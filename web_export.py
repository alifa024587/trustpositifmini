import json
from datetime import datetime, timedelta


def save_status(data):

    now = datetime.now()

    total = len(data)
    blocked = 0

    output = {
        "last_update": now.strftime(
            "%Y-%m-%d %H:%M:%S"
        ),

        "next_update": (
            now + timedelta(minutes=2)
        ).strftime(
            "%Y-%m-%d %H:%M:%S"
        ),

        "total_domains": total,
        "total_blocked": 0,

        "domains": []
    }

    for item in data:

        is_blocked = item["nawala"]["blocked"]

        if is_blocked:
            blocked += 1

        output["domains"].append({

            "domain":
                item["domain"],

            "nawala":
                is_blocked,

            "network":
                False,

            "status":
                "BLOCKED"
                if is_blocked
                else "NORMAL",

            "checked_at":
                datetime.now().strftime(
                    "%Y-%m-%d %H:%M:%S"
                )

        })

    output["total_blocked"] = blocked

    with open(
        "status.json",
        "w",
        encoding="utf8"
    ) as f:

        json.dump(
            output,
            f,
            indent=4
        )