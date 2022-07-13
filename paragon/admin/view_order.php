<?php include ('../connect.php'); ?>

<?php

if($_SESSION['user']['type']!='AdmiN')

{

		header('Location:'.$SITE_URL);

}

@$SubmitButton 	= $_POST["submit_btn"];

if(isset($_GET['id']) && $_GET['id']!=""){

	$order_id = $_GET["id"];

}else{

	header("location:manage_orders.php");

}





if(isset($id) && $id != '')

{	

	

	

	$qry_order = "SELECT T1.*, T2.*, T3.*,T4.* FROM order_master AS T1, order_items as T2, user_details as T3, access as T4 WHERE T1.order_id  = T2.order_id AND T1.user_id = T3.id AND T2.a_id = T4.id  AND T1.order_id = '".$order_id."'";

	$res_order_single = mysqli_query($db,$qry_order);

	$res_order_multi = mysqli_query($db,$qry_order);

	$row_order_single = mysqli_fetch_array($res_order_single);

	

	

	//print_r($model_id);exit;

	

	

}

?>

<?php require 'inc/config.php'; ?>

<?php require 'inc/views/template_head_start.php'; ?>

<?php require 'inc/views/template_head_end.php'; ?>

<?php require 'inc/views/base_head.php'; ?>

<!-- Page Header -->



<div class="content bg-gray-lighter">

  <div class="row items-push">

    <div class="col-sm-8">

      <h1 class="page-heading">Order #<?php echo $order_id; ?></h1>



    </div>

    <div class="col-sm-4 text-right hidden-xs">

      <ol class="breadcrumb push-10-t">

        <li>Home</li>

        <li><a class="link-effect" href="manage_orders.php"> Orders </a></li>

        <li>order Details</li>

      </ol>

    </div>

  </div>

</div>

<!-- END Page Header -->

  <!-- Main Container -->

   

<!-- Page Content -->

<div class="content content-boxed">

   



    <!-- Products -->

    <div class="block">

        <div class="block-header bg-gray-lighter">

            <h3 class="block-title">Items</h3>

        </div>

        <div class="block-content">

            <div class="table-responsive">

                <table class="table table-borderless table-striped table-vcenter">

                    <thead>

                        <tr>

                           

                            <th>Item Name</th>

                           

                           

                            <th class="text-right" style="width: 10%;">UNIT COST</th>

                             <th class="text-center">QTY</th>

                            <th class="text-right" style="width: 10%;">PRICE</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php while($row_order_multi= mysqli_fetch_array($res_order_multi)){ ?>

                        <tr>

                           

                            <td><?php echo $row_order_multi['a_name'] ?></td>

                            

                            <td class="text-right">Rs. <?php echo $row_order_multi['a_price'] ?></td>

                            <td class="text-center"><strong><?php echo $row_order_multi['a_qty'] ?></strong></td>

                            <td class="text-right">Rs. <?php echo ($row_order_multi['a_price']*$row_order_multi['a_qty']) ?></td>

                        </tr>

                    <?php }?>

                        <tr>

                            <td colspan="4" class="text-right"><hr></td>

                            

                        </tr>

                        <tr>

                            <td colspan="3" class="text-right"><strong>SUB TOTAL</strong></td>

                            <td class="text-right">Rs. <?php echo $row_order_single['order_sub_total']?></td>

                        </tr>

                        <?php /*?><tr>

                            <td colspan="3" class="text-right"><strong>GST (<?php echo  $row_order_single['order_gst_per']?>%)</strong></td>

                            <td class="text-right">Rs. <?php echo  $row_order_single['order_gst']?></td>

                        </tr><?php */?>

                        <tr class="success">

                            <td colspan="3" class="text-right text-uppercase"><strong>Total</strong></td>

                            <td class="text-right"><strong>Rs. <?php  echo $row_order_single['order_amount']?></strong></td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- END Products -->



    <!-- Customer -->

    <div class="row">

        <div class="col-lg-6">

            <!-- Billing Address -->

            <div class="block">

                <div class="block-header bg-gray-lighter">

                    <h3 class="block-title">Billing/Shipping Details</h3>

                </div>

                <div class="block-content block-content-full">

                    <?php /*?><div class="h4 push-5"><?php  echo $row_order_single['u_name']; ?></div>

                    <address>

                       <?php  echo nl2br($row_order_single['u_address'])?><br><br>

                        <i class="fa fa-phone"></i> <?php  echo $row_order_single['u_phone']?><br>

                        <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)"><?php  echo $row_order_single['u_email']?></a>

                    </address><?php */?>
                    
					<div class="h4 push-5">Billing Detials</div>
                    <address>
                    	<?php  echo $row_order_single['billing_name']; ?><br />
                    	<?php  echo $row_order_single['billing_address']; ?><br />
                    	<?php  echo $row_order_single['billing_city']; ?> - <?php  echo $row_order_single['billing_zip']; ?><br />
                    	<?php  echo $row_order_single['billing_state']; ?> - <?php  echo $row_order_single['billing_country']; ?><br />
                    	<?php  echo $row_order_single['billing_tel']; ?><br />
                    	<?php  echo $row_order_single['billing_email']; ?><br /> 
                    	<strong>Note: </strong><?php  echo $row_order_single['billing_notes']; ?>
                    </address>

                    <div class="h4 push-5">Shipping Detials</div>
                    <address>
                    	<?php  echo $row_order_single['delivery_name']; ?><br />
                    	<?php  echo $row_order_single['delivery_address']; ?><br />
                    	<?php  echo $row_order_single['delivery_city']; ?> - <?php  echo $row_order_single['delivery_zip']; ?><br />
                    	<?php  echo $row_order_single['delivery_state']; ?> - <?php  echo $row_order_single['delivery_country']; ?><br />
                    	<?php  echo $row_order_single['delivery_tel']; ?><br />
                    </address>

                </div>

            </div>

            <!-- END Billing Address -->

        </div>

        <div class="col-lg-6">

            <!-- Shipping Address -->

            <div class="block">

                <div class="block-header bg-gray-lighter">

                <ul class="block-options">

                        <li>

                         <a href="add_order.php?id=<?php echo $row_order_single['order_id']; ?>">

                            <button type="button" data-toggle="tooltip" title="" data-original-title="Edit"><i class="si si-pencil"></i></button>

                        </a>

                        </li>

                        

                    </ul>

                    <h3 class="block-title">Payment Details</h3>



                </div>

                <div class="block-content block-content-full">

                    <div class="h4 push-5">Payment Method:&nbsp;&nbsp;&nbsp; <u><i><?php  echo $row_order_single['payment_mode']?></i></u></div>

                    <div class="h4 push-5">Payment Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>

                    	<?php 

							switch($row_order_single['payment_status'])

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
                                            
                                        case U:

											echo "<span class='label label label-danger'>Unpaid</span>";

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

                    </i></div>

                    

                </div>

            </div>

            <!-- END Shipping Address -->

        </div>

    </div>

    <!-- END Customer -->



    

</div>

<!-- END Page Content -->



  



<?php require 'inc/views/base_footer.php'; ?>

<?php require 'inc/views/template_footer_start.php'; ?>





<?php require 'inc/views/template_footer_end.php'; ?>

<script>

 

$( document ).ready(function() {

   

});



</script>