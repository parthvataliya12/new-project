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

$mode = 'Add ';

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

			$ins.="insert into brands set ";

			$whr='';

			$sentMsg='success';
			
			if($_FILES['brand_image']['name']!="")
			{
				if($_FILES['brand_image']['name']!="" && file_exists("../images/product_images/".$_POST['h_brand_image']))
				{
					@unlink("../images/product_images/".$_POST['h_brand_image']);
				}
					$tmp_name = $_FILES['brand_image']['tmp_name'];
					$fileNm = $_FILES['brand_image']['name'];
					$image_name = rand().'_'.preg_replace("/[^A-Za-z0-9.]/",'_',$fileNm);
					$filePath = "../images/product_images/".$image_name;
					copy($tmp_name,$filePath);
			}
			

			

		}else{

			$ins.="update brands set ";

			$whr.=" where id='".$hid."' ";

			$sentMsg='update';
			
			if($_FILES['brand_image']['name']!="")
			{
				if($_FILES['brand_image']['name']!="" && file_exists("../images/product_images/".$_POST['h_brand_image']))
				{
					@unlink("../images/product_images/".$_POST['h_brand_image']);
				}
					$tmp_name = $_FILES['brand_image']['tmp_name'];
					$fileNm = $_FILES['brand_image']['name'];
					$image_name = rand().'_'.preg_replace("/[^A-Za-z0-9.]/",'_',$fileNm);
					$filePath = "../images/product_images/".$image_name;
					copy($tmp_name,$filePath);
			}
			else
			{
					$image_name	= $_POST['h_brand_image'];
			}

		}

		

		/*if($_FILES['author_photo']['name']!=""){



			if($h_author_photo!="" && file_exists('../assets/images/testi_photos/'.$h_author_photo)){

				@unlink('../assets/images/testi_photos/'.$h_author_photo);

			}



			$tmp_name=$_FILES['author_photo']['tmp_name'];

			$fileNm=$_FILES['author_photo']['name'];

			$author_photo=rand().'_'.preg_replace("/[^A-Za-z0-9.]/",'_',$fileNm);

			$filePath='../assets/images/testi_photos/'.$author_photo;

	 		if(copy($tmp_name,$filePath)){

	  			 $sourceFile =$filePath;

 			}

		}

		else

		{

			$author_photo = $h_author_photo;

		}*/

		

		$ins.=" 

			brand_name ='".addslashes($brand_name)."',
			
			brand_description ='".addslashes($brand_description)."',
			
			brand_image ='".addslashes($image_name)."',
			
			slug ='".addslashes(clean_url($brand_name))."',

			status = '".addslashes($status)."' ";

	

	

	

	if($hid=='')

	{

		mysqli_query($db,$ins) or die (mysqli_error($db));
 
	

		header('Location:manage_brands.php?msg='.$sentMsg);
	
		exit;

	}

	else 

	{

		$ins.=$whr;

		mysqli_query($db,$ins) or die (mysqli_error($db));

		header('Location:manage_brands.php?msg='.$sentMsg);

		exit;

	}

}

if(isset($id) && $id != '')
{
	$mode='Edit ';

	$Qry = "SELECT * FROM brands WHERE id =".$id;

	$Res = mysqli_query($db,$Qry) or die(mysqli_error($db));

	$Row_Manager = mysqli_fetch_array($Res);
	$brand_name = $Row_Manager['brand_name'];
	$brand_description = stripslashes($Row_Manager['brand_description']);
	$brand_image = $Row_Manager['brand_image'];
	$status = $Row_Manager['status'];
}





?>

<?php require 'inc/config.php'; ?>

<?php require 'inc/views/template_head_start.php'; ?>

<link rel="stylesheet" href="assets/js/plugins/summernote/summernote.min.css">
<link rel="stylesheet" href="assets/js/plugins/summernote/summernote-bs3.min.css">

<?php require 'inc/views/template_head_end.php'; ?>

<?php require 'inc/views/base_head.php'; ?>

<!-- Page Header -->



<div class="content bg-gray-lighter">

  <div class="row items-push">

    <div class="col-sm-8">

      <h1 class="page-heading"> Brands </h1>

    </div>

    <div class="col-sm-4 text-right hidden-xs">

      <ol class="breadcrumb push-10-t">

        <li>Home</li>

        <li><a class="link-effect" href="manage_brands.php">Brands</a></li>

        <li><?php echo $mode;?> Brand</li>

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

            <div class="form-group">

              <label class="col-xs-12" for="brand_name">Brand Name</label>

              <div class="col-sm-9">

                <input class="form-control" type="text" id="example-text-input" name="brand_name" value="<?php echo $brand_name?>">

              </div>

            </div>
            
            
            <div class="form-group">
              <label class="col-xs-12" for="model_description">Brand Description</label>
              <div class="col-sm-12">
				 <textarea class="js-summernote" id="brand_description"  name="brand_description"><?php if($brand_description) echo $brand_description;?></textarea>
              </div>
            </div>
            
            
            <input  type="hidden" id="h_brand_image" name="h_brand_image" value="<?php echo $brand_image;?>">
			<div class="form-group">
              <label class="col-xs-12" for="brand_image">Brand Banner</label>
              <div class="col-sm-12">
                <input class="form-control" type="file" id="brand_image" name="brand_image">
                <br />
                <span style="color: red;" >Image size: 530px(W) X 330px(H)</span>
           	 </div>
			</div>
			<?php if($brand_image){?>
			<div class="form-group">
              <div class="col-sm-3 col-md-3">
                <img  src="<?php echo $SITE_URL?>images/product_images/<?php echo $brand_image;?>" class="img-responsive"/>   
           	 </div>
			</div>
			<?php }?>


            <div class="form-group">

              <label class="col-xs-12">Status</label>

              <div class="col-xs-6">

                <label class="css-input css-radio css-radio-primary push-10-r">

                <input type="radio" name="status" value="Y"  <?php if ($id!='' && $status == "Y") {echo "checked='checked'";} else if ($id =='') {echo "checked='checked'";}?>>

                <span></span> Active </label>

                <label class="css-input css-radio css-radio-primary">

                <input type="radio" name="status" value="N"  <?php if ($id!='' && $status == "N") {echo "checked='checked'";} ?>>

                <span></span> InActive </label>

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

<script src="assets/js/plugins/summernote/summernote.min.js"></script>

<!-- Page JS Code -->

<script src="<?php echo $one->assets_folder; ?>/js/pages/brands.js"></script>

<script>
    $(function(){
        // Init page helpers (Magnific Popup plugin)
        App.initHelpers(['summernote','select2','magnific-popup']);
    });
</script>

<?php require 'inc/views/template_footer_end.php'; ?>

