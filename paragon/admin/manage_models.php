<?php include ('../connect.php'); ?>

<?php

if($_SESSION['user']['type']!='AdmiN')

{

		header('Location:'.$SITE_URL);

}



if(isset($_GET['act']) && $_GET['act']=='delete'){

	

	$eid = $_GET['id'];

	$selQry = "select * from models where id = ".$eid;

	$ResQry = mysqli_query($db,$selQry);



		 

		

	if(mysqli_num_rows($ResQry))

	{ 

		

		$recQry = mysqli_fetch_array($ResQry);

		

		

		$image_name = $recQry['model_display_picture']; 

		if(@file_exists("../images/product_images/".$image_name) && $image_name!=""){

		   @unlink("../images/product_images/".$image_name);

		}

		

		$qry_images = "SELECT * FROM model_images where model_id = ".$eid;

		$res_qry_images = mysqli_query($db,$qry_images);

		if(mysqli_num_rows($res_qry_images))

		{

			while($row_images = mysqli_fetch_array($res_qry_images))

			{

				if(@file_exists("../images/product_images/other_images/".$row_images['image_name']) && $row_images['image_name']!="")

				{

				   @unlink("../images/product_images/other_images/".$row_images['image_name']);

				}

			}

		}

		

		

		

		$delQry = "delete from models where id = ".$eid;

		mysqli_query($db,$delQry);

		



		$url = $SITE_URL.'admin/manage_models.php?msg=del';

		header("Location:".$url);

		exit;

	}

}







$Qry = "SELECT * FROM models order by id DESC";

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

      <h1 class="page-heading">Models</h1>

    </div>

    <div class="col-sm-4 text-right hidden-xs">

      <ol class="breadcrumb push-10-t">

        <li><a class="link-effect" href="add_model.php">Add Model</a></li>

      </ol>

    </div>

  </div>

</div>

<!-- END Page Header -->

<!-- END Stats -->

<!-- Page Content -->

<div class="content">

  <!-- Full Table -->

  <div class="block">

    

    <div class="block-content">

     <form id="manage" name="manage"  method="post">

        <table class="table table-bordered table-striped js-dataTable-full">

          <thead>

            <tr>

              <th  width="5%" class="text-center"></th>

              <th  width="10%">Model</th>

              <th  width="10%">Brand</th>

              <th class="hidden-xs" >Picture</th>

              

			  <th class="hidden-xs" width="10%">Display Order&nbsp;<br><a href="javascript:void(0);" onClick="javascript:saveorder('models')" title="Save Order">Save</a></th>

              <th width="5%">Action</th>

              <th width="5%" class="hidden-xs">status</th>

            </tr>

          </thead>

          <tbody>

            <?php while($Row = mysqli_fetch_array($Res_manager)){?>

            <tr>

              <td class="text-center"><?php echo $Row['setord']; ?></td>

              <td class="font-w600"><?php echo $Row['model_name']; ?></td>

              <td class="font-w600"><?php echo Get_one_value('brands','brand_name',$Row['brand_id'],'id',$db); ?></td>

              <td class="font-w600 hidden-xs"><img src="<?php echo $SITE_URL?>images/product_images/<?php echo $Row['model_display_picture']; ?>"/ class="img-responsive" style="width:30%"></td>

              

			  <td class="hidden-xs"><input type="text" size="5"  id="setord_<?php echo $Row['id'];?>" name="setord_<?php echo $Row['id'];?>" onKeyPress="return numOnly(job_details)" value="<?php echo $Row['setord'];?>" class="form-control" style="text-align:center; width:75%;" /></td>

              <td class="text-center "><div class="btn-group"> <a href="add_model.php?id=<?php echo $Row['id']; ?>">

                  <button data-original-title="Edit Model" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title=""><i class="fa fa-pencil"></i></button>

                  </a>

				    <a href="?id=<?php echo $Row['id']; ?>&act=delete" onclick="javascript:if(confirm('Esta seguro que desea borrar?'))return true; else return false;" >

				   <button data-original-title="Delete Model" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title=""><i class="fa fa-times"></i></button></a>

                </div></td>

              <td class="text-center hidden-xs"><?php if($Row['status'] == 'Y'){ ?>

                <i class="fa fa-check text-info"></i>

                <?php }else{?>

                <i class="fa fa-close  text-danger"></i>

                <?php }?>

              </td>

            </tr>

            <?php } ?>

          </tbody>

        </table>

      </form>

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

<script src="<?php echo $one->assets_folder; ?>/js/pages/base_tables_datatables.js"></script>

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

