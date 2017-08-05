<?php

  // localisation pour les dates
  setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');

  /* Support du markdown */
  $markdown_module_path = "../../wire/modules/Textformatter/TextformatterMarkdownExtra/";
  require $markdown_module_path."parsedown/Parsedown.php";
  require $markdown_module_path."parsedown-extra/ParsedownExtra.php";
  global $Markdown;
  $Markdown = new ParsedownExtra();
?>
