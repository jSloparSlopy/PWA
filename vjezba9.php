<?php
function provjeriDucan() {
    $sat   = (int)date('G');      
    $dan   = (int)date('N');      
    $datum = date('d.m.');        
    $godina = date('Y');

    $praznici = [
        '01.01.', // Nova godina
        '06.01.', // Sveta tri kralja
        '01.05.', // Praznik rada
        '30.05.', // Dan državnosti
        '22.06.', // Dan antifašističke borbe
        '05.08.', // Dan pobjede i domovinske zahvalnosti
        '15.08.', // Velika Gospa
        '01.11.', // Svi sveti
        '18.11.', // Dan sjećanja na žrtve Domovinskog rata
        '25.12.', // Božić
        '26.12.', // Sveti Stjepan
    ];

    $uskrs = easter_date($godina);                    // timestamp Uskrsa
    $praznici[] = date('d.m.', $uskrs);               // Uskrs
    $praznici[] = date('d.m.', $uskrs + 86400);       // Uskrsni ponedjeljak

    if (in_array($datum, $praznici)) {
        return "Dućan je ZATVOREN (državni praznik).";
    }

    if ($dan == 7) {
        return "Dućan je ZATVOREN (nedjelja).";
    }

    if ($dan == 6) {
        if ($sat >= 9 && $sat < 14) {
            return "Dućan je OTVOREN (subota, radi 9 - 14).";
        } else {
            return "Dućan je ZATVOREN (subota, radno vrijeme 9 - 14).";
        }
    }

    if ($sat >= 8 && $sat < 20) {
        return "Dućan je OTVOREN (radno vrijeme 8 - 20).";
    } else {
        return "Dućan je ZATVOREN (radno vrijeme 8 - 20).";
    }
}

echo "<p>Trenutni datum i vrijeme: " . date('d.m.Y. H:i') . "</p>";
echo "<h3>" . provjeriDucan() . "</h3>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vježba 9</title>
</head>
<body>
    
</body>
</html>