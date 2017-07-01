var layout = (function(){
  /* Gère les éléments actifs : carte, menu, contenu
  Void -> Object
  L'activation/désactivation se fait via la classe 'active' */

  var composant = {};

  // les éléments
  var carte = document.getElementById('carte');
  var menu = document.getElementById('menu');
  var contenu = document.getElementById('contenu');

  // la classe
  var classe_active = 'active';

  // événements carte et contenu
  carte.addEventListener('mouseenter', activer, false);
  contenu.addEventListener('mouseenter', activer, false);

  // événement menu
  menu.addEventListener('mouseenter', activer_menu, false);
  menu.addEventListener('mouseleave', desactiver_menu, false);

  function activer ( e ) {
    /* active carte ou contenu
    Object (event) -> Void  */
    carte.classList.remove( classe_active );
    contenu.classList.remove( classe_active );
    e.target.classList.add( classe_active );
  }

  function activer_menu () {
    /* active le menu
    Void -> Void  */
    menu.classList.add( classe_active );
  }

  function desactiver_menu ( e ) {
    /* désactive le menu
    Void -> Void  */
    menu.classList.remove( classe_active );
  }

  composant.activer_contenu = function () {
    /* passe le contenu en mode actif */
    carte.classList.remove( classe_active );
    contenu.classList.add( classe_active );
  };

  return composant;
})();
