<?php
    $poruka = "";
    $konekcija = mysqli_connect("localhost", "root", "admin", "tablica");

    if(isset($_POST['registriraj'])){
        if(!$konekcija){
            $poruka = "Krivi podaci spajanja...";
        }else{

            $ime_student = isset($_POST['ime_student'])         ? trim(mysqli_real_escape_string($konekcija, $_POST['ime_student'])) : '';
            $prezime_student = isset($_POST['prezime_student']) ? trim(mysqli_real_escape_string($konekcija, $_POST['prezime_student'])) : '';
            $JMBAG = isset($_POST['JMBAG'])                     ? trim(mysqli_real_escape_string($konekcija, $_POST['JMBAG'])) : '';
            $e_mail = isset($_POST['e_mail'])                   ? trim(mysqli_real_escape_string($konekcija, $_POST['e_mail'])) : '';

            if(empty($ime_student) || empty($prezime_student) || empty($JMBAG) || empty($e_mail)){
                $poruka .= "Sva polja moraju biti popounjena!";
            }

            if(strlen($JMBAG) != 10 || !is_numeric($JMBAG)){
                $poruka .= "JMBAG ima TOČNO 10 brojeva!";
            }

            if(!filter_var($e_mail, FILTER_VALIDATE_EMAIL)){
                $poruka .= "E-mail nije ispravnog formata!";
            }

            else{
                $sql = "INSERT INTO tablica(ime_student, prezime_student, JMBAG, e_mail)
                        VALUES('$ime_student', '$prezime_student', '$JMBAG', '$e_mail')";
                
                if(mysqli_query($konekcija, $sql)){
                    $poruka = "Podaci uneseni!";
                }else{

                    $poruka = "Greška tokom unosa!";
                }
            }
        }
    }

    mysqli_close($konekcija);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
        <style>
            body{
                margin: 30px;
                font-family: Arial, sans-serif;
            }
    </style>
</head>
<body>
    <form action="registracija.php">

        <label for="ime_student">Ime</label><br>
        <input type="text" name="ime_student" required>
        <br>
        <label for="prezime_student">Prezime</label><br>
        <input type="text" name="prezime_student" required>
        <br>
        <label for="JMBAG">JMBAG</label><br>
        <input type="number" name="JMBAG" required>
        <br>
        <label for="e_mail">E-mail</label><br>
        <input type="email" name="e_mail" required>
        <br>
        <input type="submit" name="registriraj" value="REGISTRIRAJ SE!">
    </form>

    <div>
        <?= $poruka ?>
    </div>
</body>
</html>