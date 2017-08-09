ui.infobulle = (function(){
  /*
    Infobulle permmetant l'affichage dynamique d'informations
    relatives aux nœuds de la cartographie.
  */
  "use strict";

  // objet infobulle retourné par la fonction anonyme
  var composant = {};
  // l'infobulle injectée dans le DOM
  var infobulle = {};
  // offset vertical de l'infobulle en pixels
  var offset_y = -10;

  // constructeur appelé en fin de fonction
  var constructeur = function () {
    /* créé l'élément infobulle et l'insère dans le DOM
    Void -> Void */
    infobulle.element = document.createElement("section");
    infobulle.titre = document.createElement("h2");
    infobulle.texte = document.createElement("p");

    infobulle.titre.classList.add('infobulle__titre');
    infobulle.texte.classList.add('infobulle__texte');

    infobulle.element.setAttribute('id', 'infobulle');
    infobulle.element.classList.add('infobulle');
    infobulle.element.setAttribute('hidden', true);
    infobulle.element.style.position = 'absolute';
    infobulle.element.style.display = 'none';

    infobulle.element.appendChild( infobulle.titre );
    infobulle.element.appendChild( infobulle.texte );
    document.body.appendChild( infobulle.element );

    composant.mise_a_zero();
  };

  composant.afficher = function () {
    /* affiche l'infobulle
    Void -> Void */
    infobulle.element.removeAttribute('hidden');
    infobulle.element.style.display = 'block';
  };

  composant.cacher = function () {
    /* cache l'infobulle
    Void -> Void */
    infobulle.element.style.display = 'none';
    infobulle.element.setAttribute('hidden', true);
  };

  composant.mise_a_zero = function () {
    /* Met l'info-bulle à zéro */
    infobulle.titre.innerHTML = "infobulle vide";
    infobulle.texte.innerHTML = "Pas de contenu survolé actuellement";
  };

  composant.positionner = function (x, y) {
    /* positionne l'infobulle en regard des coordonnées en entrée
    Int, Int -> Void */
    // on applique les transformations du SVG
    x = (x * cartographie.carte.transformations.scale) + cartographie.carte.transformations.translate.x;
    y = (y * cartographie.carte.transformations.scale) + cartographie.carte.transformations.translate.y;
    // on centre en x et applique un offset en y
    x = x - infobulle.element.offsetWidth/2;
    y = y - infobulle.element.offsetHeight + offset_y * cartographie.carte.transformations.scale;
    // on applique
    infobulle.element.style.left = x + 'px';
    infobulle.element.style.top = y + 'px';
  };

  composant.charger = function (node) {
    /* Modification du contenu de l'info-bulle
    String -> Void */
    infobulle.titre.innerHTML = node.titre;
    if ( node.date ) {
      infobulle.texte.classList.add( 'infobulle__texte' );
      infobulle.texte.classList.remove( 'infobulle__texte--vide' );
      infobulle.texte.innerHTML = node.date;
    } else {
      infobulle.texte.classList.add( 'infobulle__texte--vide' );
      infobulle.texte.classList.remove( 'infobulle__texte' );
      infobulle.texte.innerHTML = "pas de date associée";
    }
  };

  // on appelle le constructeur
  constructeur();

  // on retourne l'objet
  return composant;
})();
