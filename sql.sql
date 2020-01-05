DROP TABLE IF EXISTS log;
DROP TABLE IF EXISTS workout;
DROP TABLE IF EXISTS users;


CREATE TABLE users(
	userId INTEGER AUTO_INCREMENT,
	email VARCHAR(150) UNIQUE,
	hash VARCHAR(255),
	reset VARCHAR(255),
	PRIMARY KEY (userId));

CREATE TABLE workout(
	workoutId INTEGER AUTO_INCREMENT,
	userId INTEGER NOT NULL,
	name vARCHAR(255) NOT NULL,
	PRIMARY KEY (workoutId),
	FOREIGN KEY (userId) REFERENCES users(userId));
CREATE TABLE log(
	`logId` INTEGER AUTO_INCREMENT,
	`workoutId` INTEGER NOT NULL,
	`userId` INTEGER NOT NULL,
	`reps` INTEGER NOT NULL,
	`date` DATE,
	`kilo` DECIMAL(10,2),
	PRIMARY KEY (logId),
	FOREIGN KEY (workoutId) REFERENCES workout(workoutId),
	FOREIGN KEY (userId) REFERENCES users(userId));
