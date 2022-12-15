<?php 
include('connect.php');

// Get a key from https://www.google.com/recaptcha/admin/create
$publickey = "6LesOI0UAAAAAGbOPcVShy1tvlj_7Aj3mTXMkAZ9";
$privatekey = "6LesOI0UAAAAAAYCjqDAQaAigYB_TAizwmVdROs2";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

$meta_title = "Reach Us | Paragon Accessories Pvt. Ltd.";
$meta_keywords = "Two wheeler accessories, honda accessories, yamaha accessories, suzuki accessories, mahindra accessories, tvs accessories, royale enfield accessories, bike accessories, scooter accessories";
$meta_desc = "Reach Us  | Paragon Accessories Pvt. Ltd.";
if(isset($_POST['submit_btn'])&& $_POST['submit_btn']=='submit'){
	
	if(isset($_POST['g-recaptcha-response']))
          $captcha=$_POST['g-recaptcha-response'];

	 if(!$captcha){
		 $error = 'Please check captcha is invalid.';
	 }else {
		 $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$privatekey."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

		if($response['success'] == false){
			$error = 'You are spammer ! Get the @$%K out';
		}else{
			$body = '';
			$body .= '<p>&nbsp;</p>';
			$body .= '<p>Hello Admin,</p>';
			$body .= '<p>New contact inquiry from your website http://paragontwowheeleraccessories.com/</p>';
			$body .= '<p>&nbsp;</p>';
			$body .= '<p>Name : <strong>'.$_POST['c_name'].'</strong></p>';
			$body .= '<p>Company Name : <strong>'.$_POST['cc_name'].'</strong></p>';
			$body .= '<p>Email : <strong>'.$_POST['c_email'].'</strong></p>';
			$body .= '<p>Mobile : <strong>'.$_POST['c_mobile'].'</strong></p>';
			$body .= '<p>Telephone : <strong>'.$_POST['c_phone'].'</strong></p>';
			$body .= '<p>Subject : <strong>'.$_POST['c_subject'].'</strong></p>';
			$body .= '<p>Message : <strong>'.$_POST['message'].'</strong></p>';
			$body .= '<p>Country : <strong>'.$_POST['country'].'</strong></p>';
			$body .= '<p>State : <strong>'.$_POST['state'].'</strong></p>';
      $body .= '<p>City : <strong>'.$_POST['city'].'</strong></p>';
      $body .= '<p>Pincode/Zip : <strong>'.$_POST['zip_pincode'].'</strong></p>';

			  $subject = "New Contact Inquiry";

			  require_once 'include/phpmailer/class.phpmailer.php'; 
			  $mail = new PHPMailer(true); 


			  try{
					$mail->IsSMTP();                           // tell the class to use SMTP
					$mail->SMTPAuth   = true;                  // enable SMTP authentication
					$mail->Port       = 465;     
					$mail->Host       = "md-in-29.webhostbox.net"; // SMTP server
					$mail->Username   = "noreply@paragontwowheeleraccessories.com";     // SMTP server username
					$mail->Password   = "himat@123"; 
					$mail->SMTPSecure = "ssl"; 
				   // $mail->IsSendmail();  // tell the class to use Sendmail

					$mail->AddReplyTo($_POST['c_email'],$_POST['c_name']);

					$mail->From       = 'noreply@paragontwowheeleraccessories.com';
					$mail->FromName   = 'Paragon Two Wheeler Accessories';

					$to = "services@paragontwowheeleraccessories.com";
				    //$to = "parasana.himat@gmail.com";

					$mail->AddAddress($to);
					$mail->AddCC("sales@paragontwowheeleraccessories.com","Sales Paragon");
					$mail->AddCC("info@paragontwowheeleraccessories.com","Info Paragon");

					$mail->Subject  =   $subject;
					$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
					$mail->WordWrap   = 80; // set word wrap

					$mail->MsgHTML($body);

					$mail->IsHTML(true); // send as HTML

					$sendEmail = $mail->Send();


			  //echo 'Message has been sent.';
			  } catch (phpmailerException $e) {
				  echo $e->errorMessage();

			  }
			  //===============SMS API==================//

				// Account details
				//$apiKey = urlencode('BhN+Xb1djIQ-9tms1JjZbapNOpLrsoYcAP7wCbidd5');
				$apiKey = SMS_API_KEY;

				// Message details
				$numbers = array(9722332211);
				
				$sender = urlencode('TXTLCL');
				$message = rawurlencode('New Contact Inquiry from Website. Please Check Email.');

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
				echo $response;

			  //===============SMS API==================//
			header("Location:?msg=P");
		 }
	 }
}
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

