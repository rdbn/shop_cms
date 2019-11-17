FROM alpine:3.7

RUN apk add php7-amqp php7-fpm php7-redis php7-apcu php7-ctype php7-curl php7-dom php7-gd php7-iconv php7-imagick php7-json \
php7-intl php7-mcrypt php7-mbstring php7-opcache php7-openssl php7-pdo php7-pdo_mysql php7-mysqli php7-xml php7-zlib php7-phar \
php7-tokenizer php7-session php7-simplexml php7-xdebug php7-pcntl php7-zip php7-bcmath php7-sockets make curl git openssh \
php7-fileinfo php7-xmlreader php7-xmlwriter \
&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY php.ini /etc/php7/php.ini
COPY php-fpm.conf /etc/php7/php-fpm.conf
COPY www.conf /etc/php7/php-fpm.d/www.conf

WORKDIR /var/www/shop_cms
EXPOSE 9001

CMD ["php-fpm7", "-F", "-R"]