<?php
$naslov     = isset($_POST['naslov'])     ? htmlspecialchars(trim($_POST['naslov']))     : '';
$kategorija = isset($_POST['kategorija']) ? htmlspecialchars(trim($_POST['kategorija'])) : '';
$autor      = isset($_POST['autor'])      ? htmlspecialchars(trim($_POST['autor']))      : 'Nepoznat autor';
$sazetak    = isset($_POST['sazetak'])    ? htmlspecialchars(trim($_POST['sazetak']))    : '';
$tekst      = isset($_POST['tekst'])      ? htmlspecialchars(trim($_POST['tekst']))      : '';
$prikaz     = isset($_POST['prikaz'])     ? true : false;
$datum      = date('Y-m-d', time()); // zbog sql notacije

$slika_src = '';
$slika_ime = '';
if (isset($_FILES['slika']) && $_FILES['slika']['error'] === UPLOAD_ERR_OK) {
    $dozvoljeni_tipovi = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($_FILES['slika']['type'], $dozvoljeni_tipovi)) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
        $slika_ime  = basename($_FILES['slika']['name']);
        $slika_dest = $upload_dir . $slika_ime;
        if (move_uploaded_file($_FILES['slika']['tmp_name'], $slika_dest))
            $slika_src = $slika_dest;
    }
}

$greske = [];
if (empty($naslov))     $greske[] = 'Naslov vijesti je obavezan.';
if (empty($kategorija)) $greske[] = 'Kategorija je obavezna.';
if (empty($sazetak))    $greske[] = 'Kratki sažetak je obavezan.';
if (empty($tekst))      $greske[] = 'Tekst vijesti je obavezan.';
?>
<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $naslov ? $naslov . ' — F1 Vijesti' : 'Pregled vijesti — F1 Vijesti' ?></title>
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="style/skripta_styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

  <header>
    <div class="header-inner">
      <div class="header-brand">
        <span class="header-logo">F1</span>
        <span class="header-tagline">VIJESTI</span>
      </div>
      <nav>
        <a href="index.html"><i class="fa-solid fa-house"></i> Početna</a>
        <a href="index.html#najnovije">Najnovije</a>
        <a href="index.html#vozaci">Vozači</a>
        <a href="index.html#timovi">Timovi</a>
        <a href="index.html#staze">Staze</a>
        <a href="unos.html"><i class="fa-solid fa-pen"></i> Unos</a>
      </nav>
      <div class="header-season">SEZONA 2026</div>
    </div>
    <div class="header-stripe"></div>
  </header>

<?php if (!empty($greske)): ?>
  <main>
    <div class="error-box">
      <h3><i class="fa-solid fa-triangle-exclamation"></i> Forma nije ispravno ispunjena</h3>
      <ul>
        <?php foreach ($greske as $g): ?>
          <li><?= $g ?></li>
        <?php endforeach; ?>
      </ul>
      <a href="unos.html" class="btn-back-err">
        <i class="fa-solid fa-arrow-left"></i> Povratak na formu
      </a>
    </div>
  </main>

