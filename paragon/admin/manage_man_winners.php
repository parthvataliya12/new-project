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
	$selQry = "select * from winners_manual where id = ".$eid;
	$myQry = mysqli_query($db,$selQry);

		$recQry = mysqli_fetch_array($myQry); 
		$image_name = $recQry['image']; 
		if(@file_exists("../assets/images/winners/".$image_name) && $image_name!=""){
		   @unlink(".../assets/images/winners/".$image_name);
		}
	if(mysqli_num_rows($myQry)){ 
		
		$delQry = "delete from winners_manual where id = ".$eid;
		mysqli_query($db,$delQry);

		$url = $SITE_URL.'admin/manage_man_winners.php?msg=del';
		header("Location:".$url);
		exit;
	}
}

if(isset($_GET['msg']) && $_GET['msg'] == 'del'){
	$Err = 'Ganador eliminado correctamente';	
}
$Qry = "SELECT * FROM winners_manual ORDER BY id ASC";
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
      <h1 class="page-heading">Ganadores</h1>
    </div>
    <div class="col-sm-4 text-right hidden-xs">
      <ol class="breadcrumb push-10-t">
        <li><a class="link-effect" href="add_testimonial.php">Agregar Ganadore</a></li>
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
              <th>Ganador</th>
			   <th>Ganador Foto</th>
              <th >ACCION</th>
			  <th class="hidden-xs">ESTADO</th>
              
            </tr>
          </thead>
          <tbody>
            <?php while($Row = mysqli_fetch_array($Res_order)){?>
            <tr>
              <td class="text-center"><?php echo $Row['id']; ?></td>
			  <td class="text-center"><?php echo $Row['name']; ?></td>
              <td class="font-w600"><img src="../assets/images/winners/<?php echo $Row['image']; ?>"/ width="110" height="110"></td>
			  <td class="text-center "><div class="btn-group"> <a href="add_man_winner.php?id=<?php echo $Row['id']; ?>">
                  <button data-original-title="Editar Ganador" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title=""><i class="fa fa-pencil"></i></button>
                  </a>
				   <a href="?id=<?php echo $Row['id']; ?>&act=delete" onclick="javascript:if(confirm('Esta seguro que desea borrar?'))return true; else return false;" >
				   <button data-original-title="Retirar Ganador" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title=""><i class="fa fa-times"></i></button></a>
                 
                </div>
				</td>
			  <td class="text-center hidden-xs">
			  <?php if($Row['status'] == 'Y'){ ?>
                <p><i class="fa fa-check text-info"></i></p>
                <?php }else{?>
                <p><i class="fa fa-close  text-danger"></i></p>
                <?php }?>
              </td>
              
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
<script src="<?php echo $one->assets_folder; ?>/js/pages/slider_datatables.js"></script>
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
