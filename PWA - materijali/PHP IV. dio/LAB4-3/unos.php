<?php
$conn = new PDO("mysql:host=localhost;dbname=vjezba_db;charset=utf8", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$ime = $_POST['ime'];
$prezime = $_POST['prezime'];
$grad = $_POST['grad'];
$postanski_broj = $_POST['postanski_broj'];

// Zaštita od SQL injection pomoću prepared statement
$stmt = $conn->prepare("INSERT INTO osobe (ime, prezime, grad, postanski_broj) VALUES (?, ?, ?, ?)");
$stmt->execute([$ime, $prezime, $grad, $postanski_broj]);

echo "Podaci su uspješno uneseni!";
?>