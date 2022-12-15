<?php 
if(isset($_SESSION['user'])&&$_SESSION['user']['type']=='AdmiN')
{
	header('Location:'.$SITE_URL.'admin/dashboard.php');
}
?>