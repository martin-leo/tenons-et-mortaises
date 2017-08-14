<?php

class Metadonnees {
  /* Représente les métadonnées de projet du site.
  Celles-ci comprennent :
    * titre_page : le titre de page (titre du document + titre du site)
    * description : description pour SEO et RS
    * illustration : illustration pour les réseaux sociaux

  Dans le cas où ces données ne sont pas renseignées, on va chercher dans l'élément parent jusqu'à la racine
  */
  public $titre_page, $description, $illustration;

  public function __construct ( $page ) {
    /* Constructeur
    Pages -> Void */
    $pages = wire("pages");

    $this->titre_page = $page->title . ' - ' . $pages->get("/")->title;
    $this->description = obtenir_recursivement_champs( $page, 'meta_description');
    $this->illustration = obtenir_recursivement_champs( $page, 'image_principale');
  }
}

?>
