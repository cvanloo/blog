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

-- thread specific tables

CREATE TABLE forum (
	id int PRIMARY KEY AUTO_INCREMENT,
	name varchar(32) NOT NULL,
	description varchar(512) NOT NULL,
	rules varchar(512) NOT NULL,
	create_date DATE NOT NULL DEFAULT CURDATE(),
	is_deleted TINYINT(1) NOT NULL DEFAULT 0,

	UNIQUE (name)
);

CREATE TABLE forum_mod (
	id int PRIMARY KEY AUTO_INCREMENT,
	user_id int NOT NULL,
	forum_id int NOT NULL,
	mod_level int NOT NULL DEFAULT 0,

	UNIQUE (user_id, forum_id),
	FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (forum_id) REFERENCES forum(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE user_forum (
	id int PRIMARY KEY AUTO_INCREMENT,
	user_id int NOT NULL,
	forum_id int NOT NULL,
	join_date DATE NOT NULL DEFAULT CURDATE(),
	is_blocked TINYINT(1) NOT NULL DEFAULT 0,

	UNIQUE (user_id, forum_id),
	FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (forum_id) REFERENCES forum(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE thread (
	id int PRIMARY KEY AUTO_INCREMENT,
	forum_id int NOT NULL,
	creator_id int NOT NULL,
	title varchar(56) NOT NULL,
	content_path varchar(256) NOT NULL,
	parent_thread_id int,
	create_datetime DATETIME NOT NULL DEFAULT NOW(),
	is_archived TINYINT(1) NOT NULL DEFAULT 0,
	is_deleted TINYINT(1) NOT NULL DEFAULT 0,

	FOREIGN KEY (forum_id) REFERENCES forum(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (creator_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (parent_thread_id) REFERENCES thread(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- chat & dm

CREATE TABLE chat (
	id int PRIMARY KEY AUTO_INCREMENT,
	name varchar(32) NOT NULL,
	create_date DATE NOT NULL DEFAULT CURDATE(),
	is_deleted TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE participant (
	id int PRIMARY KEY AUTO_INCREMENT,
	chat_id int NOT NULL,
	user_id int NOT NULL,
	join_date DATE NOT NULL DEFAULT CURDATE(),
	is_blocked TINYINT(1) NOT NULL DEFAULT 0,
	is_deleted TINYINT(1) NOT NULL DEFAULT 0,

	UNIQUE (chat_id, user_id),
	FOREIGN KEY (chat_id) REFERENCES chat(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE message (
	id int PRIMARY KEY AUTO_INCREMENT,
	creator_id int NOT NULL,
	parent_message_id int,
	message varchar(512),
	create_datetime DATETIME NOT NULL DEFAULT NOW(),
	is_deleted TINYINT(1) NOT NULL DEFAULT 0,

	FOREIGN KEY (creator_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (parent_message_id) REFERENCES message(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE message_recipient (
	participant_id int NOT NULL,
	message_id int NOT NULL,
	datetime_of_read DATETIME NOT NULL DEFAULT NOW(),

	UNIQUE (participant_id, message_id),
	FOREIGN KEY (participant_id) REFERENCES participant(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (message_id) REFERENCES message(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- misc.

CREATE TABLE report (
	id int PRIMARY KEY AUTO_INCREMENT,
	reporter_id int NOT NULL,
	reported_id int NOT NULL,
	thread_id int NOT NULL,
	reason ENUM('spam', 'rule_breaking', 'misinformation', 'abusive_or_harassing',
		'other_issue') NOT NULL,
	message varchar(512) NOT NULL,
	was_reviewed TINYINT(1) NOT NULL DEFAULT 0,

	FOREIGN KEY (reporter_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (reported_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (thread_id) REFERENCES thread(id) ON UPDATE CASCADE ON DELETE CASCADE
);
