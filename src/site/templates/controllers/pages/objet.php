<?php
class Objet {
  /* Structure d'un objet :
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

    // on fait le lien avec l'objet ParseDown Extra
    global $Markdown;

    $this->titre = $page->title;
    $this->breadcrumbs = new Breadcrumbs ( $page );
    $this->theme = new Theme( $page );
    $this->themes_secondaires = [];
    $this->nature = new Nature( $page );
    $this->date_de_publication = utf8_encode( strftime('le %d %B %Y', $page->date_de_publication) ) ;
    $this->origine = substr( $Markdown->text( $page->origine ), 3, -4); // en markdown, on vire les <p></p>
    $this->auteurs = new Auteurs( $page->auteurs ) ;
    $this->contenu = $Markdown->text( $page->contenu );
    $this->image_principale = $page->image_principale ;
    $this->images = $page->images ;
    $this->URIs = [];
    $this->satellites = [];
    $this->objets_associes = [];


    // toutes les URIs associées
    foreach ( $page->URIs as $uri) {
      array_push($this->URIs, new URI ( $uri ) );
    }

    // tous les thèmes secondaires associés
    foreach ( $page->themes_secondaires as $theme) {
      //array_push($this->auteurs, $auteur->auteur->title);
      array_push($this->themes_secondaires, new Theme_secondaire( $theme ) );
    }

    // tous les satellites
    foreach ( $page->children() as $satellite) {
      //array_push($this->auteurs, $auteur->auteur->title);
      array_push($this->satellites, new Satellite( $satellite ) );
    }

    // tous les objets associés
    foreach ( $page->objets_associes as $objet_associe) {
      //array_push($this->auteurs, $auteur->auteur->title);
      array_push($this->objets_associes, new Objet_lie( $objet_associe ) );
    }
  }
}

function determiner_objet( $page ) {
  /*
  Page Object -> Void */
  /* ajout d'une propriété thème */
  $page->objet = new Objet ( $page );
}

determiner_objet( $page );
?>
