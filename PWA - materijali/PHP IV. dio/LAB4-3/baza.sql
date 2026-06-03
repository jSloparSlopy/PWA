USE vjezba_db;

CREATE TABLE osobe (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(50) NOT NULL,
    prezime VARCHAR(50) NOT NULL,
    grad VARCHAR(50) NOT NULL,
    postanski_broj INT NOT NULL
);