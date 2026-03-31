<?php 
    $rezultat = '';
    $kOcjena = '';

    if(isset($_GET['k1']) && isset($_GET['k2'])){
        $rezultat = "Ocjena iz kolegija je ";
        $K1 = (int)$_GET['k1'];
        $K2 = (int)$_GET['k2'];
        
        $kOcjena = 1;
        if($K1 > 1 && $K2 > 1){
            $kOcjena = ceil(($K1 + $K2)/2);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vježba 7</title>
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
    </style>
</head>
<body>
    <strong>Izračun ocjene kolegija</strong>
    <form method="GET">
        <p>Kolokvij I. <input type="number" name="k1" min="1" max="5" 
                        value="<?= isset($_GET['k1']) ? (int)$_GET['k1'] : 1 ?>">
        </p>

        <p>Kolokvij II. <input type="number" name="k2" min="1" max="5" 
                        value="<?= isset($_GET['k2']) ? (int)$_GET['k2'] : 1 ?>">
        </p>

        <button type="submit">Izračunaj!</button>

        <p><?= $rezultat ?><strong><?= $kOcjena ?></strong></p>
    </form>
    
</body>
</html>