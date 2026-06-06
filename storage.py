import json
import os

FILE = "domains.json"

def load_domains():
    if not os.path.exists(FILE):
        return []

    with open(FILE, "r") as f:
        return json.load(f)

def save_domains(domains):
    with open(FILE, "w") as f:
        json.dump(domains, f, indent=2)

def add_domain(domain):
    domains = load_domains()

    domain = domain.lower().strip()

    if domain in domains:
        return False

    domains.append(domain)

    save_domains(domains)

    return True

def delete_domain(domain):
    domains = load_domains()

    domains = [
        d for d in domains
        if d != domain.lower()
    ]

    save_domains(domains)