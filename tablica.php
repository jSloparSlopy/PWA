<?php
    $con = mysqli_connect("127.0.0.1:3307", "root", "admin", "korisnik");
    $info = "";
    $ispis = "<table><tr> <th>id</th> <th>ime</th> <th>prezime</th> <th>spol</th> <th>email</th> <th>godina</th> <th>hobi</th> </tr>";
    $boja = "";

    $sql = "SELECT * FROM korisnik";
    $rezultat = mysqli_query($con, $sql);     
    if(mysqli_num_rows($rezultat)>0){

        while($redak = mysqli_fetch_array($rezultat)){
            if($redak['spol'] == "M") $boja = "blue";
            else $boja = "red";
            $ispis .= "<tr style='$boja;'>";

            for($i=0; $i<8; $i++){
                $ispis .= "<td>" . $redak[$i] . "</td>";
            }

            $ispis .= "</tr>";
        }

        // ili bez petlje 

        /*
        while($redak = mysqli_fetch_assoc($rezultat)){
            if($redak['spol'] == "M") $boja = "blue";
            else $boja = "red";
            
            $ispis .= "<tr style='color: $boja;'>
                        <td>" . $redak['id'] . "</td>
                        <td>" . $redak['ime'] . "</td>
                        <td>" . $redak['prezime'] . "</td>
                        <td>" . $redak['spol'] . "</td>
                        <td>" . $redak['email'] . "</td>
                        <td>" . $redak['godina'] . "</td>
                        <td>" . $redak['hobi'] . "</td>
                    </tr>";
        }*/

    }else{
        $info = "Greška redaka...";
    }

    $ispis .= "</table>";
    mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <?= $ispis; ?>
    </div>
</body>
</html>