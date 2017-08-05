<?php

class Breadcrumbs {
  /* breadcrumbs pour une page donnée
    cas :
      * objet
      * objet satellite
      * événement
      * sous-événement
      * thème/nature
      * page (manifeste, autre)
  */

  public $breadcrumbs;

  function recursion ( $page ) {
    array_push( $this->breadcrumbs, $page );
    if ( $page->parent->id ) {
      $this->recursion( $page->parent );
    }
  }

  public function __construct ( $page ) {
    /* Constructeur
    Page -> Void */

    $this->breadcrumbs = [];

    $this->recursion( $page );
  }


  public function __toString() {
    /* retourne un lien HTML avec url+titre (ou juste le titre si pas d'url)
    Void -> String */

    $sortie = "<ul class=\"breadcrumbs__liste\">";

    foreach ( array_reverse( $this->breadcrumbs ) as $crumb) {
      $sortie .= "<li class=\"breadcrumbs__item\"><a href=\"$crumb->httpUrl\">$crumb->title</a></li>";
    }

    $sortie .= "</ul>";
    return $sortie;
  }
}

?>
