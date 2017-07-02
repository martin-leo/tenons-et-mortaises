cartographie.carte = (function () {
  /*
    Cartographie
    Void -> Object

    * Méthodes :
      * resize() : gestion du resize, à appeler dès que #carte est redimensionné (un écouteur est présent sur window)
      * setup() : mise en place de la structure
      * selections() : génère les sélections
      * evenements() : déclaration des événements
    * Propriétés :
      * selections.nodes : sélection d3 des nœeuds

  * 1. Déclaration des variables
  * 2. Fonctions utiles
  * 3. Setup
  * 4. Sélections
  * 5. Événements

  TODO :
   * interactions
    * au mouseover sur un node
      * tooltip
  */
  "use strict";

  /* ----------
    1. Déclaration des variables
  ---------- */

  // objet retourné par la fonction anonyme
  var objet_carte = {};

  objet_carte.selections = {};

  // layout & behaviour d3js
  var force;

  // sélection d'éléments d3js
  var carte;
  var svg;
  var zoom;
  var conteneur;

  // graph
  var graph = {}; // référence à l'objet tem_data

  // variables
  var width;
  var height;

  // transformations appliquées à la carte
  objet_carte.transformations = {};
  objet_carte.transformations.scale = 1;
  objet_carte.transformations.translate = {};
  objet_carte.transformations.translate.x = 0;
  objet_carte.transformations.translate.y = 0;

  // paramètres
  var zoom_min = 0.1;
  var zoom_max = 7;
  var charge = -50;

  var node_taille_base = 4;
  var node_taille_coeff = 6;

  var link_distance_diviseur = 32; // relatif à la taille de l'écran
  var link_distance_coeff = 10;
  var link_distance_minimum = 15;

  carte = document.getElementById('carte');

  /* ----------
    2. Fonctions utiles
  ---------- */

  function link_distance(d){
    /* Différenciation des tailles de liens
    -> liens racine -> thème
    -> liens thème -> objet
    -> liens d'association
    Object -> Number */

    //width = carte.clientWidth;
    //height = carte.clientHeight;

    var etalon = width > height ? height : width;
    var minimum = link_distance_minimum;
    etalon /= link_distance_diviseur;
    if (d.nature === "parenté") {
      // liens de parenté
      if (d.source.level === 0) {
        // liens racine -> thème
        return minimum < etalon ? 3 * etalon : 3 * minimum;
      } else {
        // liens thème -> objet
        return minimum < etalon ? 1.5 * etalon : 1.5 * minimum;
      }
    } else {
      // liens d'association
      return minimum < etalon ? etalon : minimum;
    }
  }

  function link_id(d) {
    /* Renvoie un id.
    Object -> String */
    return d.source.id + '-' + d.target.id;
  }

  function link_classes(d) {
    /* Renvoie un String où sont concaténées toutes les classes à appliquer au lien (éléments line)
    Object -> String */
    var classes = '';

    if (d.nature === 'parenté') {
      classes += 'link parente n' + d.source.level;
    } else {
      classes += 'link association n' + d.source.level;
      classes += d.theme_principal ? ' theme_' + d.theme_principal : '';
    }
    return classes;
  }

  function node_classes(d) {
    /* Renvoie un String où sont concaténées toutes les classes à appliquer au node (élements g)
    Object -> String */
    var classes = '';
    classes +='node n' + d.level + ' ';
    if (d.level === 1) classes += cartographie.tem_data.nettoyer_chaine(d.titre) + ' ';
    else classes += cartographie.tem_data.nettoyer_chaine(cartographie.tem_data.index[d.theme_principal].titre);
    // classes += d.theme_principal ? 'theme_' + d.theme_principal + ' ': '';
    return classes;
  }

  function node_id(d) {
    /* Renvoie un id.
    Object -> String */
    return 'node_' + d.id;
  }

  function node_size(d) {
    /* Renvoie la taille souhaitée du node selon son niveau */
    return node_taille_base + (2 - d.level) * node_taille_coeff;
  }

  function maj_dimensions() {
    /* Met à jour les variables width et height
    Void -> Void */
    width = carte.clientWidth;
    height = carte.clientHeight;
  }

  objet_carte.resize = function () {
    /* Procède au resize et adapte le zoom selon */
    var W = carte.clientWidth;
    var H = carte.clientHeight;

    // édition des attributs de svg
    svg.attr("width", W).attr("height", H);

    // recalcule de la taille
    // note : cola.d3adaptor ne dispose pas de la méthode .resume()
    // on utilise donc start()
    force.size([force.size()[0] + (W - width) / zoom.scale(), force.size()[1] + (H - height) / zoom.scale()]).start();

    // on enregistre les nouvelles dimensions
    maj_dimensions();
  };

  /* ----------
  3. Setup
  ---------- */

  objet_carte.setup = function (data) {
    /* Référencement des données et mise en place du layout
    Object -> Void */
    graph = data;
    maj_dimensions();

    force = cola.d3adaptor()// d3.layout.force()
      .linkDistance(link_distance)
      .size([width, height])
      .nodes(graph.nodes)
      .links(graph.links)
      .start();

    // sélection côté svg : objet svg appendé à body
    svg = d3.select("#carte").append("svg").attr("width", width).attr("height", height);
    // création du zoom
    zoom = d3.behavior.zoom().scaleExtent([zoom_min, zoom_max]);
    // création d'un conteneur dans svg et stockage dans var conteneur
    conteneur = svg.append("g");
  };

  /* ----------
  4. Sélections
  ---------- */

  objet_carte.selections = function () {
    /* On génère les différentes sélections
    Void -> Void */
    objet_carte.selections.links = conteneur.selectAll('.link')
      .data(graph.links) // association des données
      .enter().append('line') // pour les donnée entrantes (toutes), on ajoute une line au graph
      .attr('id', link_id) // on leur met un id (si lien associatif)
      .attr('class', link_classes) // on leur met la classe link
    objet_carte.selections.nodes = conteneur.selectAll(".node")
      .data(graph.nodes) // bind des datas
      .enter().append("g")
      .attr('class', node_classes)
      .attr('id', node_id)
      .append('circle').attr('r', node_size)
      .call(force.drag) // force drag (redondant avec le zoom ?)
    objet_carte.selections.associations = conteneur.selectAll(".association")
      .attr('marker-end', 'url(#pointe-fin)');
  };

  /* ----------
  5. Événements
  ---------- */

  objet_carte.evenements = function () {
    /* Déclaration des écouteurs d'événements
    Void -> Void */
    force.on("tick", function() {
      /* Fonction d'animation */

      // nodes
      objet_carte.selections.nodes.attr("transform", function(d) {
        return "translate(" + d.x + "," + d.y + ")";
      });

    // on met à jour les liens
    objet_carte.selections.links.attr('x1', function(d) { return d.source.x; })
        .attr('y1', function(d) { return d.source.y; })
        .attr('x2', function(d) { return d.target.x; })
        .attr('y2', function(d) { return d.target.y; });

    });

    // si on est sur un device tactile
    if (device.touch) {
      /* Trois événements à gérer en cas de device tactile :
      1. clic sur la carte hors-node : fermeture et reset de l'infobulle si ouverte
      2. clic sur un node : placement et ouverture de l'infobulle avec affichage du contenu correspondant
      3. clic sur l'infobulle : chargement du contenu correspondant */

      /* 1. clic sur la carte hors-node */
      document.getElementById("carte").addEventListener('mouseup', function(e) {
        /* lors d'un clic sur la carte, deux cas de figure :
          - clic sur un élément avec un tagname svg ou line : on ferme l'info-bulle si elle est ouvert
          - clic sur un élément avec un tagname circle : on ne fait rien, la gestion de l'infobulle dans ce cas est gérée par d3
        */
        if ( e.target.tagName !== 'circle' ) {
          // clic par sur un node
          cartographie.interactions.enlever_infobulle();
        }
      }, false);
      /* 2. Clic sur un node */
      objet_carte.selections.nodes.on("mousedown", function(d) {
        /* Lors d'un tap sur un node on affiche l'infobulle correspondante */
        cartographie.interactions.afficher_infobulle(d);
      });
      /* 3. Clic sur l'infobulle */
      document.getElementById('infobulle').addEventListener('mouseup', function(e) {
        console.log('clic sur infobulle, chargement de contenu à implémenter');
      }, false);
    } else {
      /* 3 cas de figure en cas de device non tactile :
        1. Survol d'un node = affichage d'une infobulle + mise en avant du réseau associé
        2. Clic court d'un node = chargement du contenu dans la page ou
        3. clic long = drag du node ET de l'infobulle */

      /* 1. lors du survol d'un node */
      // au début du survol
      objet_carte.selections.nodes.on("mouseenter", function(d) {
        d3.event.stopPropagation();
        cartographie.interactions.afficher_infobulle(d);
        cartographie.interactions.highlight_network(d);
      });
      // à la fin du survol d'un node
      objet_carte.selections.nodes.on("mouseout", function(d) {
        cartographie.interactions.enlever_infobulle();
        cartographie.interactions.remove_nodes_hightlights();
      });

      /* 2. clic court sur un node */
      objet_carte.selections.nodes.on("mouseup", function(d) {
        // pas de d3.event.stopPropagation(); ici ! Sinon bug !
        // 1. clic court = chargement de contenu
        if ( cartographie.interactions.clic() ) {
          ui.doc.charger(d.id);
        }
        // on enlève l'écouteur pour le drag s'il n'y a pas eu de drag
        objet_carte.selections.nodes.on("mousemove", null);
      });

      /* 3. clics longs sur un node */

      objet_carte.selections.nodes.on("mousedown", function(d) {
        d3.event.stopPropagation();
        // on log le début du clic pour le mesurer
        cartographie.interactions.mousedown();
        // si drag
        objet_carte.selections.nodes.on("mousemove",function(){
          cartographie.interactions.enlever_infobulle();
          // on enlève l'écouteur pour le faire qu'un fois
          objet_carte.selections.nodes.on("mousemove", null);
        });
      });

    }

    zoom.on("zoom", function() {
      /* Application du zoom
      Void -> Void */

      // variables de travail
      var translate = d3.event.translate;
      var scale = d3.event.scale;

      // on enregistre les infos dans une propriété
      objet_carte.transformations.scale = scale;
      objet_carte.transformations.translate = {};
      objet_carte.transformations.translate.x = translate[0];
      objet_carte.transformations.translate.y = translate[1];

      // on applique
      conteneur.attr("transform", "translate(" + translate + ")scale(" + scale + ")");
    });

    svg.call(zoom); // on applique le zoom à l'objet svg

    // au resize de la fenêtre on appelle la fonction dédiée
    d3.select(window).on("resize", objet_carte.resize);
  };

  return objet_carte;
})();
