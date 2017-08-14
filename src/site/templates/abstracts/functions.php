<?

function obtenir_recursivement_champs ( $page, $selecteur ) {
  /* recherche de manière récursive,
  la valeur d'un champs donné pour une page.
  Par exemple la description si celle-ci a été omis : on prendra celle de l'élément parent.
  Page Object, String -> String */

  // on recherche la valeur du champ
  $champs = $page->get($selecteur);

  // si la valeur n'est pas une chaîne vide
  if ( $champs != '' ) {
    return $champs;

  // sinon, dans le cas on l'on a un parent
  } else if ($page->parent->title != null ) {

    // on recommence, récursivement
    return obtenir_recursivement_champs ( $page->parent, $selecteur );

  // sinon on renvoie une chaîne de caractère vide
  } else {
    return '';
  }
}

?>
