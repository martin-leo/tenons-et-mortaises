<?php

class Page_simple {
  /* Représente  */

  public $titre, $url;

  public function __construct ( $page ) {
    /* Constructeur
    Page -> Void */
    if ( $page->id ) {
      $this->nom = $page->title;
      $this->url = $page->httpUrl;
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
