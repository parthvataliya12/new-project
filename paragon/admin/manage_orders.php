<?php include ('../connect.php'); ?>

<?php

if($_SESSION['user']['type']!='AdmiN')

{

		header('Location:'.$SITE_URL);

}

$Qry = "SELECT * FROM order_master ORDER BY id DESC";

$Res_order= mysqli_query($db,$Qry);

?>

<?php require 'inc/config.php'; ?>

<?php require 'inc/views/template_head_start.php'; ?>

<!-- Page JS Plugins CSS -->

<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/datatables/jquery.dataTables.min.css">

<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/slick/slick.min.css">

<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/slick/slick-theme.min.css">

<?php require 'inc/views/template_head_end.php'; ?>

<?php require 'inc/views/base_head.php'; ?>

<!-- Page Header -->

<div class="content bg-gray-lighter">

  <div class="row items-push">

    <div class="col-sm-8">

      <h1 class="page-heading"> Orders </h1>

    </div>

    <?php /*?><div class="col-sm-4 text-right hidden-xs">

      <ol class="breadcrumb push-10-t">

        <li><a class="link-effect" href="add_order.php">Agregar  CITA</a></li>

      </ol>

    </div><?php */?>

  </div>

</div>

<!-- END Page Header -->

<!-- END Stats -->

<!-- Page Content -->

<div class="content">

  <!-- Full Table -->

  <div class="block">

    

    <div class="block-content">

   

        <table class="table table-bordered table-striped js-dataTable-full">

          <thead>

            <tr>

              <th class="text-center" width="5%"></th>

              <th>Order No.</th>

			  <th >USER</th>

             <th>Order Amount</th>

              <!--<th class="hidden-xs">Order Items</th>-->

			  

			  <th class="hidden-xs">Date</th>

			  <th class="hidden-xs">Payment Status</th>

        <th class="hidden-xs">Order Status</th>

              <th class="text-center">Action</th>

              

            </tr>

          </thead>

          <tbody>

            <?php while($Row = mysqli_fetch_array($Res_order)){?>

            <tr>

              <td class="text-center"><?php echo $Row['id']; ?></td>

			 

              <td class="font-w600">#<?php echo $Row['order_id']; ?></td>

			   <td class="font-w600"><?php echo Get_one_value("user_details","u_name",$Row['user_id'],"id",$db); ?></td>

              <td class="font-w600 hidden-xs">Rs. <?php echo number_format($Row['order_amount'],0,'','.'); ?></td>

              <!--<td class="font-w600 hidden-xs"><?php echo  $Row['order_total_items'] ?></td>-->

              <td class="font-w600 hidden-xs"><?php echo  date('d/m/Y H:i:s',strtotime($Row['trans_date'])) ?></td>

			    

				<td class="font-w600 hidden-xs">

			  	<?php 

					switch($Row['payment_status'])

					{

						case U:

							echo "<span class='label label label-danger'>Unpaid</span>";

							break;

						case P:

							echo "<span class='label label label-success'>Paid</span>";

							break;
							

						default: 

							echo "<span class='label label label-success'>Paid</span>";

							break;
					

					}

				?>

			  </td>

			  <td class="font-w600 hidden-xs">

			  	<?php 

					switch($Row['order_status'])

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

              <td class="text-center "><div class="btn-group"> <a href="add_order.php?id=<?php echo $Row['order_id']; ?>">

                  <button data-original-title="Edit Order" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title=""><i class="fa fa-pencil"></i></button>

                  </a>

                  <a href="view_order.php?id=<?php echo $Row['order_id']; ?>">

                  <button data-original-title="View Order" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title=""><i class="fa fa-eye"></i></button>

                  </a>

                  <a href="<?php echo $SITE_URL."invoices/".$Row['order_id'].".pdf"; ?>" download>

                  <button data-original-title="Download Invoice" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title=""><i class="fa fa-download"></i></button>

                  </a>

                  <?php /*?><button data-original-title="Remove Manager" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title=""><i class="fa fa-times"></i></button><?php */?>

                </div></td>

            </tr>

            <?php } ?>

          </tbody>

        </table>

    </div>

  </div>

  <!-- END Full Table -->

  <!-- Partial Table -->

</div>

<!-- END Page Content -->

<?php require 'inc/views/base_footer.php'; ?>

<?php require 'inc/views/template_footer_start.php'; ?>

<!-- Page JS Plugins -->

<script src="<?php echo $one->assets_folder; ?>/js/plugins/datatables/jquery.dataTables.min.js"></script>

<!-- Page JS Code -->

<script src="<?php echo $one->assets_folder; ?>/js/pages/order_datatables.js"></script>

<!-- Page Plugins -->

<script src="<?php echo $one->assets_folder; ?>/js/plugins/slick/slick.min.js"></script>

<!-- Page JS Code -->

<script>

    $(function(){

        // Init page helpers (Slick Slider plugin)

        App.initHelpers('slick');

    });

</script>

<?php require 'inc/views/template_footer_end.php'; ?>

