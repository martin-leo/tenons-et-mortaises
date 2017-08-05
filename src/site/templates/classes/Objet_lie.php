<?php

class Objet_lie {
  /* représentation simple d'une objet lié, lequel peut être aussi bien un objet qu'un événement :
    * titre
    * image principale
    * url
  */

  public $nom, $image, $url;

  public function __construct ( $objet ) {
    /* Constructeur
    Page -> Void */

    // on fait le lien avec l'objet ParseDown Extra
    global $Markdown;

    $this->nom = $objet->title;
    $this->url = $objet->httpUrl;
    $this->image = $objet->image_principale;
    $this->dates = new PW_Date( $objet );
    $this->origine = substr( $Markdown->text( $objet->origine ), 3, -4);
  }

  public function __toString() {
    /* retourne le HTML de représentation de l'objet lié
    Void -> String */

    $image__url = "";
    $image__description = "";

    if ( $this->image ) {
      $image__url = $this->image->httpUrl;
      $image__description = $this->image->description;
    }

    $sortie = "<li class=\"liste-d-articles__item--avec-iconographie\"><section class=\"article-liste--avec-iconographie\">";

    $sortie .= "<h3 class=\"article-liste__titre--avec-iconographie\"><a href=\"$this->url\">$this->nom</a></h3>";

    $sortie .= "<div class=\"article-liste__illustration\">";

    $sortie .= "<a href=\"$this->url\">";

    $sortie .= "<img src=\"$image__url\" alt=\"$image__description\">";

    $sortie .= "</a>";

    $sortie .= "</div>";

    if ( $this->dates ) { $sortie .= "<p class=\"article-liste__date\"> $this->dates</p>"; }

    $sortie .= "</section></li>";

    return $sortie;
  }
}

?>
