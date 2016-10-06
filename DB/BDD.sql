-- ----------------------------------------------
--BDD 
-- ----------------------------------------------

CREATE DATABASE IF NOT EXISTS CDP_BDD;
USE CDP_BDD;

-- ----------------------------------------------
-- Création de table
-- ----------------------------------------------
	-- User
CREATE TABLE users(			
	login VARCHAR(15) NOT NULL,			
	passwd VARCHAR(32) NOT NULL,			
	rang ENUM('admin','animateur','enseignant','redacteur'),			
PRIMARY KEY(LOGIN));

	-- Laboratoire

CREATE TABLE laboratoires(
	id INT NOT NULL AUTO_INCREMENT,
	nom VARCHAR(255) NOT NULL,
	lieu VARCHAR(255) NOT NULL,
PRIMARY KEY(id));

	-- Ateliers
CREATE TABLE ateliers(			
	id INT NOT NULL AUTO_INCREMENT,			
	titre VARCHAR(255) NOT NULL,
	theme VARCHAR(255)NOT NULL,
	typeAtel VARCHAR(255) NOT NULL,		
	laboratoire INT NOT NULL,
	lieu VARCHAR(255)NOT NULL,
	duree INT NOT NULL,
	CAPACITE INT NOT NULL,
	horaire DATETIME NOT NULL,			
PRIMARY KEY(id),
FOREIGN KEY(laboratoire) REFERENCES laboratoires(id));	

	-- Inscription Atelier
CREATE TABLE insc_atel(			
	login VARCHAR(15) NOT NULL,			
	id INT NOT NULL,			
PRIMARY KEY(login,id),			
FOREIGN KEY(login) REFERENCES users(login),			
FOREIGN KEY(id) REFERENCES ateliers(id)			
);			

-- ----------------------------------------------
-- Peuplement de la table
-- ----------------------------------------------
INSERT INTO users VALUES('admin','admin','admin');
INSERT INTO users VALUES('user','user','animateur');

INSERT INTO laboratoires  VALUES (NULL, 'CNRS', 'Bordeaux');
INSERT INTO laboratoires  VALUES (NULL, 'INRIA', 'Bordeaux');

INSERT INTO ateliers VALUES (NULL, 'Conférence sur les Design Pattern ', 'Developpement', 'Atelier Scientifique', '1', 'Labri salle 203', '30', '100',  '2016-10-03 10:30:00');
INSERT INTO ateliers VALUES (NULL, 'Conférence Système d''exploitation', 'Systeme', 'Atelier Scientifique', '1', 'Labri salle 14', '30', '100',  '2016-10-03 10:30:00');
INSERT INTO ateliers VALUES (NULL, 'Conference sur Java', 'Developpement', 'Atelier Scientifique', '2', 'Labri salle 31', '30', '100', '2016-10-04 10:00:00');
