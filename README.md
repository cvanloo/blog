# Blog

Modul 133 Project

## Setup development environment

Needed packages (Gentoo):

* app-emulation/docker
* app-emulation/docker-compose
* dev-db/mariadb

## docker-compose

Make sure the docker service is running:

	rc-service docker start # for OpenRC
	systemctl start docker  # for systemd

Start:

	docker-compose up -d

Stop:

	docker-compose stop

## mariadb

When the docker service is running, find it's IP address:

	docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' blog_db_1

The docker-compose.yaml is configured to assign a static ip address of
```172.19.0.3``` to the mariadb instance.

Connect to the db:

	mysql -h 172.19.0.3 -u admin -ptest

Shut down the docker containers:

	docker-compose stop

Completely reset (delete) the containers:

	docker-compose down -v
