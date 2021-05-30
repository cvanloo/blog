-- drop and create database

DROP DATABASE IF EXIST forum;
CREATE DATABASE forum;
USE forum;

-- user specific tables

CREATE TABLE user (
	id int PRIMARY KEY AUTO_INCREMENT,
	email varchar(56) NOT NULL,
	account_name varchar(32) NOT NULL,
	display_name varchar(32) NOT NULL,
	create_date DATE NOT NULL DEFAULT CURDATE(),
	is_blocked TINYINT(1) NOT NULL DEFAULT 0,
	is_deleted TINYINT(1) NOT NULL DEFAULT 0,

	UNIQUE (email),
	UNIQUE (account_name)
);

CREATE TABLE authentication (
	user_id int NOT NULL,
	salt: binary(128) NOT NULL,
	sha512 binary(64) NOT NULL,
	
	UNIQUE (user_id),
	FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE access_right (
	user_id int NOT NULL,
	ar_key varchar(32) NOT NULL,
	ar_value varchar(256) NOT NULL,

	UNIQUE (user_id, ar_key),
	FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE setting (
	user_id int NOT NULL,
	s_key varchar(32) NOT NULL,
	s_value varchar(256) NOT NULL,

	UNIQUE (user_id, s_key),
	FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE
);
