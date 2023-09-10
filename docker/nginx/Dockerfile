FROM nginx:latest

ADD ./docker/nginx/LogAnalyzer.conf /etc/nginx/conf.d/default.conf

ADD ./ /app/

RUN chmod 777 /app/upload