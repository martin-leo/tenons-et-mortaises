<?php
include_once("./abstracts/initialisation.php");
include_once("./abstracts/classes.php");
include_once("./abstracts/functions.php");

$head__scripts = "<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?sensor=false'></script>";

include_once("./controllers/pages/evenement.php");

include_once("./views/common/header.php"); // header

include_once("./views/common/carte.php");
include_once("./views/common/menu.php");
include_once("./views/pages/evenement.php");

include_once("./views/common/footer.php"); // footer
?>
