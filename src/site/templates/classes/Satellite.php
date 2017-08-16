<?php

class Satellite {
  /* Représente un satellite d'un objet
    Il s'agit des éléments enfants de l'objet */

  public $nom, $url, $image;

  public function __construct ( $satellite ) {
    /* Constructeur
    Page -> Void */

    $this->nom = $satellite->title;
    $this->url = $satellite->httpUrl;
    $this->image = $satellite->image_principale;
    if ( $this->image == "" ) {
      $this->image = wire("pages")->get(1)->image_principale;
    }
    $this->auteurs = new Auteurs ( $satellite->auteurs );
    $this->dates = new PW_Date( $satellite );
    $this->origine = substr( $satellite->origine, 3, -4);
  }

  public function __toString() {
    /* retourne le HTML de représentation du satellite
    Void -> String */

    $image__url;
    $image__description;

    if ( $this->image ) {

      $image__url = $this->image->httpUrl;
      $image__description = $this->image->description;

    }

    $sortie = "<li class=\"liste-d-articles__item--avec-iconographie\"><section class=\"article-liste--avec-iconographie\">";


    if ( $this->url ) { $sortie .= "<a href=\"$this->url\">"; }

    $sortie .= "<h3 class=\"article-liste__titre--avec-iconographie\">$this->nom</h3>";

    if ( $this->url ) { $sortie .= "</a>"; }

    if ( $this->image ) {

      $sortie .= "<div class=\"article-liste__illustration\">";

      if ( $this->url ) { $sortie .= "<a href=\"$this->url\">"; }

      $sortie .= "<img class=\"lazyload\" data-src=\"$image__url\" alt=\"$image__description\">";

      if ( $this->url ) { $sortie .= "</a>"; }

      $sortie .= "</div>";
    }

    if ( $this->auteurs ) { $sortie .= "<p class=\"article-liste__auteurs\">$this->auteurs</p>"; }

    if ( $this->dates ) { $sortie .= "<p class=\"article-liste__date\"> $this->dates</p>"; }

    $sortie .= "</section></li>";

    return $sortie;
  }
}

?>
