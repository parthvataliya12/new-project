<?php 

 include('connect.php');



 if(!isset($_SESSION['paragone_user'])&&$_SESSION['paragone_user']['id']==''){

   header("location:".$SITE_URL."login/?chk=N");

 }







if(isset($_POST['submit_details']) && $_POST['submit_details']=='submit'){



      foreach($_POST as $key=>$value)

      {

        $$key=trim($value); 

      }



    $ins.="UPDATE user_details SET ";

          $whr.=" where id='".$_SESSION['paragone_user']['id']."' ";

          $sentMsg='update';



           $ins.=" 

          u_name ='".addslashes($u_name)."', 

          u_country = '".$country."', 

          u_city = '".$city."', 

          u_state = '".$state."', 

          u_address='".$u_address."', 
		  
		  u_pincode='".$u_pincode."' 

           ";



         $ins.=$whr;

        mysqli_query($db,$ins) or die (mysqli_error($db));

        header('Location:?msg='.$sentMsg);



}



if(isset($_POST['submit_new_pass']) && $_POST['submit_new_pass']=='submit'){



      foreach($_POST as $key=>$value)

      {

        $$key=trim($value); 

      }





      $main_pass = Get_one_value("user_details","u_password","id",$_SESSION['paragone_user']['id'],$db);

      if($main_pass == $c_pass)

      {

        if($n_pass ==  $r_pass){



           $ins="UPDATE user_details set 

            u_password='".addslashes($n_pass)."' 

            

            WHERE id = ".$_SESSION['paragone_user']['id']; 

            $sentMsg='success';

          

            

              mysqli_query($db,$ins) or die (mysqli_error($db));

              header("Location:?msg=".$sentMsg);

        }else

        {

          $sentMsg='N';

           header("Location:?msg=".$sentMsg);

        }

      }

      else

      {

        header("Location:?msg=X");

      }

}



$qry_user = "SELECT * FROM user_details WHERE id = ".$_SESSION['paragone_user']['id'];

$res_user  = mysqli_query($db,$qry_user);

$row_user = mysqli_fetch_array($res_user);


$meta_title = 'Profile - Paragon Two Wheeler Accessories';

$meta_keywords = 'Profile - Paragon Two Wheeler Accessories';

$meta_desc = 'Profile - Paragon Two Wheeler Accessories'; 

?>

<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->

<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->

<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->

<!--[if gt IE 8]><!-->

<html class="no-js">

<!--<![endif]-->

<head>

<?php include('head.php') ?>

<script src = "<?php echo $SITE_URL ?>js/countries.js"></script>



      <style>

        .error{

            border: 1px solid red !important;

        }

    </style>

</head>

<body>

<!--[if lt IE 7]>

            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>

        <![endif]-->

<?php  include('nav.php'); ?>

<div id="heading">

  <div class="container">

    <div class="row">

      <div class="col-md-12">

        <div class="heading-content">

          <h2>Profile </h2>

           <a href="<?php echo $SITE_URL ?>order-history/"><u>ORDER HISTORY</u></a>

        </div>

      </div>

    </div>

  </div>

</div>