<script src='https://www.google.com/recaptcha/api.js'></script>
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
          <h2>Reach Us</h2>
          <span><a href="<?php echo $SITE_URL;?>">Home</a> / Reach Us</span> </div>
      </div>
    </div>
  </div>
</div>
<div class="contact-us">
  <div class="container">
    <div class="row">
      <div class="product-item col-md-12">
      <?php if(isset($_GET['msg']) && $_GET['msg']=='P') {?>
        <div class="alert alert-success">
          <strong>Thank you!</strong> Your inquiry has been sent to Admin. We will contact you soon.
        </div>
        <?php } 
		if($error != ''){ ?>
		<div class="alert alert-error"><?php echo $error; ?></div>
		<?php } ?>
        <div class="row">
          <div class="col-lg-12">
            <div class="message-form">
              <form  method="post" class="send-message" id="contact_form">
                <div class="row">
                  <div class="name col-md-4">
                    <input type="text" name="c_name" id="c_name" placeholder="Your Name" />
                  </div>
                  <div class="email col-md-4">
                    <input type="text" name="cc_name" id="cc_name" placeholder="Company Name" />
                  </div>
                  <div class="name col-md-4">
                    <input type="email" name="c_email" id="c_email" placeholder="Email" />
                  </div>
                  <div class="email col-md-4">
                    <input type="text" name="c_mobile" id="c_mobile" placeholder="Mobile" />
                  </div>
                  <div class="subject col-md-4">
                    <input type="text" name="c_phone" id="c_phone" placeholder="Telephone No." />
                  </div>
                  <div class="subject col-md-4">
                    <select class="form-control" name="c_subject" id="c_subject">
                      <option value="">Select Subject</option>
                      <option value="Sales Support">Sales Support</option>
                      <option value="Apply for Dealership">Apply for Dealership</option>
                      <option value="Transporter Enquiry">Transporter Enquiry</option>
                      <option value="Feedback Regarding Services">Feedback Regarding Services</option>
                      <option value="Feedback Regarding Product">Feedback Regarding Product</option>
                      <option value="Bulk Enquiry">Bulk Enquiry</option>
                      <option value="Vendor Registration">Vendor Registration</option>
                      <option value="Raw material Supply">Raw material Supply</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                  <div class="subject col-md-3">
                    <select class="form-control" id="country" name ="country">
                      <option value="">Select Country</option>
                    </select>
                  </div>
                  <div class="state col-md-3">
                    <select class="form-control" name ="state" id ="state">
                      <option value="">Select State</option>
                    </select>
                  </div>
                  <div class="email col-md-3">
                    <input type="text" name="city" id="city" placeholder="Enter City" />
                  </div>
                  <div class="email col-md-3">
                    <input type="text" name="zip_pincode" id="zip_pincode" placeholder="Enter Pincode/Zip" />
                  </div>
                  <div class="text col-md-12">
                    <textarea name="message" placeholder="Message" id="message"></textarea>
                  </div>
                  
                  <div class="text col-md-12">
                  	<div class="g-recaptcha" data-sitekey="6LesOI0UAAAAAGbOPcVShy1tvlj_7Aj3mTXMkAZ9"></div>
                  </div>
                </div>
                <div class="send">
                  <button type="submit" name="submit_btn" value="submit">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="map">
      <div class="row">
        <div class="col-lg-12">
          <div class="heading-section">
            <h2>Find Us <span>On Map</span></h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div id="TabbedPanels1" class="TabbedPanels">
            <ul class="TabbedPanelsTabGroup">
              <li class="TabbedPanelsTab" tabindex="0"><span>Corporate</span> office
                <div class="arrow-d"></div>
              </li>
              <li class="TabbedPanelsTab" tabindex="0">Unit 1
                <div class="arrow-d"></div>
              </li>
              <li class="TabbedPanelsTab" tabindex="0">Unit 2
                <div class="arrow-d"></div>
              </li>
              <?php /*?><li class="TabbedPanelsTab" tabindex="0">Unit 3
                <div class="arrow-d"></div>
              </li><?php */?>
              <li class="TabbedPanelsTab" tabindex="0">Unit 3
                <div class="arrow-d"></div>
              </li>
            </ul>
            <div class="TabbedPanelsContentGroup">
              <div class="TabbedPanelsContent">
                <div class="info">
                  <div class="col-md-4">
                    <ul>
                      <li><i class="fa fa-map-signs"></i> <strong>Paragon House</strong><br>
                        4-Bhaktinagar station plot, Opp. Metro offset,<br>
                        Gondal road, Rajkot - 360002 </li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                    <ul>
                      <li><i class="fa fa-phone"></i>+91 92276 28929</li>
                      <li><i class="fa fa-phone"></i>+91 97223 32211</li>
                      <li><i class="fa fa-envelope"></i><a href="mailto:sales@paragontwowheeleraccessories.com">sales@paragontwowheeleraccessories.com</a></li>
                    </ul>
                  </div>
                </div>
                <div id="googleMap">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3689.785255670942!2d70.9413463154202!3d22.36173594631181!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959b10347e00067%3A0x44c01778b531e340!2sPARAGON+ACCESSORIES+PVT.+LTD.!5e0!3m2!1sen!2sin!4v1470208817018" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
              </div>
              <div class="TabbedPanelsContent">
                <div class="info">
                  <div class="col-md-6">
                    <ul>
                      <li><i class="fa fa-map-signs"></i> <strong>Paragon Accessories Pvt. Ltd.</strong><br>
                        Survey No.197, Plot No.7-A, Plasama Road, Gondal Highway,<br>
                        Veraval(Shapar), Rajkot - 360024 </li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                    <ul>
                      <li><i class="fa fa-phone"></i>+91 92276 28929</li>
                      <li><i class="fa fa-phone"></i>+91 97223 32211</li>
                      <li><i class="fa fa-envelope"></i><a href="mailto:sales@paragontwowheeleraccessories.com">sales@paragontwowheeleraccessories.com</a></li>
                    </ul>
                  </div>
                </div>
                <div id="googleMap">
                 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12428.282300119337!2d70.78673407452223!3d22.165958683486043!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x16820c6b1cec41b0!2sAirtel+Store!5e0!3m2!1sen!2sin!4v1553861713209!5m2!1sen!2sin" width="600"  style="border:0" allowfullscreen></iframe>
                  <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3689.785255670942!2d70.9413463154202!3d22.36173594631181!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959b10347e00067%3A0x44c01778b531e340!2sPARAGON+ACCESSORIES+PVT.+LTD.!5e0!3m2!1sen!2sin!4v1470208817018" frameborder="0" style="border:0" allowfullscreen></iframe>-->
                </div>
              </div>
              <div class="TabbedPanelsContent">
                <div class="info">
                  <div class="col-md-7">
                    <ul>
                      <li><i class="fa fa-map-signs"></i> <strong>Paragon Accessories Pvt. Ltd.</strong><br>
                        Survey No.197, Plot No.7-B, Opp.Micro Melt, Gondal Highway,<br>
                        Veraval(Shapar), Rajkot - 360024 </li>
                    </ul>
                  </div>
                  <div class="col-md-5">
                    <ul>
                      <li><i class="fa fa-phone"></i>+91 92276 28929</li>
                      <li><i class="fa fa-phone"></i>+91 97223 32211</li>
                      <li><i class="fa fa-envelope"></i><a href="mailto:sales@paragontwowheeleraccessories.com">sales@paragontwowheeleraccessories.com</a></li>
                    </ul>
                  </div>
                </div>
                <div id="googleMap">
                 	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d236776.8484044814!2d70.73215536394952!3d21.986842527021015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xefb5f046175c6282!2sMicro+Melt+Pvt.+Ltd.!5e0!3m2!1sen!2sin!4v1553861603935!5m2!1sen!2sin"  frameborder="0" style="border:0" allowfullscreen></iframe>
                  <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3689.785255670942!2d70.9413463154202!3d22.36173594631181!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959b10347e00067%3A0x44c01778b531e340!2sPARAGON+ACCESSORIES+PVT.+LTD.!5e0!3m2!1sen!2sin!4v1470208817018" frameborder="0" style="border:0" allowfullscreen></iframe>-->
                </div>
              </div>
              <?php /*?><div class="TabbedPanelsContent">
                <div class="info">
                  <div class="col-md-7">
                    <ul>
                      <li><i class="fa fa-map-signs"></i> <strong>Paragon Accessories Pvt. Ltd.</strong><br>
                        Survey No.161,Plot No.4,Opp.Regal Pump, Nr.Primeseal Industries, SIDCO Road, <br>
                        Veraval(Shapar), Tal.Kotda Sangani. Dist.Rajkot - 360024 </li>
                    </ul>
                  </div>
                  <div class="col-md-5">
                    <ul>
                      <li><i class="fa fa-phone"></i>+91 92276 28929</li>
                      <li><i class="fa fa-phone"></i>+91 97223 32211</li>
                      <li><i class="fa fa-envelope"></i><a href="mailto:sales@paragontwowheeleraccessories.com">sales@paragontwowheeleraccessories.com</a></li>
                    </ul>
                  </div>
                </div>
                <div id="googleMap">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3689.785255670942!2d70.9413463154202!3d22.36173594631181!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959b10347e00067%3A0x44c01778b531e340!2sPARAGON+ACCESSORIES+PVT.+LTD.!5e0!3m2!1sen!2sin!4v1470208817018" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
              </div><?php */?>
              <div class="TabbedPanelsContent">
                <div class="info">
                  <div class="col-md-6">
                    <ul>
                      <li><i class="fa fa-map-signs"></i> <strong>Paragon Accessories Pvt. Ltd.</strong><br>
                        Plot no.-219,220,221, Kuvadava G.I.D.C, 8-B national highway, <br>
                        Kuvadava - 360023 Dist- Rajkot </li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                    <ul>
                      <li><i class="fa fa-phone"></i>+91 92276 28929</li>
                      <li><i class="fa fa-phone"></i>+91 97223 32211</li>
                      <li><i class="fa fa-envelope"></i><a href="mailto:sales@paragontwowheeleraccessories.com">sales@paragontwowheeleraccessories.com</a></li>
                    </ul>
                  </div>
                </div>
                <div id="googleMap">
                 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3689.6141377211743!2d70.95532661443039!3d22.368194046080607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959b0552988afed%3A0x25b90c19709a2258!2skuvadva+gidc!5e0!3m2!1sen!2sin!4v1553861504603!5m2!1sen!2sin"  frameborder="0" style="border:0" allowfullscreen></iframe>
                  <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3689.785255670942!2d70.9413463154202!3d22.36173594631181!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959b10347e00067%3A0x44c01778b531e340!2sPARAGON+ACCESSORIES+PVT.+LTD.!5e0!3m2!1sen!2sin!4v1470208817018" frameborder="0" style="border:0" allowfullscreen></iframe>-->
                </div>
              </div>
            </div>
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
<script src="js/jquery.validate.min.js"></script>
<!--<script src="js/bootstrap.js"></script>-->
<script type="text/javascript">
    
    $(document).ready(function() {

        $("#contact_form").validate({

            rules: {

                c_name: "required",
                c_email: "required",
                cc_name: "required",
                c_phone: "required",
                c_mobile: "required",
                c_subject: "required",
                message: "required",
                country: "required",
                state: "required",
                city: "required",
                zip_pincode: "required",
            },
             errorPlacement: function(){
                return false;  // suppresses error message text
             }

        });

    });

</script>

<script src="js/jis.jquery.min.js"></script>
<script src="js/vendor/jquery.gmap3.min.js"></script>
<script src="js/menu_slide.js"></script>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
       </script>
       
</body>
</html>
