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
    username VARCHAR(30) UNIQUE,
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
	adaptationName VARCHAR(20) PRIMARY KEY DEFAULT 'Original'
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
    adaptationName VARCHAR(20),
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
 

INSERT INTO Band
VALUES (3, "Fred V & Grafix"), (4, "Fred V & Grafix");

INSERT INTO Band_Solo (id, dateEntry)
VALUES (3, '2009.01.01'), (4, '2009.01.01');

INSERT INTO Music (idArtist, title)
VALUES (5, "Beggin by letting go"), (2, "Piano only"), (5, "In Stillness"), (6, "Begging by letting go (Remix)");
 
INSERT INTO Album
VALUES (3, '2015.01.01');

INSERT INTO Artist_Album
VALUES (5, 3);

INSERT INTO Track 
VALUES (1, '2:00'), (2, '3:00'), (4, '3:00');

INSERT INTO Genre
VALUES ("Drum'n bass");

INSERT INTO Adaptation
VALUES ("Remix");

INSERT INTO Track_Genre
VALUES (1, "Drum'n bass"), (2, "Drum'n bass"), (4, "Drum'n bass");

INSERT INTO Track_Adaptation(idTrack, adaptationName, releaseDate)
VALUES (4, "Remix", "2019.01.01");
INSERT INTO Track_Adaptation(idTrack, releaseDate)
VALUES (1, "2019.01.01"), (2, "2018.12.12");

INSERT INTO LinkTrack(idTrack, link)
VALUES (1, "tracks\Beggin by letting go.mp3");



