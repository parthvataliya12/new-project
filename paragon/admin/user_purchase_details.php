<?php include ('../connect.php'); ?>
<?php
if($_SESSION['user']['type']!='AdmiN')
{
		header('Location:'.$SITE_URL);
}

if(isset($_GET['id']) && $_GET['id']!=""){
	$id = $_GET["id"];
}else{
	$id='';
}
	$Qry = "SELECT * FROM number_pro_user WHERE user_id =".$id;
	$Res = mysqli_query($db,$Qry) or die(mysqli_error($db));
	$total_rows = mysqli_num_rows($Res)
	

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
<!-- END Page Header -->
<!-- END Stats -->
<!-- Page Content -->
<div class="content">
  <!-- Full Table -->
  <div class="row">
    <div class="col-md-6">
      <div class="block">
        <div class="block-header bg-gray-lighter">
          <h3 class="block-title"><a href="manage_users.php"><<< Go Back</a></h3>
        </div>
        <div class="block-content">
		<h4 class=" text-center">Usuario: <?php echo  Get_one_value("user_details","u_name",$id,"id",$db);?>  <?php echo  Get_one_value("user_details","u_lastname",$id,"id",$db);?></h2>
          <div class="table-responsive">
		  
            <?php if($total_rows>0){?>
            <table class="table table-striped table-vcenter">
              <thead>
                <tr>
                  <th class="text-center">Producto</th>
                  <th class="text-center">N&uacute;mero</th>
                </tr>
              </thead>
              <tbody>
                <?php while($Row = mysqli_fetch_array($Res)){
					$pro_name = Get_one_value("products","product_name",$Row['product_id'],"id",$db);
					?>
                <tr>
                  <td class="text-center"><strong><?php echo $pro_name;?></strong></td>
                  <td class="text-center"><?php echo $Row['num'];?></td>
                </tr>
                <?php }?>
              </tbody>
            </table>
            <?php }else{?>
            <h1>No se ha encontrado ninguna compra</h1>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
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
