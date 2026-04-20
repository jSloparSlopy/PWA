<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vježba 10</title>
</head>
<body>
    <h2>Zadatak <code>str_word_count</code></h2>
    <p>U zadatku se traži da se ispiše koliko je riječi u rečenici. Koristite naredbu <code>str_word_count</code></p>

    <form method="POST" action="">
        <label for="niz"><b>Ulazni niz:</b></label><br>
        <input type="text" name="niz" id="niz" value="<?php echo isset($_POST['niz']) ? htmlspecialchars($_POST['niz']) : ''; ?>"><br>
        <input type="submit" name="posalji" value="ispiši broj riječi">
    </form>

    <?php
        if (isset($_POST['posalji']) && !empty(trim($_POST['niz']))) {
            $niz = $_POST['niz'];
            $broj = str_word_count($niz);

            echo "<h4 class='rezultat'>Ulazni niz: <span class='niz'>" 
                . htmlspecialchars($niz) 
                . "</span> sadrži $broj riječi.</h4>";
        }
    ?>
</body>
</html>