ui.menu = (function(){
  /* composant carte */
  var composant = {};

  // composant actif ?
  composant.actif = false;

  composant.activer = function () {
    /* ajoute la classe 'active' à l'élément HTML menu */
    ui.elements.menu.classList.add('active');
    composant.actif = true;
  };

  composant.desactiver = function () {
    /* enlève la classe 'active' de l'élément HTML menu */
    ui.elements.menu.classList.remove('active');
    composant.actif = false;
  };

  composant.basculer = function () {
    /* bascule entre activé/désactiver */

    if ( composant.actif ) {
      composant.desactiver();
    } else {
      composant.activer();
    }

  };

  function clic_bouton_carte ( e ) {
    /* lors du clic sur le bouton carte : bascule de la carte et du picto */
    ui.carte.basculer();

  }

  function intervertir_pictogrammes ( e ) {
    /* tente d'intervertir le pictogramme d'un bouton
    var nouveau_picto = e.target.dataset.pictogrammeFermer;

    if ( nouveau_picto ) {
      e.target.dataset.pictogrammeFermerAlt = e.target.innerHTML;
      e.target.innerHTML = nouveau_picto;
    } */
  }

  function ajout_des_ecouteurs () {
    /* ajoute les écouteurs à l'élément HTML carte :
        * activation au survol
    */
    ui.elements.menu.addEventListener('mouseover', composant.activer, false);
    ui.elements.menu.addEventListener('mouseleave', composant.desactiver, false);

    // gestion du boutons menu sur mobile (le bouton carte à son propre composant)
    ui.elements.bouton_menu.addEventListener('click', composant.basculer, false);
  }

  composant.initialiser = function () {
    /* initialise le composant */
    ajout_des_ecouteurs();
  };

  return composant;
})();
