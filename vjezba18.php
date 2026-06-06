<?php
$con = mysqli_connect("localhost", "root", "admin", "pwa");

// edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $id       = (int) $_POST['edit_id'];
    $name     = mysqli_real_escape_string($con, trim($_POST['name']));
    $lastname = mysqli_real_escape_string($con, trim($_POST['lastname']));
    $country  = (int) $_POST['country_id'];
    mysqli_query($con, "UPDATE users SET name='$name', lastname='$lastname', country_id=$country WHERE id=$id");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$query  = "SELECT u.id, u.name, u.lastname, c.name AS country_name
           FROM users u
           INNER JOIN countries c ON u.country_id = c.id
           ORDER BY c.name, u.lastname";
$result = mysqli_query($con, $query);
$users  = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

// dropdown
$cResult    = mysqli_query($con, "SELECT id, name FROM countries ORDER BY name");
$countries  = [];
while ($row = mysqli_fetch_assoc($cResult)) {
    $countries[] = $row;
}

// editirani korisnik
$editId = isset($_GET['edit']) ? (int) $_GET['edit'] : 0;

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Popis korisnika</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f5f6fa;
            min-height: 100vh;
            padding: 40px 20px;
            color: #222;
        }

        .container {
            max-width: 620px;
            margin: 0 auto;
        }

        h2 {
            font-size: 22px;
            font-weight: 700;
            color: #111;
            margin-bottom: 24px;
            padding-bottom: 10px;
            border-bottom: 2px solid #4caf50;
            display: inline-block;
        }

        ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* ── Normal row ── */
        li.user-row {
            background: #fff;
            border: 1px solid #e8e8e8;
            border-radius: 10px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: box-shadow .15s;
        }
        li.user-row:hover { box-shadow: 0 2px 8px rgba(0,0,0,.08); }

        .avatar {
            font-size: 20px;
            flex-shrink: 0;
        }
        .user-info { flex: 1; }
        .user-name { font-size: 15px; font-weight: 600; color: #111; }
        .user-country {
            font-size: 13px;
            color: #777;
            margin-top: 1px;
        }

        .btn-edit {
            background: none;
            border: 1px solid #4caf50;
            color: #4caf50;
            border-radius: 6px;
            padding: 5px 14px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            transition: background .15s, color .15s;
            white-space: nowrap;
        }
        .btn-edit:hover { background: #4caf50; color: #fff; }

        /* ── Edit row ── */
        li.edit-row {
            background: #fff;
            border: 2px solid #4caf50;
            border-radius: 10px;
            padding: 14px 16px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .edit-row form {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .edit-row input,
        .edit-row select {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 7px 10px;
            font-size: 14px;
            color: #111;
            background: #fafafa;
            outline: none;
            transition: border-color .15s;
        }
        .edit-row input { width: 140px; }
        .edit-row select { width: 160px; }
        .edit-row input:focus,
        .edit-row select:focus { border-color: #4caf50; }

        .btn-save {
            background: #4caf50;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 7px 18px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background .15s;
        }
        .btn-save:hover { background: #388e3c; }

        .btn-cancel {
            background: none;
            border: 1px solid #ccc;
            color: #666;
            border-radius: 6px;
            padding: 7px 14px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            transition: border-color .15s, color .15s;
        }
        .btn-cancel:hover { border-color: #999; color: #333; }

        .edit-label {
            font-size: 12px;
            color: #4caf50;
            font-weight: 600;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .empty { color: #999; font-size: 15px; padding: 20px 0; }
    </style>
</head>
<body>
<div class="container">
    <h2>Popis korisnika</h2>

    <ul>
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $user): ?>

                <?php if ($editId === (int)$user['id']): ?>

                    <li class="edit-row">
                        <span class="edit-label">✏️ Uređivanje korisnika</span>
                        <form method="POST">
                            <input type="hidden" name="edit_id" value="<?= $user['id'] ?>">

                            <input
                                type="text"
                                name="name"
                                value="<?= htmlspecialchars($user['name']) ?>"
                                placeholder="Ime"
                                required>

                            <input
                                type="text"
                                name="lastname"
                                value="<?= htmlspecialchars($user['lastname']) ?>"
                                placeholder="Prezime"
                                required>

                            <select name="country_id" required>
                                <?php foreach ($countries as $c): ?>
                                    <option
                                        value="<?= $c['id'] ?>"
                                        <?= $c['name'] === $user['country_name'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($c['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <button type="submit" class="btn-save">Spremi</button>
                            <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn-cancel">Odustani</a>
                        </form>
                    </li>

                <?php else: ?>
                    <li class="user-row">
                        <span class="avatar">👤</span>
                        <div class="user-info">
                            <div class="user-name">
                                <?= htmlspecialchars($user['name']) ?>
                                <?= htmlspecialchars($user['lastname']) ?>
                            </div>
                            <div class="user-country">
                                🌍 <?= htmlspecialchars($user['country_name']) ?>
                            </div>
                        </div>
                        <a href="?edit=<?= $user['id'] ?>" class="btn-edit">Uredi</a>
                    </li>
                <?php endif; ?>

            <?php endforeach; ?>
        <?php else: ?>
            <p class="empty">Nema korisnika u bazi.</p>
        <?php endif; ?>
    </ul>
</div>
</body>
</html>