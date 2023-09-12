FROM php:7.4.8-fpm

RUN apt-get update -qq
RUN apt-get clean
RUN rm -rf /var/cache/apt

ADD ./ /app/

RUN chmod 777 /app/upload