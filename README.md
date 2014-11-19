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
        DocumentRoot /var/www/html
        <Directory /var/www>
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
MIT