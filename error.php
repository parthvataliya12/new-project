<?php

include('connect.php'); 

$meta_title = "Error | Paragon Accessories Pvt. Ltd.";

$meta_keywords = "Two wheeler accessories, honda accessories, yamaha accessories, suzuki accessories, mahindra accessories, tvs accessories, royale enfield accessories";

$meta_desc = "Error | Paragon Accessories Pvt. Ltd.";

?>

<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->

<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->

<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->

<!--[if gt IE 8]><!--> 

<html class="no-js"> <!--<![endif]-->





<head>

     <?php include('head.php') ?>

    </head>

    <body>

        <!--[if lt IE 7]>

            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>

        <![endif]-->



           <?php include('nav.php') ?>





            <div id="heading">

            	

              	  <div class="container">

                  	

                    <div class="row">                    	

                        <div class="col-md-12">

                            <div class="heading-content">

                                <h2>Error</h2>

                                <span><a href="<?php echo $SITE_URL; ?>">Home</a> / Error</span>

                            </div>

                        </div>

                   

                </div>

                </div>

            </div>





            <div id="timeline-post">

                <div class="container">

                    <!--<div class="row">

                        <div class="col-md-12">

                            <div class="heading-section">

                                <h2>Who We Are</h2>

                                <img src="images/under-heading.png" alt="" >

                            </div>

                        </div>

                    </div>-->

                    

                    <div class="row">

                        <div class="col-md-12 text-center">

                        	
                        	<h1><br />Error<br /><br /></h1>
                        	
                        	<?php if($_GET['e'] == 'a'){
								echo "<h1 style='line-height:48px;' >Thank you for shopping with us.<br />However,the transaction has been cancelled.</h1>";
							}else if($_GET['e'] == 'f'){
								echo "<h1 style='line-height:48px;' >Thank you for shopping with us.<br />However,the transaction has been declined.</h1>";
							}else if($_GET['e'] == 's'){
								echo "<h1 style='line-height:48px;' >Security Error. <br />Illegal access detected.</h1>";
							}else if($_GET['e'] == 'e'){
								echo "<h1 style='line-height:48px;' >Security Error. <br />Illegal access detected.<br />However, if you charged for the order. Please contact us.</h1>";
							}else{
								echo "<h1 style='line-height:48px;' >Security Error. <br />Illegal access detected.</h1>";
							}
							?>
							<br /><br /><br />


                        </div>

                    </div>

                    

                    

                </div>

            </div>

            



<div class="space50"></div>

            





            <?php include('footer.php') ?>



        <!--<script src="js/vendor/jquery-1.11.0.min.js"></script>-->

        <!--<script src="js/bootstrap.js"></script>-->

        <script src="js/jis.jquery.min.js"></script>         

        <script src="js/vendor/jquery.gmap3.min.js"></script>



      <script src="js/menu_slide.js"></script>



    </body>

</html>