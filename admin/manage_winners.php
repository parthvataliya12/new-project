<?php include ('../connect.php'); ?>
<?php
if($_SESSION['user']['type']!='AdmiN')
{
		header('Location:'.$SITE_URL);
}
$Qry = "SELECT * FROM winners ORDER BY id DESC";
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
      <h1 class="page-heading"> Recarga </h1>
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
              <th>Producto</th>
			  <th>ganador</th>
              <th>Tel&eacute;fono</th>
              <th class="hidden-xs">Num ganador</th>
			  <th class="hidden-xs">Email</th>
			  <th class="hidden-xs">Fecha</th>
              
              
            </tr>
          </thead>
          <tbody>
            <?php while($Row = mysqli_fetch_array($Res_order)){
			$qry_pro = "SELECT * FROM products WHERE id = ".$Row['product_id'];
			$row_pro = mysqli_fetch_assoc(mysqli_query($db,$qry_pro));
			$qry_usr = "SELECT * FROM user_details WHERE id = ".$Row['user_id'];
			$row_usr = mysqli_fetch_assoc(mysqli_query($db,$qry_usr));
			?>
            <tr>
              <td class="text-center"><?php echo $Row['id']; ?></td>
			 
              <td class="font-w600"><?php echo $row_pro['product_name']; ?></td>
			   <td class="font-w600"><?php echo $row_usr['u_name']." ".$row_usr['u_lastname']?></td>
              <td class="font-w600 hidden-xs"><?php echo $row_usr['u_phone']; ?></td>
              <td class="font-w600 hidden-xs"><?php echo $Row['num']; ?></td>
			   <td class="font-w600 hidden-xs"><?php echo $row_usr['u_email']; ?></td>
			  <td class="font-w600 hidden-xs"><?php echo date("d-m-Y H:i:s" ,strtotime($row_pro['draw_date'])); ?></td>
              
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
