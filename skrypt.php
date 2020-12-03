
CREATE DATABASE zoo;
CREATE TABLE ssaki (
					Id int NOT NULL AUTO_INCREMENT,
					nazwa varchar(30) NOT NULL,
					waga float NOT NULL,
					srodowisko varchar(30) NOT NULL,
					kraj_pochodzenia varchar(30) NOT NULL,
					zdjencie varchar(255),
					PRIMARY KEY (Id)
					); 

INSERT INTO ssaki(nazwa,waga,srodowisko,kraj_pochodzenia) VALUES 
("jeż",200,"lądowe","Polska"),
("kret",2,"lądowe","Polska"),
("ryjówka górska",1,"lądowe","Polska"),
("podkowiec mały",0.5,"lądowe","Polska"),
("nocek rudy",0.2,"lądowe","Polska"),
("wilk szary",20,"lądowe","Polska")



