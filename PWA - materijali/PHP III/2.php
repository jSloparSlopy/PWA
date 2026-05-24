<?php


$host      = "localhost";
$username  = "root";
$password  = "admin";
$ime_baze  = "korisnici_db";


$conn = mysqli_connect($host, $username, $password, $ime_baze);

if (!$conn) {
    die("Konekcija nije uspjela: " . mysqli_connect_error());
}


$sql       = "SELECT id, ime, prezime, spol, telefon, email, godine, hobi FROM korisnik";
$rezultat  = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Prikaz korisnika</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 12px;
        }
        th {
            background-color: #ffffff;
        }
        .muski {
            background-color: blue;
            color: white;
        }
        .zenski {
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>

<table>
    <thead>
        <tr>
            <th>id</th>
            <th>ime</th>
            <th>prezime</th>
            <th>spol</th>
            <th>telefon</th>
            <th>email</th>
            <th>godine</th>
            <th>hobi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($red = mysqli_fetch_assoc($rezultat)): ?>
            <?php
                
                if ($red["spol"] === "M") {
                    $boja = "muski";
                } else {
                    $boja = "zenski";
                }
            ?>
            <tr class="<?= $boja ?>">
                <td><?= htmlspecialchars($red["id"])      ?></td>
                <td><?= htmlspecialchars($red["ime"])     ?></td>
                <td><?= htmlspecialchars($red["prezime"]) ?></td>
                <td><?= htmlspecialchars($red["spol"])    ?></td>
                <td><?= htmlspecialchars($red["telefon"]) ?></td>
                <td><?= htmlspecialchars($red["email"])   ?></td>
                <td><?= htmlspecialchars($red["godine"])  ?></td>
                <td><?= htmlspecialchars($red["hobi"])    ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>

<?php
mysqli_close($conn);
?>