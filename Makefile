SHELL := /bin/bash

up:
	symfony server:start -d
	docker-compose up -d
.PHONY: up


down:
	symfony server:stop
	docker-compose down
.PHONY: down

open:
	symfony open:local
.PHONY:open