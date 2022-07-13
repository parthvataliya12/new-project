<?php include ('../connect.php'); ?>

<?php

if($_SESSION['user']['type']!='AdmiN')

{

		header('Location:'.$SITE_URL);

}

$Err = '';

$Suc = '';

if(isset($_GET['act']) && $_GET['act']=='delete'){

	$eid = $_GET['id'];

	$selQry = "select * from email_subscribers where id = '".$eid."'";

	$myQry = mysqli_query($db,$selQry);

	

	if(mysqli_num_rows($myQry)){ 

		

		$delQry = "delete from email_subscribers where id = '".$eid."'";

		mysqli_query($db,$delQry);

		$delQry = "delete from manager_user where user_id = '".$eid."'";

		mysqli_query($db,$delQry);



		$url = $SITE_URL.'admin/manage_subscribers.php?msg=del';

		header("Location:".$url);

		exit;

	}

}



if(isset($_GET['msg']) && $_GET['msg'] == 'del'){

	$Err = 'Subscriber deleted successfully';	

}

$Qry = "SELECT * FROM email_subscribers order by id ASC";

$Res_manager = mysqli_query($db,$Qry);



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

      <h1 class="page-heading">Subscribers </h1>

    </div>

    <div class="col-sm-4 text-right hidden-xs">

      <ol class="breadcrumb push-10-t">

        <li>&nbsp;</li>

      </ol>

    </div>

  </div>

</div>

<!-- END Page Header -->

<!-- END Stats -->

<?php if($Err != ""){ ?>

<div class="col-sm-12">&nbsp;</div>

<div class="col-sm-12">

    <div class="alert alert-info alert-dismissable">

        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>

        <p><?php echo $Err; ?></p>

    </div>

</div>

<div class="row"></div>

<?php } ?>

<!-- Page Content -->

<div class="content">

  <!-- Full Table -->

  <div class="block">

    

    <div class="block-content">

   

        <table class="table table-bordered table-striped js-dataTable-full">

          <thead>

            <tr>

              <th class="text-center"></th>

              <th class="hidden-xs">Email</th>

			 

              <th class="hidden-xs">Date</th>

              <th >Action</th>

            </tr>

          </thead>

          <tbody>

            <?php $i=1;while($Row = mysqli_fetch_array($Res_manager)){?>

            <tr>

              <td class="text-center"><?php echo $i; ?></td>

              <td class="font-w600 hidden-xs"><?php echo $Row['email']; ?></td>

			 

              <td class="font-w600 hidden-xs"><?php echo date("d-m-Y H:i",strtotime($Row['register_date'])); ?></td>

              <td class="text-center "><div class="btn-group"> <a href="add_user.php?id=<?php echo $Row['id']; ?>">

                 
				   <a href="?id=<?php echo $Row['id']; ?>&act=delete" onclick="javascript:if(confirm('Are you sure to delete?'))return true; else return false;" >

                  <button data-original-title="Delete User" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title=""><i class="fa fa-times"></i></button></a>

				   

                </div></td>

              

            </tr>

            <?php $i++;} ?>

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

<script src="<?php echo $one->assets_folder; ?>/js/pages/base_subscribers_table.js"></script>

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

