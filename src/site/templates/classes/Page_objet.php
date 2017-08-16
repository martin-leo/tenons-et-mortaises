<?php

class Page_objet {
  /* Structure d'une page objet :
    * titre (title)
    * thème principal (page parent)
    * thèmes secondaires (themes_secondaires)
    * nature (nature)
    * date de publication (date_de_publication)
    * origine (origine)
    * auteurs (auteurs)
    * contenu (contenu)
    * image principale (image_principale)
    * images (images)
    * objets associés (objets_associes)
    * URIs (URIs)
  */
  public $titre, $theme, $themes_secondaires, $nature, $date_de_publication, $origine, $auteurs, $contenu, $image_principale, $images, $URIs, $satellites, $objets_associes;

  public function __construct( $page ) {
    /*  */

    $this->titre = $page->title;
    $this->breadcrumbs = new Breadcrumbs ( $page );
    if ( $page->parent->id > 1) { // pour les objets hors thème genre manifeste
      $this->theme = new Theme( $page );
      $this->nature = new Nature( $page );
      $this->themes_secondaires = [];
    }
    $this->date_de_publication = strftime('le %d %B %Y', $page->date_de_publication) ;
    $this->origine = substr( $page->origine , 3, -5); // en markdown, on vire les <p></p>
    $this->auteurs = new Auteurs( $page->auteurs ) ;
    $this->contenu = $page->contenu;
    $this->image_principale = $page->image_principale ;
    $this->images = $page->images ;
    $this->URIs = [];
    $this->satellites = [];
    $this->objets_associes = [];

    // toutes les URIs associées
    foreach ( $page->URIs as $uri) {
      array_push($this->URIs, new URI ( $uri ) );
    }

    if ( $page->themes_secondaires ) {
      // tous les thèmes secondaires associés
      foreach ( $page->themes_secondaires as $theme) {
        //array_push($this->auteurs, $auteur->auteur->title);
        array_push( $this->themes_secondaires, new Theme_secondaire( $theme ) );
      }
    }

    if ( $page->children() ) {
      // tous les satellites
      foreach ( $page->children() as $satellite ) {
        //array_push($this->auteurs, $auteur->auteur->title);
        array_push( $this->satellites, new Satellite( $satellite ) );
      }
    }

    // tous les objets associés
    foreach ( $page->objets_associes as $objet_associe ) {
      //array_push($this->auteurs, $auteur->auteur->title);
      array_push($this->objets_associes, new Objet_lie( $objet_associe ) );
    }
  }
}

?>
