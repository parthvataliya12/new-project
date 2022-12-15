<?php 
include('connect.php');
if(!isset($_GET)&&$_GET['pid']==''){
    header('location:'.$SITE_URL);
}

$pgname = 'brands_details';
$res_model_details = mysqli_query($db,"SELECT * FROM models WHERE slug = '".$_GET['pid']."' ORDER BY id ASC");
$row_model_details = mysqli_fetch_array($res_model_details);
$brand_id = $row_model_details['brand_id'];
$model_type = $row_model_details['model_type'];
$model_status = $row_model_details['status'];
$brand_name =  Get_one_value('brands','brand_name',$row_model_details['brand_id'],'id',$db); 
$model_name = $row_model_details ['model_name'];
$model_description =  stripslashes($row_model_details['model_description']);
$model_display_picture = $row_model_details ['model_display_picture'];
$model_id = $row_model_details ['id'];

$meta_title = "Brand | ".$row_model_details ['meta_title'];
$meta_keywords = $row_model_details ['meta_keywords'];
$meta_desc = $row_model_details ['meta_description'];

$res_brand_list2= mysqli_query($db,"SELECT * FROM brands WHERE `id` = '".$brand_id."' ORDER BY id ASC");
$row_brand_list2 = mysqli_fetch_assoc($res_brand_list2);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<?php include('head.php'); ?>
<style>
           .lSSlideOuter .lSPager.lSGallery{
            margin-top: 50px !important;
           }
           .lightSlider.lsGrab > *{
            height: 300px;
           }
          
       </style>
     
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
          <h2><?php echo $brand_name." ".$model_name ?></h2>
          <span><a href="<?php echo $SITE_URL ?>">Home</a> / <a href="<?php echo $SITE_URL."brands/"?>">Brands</a> / <a href="<?php echo $SITE_URL;?>brands/<?php echo $row_brand_list2['slug']; ?>/"><?php echo $row_brand_list2['brand_name']; ?></a> / <?php echo $brand_name." ".$model_name ?></span> </div>
      </div>
    </div>
  </div>
