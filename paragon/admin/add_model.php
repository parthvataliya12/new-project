<?php include ('../connect.php'); ?>
<?php
if($_SESSION['user']['type']!='AdmiN')
{
		header('Location:'.$SITE_URL);
}
@$SubmitButton 	= $_POST["submit_btn"];
if(isset($_GET['id']) && $_GET['id']!=""){
	$id = $_GET["id"];
}else{
	$id='';
}
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
			$qrymaxord = "SELECT max(setord) AS max_ord  from models";
			$resmaxord =  mysqli_query($db,$qrymaxord);
			$rowmaxord  = mysqli_fetch_assoc($resmaxord);
			
			$max_ord = $rowmaxord['max_ord'];
			$max_ord = $max_ord +1;
						
			$ins.="insert into models set ";
			$whr='';
			$sentMsg='success';
			//$product_post_date = "product_post_date ='".date('Y-m-d H:i:s')."',";
			
			$slug = clean_url($_POST['model_name']);
			
			
			
			
		}else{
		
		
			$ins.="update models set ";
			$whr.=" where id='".$hid."' ";
			$sentMsg='update';
			$product_post_date ='';
			$slug = clean_url($_POST['model_name']);
		}
		
		if($_FILES['model_display_picture']['name']!="")
		{
			if($_FILES['model_display_picture']['name']!="" && file_exists("../images/product_images/".$_POST['h_display_image']))
			{
				@unlink("../images/product_images/".$_POST['h_display_image']);
			}
				$tmp_name = $_FILES['model_display_picture']['tmp_name'];
				$fileNm = $_FILES['model_display_picture']['name'];
				$image_name = rand().'_'.preg_replace("/[^A-Za-z0-9.]/",'_',$fileNm);
				$filePath = "../images/product_images/".$image_name;
				copy($tmp_name,$filePath);
		}
		else
		{
				$image_name	= $_POST['h_model_display_picture'];
		}
		
		
		
		$ins.=" 
			model_type ='".addslashes($model_type)."',
			brand_id = '".addslashes($brand_id)."',
			model_name ='".addslashes($model_name)."',
			model_description = '".addslashes($model_description)."',
			model_display_picture = '".addslashes($image_name)."',
			status = '".addslashes($status)."',
			slug = '".addslashes($slug)."',
			setord = '".addslashes($max_ord)."',
			meta_title = '".addslashes($meta_title)."',
			meta_description = '".addslashes($meta_description)."',
			meta_keywords = '".addslashes($meta_keywords)."'
			 ";
	
	
	if($hid=="")
	{
		mysqli_query($db,$ins) or die (mysqli_error($db));
		$pid = mysqli_insert_id($db);
		//////////////OTHER IMAGES///////////////////
		if(count($_FILES['model_images'])>0)
		{
			for($i=0;$i<count($_FILES['model_images']);$i++)
			{
				if($_FILES['model_images']['name'][$i]!="")
				{
					
						$tmp_name1 = $_FILES['model_images']['tmp_name'][$i];
						$fileNm1 = $_FILES['model_images']['name'][$i];
						$image_name1 = rand().'_'.preg_replace("/[^A-Za-z0-9.]/",'_',$fileNm1);
						$filePath1 = "../images/product_images/other_images/".$image_name1;
						if(copy($tmp_name1,$filePath1))
						{
							$qry="INSERT INTO model_images SET 
							model_id=".$pid.",
							model_image='".$image_name1."'";
							mysqli_query($db,$qry) or die(mysql_error($db));
						}
				}
			}
		}
		//////////////OTHER IMAGES///////////////////
		
		
		
		header('Location:manage_models.php?msg='.$sentMsg);
	}
	else if($hid)
	{
		$ins.=$whr;
		mysqli_query($db,$ins) or die (mysqli_error($db));
		
		
		//////////////OTHER IMAGES///////////////////
		if(count($_FILES['model_images'])>0)
		{
			for($i=0;$i<count($_FILES['model_images']);$i++)
			{
				
				if($_FILES['model_images']['name'][$i]!="")
				{
					
						$tmp_name1 = $_FILES['model_images']['tmp_name'][$i];
						$fileNm1 = $_FILES['model_images']['name'][$i];
					 	$image_name1 = rand().'_'.preg_replace("/[^A-Za-z0-9.]/",'_',$fileNm1);
						$filePath1 = "../images/product_images/other_images/".$image_name1;
						if(copy($tmp_name1,$filePath1))
						{
							$qry="INSERT INTO model_images SET 
							model_id=".$hid.",
							model_image='".$image_name1."'";
							mysqli_query($db,$qry) or die(mysql_error($db));
						}
				}
			}
		}
		//////////////OTHER IMAGES///////////////////
		
	
		
		
		header('Location:manage_models.php?msg='.$sentMsg);
		
	}
	
	
	
}
if(isset($id) && $id != '')
{	
	
	$mode='Edit ';
	$Qry = "SELECT * FROM models WHERE id =".$id;
	$Res = mysqli_query($db,$Qry) or die(mysqli_error($db));
	
	$Row = mysqli_fetch_array($Res);
	
	$model_name = $Row['model_name'];
	$model_type = $Row['model_type'];
	$brand_id = $Row['brand_id'];
	$model_display_picture = $Row['model_display_picture'];
	$model_description = $Row['model_description'];
	$status = $Row['status'];
	$max_ord = $Row['setord'];
	$meta_title = $Row['meta_title'];
	$meta_description = $Row['meta_description'];
	$meta_keywords = $Row['meta_keywords'];
	
	
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
      <h1 class="page-heading"><?php echo $mode;?> Model</h1>
    </div>
    <div class="col-sm-4 text-right hidden-xs">
      <ol class="breadcrumb push-10-t">
        <li>Home</li>
        <li><a class="link-effect" href="manage_models.php"> Models </a></li>
        <li><?php echo $mode;?> Model</li>
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
              <label class="col-xs-12" for="brand_id">Select Brand</label>
              <div class="col-sm-12">
                <select class="js-select2 form-control" id="brand_id" name="brand_id" style="width: 100%;">
                    	<?php 
                    		$qry_brands = "SELECT * FROM brands ORDER BY id";
                    		$res_brands = mysqli_query($db,$qry_brands);
                    		while($row_brands = mysqli_fetch_assoc($res_brands)){

                    	 ?>
                        <option value="<?php echo  $row_brands['id']?>" <?php echo  $row_brands['id']==$brand_id?'selected':'';?> ><?php echo  $row_brands['brand_name']?></option>
                        <?php } ?>
                   </select>

              </div>
            </div>
             <div class="form-group">
              <label class="col-xs-12" for="model_type">Select Type</label>
              <div class="col-sm-12">
                <select class="js-select2 form-control" id="model_type" name="model_type" style="width: 100%;">
                    	
                        <option value="1" <?php  echo $model_type==1?'selected':'';?> >Scooter</option>
                        <option value="2" <?php  echo $model_type==2?'selected':'';?>>Bike</option>
                     
                   </select>

              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12" for="model_name">Model Name</label>
              <div class="col-sm-12">
                <input class="form-control" type="text" id="model_name" name="model_name" value="<?php echo $model_name?>" />
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12" for="model_description">Model Description</label>
              <div class="col-sm-12">
				 <textarea class="js-summernote" id="model_description"  name="model_description"><?php if($model_description) echo $model_description;?></textarea>

              </div>
            </div>
            
			
			<input  type="hidden" id="h_model_display_picture" name="h_model_display_picture" value="<?php echo $model_display_picture;?>">
			<div class="form-group">
              <label class="col-xs-12" for="model_display_picture">Model Display Picture</label>
              <div class="col-sm-12">
                <input class="form-control" type="file" id="model_display_picture" name="model_display_picture">
           	 </div>
			</div>
			<?php if($model_display_picture){?>
			<div class="form-group">
              <div class="col-sm-3 col-md-3">
                <img  src="<?php echo $SITE_URL?>images/product_images/<?php echo $model_display_picture;?>" class="img-responsive"/>   
           	 </div>
			</div>
			<?php }?>
			<div class="form-group">
              <label class="col-xs-12" for="model_images">Other Model Pictures</label>
              <div class="col-sm-12">
                <input class="form-control" type="file" id="model_images" name="model_images[]" multiple>
           	 </div>
			 
			</div><?php 
				if($id)
				{ 
					$qry_pro_images = "SELECT * FROM model_images WHERE model_id = ".$id;
					$res_pro_imgs = mysqli_query($db,$qry_pro_images);
					$total_imgs = mysqli_num_rows($res_pro_imgs);
					if($total_imgs>0)
					{?>
					<div class="row items-push js-gallery-advanced"><?php 
						while($row_pro_imgs = mysqli_fetch_array($res_pro_imgs))
						{
							if($row_pro_imgs['model_image']!='' && file_exists("../images/product_images/other_images/".$row_pro_imgs['model_image'])){?>
							
								<div class="col-sm-3 col-md-3 col-lg-3 animated fadeIn">
									<div class="img-container fx-img-rotate-r">
									<img class="img-responsive" src="<?php echo $SITE_URL;?>images/product_images/other_images/<?php echo $row_pro_imgs['model_image'];?>" alt="">
										<div class="img-options">
											<div class="img-options-content">
												<a class="btn btn-sm btn-default img-lightbox" href="<?php echo $SITE_URL;?>images/product_images/other_images/<?php echo $row_pro_imgs['model_image'];?>">
													<i class="fa fa-search-plus"></i> 
												</a>
												<div class="btn-group btn-group-sm">
													<a class="btn btn-default" href="javascript:void(0)" onclick="delImg(<?php echo $row_pro_imgs['id'];?>)"><i class="fa fa-times"></i></a>
												</div>
											</div>
										</div>
									</div>
								</div><?php
							
							}
						}?>
				</div><?php 
					} 
				}?>
				
           
            
            <div class="form-group">
              <label class="col-xs-12">Status</label>
              <div class="col-xs-6">
                <label class="css-input css-radio css-radio-primary push-10-r">
                <input type="radio" name="status" value="Y"  <?php if ($id!='' && $status == "Y") {echo "checked='checked'";} else if ($id =='') {echo "checked='checked'";}?>>
                <span></span> Active </label>
                <label class="css-input css-radio css-radio-primary">
                <input type="radio" name="status" value="N"  <?php if ($id!='' && $status == "N") {echo "checked='checked'";} ?>>
                <span></span> Inactive </label>
              </div>
            </div>
            <hr class="hidden-print" style="border-top: 4px solid #eee;">
			   <div class="form-group">
              <label class="col-xs-12" for="meta_title">Meta Title</label>
              <div class="col-sm-12">
                <input class="form-control" type="text" id="meta_title" name="meta_title" value="<?php echo $meta_title?>" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12" for="meta_description">Meta Description</label>
              <div class="col-sm-12">
				 <textarea class="form-control" rows="6" id="meta_description"  name="meta_description"><?php if($meta_description) echo $meta_description;?></textarea>

              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12" for="meta_keywords">Meta Keywords</label>
              <div class="col-sm-12">
				 <textarea class="form-control" rows="6" id="meta_keywords"  name="meta_keywords"><?php if($meta_keywords) echo $meta_keywords;?></textarea>

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
<script src="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-datepicker/moment.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-datepicker/locale/es.js"></script>

<!-- Page JS Plugins -->
<script src="assets/js/plugins/summernote/summernote.min.js"></script>

<script src="<?php echo $one->assets_folder; ?>/js/plugins/magnific-popup/magnific-popup.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo $one->assets_folder; ?>/js/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>
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
                'brand_id': {
                    required: true
                   
                },
                'model_type': {
                    required: true
            
                },
                'model_name': {
                    required: true
                   
                },
                <?php if($id==''){ ?>
                'model_display_picture': {
                    required: true
                   
                },
                <?php } ?>
                'model_description': {
                    required: true
                   
                }
            },
            messages: {
                
                'brand_id': 'Please Select Brand',
                'model_type': 'Please Model Type',
                'model_name': 'Please Enter Model Name',
                 <?php if($id==''){?>
                'model_display_picture': 'Please Select Picture',
                <?php } ?>
                'model_description': 'Please Enter Details'
               
            }
        });
    };

    // Init Material Forms Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
  

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
<!-- Page JS Code -->
<script>
    $(function(){
        // Init page helpers (Magnific Popup plugin)
        App.initHelpers(['summernote','select2','magnific-popup']);
    });
</script>


<?php require 'inc/views/template_footer_end.php'; ?>
<script>
 /*jQuery('.js-datetimepicker').datetimepicker({
            weekStart: 1,
            autoclose: true,
            todayHighlight: true
        });*/

	
function delImg(img_id)
{	
		 jQuery.ajax({
				url: "ajax.inc.php",
				type : "POST",
				data: {
					flag: "delete_pro_image",
					id : img_id
				},
				success:function(data){
					if(data=='success')
					{
						location.reload();
					}
				}
			});
}	
</script>