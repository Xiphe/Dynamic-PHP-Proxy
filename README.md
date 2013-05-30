Dynamic PHP Proxy
=================

A PHP based, self-hosted alternative for Dynamic DNS Services.


What it does
------------

Basically it's just the [php-proxy from Jens Segers](https://github.com/jenssegers/php-proxy)  
The trick is, that the target-address of the proxy is now dynamic
and can be set by calling `new_ip.php` with correct login data.

This enables the target to tell the proxy his new IP whenever
it changes. (Same principle as Dynamic DNS Services).


Install
-------

1. Download or clone this project
2. Run `composer install` ([more info](http://getcomposer.org/))
3. Rename `private/config.php.sample` to `private/config.php` and
   adjust the ports and timeout if required.
4. Rename `private/user.php.sample` to `private/user.php` and set
   a username and a strong password
5. Create a `private/ip.txt` file and put the current ip address of
   the target in it.
6. Make sure the `log/` directory and `private/ip.txt` are writable
   by your www-data user.
7. Set up your target to call `new_ip.php` with the login data
   of `private/user.php` whenever its IP changes.
8. (Optional) To reduce conflicts and increase safety, you can
   rename `new_ip.php` to something cryptic. The new name has to
   replace the old one in the `.htaccess` and of course in the
   configuration of your target.
9. (Recommended) Buy some Beer for katzgrau, cwill747, InfinityWebMe,
   jenssegers and xiphe.


License
-------

Copyright (c) 2013 Hannes Diercks

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.