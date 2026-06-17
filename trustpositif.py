import requests
from requests.adapters import HTTPAdapter
from urllib3.util.retry import Retry

HOME = "https://trustpositif.id/checker"
API = "https://trustpositif.id/checker/check"


def create_session():
    s = requests.Session()

    # Gunakan Tor Browser
    s.proxies.update({
        "http": "socks5h://127.0.0.1:9150",
        "https": "socks5h://127.0.0.1:9150"
    })

    print(
        "IP Tor:",
        s.get("https://api.ipify.org", timeout=30).text
    )

    retry = Retry(
        total=3,
        backoff_factor=1,
        status_forcelist=[429, 500, 502, 503, 504]
    )

    adapter = HTTPAdapter(max_retries=retry)
    s.mount("http://", adapter)
    s.mount("https://", adapter)

    s.headers.update({
        "User-Agent": (
            "Mozilla/5.0 (Windows NT 10.0; Win64; x64) "
            "AppleWebKit/537.36 (KHTML, like Gecko) "
            "Chrome/137.0 Safari/537.36"
        )
    })

    return s


def check_domain(domain):
    s = create_session()

    try:
        print(
            "IP:",
            s.get("https://api.ipify.org", timeout=30).text
        )
        
        # Ambil halaman checker
        r = s.get(HOME, timeout=30)
        r.raise_for_status()

        # Ambil CSRF token
        csrf = s.cookies.get("XSRF-TOKEN")

        if not csrf:
            raise Exception("XSRF token tidak ditemukan")

        headers = {
            "Accept": "application/json",
            "Content-Type": "application/json",
            "Origin": "https://trustpositif.id",
            "Referer": HOME,
            "X-CSRF-TOKEN": csrf
        }

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

        r.raise_for_status()

        return r.json()

    except Exception as e:
        print("ERROR:", e)
        return None


# Contoh
hasil = check_domain("google.com")
print(hasil)