<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vježba 8</title>
</head>
<body>

<form method="POST" action="">
    <p>Označi vozilo:</p>
    <ul>
    <?php
        $polje = array("Audi", "BMW", "Renault", "Citroen");
        foreach ($polje as $model) {
            echo "<label><input type='radio' name='vozilo' value='$model'> $model</label><br>";
        }
    ?>
    </ul>
    <input type="submit" name="posalji" value="POŠALJI">
</form>

<?php
    if (isset($_POST['posalji'])) {
        if (isset($_POST['vozilo'])) {
            echo "<h4>Izabrani model: " . htmlspecialchars($_POST['vozilo']) . "</h4>";
        } else {
            echo "<h4>Nije odabran niti jedan model!</h4>";
        }
    }
?>

</body>
</html>