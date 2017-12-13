CREATE TABLE Users (
	email varchar(255) PRIMARY KEY,
	firstName varchar(255),
	lastName varchar(255),
	password varchar(255)
);

CREATE TABLE User_Profile (
	intro varchar(255),
	hobbies varchar(255),
	music varchar(255),
	email varchar(255),
	FOREIGN KEY(email) REFERENCES Users(email)
);
