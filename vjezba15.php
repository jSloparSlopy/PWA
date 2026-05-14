<?php
// Spajanje na bazu 
$con = mysqli_connect("localhost", "root", "admin", "pwa");

$results = [];
$searched = false;
$search = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $search   = $_POST['search'];
    $searched = true;

    if ($search !== '') {
        $query  = "SELECT * FROM users WHERE ime LIKE '%$search%' OR prezime LIKE '%$search%'";
        $result = mysqli_query($con, $query);

        while ($row = mysqli_fetch_array($result)) {
            $results[] = $row;
        }
    }
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Tražilica korisnika</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 700px;
            margin: 40px auto;
            padding: 0 20px;
            background: #f4f4f4;
        }
        h1 { color: #333; }
        form {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }
        input[type="text"] {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover { background: #0056b3; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        th {
            background: #007bff;
            color: white;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover { background: #f0f7ff; }
        .poruka {
            padding: 15px;
            border-radius: 4px;
            background: #fff3cd;
            border: 1px solid #ffc107;
            color: #856404;
        }
        .broj {
            color: #555;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h1>Tražilica korisnika</h1>

    <form method="POST" action="">
        <input
            type="text"
            name="search"
            placeholder="Upišite ime ili prezime..."
            value="<?php echo htmlspecialchars($search); ?>"
        >
        <button type="submit">Pretraži</button>
    </form>

    <?php if ($searched): ?>

        <?php if (!empty($results)): ?>

            <p class="broj">Pronađeno: <strong><?php echo count($results); ?></strong> korisnik(a)</p>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Username</th>
                    <th>Država</th>
                </tr>
                <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['ime']; ?></td>
                    <td><?php echo $row['prezime']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['country_code']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>

        <?php elseif ($search === ''): ?>
            <p class="poruka">Molimo unesite pojam za pretragu.</p>
        <?php else: ?>
            <p class="poruka">Nije pronađen nijedan korisnik za: <strong><?php echo htmlspecialchars($search); ?></strong></p>
        <?php endif; ?>

    <?php endif; ?>

</body>
</html>