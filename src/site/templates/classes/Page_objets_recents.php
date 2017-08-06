<?php

class Page_objets_recents {
  /*
  */
  public $titre, $breadcrumbs, $objets;

  public function __construct( $page ) {
    /*  */

    $this->titre = $page->title;
    $this->breadcrumbs = new Breadcrumbs ( $page );
    $this->objets = [];


    foreach ( wire("pages")->find("template=objet, sort=-created") as $objet ) {
      array_push( $this->objets, new satellite ( $objet ) );
    }
  }

  public function __toString() {
    /* retourne le HTML de représentation de l'objet lié
    Void -> String */
    $sortie = "";
    foreach ($this->objets as $objet) {
      $sortie .= "$objet";
    }
    return $sortie;
  }
}

?>
