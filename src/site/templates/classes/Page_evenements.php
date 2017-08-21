<?php

class Page_evenements {
  /* Représente la nature d'un objet :
    - nom
    - url sur le site */

  public $breadcrumbs, $futurs, $passés;

  public function __construct( $page ) {
    /* Constructeur
    Page -> Void */

    $this->breadcrumbs = new Breadcrumbs ( $page );
    $this->passes = [];
    $this->presents = [];
    $this->futurs = [];

    $passes = wire("pages")->find("template=evenement,date_de_fin<today");
    $presents = wire("pages")->find("template=evenement,date_de_debut<=today, date_de_fin>=today");
    $futurs = wire("pages")->find("template=evenement,date_de_debut>today");

    foreach ( $passes as $passe ) {
      array_push( $this->passes, new Objet_lie ( $passe ) );
    }

    foreach ( $presents as $present ) {
      array_push( $this->presents, new Objet_lie ( $present ) );
    }

    foreach ( $futurs as $futur ) {
      array_push( $this->futurs, new Objet_lie ( $futur ) );
    }

  }

}

?>
