<?php
    // početna boja, ako ništa nije odabrano
    $boja = "#000000";

    if (isset($_POST['posalji'])) {
        
        if (isset($_POST['promjena']) && isset($_POST['odabranaBoja'])) {
            $boja = $_POST['odabranaBoja'];
        }
    }
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Vjezba - promjena boje</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 30px;
            color: <?php echo htmlspecialchars($boja); ?>;
        }
        form {
            border: 1px solid #888;
            padding: 20px;
            width: 350px;
            border-radius: 5px;
        }
        .red { margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #ccc; }
        input[type="submit"] {
            background: #333; color: white; border: none;
            padding: 10px 20px; cursor: pointer; font-weight: bold;
        }
    </style>
</head>
<body>

<h2>Promjena boje teksta</h2>
<p>Ovaj tekst ce promijeniti boju ako oznacite checkbox i posaljete formu.</p>

<form method="POST" action="">
    <div class="red">
        <label for="odabranaBoja">Odaberite zeljenu boju:</label><br>
        <input type="color" name="odabranaBoja" id="odabranaBoja" value="#000000">
    </div>

    <div class="red">
        <p>Potvrdite zelite li promjeniti boju:</p>
        <input type="checkbox" name="promjena" id="promjena" value="da">
        <label for="promjena">Zelim promjeniti boju</label>
    </div>

    <input type="submit" name="posalji" value="PROMJENI BOJU">
</form>

<?php
    if (isset($_POST['posalji'])) {
        if (isset($_POST['promjena'])) {
            echo "<p>Boja teksta promijenjena u: <b>" . htmlspecialchars($boja) . "</b></p>";
        } else {
            echo "<p>Checkbox nije oznacen - boja nije promijenjena.</p>";
        }
    }
?>

</body>
</html>