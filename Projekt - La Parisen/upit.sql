CREATE DATABASE leparisien CHARACTER SET utf8 COLLATE utf8_general_ci;

USE leparisien;

CREATE TABLE vijesti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    datum VARCHAR(32),
    naslov VARCHAR(64),
    sazetak TEXT,
    tekst TEXT,
    slika VARCHAR(64),
    kategorija VARCHAR(64),
    arhiva TINYINT(1)
);

CREATE TABLE korisnik (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(32),
    prezime VARCHAR(32),
    korisnicko_ime VARCHAR(32) UNIQUE,
    lozinka VARCHAR(255),
    razina TINYINT(1)
);

ALTER TABLE vijesti ADD autor_id INT;
ALTER TABLE vijesti ADD FOREIGN KEY (autor_id) REFERENCES korisnik(id);