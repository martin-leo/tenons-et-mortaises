<?php

class Theme_secondaire extends Theme {
  /* Représente un thème secondaire d'un objet
    Le thème est soit l'objet ancêtre possédant un template thème le plus proche */

  public function __construct ( $theme_secondaire ) {
    /* Constructeur
    Page -> Void */

    // on fait le lien avec l'objet ParseDown Extra
    global $Markdown;

    $this->nom = $theme_secondaire->title;
    $this->texte = $Markdown->text($theme_secondaire->zone_de_texte);
    $this->url = $theme_secondaire->httpUrl;
  }
}

?>
