<?php 

 include('connect.php');

 include_once('check-login.php');

 if(!isset($_SESSION['cart']))

 {

  header("location:".$SITE_URL."login/");

  exit;

 }

 if(isset($_SESSION['cart'])&&count($_SESSION['cart']['item_id'])<=0){

   header("location:".$SITE_URL."brands/");

  exit;

 }

//unset($_SESSION['cart']);

           

$cart = $_SESSION['cart'];

$sub_total  = 0;

$GST_per = Get_one_value('tax','tax_per',1,'id',$db);

/*

 echo"<pre>";

print_r($cart);

 echo"</pre>";*/

/*echo"<pre>";

print_r($cart);*/





 ?>

 <!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->

<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->

<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->

<!--[if gt IE 8]><!--> 

<html class="no-js"> <!--<![endif]-->


<?php $meta_title = 'Checkout - Paragon Two Wheeler Accessories'; ?>

<?php $meta_keywords = 'Checkout - Paragon Two Wheeler Accessories'; ?>

<?php $meta_desc = 'Checkout - Paragon Two Wheeler Accessories'; 
	
$qry_user = "SELECT * FROM user_details WHERE id = ".$_SESSION['paragone_user']['id'];

$res_user  = mysqli_query($db,$qry_user);

$row_user = mysqli_fetch_array($res_user);
	
$order_id = $_SESSION['order_id'];

?>


<head>

      <?php include('head.php') ?>

      <style>

        table{

            border:1px solid  #e7e7e7;

           

        }

          table input{

            width: 27%;margin-top:0px;color:#000;text-align:center;height: 25px;

          }

           table a img {

           margin-left: 5px;

          }

        .error{

            border: 1px solid red !important;

        }

    </style>

