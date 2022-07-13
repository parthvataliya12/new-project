<?php 

//ini_set('session.gc_maxlifetime', 60 * 60); // 1 Hours 

error_reporting(E_ERROR | E_PARSE);

/*date_default_timezone_set('Chile/Continental');

*/
session_start();


include ("include/config.inc.php");

include ("include/functions.php");



$db=mysqli_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);

mysqli_select_db($db,$DATABASENAME);



# USED!!.. admin left module display

define("FILE_NAME", getFileName());

define("INCLUDE_PATH", $SITE_URL.'include/');



# Settings

/*$fetchquery = "select * from setting";

$result = mysql_query($fetchquery) or die(mysql_error());

$rs = mysql_fetch_assoc($result);

foreach($rs as $key=>$val){ $key="setting_".$key; $$key=stripslashes($val); } //extract($rs, EXTR_PREFIX_ALL, 'setting');

$ADMIN_MAIL = stripslashes($setting_site_admin_email_id);

$google_analytic_code = stripslashes($setting_google_analytic_code);

define('ADMIN_MAIL', $ADMIN_MAIL);*/

$Qry_pages = "SELECT * FROM static_pages WHERE id = 1";

$res_pages = mysqli_query($db,$Qry_pages);

$row_pages = mysqli_fetch_array($res_pages);



$Set_Address = $row_pages['company_address'];

$Set_Email = $row_pages['company_email'];

$Set_Phone = $row_pages['company_phone'];

$Set_FB = $row_pages['fb_link'];

$Set_TW = $row_pages['tw_link'];

$set_banner =  $row_pages['gplus_link'];


define("SMS_API_KEY", urlencode('BhN+Xb1djIQ-9tms1JjZbapNOpLrsoYcAP7wCbidd5'));

$HideCountry = array('Bangladesh', 'Nepal', 'Sri Lanka');

if(!isset($_SESSION['V_Country'])){
  $_SESSION['V_Country'] = ip_info("Visitor", "Country");
}

?>