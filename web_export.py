import json
from datetime import datetime


def save_status(data):

    blocked = 0

    for item in data:
        if item["nawala"]["blocked"]:
            blocked += 1

    output = {
        "last_update": datetime.now().strftime("%d-%m-%Y %H:%M:%S"),
        "total": len(data),
        "blocked": blocked,
        "safe": len(data) - blocked,
        "data": []
    }

    for item in data:

        output["data"].append({
            "domain": item["domain"],
            "blocked": item["nawala"]["blocked"]
        })

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