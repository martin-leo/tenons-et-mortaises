<?php

class Page_theme {
  /* Structure d'une page theme :
    * titre (title)
    * breadcrumbs
    * contenu (contenu)
    * image principale (image_principale)
    * descendants
  */
  public $titre, $contenu, $breadcrumbs, $image_principale, $enfants, $petits_enfants, $descendants;


  private function tri_descendants ($a, $b) {
    /* Trie des objets par id (u plus gros (récent) au plus petit (ancien) */
    if ($a->id == $b->id) {
      return 0;
    }
    return ($a->id < $b->id) ? +1 : -1;
  }


  public function __construct( $page ) {
    /*  */

    $this->titre = $page->title;
    $this->breadcrumbs = new Breadcrumbs ( $page );
    $this->contenu = $page->zone_de_texte;
    $this->image_principale = $page->image_principale ;
    $this->enfants = $page->children();
    $this->petits_enfants = $page->children()->children();
    $this->descendants = [];

    // on ajoute les enfants au tableau des descendants
    foreach ( $this->enfants as $enfant ) {
      array_push( $this->descendants, new Objet_lie( $enfant ) );
    }

    // on ajoute les petits-enfants au tableau des descendants
    foreach ( $this->petits_enfants as $famille ) {
      for ($i=0; $i < $famille->count ; $i++) {
        array_push( $this->descendants, new Objet_lie( $famille[$i] ) );
      }
    }

    // on trie le tableau par id
    usort( $this->descendants, array($this, "tri_descendants") );
  }
}

?>
