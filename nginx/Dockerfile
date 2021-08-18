FROM nginx:mainline-alpine

RUN apk update && \
    apk add bash

RUN rm /etc/nginx/conf.d/default.conf
COPY etc/server.conf /etc/nginx/conf.d/server.conf

EXPOSE 443
EXPOSE 80

