<?php
include '../connect.php';
if($_SESSION['user']['type']!='AdmiN')
{
		header('Location:'.$SITE_URL);
}

$qry_user = "SELECT * FROM static_pages where id = 1";
$row_user = mysqli_fetch_array(mysqli_query($db,$qry_user));
?>
<?php require 'inc/config.php'; ?>
<?php require 'inc/views/template_head_start.php'; ?>
<?php require 'inc/views/template_head_end.php'; ?>
<?php require 'inc/views/base_head.php'; ?>

<!-- Page Header -->
<div class="content bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/img/photos/photo8@2x.jpg');">
    <div class="push-50-t push-15 clearfix">
        
        <h1 class="h2 text-white push-5-t animated zoomIn"><?php echo $row_user['u_name']?> <?php echo $row_user['u_lastname']?></h1>
        
    </div>
</div>
<!-- END Page Header -->


<!-- Page Content -->
<div class="content content-boxed">
  <!-- Demo Content -->
  <div class="block block-rounded">
    <div class="block-header">
	 <?php if(isset($_REQUEST['msg'])&&$_REQUEST['msg']=='update'){?>
    <div class="col-sm-12 col-lg-12" data-animation-class="zoomInDown">
      <!-- Success Alert -->
      <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
        <h3 class="font-w300 push-15">Exito..!</h3>
        <p><a href="javascript:void(0)" class="alert-link">Su perfil se actualiza.</a></p>
      </div>
      <!-- END Success Alert -->
    </div>
 <?php }?>
      <ul class="block-options">
        <li>
          <a href="<?php echo $SITE_URL;?>admin/edit_profile.php"><button type="button"><i class="si si-pencil"></i></button></a>
        </li>
      </ul>
      <div class="block-content block-content-full block-content-narrow">
        <div class="col-md-2 col-xs-3">
          <div class="col-md-12 mar-bot">Direccion: </div>
          <div class="col-md-12 mar-bot">Email: </div>
          <div class="col-md-12 mar-bot">Telefono: </div>
		  <div class="col-md-12 mar-bot">Facebook: </div>
		  <div class="col-md-12 mar-bot">Twitter: </div>
		   <div class="col-md-12 mar-bot">Bandera: </div>
		  
        </div>
		<div class="col-md-10 col-xs-9">
        <div class="col-md-12 mar-bot"><?php echo $row_user['company_address']?></div>
		<div class="col-md-12 mar-bot"><?php echo $row_user['company_email'];?></div>
		<div class="col-md-12 mar-bot"><?php echo $row_user['company_phone'];?></div>
		<div class="col-md-12 mar-bot"><?php echo $row_user['fb_link'];?></div>
		<div class="col-md-12 mar-bot"><?php echo $row_user['tw_link'];?></div>
		<div class="col-md-12 mar-bot"><img src="<?php echo $SITE_URL;?>assets/images/<?php echo $row_user['gplus_link'];?>"/ width="200" height="110"></div>
      </div>
      </div>
    </div>
  </div>
  <!-- END Demo Content -->
</div>
<!-- END Page Content -->

<?php require 'inc/views/base_footer.php'; ?>
<?php require 'inc/views/template_footer_start.php'; ?>
<?php require 'inc/views/template_footer_end.php'; ?>