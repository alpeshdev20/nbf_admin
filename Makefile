setup:
	@make build
	@make up 
	@make composer-update
build:
	docker compose build app --no-cache --force-rm
stop:
	docker compose stop
up:
	docker compose up -d
composer-update:
	docker exec nbf-admin bash -c "composer update --ignore-platform-reqs"
data:
	docker exec nbf-admin bash -c "php artisan migrate"
	docker exec nbf-admin bash -c "php artisan db:seed"
import:
	docker exec -i nbf-admin-db mysql -uebook -pebook ebook < ebook-dump.sql