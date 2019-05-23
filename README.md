Docker DNS Server
==============

This is an Authoritative DNS Server written in pure PHP.
It will listen to DNS request on the default port (Default: port 53) and give answers about any domain that it has DNS records for.
This class can be used to give DNS responses dynamically based on your pre-existing PHP code.

Supported Record Types
====================

* A
* NS
* CNAME
* SOA
* PTR
* MX
* TXT
* AAAA
* OPT
* AXFR
* ANY

Example:
========
Edit config/dns_record.json

And execute docker-compose up -d

And here is us querying it and seeing the response
```
$ dig @127.0.0.1 test.com A +short
111.111.111.111

$ dig @127.0.0.1 test.com TXT +short
"Some text."

$ dig @127.0.0.1 test2.com A +short
111.111.111.111
112.112.112.112
```
