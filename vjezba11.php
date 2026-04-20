<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vježba 11</title>
</head>
<body>

    <h2>Prosti brojevi manji od 100</h2>

    <?php
        function jeProst($broj) {
            if ($broj < 2) {
                return false;
            }

            for ($i = 2; $i <= sqrt($broj); $i++) {
                if ($broj % $i == 0) {
                    return false;   
                }
            }
            return true;           
        }


        $brojac = 0;
        for ($x = 2; $x < 100; $x++) {
            if (jeProst($x)) {
                echo "<span class='broj'> $x |</span>";
                $brojac++;
            }
        }

        echo "<p>Ukupno prostih brojeva manjih od 100: <b>$brojac</b></p>";
    ?>
        
</body>
</html>