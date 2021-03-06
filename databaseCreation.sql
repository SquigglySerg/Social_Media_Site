CREATE TABLE Users (
	email varchar(255) PRIMARY KEY,
	firstName varchar(255),
	lastName varchar(255),
	password varchar(255),
	verified BOOLEAN
);

CREATE TABLE User_Profile (
	intro varchar(1023),
	hobbies varchar(1023),
	music varchar(1023),
	avatar varchar(255),
	background varchar(255),
	email varchar(255),
	FOREIGN KEY(email) REFERENCES Users(email)
);
