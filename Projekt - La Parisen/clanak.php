<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Parisien</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
</head>
<body>
    <header>
        <div id="logo">
            <a href="index.php">Le Parisien</a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="kategorija.php?kategorija=parisien">PARISIEN</a></li>
                <li><a href="kategorija.php?kategorija=vivre">VIVRE</a></li>
                <li><a href="unos.php">UNOS</a></li>
                <li><a href="administrator.php">ADMINISTRACIJA</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="logout.php">ODJAVA (<?php echo $_SESSION['username']; ?>)</a></li>
                <?php else: ?>
                    <li><a href="administrator.php">PRIJAVA</a></li>
                    <li><a href="registracija.php">REGISTRACIJA</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <?php
        include 'spajanje.php';
        define('UPLPATH', 'img/');

        $id = $_GET['id'];
        $query = "SELECT vijesti.*, korisnik.korisnicko_ime 
                FROM vijesti 
                LEFT JOIN korisnik ON vijesti.autor_id = korisnik.id 
                WHERE vijesti.id = $id";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
        ?>

        <article id="clanak">
            <p class="category"><?php echo strtoupper($row['kategorija']); ?></p>
            <h1><?php echo $row['naslov']; ?></h1>
            <p class="datum">AUTOR: <?php echo $row['korisnicko_ime'] ?? 'Nepoznat'; ?></p>
            <p class="datum">OBJAVLJENO: <?php echo $row['datum']; ?></p>
            <img src="<?php echo UPLPATH . $row['slika']; ?>" alt="<?php echo $row['naslov']; ?>">
            <p><em><?php echo $row['sazetak']; ?></em></p>
            <p><?php echo $row['tekst']; ?></p>
        </article>

        <?php mysqli_close($dbc); ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>