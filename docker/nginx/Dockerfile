FROM nginx:latest

COPY --from=spidermane/trunk * /trunk

ARG SERVER_NAME="localhost"
ENV SERVER_NAME="$SERVER_NAME"
ARG SERVER_PORT=80
ENV SERVER_PORT="$SERVER_PORT"

ENV APP_NAME="app"
ENV APP_PORT=9000

ENV WEB_ROOT=/var/www/html/wordpress

RUN /trunk/extras/nginx

RUN /trunk/actions/cleanup
