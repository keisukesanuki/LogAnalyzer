FROM nginx:latest

ADD ./docker/nginx/LogAnalyzer.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /app/public
ADD ./public/ /app/public/