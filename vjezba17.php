<?php
$con = mysqli_connect("localhost", "root", "admin", "pwa");

$query  = "SELECT u.name, u.lastname, c.name AS country_name
           FROM users u
           INNER JOIN countries c ON u.country_id = c.id
           ORDER BY c.name, u.lastname";

$result = mysqli_query($con, $query);

$users = [];
while ($row = mysqli_fetch_array($result)) {
    $users[] = $row;
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Popis korisnika</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 40px auto;
            padding: 0 20px;
            background: #fff;
        }

        h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #111;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 0;
            font-size: 15px;
            color: #333;
            border-bottom: 1px solid #f0f0f0;
        }

        li::before {
            content: "👤";
            font-size: 14px;
        }

        .lastname {
            color: #4caf50;
            font-weight: 600;
        }

        .country {
            color: #333;
            font-weight: normal;
        }
    </style>
</head>
<body>

    <h2>Popis korisnika</h2>

    <ul>
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>
                <li>
                    <?php echo htmlspecialchars($user['name']); ?>
                    <span class="lastname"><?php echo htmlspecialchars($user['lastname']); ?></span>
                    <span class="country">(<?php echo htmlspecialchars($user['country_name']); ?>)</span>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Nema korisnika u bazi.</li>
        <?php endif; ?>
    </ul>

</body>
</html>