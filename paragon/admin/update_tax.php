<?php include ('../connect.php'); ?>
<?php
if($_SESSION['user']['type']!='AdmiN')
{
		header('Location:'.$SITE_URL);
}
@$SubmitButton 	= $_POST["submit_btn"];
$id =1;
$mode='Add ';
if(isset($SubmitButton) && $SubmitButton <> "")
{ 
	foreach($_POST as $key=>$value)
	{
		$$key=trim($value);	
	}
		$ins='';
		$whr='';
		if($hid=="")
		{
			$ins.="insert into tax set ";
			$whr='';
			$sentMsg='success';
			
		}else{
			$ins.="update tax set ";
			$whr.=" where id='".$hid."' ";
			$sentMsg='update';
		}
		
		$ins.=" 
			tax_per ='".addslashes($tax_per)."',
			tax_no ='".addslashes($tax_no)."'
			 ";

	if($hid=="")
	{
		mysqli_query($db,$ins) or die (mysqli_error($db));
		header('Location:update_tax.php?msg='.$sentMsg);
	}
	else if($hid)
	{
		$ins.=$whr;
		mysqli_query($db,$ins) or die (mysqli_error($db));
		header('Location:update_tax.php?msg='.$sentMsg);
	}
}
if(isset($id) && $id != '')
{	
	$mode='Edit ';
	$Qry = "SELECT * FROM tax WHERE id =".$id;
	$Res = mysqli_query($db,$Qry) or die(mysqli_error($db));
	$Row = mysqli_fetch_array($Res);
	$tax_per = $Row['tax_per'];
	$tax_no = $Row['tax_no'];
}
?>
<?php require 'inc/config.php'; ?>
<?php require 'inc/views/template_head_start.php'; ?>
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css">
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/magnific-popup/magnific-popup.min.css">
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/select2/select2.min.css">
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/select2/select2-bootstrap.css">
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/jquery-tags-input/jquery.tagsinput.min.css">
<link rel="stylesheet" href="assets/js/plugins/summernote/summernote.min.css">
<link rel="stylesheet" href="assets/js/plugins/summernote/summernote-bs3.min.css">

<?php require 'inc/views/template_head_end.php'; ?>
<?php require 'inc/views/base_head.php'; ?>
<!-- Page Header -->

<div class="content bg-gray-lighter">
  <div class="row items-push">
    <div class="col-sm-8">
      <h1 class="page-heading"><?php echo $mode;?> GST Details</h1>
    </div>
    <div class="col-sm-4 text-right hidden-xs">
      <ol class="breadcrumb push-10-t">
        <li><a class="link-effect" href="dashboard.php"> Home</a></li>
        <li>GST </li>
       
      </ol>
    </div>
  </div>
</div>
<!-- END Page Header -->
<!-- Page Content -->
<div class="content content-narrow">
  <!-- Bootstrap Design -->
  <div class="row">
    <div class="col-md-12">
      <!-- Default Elements -->
      <div class="block">
        <div class="block-content block-content-narrow">
          <form class="js-validation-bootstrap form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input  type="hidden" id="hid" name="hid" value="<?php echo $id;?>"> 
			<input  type="hidden" id="max_ord" name="max_ord" value="<?php echo $max_ord;?>"> 
            <div class="form-group">
              <label class="col-xs-12" for="a_name">GST in percent (%)</label>
              <div class="col-sm-12">
                <input class="form-control" type="text" id="tax_per" name="tax_per" value="<?php echo $tax_per?>" />
              </div>
            </div>
			<div class="form-group">
              <label class="col-xs-12" for="a_name">GST Number</label>
              <div class="col-sm-12">
                <textarea class="form-control" rows="7" name="tax_no" id="tax_no"><?php echo $tax_no?></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                <button class="btn btn-sm btn-primary" type="submit" name='submit_btn' value="submit">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- END Default Elements -->
    </div>
  </div>
  <!-- Bootstrap Design -->
</div>
<!-- END Page Content -->
<?php require 'inc/views/base_footer.php'; ?>
<?php require 'inc/views/template_footer_start.php'; ?>
<!-- Page JS Plugins -->
<script src="<?php echo $one->assets_folder; ?>/js/plugins/jquery-validation/jquery.validate.min.js"></script>

<!-- Page JS Code -->
<script>
	var BaseFormValidation = function() {
    // Init Bootstrap Forms Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
    var initValidationBootstrap = function(){
        jQuery('.js-validation-bootstrap').validate({
            errorClass: 'help-block animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function(error, e) {
                jQuery(e).parents('.form-group > div').append(error);
            },
            highlight: function(e) {
                jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
                jQuery(e).closest('.help-block').remove();
            },
            success: function(e) {
                jQuery(e).closest('.form-group').removeClass('has-error');
                jQuery(e).closest('.help-block').remove();
            },
            rules: {
                'tax_per': {
                    required: true
                }
            },
            messages: {
                'a_type': 'Please Enter GST in Percent'
            }
        });
    };
    return {
        init: function () {
            // Init Bootstrap Forms Validation
            initValidationBootstrap();
        }
    };
}();
// Initialize when page loads
jQuery(function(){ BaseFormValidation.init(); });
</script>
<?php require 'inc/views/template_footer_end.php'; ?>