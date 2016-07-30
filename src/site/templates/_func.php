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
  $page->test = test;
}

/* Note : si j'inverse l'ordre de imprimer_themes et imprimer_themes_secondaires
L'appel à imprimer_themes appelle en fait imprimer_themes_secondaires : WTF ?*/

class PW_Tools {
  /*  */
  // pour référence à l'objet Markdown
  public $Extra;

  public function __construct() {
    /* Constructeur
    Page -> Void */
    // On met en place l'accès à la variable globale
    global $Extra;
    // On créé la référence
    $this->Extra = $Extra;
  }

  public function determiner_nature($page) {
    /* Renvoie la nature d'un objet
    Page -> String */
    if ($page->nature->title) {
      return $page->nature->title;
    } else if ($page->template == "evenement") {
      return "événement";
    } else {
      return "nature non déterminée"; // todo
    }
  }


  public function imprimer_auteurs($page) {
    /* Imprime les auteurs d'un objet
    Page -> Void */
    echo "<ul>";
    if ($page->auteurs) {
      foreach ($page->auteurs as $auteur) {
        echo "<li>$auteur->auteur</li>";
      }
    }
    echo "</ul>";
  }

  public function imprimer_themes_secondaires($page) {
    /*
    Page -> Void */
    if ($page->themes_secondaires->count > 0) {
    echo "<section>";
      echo "<h4>Thèmes secondaires</h4>";
      echo "<ul>";
        foreach ($page->themes_secondaires as $theme) {
          echo "<li><a href='$theme->url'>$theme->title</a></li>";
        }
      echo "</ul>";
    echo "</section>";
    }
  }

  public function imprimer_themes($page) {
    /* Imprime les thèmes associés à une page
    Page -> Void */
    echo "<section>";
      $themes = ($page->themes_secondaires->count > 0) ? true : false;
      if ($themes) {
        echo "<h3>Thèmes</h3>";
      } else {
        echo "<h3>Thème</h3>";
      }
      echo "<section>";
        echo "<h4>Thème principal</h4>";
        echo $page->theme;
        $this->imprimer_themes_secondaires($page);
      echo "</section>";
    echo "</section>";
  }

  public function imprimer_objets_associes($page) {
    /* Imprime les objets associés à une page
    Page -> Void */
    if ( $page->objets_associes->count > 0 ) {
      echo "<section>";
        echo "<h3>Objets Associés</h3>";
        echo "<ul>";
        foreach ($page->objets_associes as $objet) {
          print_r($objet->nature);
          echo "<li>";
          echo "<a href='$objet->url'>";
          echo "<section>";
          echo "<p>".$this->determiner_nature($objet)." ajouté le ".date("d/m/Y.",$objet->date_de_publication_tem)."</p>";
          echo "<h4>$objet->title</h4>";
          echo "</section>";
          echo "</a>";
          echo "</a></li>";
        };
        echo "</ul>";
      echo "</section>";
    }
  }

  public function imprimer_satellites($page) {
    /* Imprime les satellites associés à une page
    Page -> Void */
    if ( $page->children->count > 0 ) {
      echo "<section>";
        echo "<h3>satellites</h3>";
        echo "<ul>";
        foreach ($page->children as $child) {
          echo "<li><a href='{$child->url}'>{$child->title}</a></li>";
        };
        echo "</ul>";
      echo "</section>";
    }
  }

  public function date_tem($page) {
    /* Imprime la date de publication TeM
    Page -> Void */
    if ($page->date_de_publication_tem) {
      echo "<p>";
        echo "le ".date("d/m/Y.",$page->date_de_publication_tem);
      echo "</p>";
    };
  }

  public function imprimer_dates_et_origine($page) {
    /* Imprime la date de publication, éventuellement l'origine de l'objet ainsi que la date originelle de publication
    Page -> Void */
    echo "<p>";
    $origine = $page->origine ? true : false;
    $date_de_publication_originale = $page->date_de_publication_originale ? true : false;
    echo "publication originale : ";
    if ($page->origine) {
      echo substr($this->Extra->text($page->origine), 3, -4); // on strip le <p></p>
    }
    if ($page->origine && $page->date_de_publication_originale) {
      echo " le ";
    };
    if ($page->date_de_publication_originale) {
      echo date("d/m/Y.",$page->date_de_publication_originale);
    };
    echo "</p>";
  }
}

?>
