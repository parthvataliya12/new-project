<?php
include( 'connect.php' );
include_once('check-login.php');

$cart = $_SESSION[ 'cart' ];
$sub_total = 0;
$GST_per = Get_one_value( 'tax', 'tax_per', 1, 'id', $db );

if(empty($_POST['billing_name']) || empty($_POST['billing_email']) || empty($_POST['billing_tel']) || empty($_POST['billing_address']) || empty($_POST['billing_city']) || empty($_POST['billing_state']) || empty($_POST['billing_zip']) || empty($_POST['billing_country']) || empty($_POST['delivery_name']) || empty($_POST['delivery_tel']) || empty($_POST['delivery_address']) || empty($_POST['delivery_city']) || empty($_POST['delivery_state']) || empty($_POST['delivery_zip']) || empty($_POST['delivery_country'])){
	?>
	<script>location.href='<?php echo $SITE_URL; ?>checkout.php?e=b'</script>
	<?php
	exit;
}

if($_POST['pay_method'] == 'cod'){ 

	$SqlLeft = '';
	$SqlRight = "";

	$SqlLeft .= '`user_id`, `order_email`, `order_phone`, `order_sub_total`, `order_gst_per`, `order_gst`, `order_amount`, `order_date`,`order_status`,`order_transaction_id`,`payment_status`,`payment_method`,`amount`,`billing_name`,`billing_email`,`billing_tel`,`billing_address`,`billing_city`,`billing_state`,`billing_zip`,`billing_country`,`delivery_name`,`delivery_tel`,`delivery_address`,`delivery_city`,`delivery_state`,`delivery_zip`,`delivery_country`,`payment_mode`,';

	$SqlRight .= $_SESSION['paragone_user']['id'].", '".$_SESSION['paragone_user']['email']."', '".$_SESSION['paragone_user']['phone']."', '".$_SESSION['order_sub_total']."', '".$_SESSION['order_gst_per']."', '0', '".$_SESSION['order_total']."', '".date('Y-m-d H:i:s')."', 'Success', '".$order_id."', 'U', 'COD', '".$_SESSION['order_total']."','".$_POST['billing_name']."','".$_POST['billing_email']."','".$_POST['billing_tel']."','".$_POST['billing_address']."','".$_POST['billing_city']."','".$_POST['billing_state']."','".$_POST['billing_zip']."','".$_POST['billing_country']."','".$_POST['delivery_name']."','".$_POST['delivery_tel']."','".$_POST['delivery_address']."','".$_POST['delivery_city']."','".$_POST['delivery_state']."','".$_POST['delivery_zip']."','".$_POST['delivery_country']."','COD',";
	
	$order_id = $_SESSION['order_id'];
	$track = '';

	$SqlLeft .= " `order_id`,";
	$SqlRight .= " '".$order_id."',";
	$order_id = $order_id;
	$track = $order_id;

	$SqlLeft .= " `trans_date`,";
	$SqlRight .= " '".date('Y/m/d H:i:s')."',";

	$SqlLeft = substr($SqlLeft, 0, -1);
	$SqlRight = substr($SqlRight, 0, -1);

	$insQry = "INSERT INTO `order_master` (".$SqlLeft.") VALUES (".$SqlRight.") ";
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

		header("location:".$SITE_URL."error/?e=f");
		exit;
	}

}else{ ?>


<form method="post" name="customerData" id="customerData" action="<?php echo $SITE_URL; ?>ccavRequestHandler.php">

	<input type="hidden" name="billing_name" id="billing_name" value="<?php echo $_POST['billing_name']; ?>"/>
	<input type="hidden" name="billing_email" id="billing_email" value="<?php echo $_POST['billing_email']; ?>"/>
	<input type="hidden" name="billing_tel" id="billing_tel" value="<?php echo $_POST['billing_tel']; ?>"/>
	<input type="hidden" name="billing_address" id="billing_address" value="<?php echo $_POST['billing_address']; ?>"/>
	<input type="hidden" name="billing_city" id="billing_city" value="<?php echo $_POST['billing_city']; ?>"/>
	<input type="hidden" name="billing_state" id="billing_state" value="<?php echo $_POST['billing_state']; ?>"/>
	<input type="hidden" name="billing_zip" id="billing_zip" value="<?php echo $_POST['billing_zip']; ?>"/>
	<input type="hidden" name="billing_country" id="billing_country" value="<?php echo $_POST['billing_country']; ?>"/>
	<input type="hidden" name="delivery_name" id="delivery_name" value="<?php echo $_POST['delivery_name']; ?>"/>
	<input type="hidden" name="delivery_tel" id="delivery_tel" value="<?php echo $_POST['delivery_tel']; ?>"/>
	<input type="hidden" name="delivery_address" id="delivery_address" value="<?php echo $_POST['delivery_address']; ?>"/>
	<input type="hidden" name="delivery_city" id="delivery_city" value="<?php echo $_POST['delivery_city']; ?>"/>
	<input type="hidden" name="delivery_state" id="delivery_state" value="<?php echo $_POST['delivery_state']; ?>"/>
	<input type="hidden" name="delivery_zip" id="delivery_zip" value="<?php echo $_POST['delivery_zip']; ?>"/>
	<input type="hidden" name="delivery_country" id="delivery_country" value="<?php echo $_POST['delivery_country']; ?>"/>

	<?php 

	for($i=0;$i<count($cart['item_id']);$i++){

		$item_total  = $cart['item_price'][$i]*$cart['item_qty'][$i];

		$sub_total +=   $item_total;

	} 

	$GST_charge = ($sub_total*$GST_per)/100;
    $GST_charge = 0;
	$total_of_cart = $sub_total + $GST_charge;

	$_SESSION[ 'order_gst_per' ] = $GST_per;
	$_SESSION[ 'order_gst_charges' ] = $GST_charge;
	$_SESSION[ 'order_sub_total' ] = $sub_total;
	$_SESSION[ 'order_total' ] = $total_of_cart;

?>

	<input type="hidden" name="tid" id="tid" readonly/>
	<input type="hidden" name="merchant_id" value="209556"/>
	<input type="hidden" name="order_id" value="<?php echo $_SESSION['order_id']; ?>"/>
	<input type="hidden" name="amount" value="<?php  echo number_format($total_of_cart, 2, '.', ''); ?>"/>
	<input type="hidden" name="currency" value="INR"/>
	<input type="hidden" name="redirect_url" value="<?php echo $SITE_URL; ?>ccavResponseHandler.php"/>
	<input type="hidden" name="cancel_url" value="<?php echo $SITE_URL; ?>ccavResponseHandler.php"/>
	<input type="hidden" name="language" value="EN"/>

</form>

<script type = "text/javascript"  src = "<?php echo $SITE_URL ?>js/vendor/jquery.min.js"></script>	

<script>
	window.onload = function () {
		var d = new Date().getTime();
		document.getElementById( "tid" ).value = d;
		jQuery('#customerData').submit();
	};
</script>

<?php } ?>