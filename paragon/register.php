<?php 
include('connect.php');

if(isset($_SESSION['paragone_user']) && $_SESSION['paragone_user']['id']!=''){
    header("location:".$SITE_URL."");
    exit;
  }

$u_name = '';
$u_email = ''; 
$u_password = '';
$u_otp = ''; 
$u_phone = ''; 
$u_address = '';
$u_pincode = '';

$Err = '';
 if(isset($submit_btn) && $submit_btn == "submit")

{

    foreach($_POST as $key=>$value)

    {

        $$key=trim($value); 

    }

	if(empty($u_name) || empty($u_email) || empty($u_password) || empty($u_otp) || empty($u_phone) || empty($u_address) || empty($u_pincode)){
		$Err = 'Please enter all required fields.';
	}else if(!empty($u_email) && !is_valid_email($u_email)){
		$Err = 'Please enter valid email address.';		
	}else if($_SESSION['reg_otp'] != $u_otp){
		$Err = 'Please check otp you enter is wrong.';
	}


    if($Err == ''){

        $ins="insert into user_details set 

        u_name ='".addslashes($u_name)."',

        u_email ='".addslashes($u_email)."',

        u_password ='".addslashes($u_password)."',

        u_phone ='".addslashes($u_phone)."',

        u_city ='',

        u_state ='',

        u_address ='".addslashes($u_address)."',
		
		u_pincode ='".addslashes($u_pincode)."',

        u_create_date ='".date('Y-m-d H:i:s')."'

        "; 

        $whr='';

        $sentMsg='success';

        

        if(!GTG_is_dup_add('user_details','u_email',$u_email,$db))

        {

            mysqli_query($db,$ins) or die (mysql_error($db));

            $last_user_id = mysqli_insert_id($db);

            

            $_SESSION['paragone_user']['type']  =  'UseR';

            $_SESSION['paragone_user']['id']  =  $last_user_id;

            $_SESSION['paragone_user']['email']  =  $u_email;

            $_SESSION['paragone_user']['name']  =  $u_name;
			
			 $_SESSION['paragone_user']['u_address']  =  $u_address;

            $_SESSION['paragone_user']['u_pincode']  =  $u_pincode;



            $htmlContent='

                 <html>

                    <head>

                        <title>Welcome to Paragone Accessorires Pvt. Ltd.</title>

                    </head>

                    <body style ="font-family: Helvetica, Arial, sans-serif;">

                        <div style="width:100%;text-align:center"><img width="20%" src="'.$SITE_URL.'images/logo-black.png"></div>

                        <p>Hello '.$u_name.'</p>

                        <br />

                        <p>Welcome to Paragone Accessorires Pvt. Ltd.</p>

                        <p>Your registration with our website is successful.</p>

                        <p>Your Login Details are as follow:</p>

                        <p>=================================</p>

                        <p>Email: '.$u_email.'</p>

                        <p>Password: '.$u_password.'</p>

                        <br>

                        <br>

                        <br>

                        <br>

                        <br>

                        <p>Thank you,</p>

                        <p>Team Paragone Accessorires Pvt. Ltd.</p>

                    </body>

                    </html>

                '; 

                

                $subject = "Registration Success";



                require_once 'include/phpmailer/class.phpmailer.php'; 

                $mail = new PHPMailer(true); 



                   

                try{

                $mail->IsSMTP();                           // tell the class to use SMTP

                $mail->SMTPAuth   = true;                  // enable SMTP authentication

                $mail->Port       =   465;     

                $mail->Host       = "md-in-29.webhostbox.net"; // SMTP server

                $mail->Username   = "info@paragontwowheeleraccessories.com";     // SMTP server username

                $mail->Password   = "himat@123"; 

                $mail->SMTPSecure = "ssl"; 

                $mail->IsSendmail();  // tell the class to use Sendmail

            

                $mail->AddReplyTo('info@paragontwowheeleraccessories.com','Paragon Two Wheeler Accessories');

            

                $mail->From       = 'info@paragontwowheeleraccessories.com';

                $mail->FromName   = 'Paragon Two Wheeler Accessories';

                

                $to = $u_email;

            

                $mail->AddAddress($to);

            

                $mail->Subject  =   $subject;

                $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

                $mail->WordWrap   = 80; // set word wrap

            

                $mail->MsgHTML($htmlContent);

                

                $mail->IsHTML(true); // send as HTML

            

                $sendEmail = $mail->Send();

                echo $sendEmail ? "1" : "0";

                //echo 'Message has been sent.';

                } catch (phpmailerException $e) {

                    echo $e->errorMessage();

                }

              

                

            

            header('Location:'.$SITE_URL.'login/');

            

        }

        else

        {

                header('Location:'.$SITE_URL.'register/?reg=N');

        }
	}

}



$meta_title = "Register | Paragon Accessories Pvt. Ltd.";

$meta_keywords = "Two wheeler accessories, honda accessories, yamaha accessories, suzuki accessories, mahindra accessories, tvs accessories, royale enfield accessories, bike accessories, scooter accessories";

$meta_desc = "Register | Paragon Accessories Pvt. Ltd.";

 ?>

 <!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->

<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->

<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->

<!--[if gt IE 8]><!--> 

<html class="no-js"> <!--<![endif]-->





