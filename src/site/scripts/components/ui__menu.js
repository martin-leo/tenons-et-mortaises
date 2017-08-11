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
      composant.activer();
      composant.actif = false;
    } else {
      composant.desactiver();
      composant.actif = true;
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
    // console.log('ajout_des_ecouteurs', ui.elements.menu);
    ui.elements.menu.addEventListener('mouseover', mouseover, false);
    ui.elements.menu.addEventListener('mouseleave', mouseleave, false);

    // gestion du boutons menu sur mobile (le bouton carte à son propre composant)
    ui.elements.bouton_menu.addEventListener('click', click, false);
  }

  function mouseover ( evenement ) {
    // console.log ( evenement );
    evenement.preventDefault();
    composant.activer();
  }

  function mouseleave ( evenement ) {
    // console.log ( evenement );
    evenement.preventDefault();
    composant.desactiver()
  }

  function click ( evenement ) {
    // console.log ( evenement );
    evenement.preventDefault();
    composant.basculer()
  }



  composant.initialiser = function () {
    /* initialise le composant */
    ajout_des_ecouteurs();
  };

  return composant;
})();
