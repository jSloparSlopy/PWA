<?php 
    $klasa = '';
    $poruka = '';
    $tekst = 'Probaj pogoditi!';

    if(isset($_GET['unos'])){

        $randomBroj = rand(1,9);
        $unos       = (int)$_GET['unos'];

        if($unos === $randomBroj){
            $klasa = 'tocno';
            $tekst = 'Pogodak, probaj ponovo!';
            $poruka = "Zamišljeni broj je " . $randomBroj;
        } else {
            $klasa  = 'netocno';
            $tekst = 'Krivo, probaj ponovo!';
            $poruka = "Zamišljeni broj je " . $randomBroj;
        }
    }
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vježba 5</title>
    <style>
    *{
        font-family: Arial, sans-serif;
    }
    button {
      padding: 8px 20px;
      font-size: 16px;
      cursor: pointer;
      background-color: #e0e0e0;
      border: none;
      border-radius: 6px;
    }
    .tocno   { background-color: green; color: white; }
    .netocno { background-color: red;   color: white; }
    </style>
</head>
<body>
    <p>Igra (pogodi broj)</p>
    <form method="GET">
        <label>Upiši jedan broj od 1 do 9*
            <input name="unos" type="number" min="1" max="9" 
                   value="<?= isset($_GET['unos']) ? (int)$_GET['unos'] : 1 ?>">
        </label>
        <br><br>
        <button type="submit" class="<?= $klasa ?>"> <?= $tekst ?> </button>
    </form>
    <p><?= $poruka ?></p>
</body>
</html>