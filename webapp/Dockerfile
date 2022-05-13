FROM ambientum/php:8.0-nginx

COPY . .

# RUN ls -lsaR bootstrap
RUN [ -d bootstrap/cache ] || sudo mkdir bootstrap/cache && \
	sudo chmod -R 777 storage bootstrap/cache && \
	composer install --no-dev && \
	cp .env.example .env && \
	php artisan key:generate
	
ENV APP_NAME=TheComm