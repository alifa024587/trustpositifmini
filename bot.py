from telegram import Update
from telegram.ext import (
    Application,
    CommandHandler,
    ContextTypes
)

from config import BOT_TOKEN, CHAT_ID
from nawala import check_domains
from web_export import save_status

from storage import (
    add_domain,
    delete_domain,
    load_domains
)

import os
import json
from datetime import datetime

last_export = ""
last_status = {}

async def start(update: Update, context: ContextTypes.DEFAULT_TYPE):

    text = (
        "🤖 TrustPositif Checker Bot\n\n"

        "/add domain.com\n"
        "Tambah domain\n\n"

        "/delete domain.com\n"
        "Hapus domain\n\n"

        "/list\n"
        "List domain\n\n"

        "/webstatus\n"
        "Cek semua domain\n\n"

        "/cek domain.com\n"
        "Cek 1 domain\n\n"

        "/cekall domain1 domain2 ...\n"
        "Atau paste banyak domain"
    )

    await update.message.reply_text(text)


async def add(update: Update, context: ContextTypes.DEFAULT_TYPE):

    if not context.args:
        return await update.message.reply_text(
            "Contoh:\n/add google.com"
        )

    domain = context.args[0].lower()

    if not add_domain(domain):
        return await update.message.reply_text(
            "⚠️ Domain sudah ada."
        )

    result = check_domains([domain])

    item = result["data"][0]

    status = (
        "🚫 BLOCKED"
        if item["nawala"]["blocked"]
        else "✅ NOT BLOCKED"
    )

    result_all = check_domains(
        load_domains()
    )

    save_status(
        result_all["data"]
    )

    update_web()

    await update.message.reply_text(
        f"✅ Domain ditambahkan\n\n"
        f"🌐 {domain}\n"
        f"{status}"
    )


async def delete(update: Update, context: ContextTypes.DEFAULT_TYPE):

    if not context.args:
        return await update.message.reply_text(
            "Contoh:\n/delete google.com"
        )

    domain = context.args[0].lower()

    delete_domain(domain)

    result_all = check_domains(
        load_domains()
    )

    save_status(
        result_all["data"]
    )

    update_web()
    await update.message.reply_text(
        "✅ Domain dihapus."
    )


async def list_domain(update: Update, context: ContextTypes.DEFAULT_TYPE):

    domains = load_domains()

    if not domains:
        return await update.message.reply_text(
            "Belum ada domain."
        )

    text = ""

    for i, d in enumerate(domains, start=1):
        text += f"{i}. {d}\n"

    await update.message.reply_text(text)


async def cek(update: Update, context: ContextTypes.DEFAULT_TYPE):

    if not context.args:
        return await update.message.reply_text(
            "Contoh:\n/cek google.com"
        )

    domain = context.args[0].lower()

    msg = await update.message.reply_text(
        "🔍 Sedang mengecek..."
    )

    result = check_domains([domain])

    item = result["data"][0]

    status = (
        "🚫 BLOCKED"
        if item["nawala"]["blocked"]
        else "✅ NOT BLOCKED"
    )

    await msg.edit_text(
        f"🌐 {domain}\n\n"
        f"{status}"
    )


async def webstatus(update: Update, context: ContextTypes.DEFAULT_TYPE):

    domains = load_domains()

    if not domains:
        return await update.message.reply_text(
            "Belum ada domain."
        )

    msg = await update.message.reply_text(
        "🔍 Sedang mengecek..."
    )

    try:

        result = check_domains(domains)

        text = ""

        for item in result["data"]:

            status = (
                "🚫 BLOCKED"
                if item["nawala"]["blocked"]
                else "✅ NOT BLOCKED"
            )

            text += (
                f"🌐 {item['domain']}\n"
                f"{status}\n\n"
            )

    except:

        text = "❌ Gagal mengambil data."

    await msg.edit_text(text)


async def cekall(update: Update, context: ContextTypes.DEFAULT_TYPE):

    text_input = update.message.text.replace(
        "/cekall",
        ""
    ).strip()

    if not text_input:
        return await update.message.reply_text(
            "Contoh:\n\n"
            "/cekall\n"
            "google.com\n"
            "facebook.com"
        )

    domains = []

    for line in text_input.splitlines():

        line = line.strip()

        if line:
            domains.append(line)

    msg = await update.message.reply_text(
        "🔍 Sedang mengecek..."
    )

    try:

        result = check_domains(domains)

        hasil = ""

        for item in result["data"]:

            status = (
                "🚫 BLOCKED"
                if item["nawala"]["blocked"]
                else "✅ NOT BLOCKED"
            )

            hasil += (
                f"🌐 {item['domain']}\n"
                f"{status}\n\n"
            )

    except:

        hasil = "❌ Gagal mengambil data."

    await msg.edit_text(hasil)

async def monitor(context: ContextTypes.DEFAULT_TYPE):

    global last_export

    try:

        domains = load_domains()

        if not domains:
            return

        result = check_domains(domains)

        print(
            f"[{datetime.now().strftime('%H:%M:%S')}] "
            f"Checked {len(domains)} domains"
        )

        current = json.dumps(
            result["data"],
            sort_keys=True
        )

        save_status(result["data"])

        update_web()

        last_export = current

        for item in result["data"]:

            domain = item["domain"]
            blocked = item["nawala"]["blocked"]

            if blocked:

                await context.bot.send_message(
                    chat_id=CHAT_ID,
                    text=
                    f"🚨 DOMAIN NAWALA KO!\n\n"
                    f"🌐 {domain}\n\n"
                    f"❌ BLOCKED\n\n"
                    f"Segera ganti domain Ko!"
                )

            else:

                if last_status.get(domain) == True:

                    await context.bot.send_message(
                        chat_id=CHAT_ID,
                        text=
                        f"✅ DOMAIN PULIH\n\n"
                        f"🌐 {domain}\n\n"
                        f"Sudah tidak terdeteksi Nawala."
                    )

            last_status[domain] = blocked

    except Exception:
        import traceback
        traceback.print_exc()

def update_web():

    os.system("git add status.json")

    if os.system("git diff --cached --quiet") != 0:

        os.system(
            'git commit -m "auto update"'
        )

        os.system(
            "git push origin main"
        )
        
def main():

    app = (
        Application.builder()
        .token(BOT_TOKEN)
        .build()
    )

    app.add_handler(
        CommandHandler(
            "start",
            start
        )
    )

    app.add_handler(
        CommandHandler(
            "add",
            add
        )
    )

    app.add_handler(
        CommandHandler(
            "delete",
            delete
        )
    )

    app.add_handler(
        CommandHandler(
            "list",
            list_domain
        )
    )

    app.add_handler(
        CommandHandler(
            "webstatus",
            webstatus
        )
    )

    app.add_handler(
        CommandHandler(
            "cek",
            cek
        )
    )

    app.add_handler(
        CommandHandler(
            "cekall",
            cekall
        )
    )

    app.job_queue.run_repeating(
        monitor,
        interval=120,
        first=10
    )

    print("Bot running...")

    app.run_polling()


if __name__ == "__main__":
    main()