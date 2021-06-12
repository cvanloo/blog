-- drop and create database

DROP DATABASE IF EXISTS blog;
CREATE DATABASE blog;
USE blog;

-- user specific tables

CREATE TABLE user (
	id int PRIMARY KEY AUTO_INCREMENT,
	email varchar(56) NOT NULL,
	account_name varchar(32) NOT NULL,
	display_name varchar(32) NOT NULL,
	pw_hash varchar(255) NOT NULL, -- The salt is stored within the password hash
	create_date DATE NOT NULL DEFAULT CURDATE(),
	is_blocked TINYINT(1) NOT NULL DEFAULT 0,
	is_deleted TINYINT(1) NOT NULL DEFAULT 0,

	UNIQUE (email),
	UNIQUE (account_name)
);

/*CREATE TABLE authentication (
	user_id int NOT NULL,
	salt binary(128) NOT NULL,
	sha512 binary(64) NOT NULL,
	
	UNIQUE (user_id),
	FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE
);*/

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

-- blog specific tables

CREATE TABLE blog (
	id int PRIMARY KEY AUTO_INCREMENT,
	creator_id int NOT NULL,
	title varchar(64) NOT NULL,
	description varchar(512),
	content_path varchar(256) NOT NULL,
	create_datetime DATETIME NOT NULL DEFAULT NOW(),
	is_archived TINYINT(1) NOT NULL DEFAULT 0,
	is_deleted TINYINT(1) NOT NULL DEFAULT 0,

	UNIQUE (content_path),
	FOREIGN KEY (creator_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE tag (
	id int PRIMARY KEY AUTO_INCREMENT,
	name varchar(12),

	UNIQUE (name)
);

CREATE TABLE blog_tag (
	blog_id int NOT NULL,
	tag_id int NOT NULL,

	FOREIGN KEY (blog_id) REFERENCES blog(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (tag_id) REFERENCES tag(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE comment (
	id int PRIMARY KEY AUTO_INCREMENT,
	creator_id int NOT NULL,
	blog_id int NOT NULL,
	parent_id int,
	create_datetime DATETIME NOT NULL DEFAULT NOW(),
	is_archived TINYINT(1) NOT NULL DEFAULT 0,
	is_deleted TINYINT(1) NOT NULL DEFAULT 0,

	FOREIGN KEY (creator_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (blog_id) REFERENCES blog(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (parent_id) REFERENCES comment(id) ON UPDATE CASCADE ON DELETE CASCADE
);
