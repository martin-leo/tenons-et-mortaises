<?php

class Nature {
  /* Représente la nature d'un objet :
    - nom
    - url sur le site */

  public $nom, $url;

  public function __construct( $page ) {
    /* Constructeur
    Page -> Void */=
    // si la page à un élément nature
    if ( isset( $page->nature->title ) ) {
      $this->nom = $page->nature->title;
      $this->url = $page->nature->httpUrl;
    }

  }

  public function __toString() {
    /* retourne un lien HTML avec url+titre (ou juste le titre si pas d'url)
    Void -> String */
    if ( $this->url && $this->nom ) {
      return "<a href='$this->url'>$this->nom</a>";
    } else {
      return "";
    }
  }

}

?>
