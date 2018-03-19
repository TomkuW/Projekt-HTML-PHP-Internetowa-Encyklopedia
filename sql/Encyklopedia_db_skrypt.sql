DROP DATABASE IF EXISTS encyklopedia_db;
CREATE DATABASE encyklopedia_db;
USE encyklopedia_db;

CREATE TABLE uzytkownik (
  `uzytkownik_id` int(100) NOT NULL AUTO_INCREMENT,
  `imie` varchar(45) NOT NULL,
  `nazwisko` varchar(60) NOT NULL,
  `miasto` varchar(45) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  PRIMARY KEY (`uzytkownik_id`)
  )
  ENGINE = InnoDB COLLATE=utf8_polish_ci;
  COMMIT;
   
  CREATE TABLE kategoria (
  `kategoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(40) NOT NULL,
  `opis` varchar(300) NOT NULL,
  PRIMARY KEY (`kategoria_id`)
  )
  ENGINE = InnoDB COLLATE=utf8_polish_ci;
COMMIT;

CREATE TABLE kompedium (
  `kompedium_id` int(10) NOT NULL AUTO_INCREMENT,
  `uzytkownik_id` int(10) NOT NULL,
  `kategoria_id` int(10) NOT NULL,
  `fraza` varchar(75) NOT NULL,
  `tresc` varchar(600) NOT NULL,
  `data_dodania` date NOT NULL,
  PRIMARY KEY (`kompedium_id`),
  KEY `fk_kompedium_uzytkownik1_idx` (`uzytkownik_id`),
  KEY `fk_kompedium_kategoria1_idx` (`kategoria_id`),
  CONSTRAINT `fk_kompedium_uzytkownik1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownik` (`uzytkownik_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_kompedium_kategoria1` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoria` (`kategoria_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
  )
  ENGINE = InnoDB COLLATE=utf8_polish_ci;
  COMMIT;
  
-- Konto administratora
INSERT INTO uzytkownik (uzytkownik_id, imie, nazwisko, miasto, login, password, email)
VALUES(null,'Tomasz','Waberski','Sokolow','admin','admin','wabtomek@gmail.com');
  
