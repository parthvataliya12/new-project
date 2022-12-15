<?php

	global $SITE_URL,$SITE_NAME;
	//date_default_timezone_set('Europe/London');
	$SITE_NAME = 'rifes.cl';
	define('Server',$_SERVER['HTTP_HOST']);
	
	if(substr(Server,0,3)=="loc")  ////LOCAL DB DETAIL
	{
		$DBSERVER = "localhost";
		$DATABASENAME = "paragon";
		$USERNAME = "root";
		$PASSWORD = "";
		$SITE_URL = "http://localhost/paragon/"; 
		define('DOCUMENT_ROOT_PATH', $_SERVER['DOCUMENT_ROOT']."paragon");
	}else if(substr(Server,0,3)=="192")  ////LOCAL DB DETAIL
	{
		$DBSERVER = "localhost";
		$DATABASENAME = "paragon";
		$USERNAME = "root";
		$PASSWORD = "";
		$SITE_URL = "http://192.168.0.108/paragon/"; 
		define('DOCUMENT_ROOT_PATH', $_SERVER['DOCUMENT_ROOT']."paragon");
	}
	else ////ONLINE DB DETAIL
	{
		$DBSERVER = "localhost"; 
		$DATABASENAME = "parsanai_para_live";
		$USERNAME = "parsanai_para_li";
		$PASSWORD = "H1[r,e&~bKsA"; 
		$SITE_URL = "https://paragontwowheeleraccessories.com/";
		define('DOCUMENT_ROOT_PATH', $_SERVER['DOCUMENT_ROOT']."/");
	}	

	if(is_array($_POST)){ foreach($_POST as $var=>$valu){$$var = $valu;} }
	if(is_array($_GET)){ foreach($_GET as $var=>$valu){$$var = $valu;} }
	$basename = basename($_SERVER['PHP_SELF']);
	
	set_time_limit(900);
	//------------------------------------
	ini_set("max_execution_time" , 300000);
	ini_set("max_input_time" , 60000);
	ini_set("post_max_size" , "60M");
	ini_set("upload_max_filesize" , "60M");	
	//------------------------------------		
?>