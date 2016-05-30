var carte = (function () {
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
  var graph; // référence à l'objet tem_data

  // layout & behaviour d3js
  var force;

  // sélection d'éléments d3js
  var carte;
  var svg;
  var zoom;
  var conteneur;

  // graph
  var graph = {};

  // variables
  var width;
  var height;

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
    if (d.level === 1) classes += tem_data.nettoyer_chaine(d.titre) + ' ';
    else classes += tem_data.nettoyer_chaine(tem_data.index[d.theme_principal].titre);
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
  }

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
    // defs (marqueurs pour fléchage)
    // début
    var defs = svg.append('defs')
    defs.append("marker").attr('id', 'pointe-debut')
                         .attr('orient', 'auto')
                         .attr('markerHeight', '6')
                         .attr('markerWidth', '6')
                         .attr('refX', '-15')
                         .attr('viewBox', '-10 -5 10 10')
                         .attr('orient', 'auto')
                         .append("path")
                           .attr('d', 'M0,-5L-10,0L0,5')
    // fin
    defs.append("marker").attr('id', 'pointe-fin')
                         .attr('orient', 'auto')
                         .attr('markerHeight', '6')
                         .attr('markerWidth', '6')
                         .attr('refX', '15')
                         .attr('viewBox', '0 -5 10 10')
                         .attr('orient', 'auto')
                         .append("path")
                           .attr('d', 'M0,-5L10,0L0,5')
    // création du zoom
    zoom = d3.behavior.zoom().scaleExtent([zoom_min, zoom_max])
    // création d'un conteneur dans svg et stockage dans var conteneur
    conteneur = svg.append("g");
  }

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
  }

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

    objet_carte.selections.nodes.on("mousedown", function(d) {
      d3.event.stopPropagation();
      interactions.echo(d);
    });

    objet_carte.selections.nodes.on("mouseenter", function(d) {
      d3.event.stopPropagation();
      interactions.echo(d);
      interactions.highlight_network(d);
    });

    objet_carte.selections.nodes.on("mouseout", function(d) {
      interactions.remove_nodes_hightlights();
    });

    zoom.on("zoom", function() {
      /* Application du zoom du zoom */
      conteneur.attr("transform", "translate(" + d3.event.translate + ")scale(" + d3.event.scale + ")");
    });

    svg.call(zoom); // on applique le zoom à l'objet svg

    // au resize de la fenêtre on appelle la fonction dédiée
    d3.select(window).on("resize", objet_carte.resize);
  }

  return objet_carte;
})();
