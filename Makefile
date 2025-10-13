start_server:
	php -S localhost:8091
compose_up_dev:
	docker compose -f compose.dev.yaml up -d