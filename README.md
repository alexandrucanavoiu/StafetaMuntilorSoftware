<p align="center"><a href="https://www.stafetamuntilor.ro" target="_blank"><img src="https://www.stafetamuntilor.ro/images/logo.png" width="300" alt="Stafeta Muntilor Logo"></a></p>

## StafetaMuntilorSoftware
Created to help NGOs from Romania to organize events in National Championship of Sports Tourism Stafeta Muntilor.

The software is based on the Competition Rules of the National Championship of Sports Tourism Stafeta Muntilor - [www.stafetamuntilor.ro](https://www.stafetamuntilor.ro).

StafetaMuntilorSoftware was made with the help of volunteers Sergiu Valentin Vlad and Alexandru Canavoiu in the year 2015 and continued by Alexandru Canavoiu. At this moment the framework used is Laravel.

The language used is Romanian (all pages in the web application software are in Romanian).

<br />

## Requirements
- Apache / Nginx
- PHP 8.2 with following extensions:
  - php8.2-fpm
  - php8.2-bcmath
  - php8.2-common
  - php8.2-curl
  - php8.2-mysql
  - php8.2-xml
  - php8.2-xmlrpc
  - php8.2-mbstring
  - php8.2-gd
  - php8.2-zip
  - php8.2-intl
  - php8.2-zip
  - php8.2-soap
  - php8.2-cli
  - php8.2-imagick
- Mysql 8 / MariaDB 10.5.15+
- Composer version 2.4.4+ (getcomposer.org)

<br />

## Steps to install the latest version of StafetaMuntilorSoftware
1. Put all files in your directory (folder "public" is the document root)

2. Create a database name + database username and give permission to the database.

3. Import the database "stafeta.sql" from db_to_import folder

4. Run the following commands in the directory where you put the files
```
$ php artisan clear-compiled 
$ composer install
$ composer dump-autoload
$ cp .env_example .env
```

5. Database configuration

```
$ vim .env
```
and replace

DB_DATABASE=stafetamuntilor

DB_USERNAME=stafetamuntilor

DB_PASSWORD=password123

with your credentials


6. Clearing cached bootstrap files.
```
$ php artisan optimize:clear
```
<br />

## Steps to install the versions v1.0 - v3.2.x of StafetaMuntilorSoftware in Windows

1. Download UwAmp from www.uwamp.com and run UwAmp with Php5.6 and Mysql 5.7
2. Copy the files in your Document Root
3. Restart Apache/Mysql
4. Login to the phpmyadmin with root/root and create a database "stafeta"
5. Import the database "stafeta.sql" from db_to_import folder 
5. Browse www from UwAmp


<br />

## Security Vulnerabilities

If you discover a security vulnerability, please send an e-mail to Stafeta Muntilor via [office@stafetamuntilor.ro](mailto:office@stafetamuntilor.ro).

This web app software is used in offline mode and is not expoused to the internet.

<br />

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).