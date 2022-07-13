<?php 
include ('connect.php'); 
session_destroy();
header('Location:'.$SITE_URL."login/?lg=Y");
?>