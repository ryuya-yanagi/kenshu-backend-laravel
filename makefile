init:
	docker-compose up -d --build
	@make composer
	docker-compose exec kenshu-laravel cp .env.example .env
	docker-compose exec kenshu-laravel php artisan key:generate
	docker-compose exec kenshu-laravel php artisan storage:link
	docker-compose exec kenshu-laravel chmod -R 777 storage bootstrap/cache
	docker-compose exec kenshu-laravel npm ci
	@make migrate
	@make seed
build:
	docker-compose build
up:
	docker-compose up -d
down:
	docker-compose down
restart:
	@make down
	@make up
ps:
	docker-compose ps
migrate:
	docker exec kenshu-laravel php artisan migrate
laravel:
	docker exec -it kenshu-laravel bash
nginx:
	docker exec -it kenshu-nginx ash
mysql:
	docker exec -it kenshu-mysql bash -c 'mysql -u kenshu -ppassword'
mysql-logs:
	docker exec kenshu-mysql tail -f /var/log/mysql/mysql-general.log
mysql-restart:
	docker-compose down kenshu-mysql
	docker-compose up -d kenshu-mysql
composer:
	docker-compose exec kenshu-laravel composer install
autoload:
	docker exec kenshu-laravel composer dump-autoload
seed:
	docker exec kenshu-laravel php artisan db:seed
db-remove:
	docker-compose down kenshu-mysql
	rm -rf infra/mysql/data
npm:
	@make npm-install
npm-install:
	docker-compose exec kenshu-nginx npm install
npm-dev:
	docker-compose exec kenshu-nginx npm run dev
npm-watch:
	docker-compose exec kenshu-nginx npm run watch
test:
	docker exec kenshu-laravel composer test
test-coverage:
	docker exec kenshu-laravel ./vendor/bin/phpunit --verbose --coverage-html tests-coverage