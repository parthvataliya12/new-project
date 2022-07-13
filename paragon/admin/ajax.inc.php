<?php
require '../connect.php';
$status = '';
if(isset($_REQUEST['flag'])){ $flag = $_REQUEST['flag']; }
if(isset($_REQUEST['status'])){ $status = $_REQUEST['status']; }
if(isset($_REQUEST['statusmenu'])){ $statusmenu = $_REQUEST['statusmenu']; }
if(isset($_REQUEST['show_status'])){ $show_status = $_REQUEST['show_status']; }
if(isset($_REQUEST['id'])){ $id = $_REQUEST['id']; }
if(isset($_REQUEST['pid'])){ $pid = $_REQUEST['pid']; }

switch($flag)
{
	case 'delete_pro_image':
			
			$image_name = Get_one_value("model_images","model_image",$id,"id",$db); 
			if(@file_exists("../images/product_images/other_images/".$image_name) && $image_name!=""){
			   @unlink("../images/product_images/other_images/".$image_name);
			}
			$qry="DELETE FROM model_images WHERE id =".$id;
			mysqli_query($db,$qry);
			echo "success";
	break;
	
	case 'delete_access_image':
			
			$image_name = Get_one_value("access_images","a_images",$id,"id",$db); 
			if(@file_exists("../images/product_images/other_images/".$image_name) && $image_name!=""){
			   @unlink("../images/product_images/other_images/".$image_name);
			}
			$qry="DELETE FROM access_images WHERE id =".$id;
			mysqli_query($db,$qry);
			echo "success";
	break;

	
	case 'displayorder':

		$disval=explode(",",$_REQUEST['disvalue']);
		for($i=0;$i<count($disval);$i++)
		{
			$cat = explode(":",$disval[$i]);
			$qry="UPDATE ".$_REQUEST['table']." SET setord='".$cat[1]."' WHERE id='".$cat[0]."' ";
			mysqli_query($db,$qry);
		}

	break;
	case 'select_on_load':

		$brand_id=$_POST['brand_id'];
		$model_type=$_POST['model_type'];
		$models = '';

		$qry = "SELECT * FROM models WHERE brand_id = ".$brand_id." AND model_type = ".$model_type;
		$res = mysqli_query($db,$qry);
		while($row= mysqli_fetch_assoc($res))
		{
			echo '<option value="'.$row['id'].'">'.$row['model_name'].'</option>';
		}
		

	break;
}


?>