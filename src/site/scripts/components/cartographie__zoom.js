cartographie.zoom = (function () {
  /*  permet de gérer le zoom sur la carte de manière simpliste :
      on peut tester le zoom et zoomer/dézoomer
      si les nodes ne remplisent pas assez ou trop la zone de la carte */
  "use strict";
  var composant = {};

  var ratio_cible = 0.75; // on souhaite que les nodes remplissent ce ratio de l'espace alloué à la carte

  var transform = {} // représentation objet de l'attribut transform

  var svg; // L'élément SVG, qui va remplir l'espace alloué
  var svg__g; // Le groupe qui va être transformé avec l'attribut transform

  var carte = {};
  carte.conteneur = {}; // on va stocker ici les infos sur le conteneur svg
  carte.nodes = {}; // et là celles sur le groupe de nodes

  composant.init = function () {
    /* initialisation du composant
    Void -> Void */

    // on récupère les composants qui nous intéressent
    svg =    document.querySelector('#carte > svg');
    svg__g = document.querySelector('#carte > svg > g');
    console.log(svg,svg__g);
    maj_transform();
    composant.adapter();
    //appliquer_maj();
    //cartographie.carte.tmp( transform );
  }

  composant.adapter = function () {
    /* adapte le zoom afin de remplir l'espace de la carte
    Void -> Void */

    // on met à jour notre représentation

    // on récupère les dimension de la carte
    carte.conteneur.BoundingClientRect = svg.getBoundingClientRect();
    carte.conteneur.hauteur = carte.conteneur.BoundingClientRect.height;
    carte.conteneur.largeur = carte.conteneur.BoundingClientRect.width;

    console.log(carte.conteneur);

    // on obtient la taille actuelle du groupe de nodes (hauteur/largeur)
    carte.nodes.BoundingClientRect = svg__g.getBoundingClientRect();
    carte.nodes.hauteur = carte.nodes.BoundingClientRect.height;
    carte.nodes.largeur = carte.nodes.BoundingClientRect.width;

    console.log(carte.nodes);

    // on détermine le plus gros ratio de remplissage pour savoir
    // si l'on se base sur la largeur ou la hauteur pour le zoom
    var ratio_hauteur = calculer_ratio ( carte.conteneur.hauteur, carte.nodes.hauteur );
    var ratio_largeur = calculer_ratio ( carte.conteneur.largeur, carte.nodes.largeur );

    // on calcule le zoom nécéssaire
    console.log(ratio_hauteur,ratio_largeur);
    console.log('échelle avant : ', transform.scale );
    var ratio_source = ratio_hauteur > ratio_largeur ? ratio_hauteur : ratio_largeur;
    recalculer_transform ( ratio_source );
    console.log ('échelle après : ', transform.scale );
    cartographie.carte.zoom( transform.scale );
  }

  composant.go = function () {
    /* tmp */
    maj_transform();
    console.log( 'rebuild : ' + transform );
  }

  composant.get_transform = function () {
    console.log( transform );
  }

  function calculer_ratio ( exterieur, interieur ) {
    /* calcule le ratio d'un élément intérieur par rapport à un élément extérieur */
    return interieur / exterieur;
  }

  function recalculer_transform ( ratio_source ) {
    /**/
    var multiplicateur = ratio_cible / ratio_source;

    transform.scale *= multiplicateur;

    var centre = {};

    centre.x = carte.conteneur.largeur / 2;
    centre.y = carte.conteneur.hauteur / 2;

    // ratio_cible
    // x = (x - center[0]) * factor + center[0];
    // y = (y - center[1]) * factor + center[1];
    transform.translate[0] = (transform.translate[0] - centre.x) * ratio_cible + centre.x;
    transform.translate[1] = (transform.translate[1] - centre.y) * ratio_cible + centre.y;

    //transform.translate[0] = -carte.conteneur.hauteur / 2 * multiplicateur + carte.conteneur.hauteur / 2;
    //transform.translate[1] = -carte.conteneur.largeur / 2 * multiplicateur + carte.conteneur.largeur / 2;
  }

  function maj_transform () {
    /* Met à jour la représentation objet de l'attribut transform */
    var attribut_transform = svg__g.getAttribute('transform');

    // si l'attribut n'est pas défini (null) on lui assigne une chaîne de caractères vide
    attribut_transform = attribut_transform ? attribut_transform : '';

    // on met à jour l'attribut transform avec les valeur constatées
    transform = parse( attribut_transform );

  }

  function appliquer_maj () {
    /**/
    svg__g.setAttribute ( 'transform', rebuild( transform ) );
  }

  function parse (a) {
    /* permet de parser la valeur de l'attribut transform
    src : https://stackoverflow.com/a/41101293/6215975
    String -> Object */
    try {
      var b = {};
      for (var i in a = a.match(/(\w+)\(([^,)]+),?([^)]+)?\)/gi)) {
          var c = a[i].match(/[\w\.\-]+/g);
          b[c.shift()] = parse_array(c);
      }
      // si l'échelle n'est pas précisée, on suppose qu'elle est de 1
      if ( !b.hasOwnProperty( 'scale' ) ) {
        b.scale = 1;
      }
      // si la translation n'est pas précisée, on suppose qu'elle est de [0,0]
      if ( !b.hasOwnProperty( 'translate' ) ) {
        b.translate = [0,0];
      }
      return b;
    } catch (e) {
      // plutôt qu'un objet vide on préremplie avec l'échelle par défaut : 1 et la translation par défaut : [0,0];
      return { scale:1, translate:[0,0] };
    }
  }

  function parse_array ( array ) {
    /*  sous-fonction pour parse : permet de passer les valeurs des arrays en float
    String Array -> Float Array */
    for (var i = 0; i < array.length; i++) {
      array[i] = parseFloat( array[i] );
    }
    return array;
  }

  function rebuild ( objet ) {
    /* Permet de reconstruire la valeur transform à partir d'un objet
    Object -> String */
    var sortie = '';
    for ( var propriete in objet ) {
      if ( objet.hasOwnProperty( propriete )) {
        sortie += propriete + '(';
        if ( typeof objet[propriete] === 'object' ) {
          for (var i = 0; i < objet[propriete].length; i++) {
            sortie += objet[propriete][i] + ',';
          }
          sortie = sortie.slice(0, -1);
        } else {
          sortie += objet[propriete];
        }
        sortie += ')';
      }
    }
    return sortie;
  }

  return composant;
})();
