<?php
  $entrees = $pages->get("path=/menu/")->entrees_du_menu;
  $page->menu = "";
  foreach ($entrees as $entree) {
    $page->menu .= "<li class=\"menu__item\"><a class=\"menu__lien\" href=\"$entree->httpUrl\">$entree->title</a></li>";
  }
?>
