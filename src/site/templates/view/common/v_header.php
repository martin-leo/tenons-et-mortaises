<!DOCTYPE html><html lang="<?php echo $lang ?>"><head><meta charset="utf-8"><title><?php echo $page_title ?></title><link rel="stylesheet" href="<?php echo $config->urls->templates?>styles/s.css">
<?php if ($scripts) { echo $scripts; } ?></head><body>

/* titre principal */
<h1 hidden>titre du site - titre du contenu</h1>

/* cartographie des archives */
<section id="carte">
  <h2 hidden>Cartographie des archives</h2>
</section>

/* Navigation */
<nav>
  <h2>Menu</h2>
  <ul>
    <li>événements</li>
    <li>thèmes</li>
    <li>objets récents</li>
    <li>projets</li>
    <li>archives</li>
    <li>manifeste</li>
    <li>contact</li>
  </ul>
</nav>
