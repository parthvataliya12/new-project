<?php
$cart = $_SESSION['cart'];
$sub_total  = 0;
$GST_per = Get_one_value('tax','tax_per',1,'id',$db);
?>


<div class="col-md-12 col-sm-12 col-xs-12" ><h2>Your Cart</h2><hr /></div>

<?php
for($i=0;$i<count($cart['item_id']);$i++){
	$item_total  = $cart['item_price'][$i]*$cart['item_qty'][$i];
	$sub_total +=   $item_total;
	?>
	<div class="col-md-9 col-sm-9 col-xs-9" >
		<?php echo $cart['item_name'][$i].' (Rs.'.$cart['item_price'][$i].')'. ' X '.$cart['item_qty'][$i]; ?>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-3" >
		Rs. <?php echo $item_total; ?>
	</div>
	<?php
	?>
	<div class="col-md-12 col-sm-12 col-xs-12" ><hr /></div>
	<?php 
}

$GST_charge = ($sub_total*$GST_per)/100;
$GST_charge = 0;
$total_of_cart = $sub_total + $GST_charge;
if(count($cart['item_id'])){
?>
<div class="col-md-9 col-sm-9 col-xs-9" >
	Sub Total
</div>
<div class="col-md-3 col-sm-3 col-xs-3" >
	Rs. <?php echo  $sub_total; ?>
</div>
<?php /*?><div class="col-md-9 col-sm-9 col-xs-9" >
	GST(<?php echo $GST_per ?>%)
</div>
<div class="col-md-3 col-sm-3 col-xs-3" >
	Rs. <?php echo $GST_charge ; ?>
</div><?php */?>
<div class="col-md-12 col-sm-12 col-xs-12" ><hr /></div>
<div class="col-md-9 col-sm-9 col-xs-9" >
	Total
</div>
<div class="col-md-3 col-sm-3 col-xs-3" >
	Rs. <?php echo $total_of_cart; ?>
</div>
<div class="col-md-12 col-sm-12 col-xs-12" ><hr /></div>
<div class="col-md-12 col-sm-12 col-xs-12" >
	<div class="send"><button type="button" id='btn_ckeckout' style="width: 100%" onclick="javascript:window.location.href='<?php echo $SITE_URL ?>checkout/'">Proceed to Checkout</button></div>
	Product price included with <?php echo $GST_per ?>% GST.
</div>
<?php }else{ ?>
<div class="col-md-12 col-sm-12 col-xs-12" >
	<strong>Your cart is empty.</strong>
</div>
<?php } ?>
<div class="col-md-12 col-sm-12 col-xs-12" ><hr /></div>
