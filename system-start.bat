docker compose up -d

docker run --rm -d -p 4200:80 pos-fe:v11

docker run --rm -d -p 80:80 --name my-apache-php-app -v  %CD%\POS_Script:/var/www/html php:7.2-apache

PAUSE