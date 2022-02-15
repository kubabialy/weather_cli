FROM php:8.1-cli
COPY . /usr/src/weather_cli
WORKDIR /usr/src/weather_cli
CMD [ "php", "./weather" ]