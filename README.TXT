Copyright 2014, CardConnect (http://www.cardconnect.com)

Permission to use, copy, modify, and/or distribute this software for any
purpose with or without fee is hereby granted, provided that the above
copyright notice and this permission notice appear in all copies.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY AND
FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
PERFORMANCE OF THIS SOFTWARE.
----

CardConnect PHP REST client example

PHP Requirements:
- php5 json module
- PEST library from: https://github.com/educoder/pest - place in subdirectory named 'pest'

This package includes an example client library (CardConnectRestClient.php) and example
usage of the client (CardConnectRestClientExample.php).

To run:
1) Modify CardConnectRestClientExample and set the $user and $password variables to 
your CardConnect username and password
2) Modify CardConnectRestClientExample.php and set the $url variable to your
CardConnect instance (http://sitename.prinpay.com:6443/cardconnect/rest);
3) Run via : php CardConnectClientExample.php

These examples use the Pest PHP module (https://github.com/educoder/pest)
