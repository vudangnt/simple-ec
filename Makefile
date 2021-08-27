run: up
up: docker-compose.yml
	docker-compose -f ./docker-compose.yml up --build -d
down: docker-compose.yml
	docker-compose down --remove-orphans
ssh:
	docker exec -it vu-test bash