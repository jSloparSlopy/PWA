CREATE DATABASE vjezba_db;
USE vjezba_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    korisnicko_ime VARCHAR(50) UNIQUE NOT NULL,
    lozinka VARCHAR(255) NOT NULL,
    razina_dozvole INT DEFAULT 1
);