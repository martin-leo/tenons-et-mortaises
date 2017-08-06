<?php

class URI {
  /* Représente un field Repeater URIs composé de :
    - un champs uri
    - un champs texte */

  public $uri, $texte;


  public function __construct( $URI ) {
    /* Constructeur
    Page -> Void */

    $this->url = $URI->URI;
    $this->texte = $URI->zone_de_texte;
  }

  public function __toString() {
    /* retourne un lien HTML avec url+titre
    Void -> String */
    return "<a href='$this->url'>$this->texte</a>";
  }
}

?>
