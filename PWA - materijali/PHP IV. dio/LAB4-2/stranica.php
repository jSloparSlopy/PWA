<?php
session_start();

if (!isset($_SESSION['korisnicko_ime'])) {
    echo "Niste prijavljeni!";
    exit;
}

$korisnicko_ime = $_SESSION['korisnicko_ime'];
$razina_dozvole = $_SESSION['razina_dozvole'];

if ($razina_dozvole == 1) {
    echo "Dobro došli $korisnicko_ime. Vaša razina je administrator.";
} else {
    echo "Dobro došli $korisnicko_ime.";
}
?>