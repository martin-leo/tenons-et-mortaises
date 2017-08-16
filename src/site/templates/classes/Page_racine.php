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

    $this->enfants = [];
    $this->breadcrumbs = new Breadcrumbs ( $page );

    foreach ($page->children as $enfant) {
      array_push($this->enfants, new Page_simple ( $enfant ) );
    }
  }

  public function __toString() {
    /*
    Void -> String */
    $sortie = "";
    foreach ( $this->enfants as $enfant ) {
      $sortie .= "<li class=\"liste__item\">$enfant</li>";
    }
    return $sortie;
  }
}

?>
