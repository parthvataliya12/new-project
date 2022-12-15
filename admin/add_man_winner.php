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
			$ins.="insert into winners_manual set ";
			$whr='';
			$sentMsg='success';
			
		}else{
			$ins.="update winners_manual set ";
			$whr.=" where id='".$hid."' ";
			$sentMsg='update';
		}
		
		if($_FILES['image']['name']!=""){

			if($h_image!="" && file_exists('../assets/images/winners/'.$h_image)){
				@unlink('../assets/images/winners/'.$h_image);
			}

			$tmp_name=$_FILES['image']['tmp_name'];
			$fileNm=$_FILES['image']['name'];
			$image=rand().'_'.preg_replace("/[^A-Za-z0-9.]/",'_',$fileNm);
			$filePath='../assets/images/winners/'.$image;
	 		if(copy($tmp_name,$filePath)){
	  			 $sourceFile =$filePath;
 			}
		}
		else
		{
			$image = $h_image;
		}
		
		$ins.=" 
			name ='".addslashes($name)."',
			product = '".addslashes($product)."',
			image = '".addslashes($image)."',
			win_date = '".date("Y-m-d" ,strtotime($win_date))."',
			location = '".$location."',
			status = '".addslashes($status)."' ";
	
	
	
	if($hid=='')
	{
		mysqli_query($db,$ins) or die (mysqli_error($db));
		header('Location:manage_man_winners.php?msg='.$sentMsg);
		exit;
	}
	else 
	{
		$ins.=$whr;
		mysqli_query($db,$ins) or die (mysqli_error($db));
		header('Location:manage_man_winners.php?msg='.$sentMsg);
		exit;
	}
	
	
}
if(isset($id) && $id != '')
{	
	
	$mode='Edit ';
	$Qry = "SELECT * FROM testimonials WHERE id =".$id;
	$Res = mysqli_query($db,$Qry) or die(mysqli_error($db));
	
	$Row_Manager = mysqli_fetch_array($Res);
	
	$author_name = $Row_Manager['author_name'];
	$author_desig = $Row_Manager['author_desig'];
	$author_photo = $Row_Manager['author_photo'];
	$testimonial = $Row_Manager['testimonial'];
	$status = $Row_Manager['status'];
	
}


?>
<?php require 'inc/config.php'; ?>
<?php require 'inc/views/template_head_start.php'; ?>
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css">
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datetimepicker.min.css">
<?php require 'inc/views/template_head_end.php'; ?>
<?php require 'inc/views/base_head.php'; ?>
<!-- Page Header -->

<div class="content bg-gray-lighter">
  <div class="row items-push">
    <div class="col-sm-8">
      <h1 class="page-heading"> Ganadores </h1>
    </div>
    <div class="col-sm-4 text-right hidden-xs">
      <ol class="breadcrumb push-10-t">
        <li>Home</li>
        <li>Ganadores</li>
        <li><a class="link-effect" href="">Agregar Ganadore</a></li>
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
          <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input  type="hidden" id="hid" name="hid" value="<?php echo $id;?>">
            <div class="form-group">
              <label class="col-xs-12" for="example-text-input">Nombre del Ganadores</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" id="example-text-input" name="name" value="<?php echo $name?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12" for="product">Producto</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" id="product" name="product" value="<?php echo $product?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12" for="image">Ganadores de fotos</label>
              <div class="col-sm-9">
			  	<input class="form-control" type="hidden" id="h_image" name="h_image" value= "<?php echo $image;?>"/>
                <input class="form-control" type="file" id="image" name="image"/>
              </div>
            </div>
			<?php if($id){?>
			<div class="form-group">
			 <div class="col-sm-9">
				<img src="<?php echo $SITE_URL;?>assets/images/winners/<?php echo $image; ?>"/ width="110" height="110">
				</div>
			</div>
			<?php }?>
            <div class="form-group">
              <label class="col-xs-12" for="example-email-input">Fecha del Sorteo</label>
              <div class="col-sm-9">
                <input class="js-datetimepicker form-control" type="text" id="win_date" name="win_date" placeholder="dd-mm-yyyy"  value="<?php echo $win_date?>">
              </div>
            </div>
			<div class="form-group">
              <label class="col-xs-12" for="example-email-input">Comuna</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" id="location" name="location" value="<?php echo $location?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12">Estado</label>
              <div class="col-xs-6">
                <label class="css-input css-radio css-radio-primary push-10-r">
                <input type="radio" name="status" value="Y"  <?php if ($id!='' && $status == "Y") {echo "checked='checked'";} else if ($id =='') {echo "checked='checked'";}?>>
                <span></span> Activo </label>
                <label class="css-input css-radio css-radio-primary">
                <input type="radio" name="status" value="N"  <?php if ($id!='' && $status == "N") {echo "checked='checked'";} ?>>
                <span></span> Inactivo </label>
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                <button class="btn btn-sm btn-primary" type="submit" name='submit_btn' value="submit">Enviar</button>
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
<?php require 'inc/views/template_footer_end.php'; ?>
<script>
   $('.js-datetimepicker').datetimepicker({
                    format: 'DD-MM-YYYY',
					locale:"es"
                });		
</script>