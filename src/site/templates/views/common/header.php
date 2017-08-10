<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $page->title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo $config->urls->templates?>styles/s.css">
    <?php if ( isset ( $head__scripts ) ) { echo $head__scripts; } ?>
  </head>
  <body class="page">