</div>
<div id="product-post">
  <div class="container">
    <div class="row">
      <div class="product-item col-md-12">
      	<?php if($model_status == 'Y') {?>
        <div class="row">
        
			
         
				  <?php /*?><div class="col-md-6">
					<div class="image">
					  <div class="image-post">
					   <div class="flexslider">
						  <ul class="slides">
							<li   data-thumb="<?php echo $SITE_URL ?>images/product_images/<?php echo $model_display_picture; ?>">
							  <img class = "img_box" src="<?php echo $SITE_URL ?>images/product_images/<?php echo $model_display_picture; ?>" />
							</li>
									<?php 
						   $qry_other = "SELECT * FROM model_images WHERE model_id = ".$model_id;
						  $res_other_picture = mysqli_query($db, $qry_other);
						  while($row_other_imgs = mysqli_fetch_assoc($res_other_picture))
						  {
							  if($row_other_imgs['model_image']!='' && file_exists("images/product_images/other_images/".$row_other_imgs['model_image'])){
						 ?>
							<li  data-thumb="<?php echo $SITE_URL ?>images/product_images/other_images/<?php echo $row_other_imgs['model_image'] ?>">
							  <img class = "img_box" src="<?php echo $SITE_URL ?>images/product_images/other_images/<?php echo $row_other_imgs['model_image'] ?>" />
							</li>
							<?php }
						  } ?>
						  </ul>
						</div>
					  </div>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="product-content">
					  <div class="product-title">
						<h3><?php echo $brand_name." ".$model_name ?></h3>
					  </div>
					  <p class="mid"><?php echo $model_description;?></p>

					</div>
				  </div><?php */?>
         
         		
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="Model-slider">
                        	<div id="slider">  
                                	<ul>
							<?php /*?><img src="https://paragontwowheeleraccessories.com/beta/images/product_images/1308099963_003.png" alt="Hero"/><?php */?>
							<?php 
						   	$qry_other = "SELECT * FROM model_images WHERE model_id = ".$model_id."";
							$res_other_picture = mysqli_query($db, $qry_other);
							$isD = 1;
							while($row_other_imgs = mysqli_fetch_assoc($res_other_picture))
							{
								  if($row_other_imgs['model_image']!='' && file_exists("images/product_images/other_images/".$row_other_imgs['model_image']) && $isD == 1){
									  //$isD = 0;
							 ?>
								
                                            <li><img src="<?php echo $SITE_URL ?>images/product_images/other_images/<?php echo $row_other_imgs['model_image'] ?>" alt="<?php echo $model_name; ?>" /></li>

								<?php } 
							} ?>
                                                               </ul>
								</div>
						</div>
					</div>
				
          
        	
          
        </div>
        
        
        <div class="row" >
			<div class="col-md-12 col-sm-12 col-xs-12 brand_main">
					<div class="row">
					<?php
						$selAcc = "SELECT access.*, access_model.model_id FROM access_model 
							LEFT JOIN access ON access.id = access_model.access_id 
						WHERE model_id = ".$model_id." AND access.status = 'Y' ";
						$recAcc = mysqli_query($db, $selAcc);
						while($rowAcc = mysqli_fetch_array($recAcc)){
					?>

													 
						<div class="col-md-3 col-sm-6 mix portfolio-item ">       
							<div class="portfolio-wrapper">                
								<div class="portfolio-thumb">
									<a href="<?php echo $SITE_URL; ?>product/<?php echo $rowAcc['slug']; ?>">

									<?php if($rowAcc['a_discount']){ ?>
										<div class="badge_discount" ><span><?php echo $rowAcc['a_discount']; ?>% <small>Off</small></span></div>
									<?php } ?>

									<?php if($rowAcc['a_picture']!=''){ ?>

									<?php /*?><img src="<?php echo $SITE_URL; ?>images/product_images/<?php echo $rowAcc['a_picture']; ?>" alt="<?php echo $rowAcc['a_name']; ?>" class="model_img"/><?php */?>

									<img src="<?php echo $SITE_URL ?>images/product_images/<?php echo $rowAcc['a_picture']; ?>" alt="<?php echo $rowAcc['a_name']; ?>" class="model_img"/>

									<?php } ?>
									</a>
								</div> 
								<h3><?php echo $rowAcc['a_name']; ?></h3>
								<p><?php if($rowAcc['a_original'] > 0){ ?><span class="origianl_price">Rs. <?php echo $rowAcc['a_original']; ?></span><?php } ?>
                                    <span class="price">Rs. <?php echo $rowAcc['a_price']; ?></span>
                                </p>
								
								<?php if(!in_array($_SESSION['V_Country'], $HideCountry)){ ?>
								<p><a href="javascript:;" data-id="<?php echo $rowAcc['id']; ?>" data-price="<?php echo $rowAcc['a_price']; ?>" class="add-to-cart-btn add_to_cart">Add to Cart</a></p>
								<?php } ?>
							</div>          
						</div>
					
					<?php } ?>
					</div>

			</div>
		</div>
        
        
        <?php }else{ ?>
        <div class="row">
        	<div class="col-md-12 text-center">
        		<h3>This model will be here soon.</h3>
        	</div>
        </div>
        <?php } ?>
        
        <div class="row" >
			<div class="col-md-12 col-sm-12 col-xs-12">
            	<div class="model-detail-text">
					
					<?php echo $model_description; ?>
					
                	<?php /*?><div class="text-title"><h3>Accessorize your Suzuki Access-125</h3></div>
                    <p>Suzuki Access- 125 is a modernized scooter that has been manufactured under Suzuki motorcycle India limited. Suzuki access is recently gaining its importance because it is really a brilliant spacious scooter that helps to make your ride beautiful.</p>
                    <p>The basic structural core of the scooter is made up of pure steel which gives strength as well as look to the scooter. Both front and rear brakes are available which help you stopping the rotating wheel in just a few seconds. The base of the wheel is pretty good which is of 1250 mm. </p>
                    <p>Along with such specification, all are also crazy about the good looking accessories that help in building a strong structure to protect the scooter from further damages. And to buy access 125 accessories online, the best manufacturer of such accessories are Paragon Accessories Pvt. Ltd. </p>
                    <p>&nbsp;</p>
                    <h4>What are the special products we have for access 125:</h4>
                    <ul>
                    	<li><p><strong>All rounded guard with fitting:</strong> These are basically all rounded protective guard as the name suggests. Made up of stainless steel material they are anti-rust also which can withstand any weather.</p></li>
                        <li><p><strong>Front crash guard right and left set:</strong> Made up of high-grade stainless steels which are anti-rust also, these are very useful in getting protection against any front damage to the scooter. So you can get such Suzuki access accessories online in our online store.</p></li>
                        <li><p><strong>Front mudguard bumper:</strong> Again this guard is made up of stainless steels that are anti-rust and it helps in protecting the body from any front scratches if you bump your scooter anywhere. At the same time, this looks very royal because it is finished with a mirror glass look.</p></li>
                        <li><p><strong>Spare parts of access-125:</strong> If you want to have spare parts that can help you save from any emergency condition when any of the parts of scooter fails. Then you can get Suzuki access 125 spare parts online in our online store very easily at a very minimum price as compared to any other sites.</p></li>
                    </ul>
                    <h4>Why should you contact us?</h4>
                    <p>Paragon Accessories Pvt. Ltd. is a trustworthy company that has lived up to its millions of customers. It's a multi-leveled company that has taken care of accessories as well as several other spare parts of different brands under one floor.</p>
                    <p>You can get Suzuki access 125 accessories online in very reasonable pricing with some amount of discount if you are a trustworthy and loyal customer to us.</p>
                     <p>&nbsp;</p>
          			<h4>Why you need our products:</h4>
                    <p>Knowing very well the conditions in which we drive our bikes or scooter, Paragon Accessories Pvt. Ltd. decided to come up with different accessories and spare parts which can turn up as saviors fro Indians. It is very important here to have an extra plan anytime, anywhere.</p>          
                    <p>So we come up with 500-700 sets of each product daily that can satisfy the need of customers. So to get information about our more products in detail you can check our official website which can help you get all the information related to the company as well as the products which we manufacture.</p><?php */?>
					
                </div>
            </div>
        </div>
       
        <div class="other-iteam">
          <div class="row">
            <div class="col-md-12">
              <div class="heading-section">
                <h2>Other <span>Models</span></h2>
              </div>
            </div>
          </div>
          <div class="row">
            <?php 
            $qry_relate = "SELECT * FROM models WHERE brand_id = ".$brand_id." AND status = 'Y' ORDER BY id ASC LIMIT 4";
            $res_relate = mysqli_query($db,$qry_relate);
            while($row_relate = mysqli_fetch_array($res_relate)){
           ?>
            <div class="col-md-3 col-sm-6">
              <div class="portfolio-wrapper">
                <div class="portfolio-thumb">
                 	<img src="<?php echo $SITE_URL ?>images/product_images/<?php echo $row_relate['model_display_picture']; ?>" />
                 	<?php /*?><img src="<?php echo $SITE_URL ?>images/product_images/<?php echo $row_relate['model_display_picture']; ?>" /><?php */?>
                  <div class="hover">
                    <div class="hover-iner">
                    	<a class="fancybox" href="<?php echo $SITE_URL ?>model/<?php echo $row_relate['slug']?>">
                    		<img src="images/link-icon.png" alt="" />
                    	</a>
                    </div>
                  </div>
                </div>
                <div class="label-text">
                  <h3><a href="javascript:;"><?php echo $row_relate['model_name'] ?></a></h3>
                   </div>
              </div>
            </div>
            <?php } ?>
           
          </div>
        </div>
        

      </div>
    </div>
  </div>
