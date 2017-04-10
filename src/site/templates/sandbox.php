<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sand Box</title>
  <script src="../site/assets/js/d3.js"></script>
</head>
<body>
<!-- content -->
<script>
var json;
var chemin = '../site/assets/files/data.json';
d3.json(chemin, function(erreur, _json) {
      /* Chargement du JSON */
      if (erreur) {
        console.error('Erreur lors du chargement des données depuis ' + chemin + '.');
        console.log('erreur renvoyée :', erreur);
      } else {
        json = _json;
        do_this();
      }
    });
function do_this(){
  console.log(json);
}
</script>
</body>
</html>
