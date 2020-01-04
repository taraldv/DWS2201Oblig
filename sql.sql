DROP TABLE IF EXISTS users;

CREATE TABLE users(
	userId INTEGER AUTO_INCREMENT,
	email VARCHAR(150) UNIQUE,
	hash VARCHAR(255),
	reset VARCHAR(255),
	PRIMARY KEY (userId));
