var doc = (function(){
  /* Gestion du document */
  var doc = {};

  doc.charger = function (id) {
    /* charge l'article demandé dans le document
    String -> Void */
    console.log('demande de chargement de l\'objet ', id);
  };

  return doc;
})();
