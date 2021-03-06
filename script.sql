DROP SCHEMA IF EXISTS project;

CREATE SCHEMA project;

Use project;

CREATE TABLE Person(
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
    lastname VARCHAR(30),
    firstname VARCHAR(30),
    birthdate DATE NOT NULL
);

CREATE TABLE Customer(
	id INT(11) PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    pwd VARCHAR(30) NOT NULL,
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
    bandname VARCHAR(20) NOT NULL,
	FOREIGN KEY(id) REFERENCES Person(id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

CREATE TABLE Band_Solo(
	idSolo INT(11),
    idBand INT(11),
	dateEntry DATE NOT NULL,
    dateExit DATE NOT NULL,
    FOREIGN KEY(idSolo) REFERENCES Person(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY(idBand) REFERENCES Person(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	PRIMARY KEY(idSolo, idBand) 
);

CREATE TABLE Music(
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
    idArtist INT(11) NOT NULL,
	title VARCHAR(100) NOT NULL,
	FOREIGN KEY(idArtist) REFERENCES Person(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE Customer_Music(
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
    idArtist INT(11),
	releaseDate DATE NOT NULL,
    FOREIGN KEY(id) REFERENCES Music(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY(idArtist) REFERENCES Artist(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE Customer_Album(
	idUser INT(11),
	idAlbum INT(11),
	grade INT(1) NOT NULL,
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
    length TIME NOT NULL,
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
    labelGenre VARCHAR(20),
	FOREIGN KEY(idTrack) REFERENCES Music(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY(labelGenre) REFERENCES Genre(label)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	PRIMARY KEY(idTrack, labelGenre)
);

CREATE TABLE Track_Adaptation(
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
    idTrack INT(11) NOT NULL,
    idAlbum INT(11),
    adaptationName VARCHAR(20) NOT NULL DEFAULT 'Original',
    releaseDate DATE NOT NULL,
    FOREIGN KEY(idTrack) REFERENCES Track(id)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY (adaptationName) REFERENCES Adaptation(adaptationName)
		ON UPDATE CASCADE
        ON DELETE CASCADE,
	FOREIGN KEY (idAlbum) REFERENCES Album(id)
		ON UPDATE CASCADE
        ON DELETE SET NULL
);

CREATE TABLE Customer_Track_Adaptation(
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

DELIMITER $$
CREATE TRIGGER check_birthdate
BEFORE INSERT ON Person
FOR EACH ROW
BEGIN
	IF(NEW.birthdate > CURRENT_DATE())
    THEN SIGNAL SQLSTATE '45000'
		SET message_text = 'Error, birthdate is wrong.';
	END IF;
END
$$

DELIMITER $$
CREATE TRIGGER check_releaseDate_1
BEFORE INSERT ON Track_Adaptation
FOR EACH ROW
BEGIN
  DECLARE birthdayArtist DATE;
    SET birthdayArtist = (
    SELECT birthdate 
		FROM Person 
        INNER JOIN Music
			ON Music.id = NEW.idTrack
		WHERE Person.id = Music.idArtist
    );
  IF(NEW.releaseDate > CURRENT_DATE() OR birthdayArtist > NEW.releaseDate)
    THEN SIGNAL SQLSTATE '45000'
      SET message_text = 'Error, releaseDate is wrong.';
  END IF;
END
$$


DELIMITER $$
CREATE TRIGGER check_releaseDate_2 BEFORE INSERT ON Album
FOR EACH ROW
BEGIN
  DECLARE birthdayArtist DATE;
    SET birthdayArtist = (
    SELECT birthdate 
		FROM Person 
        INNER JOIN Music
			ON Music.id = NEW.id
            WHERE Person.id = New.idArtist
    );
  IF(NEW.releaseDate > CURRENT_DATE() OR birthdayArtist > NEW.releaseDate)
    THEN SIGNAL SQLSTATE '45000'
      SET message_text = 'Error, releaseDate is wrong.';
  END IF;
END
$$

DELIMITER $$
CREATE TRIGGER date_check BEFORE INSERT ON Band_Solo
FOR EACH ROW
BEGIN
	DECLARE creationDate DATE;
	DECLARE soloBirthDate DATE;
    SET creationDate=(
		SELECT birthdate 
			FROM Person 
		WHERE Person.id = New.idBand);
    SET soloBirthDate=(
		SELECT birthdate
			FROM Person
		WHERE Person.id = New.idSolo);
  IF (NEW.dateEntry > New.dateExit OR New.dateEntry < creationDate OR New.dateEntry < soloBirthDate OR New.dateExit > current_date() OR NEW.dateEntry > CURRENT_DATE())
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error, dateEntry cannot be after dateExit or before band creation date';
  END IF;
END
$$



DELIMITER $$
CREATE TRIGGER grade_check1 BEFORE INSERT ON Customer_Track_Adaptation
FOR EACH ROW
BEGIN
	IF NEW.grade < '1' OR New.grade > '5'
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error, grade value is not between 1 and 5';
    END IF;
END
$$

DELIMITER $$
CREATE TRIGGER grade_check2 BEFORE INSERT ON Customer_Album
FOR EACH ROW
BEGIN
	IF NEW.grade < '1' OR New.grade > '5'
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Error, grade value is not between 1 and 5';
    END IF;
END
$$


INSERT INTO Person (lastname, firstname, birthdate)
VALUES ("Keen", "Will", '1994.02.26'), ("Van der Schoot", "Mark", "1990-10-04"),
		("Vahrman", "Fred", '1990.01.12'),
        ("Jackson", "Josh", '1991.06.14'),
        ("Allen", "Edward", '1990.12.12'),
        ("Hine", "William", '1994.09.16');

INSERT INTO Artist
VALUES (1, "Keeno"), (2, "Maduk"), (3, "Fred V"), (4, "Grafix"), (5, "Etherwood"), (6, "Whiney");

INSERT INTO Solo(id, biography)
VALUES (1, "Will Keen (born 26 February 1994), known by his stage name Keeno, is a British record producer and DJ from Winchester, renowned for adding orchestral elements to drum and bass. His debut album Life Cycle was released on 30 June 2014 through Hospital Records' imprint label
 Med School. It entered the UK Albums Chart at number 198, the UK Dance Chart at number 13 
and the UK Indie Chart at number 34. Keeno has also received airplay on BBC Radio 1 and 1Xtra drum and bass shows.
Keeno's second album, Futurist, was released on his 22nd birthday, 26 February 2016.[6] The album's first instant grat single, At Twilight, was released on 12 February 2016.
He released his third studio album, All The Shimmering Things, in November 2017."),
(2, "Mark van der Schoot (born 4 October 1990), known by his stage name Maduk, is a Dutch drum and bass music producer and DJ from Amsterdam. He has released music on Hospital Records, 
Liquicity Records, Viper Recordings as well as Monstercat and Fokuz Recordings.
 He released his first album Never Give Up at Hospital Records on 29 April 2016. Together with Maris Goudzwaard, he founded Liquicity"),
 (3, "Hailing from the south-west of the UK, drum & bass producer Fred V has elevated his trademark euphoria and melodic movements to new heights.
 Now exclusively signed to Hospital Records as a solo artist, he aspires to push the boundaries of the D+B landscape into new realms with his unique songwriting, 
 vocal skills and as a supremely talented multi-instrumentalist. With his shimmering big room steppers to heart-melting arpeggio melodies, Fred V draws inspiration from the likes of future-bass, electronica powerhouse Flume and the neo-soul stylings of Tom Misch.
 His accomplished songwriting abilities allow him to tread the delicate boundaries of D+B and the boundless realms of electronica."),
 (4, "Bristol based drum & bass producer Grafix has revitalized his solo career, signing exclusively to Hospital Records, and ready to take the drum & bass world by the horns.
 Previously famed for being one half of ‘Fred V & Grafix’, Josh Jackson has been at the forefront of the genre for over a decade with a trio of collaborative albums under his belt.
 Now after years of success, he’s taken a new direction embracing his revived identity as a solo artist.
 Widely respected for his clinical mixdowns and impeccable production skills, this sharp musical brain is poised for great things as he sets on his solo journey."),
 (5, "Edward discovered drum'n'bass during the late '90s but didn't release his first production until 2012.
 The first recording to bear his name was a Jakwob and Etherwood remix of Lana Del Rey's Video Games; he also played guitar as part of Jakwob's band. He made his proper debut that November,
 when he appeared on Hospital Records' Sick Music 3 compilation with Give It Up,
 an emotive track laced with multiple melodic keyboard lines. The similarly emotive Spoken was placed on Hospitality Drum & Bass 2013 in January 2013"),
 (6, "Med School proudly announces the latest addition to our talent-filled roster, 
 Whiney! Coventry-born Will Hine has developed an impressive skill set, successfully carving out his signature sound and passion for drum and bass.
With over twelve years spent in choirs, orchestras and grade eight achievements in both violin and piano,
 it was inevitable that music was going to play a prominent role in Will’s future. 
 After discovering a love for Pendulum and becoming inspired to delve into the world of music production, Whiney had his debut release on Subsphere Recordings back in 2012,
 an exquisite collaboration with Keeno called the “Sweetest Sin” EP.");

INSERT INTO Music (idArtist, title)
VALUES (5, "Beggin by letting go"), (1, "Piano only"), (5, "In Stillness"), (6, "Beggin by letting go"), (5,"A Hundred Oceans"), (5, "Fire Lit Sky"), (5, "Bears Breeches");

INSERT INTO Album
VALUES (3,1, '2017.01.01');

INSERT INTO Track 
VALUES (1, '2:43'), (2, '3:25'), (4, '3:43'), (5, '3:21'), (6, '3:21'), (7, '2:50');

INSERT INTO Genre
VALUES ("Drum and bass");

INSERT INTO Adaptation
VALUES ("Original"), ("Remix");

INSERT INTO Track_Genre
VALUES (1, "Drum and bass"), (2, "Drum and bass"), (4, "Drum and bass"), (5, "Drum and bass"), (6, "Drum and bass"), (7, "Drum and bass");

INSERT INTO Track_Adaptation(idTrack,adaptationName, releaseDate)
VALUES (4,"Remix", "2019.01.12");
INSERT INTO Track_Adaptation(idTrack, releaseDate)
VALUES (1, "2019.01.01"), (2,"2018.12.12");
INSERT INTO Track_Adaptation(idTrack, idAlbum, releaseDate)
VALUES (5, 3, "2019.10.09"), (6, 3, "2019.10.09"), (7, 3, "2019.10.09"); 

INSERT INTO LinkTrack(idTrack, link)
VALUES (1, "tracks/Beggin by letting go.mp3");