<div class="billing">

  <div class="container">

   

    <div class="row">

      <div class="product-item col-md-12">

       <?php if(isset($_GET['msg']) && $_GET['msg']=='N') {?>

        <div class="alert alert-danger">

          <strong>Oops!</strong> New password and Confirm Password are not same. Pleae Enter same Password in both

        </div>

        <?php } ?>

        <?php if(isset($_GET['msg']) && $_GET['msg']=='X') {?>

        <div class="alert alert-danger">

          <strong>Oops!</strong> Your Current password is Wrong. Please Enter Correct Password.

        </div>

        <?php } ?>

        <?php if(isset($_GET['msg']) && $_GET['msg']=='success') {?>

        <div class="alert alert-success">

          <strong>Success!</strong> Your Password has been Changed.

        </div>

        <?php } ?>

        <?php if(isset($_GET['msg']) && $_GET['msg']=='update') {?>

        <div class="alert alert-success">

          <strong>Success!</strong> Your details has been updates.

        </div>

        <?php } ?>



        <div class="row">

          <div class="col-lg-6 " style="border:1px solid #afafaf;padding: 15px;border-radius: 10px;box-shadow:  1px 1px 5px #888888;">

           <h1 class="text-center">Edit your detalis</h1>

            <hr>

            <div class="message-form">

             <form action="" method="post" id="user_details" class="send-message">

                <div class="row">

                  <div class="name col-md-6">

                    <input type="text" name="u_name" id="u_name" placeholder="Name" value="<?php echo $row_user['u_name']; ?>" />

                  </div>

                  <div class="name col-md-6">

                    <input type="text" name="u_phone" id="u_phone" placeholder="Phone" value="<?php echo $row_user['u_phone']; ?>" readonly />

                  </div>

                  <div class="email col-md-12">

                    <input type="text" name="u_email" id="u_email" placeholder="Email"  value="<?php echo $row_user['u_email']; ?>" readonly />

                  </div>

                  <div class="name col-md-12">

                    <textarea rows=7 name="u_address" placeholder="Address"><?php echo $row_user['u_address']; ?></textarea>

                  </div>
                  
                  <div class="name col-md-12">

                    <input type="text" name="u_pincode" id="u_pincode" placeholder="Pincode" value="<?php echo $row_user['u_pincode']; ?>"/>

                  </div>

                  <div class="subject col-md-4">

                    <select class="form-control" id="country" name ="country">

                      <option value="">Select Country</option>


                    </select>

                  </div>

                  <div class="state col-md-4">

                    <select class="form-control" name ="state" id ="state" >

                      <option value="">Select State</option>

                    </select>

                  </div>

                  <div class="email col-md-4">

                    <input type="text" name="city" id="city" placeholder="Enter City" value="<?php echo $row_user['u_city']; ?>" />

                  </div>

                   <div class="name col-md-12">

                      <div class="send text-left">

                        <button type="submit" name="submit_details" value = "submit" style="width: 100%">Save</button>

                      </div>

                    </div>

                </div>

              </form>  

             

            </div>

          </div>

          <div class="col-lg-5" style="border:1px solid #afafaf;padding: 15px;border-radius: 10px;box-shadow:  1px 1px 5px #888888; float: right">

            <h1 class="text-center">Change Your password</h1>

            <hr>

            <div class="message-form">

             <form action="" method="post" id="change_pass" class="send-message">

                <div class="row">

                  <div class="name col-md-12">

                    <input type="password" name="c_pass" id="c_pass" placeholder="Current Password"/>

                  </div>

                  <div class="name col-md-12">

                    <input type="password" name="n_pass" id="n_pass" placeholder="New Password"/>

                  </div>

                  <div class="email col-md-12">

                    <input type="password" name="r_pass" id="r_pass" placeholder="Confirm New Password"  />

                  </div>

                  

                   <div class="name col-md-12">

                      <div class="send text-left">

                        <button type="submit" name="submit_new_pass" value = "submit" style="width: 100%">Save</button>

                      </div>

                    </div>

                </div>

              </form>  

          </div>

        </div>

      </div>

    </div>

     

  </div>

</div>

<?php include('footer.php') ?>



<script language="javascript">

    populateCountries("country", "state"); // first parameter is id of country drop-down and second parameter is id of state drop-down

</script>

<!--<script src="js/vendor/jquery-1.11.0.min.js"></script>-->

<!--<script src="js/bootstrap.js"></script>-->

<script src="js/jis.jquery.min.js"></script>

<script src="js/vendor/jquery.gmap3.min.js"></script>

<script src="js/menu_slide.js"></script>

<script src="js/jquery.validate.min.js"></script>

<!--<script src="js/bootstrap.js"></script>-->

<script type="text/javascript">

    

    $(document).ready(function() {



        $("#user_details").validate({



            rules: {



                u_name: "required",

                u_email: "required",

                u_phone: "required",

                u_phone: "required",

                u_address: "required",

                country: "required",

                state: "required",

                city: "required",
				
				u_pincode: "required"

            },

             errorPlacement: function(){

                return false;  // suppresses error message text

             }



        });

        $("#change_pass").validate({



            rules: {



                c_pass: "required",

                n_pass: "required",

                r_pass: "required"

            },

             errorPlacement: function(){

                return false;  // suppresses error message text

             }



        });

        /*console.log('<?php //echo $row_user['u_country'] ?>');*/


		<?php if(!empty($row_user['u_country'])){ ?>

        $('#country').change(function(e){

           $( "#country" ).val('<?php echo $row_user['u_country'] ?>');



          });
		
		$('#country').trigger('change');
		
		<?php } ?>

         

		<?php if(!empty($row_user['u_state'])){ ?>
         $( "#state" ).val('<?php echo $row_user['u_state'] ?>');
		<?php } ?>

    });



</script>

</body>

</html>

