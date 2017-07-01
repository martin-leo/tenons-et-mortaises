ui.carte = (function(){
  /* composant carte */
  var composant = {};

  // composant actif ?
  composant.actif = false;

  composant.activer = function () {
    /* ajoute la classe 'active' à l'élément HTML carte et l'enlève de l'élément document */
    ui.elements.carte.classList.add('active');
    ui.doc.desactiver();
    ui.bouton_carte.off();
    composant.actif = true;
  };

  composant.desactiver = function () {
    /* enlève la classe 'active' de l'élément HTML carte */
    ui.elements.carte.classList.remove('active');
    ui.bouton_carte.on();
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

  function ajout_des_ecouteurs () {
    /* ajoute les écouteurs à l'élément HTML carte :
        * activation au survol
    */
    ui.elements.carte.addEventListener('mouseover', composant.activer, false);
  }

  composant.initialiser = function () {
    /* initialise le composant */
    ajout_des_ecouteurs();
  };

  return composant;
})();
