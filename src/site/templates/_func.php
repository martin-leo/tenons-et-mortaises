<?php
/*
  Fonctions partagées par les différents templates
*/

class PW_Page {
  /* Représente un objet ProcessWire Page à travers les propriétés titre, url, id.
  echo utilisé avec un objet Theme renvoie l'objet Page sous forme de lien html. */
  public $titre, $url, $id;

  public function __construct($page) {
    $this->id = $page->id;
    $this->url = $page->url;
    $this->titre = $page->title;
  }

  public function __toString() {
    return "<a href='$this->url'>$this->titre</a>";
  }
}

function get_theme($page){
  /* Recherche le l'objet Page correspondant au thème d'une page
  Page -> Page */
  if ($page->parent->template->name === 'theme') {
    return $page->parent;
  } else {
    return get_theme($page->parent);
  }
}

/* Extraction des données complexes */
function extraction_donnees_complexes($page) {
  /*
  Page Object -> Void */
  $page->theme = new PW_Page(get_theme($page));
}

?>
