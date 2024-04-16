pint.json.PHONY: start bash mqtt restart down ps network

CONTAINER_NAME = php-fpm

start:
	sudo docker-compose build && sudo docker-compose up -d && sudo docker-compose exec $(CONTAINER_NAME) php artisan migrate

bash:
	sudo docker-compose exec $(CONTAINER_NAME) bash

mqtt:
	sudo docker exec -it -u 1883 kvoda_expeditors_mqtt_1 sh

restart:
	sudo docker-compose down && sudo docker-compose build && sudo docker-compose up -d --remove-orphans && sudo docker-compose exec $(CONTAINER_NAME) php artisan migrate

down:
	sudo docker-compose down

ps:
	sudo docker-compose ps

network:
	sudo docker network create expeditors
