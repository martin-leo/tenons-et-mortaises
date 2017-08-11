ui.bouton_carte = (function(){
  /* composant carte */
  var composant = {};


  function ajout_des_ecouteurs () {
    /* ajoute les écouteurs à l'élément HTML bouton carte :
        * clic : basculer carte
    */
    ui.elements.bouton_carte.addEventListener('touchend', touch , false);
    ui.elements.bouton_carte.addEventListener('click', touch , false);
  }

  function touch ( evenement ) {
    /*  */
    //console.log( evenement );
    evenement.preventDefault();
    ui.carte.basculer();
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

    if ( ui.elements.carte.classList.contains( 'active' ) ) {
      composant.off();
    } else {
      composant.on();
    }
  };

  return composant;
})();
