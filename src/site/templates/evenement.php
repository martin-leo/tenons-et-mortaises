<?php
include_once("./_init.php");
include_once("./_func.php");

$scripts = "<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?sensor=false'></script>";

include_once("./view/common/v_header.php"); // header

include_once("./controller/pages/c_evenement.php"); // controller
include_once("./view/pages/v_evenement.php"); // view

include_once("./view/common/v_footer.php"); // footer
?>
