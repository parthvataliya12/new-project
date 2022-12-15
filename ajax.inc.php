<?php

require 'connect.php';

$status = '';

if(isset($_REQUEST['flag'])){ $flag = $_REQUEST['flag']; }

if(isset($_REQUEST['phone_no'])){ $status = $_REQUEST['phone_no']; }

if(isset($_REQUEST['status'])){ $status = $_REQUEST['status']; }

if(isset($_REQUEST['statusmenu'])){ $statusmenu = $_REQUEST['statusmenu']; }

if(isset($_REQUEST['show_status'])){ $show_status = $_REQUEST['show_status']; }

if(isset($_REQUEST['id'])){ $id = $_REQUEST['id']; }

if(isset($_REQUEST['pid'])){ $pid = $_REQUEST['pid']; }

if( !isset($_SESSION['order_id']) && empty($_SESSION['order_id']) ) { 
	$_SESSION['order_id'] = generate_ord_num(); 
	$order_id = $_SESSION['order_id'];
}else{
	$order_id = $_SESSION['order_id'];
}

switch($flag)

{

	case 'buy_now':

			

			unset($_SESSION['cart']);



			$qry_get_access = "SELECT * FROM access WHERE id = ".$_REQUEST['pro_id'];

			$res_get_access = mysqli_query($db,$qry_get_access);

			$row_get_access = mysqli_fetch_assoc($res_get_access );

			

			if($row_get_access['a_price'] = $_REQUEST['pro_price']){



				$_SESSION['cart']['item_name'][]= $row_get_access['a_name'];

				$_SESSION['cart']['item_price'][]= $row_get_access['a_price'];

				$_SESSION['cart']['item_qty'][]= 1;

				$_SESSION['cart']['item_id'][]= $row_get_access['id'];



				echo "success";

			}

			

	break;

	case 'add_to_cart':



			//================Update Cart Qty for same PRoduct===================//

			if(isset($_SESSION['cart'])&&count($_SESSION['cart']['item_id'])>0){



					if (in_array($_REQUEST['pro_id'], $_SESSION['cart']['item_id'])){



						$key = array_search($_REQUEST['pro_id'], $_SESSION['cart']['item_id']);

						 $_SESSION['cart']['item_qty'][$key] = $_SESSION['cart']['item_qty'][$key]+1;
						
						$updTemp = "update temp_order_item set item_qty = item_qty + 1 WHERE order_id = '".$order_id."' AND item_id = '".$_REQUEST['pro_id']."' ";
						mysqli_query($db, $updTemp);

						 echo "success";exit;

					}

			}

			

			$qry_get_access = "SELECT * FROM access WHERE id = ".$_REQUEST['pro_id'];

			$res_get_access = mysqli_query($db,$qry_get_access);

			$row_get_access = mysqli_fetch_assoc($res_get_access );



			

			if($row_get_access['a_price'] = $_REQUEST['pro_price']){



				$_SESSION['cart']['item_name'][]= $row_get_access['a_name'];

				$_SESSION['cart']['item_price'][]= $row_get_access['a_price'];

				$_SESSION['cart']['item_qty'][]= 1;

				$_SESSION['cart']['item_id'][]= $row_get_access['id'];

				$insTemp = "insert into temp_order_item set order_id = '".$order_id."', item_id = '".$row_get_access['id']."', item_qty = '1', item_name = '".$row_get_access['a_name']."', item_price = '".$row_get_access['a_price']."', added_date = '".date('Y-m-d H:i:s')."' ";
				mysqli_query($db, $insTemp);

				echo "success,".count($_SESSION['cart']['item_id']);

			}

			

	break;

	case 'update_qty':



			//================Update Cart Qty for same PRoduct===================//

			if(isset($_SESSION['cart'])&&count($_SESSION['cart']['item_id'])>0){



					if (in_array($_REQUEST['pro_id'], $_SESSION['cart']['item_id'])){



						$key = array_search($_REQUEST['pro_id'], $_SESSION['cart']['item_id']);

						 $_SESSION['cart']['item_qty'][$key] = $_REQUEST['pro_qty'];
						
						$updTemp = "update temp_order_item set item_qty = '".$_REQUEST['pro_qty']."' WHERE order_id = '".$order_id."' AND item_id = '".$_REQUEST['pro_id']."' ";
						mysqli_query($db, $updTemp);

						 echo "success";exit;

					}

			}

			

			

			

	break;

	case 'delete_item':



			//================Update Cart Qty for same PRoduct===================//

			if(isset($_SESSION['cart'])&&count($_SESSION['cart']['item_id'])>0){



					if (in_array($_REQUEST['pro_id'], $_SESSION['cart']['item_id'])){

						$updTemp = "delete from temp_order_item WHERE order_id = '".$order_id."' AND item_id = '".$_REQUEST['pro_id']."' ";
						mysqli_query($db, $updTemp);

						$key = array_search($_REQUEST['pro_id'], $_SESSION['cart']['item_id']);

						 unset($_SESSION['cart']['item_qty'][$key]);

						 unset($_SESSION['cart']['item_id'][$key]);

						 unset($_SESSION['cart']['item_name'][$key]);

						 unset($_SESSION['cart']['item_price'][$key]);



						$_SESSION['cart']['item_name'] =  array_values(array_filter($_SESSION['cart']['item_name']));

						$_SESSION['cart']['item_price'] = array_values(array_filter($_SESSION['cart']['item_price']));

						$_SESSION['cart']['item_qty'] = array_values(array_filter($_SESSION['cart']['item_qty']));

						$_SESSION['cart']['item_id'] = array_values(array_filter($_SESSION['cart']['item_id']));

				

						 echo "success";exit;

					}

			}

			

			

			

	break;

	case 'cart_to_chkout':



			if(isset($_SESSION['post_back_url']))

			{

				unset($_SESSION['post_back_url']);

			}

			$_SESSION['post_back_url'] = 'checkout';

	break;
		
		
	case 'phone_varify':
		
		$Err = '';
		
		if(empty($_REQUEST['phone_no']) || empty($_REQUEST['email_ad'])){
			$Err = 'Please enter valid phone no. and email.';
		}else if( strlen($_REQUEST['phone_no']) < 10 ){
			$Err = 'Please enter valid phone no.';		
		}else if(!is_valid_email($_REQUEST['email_ad'])){
			$Err = 'Please enter valid email address.';		
		}

		if($Err != ''){
			echo '<span style="color:red; font-weight:bold;" >'.$Err.'</span>';
		}

		if($Err == ''){
			$qry_get_access = "SELECT * FROM user_details WHERE u_phone = '".$_REQUEST['phone_no']."' or  u_email = '".$_REQUEST['email_ad']."' ";
			$res_get_access = mysqli_query($db,$qry_get_access);

			if(mysqli_num_rows($res_get_access) > 0){
				echo '<span style="color:red; font-weight:bold;" >Please check mobile no. or email it is already registered with us.</span>';
			}else{
				
				// Account details
				//$apiKey = urlencode('BhN+Xb1djIQ-9tms1JjZbapNOpLrsoYcAP7wCbidd5');

				$apiKey = SMS_API_KEY;

				// Message details
				$numbers = array($_REQUEST['phone_no']);
				
				$otp = rand(1000,9999);
				
				$sender = urlencode('TXTLCL');
				$message = rawurlencode('Paragon Accessories registration OTP is '.$otp);

				$numbers = implode(',', $numbers);

				// Prepare data for POST request
				$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

				// Send the POST request with cURL
				$ch = curl_init('https://api.textlocal.in/send/');
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($ch);
				curl_close($ch);

				// Process your response here
				$response = json_decode($response, true);

				/*if($response['status'] == 'success'){
					echo '<span style="color:green; font-weight:bold;" >OTP sent successfully!</span>';
					$_SESSION['reg_otp'] = $otp;
				}else if($response['status'] == 'failure'){
					echo '<span style="color:red; font-weight:bold;" >'.$response['warnings'][0]['message'].'</span>';
				}else{
					echo '<span style="color:red; font-weight:bold;" >Unable to send otp please try again later.</span>';
				}*/
				
				$htmlContent='

                 <html>

                    <head>

                        <title>Welcome to Paragone Accessorires Pvt. Ltd.</title>

                    </head>

                    <body style ="font-family: Helvetica, Arial, sans-serif;">

                        <div style="width:100%;text-align:center"><img width="20%" src="'.$SITE_URL.'images/logo-black.png"></div>

                        <p>Hello </p>

                        <br />

                        <p>Welcome to Paragone Accessorires Pvt. Ltd.</p>

                        <p>Your registration otp is '.$otp.'.</p>

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

                $subject = "Registration One Time Password";

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

                $to = $_REQUEST['email_ad'];

                $mail->AddAddress($to);

                $mail->Subject  =   $subject;

                $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

                $mail->WordWrap   = 80; // set word wrap

                $mail->MsgHTML($htmlContent);

                $mail->IsHTML(true); // send as HTML

                $sendEmail = $mail->Send();

                if($sendEmail){ 
					echo 'success'; 
					$_SESSION['reg_otp'] = $otp;
				}else{
					'<span style="color:red; font-weight:bold;" >Otp not sent please try again.</span>';
				}

                //echo 'Message has been sent.';

                } catch (phpmailerException $e) {

                    echo $e->errorMessage();

                }
				
				
			}

		}

	break;
		
		
	case 'send_login_otp':
		
		$Err = '';
		
		if(empty($_REQUEST['email_ad'])){
			$Err = '<span style="color:red; font-weight:bold;" >Please enter valid phone no. and email.</span>';
		}else if(!is_valid_email($_REQUEST['email_ad'])){
			$Err = '<span style="color:red; font-weight:bold;" >Please enter valid email address.</span>';		
		}

		if($Err != ''){
			echo '<span style="color:red; font-weight:bold;" >'.$Err.'</span>';
		}

		if($Err == ''){
			$qry_get_access = "SELECT * FROM user_details WHERE u_email = '".$_REQUEST['email_ad']."' ";
			$res_get_access = mysqli_query($db,$qry_get_access);

			if(mysqli_num_rows($res_get_access) == 0){
				echo '<span style="color:red; font-weight:bold;" >Please check email is not registered with us.</span>';
			}else{
				
				$RowSignIn = mysqli_fetch_array($res_get_access);
				
				// Account details
				//$apiKey = urlencode('BhN+Xb1djIQ-9tms1JjZbapNOpLrsoYcAP7wCbidd5');

				$apiKey = SMS_API_KEY;

				// Message details
				$numbers = array($RowSignIn['u_phone']);
				
				$otp = rand(1000,9999);
				
				$sender = urlencode('TXTLCL');
				$message = rawurlencode('Paragon Accessories login OTP is '.$otp);

				$numbers = implode(',', $numbers);

				// Prepare data for POST request
				$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

				// Send the POST request with cURL
				$ch = curl_init('https://api.textlocal.in/send/');
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($ch);
				curl_close($ch);

				// Process your response here
				$response = json_decode($response, true);

				/*if($response['status'] == 'success'){
					echo '<span style="color:green; font-weight:bold;" >OTP sent successfully!</span>';
					$_SESSION['reg_otp'] = $otp;
				}else if($response['status'] == 'failure'){
					echo '<span style="color:red; font-weight:bold;" >'.$response['warnings'][0]['message'].'</span>';
				}else{
					echo '<span style="color:red; font-weight:bold;" >Unable to send otp please try again later.</span>';
				}*/
				
				$htmlContent='

                 <html>

                    <head>

                        <title>Paragone Accessorires Pvt. Ltd.</title>

                    </head>

                    <body style ="font-family: Helvetica, Arial, sans-serif;">

                        <div style="width:100%;text-align:center"><img width="20%" src="'.$SITE_URL.'images/logo-black.png"></div>

                        <p>Hello </p>

                        <br />

                        <p>Welcome to Paragone Accessorires Pvt. Ltd.</p>

                        <p>Your login otp is '.$otp.'.</p>

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

                $subject = "Login One Time Password";

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

                $to = $_REQUEST['email_ad'];

                $mail->AddAddress($to);

                $mail->Subject  =   $subject;

                $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

                $mail->WordWrap   = 80; // set word wrap

                $mail->MsgHTML($htmlContent);

                $mail->IsHTML(true); // send as HTML

                $sendEmail = $mail->Send();

                if($sendEmail){ 
					echo 'success'; 
					$_SESSION['login_otp'] = $otp;
				}else{
					'<span style="color:red; font-weight:bold;" >Otp not sent please try again.</span>';
				}

                //echo 'Message has been sent.';

                } catch (phpmailerException $e) {

                    echo $e->errorMessage();

                }
				
				
			}

		}

	break;
		
	case 'subscribers':
		
		$Err = '';
		if(!is_valid_email($_REQUEST['email'])){
			$Err = 'Please enter valid email address.';		
		}else{
			$qry_get_access = "SELECT * FROM email_subscribers WHERE email = '".$_REQUEST['email']."' ";
			$res_get_access = mysqli_query($db,$qry_get_access);

			if(mysqli_num_rows($res_get_access) > 0){
				$Err = 'Email already register.';
			}
		}
		
		if($Err == ''){
			$qryES = "INSERT INTO email_subscribers SET email = '".$_REQUEST['email']."', register_date = '".date('Y-m-d H:i:s')."' ";
			$resES = mysqli_query($db,$qryES);
			if($resES){
				$Err = 'Email register successfully.';
			}else{
				$Err = 'Email not register. Please try again.';
			}
		}
		echo $Err;
	break;
		

}





?>