</head>

    <body>

        <!--[if lt IE 7]>

            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>

        <![endif]-->



          <?php  include('nav.php'); ?>





			

            <div id="heading">            	

              	  <div class="container">                  	

                    <div class="row">                    	

                        <div class="col-md-12">

                            <div class="heading-content">

                                <h2>Checkout</h2>

                                

                            </div>

                        </div>

                   

                </div>

                </div>

            </div>



            





            <div class="cart">

                <div class="container"> 

                    <div class="row">
                       
                       <form method="post" name="customerData" action="<?php echo $SITE_URL; ?>do-payment.php" id="checkout_form" >
                       
                       	<div class="col-md-12 text-center"  >
                          
                          	<?php if(isset($_GET['e']) && $_GET['e'] == 'b'){ ?>
								<p style='color:#FF0000; text-align: center; font-weight: 700;' >Please fill all required fields!</p>
							<?php } ?>
                           
                           	<img src="<?php echo $SITE_URL; ?>images/free-delivery.gif" alt="Free Home Delivery" title="Free Home Delivery" style="background: #000;" >
                           
						</div>
                        
                        <div class="col-md-12">
                            
                            <h1 class="text-center" >Billing / Shipping Details</h1>
                            
						</div>
                       
                       <div class="message-form" >
                        
                        <div class="col-lg-5" style="border:1px solid #afafaf;padding: 15px;border-radius: 10px;box-shadow:  1px 1px 5px #888888; margin: 10px; " >

                        		<div class="name col-md-12" style="margin-bottom: 10px;" ><h2>Billing Info</h2></div>

                        		<div class="name col-md-12" style="margin-bottom: 10px;" >
                        			<label>Billing Name: </label>
                        			<input style="margin-top: 0px;" type="text" name="billing_name" id="billing_name" value="<?php echo $row_user['u_name']; ?>" />
								</div>
								
								<div class="name col-md-12" style="margin-bottom: 10px;" >
                        			<label>Billing Email: </label>
                        			<input style="margin-top: 0px;" type="text" name="billing_email" id="billing_email" value="<?php echo $row_user['u_email']; ?>" />
								</div>
								
								<div class="name col-md-12" style="margin-bottom: 10px;" >
                        			<label>Billing Phone: </label>
                        			<input style="margin-top: 0px;" type="text" name="billing_tel" id="billing_tel" value="<?php echo $row_user['u_phone']; ?>" />
								</div>
								
								<div class="name col-md-12" style="margin-bottom: 10px;" >
                        			<label>Billing Address: </label>
                        			<input style="margin-top: 0px;" type="text" name="billing_address" id="billing_address" value="" />
								</div>
								
								<div class="name col-md-12" style="margin-bottom: 10px;" >
                        			<label>Billing City: </label>
                        			<input style="margin-top: 0px;" type="text" name="billing_city" id="billing_city" value="" />
								</div>
								
								<div class="name col-md-12" style="margin-bottom: 10px;" >
                        			<label>Billing State: </label>
                        			<input style="margin-top: 0px;" type="text" name="billing_state" id="billing_state" value="" />
								</div>
								
								<div class="name col-md-12" style="margin-bottom: 10px;" >
                        			<label>Billing Pincode/Zip: </label>
                        			<input style="margin-top: 0px;" type="text" name="billing_zip" id="billing_zip" value="" />
								</div>
								
								<div class="name col-md-12" style="margin-bottom: 10px;" >
                        			<label>Billing Country: </label>
                        			<input style="margin-top: 0px;" type="text" name="billing_country" id="billing_country" value="" />
								</div>

                        </div>


                        <div class="col-lg-5" style="border:1px solid #afafaf;padding: 15px;border-radius: 10px;box-shadow:  1px 1px 5px #888888; float: right; margin: 10px;" >
                        
                        	<div class="name col-md-12" style="margin-bottom: 10px;" ><h2>Shipping Info</h2></div>
                        	
                        	<div class="name col-md-12" style="margin-bottom: 10px;" >                        		
								<label style="float: left; line-height: 25px;" >Same as billing?&nbsp;&nbsp;</label>
								<input style="margin-top: 0px; width: 25px; height: 25px; cursor: pointer;" type="checkbox" name="delivery_same_billing" id="delivery_same_billing" />
							</div>

							<div class="name col-md-12" style="margin-bottom: 10px;" >
								<label>Shipping Name: </label>
								<input style="margin-top: 0px;" type="text" name="delivery_name" id="delivery_name" value="" />
							</div>
                      
                      		<div class="name col-md-12" style="margin-bottom: 10px;" >
								<label>Shipping Phone: </label>
								<input style="margin-top: 0px;" type="text" name="delivery_tel" id="delivery_tel" value="" />
							</div>
                       
                       		<div class="name col-md-12" style="margin-bottom: 10px;" >
								<label>Shipping Address: </label>
								<input style="margin-top: 0px;" type="text" name="delivery_address" id="delivery_address" value="" />
							</div>
                       
                       		<div class="name col-md-12" style="margin-bottom: 10px;" >
								<label>Shipping City: </label>
								<input style="margin-top: 0px;" type="text" name="delivery_city" id="delivery_city" value="" />
							</div>                       
                       
                      		<div class="name col-md-12" style="margin-bottom: 10px;" >
								<label>Shipping State: </label>
								<input style="margin-top: 0px;" type="text" name="delivery_state" id="delivery_state" value="" />
							</div>
                       
                       		<div class="name col-md-12" style="margin-bottom: 10px;" >
								<label>Shipping Pincode/Zip: </label>
								<input style="margin-top: 0px;" type="text" name="delivery_zip" id="delivery_zip" value="" />
							</div>
                       
                       		<div class="name col-md-12" style="margin-bottom: 10px;" >
								<label>Shipping Country: </label>
								<input style="margin-top: 0px;" type="text" name="delivery_country" id="delivery_country" value="" />
							</div>

						</div>
                       
                       </div>
                       
                       
                       <div class="col-md-12" >&nbsp;</div>
                       <div class="col-md-12" >&nbsp;</div>
                       
                       <div class="col-md-12 text-center"  >
                           
                           	<img src="<?php echo $SITE_URL; ?>images/free-delivery.gif" alt="Free Home Delivery" title="Free Home Delivery" style="background: #000;" >
                           
						</div>
                       
                       <div class="col-md-12">
                            
                            <h1 class="text-center" >Confirm Your Order</h1>
                            
						</div>
                       
                       <div class="col-md-12" >&nbsp;</div>
                        

                        <div class="col-md-12">
                           

                            <table class="table table-hover">

                              <thead>

                                <tr>

                                  <th width="5%" >#</th>

                                  <th width="35%">Item Name</th>

                                  <th width="20%">Price</th>

                                  <th width="20%">Qty</th>

                                  <th width="20%" >Total</th>

                                </tr>

                              </thead>

                              <tbody>

                              <?php 

                                for($i=0;$i<count($cart['item_id']);$i++){

                                   $item_total  = $cart['item_price'][$i]*$cart['item_qty'][$i];

                                   $sub_total +=   $item_total;

                               ?>

                                <tr>

                                  <th scope="row"><?php echo $i+1; ?></th>

                                  <td><?php echo $cart['item_name'][$i] ?></td>

                                  <td>Rs. <?php echo $cart['item_price'][$i] ?></td>

                                  <td><?php echo $cart['item_qty'][$i] ?></td>

                                  <td>Rs. <?php echo $item_total; ?></td>

                                </tr>

                                <?php } 

                                  $GST_charge = ($sub_total*$GST_per)/100;
								  
								  $GST_charge = 0;

                                  $total_of_cart = $sub_total + $GST_charge;

                                ?>

                              </tbody>

                            </table>        

                        </div>

                        <div class="col-md-4" style="float:right">

                            <h1>Cart Total</h1>

                            <table class="table table-hover">

                              <tbody>

                                <tr>

                                  <td><strong>Subtotal</strong></td>

                                  <td>Rs. <?php  echo number_format($sub_total, 2, '.', ''); ?></td>

                                </tr>

                                <?php /*?><tr>

                                  <td><strong>GST(<?php echo $GST_per ?>%)</strong></td>

                                  <td>Rs. <?php  echo number_format($GST_charge, 2, '.', ''); ?></td>

                                </tr><?php */?>

                                <tr>

                                  <td><strong>Total</strong></td>

                                  <td><h3 style="margin: 0px;" >Rs. <?php  echo number_format($total_of_cart, 2, '.', ''); ?></h3></td>
                                  
                                  <?php
									$_SESSION['order_gst_per'] = $GST_per;
									$_SESSION['order_gst_charges'] = $GST_charge;
									$_SESSION['order_sub_total'] = $sub_total;
									$_SESSION['order_total'] = $total_of_cart;
								  ?>

                                </tr>
                                
                                <tr>
                                	<td colspan="2" class="send" align="center" ><button type="submit" id='btn_ckeckout' style="width: 100%" >Confirm and Pay</button><br />Product price included with <?php echo $GST_per ?>% GST.</td>
                                </tr>

                              </tbody>

                            </table>

                        </div>
                        
                        <div class="col-md-12" >
                        	<div class="send">
                            
                            	
                            	
                            		<input type="hidden" name="tid" id="tid" readonly />
                            		<input type="hidden" name="merchant_id" value="209556"/>
                            		<input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
                            		<input type="hidden" name="amount" value="<?php  echo number_format($total_of_cart, 2, '.', ''); ?>"/>
                            		<input type="hidden" name="currency" value="INR"/>
                            		<input type="hidden" name="redirect_url" value="<?php echo $SITE_URL; ?>ccavResponseHandler.php"/>
                            		<input type="hidden" name="cancel_url" value="<?php echo $SITE_URL; ?>ccavResponseHandler.php"/>
                            		<input type="hidden" name="language" value="EN"/>

                           
                            </div>
                        </div>
                        
                        </form>

                    </div>                                  

                </div>

            </div>

            <?php include('footer.php') ?>

        <!--<script src="js/vendor/jquery-1.11.0.min.js"></script>-->

        <!--<script src="js/bootstrap.js"></script>-->

        <script src="js/jis.jquery.min.js"></script>         

        <script src="js/vendor/jquery.gmap3.min.js"></script>

   		<script src="js/menu_slide.js"></script>
   		
   		<script src="js/jquery.validate.min.js"></script>

		<script language="javascript" >
		$(document).ready(function() {

					$("#checkout_form").validate({



					rules: {

						billing_name: "required",

						billing_email: "required",

						billing_tel: "required",

						billing_address: "required",

						billing_city: "required",

						billing_state: "required",

						billing_zip: "required", 
						
						billing_country: "required", 

						delivery_name: "required",

						delivery_tel: "required",

						delivery_address: "required",

						delivery_city: "required",

						delivery_state: "required",

						delivery_zip: "required", 
						
						delivery_country: "required" 

					},

					 errorPlacement: function(){

						return false;  // suppresses error message text

					 }

				});

				$("#u_email").keyup(function () {  
					$(this).val($(this).val().toLowerCase());  
				});

			});
		</script>
   		
   		<script>
			window.onload = function() {
				var d = new Date().getTime();
				document.getElementById("tid").value = d;
			};
			
			$("#delivery_same_billing").change(function() {
				if(this.checked) {
					$('#delivery_name').val($('#billing_name').val());
					$('#delivery_tel').val($('#billing_tel').val());
					$('#delivery_address').val($('#billing_address').val());
					$('#delivery_city').val($('#billing_city').val());
					$('#delivery_state').val($('#billing_state').val());
					$('#delivery_zip').val($('#billing_zip').val());
					$('#delivery_country').val($('#billing_country').val());
				}else{
					$('#delivery_name').val('');
					$('#delivery_tel').val('');
					$('#delivery_address').val('');
					$('#delivery_city').val('');
					$('#delivery_state').val('');
					$('#delivery_zip').val('');
					$('#delivery_country').val('');
				}
			});
			
		</script>

    </body>

</html>