</div>

<?php include_once('sticky-cart.php'); ?>

<?php include('footer.php'); ?>
<script src="<?php echo $SITE_URL ?>js/loader1.js"></script>
<!-- Resource jQuery -->
<!--<script src="js/vendor/jquery-1.11.0.min.js"></script>-->
<!--<script src="js/bootstrap.js"></script>-->
<!-- <script src="js/lightslider.min.js"></script> -->

 
<script src="<?php echo $SITE_URL ?>js/jis.jquery.min.js"></script>
<script src="<?php echo $SITE_URL ?>js/vendor/jquery.gmap3.min.js"></script>
<script src="<?php echo $SITE_URL ?>js/jquery.flexslider.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
  $('.flexslider').flexslider({
    animation: "fade",
     slideshow: false,
    controlNav: "thumbnails",
    directionNav: false,
   before : function(slider) {
        $('.img_box').imagezoomsl({ 
              zoomrange: [1, 10],
              magnifiereffectanimate: "fadeIn",
              magnifiersize: [500, 400],
            });
          }
  });
});

</script>
 <script src="<?php echo $SITE_URL ?>js/zoomsl-3.0.min.js"></script>
 <script>
jQuery(function(){
  $('.img_box').imagezoomsl({ 
    zoomrange: [1, 10],
    magnifiereffectanimate: "fadeIn",
    magnifiersize: [500, 400],
  });  
});
</script>
<script src="<?php echo $SITE_URL ?>js/menu_slide.js"></script>
<script src="<?php echo $SITE_URL ?>js/model-slider.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	  $(".add_to_cart").on('click',function(){
		  $.ajax({
			  url: "<?php echo $SITE_URL ?>data/",
			  type : "POST",
			  data: {
				  flag: "add_to_cart",
				  pro_id : $(this).data('id'),
				  pro_price: $(this).data('price'),
			  },
			  success:function(data){
				  var data = data.split(',');
				  if(data[0]=='success')
				  {
					//window.location.href = "?add=Y";
					  location.reload();
				  }
			  }
		  });
	  });
});
</script>

</body>
</html>
