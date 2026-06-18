<?php
    $konekcija = mysqli_connect("localhost", "admin", "654321", "Movies");
    $poruka = "";

    if(!$konekcija){
        $poruka = "Connection failed";
    }else{

        $sql_filmovi = "SELECT naziv, zanr, trajanje FROM film
                        WHERE jezik LIKE 'enegleski%' AND 
                        trajanje >= 90 AND trajanje <= 120";
        
        $rezultat = mysqli_query($konekcija, $sql_filmovi);

        if(mysqli_num_rows($rezultat)>0){
            $puruka .= "<table> <th>Naziv</th> <th>Žanr</th> <th>Trajanje</th";
            while($red = mysqli_fetch_assoc($rezultat)){

                if(strtolower($red['zanr']) == "horor"){
                    $poruka .= "<tr style='color:red;>'";
                } else{
                    $poruka .= "<tr style='color:green;'";
                }

                $poruka .= "<td>" . $red['naziv'] . "</td>";
                $poruka .= "<td>" . $red['zanr'] . "</td>";
                $poruka .= "<td>" . $red['trajanje'] . "</td>";

                $poruka .= "</tr>";
            }

            $poruka .= "</table>";
        }else{
            $poruka = "Greška prilikom dohvata!";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmovi</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            margin: 30px;
        }
    </style>
</head>
<body>
    
    <?= $poruka; ?>
</body>
</html>