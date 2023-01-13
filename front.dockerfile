FROM nginx:1.22
COPY front/build/ /usr/share/nginx/html

EXPOSE 80

