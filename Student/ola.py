import time
import cloudscraper
from bs4 import BeautifulSoup

def ola(url):
    soup = None
    client = cloudscraper.create_scraper(allow_brotli=False)
    headers = {
        'User-Agent': 'Mozilla/5.0 (X11; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0',
        'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
        'Accept-Language': 'en-US,en;q=0.5',
        'Connection': 'keep-alive',
        'Upgrade-Insecure-Requests': '1',
        'Sec-Fetch-Dest': 'document',
        'Sec-Fetch-Mode': 'navigate',
        'Sec-Fetch-Site': 'same-origin',
        'Sec-Fetch-User': '?1',
    }

    while 'rocklinks.net' not in soup and "try2link.com" not in soup and "ez4short.com" not in soup:
        try:
            res = client.get(url, headers=headers)
            soup = BeautifulSoup(res.content, "html.parser")
            if "rocklinks.net" in soup:
                url = soup.find("a", id="go-link").get("href")
                domain = "https://blog.disheye.com"
                code = url.split("/")[-1]
                final_url = f"{domain}/{code}"
                resp = client.get(final_url)
                soup = BeautifulSoup(resp.content, "html.parser")
                inputs = soup.find(id="go-link").find_all(name="input")
                data = {input.get('name'): input.get('value') for input in inputs}
                headers = {"X-Requested-With": "XMLHttpRequest"}
                time.sleep(10)
                r = client.post(f"{domain}/links/go", data=data, headers=headers)
                return r.json().get('url', "Something went wrong :(")
            elif "try2link.com" in soup:
                url = soup.find("a", id="go-link").get("href")
                params = (('d', int(time.time()) + (60 * 4)),)
                r = client.get(url, params=params, headers={'Referer': 'https://newforex.online/'})
                soup = BeautifulSoup(r.text, 'html.parser')
                inputs = soup.find(id="go-link").find_all(name="input")
                data = {input.get('name'): input.get('value') for input in inputs}
                headers = {'X-Requested-With': 'XMLHttpRequest'}
                time.sleep(7)
                bypassed_url = client.post('https://try2link.com/links/go', headers=headers, data=data)
                return bypassed_url.json().get("url", "Something went wrong :(")
            elif "ez4short.com" in soup:
                ref = "https://techmody.io/"
                resp = client.get(url, headers={"referer": ref})
                soup = BeautifulSoup(resp.content, "html.parser")
                inputs = soup.find_all("input")
                data = {input.get('name'): input.get('value') for input in inputs}
                headers = {"X-Requested-With": "XMLHttpRequest"}
                time.sleep(8)
                r = client.post("https://ez4short.com/links/go", data=data, headers=headers)
                return r.json().get('url', "Something went wrong :(")
        except Exception as e:
            return f"Error: {e}"

url = input("Enter the URL: ")
print(ola(url))
