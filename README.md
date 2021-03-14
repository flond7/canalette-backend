# SETUP

## setup files
- pull from repository
- change dir (folder) name
- create the new repo on github
- change git repository: git remote set-url origin git@your.git.repo.example.com:user/repository2.git
- chack repo change: git remote -v

## check installation
- run composer install

## setup server
- check folder permissions
  sudo chown -R <user>:<group> folder-to-own

- allow permission to write writeble folder to apache2
  chown -R www-data:www-data /var/www/html/NAME-OF-YOUR-APP/writable 

- check if mod_rewrite is enabled (or enable it)
  sudo a2enmod rewrite

- check that /etc/apache2/apache2.conf has uncommented 
  LoadModule vhost_alias_module modules/mod_vhost_alias.so

- in /etc/apache2/apache2.conf add
  <Directory "/var/www/html/name-of-your-app">
      Options Indexes FollowSymLinks
      AllowOverride All
      Require all granted
  </Directory>

- create virtual host on apache2 creating a config file (copy the base config) in /etc/apache2/sites-available/NAME-OF-YOUR-APP.conf 
  <VirtualHost 172.20.34/name-of-your-app>
        # The ServerName directive sets the request scheme, hostname and port t$
        # the server uses to identify itself. This is used when creating
        # redirection URLs. In the context of virtual hosts, the ServerName
        # specifies what hostname must appear in the request's Host: header to
        # match this virtual host. For the default virtual host (this file) this
        # value is not decisive as it is used as a last resort host regardless.
        # However, you must set it for any further virtual host explicitly.
        ServerName name-of-your-app

        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/html/NAME-OF-YOUR-APP/public

        # Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
        # error, crit, alert, emerg.
        # It is also possible to configure the loglevel for particular
        # modules, e.g.
        #LogLevel info ssl:warn

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

        # For most configuration files from conf-available/, which are
        # enabled or disabled at a global level, it is possible to
        # include a line for only one particular virtual host. For example the
        # following line enables the CGI configuration for this host only
        # after it has been globally disabled with "a2disconf".
        #Include conf-available/serve-cgi-bin.conf
  </VirtualHost>

- restart
  sudo systemctl restart apache2

## rewrite rules
- in .htaccess change the rewrite rule with the correct name
  RewriteBase /NAME-OF-YOUR-APP/

- in app/Config/app.php change the baseURL
  public $baseURL = 'http://localhost/NAME-OF-YOUR-APP';
  

## database setup
- in .env change the app.baseURL
  http://SERVER.IP/NAME-OF-YOUR-APP'

- update database info




# CRUD API
## model
- add a new model in app/Model and specify
  table, primaryKey, allowedFields

## controller
- if file is copied remember to change the model in all methods

- index()
  change the ordered by

- showItem()
  change the getWhere() id string

- store()
  change function input and data structure

- update()
  change function input and data structure

## route
- no required changes if you use the url
  http://localhost/NAME-OF-YOUR-APP/controllerName/controllerMethod/var

- for better routing add in app/config/routes.php
  $routes->get('category/method/(:num)','controllerName::methodName/$1'); 
  (first part is just an indication for the url, you can choose what you want)



# CodeIgniter 4 Application Starter

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!
