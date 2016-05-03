<?php
  /* Support du markdown */
  $markdown_module_path = "../../wire/modules/Textformatter/TextformatterMarkdownExtra/";
  require $markdown_module_path."parsedown/Parsedown.php";
  require $markdown_module_path."parsedown-extra/ParsedownExtra.php";
  $Extra = new ParsedownExtra();
?>
