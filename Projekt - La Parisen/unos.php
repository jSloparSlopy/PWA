<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Parisien - Unos</title>
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
    if (isset($_POST['title'])) {
        include 'spajanje.php';

        $picture = $_FILES['pphoto']['name'];
        $title = $_POST['title'];
        $about = $_POST['about'];
        $content = $_POST['content'];
        $category = $_POST['category'];
        $date = date('d.m.Y.');
        $archive = isset($_POST['archive']) ? 1 : 0;
        $autor_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;

        if ($picture != '') {
            $target_dir = 'img/' . $picture;
            move_uploaded_file($_FILES['pphoto']['tmp_name'], $target_dir);
        }

        $query = "INSERT INTO vijesti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva, autor_id) 
                VALUES ('$date', '$title', '$about', '$content', '$picture', '$category', '$archive', '$autor_id')";
        $result = mysqli_query($dbc, $query) or die('Error querying database.');
        mysqli_close($dbc);

        echo '<p class="uspjeh">Vijest uspješno dodana! <a href="index.php">Povratak na početnu</a></p>';
    }
    ?>

        <section id="unos-forma">
            <h2>Unos nove vijesti</h2>
            <form name="unos" action="unos.php" method="POST" enctype="multipart/form-data">
                <div class="form-item">
                    <label for="title">Naslov vijesti</label>
                    <div class="form-field">
                        <input type="text" name="title" id="title" class="form-field-textual" autofocus>
                    </div>
                </div>
                <div class="form-item">
                    <label for="about">Kratki sadržaj vijesti (do 50 znakova)</label>
                    <div class="form-field">
                        <textarea name="about" id="about" cols="30" rows="5" class="form-field-textual"></textarea>
                    </div>
                </div>
                <div class="form-item">
                    <label for="content">Sadržaj vijesti</label>
                    <div class="form-field">
                        <textarea name="content" id="content" cols="30" rows="10" class="form-field-textual"></textarea>
                    </div>
                </div>
                <div class="form-item">
                    <label for="pphoto">Slika</label>
                    <div class="form-field">
                        <input type="file" accept="image/jpg,image/gif,image/png" name="pphoto" id="pphoto">
                    </div>
                </div>
                <div class="form-item">
                    <label for="category">Kategorija vijesti</label>
                    <div class="form-field">
                        <select name="category" id="category" class="form-field-textual">
                            <option value="parisien">Parisien</option>
                            <option value="vivre">Vivre Mieux</option>
                        
                        </select>
                    </div>
                </div>
                <div class="form-item">
                    <label>Spremiti u arhivu:
                        <div class="form-field">
                            <input type="checkbox" name="archive" value="1">
                        </div>
                    </label>
                </div>
                <div class="form-item form-buttons">
                    <button type="reset">Poništi</button>
                    <button type="submit">Prihvati</button>
                </div>
            </form>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>