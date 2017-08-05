<?php

class Auteurs {
  /* Représente une liste d'auteurs */
  public $liste;

  public function __construct( $auteurs ) {

    $this->liste = [];

    foreach ( $auteurs as $auteur) {
      array_push( $this->liste, new Auteur( $auteur ) );
    }
  }

  public function specifies () {
    /* retourne vrai si on a des auteurs, faux si on en a pas */
    if ( sizeof( $this->liste ) > 0 ) {
      return true;
    } else {
      return false;
    }
  }

  public function __toString() {
    /* retourne un lien HTML avec url+titre
    Void -> String */
    $sortie = "";

    foreach ( $this->liste as $auteur) {
      //$sortie .= "<a href='$auteur->url'>$auteur->nom</a>, ";
      $sortie .= $auteur->toString() . ", ";
    }

    if ( strlen( $sortie ) > 0 ) {
      $sortie = substr($sortie, 0, -2);
    }
    return $sortie;
  }

}

?>
