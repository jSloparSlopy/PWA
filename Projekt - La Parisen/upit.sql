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