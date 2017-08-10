<?php

class Page_evenement {
  /* Représente la nature d'un objet :
    - nom
    - url sur le site */

  public $titre, $theme, $themes_secondaires, $nature, $dates, $carte, $lieux, $contenu, $image_principale, $images, $URIs, $sous_evenements, $objets_associes;

  public function __construct( $page ) {
    /* Constructeur
    Page -> Void */

    $this->titre = $page->title;
    $this->breadcrumbs = new Breadcrumbs ( $page );
    if ( $page->parent->id > 1) { // pour les objets hors thème genre manifeste
      $this->theme = new Theme( $page );
      $this->nature = new Nature( $page );
      $this->themes_secondaires = [];
    }

    // carte google maps
    $this->carte = wire("modules")->get('MarkupGoogleMap');
    if ( $page->children ) {
      $this->lieux = $page->children;
      $this->lieux->push( $page );
    } else {
      $this->lieux = $page;
    }

    $this->dates = new PW_Date ( $page ) ;
    $this->contenu = $page->contenu;
    $this->image_principale = $page->image_principale ;
    $this->images = $page->images ;
    $this->URIs = [];
    $this->sous_evenements = [];
    $this->objets_associes = [];

    // toutes les URIs associées
    foreach ( $page->URIs as $uri) {
      array_push($this->URIs, new URI ( $uri ) );
    }

    if ( $page->themes_secondaires ) {
      // tous les thèmes secondaires associés
      foreach ( $page->themes_secondaires as $theme) {
        //array_push($this->auteurs, $auteur->auteur->title);
        array_push( $this->themes_secondaires, new Theme_secondaire ( $theme ) );
      }
    }

    if ( $page->children() ) {
      // tous les sous-événements
      foreach ( $page->children() as $sous_evenements ) {
        array_push ( $this->sous_evenements, new Objet_lie ( $sous_evenements ) );
      }
    }

    // tous les objets associés
    foreach ( $page->objets_associes as $objet_associe ) {
      array_push ( $this->objets_associes, new Objet_lie ( $objet_associe ) );
    }
  }

  public function __toString() {
    /* retourne un lien HTML avec url+titre (ou juste le titre si pas d'url)
    Void -> String */
    return "";
  }
}

?>
