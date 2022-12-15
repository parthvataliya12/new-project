<?php 

 include('connect.php');

 

 if(!isset($_SESSION['paragone_user'])&&$_SESSION['paragone_user']['id']==''){

   header("location:".$SITE_URL."login/?chk=N");

 }

$qry_orders = "SELECT * FROM order_master WHERE user_id  = ".$_SESSION['paragone_user']['id']." ORDER BY id DESC";

$res_orders = mysqli_query($db,$qry_orders);



 ?>

 <!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->

<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->

<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->

<!--[if gt IE 8]><!--> 

<html class="no-js"> <!--<![endif]-->





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

                                <h2>ORDER HISTORY</h2>

                                

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

                                  <th>#</th>

                                  <th width="20%">Order No.</th>

                                  <th width="20%">Status</th>

                                  <th width="20%">Date</th>

                                  <th>Total</th>

                                  <th>Action</th>

                                </tr>

                              </thead>

                              <tbody>

                              <?php

                              $i=1; 

                                while($row_orders = mysqli_fetch_array($res_orders)){

                                  

                               ?>

                                <tr>

                                   <th scope="row"><?php echo $i; ?></th>

                                  <td>#<?php echo $row_orders['order_id'] ?></td>

                                  <td>
                                  	<?php //echo $row_orders['order_total_items'] ?>
                                  	<?php
								   switch($row_orders['order_status'])

									{

										case W:

											echo "<span class='label label label-warning'>Pending</span>";

											break;

										case P:

											echo "<span class='label label label-primary'>Processing</span>";

											break;

										case C:

											echo "<span class='label label label-success'>Complete</span>";

											break;

										case X:

											echo "<span class='label label label-danger'>Cancel</span>";

											break;
											
										case 'Success':

											echo "<span class='label label label-success'>Success</span>";

											break;
											
										case 'Failure':

											echo "<span class='label label label-danger'>Failure</span>";

											break;	
										
										case 'Aborted':

											echo "<span class='label label label-danger'>Aborted</span>";

											break;	
											
										case 'Invalid':

											echo "<span class='label label label-danger'>Invalid</span>";

											break;	
											
										default: 
											echo "<span class='label label label-info'>Received</span>";

											break;

									}
								    ?>
                                  </td>

                                  <td><?php echo date('d/m/Y',strtotime($row_orders['order_date'])) ?></td>

                              

                                  <td>Rs. <?php echo $row_orders['order_amount'] ?></td>

                                  <td><a download href="<?php echo $SITE_URL; ?>invoices/<?php echo $row_orders['order_id'] ?>.pdf">Download Invoice</a></td>

                                </tr>

                                <?php $i++;} ?>

                              </tbody>

                            </table>        

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