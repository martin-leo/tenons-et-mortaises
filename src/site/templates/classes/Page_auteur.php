<?php

class Page_auteur extends Page_nature {
  /* Représente un thème secondaire d'un objet
    Le thème est soit l'objet ancêtre possédant un template thème le plus proche */

  public function obtenir_selection ( $page ) {
    /* Constructeur
    Page -> Void */

      $selecteur = "auteurs.auteur.title%=" . $page->title;
      $selection = wire("pages")->find( $selecteur );
      return $selection;
  }
}

?>
