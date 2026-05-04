<?php
    function napraviTablicu($redaka, $kolona) {
        echo "<table border='1' cellpadding='15' cellspacing='0'>";
        for ($i = 0; $i < $redaka; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $kolona; $j++) {
                echo "<td></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Vjezba - HTML tablica</title>
    <style>
        body {font-family: sans-serif; padding: 30px; }
        form { background: #fff; color: #000; padding: 20px; width: 350px; border-radius: 5px; }
        .red { margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #6b2c5f; }
        input[type="number"] { width: 100%; padding: 8px; font-size: 14px; }
        input[type="submit"] {
            background: #333; color: white; border: none;
            padding: 10px 20px; cursor: pointer; font-weight: bold;
        }
        table { background: #fff; color: #000; margin-top: 15px; }
    </style>
</head>
<body>

    <h2>Funkcija za ispis HTML tablice</h2>

    <form method="POST" action="">
        <div class="red">
            <label for="redaka">Upisite broj redaka</label><br>
            <input type="number" name="redaka" id="redaka" min="1" max="50" required>
        </div>
        <div class="red">
            <label for="kolona">Upisite broj kolona</label><br>
            <input type="number" name="kolona" id="kolona" min="1" max="50" required>
        </div>
        <input type="submit" name="posalji" value="NAPRAVI TABLICU">
    </form>

    <?php
        if (isset($_POST['posalji']) && isset($_POST['redaka']) && isset($_POST['kolona'])) {
            $redaka = (int)$_POST['redaka'];
            $kolona = (int)$_POST['kolona'];

            if ($redaka > 0 && $kolona > 0) {
                echo "<p>Ispis tablice:</p>";
                napraviTablicu($redaka, $kolona);
            } else {
                echo "<p>Unesite pozitivne brojeve!</p>";
            }
        }
    ?>

</body>
</html>