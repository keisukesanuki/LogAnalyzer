FROM nginx:latest

RUN apt-get update -qq
RUN apt-get clean
RUN rm -rf /var/cache/apt

ADD ./docker/nginx/LogAnalyzer.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /app/public
ADD ./public/ /app/public/