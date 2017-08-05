<?php

class PW_Date {
  /* Représente une date avec son type (publication/début/début-fin)
    * type (String) :
      * 0 : publication
      * 1 : début
      * 2 : début et fin
    * data (date ou tableau de dates) */

  public $type, $data, $date_traitee;

  public function __construct ( $objet ) {
    /* on va regarder la nature de l'objet et de la date associée */

    // type

    if ( $objet->template == "objet" ) {
      $this->type = 0;
    } elseif ( $objet->template == "evenement" ) {
      // si on a une date de fin
      if ( $objet->date_de_fin ) {
        $this->type = 2;
      } else {
        $this->type = 1;
      }
    }

  // dates

  // date unique
  switch ( $this->type ) {
    case 0: // date de publication
      $this->data = $objet->date_de_publication;
      break;
    case 1: // date de début seulement
      $this->data = $objet->date_de_debut;
      break;
    case 2: // date de début et de fin
      $this->data = array($objet->date_de_debut,$objet->date_de_fin);
      break;
    }
  }

  public function date_traitee ( $date ) {
    /* */
    return utf8_encode( strftime('%d %B %Y', $date) );
  }

  public function __toString() {
    switch ( $this->type ) {
      case 0: // date de publication
        $date = $this->date_traitee($this->data);
        return "Publié le $date";
        break;
      case 1: // date de début seulement
        $date = $this->date_traitee($this->data);
        return "Le $date";
        break;
      case 2: // date de début et de fin
        $debut = $this->date_traitee($this->data[0]);
        $fin = $this->date_traitee($this->data[1]);
        return "Du $debut au $fin";
        break;
    }
  }
}

?>
