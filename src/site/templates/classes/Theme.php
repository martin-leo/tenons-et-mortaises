<?php

class Theme {
  /* Représente le thème d'un objet
    Le thème est soit l'objet ancêtre possédant un template thème le plus proche */

  public $theme, $nom, $texte, $url;

  public function __construct ( $page ) {
    /* Constructeur
    Page -> Void */
    if ( $page->template == "theme" ) {
      $theme = $page;
    } else {
      $theme = $this->chercher_theme( $page );
    }

    if ( $theme->id ) {
      $this->nom = $theme->title;
      $this->texte = $theme->zone_de_texte;
      $this->url = $theme->httpUrl;
    }
  }

  public function chercher_theme ( $page, $max_iteration = 4 ) {
    /* recherche itérative de l'ancêtre le plus proche avec le template theme
    $page -> Page Object */
    $max_iteration--;

    if ( $page->parent->template->name == "theme" ) {
      return $page->parent;
    } else if ( $max_iteration > 0 ) {
      return $this->chercher_theme( $page->parent, $max_iteration );
    } else {
      return NULL;
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
