<?php

/**
 * Find whether the email is valid
 * 
 * @param Stirng $email private key of email .
 * 
 * @return Boolean $result.
 */
function is_valid_email($email) 
{
	$result = TRUE;
  	if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email)) {
    	$result = FALSE;
  	}
  	return $result;
}

/*Function to redirect :: START*/

function redirect($redirect){

	echo '<script language="javascript" >window.location.href="'.$redirect.'"</script>';

}

/*Function to redirect :: OVER*/







function get_filename($str)

{

	$str = implode("_",split(" ",$str));

	$str = implode("_",split("  ",$str));

	$str = implode("_",split("'",$str));

	$str = implode("_",split("%",$str));

	$str = implode("_",split("-",$str));

	$str = implode("_",split("@",$str));

	$str = implode("_",split("#",$str));

	$str = implode("_",split(";",$str));

	$str = implode("_",split("&",$str));

	return $str;

}



function clean_url($text)

{

	$text=strtolower($text);

	$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','=','�');

	$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','','','-');

	$text = str_replace($code_entities_match, $code_entities_replace, $text);

	return $text;

} 

function clean_url_dynamic($db ,$text, $table_name)
{
	$text=strtolower($text);
	$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','=','®');
	$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','','','-');
	$slug = str_replace($code_entities_match, $code_entities_replace, $text);

	$query = "SELECT COUNT(*) AS NumHits FROM $table_name WHERE slug LIKE '%$slug%'";
	$result = mysqli_query($db, $query) or die(mysqli_error($db));
	$row = mysqli_fetch_assoc($result);
	$numHits = $row['NumHits'];

	return ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
	//return $text;
} 

function rms($str)

{

	return $newstr=stripslashes($str);

}

//Count Shop Item



// Image fetch 

function ImageValueFetch($ImageAttributes)//$image,$fullpath,$fileexits,$width,$height,$cropratio,$id=0,$Extra=''

{

	global $SITE_URL;



	$image = $ImageAttributes["image"]; // file name only [image.jpg]

	$foldername = $ImageAttributes["foldername"]; // name of folder where image is stored [folder]

	$fileexits = $ImageAttributes["fileexits"]; // path for checking  image is exists or not [../folder/image.jpg] 

	$width = $ImageAttributes["width"]; // image width [50]

	$height = $ImageAttributes["height"]; // image height [50]

	$cropratio = $ImageAttributes["cropratio"]; //image cropratio [1.62:1]

	$id = $ImageAttributes["id"]; // user id if required [0] 

	$for = $ImageAttributes["for"]; // image used for [user, event, video, etc...]

	$Extra = $ImageAttributes["Extra"]; // extra attributes of images [border, alt, title, class, etc...]

	

	$fullpath = $SITE_URL.$foldername.$image;

	

	if($image != "" && file_exists($fileexits))

	{

		$ReturnValue = '<img src="'.$SITE_URL.'image.php?width='.$width.'&amp;height='.$height.'&amp;cropratio='.$cropratio.'&amp;image='.$fullpath.'" '.$Extra.' />';

    }

	else

    {

		if($for == "member")

		{

			$ReturnValue = '<img src="'.$SITE_URL.MEMBER_PHOTO_FOLDER.'default/default.png" width="'.$width.'" height="'.$height.'" '.$Extra.'>';

		}

		if($for == "photo")

		{

			$ReturnValue = '<img src="'.$SITE_URL.MEDIA_PHOTO_FILE.'default/default.png" width="'.$width.'" height="'.$height.'" '.$Extra.'>';

		}

		if($for == "event")

		{

			$ReturnValue = '<img src="'.$SITE_URL.EVENT_PHOTO_FILE.'default/default.png" width="'.$width.'" height="'.$height.'" '.$Extra.'>';

		}

		if($for == "video_category_icon")

		{

			$ReturnValue = '<img src="'.$SITE_URL.MEDIA_VIDEO_CAT_ICON.'default/default.png" width="'.$width.'" height="'.$height.'" '.$Extra.'>';

		}

		else if($for == "video_frame_image")

		{

			$ReturnValue = '<img src="'.$SITE_URL.MEDIA_VIDEO_FRAME_IMAGE_FILE.'default/default.png" width="'.$width.'" height="'.$height.'" '.$Extra.'>';

		}

		else if($for == "forlink")

		{

			$ReturnValue = '<img src="'.$SITE_URL.'image.php?width='.$width.'&amp;height='.$height.'&amp;cropratio='.$cropratio.'&amp;image='.$image.'" '.$Extra.' />';

		}

		else if($for == "forlinkwall")

		{

			$ReturnValue = '';

		}else if($for == "video_default_small")

		{

			$ReturnValue = '<img src="'.$SITE_URL.MEDIA_VIDEO_FRAME_IMAGE_FILE.'default/default_small.png" width="'.$width.'" height="'.$height.'" '.$Extra.'>';

		}

		else if($for == "video_default_120X67")

		{

			$ReturnValue = '<img src="'.$SITE_URL.MEDIA_VIDEO_FRAME_IMAGE_FILE.'default/default_120X67.png" width="'.$width.'" height="'.$height.'" '.$Extra.'>';

		}

		else if($for == "photo_default")

		{

			$ReturnValue = '<img src="'.$SITE_URL.MEDIA_PHOTO_FILE.'default/default.png" width="'.$width.'" height="'.$height.'" '.$Extra.'>';

		}

		else if($for == "ventlink_default")

		{

			$ReturnValue = '<img src="'.$SITE_URL.MEDIA_PHOTO_FILE.'default/default.png" width="'.$width.'" height="'.$height.'" '.$Extra.'>';

		}

    }

	return $ReturnValue;

}









function imageReplace($text)

