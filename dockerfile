FROM nginx:latest

RUN mkdir -p /etc/nginx
COPY ./nginx.conf.example ./etc/nginx/nginx.conf