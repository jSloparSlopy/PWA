<?php
    $con = mysqli_connect("127.0.0.1:3307", "root", "admin", "test");
    $info = "";

    if(isset($_POST['prijava'])){
        if($con){

            $email = isset($_POST['e_mail_prijava']) ? trim(mysqli_real_escape_string($con, $_POST['e_mail_prijava'])) : '';
            $JMBAG = isset($_POST['JMBAG_prijava'])  ? trim(mysqli_real_escape_string($con, $_POST['JMBAG_prijava'])) : '';

            if(!filter_var($email, FILTER_VALIDATE_EMAIL) || !is_numeric($JMBAG) || strlen($JMBAG) != 10){
                $info = "Potrebno ispravno unijeti podatke prijave!";
                
            }else{
                $sql = "SELECT * FROM student
                    WHERE e_mail = '$email' AND JMBAG = '$JMBAG'";

                $rezultat = mysqli_query($con, $sql);
                if(mysqli_num_rows($rezultat)){
                    $r = mysqli_fetch_assoc($rezultat);
                    $info = "Dobrodošli, " . $r['ime_student'] . "!";

                }else{
                    $info = "Greška unosa u bazu!";
                }
            }

        }else{
            $info = "Greška spajanja!";
        }

    }else{
        $info="";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
</head>
<body>
    <form action="prijava.php" method="POST">

        <label for="e_mail_prijava">E-mail</label><br>
        <input type="email" name="e_mail_prijava" required>
        <br>
        <label for="JMBAG_prijava">JMBAG</label><br>
        <input type="number" name="JMBAG_prijava" required>
        <br>
        <input type="submit" name="prijava" value="PRIJAVI SE!">
    </form>
    
</body>
</html>