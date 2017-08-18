<?php

class Page_nature {
  /* Structure d'une page theme :
    * titre (title)
    * breadcrumbs
    * contenu (contenu)
    * image principale (image_principale)
    * objets (de cette nature)
  */
  public $titre, $contenu, $breadcrumbs, $image_principale, $objets;


  public function __construct( $page ) {
    /*  */

    $this->titre = $page->title;
    $this->breadcrumbs = new Breadcrumbs ( $page );
    $this->contenu = $page->zone_de_texte;
    $this->image_principale = $page->image_principale ;
    $this->objets = [];

    $selection = $this->obtenir_selection( $page );

    foreach ( $selection as $objet ) {
      array_push($this->objets, new Objet_lie ( $objet ) );
    }
  }

  public function obtenir_selection ( $page ) {
    $selecteur = "nature.title%=" . $page->title;
    $selection = wire("pages")->find( $selecteur );
    return $selection;
  }

  public function __toString() {
    /* */
    $sortie = "";
    return $sortie;
  }
}

?>
