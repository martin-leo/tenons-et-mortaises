<?php

class Page_racine {
  /* représentation simple d'une objet lié, lequel peut être aussi bien un objet qu'un événement :
    * titre
    * image principale
    * url
  */

  public $themes, $breadcrumbs;

  public function __construct ( $page ) {
    /* Constructeur
    Page -> Void */

    $this->themes = [];
    $this->breadcrumbs = new Breadcrumbs ( $page );

    foreach ($page->children as $theme) {
      array_push($this->themes, new Theme ( $theme ) );
    }
  }

  public function __toString() {
    /*
    Void -> String */
    $sortie = "";
    foreach ( $this->themes as $theme ) {
      $sortie .= "<li class=\"themes__item\">$theme</li>";
    }
    return $sortie;
  }
}

?>
