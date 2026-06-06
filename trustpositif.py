import requests
import re

HOME = "https://trustpositif.id/checker"
API = "https://trustpositif.id/checker/check"


def check_domain(domain):

    s = requests.Session()

    headers = {
        "User-Agent": "Mozilla/5.0"
    }

    # ambil halaman checker
    r = s.get(
        HOME,
        headers=headers,
        timeout=30
    )

    r.raise_for_status()

    # ambil csrf dari cookie
    csrf = s.cookies.get("XSRF-TOKEN")

    if not csrf:
        raise Exception("XSRF token tidak ditemukan")

    headers.update({
        "Accept": "application/json",
        "Content-Type": "application/json",
        "Origin": "https://trustpositif.id",
        "Referer": "https://trustpositif.id/checker",
        "X-CSRF-TOKEN": csrf
    })

    payload = {
        "domains": domain
    }

    r = s.post(
        API,
        json=payload,
        headers=headers,
        timeout=30
    )

    print("STATUS:", r.status_code)
    print(r.text)

    return r.json()