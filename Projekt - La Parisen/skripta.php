<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Parisien - <?php echo isset($_POST['title']) ? $_POST['title'] : ''; ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <div id="logo">
            <a href="index.html">Le Parisien</a>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">HOME</a></li>
                <li><a href="#">PARISIEN</a></li>
                <li><a href="#">VIVRE</a></li>
                <li><a href="unos.html">ADMINISTRACIJA</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php
        if (isset($_POST['title'])) {
            $title = $_POST['title'];
            $about = $_POST['about'];
            $content = $_POST['content'];
            $category = $_POST['category'];
            $archive = isset($_POST['archive']) ? 'Da' : 'Ne';

            $image = '';
            if (isset($_FILES['pphoto']) && $_FILES['pphoto']['error'] == 0) {
                $image = $_FILES['pphoto']['name'];
                move_uploaded_file($_FILES['pphoto']['tmp_name'], 'img/' . $image);
            }
        ?>
        <article id="clanak">
            <p class="category"><?php echo $category; ?></p>
            <h1><?php echo $title; ?></h1>
            <p class="datum">AUTOR:</p>
            <p class="datum">OBJAVLJENO:</p>

            <?php if ($image != '') { ?>
            <img src="img/<?php echo $image; ?>" alt="<?php echo $title; ?>">
            <?php } ?>

            <p><strong>Kratki sadržaj:</strong></p>
            <p><?php echo $about; ?></p>

            <p><strong>Sadržaj:</strong></p>
            <p><?php echo $content; ?></p>

            <p><strong>Arhivirano:</strong> <?php echo $archive; ?></p>
        </article>
        <?php } else { ?>
        <p>Nisu uneseni podaci.</p>
        <?php } ?>
    </main>

    <footer>
        <p>© Le Parisien | Jan Šlopar | jslopar@tvz.hr | 2026</p>
    </footer>
</body>
</html>