<head>

      <?php include('head.php') ?>
      
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

                                <h2>Register</h2>

                                <span><a href="<?php echo $SITE_URL; ?>">Home</a> / Register</span>

                            </div>

                        </div>

                   

                </div>

                </div>

            </div>



            





            <div class="contact-us">

                <div class="container">                                       

                    <div class="row">

                                <div class="product-item col-md-12">

                                <?php if(isset($_GET['reg']) && $_GET['reg']=='N') { ?>

                                <div class="alert alert-danger">

                                  <strong>Oops!</strong> This user is already exist.

                                </div>

                                <?php } 

									if(!empty($Err)){ ?>
									
									<div class="alert alert-danger">

									  <strong>Oops!</strong> <?php echo $Err; ?>

									</div>
									
									<?php } ?>

                                    <div class="row">

                                        <div class="text-center login-box">  

                                        <form method="post" id="user_register" >

                                            <div class="message-form">

                                                <form action="#" method="post" class="send-message">

                                                    <div class="row">

                                                     <div class="name col-md-12">

                                                        <input type="text" name="u_name" id="u_name" placeholder="Name" value="<?php echo $u_name; ?>" />

                                                    </div>

                                                    <div class="name col-md-12">

                                                        <input type="text" name="u_email" id="u_email" placeholder="Email" value="<?php echo $u_email; ?>" />

                                                    </div>

                                                    <div class="email col-md-12">

                                                        <input type="password" name="u_password" id="u_password" placeholder="Password"  value="<?php echo $u_password; ?>" />

                                                    </div>

                                                    <div class="name col-md-12">

                                                        <input type="text" name="u_phone" id="u_phone" placeholder="Phone No." value="<?php echo $u_phone; ?>" />
                                                        

                                                    </div>
                                                    
                                                    
                                                    
                                                    <div class="name col-md-12">

                                                        <input type="text" name="u_address" id="u_address" placeholder="Address" value="<?php echo $u_address; ?>" />

                                                    </div>

                                                   <div class="name col-md-12">

                                                        <input type="text" name="u_pincode" id="u_pincode" placeholder="Pincode" value="<?php echo $u_pincode; ?>" />

                                                    </div>

                                                    <div class="send" id="register_btn_div" >

                                                        <p>&nbsp;</p>

                                                        <button name="register_btn" id="register_btn" value="Register" type="button" >Register</button>

                                                    </div>

                                                    <div class="name col-md-12" id="verify_div" style="padding-top: 10px;" ></div>

                                                    <div class="name col-md-12" id="verify_div_main" style="display: none;" >

														<div class="name col-md-12">

															<input type="text" name="u_otp" id="u_otp" placeholder="OTP" value="<?php echo $u_otp; ?>" />

														</div>

                                                  		<div class="send">
                                                  		
                                                  			<p>&nbsp;</p>

															<button name="submit_btn" id="submit_btn" value="submit" type="submit" >Verify OTP</button>

														</div>
                                                   
													</div>
                                                   
                                                   </div>  
                                                    

                                                </form>

                                            </div>

                                           </form>

                                        </div>                                             

                                    </div>

                                </div>

                            </div>

                    

                   

                    

                </div>

            </div>





            <?php include('footer.php') ?>



        <!--<script src="js/vendor/jquery-1.11.0.min.js"></script>-->

        <!--<script src="js/bootstrap.js"></script>-->

        <script src="js/jis.jquery.min.js"></script>         

        <script src="js/vendor/jquery.gmap3.min.js"></script>

        <script src="js/menu_slide.js"></script>
        
        <script src="js/jquery.validate.min.js"></script>
        
        
        <script language="javascript" >
			$('#register_btn').on('click',function(){
				
					$(this).html('Wait...');
				
                    var phoneNo = $('#u_phone').val();
					var emailAd = $('#u_email').val();
				
					if(phoneNo.length == 10){

						 $.ajax({

								  url: "<?php echo $SITE_URL ?>data/",

								  type : "POST",

								  data: {

									  flag: "phone_varify",

									  phone_no : phoneNo,
									  
									  email_ad : emailAd

								  },

								  success:function(data){
									  
									  if(data == 'success'){

										    $('#register_btn_div').hide();
										    $('#verify_div').html('<span style="color:green; font-weight:bold;" >OTP sent successfully to your phone no. and email.!</span>');
									  		$('#verify_div_main').show();
										    $('#register_btn').html('Register');
										  
									  }else{

										$('#verify_div').html(data);
									  	$('#verify_div').show();
										$('#register_btn').html('Register');
										  
									  }

								  }

							  });
					}else{
						$('#verify_div').html('<span style="color:red; font-weight:bold;" >Please enter valid mobile no.</span>');
						$('#verify_div').show();
						$('#register_btn').html('Register');
					}

                  });
			
			$(document).ready(function() {
			
				$("#user_register").validate({



				rules: {

					u_name: "required",

					u_email: "required",

					u_phone: "required",

					u_password: "required",
					
					u_otp: "required",

					u_address: "required",

					u_pincode: "required"

				},

				 errorPlacement: function(){

					return false;  // suppresses error message text

				 }

			});
				
			$("#u_email").keyup(function () {  
				$(this).val($(this).val().toLowerCase());  
			});

		});
			
		</script>

    </body>

</html>