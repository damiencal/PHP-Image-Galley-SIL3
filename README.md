PHP-Image-Galley-SIL3
=====================

A PHP MVC Image Galley, build by a students from the university of Grenoble (IUT2) class SIL3.
The front end uses Bootstrap 3 and AngularJS for the Album.
Images are loaded from external sources, their links are stored within the SQLite database.


Requirements
============
Internet

Web Browser (IE =< 7)

SQLite

Apache/NGINX

PHP5 =< v5.4

HOW TO
======
Place the project inside the default root document directory configured in the virtualhost.

Make sure you configure the right Directory Options for the mod_rewrite module if you are using Apache. Here is an example of your default virtualhost configuration file (/etc/apache/sites-availabe/default.conf).

<VirtualHost *:80>
        ServerName localhost

        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/
        <Directory /var/www/>
                Options FollowSymLinks
                AllowOverride All
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
        LogLevel rewrite_module:debug
</VirtualHost>

Finally navigate using your prefered browser to the projects home page.

Credits
=======
Damien Calvignac

Licence
=======
The MIT License (MIT)
Copyright (c) 2014 Damien
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.