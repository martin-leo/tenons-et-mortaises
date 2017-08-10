ui.carte = (function(){
  /* composant carte */
  var composant = {};

  var chargement = document.getElementById( "carte__chargement" );

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

  composant.etat = function ( etat ) {
    /* permet de gérer le texte de chargement : modifie le contenu ainsi que les classes pour en modifier l'aspect.
    String -> Void */
    switch ( etat ) {
      case "chargement":
        chargement.innerHTML = '<p>chargement</p>';
        chargement.classList.add( 'carte__chargement--chargement' );
        chargement.classList.remove( 'carte__chargement' );
        break;
      case "chargé":
        chargement.classList.add( 'carte__chargement--charge' );
        chargement.innerHTML = '<p>carte chargée</p>';
        chargement.classList.remove( 'carte__chargement--chargement' );
        break;
      case "erreur":
        chargement.innerHTML = '<p>erreur lors du chargement de la page</p>';
        chargement.classList.add( 'carte__chargement--erreur' );
        chargement.classList.remove( 'carte__chargement--chargement' );
        break;
      default:
        console.warn( 'erreur : etat inconnu' );
    }
  }

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
