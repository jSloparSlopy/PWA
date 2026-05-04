<?php
$grupa = isset($_GET['grupa']) ? $_GET['grupa'] : '';
$poruka = "";

switch ($grupa) {
    case "grupa01":
        $poruka = "Odabrali ste grupu 1.";
        break;
    case "grupa02":
        $poruka = "Odabrali ste grupu 2.";
        break;
    case "grupa03":
        $poruka = "Odabrali ste grupu 3.";
        break;
    default:
        $poruka = "Nepoznat odabir.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labos 1 - 20 </title>
</head>
<body>

    <h2>Odaberite grupu</h2>

    <form method="GET">
        <select name="grupa">
            <option value="">Odaberite</option>
            <option value="grupa01" <?= $grupa === 'grupa01' ? 'selected' : '' ?>>grupa01</option>
            <option value="grupa02" <?= $grupa === 'grupa02' ? 'selected' : '' ?>>grupa02</option>
            <option value="grupa03" <?= $grupa === 'grupa03' ? 'selected' : '' ?>>grupa02</option>
        </select>
        <button type="submit">Potvrdi</button>
    </form>

    
    <p><strong><?= htmlspecialchars($poruka) ?></strong></p>
    

</body>
</html>