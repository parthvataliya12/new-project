<?php 
include('connect.php');
if(!isset($_GET)&&$_GET['pid']==''){
    header('location:'.$SITE_URL);
}
exit;
$pgname = 'brands_details';
$res_model_details = mysqli_query($db,"SELECT * FROM models WHERE slug = '".$_GET['pid']."' ORDER BY id ASC");
$row_model_details = mysqli_fetch_array($res_model_details);
$brand_id = $row_model_details['brand_id'];
$model_type = $row_model_details['model_type'];
$model_status = $row_model_details['status'];
$brand_name =  Get_one_value('brands','brand_name',$row_model_details['brand_id'],'id',$db); 
$model_name = $row_model_details ['model_name'];
$model_description =  $row_model_details ['model_description'];
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
        
			<div class="col-md-8" >
         
				  <div class="col-md-6">
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
				  </div>
          
        	</div>
          	
			<div class="col-md-4" >

				<?php include_once('cart-sidebar.php'); ?>

			</div>
          
        </div>
        <?php }else{ ?>
        <div class="row">
        	<div class="col-md-12 text-center">
        		<h3>This model will be here soon.</h3>
        	</div>
        </div>
        <?php } ?>
       
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
                <div class="portfolio-thumb"> <img src="<?php echo $SITE_URL ?>images/product_images/<?php echo $row_relate['model_display_picture'] ?>" alt="" />
                  <div class="hover">
                    <div class="hover-iner"> <a class="fancybox" href="<?php echo $SITE_URL ?>brands/<?php echo $row_relate['slug']?>"><img src="images/link-icon.png" alt="" /></a> </div>
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
</body>
</html>
