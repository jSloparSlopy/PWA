<?php
    $poruka = "";
    $konekcija = mysqli_connect("localhost", "root", "admin", "korisnik");

    if(isset($_POST['posalji'])){

        if(!$konekcija){
            $poruka = "Greška konekcije! ". mysqli_connect_error();
        }else{

            $ime = isset($_POST['ime']) ? trim($_POST['ime']) : '';
            $kor_ime = isset($_POST['kor_ime']) ? trim($_POST['kor_ime']) : '';
            $lozinka = isset($_POST['lozinka']) ? trim($_POST['lozinka']) : '';
            $lozinka_hash = password_hash($lozinka, PASSWORD_DEFAULT);

            $sql_provjera = "SELECT * FROM korisnik WHERE kor_ime = ?";
            $stmnt = mysqli_stmt_init($konekcija);

            if(mysqli_stmt_prepare($stmnt, $sql_provjera)){
                mysqli_stmt_bind_param($stmnt, 's', $kor_ime);
                mysqli_stmt_execute($stmnt);
                mysqli_stmt_store_result($stmnt);

                if(mysqli_stmt_num_rows($stmnt) > 0){
                    $poruka = "Korisnik već postoji!";
                    mysqli_stmt_close($stmnt);
                }else{
                    mysqli_stmt_close($stmnt);

                    $sql = "INSERT INTO korisnik(ime, kor_ime, lozinka) VALUES(?, ?, ?)";
                    $stmnt2 = mysqli_stmt_init($konekcija);

                    if(mysqli_stmt_prepare($stmnt2, $sql)){
                        mysqli_stmt_bind_param($stmnt2, 'sss', $ime, $kor_ime, $lozinka_hash);

                        if(mysqli_stmt_execute($stmnt2)){
                            $poruka = "Uspješno dodan novi korisnik!";
                        }else{
                            $poruka = "Neuspjesno dodavanje...!";
                        }

                        mysqli_stmt_close($stmnt2);
                    }
                }
            }
        }   
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            margin: 30px;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>

    <form action="korisnik_insert.php" method="POST">
        <label for="ime">Ime</label><br />
        <input type="text" name="ime"/> <br />
        <label for="kor_ime">korisničko ime</label><br />
        <input type="text" name="kor_ime"/> <br />
        <label for="lozinka">Lozinka</label><br />
        <input type="password" name="lozinka"/> <br />
        <button type="submit" name="posalji" value="Submit">Submit</button>
    </form>

    <div><?= $poruka; ?></div>
    
</body>

</html>