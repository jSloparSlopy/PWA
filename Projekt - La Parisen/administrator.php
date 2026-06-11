<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Parisien - Administracija</title>
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

        if (isset($_POST['delete'])) {
            $id = $_POST['id'];
            $query = "DELETE FROM vijesti WHERE id=$id";
            mysqli_query($dbc, $query);
        }

        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $about = $_POST['about'];
            $content = $_POST['content'];
            $category = $_POST['category'];
            $archive = isset($_POST['archive']) ? 1 : 0;

            $picture = $_FILES['pphoto']['name'];
            if ($picture != '') {
                $target_dir = 'img/' . $picture;
                move_uploaded_file($_FILES['pphoto']['tmp_name'], $target_dir);
                $query = "UPDATE vijesti SET naslov='$title', sazetak='$about', tekst='$content', slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id";
            } else {
                $query = "UPDATE vijesti SET naslov='$title', sazetak='$about', tekst='$content', kategorija='$category', arhiva='$archive' WHERE id=$id";
            }
            mysqli_query($dbc, $query);
        }

        $query = "SELECT * FROM vijesti";
        $result = mysqli_query($dbc, $query);

        while ($row = mysqli_fetch_array($result)) {
            echo '<form enctype="multipart/form-data" action="administrator.php" method="POST">';
            echo '<div class="admin-clanak">';
            echo '<div class="form-item">
                    <label>Naslov vijesti</label>
                    <div class="form-field">
                        <input type="text" name="title" class="form-field-textual" value="' . $row['naslov'] . '">
                    </div>
                  </div>';
            echo '<div class="form-item">
                    <label>Kratki sadržaj</label>
                    <div class="form-field">
                        <textarea name="about" cols="30" rows="5" class="form-field-textual">' . $row['sazetak'] . '</textarea>
                    </div>
                  </div>';
            echo '<div class="form-item">
                    <label>Sadržaj vijesti</label>
                    <div class="form-field">
                        <textarea name="content" cols="30" rows="8" class="form-field-textual">' . $row['tekst'] . '</textarea>
                    </div>
                  </div>';
            echo '<div class="form-item">
                    <label>Slika</label>
                    <div class="form-field">
                        <input type="file" name="pphoto">
                        <br><img src="' . UPLPATH . $row['slika'] . '" width="100px">
                    </div>
                  </div>';
            echo '<div class="form-item">
                    <label>Kategorija</label>
                    <div class="form-field">
                        <select name="category" class="form-field-textual">
                            <option value="parisien" ' . ($row['kategorija'] == 'parisien' ? 'selected' : '') . '>Parisien</option>
                            <option value="vivre" ' . ($row['kategorija'] == 'vivre' ? 'selected' : '') . '>Vivre Mieux</option>
                            <option value="politique" ' . ($row['kategorija'] == 'politique' ? 'selected' : '') . '>Politique</option>
                            <option value="economie" ' . ($row['kategorija'] == 'economie' ? 'selected' : '') . '>Économie</option>
                        </select>
                    </div>
                  </div>';

            echo '<div class="form-item"><label>Arhivirano: ';
            if ($row['arhiva'] == 0) {
                echo '<input type="checkbox" name="archive">';
            } else {
                echo '<input type="checkbox" name="archive" checked>';
            }
            echo '</label></div>';

            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<div class="form-item form-buttons">
                    <button type="reset">Poništi</button>
                    <button type="submit" name="update">Izmjeni</button>
                    <button type="submit" name="delete">Izbriši</button>
                  </div>';
            echo '</div></form><hr>';
        }
        mysqli_close($dbc);
        ?>
    </main>

    <footer>
         <p>© Le Parisien | Jan Šlopar | jslopar@tvz.hr | 2026</p>
    </footer>
</body>
</html>