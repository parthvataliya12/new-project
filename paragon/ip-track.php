<?php
include('connect.php');

$HideCountry = array('Bangladesh', 'Nepal', 'Sri Lanka');

if(!isset($_SESSION['V_Country'])){
  $_SESSION['V_Country'] = ip_info("Visitor", "Country");
}

if(!in_array($_SESSION['V_Country'], $HideCountry)){
  echo 'Show';
}else{
  echo 'Hide';
}
?>