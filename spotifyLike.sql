DROP SCHEMA IF EXISTS project;

CREATE SCHEMA project;

Use project;

CREATE TABLE Person(
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
    lastname VARCHAR(30),
    firstname VARCHAR(30),
    birthdate DATE
);

CREATE TABLE Customer(
	id INT(11) PRIMARY KEY,
    username VARCHAR(30),
	FOREIGN KEY(id) REFERENCES Person(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE Artist(
	id INT(11) PRIMARY KEY,
	stageName VARCHAR(30),
    FOREIGN KEY(id) REFERENCES Person(id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE Solo(
	id INT(11) PRIMARY KEY,
	biography BLOB,
    FOREIGN KEY(id) REFERENCES Person(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE Band(
	id INT(11) PRIMARY KEY,
    bandName VARCHAR(20),
	FOREIGN KEY(id) REFERENCES Person(id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE Band_Solo(
	id INT(11) PRIMARY KEY,
	dateEntry DATE,
    dateExit DATE,
    FOREIGN KEY(id) REFERENCES Person(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE Music(
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
    idArtist INT(11),
	title VARCHAR(100),
	FOREIGN KEY(idArtist) REFERENCES Person(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE User_Music(
	idUser INT(11),
	idMusic INT(11),
    FOREIGN KEY(idUser) REFERENCES Customer(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY(idMusic) REFERENCES Music(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	PRIMARY KEY(idUser, idMusic) 
);

CREATE TABLE Album(
	id INT(11) PRIMARY KEY,
	releaseDate DATE,
    FOREIGN KEY(id) REFERENCES Music(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE Artist_Album(
	idArtist INT(11),
	idAlbum INT(11),
    FOREIGN KEY(idArtist) REFERENCES Artist(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY(idAlbum) REFERENCES Album(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	PRIMARY KEY(idArtist, idAlbum)
);

CREATE TABLE User_Album(
	idUser INT(11),
	idAlbum INT(11),
    FOREIGN KEY(idUser) REFERENCES Customer(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY(idAlbum) REFERENCES Album(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	PRIMARY KEY(idUser, idAlbum)
);

CREATE TABLE Track(
	id INT(11) PRIMARY KEY,
    length TIME,
    FOREIGN KEY (id) REFERENCES Music(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE Genre(
	label VARCHAR(20) PRIMARY KEY
);

CREATE TABLE Adaptation(
	adaptationName VARCHAR(20) PRIMARY KEY
);

CREATE TABLE Track_Genre(
	idTrack INT(11),
    idGenre VARCHAR(20),
	FOREIGN KEY(idTrack) REFERENCES Music(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY(idGenre) REFERENCES Genre(label)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	PRIMARY KEY(idTrack, idGenre)
);

CREATE TABLE Track_Adaptation(
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
    idTrack INT(11) NOT NULL,
    adaptationName VARCHAR(20) NOT NULL,
    releaseDate DATE,
    FOREIGN KEY(idTrack) REFERENCES Track(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY (adaptationName) REFERENCES Adaptation(adaptationName)
		ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE User_Track_Adaptation(
	idUser INT(11),
    idTrackAdaptation INT(11),
    grade INT(1),
    FOREIGN KEY(idUser) REFERENCES Customer(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY (idTrackAdaptation) REFERENCES Track_Adaptation(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	PRIMARY KEY(idUser, idTrackAdaptation)
);

CREATE TABLE LinkTrack(
	id INT(11) PRIMARY KEY auto_increment,
    idTrack INT(11),
    link VARCHAR(255),
    FOREIGN KEY (idTrack) REFERENCES Track(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE
);

INSERT INTO Person (lastname, firstname, birthdate)
VALUES ("Keen", "Will", '26.02.1994'), ("Van der Schoot", "Mark", "1990-10-04"),
		("Vahrman", "Fred", '1990.01.12'),
        ("Jackson", "Josh", '1991.06.14'),
        ("Allen", "Edward", '1990.12.12'),
        ("Hungerbuhler", "Nicolas", '1996.05.16');

INSERT INTO Artist
VALUES (1, "Keeno"), (2, "Maduk"), (3, "Fred V"), (4, "Grafix"), (5, "Etherwood");

INSERT INTO Customer
VALUES (6, "Grimlix");

INSERT INTO Solo(id)
VALUES (1), (2), (5);

INSERT INTO Band
VALUES (3, "Fred V & Grafix"), (4, "Fred V & Grafix");

INSERT INTO Band_Solo (id, dateEntry)
VALUES (3, '2009.01.01'), (4, '2009.01.01');

INSERT INTO Music (idArtist, title)
VALUES (5, "Beggin by letting go"), (2, "Piano only"), (null, "Oxygen"), (5, "Begging by letting go (Remix)");

INSERT INTO Album
VALUES (3, '2015.01.01');

INSERT INTO Artist_Album
VALUES (3, 3), (4, 3);

INSERT INTO Track 
VALUES (1, '2:00'), (2, '3:00'), (4, '3:00');

INSERT INTO Genre
VALUES ("Drum'n bass");

INSERT INTO Adaptation
VALUES ("Remix");

INSERT INTO Track_Genre
VALUES (1, "Drum'n bass"), (2, "Drum'n bass"), (4, "Drum'n bass");

INSERT INTO Track_Adaptation(idTrack, adaptationName, releaseDate)
VALUES (4, "Remix", "2019-01-01");

INSERT INTO LinkTrack(idTrack, link)
VALUES (1, "tracks\Beggin by letting go.mp3");