<?php else: ?>

  <div class="preview-banner">
    <i class="fa-solid fa-eye"></i> Pregled vijesti — upravo uneseno
  </div>

  <main>
    <div class="content-wrapper">

      <article class="single-article">

        <div class="article-breadcrumb">
          <a href="index.html">Početna</a>
          <i class="fa-solid fa-chevron-right"></i>
          <a href="index.html#najnovije">Vijesti</a>
          <i class="fa-solid fa-chevron-right"></i>
          <span><?= $naslov ?></span>
        </div>

        <?php if ($prikaz): ?>
          <div class="status-badge status-active">
            <i class="fa-solid fa-circle-check"></i> Aktivno — vidljivo na portalu
          </div>
        <?php else: ?>
          <div class="status-badge status-inactive">
            <i class="fa-solid fa-eye-slash"></i> Skriveno — nije vidljivo na portalu
          </div>
        <?php endif; ?>

        <div class="article-label"><?= $kategorija ?></div>
        <h1><?= $naslov ?></h1>

        <div class="article-meta">
          <span><i class="fa-regular fa-calendar"></i> <?= $datum ?></span>
          <span><i class="fa-solid fa-user"></i> <?= $autor ?></span>
          <span><i class="fa-solid fa-folder"></i> <?= $kategorija ?></span>
        </div>

        <?php if (!empty($sazetak)): ?>
        <div class="article-lead"><?= $sazetak ?></div>
        <?php endif; ?>

        <?php if (!empty($slika_src)): ?>
        <figure class="article-figure">
          <img src="<?= htmlspecialchars($slika_src) ?>" alt="<?= $naslov ?>">
          <figcaption><i class="fa-solid fa-camera"></i> <?= htmlspecialchars($slika_ime) ?></figcaption>
        </figure>
        <?php endif; ?>

        <section class="article-body">
          <p class="article-text-content"><?= $tekst ?></p>
        </section>

        <div class="article-tags">
          <span><i class="fa-solid fa-tag"></i></span>
          <a href="#"><?= $kategorija ?></a>
          <a href="#">F1 2026</a>
          <a href="#"><?= $autor ?></a>
        </div>

        <a href="unos.html" class="btn-back">
          <i class="fa-solid fa-arrow-left"></i> Unesi novu vijest
        </a>

      </article>

      <aside>

        <div class="aside-block">
          <h3 class="aside-title"><i class="fa-solid fa-circle-info"></i> Detalji vijesti</h3>
          <table class="details-table">
            <tr>
              <td>Naslov</td>
              <td><?= mb_substr($naslov, 0, 30) ?>...</td>
            </tr>
            <tr>
              <td>Kategorija</td>
              <td class="val-red"><?= $kategorija ?></td>
            </tr>
            <tr>
              <td>Autor</td>
              <td><?= $autor ?></td>
            </tr>
            <tr>
              <td>Datum</td>
              <td><?= $datum ?></td>
            </tr>
            <tr>
              <td>Status</td>
              <td class="<?= $prikaz ? 'val-green' : 'val-muted' ?>">
                <?= $prikaz ? '✓ Aktivno' : '✗ Skriveno' ?>
              </td>
            </tr>
          </table>
        </div>

        <div class="aside-block">
          <h3 class="aside-title"><i class="fa-solid fa-pen"></i> Akcije</h3>
          <div class="aside-actions">
            <a href="unos.html" class="btn-read" style="justify-content:center;font-size:0.78rem;">
              <i class="fa-solid fa-plus"></i> Nova vijest
            </a>
            <a href="index.html" class="btn-aside-secondary">
              <i class="fa-solid fa-house"></i> Početna
            </a>
          </div>
        </div>

        <div class="aside-block">
          <h3 class="aside-title"><i class="fa-solid fa-trophy"></i> Poredak vozača</h3>
          <ol class="standings-list">
            <li><span class="pos">1.</span><span class="driver">K. Antonelli</span><span class="pts">131 pts</span></li>
            <li><span class="pos">2.</span><span class="driver">G. Russell</span><span class="pts">88 pts</span></li>
            <li><span class="pos">3.</span><span class="driver">C. Leclerc</span><span class="pts">75 pts</span></li>
            <li><span class="pos">4.</span><span class="driver">L. Hamilton</span><span class="pts">72 pts</span></li>
            <li><span class="pos">5.</span><span class="driver">L. Norris</span><span class="pts">58 pts</span></li>
          </ol>
        </div>

        <div class="aside-block">
          <h3 class="aside-title"><i class="fa-solid fa-flag-checkered"></i> Sljedeća utrka</h3>
          <div class="next-race">
            <div class="race-name">🇲🇨 Monaco Grand Prix</div>
            <div class="race-date">7. lipnja 2026.</div>
            <div class="race-circuit">Circuit de Monaco</div>
          </div>
        </div>

      </aside>
    </div>
  </main>

<?php endif; ?>

  <footer>
    <div class="footer-inner">
      <div class="footer-brand">F1 <span>VIJESTI</span></div>
      <nav class="footer-nav">
        <a href="index.html">Početna</a>
        <a href="index.html#najnovije">Vijesti</a>
        <a href="index.html#vozaci">Vozači</a>
        <a href="index.html#timovi">Timovi</a>
        <a href="unos.html">Unos</a>
      </nav>
      <div class="footer-info">
        <p>Jan Šlopar &nbsp;|&nbsp; <a href="mailto:jan.slopar@student.hr">jan.slopar@student.hr</a> &nbsp;|&nbsp; 2026.</p>
        <p class="footer-copy">Kolegij: HTML &amp; CSS, 1. semestar &mdash; Programiranje web aplikacija</p>
      </div>
    </div>
  </footer>

</body>
</html>
