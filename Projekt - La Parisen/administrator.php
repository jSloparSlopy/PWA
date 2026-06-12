<?php
session_start();
/*
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';*/
include 'spajanje.php';
define('UPLPATH', 'img/');

if (isset($_COOKIE['username']) && !isset($_SESSION['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['level'] = $_COOKIE['level'];
    $_SESSION['user_id'] = $_COOKIE['user_id'];
}


$uspjesnaPrijava = false;
$admin = false;
$imeKorisnika = '';
$lozinkaKorisnika = '';
$levelKorisnika = 0;
$idKorisnika = 0;

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM vijesti WHERE id=?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
    }
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
        move_uploaded_file($_FILES['pphoto']['tmp_name'], 'img/' . $picture);
        $sql = "UPDATE vijesti SET naslov=?, sazetak=?, tekst=?, slika=?, kategorija=?, arhiva=? WHERE id=?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'sssssii', $title, $about, $content, $picture, $category, $archive, $id);
            mysqli_stmt_execute($stmt);
        }
    } else {
        $sql = "UPDATE vijesti SET naslov=?, sazetak=?, tekst=?, kategorija=?, arhiva=? WHERE id=?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'sssiii', $title, $about, $content, $category, $archive, $id);
            mysqli_stmt_execute($stmt);
        }
    }
}

if (isset($_POST['prijava'])) {
    $prijavaImeKorisnika = $_POST['username'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];

    $sql = "SELECT id, korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $idKorisnika, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
        mysqli_stmt_fetch($stmt);
    }

    if (mysqli_stmt_num_rows($stmt) > 0 && password_verify($prijavaLozinkaKorisnika, $lozinkaKorisnika)) {
        $uspjesnaPrijava = true;
        $_SESSION['username'] = $imeKorisnika;
        $_SESSION['level'] = $levelKorisnika;
        $_SESSION['user_id'] = $idKorisnika;
        $admin = ($levelKorisnika == 1);
    } else {
        $uspjesnaPrijava = false;
    }
}
?>
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
    if (($uspjesnaPrijava == true && $admin == true) || (isset($_SESSION['username']) && $_SESSION['level'] == 1)) {

        echo '<div class="admin-header">';
        echo '<p>Prijavljeni ste kao: <strong>' . $_SESSION['username'] . '</strong></p>';
        echo '<a href="logout.php"><button type="button">Odjava</button></a>';
        echo '</div><hr>';

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
            echo ($row['arhiva'] == 0) ? '<input type="checkbox" name="archive">' : '<input type="checkbox" name="archive" checked>';
            echo '</label></div>';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<div class="form-item form-buttons">
                    <button type="reset">Poništi</button>
                    <button type="submit" name="update">Izmjeni</button>
                    <button type="submit" name="delete">Izbriši</button>
                  </div>';
            echo '</div></form><hr>';
        }

    } else if ($uspjesnaPrijava == true && $admin == false) {
        echo '<p>Bok ' . $imeKorisnika . '! Uspješno ste prijavljeni, ali niste administrator.</p>';

    } else if (isset($_SESSION['username']) && $_SESSION['level'] == 0) {
        echo '<p>Bok ' . $_SESSION['username'] . '! Uspješno ste prijavljeni, ali niste administrator.</p>';

    } else if ($uspjesnaPrijava == false && isset($_POST['prijava'])) {
        echo '<p class="greska">Pogrešno korisničko ime ili lozinka. <a href="registracija.php">Registrirajte se</a></p>';
        include 'login_forma.php';

    } else {
        include 'login_forma.php';
    }
    ?>
    </main>

    <footer>
        <p>© Le Parisien | Jan Šlopar | jslopar@tvz.hr | 2026</p>
    </footer>
</body>
</html>