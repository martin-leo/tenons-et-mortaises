/* configuration UI */

ui.bouton_carte.initialiser();
ui.carte.initialiser();
ui.menu.initialiser();
ui.doc.initialiser();

/* Configuration et lancement de la cartographie dès téléchargement des données */

cartographie.tem_data.import('/pw2/site/assets/files/data.json',[go]);
cartographie.interactions.configure(cartographie.tem_data,cartographie.network);

function go () {
  cartographie.tem_data.process();
  cartographie.carte.setup(cartographie.tem_data);
  cartographie.carte.selections();
  cartographie.carte.evenements();
}


console.log(device);
