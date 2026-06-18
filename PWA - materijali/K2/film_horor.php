<?php
    $konekcija = mysqli_connect("localhost", "admin", "654321", "film");
    $poruka = "";

    if(!$konekcija){
        $poruka = "Connection failed!";
    }else{

        $sql = "SELECT * FROM film
                WHERE jezik = 'engleski jezik' AND
                trajanje >= 90 AND trajanje <= 120";

        $rezultat = mysqli_query($konekcija, $sql);
        if(mysqli_num_rows($rezultat)>0){
            while($red = mysqli_fetch_assoc($rezultat)){
                $poruka .= "<table border='1'> <tr> <th>Naziv</th> <th>Žanr</th> <th>Trajanje</th>  </tr>";
                if($red['zanr'] == "horor"){
                    $poruka .= "<tr style='background-color: red'>";

                }

                $poruka .= "<td>" . $red['naziv'] . "</td>";
                $poruka .= "<td>" . $red['zanr'] . "</td>";
                $poruka .= "<td>" . $red['trajanje'] . "</td>";

                $poruka .= "</tr>";
            }

            $poruka .= "</table>";
        }else{
            $poruka = "Nema podataka! " .mysqli_error($konekcija); 
        }
    }

    mysqli_close($konekcija);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= $poruka; ?>
</body>
</html>