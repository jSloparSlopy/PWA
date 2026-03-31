<?php 
    $rezultat = '';

    if(isset($_GET['operacija']) && isset($_GET['broj1']) && isset($_GET['broj2'])){
        $prvi    = (float)$_GET['broj1'];
        $drugi   = (float)$_GET['broj2'];
        $op      = $_GET['operacija'];

        switch($op){
            case '+':
                $rezultat = $prvi . " + " . $drugi . " = " . ($prvi + $drugi);
                break;
            case '-':
                $rezultat = $prvi . " - " . $drugi . " = " . ($prvi - $drugi);
                break;
            case '*':
                $rezultat = $prvi . " * " . $drugi . " = " . ($prvi * $drugi);
                break;
            case '/':
                if($drugi == 0){
                    $rezultat = "Ne može se dijeliti s nulom!";
                } else {
                    $rezultat = $prvi . " / " . $drugi . " = " . ($prvi / $drugi);
                }
                break;
        }
    }
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vježba 6</title>
    <style>
        * { font-family: Arial, sans-serif; }
        div button { padding: 5px 10px; }
    </style>
</head>
<body>
    <p>Kalkulator (Switch naredba)</p>
    <form method="GET">
        <p>
            <strong>Upiši prvi broj *</strong>
            <input type="number" name="broj1" value="<?= isset($_GET['broj1']) ? $_GET['broj1'] : '' ?>">
        </p>
        <p>
            <strong>Upiši drugi broj *</strong>
            <input type="number" name="broj2" value="<?= isset($_GET['broj2']) ? $_GET['broj2'] : '' ?>">
        </p>
        <p>Rezultat: <strong><?= $rezultat ?></strong></p>
        <div>
            <button type="submit" name="operacija" value="+">+</button>
            <button type="submit" name="operacija" value="-">-</button>
            <button type="submit" name="operacija" value="*">*</button>
            <button type="submit" name="operacija" value="/">/</button>
        </div>
    </form>
</body>
</html>