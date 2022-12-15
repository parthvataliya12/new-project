<?php 
include ('../connect.php');

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
			$ins.="insert into order_master set ";
			$whr='';
			$sentMsg='success';
			$u_password = generateStrongPassword();
		}else{
			$ins.="update order_master set ";
			$whr.=" where order_id='".$hid."' ";
			$sentMsg='update';
		}
		
			
			 if($hid=="")
			 {
			 $ord_num = generate_ord_num();
			 
			 	$ins.= "
				 order_id  = ".$ord_num.",
				 user_id  = ".$user_id.",
				 order_amount = ".$order_amount.",
				 order_date =  '".date('Y-m-d H:i:s')."',
				 order_expire_date =  '".$ord_exp_date."',
				 order_status =  '".$order_status."',
				 payment_status = '".$payment_status."'";
				 mysqli_query($db,$ins);
				 $last_ord_id = mysqli_insert_id($db);
				 
				 $order_id = Get_one_value("order_master","order_id",$last_ord_id,"id",'');
				//echo $order_id = Get_one_value("order_master","order_id",6,"id",'');
				 
				 send_order_email($order_id);

				header('Location:manage_orders.php?msg='.$sentMsg);
			 }
			 else
			 {
			 	/*$ordr_date = date('F j Y',strtotime($ord_date));
				
				setlocale(LC_TIME, 'es_ES', 'Catalan_Spain', 'Catalan');
				$date = DateTime::createFromFormat("F j Y", $ordr_date);
				$order_date_es = strftime("%d %B %Y",$date ->getTimestamp());
				$order_date_es =  strval($order_date_es." ".$ord_hours);
				
				$tempdate = strval($ord_date." ".$ord_hours);
				$order_date = DateTime::createFromFormat("d-m-Y H:i:s", $tempdate)->format("Y-m-d H:i:s");*/
				
			 	$ins.= "
				 order_status =  '".$order_status."',
				 payment_status = '".$payment_status."'";
			 	
				$ins.=$whr;
				mysqli_query($db,$ins);
				//echo $hid;exit;
				send_order_email($db,$hid,$flag = 'update_order');
				header('Location:manage_orders.php?msg='.$sentMsg);
				
			 }
	
	
}
if(isset($id) && $id != '')
{	
	
	$mode='Edit ';
	$Qry = "SELECT * FROM order_master WHERE order_id =".$id;
	$Res = mysqli_query($db,$Qry) or die(mysqli_error($db));
	
	$Row_Manager = mysqli_fetch_array($Res);
	
	$id = $Row_Manager['order_id'];
	$user_id = $Row_Manager['user_id'];
	$package_id = $Row_Manager['package_id'];
	$order_amount = $Row_Manager['order_amount'];
	$order_email = $Row_Manager['order_email'];
	$order_status = $Row_Manager['order_status'];
	$payment_status = $Row_Manager['payment_status'];
	$order_transaction_id = $Row_Manager['order_transaction_id'];
	$payer_email = $Row_Manager['payer_email'];
	
}


?>
<?php require 'inc/config.php'; ?>
<?php require 'inc/views/template_head_start.php'; ?>
<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css">
<?php require 'inc/views/template_head_end.php'; ?>
<?php require 'inc/views/base_head.php'; ?>
<!-- Page Header -->

<div class="content bg-gray-lighter">
  <div class="row items-push">
    <div class="col-sm-8">
      <h1 class="page-heading">Edit Order Details</h1>
    </div>
    <div class="col-sm-4 text-right hidden-xs">
      <ol class="breadcrumb push-10-t">
        <li><a href="dashboard.php">Home</a></li>
        <li>Edit Order Details</li>
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
              <label class="col-xs-12" for="user_id">Order No.</label>
              <div class="col-sm-9">
              <input  type="text" id="order_id"  class="form-control" name="order_id" value="#<?php echo $id;?>" disabled="disabled">
              </div>
            </div>
			
			<div class="form-group">
              <label class="col-xs-12" for="user_id">User Email</label>
              <div class="col-sm-9">
              <input  type="text" id="payer_email" class="form-control" name="order_email" value="<?php echo $order_email;?>" disabled="disabled">
              </div>
            </div>
            <div class="form-group">
              <label class="col-xs-12" for="user_id">User Name</label>
              <div class="col-sm-9">
                <select class="form-control" type="text" id="user_id" name="user_id">
				<?php 
					$Qry_usr = "SELECT * FROM user_details WHERE status ='Y' ORDER BY id DESC";
					$Res_usr = mysqli_query($db,$Qry_usr);
					while($row_user = mysqli_fetch_array($Res_usr)){?>
					<option value = "<?php echo $row_user['id'];?>"><?php echo  $row_user['u_name']." ".$row_user['u_last_name'];?></option>
				<?php }?>
				</select>
				
              </div>
            </div>
				 <div class="form-group">
				   <label class="col-xs-12" for="payment_amount">Date</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="ord_date" name="ord_date" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" value="<?php echo date("d/m/Y H:i:s" ,strtotime($Row_Manager['order_date']));?>" disabled="disabled">
                            </div>
                        </div>	
							
				 	
            
			<div class="form-group">
              <label class="col-xs-12" for="example-email-input">Payment Status</label>
              <div class="col-sm-9">
                <select class="form-control"  id="payment_status" name="payment_status">
					<option value = "P" <?php echo $payment_status=='P'?"selected":'';?>>Paid</option>
					<option value = "U" <?php echo $payment_status=='U'?"selected":'';?>>Unpaid</option>
					
				</select>
              </div>
            </div>
			<div class="form-group">
              <label class="col-xs-12" for="order_status">Order Status</label>
              <div class="col-sm-9">
                <select class="form-control"  id="order_status" name="order_status">
					<option value = "P" <?php echo $order_status=='P'?"selected":'';?>>Processing</option>
					<option value = "W" <?php echo $order_status=='W'?"selected":'';?>>Pending</option>
					<option value = "C" <?php echo $order_status=='C'?"selected":'';?>>Complete</option>
					<option value = "X" <?php echo $order_status=='X'?"selected":'';?>>Cancel</option>
				</select>
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
<?php require 'inc/views/template_footer_end.php'; ?>

<script>
$('#user_id').attr("disabled","disabled");
</script>