{

	$text=strtolower($text);

	/*$code_entities_match = array('{','}','(',')','[',']');

	$code_entities_replace = array('_','_','_','_','_','_');*/

	$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','/','*','+','~','`','=','�');

	$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','','-');

	$text = str_replace($code_entities_match, $code_entities_replace, $text);

	return $text;

}



/**

 * function getFileName

 *

 * @return string returns the path from HTML down to the php file

 *

 */

function getFileName(){

	$output = "";

	$output = basename($_SERVER["SCRIPT_FILENAME"], ".php");

	return $output;

}



function modurl_site($url,$param,$extension="")

{

	if(MODE_REWRITE==1)

	{

		$mod=$url;

		foreach($param as $key=>$value){

			

			if($extension=="")

			{

				$mod.=$value;

			}	

			else

			{

				$mod.=$value.$extension;

			}

			

		}

	}

	else

	{

		$mod=$url."?";

		foreach($param as $key=>$value){

			if(substr($mod,strlen($mod)-1,1)=="?"){

				$mod.=$key."=".$value;

			}

			else

			{

				$mod.="&".$key."=".$value;

			}

		}

	}

	return $mod;

} 







function get_file_extension($file_name) {

  return substr(strrchr($file_name,'.'),1);

}



/* creates a compressed zip file */

function create_zip($files = array(),$destination = '',$overwrite = false) {

  //if the zip file already exists and overwrite is false, return false

  if(file_exists($destination) && !$overwrite) { return false; }

  //vars

  $valid_files = array();

  //if files were passed in...

  if(is_array($files)) {

    //cycle through each file

    foreach($files as $file) {

      //make sure the file exists

      if(file_exists($file)) {

        $valid_files[] = $file;

      }

    }

  }

  //if we have good files...

  if(count($valid_files)) {

    //create the archive

    $zip = new ZipArchive();

    if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {

      return false;

    }

    //add the files

    foreach($valid_files as $file) {

      $zip->addFile($file,$file);

    }

    //debug

    //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

    

    //close the zip -- done!

    $zip->close();

    

    //check to make sure the file exists

    return file_exists($destination);

  }

  else

  {

    return false;

  }

}



function curPageURL() {

 $pageURL = 'http';

 //if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

 $pageURL .= "://";

 if ($_SERVER["SERVER_PORT"] != "80") {

  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

 } else {

  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

 }

 return $pageURL;

}





function image_valid($type)

{

    $file_types  = array(  

    'image/pjpeg'   => 'jpg',

    'image/jpeg'    => 'jpg',

    'image/JPG'     => 'jpg',

	'image/jpeg'    => 'jpeg',

    'image/gif'     => 'gif',

    'image/GIF'     => 'gif',

	'image/X-PNG'   => 'png',

    'image/PNG'     => 'png',

    'image/png'     => 'png',

    'image/x-png'   => 'png',

    'image/bmp'     => 'bmp',

    'image/bmp'     => 'BMP',	

    );

   

    if(!array_key_exists($type, $file_types))

    {

        return "FALSE";

    }

    else

    {

        return "TRUE";

    }

}



/*function video_valid($file)

{

	$ext=array_pop(explode('.',$file));



    $file_types  = array(  

    'video/x-flv'   => 'f4v',

    'video/x-flv'   => 'flv',

    'video/x-m4v'   => 'm4v',

    'video/mp4'     => 'mov',

    'video/mp4'		=> 'mp4'

    );



    if(!in_array($ext,$file_types))

    {

        return "FALSE";

    }

    else

    {

        return "TRUE";

    }



}*/



function video_valid($file)

{

	global $allowed_video_extensions;

	$ext = end(explode('.',$file));



    $file_types  = $allowed_video_extensions;



    if(!in_array(strtolower($ext),$file_types))

    {

        return "FALSE";

    }

    else

    {

        return "TRUE";

    }



}



if(!function_exists("shorten_string"))

{

	function shorten_string($string, $wordsreturned)

	/*  Returns the first $wordsreturned out of $string.  If string

	contains fewer words than $wordsreturned, the entire string

	is returned.

	*/

		{

		$retval = $string;	//	Just in case of a problem

		$array = explode(" ", $string);

		if (count($array)<=$wordsreturned)

		/*  Already short enough, return the whole thing

		*/

		{

		$retval = $string;

		}

		else

		/*  Need to chop of some words

		*/

		{

		array_splice($array, $wordsreturned);

		$retval = implode(" ", $array)."...";

		}

		return $retval;

	}

}

function gen_trivial_password($len = 10)

{

    $r = '';

    for($i=0; $i<$len; $i++)

        $r .= chr(rand(0, 25) + ord('a'));

    return $r;

}



function findGoal($c,$t=0){ //$c is current value, $t is real target value

	$perc = 0.80;

	$target = 50;//100;



	do{

		$target *= 2; // '2 double target 

		$larger_than = $target*$perc;

	}while($c>=$larger_than);

	return $target;

}



function checkLogin()

{

	$sk = 'oMsOhmOqGYh2jUhh';

	$seed = @$_SERVER['HTTP_USER_AGENT'] ;

	$_key = md5( $sk . $seed );

	$rm = md5($sk . 'LOGIN_REMEMBER');

	$crypt = new JSimpleCrypt($_key);

	

	if(isset($_COOKIE[$rm])){ 

		$credentials = unserialize($crypt->decrypt($_COOKIE[$rm]));

		doLogin($credentials);

	}

}





function dateDifference($startDate, $endDate)

{

			

            $startDate = strtotime($startDate);

            $endDate = strtotime($endDate);

            //echo $startDate."=".$endDate; exit;

            if ($startDate === false || $startDate < 0 || $endDate === false || $endDate < 0 || $startDate > $endDate)

                return false;

              

            $years = date('Y', $endDate) - date('Y', $startDate);

          

            $endMonth = date('m', $endDate);

            $startMonth = date('m', $startDate);

         

            // Calculate months

            $months = $endMonth - $startMonth;

            if ($months <= 0)  {

                $months += 12;

                $years--;

            }

            if ($years < 0)

               // return false;

      

            // Calculate the days

                        $offsets = array();

                        if ($years > 0)

                            $offsets[] = $years . (($years == 1) ? ' year' : ' years');

                        if ($months > 0)

                            $offsets[] = $months . (($months == 1) ? ' month' : ' months');

                        $offsets = count($offsets) > 0 ? '+' . implode(' ', $offsets) : 'now';



                        $days = $endDate - strtotime($offsets, $startDate);

                        $days = date('z', $days);  

						

                echo "heres123";      

            return array($years, $months, $days);

        }

		

function dateDiff($time1, $time2, $precision = 6) 

{

	date_default_timezone_set("UTC");

    // If not numeric then convert texts to unix timestamps

    if (!is_int($time1)) {

      $time1 = strtotime($time1);

    }

    if (!is_int($time2)) {

      $time2 = strtotime($time2);

    }

 

    // If time1 is bigger than time2

    // Then swap time1 and time2

    if ($time1 > $time2) {

      $ttime = $time1;

      $time1 = $time2;

      $time2 = $ttime;

    }

 

    // Set up intervals and diffs arrays

    $intervals = array('year','month','day','hour','minute','second');

    $diffs = array();

 

    // Loop thru all intervals

    foreach ($intervals as $interval) {

      // Set default diff to 0

      $diffs[$interval] = 0;

      // Create temp time from time1 and interval

      $ttime = strtotime("+1 " . $interval, $time1);

      // Loop until temp time is smaller than time2

      while ($time2 >= $ttime) {

	$time1 = $ttime;

	$diffs[$interval]++;

	// Create new temp time from time1 and interval

	$ttime = strtotime("+1 " . $interval, $time1);

      }

    }

 

    $count = 0;

    $times = array();

    // Loop thru all diffs

    foreach ($diffs as $interval => $value) {

      // Break if we have needed precission

      if ($count >= $precision) {

	break;

      }

      // Add value and interval 

      // if value is bigger than 0

      if ($value > 0) {

	// Add s if value is not 1

	if ($value != 1) {

	  $interval .= "s";

	}

	// Add value and interval to times array

	$times[] = $value . " " . $interval;

	$count++;

      }

    }

 

    // Return string with times

    return implode(", ", $times);

}

  

function TimeAgo($i){

	$m = time()-$i; $o='just now';

	$t = array('y'=>31556926,'mt'=>2629744,'w'=>604800,

'd'=>86400,'h'=>3600,'m'=>60,'s'=>1);

	foreach($t as $u=>$s){

		if($s<=$m){$v=floor($m/$s); $o="$v$u".($v==1?'':'').' ago'; break;}

	}

	return $o;

}



function TimeAgoNew($i){

	$m = time()-$i; $o='just now';

	$t = array('y'=>31556926,'mt'=>2629744,'w'=>604800,

'd'=>86400,'h'=>3600,'m'=>60,'s'=>1);

	foreach($t as $u=>$s){

		if($s<=$m){$v=floor($m/$s); $o="$v@$u".($v==1?'':'').''; break;}

	}

	return $o;

}







function time_since($since) {

    $chunks = array(

        array(60 * 60 * 24 * 365 , 'year'),

        array(60 * 60 * 24 * 30 , 'month'),

        array(60 * 60 * 24 * 7, 'week'),

        array(60 * 60 * 24 , 'day'),

        array(60 * 60 , 'hour'),

        array(60 , 'minute'),

        array(1 , 'second')

    );



    for ($i = 0, $j = count($chunks); $i < $j; $i++) {

        $seconds = $chunks[$i][0];

        $name = $chunks[$i][1];

        if (($count = floor($since / $seconds)) != 0) {

            break;

        }

    }



    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";

    return $print." ago";

}



function new_video_embed($input_width,$input_height,$option_name,$rxinfo=0)

{

	$new_height = $input_height;

	$new_width  = $input_width;

	$embed_code = $option_name;

	

	$patterns = array();

	//tackles double quotes

	$pattern[0] = "/height=\"[0-9]*\"/";

	$pattern[1] = "/width=\"[0-9]*\"/";

	//tackles single quotes

	$pattern[2] = "/height=\'[0-9]*\'/";

	$pattern[3] = "/width=\'[0-9]*\'/";

	//tackles single quotes

	$pattern[4] = "/height:.[0-9]*/";

	$pattern[5] = "/width:.[0-9]*/";

	

	$replacements = array();

	$replacements[0] = "height=\"".$new_height."\"";

	$replacements[1] = "width=\"".$new_width."\"";

	$replacements[2] = "height='".$new_height."'";

	$replacements[3] = "width='".$new_width."'";

	$replacements[4] = "height:".$new_height;

	$replacements[5] = "width:".$new_width;

	

	if($rxinfo==1){ $part=explode("</embed>",$embed_code);$embed_code=$part[0]."</embed>";}

	$string = preg_replace($pattern,$replacements,$embed_code);

	return $string;

}





/***

* Core Lib. June 2013

***/

//$param = array('{firstname}'=>'firstname15','{lastname}'=>'lastname12','{email}'=>'email','{password}'=>'password');

//send_mail_template(1, 'test123ac@gmail.com', $ADMIN_MAIL, $param);



function format_size($size) 

{

     // $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");

      if($size == 0) 

	  { return('n/a'); } 

	  else 

	  { return number_format(($size/1024)/1024,4);}//(round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]); }

}







function IsValidUrl($obj_url)

{

	if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $obj_url)) {

	  	return true;

	}else{

		return false;

	}

}



function dateDiffNew($time1, $time2, $precision = 6) {

    // If not numeric then convert texts to unix timestamps

    if (!is_int($time1)) {

      $time1 = strtotime($time1);

    }

    if (!is_int($time2)) {

      $time2 = strtotime($time2);

    }

 

    // If time1 is bigger than time2

    // Then swap time1 and time2

    if ($time1 > $time2) {

      $ttime = $time1;

      $time1 = $time2;

      $time2 = $ttime;

    }

 

    // Set up intervals and diffs arrays

    $intervals = array('year','month','day','hour','minute','second');

    $diffs = array();

 

    // Loop thru all intervals

    foreach ($intervals as $interval) {

      // Set default diff to 0

      $diffs[$interval] = 0;

      // Create temp time from time1 and interval

      $ttime = strtotime("+1 " . $interval, $time1);

      // Loop until temp time is smaller than time2

      while ($time2 >= $ttime) {

	$time1 = $ttime;

	$diffs[$interval]++;

	// Create new temp time from time1 and interval

	$ttime = strtotime("+1 " . $interval, $time1);

      }

    }

 

    $count = 0;

    $times = array();

    // Loop thru all diffs

    foreach ($diffs as $interval => $value) {

      // Break if we have needed precission

      if ($count >= $precision) {

	break;

      }

      // Add value and interval 

      // if value is bigger than 0

      if ($value > 0) {

	// Add s if value is not 1

	if ($value != 1) {

	  $interval .= "s";

	}

	// Add value and interval to times array

	$times[] = $value . " " . $interval;

	$count++;

      }

    }

 

    // Return string with times

    return implode(", ", $times);

  }

  





// random value from an array

function array_random($arr, $num = 1) 

{

	if(count($arr) < $num)

	{

		$num = count($arr);

	}



    $arrRdm = array_rand($arr,$num);

	$r = array();

    foreach($arrRdm as $key) 

	{

        $r[] = $arr[$key];

    }

	

    return $num == 1 ? $r[0] : $r;

}





function morethan($c){

	$a = array(20,50,100,200,500,1000);

	rsort($a);

	foreach($a as $temp){

		if($c>$temp){

			return $temp."+";

		}

	}

	return $c;

}



function SimpleCleanURL($string) 

{

   $string = str_replace(" ", "-", $string); // Replaces all spaces with hyphens.

   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.



   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.

}



//Get city, region, conutry and country code based on IP Address

function countryCityFromIP($ipAddr)

{

	//function to find country and city from IP address

	//Developed by Roshan Bhattarai http://roshanbh.com.np		

	//verify the IP address for the

	ip2long($ipAddr)== -1 || ip2long($ipAddr) === false ? trigger_error("Invalid IP", E_USER_ERROR) : "";

	

	$ipDetail=array(); //initialize a blank array

	

	//return country value based on IP Address

	$data = file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=97eb4bada9d188b4667f05da58069538ea38c444ce6d45585217e368460fd747&ip=".$ipAddr);

	

	//explode data value by ";"

	$match = explode(";",$data);



	//assign the country code to the $ipDetail array

	$ipDetail['country_code'] = $match[3];

	

	//assign the country name to the $ipDetail array

	$ipDetail['country'] = $match[4];

	

	//assign the region name to the $ipDetail array

	$ipDetail['region'] = $match[5];

	

	//assing the city name to the $ipDetail array

	$ipDetail['city'] = $match[6]; 

	

	//assing the timezone to the $ipDetail array

	$ipDetail['time_zone'] = $match[10]; 		

	

	//return the array containing country code, country, region, city

	return $ipDetail;	

}



function GetUserBaseTimeDisplay($date,$format='Y-m-d h:i:s') {

	

	if(!defined(TIMEZONE_OFFSET))

	{

		//get default time zone

		if($origin_tz === null) {

			if(!is_string($origin_tz = date_default_timezone_get())) {

				return false; // A UTC timestamp was returned -- bail out!

			}

		}

		

		/// Get timezone of user.

		$ip=$_SERVER['REMOTE_ADDR'];

		//$json   = file_get_contents('http://smart-ip.net/geoip-json/'.$ip);

		//$ipData = json_decode( $json, true);

		$json   = file_get_contents('http://ip-api.com/php/'.$ip);

		$ipData = unserialize( $json);

		$remote_tz=trim($ipData['timezone']);

		

		//get offset

		if($remote_tz!='')

		{

			$origin_dtz = new DateTimeZone($origin_tz);

			$remote_dtz = new DateTimeZone($remote_tz);

			$origin_dt = new DateTime("now", $origin_dtz);

			$remote_dt = new DateTime("now", $remote_dtz);

			$offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);

		}

		else

			$offset = 0;

		

		define('TIMEZONE_OFFSET',$offset);

	}

	

	

	$offset = TIMEZONE_OFFSET;

		

	return date($format,strtotime($date) - $offset);

}



function youtube($string,$autoplay=0,$width=630,$height=355) {

    $MainUrl = preg_replace('~

        # Match non-linked youtube URL in the wild. (Rev:20130823)

        https?://         # Required scheme. Either http or https.

        (?:[0-9A-Z-]+\.)? # Optional subdomain.

        (?:               # Group host alternatives.

          youtu\.be/      # Either youtu.be,

        | youtube         # or youtube.com or

          (?:-nocookie)?  # youtube-nocookie.com

          \.com           # followed by

          \S*             # Allow anything up to VIDEO_ID,

          [^\w\s-]       # but char before ID is non-ID char.

        )                 # End host alternatives.

        ([\w-]{11})      # $1: VIDEO_ID is exactly 11 chars.

        (?=[^\w-]|$)     # Assert next char is non-ID or EOS.

        (?!               # Assert URL is not pre-linked.

          [?=&+%\w.-]*    # Allow URL (query) remainder.

          (?:             # Group pre-linked alternatives.

            [\'"][^<>]*>  # Either inside a start tag,

          | </a>          # or inside <a> element text contents.

          )               # End recognized pre-linked alts.

        )                 # End negative lookahead assertion.

        [?=&+%\w.-]*        # Consume any URL (query) remainder.

        ~ix', 

        'http://www.youtube.com/watch?v=$1',

        $string);

    return $MainUrl;	

}



function vimeo_embed($video_url,$width=480,$height=390){

	$oembed_endpoint = 'http://vimeo.com/api/oembed';



	// Create the URLs

	$json_url = $oembed_endpoint . '.json?url=' . rawurlencode($video_url) . '&width='.$width.'&height='.$height;

	$xml_url = $oembed_endpoint . '.xml?url=' . rawurlencode($video_url) . '&width='.$width.'&height='.$height;



	$curl = curl_init($xml_url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($curl, CURLOPT_TIMEOUT, 30);

    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

    $return = curl_exec($curl);

    curl_close($curl);

    //return $return;



	$oembed = @simplexml_load_string($return);

	echo count($oembed);

	if($oembed[0]=='')

		echo 'yes';

	else

		echo 'no';

	

	return html_entity_decode($oembed->html);

}



function dailymotion_embed($video_url,$width=480,$height=390){



	// Create the URLs

	$json_url = 'http://www.dailymotion.com/services/oembed?format=xml&url=' . rawurlencode($video_url) . '&width='.$width.'&height='.$height;	



	$curl = curl_init($json_url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($curl, CURLOPT_TIMEOUT, 30);

    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

    $return = curl_exec($curl);

    curl_close($curl);

    //return $return;



	$oembed = simplexml_load_string($return);



	return html_entity_decode($oembed->html);

}



function youtube_embed($video_url,$width=480,$height=390){



	// Create the URLs

	$json_url = 'http://www.youtube.com/oembed?format=xml&url=' . rawurlencode($video_url) . '&width='.$width.'&height='.$height;	



	$curl = curl_init($json_url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($curl, CURLOPT_TIMEOUT, 30);

    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

    $return = curl_exec($curl);

    curl_close($curl);

    //return $return;



	$oembed = simplexml_load_string($return);



	return html_entity_decode($oembed->html);

}



function GenerateEmbedCode($video_url,$autoplay=0,$width=630,$height=355,$VideoType=''){

	

	$oembedUrls = array (

	  'youtube' => 'http://www.youtube.com/oembed??format=xml',

	  'dailymotion' => 'http://www.dailymotion.com/api/oembed?format=xml',

	  'vimeo' => 'http://vimeo.com/api/oembed.xml?format=xml',

	  'blip' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'hulu' => 'http://www.hulu.com/api/oembed/?format=xml',

	  'viddler' => 'http://lab.viddler.com/services/oembed/?format=xml',

	  'qik' => 'http://qik.com/api/oembed?format=xml',

	  'revision3' => 'http://revision3.com/api/oembed/?format=xml',

	  'scribd' => 'http://www.scribd.com/services/oembed?format=xml',

	  'wordpress' => 'http://wordpress.tv/oembed/?format=xml',

	  '5min' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'on.aol' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'collegehumor' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'thedailyshow' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'funnyordie' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'metacafe' => 'http://www.oohembed.com/oohembed/?format=xml', 

	  'yfrog' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'sapo' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'nfb' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'dotsub' => 'http://dotsub.com/services/oembed?format=xml',

	  'telly' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'gametrailers' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'vzaar' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'vhx' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'animoto' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'justin' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'livestream' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'veoh' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'traileraddict' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'fora' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'ted' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'comedycentral' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'snotr' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'zapiks' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'youku' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'wistia' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'kickstarter' => 'http://www.oohembed.com/oohembed/?format=xml',

	  'aol' => 'http://www.oohembed.com/oohembed/?format=xml'

	);



	if($VideoType!='')

	{

		// Create the URLs	

		/*if($VideoType=='youtube'){

			$xml_url = 'http://www.youtube.com/oembed?format=xml&url=' . rawurlencode($video_url) . '&width='.$width.'&height='.$height;	

			//return youtube($video_url,$autoplay=0,$width=630,$height=355);

		}else if($VideoType=='vimeo'){

			$oembed_endpoint = 'http://vimeo.com/api/oembed';

			

			$json_url = $oembed_endpoint . '.json?url=' . rawurlencode($video_url) . '&width='.$width.'&height='.$height;

			$xml_url = $oembed_endpoint . '.xml?url=' . rawurlencode($video_url) . '&width='.$width.'&height='.$height;

		}else if($VideoType=='dailymotion'){

			$xml_url = 'http://www.dailymotion.com/services/oembed?format=xml&url=' . rawurlencode($video_url) . '&width='.$width.'&height='.$height;

		}else if($VideoType=='metacafe'){

			$xml_url = 'http://www.oohembed.com/oohembed/?format=xml&url=' . rawurlencode($video_url) . '&width='.$width.'&height='.$height;

		}*/

		

		if($VideoType=='youtube'){

			return youtube($video_url,$autoplay=0,$width=630,$height=355);

		}

		$xml_url = $oembedUrls[$VideoType];

		$xml_url .= '&url='.rawurlencode($video_url).'&width='.$width.'&height='.$height;



		$curl = curl_init($xml_url);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($curl, CURLOPT_TIMEOUT, 30);

		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

		$return = curl_exec($curl);

		curl_close($curl);

		//return $return;



		$oembed = @simplexml_load_string($return);



		if(count($oembed) > 1){

			$iframeEmb = html_entity_decode($oembed->html);



			$iframeEmb = preg_replace('/height="(.*?)"/i', 'height="' . $height .'"', $iframeEmb);

			$iframeEmb = preg_replace('/width="(.*?)"/i', 'width="' . $width .'"', $iframeEmb);

			return $iframeEmb;

		}else{

			return '';

		}

	}

}



function videoType($url) {

    if (strpos($url, 'youtube') > 0) {

        return 'youtube';

    } elseif (strpos($url, 'vimeo') > 0) {

        return 'vimeo';

    } elseif (strpos($url, 'dailymotion') > 0) {

        return 'dailymotion';

    } elseif (strpos($url, 'metacafe') > 0) {

        return 'metacafe';

    }elseif (strpos($url, 'thedailyshow') > 0) {

        return 'thedailyshow';

    }elseif (strpos($url, 'funnyordie') > 0) {

        return 'funnyordie';

    }elseif (strpos($url, 'collegehumor') > 0) {

        return 'collegehumor';

    }elseif (strpos($url, '5min') > 0) {

        return '5min';

    }elseif (strpos($url, 'on.aol') > 0) {

        return 'on.aol';

    }elseif (strpos($url, 'wordpress') > 0) {

        return 'wordpress';

    }elseif (strpos($url, 'scribd') > 0) {

        return 'scribd';

    }elseif (strpos($url, 'revision3') > 0) {

        return 'revision3';

    }elseif (strpos($url, 'qik') > 0) {

        return 'qik';

    }elseif (strpos($url, 'viddler') > 0) {

        return 'viddler';

    }elseif (strpos($url, 'hulu') > 0) {

        return 'hulu';

    }elseif (strpos($url, 'blip') > 0) {

        return 'blip';

    }elseif (strpos($url, 'sapo') > 0) {

        return 'sapo';

    }elseif (strpos($url, 'nfb') > 0) {

        return 'nfb';

    }elseif (strpos($url, 'dotsub') > 0) {

        return 'dotsub';

    }elseif (strpos($url, 'telly') > 0) {

        return 'telly';

    }elseif (strpos($url, 'gametrailers') > 0) {

        return 'gametrailers';

    }elseif (strpos($url, 'vzaar') > 0) {

        return 'vzaar';

    }elseif (strpos($url, 'vhx') > 0) {

        return 'vhx';

    }elseif (strpos($url, 'animoto') > 0) {

        return 'animoto';

    }elseif (strpos($url, 'justin') > 0) {

        return 'justin';

    }elseif (strpos($url, 'livestream') > 0) {

        return 'livestream';

    }elseif (strpos($url, 'veoh') > 0) {

        return 'veoh';

    }elseif (strpos($url, 'traileraddict') > 0) {

        return 'traileraddict';

    }elseif (strpos($url, 'fora') > 0) {

        return 'fora';

    }elseif (strpos($url, 'ted') > 0) {

        return 'ted';

    }elseif (strpos($url, 'comedycentral') > 0) {

        return 'comedycentral';

    }elseif (strpos($url, 'snotr') > 0) {

        return 'snotr';

    }elseif (strpos($url, 'zapiks') > 0) {

        return 'zapiks';

    }elseif (strpos($url, 'youku') > 0) {

        return 'youku';

    }elseif (strpos($url, 'wistia') > 0) {

        return 'wistia';

    }elseif (strpos($url, 'kickstarter') > 0) {

        return 'kickstarter';

    }elseif (strpos($url, 'aol') > 0) {

        return 'aol';

    }elseif (strpos($url, 'yahoo') > 0) {

        return 'yahoo';

    }else {

        return 'unknown';

    }

}



/* Function to add http in url : START */

function addhttp($url) {

    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {

        $url = "http:" . $url;

    }

    return $url;

}

/* Function to add http in url : START */



function deleteDir($path) 

{

    return is_file($path) ? @unlink($path) : array_map(__FUNCTION__, glob($path.'/*')) == @rmdir($path);

}



function findExtension ($filename)

{

   $filename = strtolower($filename) ;

   $exts = explode(".", $filename) ;

   $n = count($exts)-1;

   $exts = $exts[$n];

   return $exts;

}



/*permission checking code */

function check_permissions($groups,$check){

	$user_groups = explode(',',$groups);

		

		foreach($user_groups as $group_id){

			$GetRecP = GetSingleRow('user_group','group_id',$group_id);

			

			$group_permissions = explode(',', $GetRecP['group_permissions']);

		foreach($group_permissions as $group){

		

			$groups = explode(':',$group);

			$$groups[0]=$groups[1];

				if($$check==1){

					$access = true;	

				}

			} 

		}

	return $access;

}



function is_valid_image($file_name)

{

	 $file_ext= substr($file_name, strpos($file_name, ".") + 1); 

					

		$acceptedFormats = array('gif', 'png', 'jpg', 'JPG', 'PNG','GIF','jpeg');

		

		if(!in_array($file_ext, $acceptedFormats)) 

		{

			return false;

		}

		return true;

}

/*permission checking code */







function generateStrongPassword($length = 8, $add_dashes = false, $available_sets = 'luds')

{

	$sets = array();

	if(strpos($available_sets, 'l') !== false)

		$sets[] = 'abcdefghjkmnpqrstuvwxyz';

	if(strpos($available_sets, 'u') !== false)

		$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';

	if(strpos($available_sets, 'd') !== false)

		$sets[] = '23456789';

	if(strpos($available_sets, 's') !== false)

		$sets[] = '!@#$%&*?';

	$all = '';

	$password = '';

	foreach($sets as $set)

	{

		$password .= $set[array_rand(str_split($set))];

		$all .= $set;

	}

	$all = str_split($all);

	for($i = 0; $i < $length - count($sets); $i++)

		$password .= $all[array_rand($all)];

	$password = str_shuffle($password);

	if(!$add_dashes)

		return $password;

	$dash_len = floor(sqrt($length));

	$dash_str = '';

	while(strlen($password) > $dash_len)

	{

		$dash_str .= substr($password, 0, $dash_len) . '-';

		$password = substr($password, $dash_len);

	}

	$dash_str .= $password;

	return $dash_str;

}

function Get_one_value($table,$field_name,$value,$whr_field,$db)

{

	$qry = "SELECT ".$field_name." FROM ".$table." WHERE ".$whr_field." = ".$value;

	$res=mysqli_query($db,$qry);

	$row=mysqli_fetch_array($res);

	return  $row[0];

}

function Get_one_value_str($table,$field_name,$value,$whr_field,$db)

{

	$qry = "SELECT ".$field_name." FROM ".$table." WHERE ".$whr_field." = '".$value."'";

	$res=mysqli_query($db,$qry);

	$row=mysqli_fetch_array($res);

	return  $row[0];

}

function GTG_is_dup_add($table,$field,$value,$db)

{

	if($other_str == "")

		$other_str="";

	else

		$other_str=$other_str;

	$q = "select `".$field."` from `".$table."` where ".$field." = '".$value."' ".$other_str.""; 

	$r = mysqli_query($db,$q);

	if(mysqli_num_rows($r) > 0)

		return true;

	else

		return false;

}





function generate_ord_num()

{

	//return substr(number_format(time() * rand(),0,'',''),0,10);
	return rand(10,99).time().rand(10,99);

}





function gen_ref_code()

{

	$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

	$res = "";

	for ($i = 0; $i < 10; $i++) {

		$res .= $chars[mt_rand(0, strlen($chars)-1)];

	}

	return $res;

}

function send_order_email($db,$order_id,$flag){



	 



	$qry_order = "SELECT T1.*, T2.*, T3.*,T4.* FROM order_master AS T1, order_items as T2, user_details as T3, access as T4 WHERE T1.order_id  = T2.order_id AND T1.user_id = T3.id AND T2.a_id = T4.id  AND T1.order_id = '".$order_id."'";

	$res_order_single = mysqli_query($db,$qry_order);

	$row_order_single = mysqli_fetch_array($res_order_single);



	$res_order_multi = mysqli_query($db,$qry_order);

	

	 $order_date = date('d/m/Y H:i:s', strtotime($row_order_single['order_date']));

	 if($row_order_single['payment_status']=='P')

	 {

	 	$pay_status = 'Paid';

	 }

	 else

	 {

	 	$pay_status = 'Unpaid';

	 }

	 switch($row_order_single['order_status'])

		{

			case W:

				$order_status = "<span class='label label label-warning'>Pending</span>";

				break;

			case P:

				$order_status = "<span class='label label label-primary'>Processing</span>";

				break;

			case C:

				$order_status = "<span class='label label label-success'>Complete</span>";

				break;

			case X:

				$order_status = "<span class='label label label-danger'>Cancel</span>";

				break;

			case 'Success':

				$order_status = "<span class='label label label-success'>Success</span>";

				break;

			case 'Failure':

				$order_status = "<span class='label label label-danger'>Failure</span>";

				break;	

			case 'Aborted':

				$order_status = "<span class='label label label-danger'>Aborted</span>";

				break;	

			case 'Invalid':

				echo "<span class='label label label-danger'>Invalid</span>";

				break;	

			default: 
				$order_status = "<span class='label label label-info'>Received</span>";

				break;

		}

	 if($flag == 'new_order'){

	 	$invoice_logo_path = $SITE_URL.'images/logo.jpg';

	 	$invoice_save_path = 'invoices/'.$order_id.'.pdf';



	 }

	 if($flag == 'update_order'){

	 	$invoice_logo_path = $SITE_URL.'images/logo.jpg';

	 	$invoice_save_path = '../invoices/'.$order_id.'.pdf';



	 }





	



	ob_start();

    ?>

       <style type="text/css">

<!--

    table.page_header {width: 100%; border: none; background-color: #FFF; padding: 2mm; border-bottom: solid 1mm #58585A; }

    table.page_footer {width: 100%; border: none; background-color: #FFF; padding: 2mm; border-top: solid 1mm #58585A; }

-->

</style>

<page backtop="30mm" backbottom="15mm" backleft="5mm" backright="5mm">

    <page_header>

        <table class="page_header">

            <tr>

                <td style="width: 50%; text-align: left; ">

                    <img src="<?php echo $invoice_logo_path ?>" height="50" />

                </td> 

                <td style="width: 50%; text-align: right; ">

                    <h1></h1>

                </td>                

            </tr>            

        </table>

    </page_header>

    <page_footer>

        <table class="page_footer">

            <tr>    

                <td style="width: 100%; text-align: center">

                    &copy; Paragon Accessories. All Rights Reserved

                </td>

            </tr>

        </table>

    </page_footer>

    <table cellpadding="0" cellspacing="0" border="0" >

        <tr><td width="100%;" >&nbsp;</td></tr>

        <tr>

            <td width="100%;" >

                <table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #D9D8D8;" style="width:100%;" width="100%;" > 

                <tr>

                    <td width="50%;" >

                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%;" width="100%;" >

                            <tr><td width="100%" ><strong>Paragon Accessories Pvt. Ltd.</strong> </td></tr>

                            <tr><td width="100%" >Paragon House, <br />4-Bhaktinagar station plot, <br />Opp. Metro offset, <br />Gondal road, <br />Rajkot, Gujrat, India </td></tr>

                            <tr><td width="100%" >360002</td></tr>

                            <tr><td width="100%" >+91 9227628929</td></tr>

                            <tr><td width="100%" >&nbsp;</td></tr>

                        </table>

                    </td>

                    <td width="50%;" >

                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%; padding-right:50px;" width="100%;" align="right" >

                            <tr><td width="100%" ><strong>Invoice No:</strong> #<?php echo $order_id ?></td></tr>

                            <tr><td width="100%" ><strong>Date:</strong> <?php echo date('d-m-Y', strtotime(str_replace('/','-', $order_date))); ?></td></tr>

                            <tr><td width="100%" >&nbsp;</td></tr>

                            <tr><td width="100%" >&nbsp;</td></tr>

                        </table>

                    </td>

               </tr>

               </table>     

            </td>

        </tr>

        <tr><td width="100%;" >&nbsp;</td></tr>

        <tr>

            <td width="100%;" >

                <table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #D9D8D8;" style="width:100%;" width="100%;" > 

                <tr>

                    <td width="50%;" >

                       &nbsp;
                        <?php /*?><table cellpadding="0" cellspacing="0" border="0" style="width:100%;" width="100%;" >

                            <tr><td width="100%" ><strong>Bill To: </strong> <?php echo $row_order_single['u_name'] ?> </td></tr>

                            <tr><td width="100%" ><strong>Contact No.: </strong> <?php echo $row_order_single['order_phone'] ?></td></tr>

                            <tr><td width="100%" ><strong>Email: </strong> <?php echo $row_order_single['order_email'] ?></td></tr>

                            <tr><td width="100%" ><strong>Address: </strong> <?php echo $row_order_single['u_address'] ?></td></tr>

                            

                        </table><?php */?>

                    </td>

                      <td width="50%;" >

                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%; padding-right:50px;" width="100%;" align="right" >

                            <tr><td width="100%" ><strong>Payment Method: </strong><?php  echo $row_order_single['payment_mode']?></td></tr>

                            <tr><td width="100%" ><strong>Payment Status: </strong><?php echo $pay_status;  ?></td></tr>

                            <tr><<td width="100%" ><strong>Order Status: </strong><?php echo $order_status;  ?></td></tr>

                            <tr><td width="100%" >&nbsp;</td></tr>          

                        </table>

                    </td>



               </tr>

               </table>     

            </td>

        </tr>

        <tr><td width="100%;" >&nbsp;</td></tr>

        <tr>

            <td width="100%;" >

                <table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #D9D8D8;" style="width:100%;" width="100%;" > 

                <tr>

                    <td width="100%;" >

                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%; padding-right:50px;" width="100%;" >

                            <tr>

                                <td width="60%;" style="color:#000; padding:8px; width:150px; background:#FFF; border:1px solid #58585A;" align="left" ><strong>Description</strong></td>

                               

                                <td width="15%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A;" align="center" ><strong>Unit Cost</strong></td>

                                 <td width="10%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A;" align="center" ><strong>Qty</strong></td>

                                 <td width="15%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A;" align="center" ><strong>Price</strong></td>

                            </tr>

                           <?php while($row_order_multi = mysqli_fetch_assoc($res_order_multi)){ ?>

                            <tr>

                                <td width="60%;" style="color:#000; padding:8px; width:150px; background:#FFF; border:1px solid #58585A;" align="left" ><?php echo $row_order_multi['a_name'] ?></td>

                                

                                <td width="15%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A; " align="center" >Rs. <?php echo $row_order_multi['a_price'] ?></td>

                                <td width="10%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A;" align="center" ><?php echo $row_order_multi['a_qty'] ?></td>

                                 <td width="15%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A; " align="center" >Rs. <?php echo ($row_order_multi['a_price']*$row_order_multi['a_qty']) ?></td>

                            </tr>

                            <?php } ?>

                        </table>

                    </td>                    

               </tr>

               </table>     

            </td>

        </tr>

        <tr><td width="100%;" >&nbsp;</td></tr>

        <tr>

            <td width="100%;" >

                <table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #D9D8D8;" style="width:100%;" width="100%;" > 

                <tr>

                    <td width="100%;" >

                         <table cellpadding="0" cellspacing="0" border="0" style="width:100%;padding-right:50px;padding-left:400px;" width="100%;" >

                            <tr>

                                <td width="63%;" style="color:#000; padding:8px; width:150px; background:#FFF; border:1px solid #58585A;" align="left" ><strong>Sub Total</strong></td>

                                <td width="37%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A;" align="center" ><strong>Rs. <?php echo $row_order_single['order_sub_total']?></strong></td>

                               

                            </tr>

                             <?php /*?><tr>

                                <td width="63%;" style="color:#000; padding:8px; width:150px; background:#FFF; border:1px solid #58585A;" align="left" ><strong>GST (<?php echo  $row_order_single['order_gst_per']?>%)</strong></td>

                                <td width="37%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A;" align="center" ><strong>Rs. <?php echo  $row_order_single['order_gst']?></strong></td>

                               

                            </tr><?php */?>

                            <tr>

                                <td width="63%;" style="color:#000; padding:8px; width:150px; background:#FFF; border:1px solid #58585A;" align="left" ><strong>Total</strong></td>

                                <td width="37%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A;" align="center" ><strong>Rs. <?php  echo $row_order_single['order_amount']?></strong></td>

                               

                            </tr>

                        </table>

                    </td>                    

               </tr>

               </table>     

            </td>

        </tr>
        
        <tr><td width="100%;" >&nbsp;</td></tr>
        
        <tr>

            <td width="100%;" >
            
            	<table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #D9D8D8;" style="width:100%;" width="100%;" > 

                <tr>
                    <td colspan="2" ><strong>Incusive all taxes</strong></td>
                </tr>

                <tr>
                    <td colspan="2" >&nbsp;</td>
                </tr>
                
                <tr>

                    <td width="50%;" ><strong>Billing Detials</strong></td>
                    
                    <td width="50%;" ><strong>Shipping Detials</strong></td>

				</tr>

                <tr>

                    <td width="50%;" >
                    	<?php  echo $row_order_single['billing_name']; ?><br />
                    	<?php  echo $row_order_single['billing_address']; ?><br />
                    	<?php  echo $row_order_single['billing_city']; ?> - <?php  echo $row_order_single['billing_zip']; ?><br />
                    	<?php  echo $row_order_single['billing_state']; ?> - <?php  echo $row_order_single['billing_country']; ?><br />
                    	<?php  echo $row_order_single['billing_tel']; ?><br />
                    	<?php  echo $row_order_single['billing_email']; ?><br /> 
                    	<strong>Note: </strong><?php  echo $row_order_single['billing_notes']; ?>
                    </td>
                    
                    <td width="50%;" >
                    	<?php  echo $row_order_single['delivery_name']; ?><br />
                    	<?php  echo $row_order_single['delivery_address']; ?><br />
                    	<?php  echo $row_order_single['delivery_city']; ?> - <?php  echo $row_order_single['delivery_zip']; ?><br />
                    	<?php  echo $row_order_single['delivery_state']; ?> - <?php  echo $row_order_single['delivery_country']; ?><br />
                    	<?php  echo $row_order_single['delivery_tel']; ?><br />
                    </td>

				</tr>
           
				</table>
            
			</td>
       
        </tr>

        <tr><td width="100%;" >&nbsp;</td></tr>

        

    </table>

</page>

    <?php

    //echo $content = ob_get_clean();

    //exit;// convert to PDF

   		$content = ob_get_clean();

    include('html2pdf/html2pdf.class.php');

    try

    {

        $html2pdf = new HTML2PDF('P', 'A4', 'en');

        //$html2pdf->setTestTdInOnePage(false);

        $html2pdf->writeHTML($content);

        $html2pdf->Output($invoice_save_path,'F');

    }

    catch(HTML2PDF_exception $e) {

        echo $e;

        exit;

    }

    if($flag=='new_order'){

    		require 'phpmailer/class.phpmailer.php';

			$mail = new PHPMailer();



    	$body = '<html>

                    <head>

                        <title>Welcome to Paragon Accessorires Pvt. Ltd.</title>

                    </head>

                    <body style ="font-family: Helvetica, Arial, sans-serif;">

                        <div style="width:100%;text-align:center"><img width="20%" src="https://paragontwowheeleraccessories.com/images/logo.jpg"></div>

                        <p>Hello '.$row_order_single['u_name'].'</p>

                        <br />

                        <p>Welcome to Paragon Accessorires Pvt. Ltd.</p>

                        <p>Your order is successfully placed.</p>

                        <p>Please find your order details in invoice #'.$order_id.' attached.</p>

                        

                        <p>Thank you,</p>

                        <p>Paragon Accessorires Pvt. Ltd.</p>

                    </body>

                    </html>' ;

	 

		try{

		$mail->IsSMTP();                           // tell the class to use SMTP

		$mail->SMTPAuth   = true;                  // enable SMTP authentication

		$mail->Port       =   465;     

		$mail->Host       = "md-in-29.webhostbox.net"; // SMTP server

		$mail->Username   = "info@paragontwowheeleraccessories.com";     // SMTP server username

		$mail->Password   = "himat@123"; 

		$mail->SMTPSecure = "ssl"; 

		$mail->IsSendmail();  // tell the class to use Sendmail

	

		$mail->AddReplyTo('info@paragontwowheeleraccessories.com','Paragon Two Wheeler Accessories');

	

		$mail->From       = 'info@paragontwowheeleraccessories.com';

		$mail->FromName   = 'Paragon Two Wheeler Accessories';

		

		$to = $row_order_single['order_email'];

	

        $mail->AddAddress($to);
        
        $mail->AddAddress('info@paragontwowheeleraccessories.com','New Order');
        $mail->AddAddress('sales@paragontwowheeleraccessories.com','New Order');        
        $mail->AddAddress('piyush.vasoya@yahoo.com', 'New Order');
        $mail->AddAddress('parasana.himat@hotmail.com', 'New Order');

	

		$mail->Subject  =   'Your Paragon Two Wheeler Accessories Order #'.$order_id.' is placed';

		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

		$mail->WordWrap   = 80; // set word wrap

	

		$mail->MsgHTML($body);

		$mail->AddAttachment("invoices/".$order_id.".pdf");

		$mail->IsHTML(true); // send as HTML

	

		$sendEmail = $mail->Send();

      

		//echo $sendEmail ? "1" : "0";

		//echo 'Message has been sent.';

		} catch (phpmailerException $e) {

			echo $e->errorMessage();

		}

                $apiKey = urlencode('BhN+Xb1djIQ-9tms1JjZbapNOpLrsoYcAP7wCbidd5');

                // Message details
                $numbers = array(trim($row_order_single['billing_tel']),9722332211);
                
                $msg_str = "Order Placed: Your order is successfully placed on paragontwowheeleraccessories.com with Order ID: $order_id ";
                $sender = urlencode('TXTLCL');

                $message = rawurlencode($msg_str);

                $numbers = implode(',', $numbers);

                // Prepare data for POST request
                $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

                // Send the POST request with cURL
                $ch = curl_init('https://api.textlocal.in/send/');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);


    }

	if($flag=='update_order'){

		require '../include/phpmailer/class.phpmailer.php';

			$mail = new PHPMailer();



    	$body = '<html>

                    <head>

                        <title>Welcome to Paragon Accessorires Pvt. Ltd.</title>

                    </head>

                    <body style ="font-family: Helvetica, Arial, sans-serif;">

                        <div style="width:100%;text-align:center"><img width="20%" src="https://paragontwowheeleraccessories.com/images/logo-black.jpg"></div>

                        <p>Hello '.$row_order_single['u_name'].'</p>

                        <br />

                        <p>Your order details are updated.</p>

                        <p>Please find your order details in invoice #'.$order_id.' attached.</p>

                        

                        <p>Thank you,</p>

                        <p>Paragon Accessorires Pvt. Ltd.</p>

                    </body>

                    </html>' ;

	 

		try{

		$mail->IsSMTP();                           // tell the class to use SMTP

		$mail->SMTPAuth   = true;                  // enable SMTP authentication

		$mail->Port       =   465;     

		$mail->Host       = "md-in-29.webhostbox.net"; // SMTP server

		$mail->Username   = "info@paragontwowheeleraccessories.com";     // SMTP server username

		$mail->Password   = "himat@123"; 

		$mail->SMTPSecure = "ssl"; 

		$mail->IsSendmail();  // tell the class to use Sendmail

	

		$mail->AddReplyTo('info@paragontwowheeleraccessories.com','Paragon Two Wheeler Accessories');

	

		$mail->From       = 'info@paragontwowheeleraccessories.com';

		$mail->FromName   = 'Paragon Two Wheeler Accessories';

		

		$to = $row_order_single['order_email'];

	

		$mail->AddAddress($to);

	

		$mail->Subject  =   'Your Paragon Two Wheeler Accessories Order #'.$order_id.' is Updated';

		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

		$mail->WordWrap   = 80; // set word wrap

	

		$mail->MsgHTML($body);

		$mail->AddAttachment("../invoices/".$order_id.".pdf");

		$mail->IsHTML(true); // send as HTML

	

		$sendEmail = $mail->Send();

		//echo $sendEmail ? "1" : "0";

		//echo 'Message has been sent.';

		} catch (phpmailerException $e) {

			echo $e->errorMessage();

		}
        
        $apiKey = urlencode('BhN+Xb1djIQ-9tms1JjZbapNOpLrsoYcAP7wCbidd5');

        // Message details
        $numbers = array(trim($row_order_single['billing_tel']),9722332211);
        
        $msg_str = "Order Updated: Your order is successfully update on paragontwowheeleraccessories.com with Order ID: $order_id";
        $sender = urlencode('TXTLCL');

        $message = rawurlencode($msg_str);

        $numbers = implode(',', $numbers);

        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

    }











}







function generate_invoice($order_id)

{

	ob_start();

    ?>

       <style type="text/css">

<!--

    table.page_header {width: 100%; border: none; background-color: #FFF; padding: 2mm; border-bottom: solid 1mm #58585A; }

    table.page_footer {width: 100%; border: none; background-color: #FFF; padding: 2mm; border-top: solid 1mm #58585A; }

-->

</style>

<page backtop="30mm" backbottom="15mm" backleft="5mm" backright="5mm">

    <page_header>

        <table class="page_header">

            <tr>

                <td style="width: 50%; text-align: left; ">

                    <img src="<?php echo $SITE_URL ?>images/logo.jpg" height="50" />

                </td> 

                <td style="width: 50%; text-align: right; ">

                    <h1></h1>

                </td>                

            </tr>            

        </table>

    </page_header>

    <page_footer>

        <table class="page_footer">

            <tr>    

                <td style="width: 100%; text-align: center">

                    &copy; Paragon Acce. All Rights Reserved

                </td>

            </tr>

        </table>

    </page_footer>

    <table cellpadding="0" cellspacing="0" border="0" >

        <tr><td width="100%;" >&nbsp;</td></tr>

        <tr>

            <td width="100%;" >

                <table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #D9D8D8;" style="width:100%;" width="100%;" > 

                <tr>

                    <td width="50%;" >

                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%;" width="100%;" >

                            <tr><td width="100%" ><strong>Paragon Acc Pvt. Ltd.</strong> </td></tr>

                            <tr><td width="100%" ><strong>Address:</strong> Paragon House, 4-Bhaktinagar station plot, Opp. Metro offset, Gondal road, Rajkot </td></tr>

                            <tr><td width="100%" ><strong>Postal Code:</strong> 360002</td></tr>

                            <tr><td width="100%" ><strong>Contact:</strong> +91 92276 28929</td></tr>

                            <tr><td width="100%" >&nbsp;</td></tr>

                        </table>

                    </td>

                    <td width="50%;" >

                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%; padding-right:50px;" width="100%;" align="right" >

                            <tr><td width="100%" ><strong>Invoice No:</strong> #1234</td></tr>

                            <tr><td width="100%" ><strong>Created Date:</strong> 1/1/1111</td></tr>

                            <tr><td width="100%" ><strong>Due:</strong> 1/1/1111</td></tr>

                            <tr><td width="100%" ><strong>Created By:</strong>Tushar </td></tr>

                        </table>

                    </td>

               </tr>

               </table>     

            </td>

        </tr>

        <tr><td width="100%;" >&nbsp;</td></tr>

        <tr>

            <td width="100%;" >

                <table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #D9D8D8;" style="width:100%;" width="100%;" > 

                <tr>

                    <td width="50%;" >

                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%;" width="100%;" >

                            <tr><td width="100%" ><strong>Bill To:</strong> Jaspal </td></tr>

                            <tr><td width="100%" ><strong>Contact No.:</strong> 90909090</td></tr>

                            <tr><td width="100%" ><strong>Email:</strong> asdasd@gmailc.om</td></tr>

                            

                        </table>

                    </td>

                      <td width="50%;" >

                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%; padding-right:50px;" width="100%;" align="right" >

                            <tr><td width="100%" ><strong>Payment Method: </strong>Cheque</td></tr>

                            <tr><td width="100%" ><strong>Payment Status: </strong>Unpaid</td></tr>

                            <tr><td width="100%" >&nbsp;</td></tr>          

                        </table>

                    </td>



               </tr>

               </table>     

            </td>

        </tr>

        <tr><td width="100%;" >&nbsp;</td></tr>

        <tr>

            <td width="100%;" >

                <table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #D9D8D8;" style="width:100%;" width="100%;" > 

                <tr>

                    <td width="100%;" >

                        <table cellpadding="0" cellspacing="0" border="0" style="width:100%; padding-right:50px;" width="100%;" >

                            <tr>

                                <td width="70%;" style="color:#000; padding:8px; width:150px; background:#FFF; border:1px solid #58585A;" align="left" ><strong>Description</strong></td>

                                <td width="15%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A;" align="center" ><strong>Qty</strong></td>

                                <td width="15%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A;" align="center" ><strong>Amount</strong></td>

                            </tr>



                            <tr>

                                <td width="70%;" style="color:#000; padding:8px; width:150px; background:#FFF; border:1px solid #58585A;" align="left" >Pump</td>

                                <td width="15%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A;" align="center" >10</td>

                                <td width="15%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A; " align="center" >Rs. 200</td>

                            </tr>

                             <tr>

                                <td width="70%;" style="color:#000; padding:8px; width:150px; background:#FFF; border:1px solid #58585A;" align="left" >Pump</td>

                                <td width="15%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A;" align="center" >10</td>

                                <td width="15%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A;" align="center" >Rs. 200</td>

                            </tr>

                              

                            

                        </table>

                    </td>                    

               </tr>

               </table>     

            </td>

        </tr>

        <tr><td width="100%;" >&nbsp;</td></tr>

        <tr>

            <td width="100%;" >

                <table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #D9D8D8;" style="width:100%;" width="100%;" > 

                <tr>

                    <td width="100%;" >

                         <table cellpadding="0" cellspacing="0" border="0" style="width:100%;padding-right:50px;padding-left:400px;" width="100%;" >

                            <tr>

                                <td width="63%;" style="color:#000; padding:8px; width:150px; background:#FFF; border:1px solid #58585A;" align="left" ><strong>Sub Total</strong></td>

                                <td width="37%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A;" align="center" ><strong>500</strong></td>

                               

                            </tr>

                             <?php /*?><tr>

                                <td width="63%;" style="color:#000; padding:8px; width:150px; background:#FFF; border:1px solid #58585A;" align="left" ><strong>GST</strong></td>

                                <td width="37%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A;" align="center" ><strong>20</strong></td>

                               

                            </tr><?php */?>

                            <tr>

                                <td width="63%;" style="color:#000; padding:8px; width:150px; background:#FFF; border:1px solid #58585A;" align="left" ><strong>Total</strong></td>

                                <td width="37%;" style="color:#000; padding:8px; width:50px; background:#FFF; border:1px solid #58585A;" align="center" ><strong>520</strong></td>

                               

                            </tr>

                        </table>

                    </td>                    

               </tr>

               </table>     

            </td>

        </tr>

        <tr><td width="100%;" >&nbsp;</td></tr>

        

    </table>

</page>

    <?php

    //echo $content = ob_get_clean();

    //exit;// convert to PDF

    $content = ob_get_clean();

    include('html2pdf/html2pdf.class.php');

    try

    {

        $html2pdf = new HTML2PDF('P', 'A4', 'en');

        //$html2pdf->setTestTdInOnePage(false);

        $html2pdf->writeHTML($content);

        $html2pdf->Output('exemple.pdf', 'F');

    }

    catch(HTML2PDF_exception $e) {

        echo $e;

        exit;

    }

}

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}


?>