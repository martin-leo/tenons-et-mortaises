<?php

class URI {
  /* Représente un field Repeater URIs composé de :
    - un champs uri
    - un champs texte */

  public $uri, $texte;


  public function __construct( $URI ) {
    /* Constructeur
    Page -> Void */

    // on fait le lien avec l'objet ParseDown Extra
    global $Markdown;

    $this->url = $URI->URI;
    $this->texte = $Markdown->text( $URI->zone_de_texte );
  }

  public function __toString() {
    /* retourne un lien HTML avec url+titre
    Void -> String */
    return "<a href='$this->url'>$this->texte</a>";
  }
}

?>
