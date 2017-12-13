CREATE TABLE Users (
	email varchar(255) PRIMARY KEY,
	firstName varchar(255),
	lastName varchar(255),
	password varchar(255)
);

CREATE TABLE User_Profile (
	intro varchar(1023),
	hobbies varchar(1023),
	music varchar(1023),
	email varchar(255),
	FOREIGN KEY(email) REFERENCES Users(email)
);
