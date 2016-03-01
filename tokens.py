#!/usr/bin/env python
# -*- coding: utf-8 -*-
import json
import urllib
import requests 
import hmac 
import base64

uri = "https://sandbox-authservice.priaid.ch/login"
user = "priaid_id"
secret = "password".encode("utf-8")

h = base64.b64encode(hmac.new(secret, uri).digest())

data = "Bearer " + user + ":" + h

req = requests.request('POST', uri, headers={"Authorization": data})

json_data = json.loads(req.content)

print(json_data["Token"])
