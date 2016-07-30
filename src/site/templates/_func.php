<?php
/*
  Fonctions partagées par les différents templates
*/

/*
  Note sur PW_Page, get_theme et extraction_donnees_complexes.
  Il ne s'agit pas de remplacer l'objet page mais de le compléter.
*/

class PW_Page {
  /* Représente un objet ProcessWire Page à travers les propriétés titre, url, id.
  echo utilisé avec un objet Theme renvoie l'objet Page sous forme de lien html. */
  public $titre, $url, $id;

  public function __construct($page) {
    /* Constructeur
    Page -> Void */
    $this->id = $page->id;
    $this->url = $page->url;
    $this->titre = $page->title;
  }

  public function __toString() {
    /* retourne un string HTML url+titre
    Void -> String */
    return "<a href='$this->url'>$this->titre</a>";
  }
}

function get_theme($page){
  /* Recherche l'objet Page correspondant au thème d'une page
  Page -> Page */
  if ($page->parent->template->name === 'theme') {
    return $page->parent;
  } else {
    return get_theme($page->parent);
  }
}

/* Extraction des données complexes */
function extraction_donnees_complexes($page) {
  /* Vise à extraire d'un et ajouter à un objet page
  des données plus complexes non accessibles directement.
  Page Object -> Void */
  /* ajout d'une propriété thème */
  $page->theme = new PW_Page(get_theme($page));
}

?>
