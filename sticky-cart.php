<?php if(isset($_SESSION['cart']) && count($_SESSION['cart']['item_id'])>0){ ?>
<style type="text/css" >
	.cls_cart_stk{ color: #000; }
	.cls_cart_stk:hover{ color: #FFF; }
</style>
	<div class="sticky-cart">
    <div class="col-md-12 col-sm-12 col-xs-12" ><img src="<?php echo $SITE_URL ?>images/free-delivery2.gif" alt="Free Home Delivery" title="Free Home Delivery" class="free-delivery" /></div>
		<a href="<?php echo $SITE_URL; ?>cart/" class="cls_cart_stk" >Your Cart (<?php echo count($_SESSION['cart']['item_id']) ?>)</a>
		
		<?php
		$cart = $_SESSION['cart'];
		$sub_total  = 0;
		$GST_per = Get_one_value('tax','tax_per',1,'id',$db);

		for($i=0;$i<count($cart['item_id']);$i++){
			$item_total  = $cart['item_price'][$i]*$cart['item_qty'][$i];
			$sub_total +=   $item_total;
			?>
			<div class="col-md-8 col-sm-8 col-xs-8" >
				<?php echo $cart['item_name'][$i].' (Rs.'.$cart['item_price'][$i].')'. ' X '.$cart['item_qty'][$i]; ?>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4" >
				Rs. <?php echo $item_total; ?><br />
				<a href="javascript:;" class="delete_item" data-id = "<?php echo $cart['item_id'][$i] ?>">Remove</a>
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
		<div class="col-md-8 col-sm-8 col-xs-8" >
			Sub Total
		</div>
		<div class="col-md-4 col-sm-4 col-xs-4" >
			Rs. <?php echo  number_format($sub_total, 2); ?>
		</div>
		<?php /*?><div class="col-md-8 col-sm-8 col-xs-8" >
			GST(<?php echo number_format($GST_per, 2); ?>%)
		</div>
		<div class="col-md-4 col-sm-4 col-xs-4" >
			Rs. <?php echo number_format($GST_charge, 2); ?>
		</div><?php */?>
		<div class="col-md-12 col-sm-12 col-xs-12" ><hr /></div>
		<div class="col-md-8 col-sm-8 col-xs-8" >
			Total
		</div>
		<div class="col-md-4 col-sm-4 col-xs-4" >
			Rs. <?php echo number_format($total_of_cart, 2); ?>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12" ><hr /></div>
		<div class="col-md-12 col-sm-12 col-xs-12" >
			<div class="send" align="center" ><button type="button" id='btn_ckeckout' style="width: 100%" onclick="javascript:window.location.href='<?php echo $SITE_URL ?>cart/'">Checkout</button>
			<br />Product price included with <?php echo $GST_per ?>% GST.
			</div>
		</div>
		
		<?php }else{ ?>
		<div class="col-md-12 col-sm-12 col-xs-12" >
			<strong>Your cart is empty.</strong>
		</div>
		<?php } ?>
		<div class="col-md-12 col-sm-12 col-xs-12" ><hr /></div>
		
	</div>
<?php } ?>