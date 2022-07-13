<?php include ('../connect.php'); ?>
<?php
if($_SESSION['user']['type']!='AdmiN')
{
		header('Location:'.$SITE_URL);
}

$id = $_SESSION['user']['id'];
@$SubmitButton 	= $_POST["submit_btn"];
if(isset($SubmitButton) && $SubmitButton <> "")
{ 

	
	foreach($_POST as $key=>$value)
	{
		$$key=trim($value);	
	}
	
	
	
	if($_FILES['gplus_link']['name']!=""){

			if($h_gplus_link!="" && file_exists('../assets/images/'.$h_gplus_link)){
				@unlink('../assets/images/'.$h_author_photo);
			}

			$tmp_name=$_FILES['gplus_link']['tmp_name'];
			$fileNm=$_FILES['gplus_link']['name'];
			$gplus_link=rand().'_'.preg_replace("/[^A-Za-z0-9.]/",'_',$fileNm);
			$filePath='../assets/images/'.$gplus_link;
	 		if(copy($tmp_name,$filePath)){
	  			 $sourceFile =$filePath;
 			}
		}
		else
		{
			$gplus_link = $h_gplus_link;
		}
	
	
		$sentMsg='update';
		$ins =" update static_pages set 
			company_address ='".addslashes($company_address)."',
			company_email = '".addslashes($company_email)."',
			company_phone = '".addslashes($company_phone)."',
			fb_link = '".addslashes($fb_link)."',
			gplus_link = '".addslashes($gplus_link)."',
			tw_link = '".addslashes($tw_link)."'  
		WHERE id = 1";
		mysqli_query($db,$ins) or die (mysqli_error($db));
	
	if($hid)
	{
		//$ins.=$whr;
		mysqli_query($db,$ins) or die (mysqli_error($db));
		header('Location:profile.php?msg='.$sentMsg);
		
	}
	else 
	{
		//$Err = 'Correo electrónico ya existentes.';//--Email Already Exist.
		header('Location:profile.php?msg=Err');
	}
	
	
}

	
	$mode='Edit ';
	$Qry = "SELECT * FROM static_pages WHERE id = 1";
	$Res = mysqli_query($db,$Qry) or die(mysqli_error($db));
	
	$Row_Manager = mysqli_fetch_array($Res);
	
	$company_address = $Row_Manager['company_address'];
	$company_email = $Row_Manager['company_email'];
	$company_phone = $Row_Manager['company_phone'];
	$company_skype = $Row_Manager['company_skype'];
	$fb_link = $Row_Manager['fb_link'];
	$tw_link = $Row_Manager['tw_link'];
	$gplus_link = $Row_Manager['gplus_link'];
	$linkedin_link = $Row_Manager['linkedin_link'];



?>
<?php require 'inc/config.php'; ?>
<?php require 'inc/views/template_head_start.php'; ?>
<?php require 'inc/views/template_head_end.php'; ?>

<?php require 'inc/views/base_head.php'; ?>
<!-- Page Header -->

<div class="content bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/img/photos/photo8@2x.jpg');">
    <div class="push-50-t push-15 clearfix">
        
        <h1 class="h2 text-white push-5-t animated zoomIn">Faena7x7.cl</h1>
        
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
		  <input type="hidden" name="embd_link" id="embd_link"/>
            <input  type="hidden" id="hid" name="hid" value="<?php echo $id;?>">
            <div class="form-group">
              <label class="col-xs-12" for="company_address">Direccion</label>
              <div class="col-sm-9">
                <textarea  class="form-control" rows="6" type="text" id="company_address" name="company_address"><?php echo $company_address?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12" for="company_email">Email</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" id="company_email" name="company_email" value="<?php echo $company_email?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12" for="company_phone">Telefono</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" id="company_phone" name="company_phone" value="<?php echo $company_phone?>">
              </div>
            </div>
            
            
			<div class="form-group">
              <label class="col-xs-12" for="fb_link">Facebook</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" id="fb_link" name="fb_link"  value="<?php echo $fb_link?>">
              </div>
            </div>
			
			<div class="form-group">
              <label class="col-xs-12" for="fb_link">Twitter</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" id="tw_link" name="tw_link"  value="<?php echo $tw_link?>">
              </div>
            </div>
			 <div class="form-group">
              <label class="col-xs-12" for="example-email-input">Bandera</label>
              <div class="col-sm-9">
			  	<input class="form-control" type="hidden" id="h_gplus_link" name="h_gplus_link" value= "<?php echo $gplus_link;?>"/>
                <input class="form-control" type="file" id="gplus_link" name="gplus_link"/>
				<p>tama&ntilde;o:(2500x1667 O en la misma proporci&oacute;n)</p>
              </div>
            </div>
			<?php if($gplus_link){?>
			<div class="form-group">
			 <div class="col-sm-9">
				<img src="<?php echo $SITE_URL;?>assets/images/<?php echo $gplus_link; ?>"/ width="200" height="110">
				</div>
			</div>
			<?php }?>
			
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
<?php require 'inc/views/template_footer_end.php'; ?>

