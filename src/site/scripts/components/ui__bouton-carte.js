ui.bouton_carte = (function(){
  /* composant carte */
  var composant = {};


  function ajout_des_ecouteurs () {
    /* ajoute les écouteurs à l'élément HTML bouton carte :
        * clic : basculer carte
    */
    ui.elements.bouton_carte.addEventListener('click', ui.carte.basculer , false);
  }

  composant.on = function () {
    /* bouton apparence on */
    ui.elements.bouton_carte.innerHTML = ui.elements.bouton_carte.getAttribute('data-pictogramme--on');
  };

  composant.off = function () {
    /* bouton apparence off */
    ui.elements.bouton_carte.innerHTML = ui.elements.bouton_carte.getAttribute('data-pictogramme--off');
  };

  composant.initialiser = function () {
    /* initialise le composant */
    ajout_des_ecouteurs();

    // on initialise l'attribut data-pictogramme--on
    console.log(ui.elements.bouton_carte.innerHTML);
    ui.elements.bouton_carte.setAttribute('data-pictogramme--on', ui.elements.bouton_carte.innerHTML);
  };

  return composant;
})();
