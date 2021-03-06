interactions = (function() {
  /* Interactions avec la carte
  Void -> Object
  Méthode :
  * configure() : Liens aux données
  * mousedown() : timestamp de l'event mousedown pour calcul de la durée du clic
  * clic() : différencie clic court et clic pas court
  * afficher_infobulle() : affiche une infobulle relative à un node
  * enlever_infobulle() : reset et cache l'infobulle
  * highlight_network() : applique une classe css de higlight à un réseau de nodes
  * remove_nodes_hightlights() : supprime les classes css de highlight présentes
  */
  "use strict";
  var interactions = {};
  var network;
  var tem_data;

  // variable de stockage du timestamp lors d'un mousedown sur la carte
  var timestamp_mousedown;
  // durée entre un mousedown et mouseup en dessous de laquelle on considèrera qu'il s'agit d'un clic.
  var duree_pour_clic = 100;

  interactions.configure = function (_tem_data, _network) {
    /* Référencement de l'objet network pour usage par l'objet interactions
    Object -> Void */
    network = _network;
    tem_data = _tem_data;
  }

  interactions.mousedown = function () {
    /* Enregistre le timestamp lors d'un mousedown
    Void -> Void */
    timestamp_mousedown = Date.now();
  }

  interactions.clic = function () {
    /* Renvoie un booléen selon que la différence entre le timestamp enregistré lors du mousedown et inférieur ou non à la valeur paramétrée pour définir ce qui est de l'ordre du clic ou non
    Void -> Boolean */
    // si la différence excède le paramètre duree_pour_clic
    if ( Date.now() - timestamp_mousedown > duree_pour_clic) {
      // pas un 'clic chargement de contenu'
      return false;
    // dans le cas contraire
    } else {
      return true;
    }
  }

  interactions.afficher_infobulle = function (node) {
    /* affiche une infobulle avec des informations sur le node donné
    Object -> Void */
    infobulle.charger(node);
    infobulle.afficher();
    // positionner avant d'afficher peut générer un bug sur safari :
    // offsetWidth renvoie 0.
    infobulle.positionner(node.x, node.y);
  }

  interactions.enlever_infobulle = function () {
    /* Cache l'infobulle et met son contenu à zéro
    Void -> Void */
    infobulle.cacher();
    infobulle.mise_a_zero();
  };

  interactions.highlight_network = function (d) {
    /* applique une classe css de higlight à un réseau de nodes
    Object -> Void */
    // Si l'on est sur un objet
    if (d.level !== 1) {
      highlight(true, 'réseau');
      network.get_elements(tem_data.associations_liste, tem_data.associations_index, d, 1)
             .forEach(function (id) {
               try { document.getElementById(id).classList.add('highlighted'); }
               catch (e) {
                 //console.log('0',id);
                 id = id.split('-');
                 id = id[1] + '-' + id[0];
                 try { document.getElementById(id).classList.add('highlighted'); }
                 catch (e) { console.error('lien non trouvé :', id); }
               }
      });
    }
    // Si l'on est sur un thème
    if (d.level !== 2) {
      highlight(true, tem_data.nettoyer_chaine(d.titre));
    }
  }

  interactions.remove_nodes_hightlights =  function () {
    /* Permet de disabler le highlight
    Void -> Void */
    var highlighted = document.getElementsByClassName('highlighted');
    while (highlighted.length > 0) {
     highlighted.item(0).classList.remove('highlighted');
    }
    highlight(false);
  }

  function highlight(i, mode) {
    /* Prépare la carte pour la mise en avant de certains éléments
    Boolean -> Void */
    if (i) {
      //document.getElementById('carte').classList.add('highlighted');
      document.getElementById('carte').setAttribute('data-highlighted', mode);
    } else {
      //document.getElementById('carte').classList.remove('highlighted');
      document.getElementById('carte').removeAttribute('data-highlighted');
    }
  }

  return interactions;
})();
