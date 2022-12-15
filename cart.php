<?php 

 include('connect.php');

 include_once('check-login.php');

 if(!isset($_SESSION['cart']))

 {

  header("location:".$SITE_URL."");

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


<?php $meta_title = 'Cart - Paragon Two Wheeler Accessories'; ?>

<?php $meta_keywords = 'Cart - Paragon Two Wheeler Accessories'; ?>

<?php $meta_desc = 'Cart - Paragon Two Wheeler Accessories'; ?>


<head>

      <?php include('head.php') ?>

      <style>

        table{ border:1px solid  #e7e7e7;}

          table input{
            width: 27%;margin-top:0px;color:#000;text-align:center;height: 35px;
          }

           table a img {

           margin-left: 5px;

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

                                <h2>Cart</h2>

                                

                            </div>

                        </div>

                   

                </div>

                </div>

            </div>



            





            <div class="cart">

                <div class="container"> 

                    <div class="row">

                        <div class="col-md-12">

                            <table class="table table-hover">

                              <thead>

                                <tr>

                                  <th width="5%" >#</th>

                                  <th width="35%">Product Name</th>

                                  <th width="10%">Price</th>

                                  <th width="30%">Qty</th>

                                  <th width="10%">Total</th>

                                  <th width="10%">Action</th>

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

                                  <td>

                                    <img class="increase" src="images/plus.png" alt="Increase" title="Increase" width="24" style="cursor: pointer;" data-id="<?php echo $cart['item_id'][$i] ?>" >
                                    <input min="1" type="number" name="" class="qty" value="<?php echo $cart['item_qty'][$i] ?>" />
                                    <img class="descrease" src="images/minus.png" alt="Descrease" title="Descrease" width="24" style="cursor: pointer;" data-id="<?php echo $cart['item_id'][$i] ?>" >

                                    <a href="javascript:;" class="update_qty" data-id="<?php echo $cart['item_id'][$i] ?>" alt="Update" title="Update" ><img src="images/refresh.png" alt="Update" title="Update" ></a>

                                    </td>

                                  <td>Rs. <?php echo $item_total; ?></td>

                                  <td><a href="javascript:;" class="delete_item" data-id = "<?php echo $cart['item_id'][$i] ?>">Remove</a></td>

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

                                  <td>Rs. <?php echo  number_format($sub_total, 2); ?></td>

                                </tr>

                                <?php /*?><tr>

                                  <td><strong>GST(<?php echo $GST_per ?>%)</strong></td>

                                  <td>Rs. <?php echo number_format($GST_charge, 2); ?></td>

                                </tr><?php */?>

                                <tr>

                                  <td><strong>Total</strong></td>

                                  <td><h3>Rs. <?php echo number_format($total_of_cart, 2); ?></h3></td>

                                </tr>

                              </tbody>

                            </table>

                            <div class="send" align="center" ><button type="button" id='btn_ckeckout' style="width: 100%" onclick="javascript:window.location.href='<?php echo $SITE_URL ?>checkout/'">Proceed to Checkout</button>
                            <br />
                            Product price included with <?php echo $GST_per ?>% GST.
                            </div>

                        </div>

                    </div>                                  

                </div>

            </div>

            <?php include('footer.php') ?>

        <!--<script src="js/vendor/jquery-1.11.0.min.js"></script>-->

        <!--<script src="js/bootstrap.js"></script>-->

        <script src="js/jis.jquery.min.js"></script>         

        <script src="js/vendor/jquery.gmap3.min.js"></script>





        <script type="text/javascript">

             $(document).ready(function(){

                $(".update_qty").each(function(){



                  $(this).on('click',function(){

                    var pro_qty = $(this).parent().find(".qty").val();

                    var pro_id = $(this).data('id');
					  
					  if(pro_qty == 0 || pro_qty < 0){
						  pro_qty = 1;
					  }

                    

                     $.ajax({

                              url: "<?php echo $SITE_URL ?>data/",

                              type : "POST",

                              data: {

                                  flag: "update_qty",

                                  pro_id : pro_id ,

                                  pro_qty: pro_qty,

                              },

                              success:function(data){

                                  if(data=='success')

                                  {

                                     location.reload();

                                  }

                              }

                          });

                  });

                });
				 
				 $(".descrease").each(function(){



                  $(this).on('click',function(){

                    var pro_qty = $(this).parent().find(".qty").val();
					  pro_qty = parseInt(pro_qty) - 1;

                    var pro_id = $(this).data('id');
					  
					  if(pro_qty == 0 || pro_qty < 0){
						  pro_qty = 1;
					  }

                    

                     $.ajax({

                              url: "<?php echo $SITE_URL ?>data/",

                              type : "POST",

                              data: {

                                  flag: "update_qty",

                                  pro_id : pro_id ,

                                  pro_qty: pro_qty,

                              },

                              success:function(data){

                                  if(data=='success')

                                  {

                                     location.reload();

                                  }

                              }

                          });

                  });

                });
				 
				 $(".increase").each(function(){



                  $(this).on('click',function(){

                    var pro_qty = $(this).parent().find(".qty").val();
					   pro_qty = parseInt(pro_qty) + 1;

                    var pro_id = $(this).data('id');
					  
					  if(pro_qty == 0 || pro_qty < 0){
						  pro_qty = 1;
					  }

                    

                     $.ajax({

                              url: "<?php echo $SITE_URL ?>data/",

                              type : "POST",

                              data: {

                                  flag: "update_qty",

                                  pro_id : pro_id ,

                                  pro_qty: pro_qty,

                              },

                              success:function(data){

                                  if(data=='success')

                                  {

                                     location.reload();

                                  }

                              }

                          });

                  });

                });

                $(".delete_item").each(function(){

                  $(this).on('click',function(){

                    var pro_id = $(this).data('id');

                     $.ajax({

                              url: "<?php echo $SITE_URL ?>data/",

                              type : "POST",

                              data: {

                                  flag: "delete_item",

                                  pro_id : pro_id 

                                 

                              },

                              success:function(data){

                                  if(data=='success')

                                  {

                                     location.reload();

                                  }

                              }

                          });

                  });

                });

                $("#btn_ckeckout").on('click',function(){

                   $.ajax({

                              url: "<?php echo $SITE_URL ?>data/",

                              type : "POST",

                              data: {

                                  flag: "cart_to_chkout",

                                                               

                              },

                              success:function(data){

                                  if(data=='success')

                                  {

                                    window.location.href='<?php $SITE_URL ?>checkout/';

                                  }

                              }

                          });

                });



            });

          </script>

   <script src="js/menu_slide.js"></script>

    </body>

</html>