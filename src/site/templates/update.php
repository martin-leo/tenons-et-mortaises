<?php
  /*  Script de mise à jour de la représentation JSON de la BDD
      Le JSON issu vise à l'affichage sur la carte pilotée par d3.js
      Les données représentées sont partielles :
      * thème
        * id
        * titre de l'article
        * enfants (children)
      * objet
        * +
        * date de publication tem
        * thème principal (theme_principal)
        * thèmes secondaires (themes_secondaires)
        * nature/template (nature de l'objet ou template si lien externe ou événement)
        * objets associés (related) (liste d'id)
      * événement
        * +
          * date de début
          * date de fin
  */
  function new_root(){
    /* Prépare l'objet racine et peuple le nœud-racine.
    Void -> Object */
    $root = new stdClass;
    $root->id = 0;
    $root->titre = 'TeM';
    $root->enfants = [];
    return $root;
  }

  function new_theme($theme) {
    /* Crée et retourne un nœud thème avec ses différentes propriétés.
    Page Object -> Object */
    $output = new stdClass;
    $output->id = $theme->id;
    $output->url = $theme->url;
    $output->titre = $theme->title;
    $output->enfants = [];
    return $output;
  }

  function new_object($objet) {
    /* Crée et retourne un nœud objet avec ses différentes propriétés.
    Page Object -> Object */
    $output = new stdClass;
    $output->id = $objet->id;
    $output->url = $objet->url;
    $output->titre = $objet->title;
    $output->date_de_publication_tem = $objet->date_de_publication_tem;

    if ($objet->date_de_debut) {
      $output->date_de_debut = $objet->date_de_debut;
    }

    if ($objet->date_de_fin) {
      $output->date_de_fin = $objet->date_de_fin;
    }

    $output->theme_principal = $objet->parent->id;

    if ($objet->nature) {
      $output->nature = $objet->nature->id;
    }

    $output->themes_secondaires = [];
    foreach ($objet->themes_secondaires as $theme_secondaire) {
      $output->themes_secondaires[] = $theme_secondaire->id;
    }

    if ($objet->children->count > 0) { // si l'objet à des enfants
      foreach ($objet->children as $satellite) {
        $output->enfants[] = new_object($satellite);
      }
    }

    if ($objet->objets_associes->count > 0) { // si objets associés
      foreach ($objet->objets_associes as $objet_associe) {
        $output->objets_associes[] = $objet_associe->id;
      }
    }

    //$output->objets_associes = $objet->related;
    return $output;
  }

  function process_themes($data){
    /* Liste les thèmes et les ajoutent aux enfants du nœud racine.
      Data object -> Void */
    $data->themes = $data->pages->get("/themes/")->children;
    foreach ($data->themes as $theme) {
      $data->root->enfants[] = new_theme( $data->pages->get($theme->id) );
    }
  }

  function process_objects($data){
    /* Pour chaque thème, en liste les enfants et les ajoute aux enfants dudit thème.
      Data object -> Void */
      $i = 0; // correspondance entre les thèmes fournis par $pages et le tableau $data-root->children
      foreach ($data->themes as $theme) {
        foreach ($theme->children as $objet) {
          $data->root->enfants[$i]->enfants[] = new_object($objet);
        }
      $i++; // on passe à l'objet suivant
      }
  }

  $data = new stdClass;
  $data->pages = $pages;
  $data->json = '';
  $data->root = new_root();
  process_themes($data);
  process_objects($data);

  /* conversion objet -> JSON */
  $data->json = json_encode($data->root, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

  /* écriture du json */
  $path = '../assets/files/data.json';
  $f = fopen($path, 'w');

  // pour virer les &#39;
  $data->json = str_replace("&#039;", "'", $data->json);

  fwrite($f, $data->json);
  fclose($f);

  echo 'La mise à jour des données s\'est correctement déroulée.';
?>
