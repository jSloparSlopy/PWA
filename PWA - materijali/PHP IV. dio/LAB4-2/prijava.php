<?php
session_start();

$conn = new PDO("mysql:host=localhost;dbname=vjezba_db;charset=utf8", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE korisnicko_ime = ?");
    $stmt->execute([$korisnicko_ime]);
    $korisnik = $stmt->fetch();

    if ($korisnik && password_verify($lozinka, $korisnik['lozinka'])) {
        $_SESSION['korisnicko_ime'] = $korisnik['korisnicko_ime'];
        $_SESSION['razina_dozvole'] = $korisnik['razina_dozvole'];

        if ($korisnik['razina_dozvole'] == 1) {
            echo "Dobro došli. Vaša razina je administrator. <a href='stranica.php'>NEXT</a>";
        } else {
            echo "Dobro došli. <a href='stranica.php'>NEXT</a>";
        }
    } else {
        echo "Pogrešno korisničko ime ili lozinka!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Prijava</title>
</head>
<body>
    <h2>Prijava</h2>
    <form action="prijava.php" method="POST">
        <label>Korisničko ime:</label>
        <input type="text" name="korisnicko_ime" required><br><br>
        <label>Lozinka:</label>
        <input type="password" name="lozinka" required><br><br>
        <button type="submit">Prijavi se</button>
    </form>
</body>
</html>