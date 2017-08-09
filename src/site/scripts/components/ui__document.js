ui.doc = (function(){
  /* composant carte */
  var composant = {};

  // composant actif ?
  composant.actif = false;

  composant.activer = function () {
    /* ajoute la classe 'active' à l'élément HTML document et l'enlève de l'élément carte */
    ui.elements.doc.classList.add('active');
    ui.carte.desactiver();
    composant.actif = true;
  };

  composant.desactiver = function () {
    /* enlève la classe 'active' de l'élément HTML document */
    ui.elements.doc.classList.remove('active');
    composant.actif = false;
  };

  composant.charger = function ( id ) {
    /* charge le contenu d'une autre page dans la page actuelle */
    console.log('demande de chargement de l\'objet ', id);
    //ui.infobulle.cacher();
    //layout.activer_contenu();
  };

  function ajout_des_ecouteurs () {
    /* ajoute les écouteurs à l'élément HTML document :
        * activation au survol
    */
    ui.elements.doc.addEventListener('mouseover', composant.activer, false);
  }

  composant.initialiser = function () {
    /* initialise le composant */
    ajout_des_ecouteurs();

    // activé par défaut
    // composant.activer();
  };

  return composant;
})();
