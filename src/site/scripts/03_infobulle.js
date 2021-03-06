var infobulle = (function(){
  /*
    Infobulle permmetant l'affichage dynamique d'informations
    relatives aux nœuds de la cartographie.
  */
  "use strict";

  // objet infobulle retourné par la fonction anonyme
  var infobulle = {};
  // l'infobulle injectée dans le DOM
  var bulle;
  // offset vertical de l'infobulle en pixels
  var offset_y = -10;
  // contenu lorsque vide
  var message_vide = '<h2>infobulle vide</h2><p>Pas de contenu survolé actuellement</p>';

  // constructeur appelé en fin de fonction
  var constructeur = function () {
    /* créé l'élément infobulle et l'insère dans le DOM
    Void -> Void */
    var a = document.createElement("section");
    a.setAttribute('id', 'infobulle');
    a.setAttribute('hidden', true);
    a.style.position = 'absolute';
    a.style.display = 'none';
    a.innerHTML = message_vide;
    bulle = document.body.appendChild(a);
  };

  infobulle.afficher = function () {
    /* affiche l'infobulle
    Void -> Void */
    bulle.removeAttribute('hidden');
    bulle.style.display = 'block';
  };

  infobulle.cacher = function () {
    /* cache l'infobulle
    Void -> Void */
    bulle.style.display = 'none';
    bulle.setAttribute('hidden', true);
  };

  infobulle.mise_a_zero = function () {
    /* Met l'info-bulle à zéro */
    bulle.innerHTML = message_vide;
  };

  infobulle.positionner = function (x, y) {
    /* positionne l'infobulle en regard des coordonnées en entrée
    Int, Int -> Void */
    // on applique les transformations du SVG
    x = (x * carte.transformations.scale) + carte.transformations.translate.x;
    y = (y * carte.transformations.scale) + carte.transformations.translate.y;
    // on centre en x et applique un offset en y
    x = x - bulle.offsetWidth/2;
    y = y - bulle.offsetHeight + offset_y * carte.transformations.scale;
    // on applique
    bulle.style.left = x + 'px';
    bulle.style.top = y + 'px';
  };

  infobulle.charger = function (node) {
    /* Modification du contenu de l'info-bulle
    String -> Void */
    var contenu = '<h1>' + node.titre +'</h1><p>publié le 02/07/16</p>';
    bulle.innerHTML = contenu;
  };

  // on appelle le constructeur
  constructeur();

  // on retourne l'objet
  return infobulle;
})();
