<?php 
if(!isset($_SESSION['paragone_user'])&&$_SESSION['paragone_user']['id']==''){

   header("location:".$SITE_URL."login/?chk=N");

 }
?>