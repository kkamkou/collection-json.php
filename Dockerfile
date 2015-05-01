FROM php:cli

RUN mkdir /opt/collection-json.php

VOLUME ["/opt/collection-json.php"]

WORKDIR /opt/collection-json.php

ENV PATH $PATH:/opt/vendor/bin

RUN cd .. \
  && php -r "readfile('https://getcomposer.org/installer');" | php \
  && apt-get update && apt-get install -y zlib1g-dev \
  && docker-php-ext-install zip \
  && php composer.phar require phpunit/phpunit zerkalica/phpcs:dev-master
