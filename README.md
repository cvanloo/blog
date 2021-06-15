# Blog

Modul 133 Project

## Setup development environment

## Linux

Needed packages:

These are the package names on Gentoo, but you should find them in your distro's repo too.

* app-emulation/docker
* app-emulation/docker-compose
* dev-lang/php
* dev-db/mariadb

When compiling 'dev-lang/php' on Gentoo, make sure to use the 'pdo', 'xmlreader' and 'xmlwriter' local USE flags.

Run ```composer install``` to install required dependencies.

## Windows

### Install PHP

Download the PHP Zip:

https://windows.php.net/download/#php-8.0-ts-vs16-x64

Extract it to ```C:\php\``` and make sure this path is in your PATH Variable.

Rename ```C:\php\php.ini-production``` to ```C:\php\php.ini``` and edit the file:

* Uncomment ```extension openssl```
* Uncomment ```extension mbstrings```
* Uncomment ```extension pdo_mysql```

### Install Docker

Open PowerShell:

	dism.exe /online /enable-feature /featurename:Microsoft-Windows-Subsystem-Linux /all /norestart

	dism.exe /online /enable-feature /featurename:VirtualMachinePlatform /all /norestart

Download and execute: https://wslstorestorage.blob.core.windows.net/wslblob/wsl_update_x64.msi

Once that's done run:

	wsl --set-default-version 2

Now download and install Docker Desktop with the WSL2 Backend: https://docs.docker.com/docker-for-windows/install/

## docker-compose

Make sure the docker service is running:

	rc-service docker start # for OpenRC
	systemctl start docker  # for systemd
	
	# On Windows start the Docker Desktop application

Start:

	docker-compose up -d php-apache

Stop:

	docker-compose stop

## mariadb

When the docker service is running, find it's IP address:

	docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' blog_mariadb_1

The docker-compose.yaml is configured to assign a static ip address of
```172.19.0.3``` to the mariadb instance.

Connect to the db:

	mysql -h 172.19.0.3 -u admin -ptest

Shut down the docker containers:

	docker-compose stop

Completely reset (delete) the containers:

	docker-compose down -v

To remove an image:

	docker images # show all images
	docker rmi <image-id> --force

To rebuild an image:

	docker-compose build <service>

### Setup MariaDB (Linux)

From the project root directory run:

	myqsl -h 172.19.0.3 -u admin -ptest
	source create_database.sql

### Setup MariaDB (Windows)

If the above for some reason doesn't work on Windows try:

From the project root directory run:

	docker cp create_database.sql blog_mariadb_1:/
	docker exec -it blog_mariadb_1 /bin/bash
	mysql -h localhost -u admin -ptest
	source create_database.sql

## PHPUnit

PHPUnit is used for unit testing.

To run the tests, execute:

	docker-compose run phpunit tests

## Directory Structure

  .  
├──   Projectdescription  
└──   src  
   ├──   config  
   ├──   Modules  
   ├──   public  
   │  ├──   assets  
   │  └──   index.php  
   ├──   Templates  
   └──   tests

Folder | Description
------ | -----------
src    | contains the source code
config | application config
Modules | Application Logic
public | Public accessible files
Templates | Code that renders HTML
tests  | unit tests
