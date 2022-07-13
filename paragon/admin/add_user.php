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

$mode= "Add";

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

			$ins.="insert into user_details set ";

			$whr='';

			$sentMsg='success';

			//$u_password = generateStrongPassword();

			//$create_date = 'u_create_date = '.date('Y-m-d H:i:s').',';

			$create_date = "u_create_date = '".date('Y-m-d H:i:s')."',";

			

		}else{

			$ins.="UPDATE user_details SET ";

			$whr.=" where id='".$hid."' ";

			$sentMsg='update';

			$create_date = '';

		}

		

		 $ins.=" 

			u_name ='".addslashes($u_name)."',

			u_email = '".addslashes($u_email)."',

			u_password = '".addslashes($u_password)."',

			u_phone = '".$u_phone."',

			u_city = '".$u_city."',

			u_state = '".$u_state."',

			u_address='".$u_address."',

			".$create_date ."

			status = '".addslashes($status)."' ";

	

	

	if(!GTG_is_dup_add('user_details','u_email',$u_email,$db) && $hid=="" )

	{

		mysqli_query($db,$ins) or die (mysqli_error($db));

		$last_usr_id = mysqli_insert_id($db);

		header('Location:manage_users.php?msg='.$sentMsg);

		

	}

	else if($hid)

	{

		$ins.=$whr;

		mysqli_query($db,$ins) or die (mysqli_error($db));

	

		header('Location:manage_users.php?msg='.$sentMsg);

		

	}

	else 

	{

		//$Err = 'Correo electr�nico ya existentes.';//--Email Already Exist.

		header('Location:manage_users.php?msg=Err');

	}

	

	

}

if(isset($id) && $id != '')

{	

	

	$mode='Edit ';

	$Qry = "SELECT * FROM user_details WHERE id =".$id;

	$Res = mysqli_query($db,$Qry) or die(mysqli_error($db));

	

	$Row_Manager = mysqli_fetch_array($Res);

	

	$u_name = $Row_Manager['u_name'];

	$u_email = $Row_Manager['u_email'];

	$u_password = $Row_Manager['u_password'];

	$u_phone = $Row_Manager['u_phone'];

	$u_city = $Row_Manager['u_city'];

	$u_state = $Row_Manager['u_state'];

	$status = $Row_Manager['status'];

	$u_address = $Row_Manager['u_address'];

	

}





?>

<?php require 'inc/config.php'; ?>

<?php require 'inc/views/template_head_start.php'; ?>

<?php require 'inc/views/template_head_end.php'; ?>

<?php require 'inc/views/base_head.php'; ?>

<!-- Page Header -->



<div class="content bg-gray-lighter">

  <div class="row items-push">

    <div class="col-sm-8">

      <h1 class="page-heading"><?php echo $mode;?> User</h1>

    </div>

    <div class="col-sm-4 text-right hidden-xs">

      <ol class="breadcrumb push-10-t">

        <li><a class="link-effect" href="dashboard.php">Home</a></li>

        <li><a class="link-effect" href="manage_users.php">Users</a></li>

        <li>Add Users</li>

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

              <label class="col-xs-12" for="example-text-input">Name</label>

              <div class="col-sm-9">

                <input class="form-control" type="text" id="example-text-input" name="u_name" value="<?php echo $u_name?>">

              </div>

            </div>

            

            <div class="form-group">

              <label class="col-xs-12" for="example-email-input">Email</label>

              <div class="col-sm-9">

                <input class="form-control" type="email" id="u_email" name="u_email" value="<?php echo $u_email?>">

              </div>

            </div>

		

            <div class="form-group">

              <label class="col-xs-12" for="example-email-input">Password</label>

              <div class="col-sm-9">

                <input class="form-control" type="text" id="u_password" name="u_password" value="<?php echo $u_password?>">

              </div>

            </div>



			

            <div class="form-group">

              <label class="col-xs-12" for="example-email-input">Phone</label>

              <div class="col-sm-9">

                <input class="form-control" type="text" id="u_phone" name="u_phone"  value="<?php echo $u_phone?>">

              </div>

            </div>

            <div class="form-group">

              <label class="col-xs-12" for="u_address">Address</label>

              <div class="col-sm-9">

                <textarea class="form-control" rows="6" id="u_address" name="u_address" ><?php echo $u_address?></textarea> 

              </div>

            </div>

			<div class="form-group">

              <label class="col-xs-12" for="example-email-input">City</label>

              <div class="col-sm-9">

                <input class="form-control" type="text" id="u_city" name="u_city"  value="<?php echo $u_city?>">

              </div>

            </div>

			<div class="form-group">

              <label class="col-xs-12" for="example-email-input">State</label>

              <div class="col-sm-9">

                <input class="form-control" type="text" id="u_state" name="u_state"  value="<?php echo $u_state;?>">

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

<?php require 'inc/views/template_footer_end.php'; ?>

