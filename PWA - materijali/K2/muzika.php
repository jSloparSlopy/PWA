<?php
    $konekcija = mysqli_connect("localhost", "admin", "admin654", "pjesma");
    $poruka = "";

    if(!$konekcija){
        $poruka = "Greška spajanja!" . mysqli_connect_error();
    }else{

        $sql = "SELECT * FROM pjesma
                WHERE jezik = 'engleski jezik' AND
                izvodac LIKE 'j%' AND
                trajanje < 120";
        
        $rezultat = mysqli_query($konekcija,$sql);
        if(mysqli_num_rows($rezultat)>0){
            $poruka .= "<table border='1'> <tr> <th>Naziv</th> <th>Izvodac</th> <th>Trajanje</th> </tr>";

            while($red = mysqli_fetch_assoc($rezultat)){
                if($red['spol'] == "Muško"){
                    $poruka .= "<tr style='background-color: blue'>";
                }
                elseif($red['spol'] == "Ženski"){
                     $poruka .= "<tr style='background-color: red'>";
                }


                $poruka .= "<td>" . $red['naziv'] . "</td>";
                $poruka .= "<td>" . $red['izvodac'] . "</td>";
                $poruka .= "<td>" . $red['trajanje'] . "</td>";

                $poruka .= "</tr>";
            }

            $poruka .= "</table>";
        }else{
            $poruka = "Nema podataka!" . mysqli_error($konekcija);
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