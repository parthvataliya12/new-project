<?php 
 include('connect.php');

 if(isset($_POST['submit_btn']) && $_POST['submit_btn']=='submit'){
    $user_email = $_POST['u_email'];
    $qry_find = "SELECT * FROM user_details WHERE u_email = '".$user_email."'";
    $res = mysqli_query($db,$qry_find);
    $row = mysqli_fetch_assoc($res);
    if(mysqli_num_rows($res)>0)
    {
        $body = '';
        $body .= '<p>&nbsp;</p>';
        $body .= '<p>Hello '.$row['u_name'].'</p>';
        $body .= '<p>Your login details are as follow:</p>';
        $body .= '<p>&nbsp;</p>';
        $body .= '<p>URL :: <a href="'.$SITE_URL.'login/">'.$SITE_URL.'login/</a></p>';
        $body .= '<p>Login Email :: '.$user_email .'</p>';
        $body .= '<p>Password :: '.$row['u_password'].'</p>'; 
        $body .= '<p>&nbsp;</p>';
        $body .= '<p>&nbsp;</p>';
        $body .= '<p>Save or Print this important information.</p>';
        
   
          $subject = "Your password is inside.";

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
                
                $to = $user_email;
            
                $mail->AddAddress($to);
            
                $mail->Subject  =   $subject;
                $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                $mail->WordWrap   = 80; // set word wrap
            
                $mail->MsgHTML($body);
                
                $mail->IsHTML(true); // send as HTML
            
                $sendEmail = $mail->Send();

                header("Location:".$SITE_URL."login/?msg=P");
          //echo 'Message has been sent.';
          } catch (phpmailerException $e) {
              echo $e->errorMessage();
          }
    
     
    }
    else
    {
        header("Location:?msg=I");
    }
}
$meta_title = "Forgot Password | Paragon Accessories Pvt. Ltd.";
$meta_keywords = "Two wheeler accessories, honda accessories, yamaha accessories, suzuki accessories, mahindra accessories, tvs accessories, royale enfield accessories, bike accessories, scooter accessories";
$meta_desc = "Forgot Password | Paragon Accessories Pvt. Ltd.";
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
          <h2>Forgot Password?</h2>
          <span><a href="<?php echo $SITE_URL; ?>">Home</a> / Forgot Password?</span> </div>
      </div>
    </div>
  </div>
</div>
<div class="contact-us">
  <div class="container">
    <div class="row">
      <div class="product-item col-md-12">
       <?php if(isset($_GET['msg']) && $_GET['msg']=='I') {?>
        <div class="alert alert-danger">
          <strong>Oops!</strong> Please Enter Valid Email-address.
        </div>
        <?php } ?>
        <div class="row">
         
          <div class="text-center login-box">
          <div class="message-form">
          <form  method="post" class="send-message">
            <div class="row">
              <div class="name col-md-12">
                <input type="text" name="u_email" id="u_email" placeholder="Enter your email to retrive the password" />
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
</div>
</div>
<?php include('footer.php') ?>
<!--<script src="js/vendor/jquery-1.11.0.min.js"></script>-->
<!--<script src="js/bootstrap.js"></script>-->
<script src="js/jis.jquery.min.js"></script>
<script src="js/vendor/jquery.gmap3.min.js"></script>
<script src="js/menu_slide.js"></script>
</body>
</html>
