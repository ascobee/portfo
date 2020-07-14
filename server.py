import json
import urllib
from os import curdir, sep
from urlparse import parse_qs
from BaseHTTPServer import BaseHTTPRequestHandler, HTTPServer

SITE_VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify'
SITE_SECRET = '6Lebyq8ZAAAAAC_Zafm3gqCp4aNxMHgObGHq5YJ1'
RECAPTCHA_RESPONSE_PARAM = 'g-recaptcha-response'


class Handler(BaseHTTPRequestHandler):
    def set_headers(self):
        self.send_response(200)
        self.send_header('Content-type', 'text/html')
        self.end_headers()

    def do_GET(self):
        self.set_headers()
        self.wfile.write(open(curdir + sep + 'contact.html').read() % '')

    def do_POST(self):
        self.set_headers()
        post_body = parse_qs(self.rfile.read(
            int(self.headers['Content-Length'])))

        success = False
        if RECAPTCHA_RESPONSE_PARAM in post_body:
            token = post_body[RECAPTCHA_RESPONSE_PARAM][0]
            resp = urllib.urlopen(
                SITE_VERIFY_URL, urllib.urlencode(
                    {'secret': SITE_SECRET, 'response': token}, True)).read()
            if json.loads(resp).get("success"):
                success = True

        if success:
            message = 'Thank You! I will get in touch with you soon!'
        else:
            message = 'There was an error.'
        self.wfile.write(open(curdir + sep + 'contact.html').read() % message)


if __name__ == '__main__':
    httpd = HTTPServer(('', 8080), Handler)
    httpd.serve_forever()
