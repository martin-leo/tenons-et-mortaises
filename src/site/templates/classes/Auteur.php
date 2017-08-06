<?php

class Auteur {
  /* Représente un auteur :
    - nom
    - texte associé
    - url sur le site */

  public $nom, $texte, $url;

  public function __construct( $auteur ) {
    /* Constructeur
    Page -> Void */

    // on fait le lien avec l'objet ParseDown Extra
    global $Markdown;

    $this->nom = $auteur->auteur->title;
    $this->texte = $Markdown->text($auteur->auteur->zone_de_texte);
    $this->url = $auteur->auteur->httpUrl;
  }

  public function toString () {
    /* retourne un lien HTML avec url+titre
    Void -> String */
    return "<a href='$this->url'>$this->nom</a>";
  }

  public function __toString () {
    /* retourne un lien HTML avec url+titre
    Void -> String */
    return $this->toString();
  }

}

?>