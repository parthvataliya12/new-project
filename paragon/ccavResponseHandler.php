<?php
include('connect.php');
include('Crypto.php');
?>
<?php

	error_reporting(0);
	
	$workingKey='24D517A89F9020D603BA6222D0CB23D0';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	//echo "<center>";

	for($i = 0; $i < $dataSize; $i++) 
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
	}

	$SqlLeft = '';
	$SqlRight = "";
	if($order_status==="Success")
	{
		
		$SqlLeft .= '`user_id`, `order_email`, `order_phone`, `order_sub_total`, `order_gst_per`, `order_gst`, `order_amount`, `order_date`,';
		$SqlRight .= $_SESSION['paragone_user']['id'].", '".$_SESSION['paragone_user']['email']."', '".$_SESSION['paragone_user']['phone']."', '".$_SESSION['order_sub_total']."', '".$_SESSION['order_gst_per']."', '0', '".$_SESSION['order_total']."', '".date('Y-m-d H:i:s')."', ";
		$order_id = '';
		$track = '';
		
		for($i = 0; $i < $dataSize; $i++) {
			$information=explode('=',$decryptValues[$i]);
				if($information[0] == 'tracking_id'){
					$SqlLeft .= "`order_transaction_id`,";
					$SqlRight .= "'".$information[1]."',";
					$track = $information[1];
				}else if($information[0] == 'order_id'){
					$SqlLeft .= "`order_id`,";
					$SqlRight .= "'".$information[1]."',";
					$order_id = $information[1];
				}else if($information[0] == 'trans_date'){
					$SqlLeft .= "`trans_date`,";
					$SqlRight .= "'".$information[1]."',";;
				}else if($information[0] == 'bin_country'){
					$SqlLeft .= "`bin_country`,";
					$SqlRight .= "'".rtrim($information[1])."',";;
				}else{
					$SqlLeft .= "`".$information[0]."`,";
			    	$SqlRight .= "'".$information[1]."',";
				}
		}
		
		
		
		$SqlLeft = substr($SqlLeft, 0, -1);
		$SqlRight = substr($SqlRight, 0, -1);

		$insQry = " INSERT INTO `order_master` (".$SqlLeft.") VALUES (".$SqlRight.") ";
		mysqli_query($db, $insQry);
		$lastInst = mysqli_insert_id($db);

		if($lastInst){
			$recTemp = "select * from `temp_order_item` where `order_id` = '".$order_id."' ";
			$qryTemp = mysqli_query($db, $recTemp);
			while($recTemp = mysqli_fetch_array($qryTemp)){
				$insTemp = "insert into order_items set 
					`a_name` = '".$recTemp['item_name']."', 
					`a_price` = '".$recTemp['item_price']."', 
					`a_qty` = '".$recTemp['item_qty']."', 
					`a_id` = '".$recTemp['item_id']."', 
					`order_id` = '".$recTemp['order_id']."'  
				";

				mysqli_query($db, $insTemp);

				$DelItem = "DELETE FROM `temp_order_item` WHERE `id` = '".$recTemp['id']."' ";
				mysqli_query($db, $DelItem);
			}

			send_order_email($db,$_SESSION['order_id'],'new_order');

			unset($_SESSION['cart']);
			unset($_SESSION['order_id']);
			unset($_SESSION['order_gst_per']);
			unset($_SESSION['order_gst_charges']);
			unset($_SESSION['order_sub_total']);
			unset($_SESSION['order_total']);
			
			//echo "<br><br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
			
			header("location:".$SITE_URL."thank-you/?t=".$track);

  			exit;
		}else{
			
			$updTemp = "delete from temp_order_item WHERE order_id = '".$_SESSION['order_id']."' ";
			mysqli_query($db, $updTemp);
			
			unset($_SESSION['cart']);
			unset($_SESSION['order_id']);
			unset($_SESSION['order_gst_per']);
			unset($_SESSION['order_gst_charges']);
			unset($_SESSION['order_sub_total']);
			unset($_SESSION['order_total']);
			
			header("location:".$SITE_URL."error/?e=e");
			exit;
		}
		
		
	}
	else if($order_status==="Aborted")
	{
		$updTemp = "delete from temp_order_item WHERE order_id = '".$_SESSION['order_id']."' ";
		mysqli_query($db, $updTemp);

		unset($_SESSION['cart']);
		unset($_SESSION['order_id']);
		unset($_SESSION['order_gst_per']);
		unset($_SESSION['order_gst_charges']);
		unset($_SESSION['order_sub_total']);
		unset($_SESSION['order_total']);
		
		//echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
		header("location:".$SITE_URL."error/?e=a");
		exit;
	}
	else if($order_status==="Failure")
	{
		$updTemp = "delete from temp_order_item WHERE order_id = '".$_SESSION['order_id']."' ";
		mysqli_query($db, $updTemp);

		unset($_SESSION['cart']);
		unset($_SESSION['order_id']);
		unset($_SESSION['order_gst_per']);
		unset($_SESSION['order_gst_charges']);
		unset($_SESSION['order_sub_total']);
		unset($_SESSION['order_total']);
		
		//echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
		header("location:".$SITE_URL."error/?e=f");
		exit;
	}
	else
	{
		$updTemp = "delete from temp_order_item WHERE order_id = '".$_SESSION['order_id']."' ";
		mysqli_query($db, $updTemp);

		unset($_SESSION['cart']);
		unset($_SESSION['order_id']);
		unset($_SESSION['order_gst_per']);
		unset($_SESSION['order_gst_charges']);
		unset($_SESSION['order_sub_total']);
		unset($_SESSION['order_total']);
		
		//echo "<br>Security Error. Illegal access detected";
		header("location:".$SITE_URL."error/?e=s");
		exit;
	}
?>
