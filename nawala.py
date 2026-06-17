import requests
import re

session = requests.Session()

HEADERS = {
    "User-Agent": "Mozilla/5.0"
}


def _get_csrf():
    r = session.get(
        "https://trustpositif.id/checker",
        headers=HEADERS
    )

    r.raise_for_status()

    m = re.search(
        r'<meta name="csrf-token" content="([^"]+)"',
        r.text
    )

    if not m:
        raise Exception("CSRF token tidak ditemukan")

    return m.group(1)


def check_domains(domains):

    if isinstance(domains, str):
        domains = [domains]

    hasil = []

    # Pecah menjadi batch 20 domain
    for i in range(0, len(domains), 20):

        batch = domains[i:i + 20]

        csrf = _get_csrf()

        r = session.post(
            "https://trustpositif.id/checker/check",
            json={
                "domains": "\n".join(batch)
            },
            headers={
                **HEADERS,
                "Accept": "application/json",
                "Content-Type": "application/json",
                "Origin": "https://trustpositif.id",
                "Referer": "https://trustpositif.id/checker",
                "X-CSRF-TOKEN": csrf
            }
        )

        r.raise_for_status()

        data = r.json()

        for item in data.get("results", []):

            hasil.append({
                "domain": item["Domain"],
                "nawala": {
                    "blocked": item["Blocked"]
                },
                "network": {
                    "blocked": False
                }
            })

    return {
        "data": hasil
    }


def check_domain(domain):
    return check_domains([domain])