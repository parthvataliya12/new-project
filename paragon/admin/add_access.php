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

	/*echo "<pre>";
	print_r($_POST);
	exit;*/
	
	foreach($_POST as $key=>$value){
		$$key=trim($value);	
	}
		//$model_id = json_encode($_POST['model_id']);
		$model_id = $_POST['model_id'];

		$ins='';
		$whr='';
		if($hid=="")
		{

			$qrymaxord = "SELECT max(setord) AS max_ord  from access";
			$resmaxord =  mysqli_query($db,$qrymaxord);
			$rowmaxord  = mysqli_fetch_assoc($resmaxord);

			$max_ord = $rowmaxord['max_ord'];
			$max_ord = $max_ord + 1;

			$ins.="insert into access set ";
			$whr='';
			$sentMsg='success';
			//$product_post_date = "product_post_date ='".date('Y-m-d H:i:s')."',";
			$slug_text = Get_one_value('brands','brand_name',$brand_id,'id',$db)." ".$_POST['a_name'];
			$slug = clean_url($slug_text);

			$qrySlug = "SELECT * from access where slug like '".$slug."%' ";
			$resSlug =  mysqli_query($db,$qrySlug);
			$TotalSlug = mysqli_num_rows($resSlug);
			if($TotalSlug > 0){
				$slugInc = $TotalSlug+1;
				$slug = $slug.'-'.$slugInc;
			}

			$slug = clean_url_dynamic($db, $slug, 'access');
			
			$qry_slug_chk = "SELECT * FROM access WHERE slug LIKE '".$slug."%' ";
			$res_slug_chk = mysqli_query($db,$qry_slug_chk);
			$slug_exist = mysqli_num_rows($res_slug_chk);

			if($slug_exist > 0){
				header('Location:manage_access.php?msg=Err');
				exit;
			}

		}else{
		
			$ins.="update access set ";
			$whr.=" where id='".$hid."' ";
			$sentMsg='update';

			/*$slug_text = Get_one_value('brands','brand_name',$brand_id,'id',$db)." ".$_POST['a_name'];
			$slug = clean_url($slug_text);
			
			$qrySlug = "SELECT * from access where slug LIKE '".$slug."%' ";
			$resSlug =  mysqli_query($db,$qrySlug);
			$TotalSlug = mysqli_num_rows($resSlug);
			if($TotalSlug > 0){
				$slugInc = $TotalSlug+1;
				$slug = $slug.'-'.$slugInc;
			}*/			
		}
		
		if($_FILES['a_picture']['name']!="")
		{
			if($_FILES['a_picture']['name']!="" && file_exists("../images/product_images/".$_POST['a_picture']))
			{
				@unlink("../images/product_images/".$_POST['a_picture']);
			}
				$tmp_name = $_FILES['a_picture']['tmp_name'];
				$fileNm = $_FILES['a_picture']['name'];
				$image_name = rand().'_'.preg_replace("/[^A-Za-z0-9.]/",'_',$fileNm);
				$filePath = "../images/product_images/".$image_name;
				copy($tmp_name,$filePath);
		}
		else
		{
				$image_name	= $_POST['h_a_picture'];
		}

		if($hid=="")
		{
			$ins.=" 
				a_type ='".addslashes($a_type)."',
				brand_id ='".addslashes($brand_id)."',
				a_name = '".addslashes($a_name)."',				
				a_original = '".addslashes($a_original)."', 
				a_price = '".addslashes($a_price)."', 
				a_discount = '".addslashes($a_discount)."', 
				a_description = '".addslashes($a_description)."',
				a_picture = '".addslashes($image_name)."',
				status = '".addslashes($status)."',
				a_kit = '".addslashes($a_kit)."',
				slug = '".addslashes($slug)."',
				setord = '".addslashes($max_ord)."',
				meta_title = '".addslashes($meta_title)."',
				meta_description = '".addslashes($meta_description)."',
				meta_keywords = '".addslashes($meta_keywords)."'
				";
		}else{
			$ins.=" 
				a_type ='".addslashes($a_type)."',
				brand_id ='".addslashes($brand_id)."',
				a_name = '".addslashes($a_name)."',
				a_original = '".addslashes($a_original)."', 
				a_price = '".addslashes($a_price)."',
				a_discount = '".addslashes($a_discount)."',
				a_description = '".addslashes($a_description)."',
				a_picture = '".addslashes($image_name)."',
				status = '".addslashes($status)."',
				a_kit = '".addslashes($a_kit)."',
				setord = '".addslashes($max_ord)."',
				meta_title = '".addslashes($meta_title)."',
				meta_description = '".addslashes($meta_description)."',
				meta_keywords = '".addslashes($meta_keywords)."'
				";
		}

	if($hid=="")
	{
		mysqli_query($db,$ins) or die (mysqli_error($db));
		$pid = mysqli_insert_id($db);

		//////////////MODEL ENTRY///////////////////
		$delMode = "DELETE FROM access_model WHERE access_id = $pid";
		mysqli_query($db,$delMode);
		for($m = 0; $m <= count($model_id); $m++){
			if(!empty($model_id[$m])){
				$insModelAcc = "INSERT INTO access_model SET access_id = '".$pid."', model_id = '".$model_id[$m]."'";
				mysqli_query($db,$insModelAcc);
			}
		}
		//////////////MODEL ENTRY///////////////////
		
		//////////////OTHER IMAGES///////////////////
		if(count($_FILES['access_images'])>0)
		{
			for($i=0;$i<count($_FILES['access_images']);$i++)
			{
				if($_FILES['access_images']['name'][$i]!="")
				{
						$tmp_name1 = $_FILES['access_images']['tmp_name'][$i];
						$fileNm1 = $_FILES['access_images']['name'][$i];
						$image_name1 = rand().'_'.preg_replace("/[^A-Za-z0-9.]/",'_',$fileNm1);
						$filePath1 = "../images/product_images/other_images/".$image_name1;
						if(copy($tmp_name1,$filePath1))
						{
							$qry="INSERT INTO access_images SET 
							a_id=".$pid.",
							a_images ='".$image_name1."'";
							mysqli_query($db,$qry) or die(mysql_error($db));
						}
				}
			}
		}
		//////////////OTHER IMAGES///////////////////
		
		
		
		header('Location:manage_access.php?msg='.$sentMsg);
	}
	else if($hid)
	{
		$ins.=$whr;
		mysqli_query($db,$ins) or die (mysqli_error($db));

		//////////////MODEL ENTRY///////////////////
		$delMode = "DELETE FROM access_model WHERE access_id = ".$hid;
		mysqli_query($db,$delMode);
		for($m = 0; $m <= count($model_id); $m++){
			if(!empty($model_id[$m])){
				echo $insModelAcc = "INSERT INTO access_model SET access_id = '".$hid."', model_id = '".$model_id[$m]."'";
				mysqli_query($db,$insModelAcc);
			}
		}
		//////////////MODEL ENTRY///////////////////
		
		
		//////////////OTHER IMAGES///////////////////
		if(count($_FILES['access_images'])>0)
		{
			for($i=0;$i<count($_FILES['access_images']);$i++)
			{
				
				if($_FILES['access_images']['name'][$i]!="")
				{
					
						$tmp_name1 = $_FILES['access_images']['tmp_name'][$i];
						$fileNm1 = $_FILES['access_images']['name'][$i];
					 	$image_name1 = rand().'_'.preg_replace("/[^A-Za-z0-9.]/",'_',$fileNm1);
						$filePath1 = "../images/product_images/other_images/".$image_name1;
						if(copy($tmp_name1,$filePath1))
						{
							$qry="INSERT INTO access_images SET 
							a_id=".$hid.",
							a_images='".$image_name1."'";
							mysqli_query($db,$qry) or die(mysql_error($db));
						}
				}
			}
		}
		//////////////OTHER IMAGES///////////////////
		
	
		
		
		header('Location:manage_access.php?msg='.$sentMsg);
		
	}
	
	
	
}
if(isset($id) && $id != '')
{	
	
	$mode='Edit ';
	$Qry = "SELECT * FROM access WHERE id =".$id;
	$Res = mysqli_query($db,$Qry) or die(mysqli_error($db));
	
	$Row = mysqli_fetch_array($Res);
	
	$a_name = $Row['a_name'];
	$a_type = $Row['a_type'];
	$brand_id = $Row['brand_id'];
	$model_id = json_decode($Row['model_id']);
	$a_price = $Row['a_price'];
	$a_original = $Row['a_original'];
	$a_discount = $Row['a_discount'];
	$a_description = $Row['a_description'];
	$a_picture = $Row['a_picture']; 
	$a_kit = $Row['a_kit'];
	$status = $Row['status'];
	$max_ord = $Row['setord'];
	$meta_title = $Row['meta_title'];
	$meta_description = $Row['meta_description'];
	$meta_keywords = $Row['meta_keywords'];
	//print_r($model_id);exit;
	
	$model_id_arr=array();
	$Qry = "SELECT * FROM access_model WHERE access_id =".$id;
	$Res = mysqli_query($db,$Qry) or die(mysqli_error($db));	
	while($Row = mysqli_fetch_array($Res)){
		$model_id_arr[] = $Row['model_id'];
	}
	
	
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
      <h1 class="page-heading"><?php echo $mode;?> Accessories</h1>
    </div>
    <div class="col-sm-4 text-right hidden-xs">
      <ol class="breadcrumb push-10-t">
        <li>Home</li>
        <li><a class="link-effect" href="manage_access.php"> Accessories </a></li>
        <li><?php echo $mode;?> Accessories</li>
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
              <label class="col-xs-12" for="a_type">Select Type</label>
              <div class="col-sm-12">
                <select class="js-select2 form-control" id="a_type" name="a_type" style="width: 100%;">
                    	
                        <option value="1" <?php  echo $a_type==1?'selected':'';?>>Scooter</option>
                        <option value="2" <?php  echo $a_type==2?'selected':'';?>>Bike</option>
                     
                   </select>

              </div>
            </div>
           
           <div class="form-group">
              <label class="col-xs-12" for="brand_id">Select Model</label>
              <div class="col-sm-12">
                <select class="js-select2 form-control" id="model_id" name="model_id[]" style="width: 100%;" multiple >
					<?php 
						$qry_brands = "SELECT * FROM models WHERE status = 'Y' AND brand_id = '".$brand_id."' ORDER BY id";
						$res_brands = mysqli_query($db,$qry_brands);
						while($row_brands = mysqli_fetch_assoc($res_brands)){
					 ?>
					<option value="<?php echo  $row_brands['id']?>" <?php if(in_array($row_brands['id'], $model_id_arr)){ echo 'selected'; } ?> ><?php echo  $row_brands['model_name']?></option>
					<?php } ?>
			   </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12" for="a_name">Accessories Name</label>
              <div class="col-sm-12">
                <input class="form-control" type="text" id="a_name" name="a_name" value="<?php echo $a_name?>" />
              </div>
            </div>

			<div class="form-group">
              <label class="col-xs-12" for="a_name">Original Price <small>(For display only)</small></label>
              <div class="col-sm-12">
                <input class="form-control" type="text" id="a_original" name="a_original" value="<?php echo $a_original; ?>" />
              </div>
            </div>

			<div class="form-group">
              <label class="col-xs-12" for="a_name">Accessories Price (Sell Price)</label>
              <div class="col-sm-12">
                <input class="form-control" type="text" id="a_price" name="a_price" value="<?php echo $a_price?>" />
              </div>
            </div>

			<div class="form-group">
              <label class="col-xs-12" for="a_name">Discount % <br /><small>(Please enter only digit not %)</small></label>
              <div class="col-sm-12">
                <input class="form-control" type="text" id="a_discount" name="a_discount" value="<?php echo $a_discount; ?>" />
              </div>
            </div>

            <div class="form-group">
              <label class="col-xs-12" for="a_description">Accessories Description</label>
              <div class="col-sm-12">
				 <textarea class="js-summernote" id="a_description"  name="a_description"><?php if($a_description) echo $a_description;?></textarea>

              </div>
            </div>
            
			
			<input  type="hidden" id="h_a_picture" name="h_a_picture" value="<?php echo $a_picture;?>">
			<div class="form-group">
              <label class="col-xs-12" for="a_picture">Accessories Display Picture</label>
              <div class="col-sm-12">
                <input class="form-control" type="file" id="a_picture" name="a_picture">
           	 </div>
			</div>
			<?php if($a_picture){?>
			<div class="form-group">
              <div class="col-sm-3 col-md-3">
                <img  src="<?php echo $SITE_URL?>images/product_images/<?php echo $a_picture;?>" class="img-responsive"/>   
           	 </div>
			</div>
			<?php }?>
			<div class="form-group">
              <label class="col-xs-12" for="access_images">Other Accessories Pictures</label>
              <div class="col-sm-12">
                <input class="form-control" type="file" id="access_images" name="access_images[]" multiple>
           	 </div>
			 
			</div><?php 
				if($id)
				{ 
					$qry_pro_images = "SELECT * FROM access_images WHERE a_id = ".$id;
					$res_pro_imgs = mysqli_query($db,$qry_pro_images);
					$total_imgs = mysqli_num_rows($res_pro_imgs);
					if($total_imgs>0)
					{?>
					<div class="row items-push js-gallery-advanced"><?php 
						while($row_pro_imgs = mysqli_fetch_array($res_pro_imgs))
						{
							if($row_pro_imgs['a_images']!='' && file_exists("../images/product_images/other_images/".$row_pro_imgs['a_images'])){?>
						<div class="col-sm-3 col-md-3 col-lg-3 animated fadeIn">
							<div class="img-container fx-img-rotate-r">
							<img class="img-responsive" src="<?php echo $SITE_URL;?>images/product_images/other_images/<?php echo $row_pro_imgs['a_images'];?>" alt="">
								<div class="img-options">
									<div class="img-options-content">
										<a class="btn btn-sm btn-default img-lightbox" href="<?php echo $SITE_URL;?>images/product_images/other_images/<?php echo $row_pro_imgs['a_images'];?>">
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
              <!-- <label class="col-xs-12">Status</label> -->
              <div class="col-xs-6">
                <label class="css-input css-radio css-radio-primary push-10-r">
                <input type="radio" name="a_kit" value="1"  <?php if ($a_kit == "1") {echo "checked='checked'";} else if ($id == '') {echo "checked='checked'";}?>>
                <span></span> Kit product </label>
                <label class="css-input css-radio css-radio-primary">
                <input type="radio" name="a_kit" value="0"  <?php if ($a_kit == "0") {echo "checked='checked'";} ?>>
                <span></span> Not a kit product </label>
              </div>
            </div>

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
				
				'model_id': {
                    required: true
            
                },
                
                'a_type': {
                    required: true
            
                },
               
                'a_name': {
                    required: true
                  
                },
                'a_price':{
                    required: true
                  
                },
                  <?php if($id==''){ ?>
                'a_picture': {
                    required: true
                   
                },
                 <?php } ?>
                'a_description': {
                    required: true
                   
                }
            },
            messages: {
                
               
				'brand_id': 'Please Select Brand',
				'model_id': 'Please Select Model',
                'a_type': 'Please Select Accessories Type',
                'a_price': 'Please Enter Accessories Price',
               
                'a_name': 'Please Enter Name',
                  <?php if($id==''){?>
                'a_picture': 'Please Select Picture',
                 <?php } ?>
                'a_description': 'Please Enter Details'
               
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

$( document ).ready(function() {
   <?php if($id==''){?>
	update_model_options();
	<?php } ?>
	$("#brand_id").on('change',function(){
		update_model_options();
	});
	$("#a_type").on('change',function(){
		update_model_options();
	});

});
function update_model_options(){

	var brand_id = $("#brand_id").val();
    var model_type = $("#a_type").val();
     $('#model_id').val(null).trigger("change");
    jQuery.ajax({
				url: "ajax.inc.php",
				type : "POST",
				data: {
					flag: "select_on_load",
					brand_id : brand_id,
					model_type : model_type
				},
				success:function(data){
					$('#model_id').html(data); 
					$('#model_id').select2('refresh'); 
				}
			});
}
	
function delImg(img_id)
{	
		 jQuery.ajax({
				url: "ajax.inc.php",
				type : "POST",
				data: {
					flag: "delete_access_image",
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