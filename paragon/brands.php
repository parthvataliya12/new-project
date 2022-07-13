<?php 
include('connect.php');
$pgname = 'brands';
$brand_id_arr = array();
$brand_name_arr =  array();
$res_brand_list= mysqli_query($db,"SELECT * FROM brands ORDER BY id ASC");
$meta_title = "Brands | Paragon Accessories Pvt. Ltd.";
$meta_keywords = "Two wheeler accessories, honda accessories, yamaha accessories, suzuki accessories, mahindra accessories, tvs accessories, royale enfield accessories";
$meta_desc = "Brands | Paragon Accessories Pvt. Ltd.";
 ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->


    <head>
        <?php include('head.php'); ?>
       
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
                                <h2>Brands</h2>
                                <span><a href="<?php echo $SITE_URL;?>">Home</a> / Brands</span>
                            </div>
                        </div>
                   
                </div>
                </div>
            </div>

            
            
            <div id="products-post">
                <div class="container">
                    
                    <div class="row">
                        <div class="filters col-md-12 col-xs-12">
                            <ul id="filters" class="clearfix">
                                <li><span class="filter" data-filter="all">All</span></li>
                               
                            <?php while($row_brand_list = mysqli_fetch_assoc($res_brand_list)){ 
                                $brand_id_arr[] = $row_brand_list['id'] ;
                                 ?>
                                 <li><span class="filter" data-filter=".<?php echo  $brand_name_arr[] = clean_url($row_brand_list['brand_name'])?>"><?php echo $row_brand_list['brand_name'] ?></span></li>
                            <?php } ?>
                             
                            </ul>
                        </div>
                    </div>
                    <div class="row" id="Container">
                    <?php 
                        for($br=0;$br<count($brand_id_arr);$br++){
                            $res_brands_models = mysqli_query($db,"SELECT * FROM models WHERE brand_id = ".$brand_id_arr[$br]." AND status = 'Y'");
                                while($row_barnd_model = mysqli_fetch_assoc($res_brands_models)){
                            ?>
                            <div class="col-md-3 col-sm-6 mix portfolio-item <?php echo $brand_name_arr[$br] ?>">       
                                <div class="portfolio-wrapper">                
                                    <div class="portfolio-thumb">
                                        <img src="<?php echo $SITE_URL ?>images/product_images/<?php echo $row_barnd_model['model_display_picture'] ?>" alt="" class="model_img"/>
                                        <div class="hover">
                                            <div class="hover-iner">
                                                <a class="fancybox" href="<?php echo $SITE_URL ?>brands/<?php echo $row_barnd_model['slug'] ?>/"><img src="<?php echo $SITE_URL ?>images/open-icon.png" alt="" /></a>
                                            </div>
                                        </div>
                                    </div>  
                                    <!--<div class="label-text">
                                        <h3><a href="products_details.html">Product Name</a></h3>
                                        <span class="text-category">Rs 00.00</span>
                                    </div>-->
                                </div>          
                            </div>
                            <?php } ?>
                        <?php } ?>
                        
                    </div>
                   
                </div>
            </div>



			<?php include('footer.php'); ?>

    
        <!--<script src="js/vendor/jquery-1.11.0.min.js"></script>-->
        <script src="<?php echo $SITE_URL ?>js/bootstrap.js"></script>
        <script src="<?php echo $SITE_URL ?>js/vendor/jquery.gmap3.min.js"></script>
        <script src="<?php echo $SITE_URL ?>js/plugins.js"></script>
        <script src="<?php echo $SITE_URL ?>js/main.js"></script>
       <script src="<?php echo $SITE_URL ?>js/menu_slide.js"></script>

    </body>
</html>