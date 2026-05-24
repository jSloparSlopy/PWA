<?php

// ─── Postavke konekcije na bazu ───────────────────────────────────────────────
$host      = "localhost";
$username  = "root";
$password  = "admin";
$ime_baze  = "studenti_db";

// ─── init poruke ───────────────────────────────────────────────────
$poruka       = "";
$poruka_klasa = "";

// ─── POST zahtjev ──────────────────────────────────────────────
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $conn = mysqli_connect($host, $username, $password, $ime_baze);

    
    if (!$conn) {
        $poruka       = "Konekcija na bazu nije uspjela: " . mysqli_connect_error();
        $poruka_klasa = "greska";
    } else {

        
        $ime     = trim(mysqli_real_escape_string($conn, $_POST["ime"]));
        $prezime = trim(mysqli_real_escape_string($conn, $_POST["prezime"]));
        $jmbag   = trim(mysqli_real_escape_string($conn, $_POST["jmbag"]));
        $mail    = trim(mysqli_real_escape_string($conn, $_POST["mail"]));

        
        if (empty($ime) || empty($prezime) || empty($jmbag) || empty($mail)) {
            $poruka       = "Sva polja su obavezna.";
            $poruka_klasa = "upozorenje";
        } elseif (!is_numeric($jmbag) || strlen($jmbag) > 10) {
            $poruka       = "JMBAG mora biti broj s najviše 10 znamenki.";
            $poruka_klasa = "upozorenje";
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $poruka       = "E-mail adresa nije u ispravnom formatu.";
            $poruka_klasa = "upozorenje";
        } else {
            
            $sql = "INSERT INTO Student (ime_studenta, prezime_studenta, JMBAG, e_mail)
                    VALUES ('$ime', '$prezime', '$jmbag', '$mail')";

            if (mysqli_query($conn, $sql)) {
                $poruka       = "Podaci su uspješno spremljeni u bazu!";
                $poruka_klasa = "uspjeh";
            } else {
                $poruka       = "Greška pri unosu: " . mysqli_error($conn);
                $poruka_klasa = "greska";
            }
        }

        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Page Title</title>
</head>
<body>

    <?php if (!empty($poruka)): ?>
        <p class="<?= $poruka_klasa ?>">
            <?= $poruka ?>
        </p>
    <?php endif; ?>

    <form method="POST" action="student_forma.php">

        <label for="ime">Ime</label>
        <br />
        <input name="ime" type="text" required
               value="<?= isset($_POST['ime']) ? htmlspecialchars($_POST['ime']) : '' ?>"/>
        <br />

        <label for="prezime">Prezime</label>
        <br />
        <input name="prezime" type="text" required
               value="<?= isset($_POST['prezime']) ? htmlspecialchars($_POST['prezime']) : '' ?>"/>
        <br />

        <label for="jmbag">JMBAG</label>
        <br />
        <input name="jmbag" type="number" required
               value="<?= isset($_POST['jmbag']) ? htmlspecialchars($_POST['jmbag']) : '' ?>"/>
        <br />

        <label for="mail">E-mail</label>
        <br />
        <input name="mail" type="email" required
               value="<?= isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : '' ?>"/>
        <br />

        <input name="submit" type="submit" value="Pošalji" />

    </form>

</body>
</html>