<?php
/*
  Fonctions partagées par les différents templates
*/

class Theme {
  /* Représente un thème à travers les propriétés titre, url, id.
  echo utilisé avec un objet Theme renvoie le thème sous forme de lien html. */
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

class Liste_themes {
  /* Représente une liste de thème via la propriété $liste.
  echo utilisé avec un objet Liste_themes renvoie une liste
  de classe themes-secondaires contenant les différents thèmes.
  */
  public $liste;

  public function __construct($id_list) {
    $this->liste = [];
    foreach ($id_list as $id) {
      if (!is_null($id)) {
        $this->liste[] = new Theme(wire('pages')->get(strval($id)));
      }
    }
  }

  public function __tostring() {
    $output = '<ul class="themes-secondaires">';
    foreach ($this->liste as $theme) {
      $output .= "<li>$theme</li>";
    }
    $output .= '</ul>';
    return $output;
  }
}

function process_themes_associes($id_list){
  /* retourne une liste d'objets thèmes
  avec leur propriétés id, url et titre */
  $themes = [];
  foreach ($id_list as $id) {
    if (!is_null($id)) {
      $themes[] = new Theme(wire('pages')->get(strval($id)));
      // $themes[] = generer_theme(wire('pages')->get(strval($id)));
      /* note : échec avec $pages et sans strval */
    }
  }
  return $themes;
}

/* Extraction des données les plus basiques (id, titre, template)*/
function extraction_donnees_basiques($page, $data) {
  /* Extrait les données de base de tout objet $page.
  - id de la page
  - titre
  - template
  Page Object, Standard Object -> Void */
  $data->id = $page->id;
  $data->titre = $page->title;
  $data->template = $page->template;
}

/* Extraction des données du modèle de base */
function extraction_donnees_generique($page, $data) {
  /* Extrait les données correspondant au template générique
  de l'objet $page vers l'objet $data.
  Page Object, Standard Object -> Void */
  $data->date_de_publication_tem = $page->date_de_publication_tem;
  $data->contenu = $page->contenu;
  $data->theme = new Theme($page->parent); // todo : attention au cas des objets satellites et sous-événements !
  //$data->themes_secondaires = process_themes_associes($page->themes_secondaires);
  $data->themes_secondaires = new Liste_themes($page->themes_secondaires);
  $data->objets_associes = $page->objets_associes;
  $data->image_principale = $page->image_principale;
  $data->images = $page->images;
  $data->zone_de_texte = $page->zone_de_texte;
}

?>
