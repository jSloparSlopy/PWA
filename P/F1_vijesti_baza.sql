CREATE DATABASE F1_vijesti;
USE F1_vijesti;

CREATE TABLE vijesti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naslov VARCHAR(120) NOT NULL,
    kategorija VARCHAR(64) NOT NULL,
    autor VARCHAR(100) DEFAULT 'Nepoznat autor',
    sazetak TEXT NOT NULL,
    tekst TEXT NOT NULL,
    slika VARCHAR(255),
    prikaz TINYINT(1) DEFAULT 1,
    datum VARCHAR(50)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE vijesti
MODIFY COLUMN datum DATE NOT NULL;