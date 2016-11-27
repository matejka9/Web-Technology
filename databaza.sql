CREATE DATABASE tutorial
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE tutorial;

DROP TABLE IF EXISTS stoly;
DROP TABLE IF EXISTS reservation;


CREATE TABLE stoly
(
  id INT(6) NOT NULL AUTO_INCREMENT,
  pocet integer,
  fajciarsky BOOLEAN,
  okno BOOLEAN,
  PRIMARY KEY (id)
);


CREATE TABLE reservation
(
  id INT(6) NOT NULL AUTO_INCREMENT,
  name VARCHAR(20),
  id_stol INT(6) NOT NULL,
  od TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  pocet INT,
  sitalone BOOLEAN,
  PRIMARY KEY (id),
  FOREIGN KEY (id_stol) REFERENCES stoly(id)
);

INSERT INTO stoly VALUES (1, 5, 1, 1), (2, 6, 0, 1), (3, 6, 0, 1), (4, 9, 0, 0);