<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Parisien - Kategorija</title>
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
            </ul>
        </nav>
    </header>

    <main>
        <?php
        include 'spajanje.php';
        define('UPLPATH', 'img/');

        $kategorija = $_GET['kategorija'];
        $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='$kategorija'";
        $result = mysqli_query($dbc, $query);
        ?>

        <section>
            <h2><?php echo strtoupper($kategorija); ?></h2>
            <div class="clanci">
            <?php
            while ($row = mysqli_fetch_array($result)) {
                echo '<article>';
                echo '<a href="clanak.php?id=' . $row['id'] . '">';
                echo '<img src="' . UPLPATH . $row['slika'] . '" alt="' . $row['naslov'] . '">';
                echo '<h3>' . $row['naslov'] . '</h3>';
                echo '</a>';
                echo '</article>';
            }
            mysqli_close($dbc);
            ?>
            </div>
        </section>
    </main>

    <footer>
         <p>© Le Parisien | Jan Šlopar | jslopar@tvz.hr | 2026</p>
    </footer>
</body>
</html>