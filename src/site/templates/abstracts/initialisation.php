<?php

  // localisation pour les dates
  // setlocale( LC_TIME, 'fr', 'fr_FR', 'fr_FR@euro', 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8', 'fr-FR', 'fra' );
  setlocale( LC_TIME, 'fr_FR.UTF-8' );

  $page->metadonnees = new Metadonnees( $page );

?>
