FROM nginx

RUN mkdir -p /etc/nginx
RUN touch /etc/nginx/nginx.conf
COPY nginx.conf.example /etc/nginx/nginx.conf
