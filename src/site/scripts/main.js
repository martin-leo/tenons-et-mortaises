/* Configuration et lancement de la cartographie dès téléchargement des données */

tem_data.import('/pw2/site/assets/files/data.json',[go]);
interactions.configure(tem_data,network);

function go () {
  tem_data.process();
  carte.setup(tem_data);
  carte.selections();
  carte.evenements();
}
