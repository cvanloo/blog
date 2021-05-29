# Blog

Modul 133 Project

## Setup development environment

Needed packages (Gentoo):

* app-emulation/docker
* app-emulation/docker-compose
* dev-db/mysql

## docker-compose

Make sure the docker service is running:

	rc-service docker start # for OpenRC
	systemctl start docker  # for systemd

Start:

	docker-compose up -d

Stop:

	docker-compose stop

