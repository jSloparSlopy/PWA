<?php
$conn = new PDO("mysql:host=localhost;dbname=vjezba_db;charset=utf8", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$korisnicko_ime = $_POST['korisnicko_ime'];
$lozinka = $_POST['lozinka'];

// postoji li korisničko ime
$stmt = $conn->prepare("SELECT id FROM users WHERE korisnicko_ime = ?");
$stmt->execute([$korisnicko_ime]);

if ($stmt->rowCount() > 0) {
    echo "Korisničko ime se već koristi";
} else {
    $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
    $insert = $conn->prepare("INSERT INTO users (korisnicko_ime, lozinka, razina_dozvole) VALUES (?, ?, ?)");
    $insert->execute([$korisnicko_ime, $hashed_password, 1]);
    echo "Registracija je uspješna";
}
?>