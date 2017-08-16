<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $page->title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    /* <!-- Métadonnées --> */
    <link rel="canonical" href="http://tenonsetmortaises.net/" />
    <meta name="description" content="<?php echo $page->metadonnees->description; ?>">
    /* <!-- Twitter Cards --> */
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?php echo $page->title; ?>">
    <meta name="twitter:description" content="<?php echo $page->metadonnees->description; ?>">
    <meta name="twitter:image" content="<?php echo $page->metadonnees->illustration; ?>">
    /* <!-- Open Graph --> */
    <meta property="og:url" content="<?php echo $page->httpUrl; ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $page->title; ?>">
    <meta property="og:image" content="<?php echo $page->metadonnees->illustration; ?>">
    <meta property="og:description" content="<?php echo $page->metadonnees->description; ?>">
    /* <!-- CSS/JS lié --> */
    <link rel="stylesheet" href="<?php echo $config->urls->templates?>styles/s.css">
    <?php if ( isset ( $head__scripts ) ) { echo $head__scripts; } ?>
  </head>
  <body class="page">
