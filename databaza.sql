
DROP TABLE IF EXISTS 'stoly';
DROP TABLE IF EXISTS 'reservation';


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
  id serial,
  name VARCHAR(20),
  FOREIGN KEY (stol_id) REFERENCES stoly(id),
  od TIMESTAMP DEFAULT 0,
  do TIMESTAMP DEFAULT 0
  pocet INT,
  sitalone BOOLEAN
);

