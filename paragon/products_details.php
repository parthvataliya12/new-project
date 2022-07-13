<?php  
include('connect.php');
if(!isset($_GET)&&$_GET['pid']==''){
    header('location:'.$SITE_URL);
}
if(isset($_SESSION['post_back_url']))
{
    unset($_SESSION['post_back_url']);
}


$pgname = 'brands_details';
$res_model_details = mysqli_query($db,"SELECT * FROM access WHERE slug = '".$_GET['pid']."' ORDER BY id ASC");
$row_model_details = mysqli_fetch_array($res_model_details);
$brand_id = $row_model_details['brand_id'];
$a_type = $row_model_details['a_type'];
$brand_name =  Get_one_value('brands','brand_name',$row_model_details['brand_id'],'id',$db); 
$model_name = $row_model_details ['a_name'];
$model_price = $row_model_details ['a_price'];
$model_original_price = $row_model_details ['a_original'];
$model_discount = $row_model_details ['a_discount'];
$model_description =  $row_model_details ['a_description'];
$model_display_picture = $row_model_details ['a_picture'];
$model_id = $row_model_details ['id'];
$access_id = $model_id;
$_SESSION['post_back_url'] = 'product/'.$row_model_details['slug'];

$meta_title = "Product | ".$row_model_details ['meta_title'];
$meta_keywords = $row_model_details ['meta_keywords'];
$meta_desc = $row_model_details ['meta_description'];

$res_brand_list2= mysqli_query($db,"SELECT * FROM brands WHERE `id` = '".$brand_id."' ORDER BY id ASC");
$row_brand_list2 = mysqli_fetch_assoc($res_brand_list2);

$res_brand_list22 = mysqli_query($db,"SELECT * FROM access_model WHERE `access_id` = '".$access_id."' ORDER BY id ASC");
$row_brand_list22 = mysqli_fetch_assoc($res_brand_list22);
$scooter_id = $row_brand_list22['model_id'];

$res_brand_list222 = mysqli_query($db,"SELECT * FROM models WHERE `id` = '".$scooter_id."' ORDER BY id ASC");
$row_brand_list222 = mysqli_fetch_assoc($res_brand_list222);
$scooter_name = $row_brand_list222['model_name'];
$scooter_slug = $row_brand_list222['slug'];
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
<?php include('nav.php'); ?>
<div id="heading">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="heading-content">
          <h2>Product Detail</h2>
          <span><a href="<?php echo $SITE_URL ?>">Home</a> / <a href="<?php echo $SITE_URL ?>brands/">Brands</a> / <a href="<?php echo $SITE_URL ?>brands/<?php echo $row_brand_list2['slug']; ?>"><?php echo $brand_name; ?></a> / <a href="<?php echo $SITE_URL ?>model/<?php echo $scooter_slug; ?>"><?php echo $scooter_name; ?></a> / <?php echo $model_name; ?></span> </div>
      </div>
    </div>
  </div>
</div>

<div id="product-post">
  <div class="container">
    <div class="row">
      <div id="show_alert"> </div>
      <div class="product-item col-md-12">
        <?php if(isset($_GET['add']) && $_GET['add']=='Y') {?>
        <div class="alert alert-success"> <strong>Success!</strong> Product added to your Cart. Visit your <a href="<?php echo $SITE_URL ?>cart/">Cart Here.</a> </div>
        <?php } ?>
        <div class="row">
         	
				  <div class="col-md-6">
					<div class="image">
					  <div class="image-post">              
					   <div class="flexslider"> 
             <?php if($model_discount){ ?>
                <div class="badge_discount_big" ><span><?php echo $model_discount; ?>% <small>Off</small></span></div>
              <?php } ?>
              	<div class="genuine-stamp" ></div>
						   <ul class="slides">
							<?php /*?><li data-thumb="<?php echo $SITE_URL ?>images/product_images/<?php echo $model_display_picture; ?>"><?php */?>
							<li data-thumb="<?php echo $SITE_URL ?>images/product_images/<?php echo $model_display_picture; ?>">
								<?php /*?><img class="img_box" src="<?php echo $SITE_URL ?>images/product_images/<?php echo $model_display_picture; ?>" /><?php */?>
								<img src="<?php echo $SITE_URL ?>images/product_images/<?php echo $model_display_picture; ?>" />
							</li>
							<?php /*?><li data-thumb="<?php echo $SITE_URL ?>watermark.php?image=images/product_images/<?php echo $model_display_picture; ?>&amp;watermark=images/watermark.png"> <img class="img_box" src="<?php echo $SITE_URL ?>watermark.php?image=images/product_images/<?php echo $model_display_picture; ?>&amp;watermark=images/watermark.png" style="max-height: 400px; width: auto; display: inline-block;" /> </li><?php */?>
							<?php 
					   $qry_other = "SELECT * FROM access_images WHERE a_id = ".$model_id;
					  $res_other_picture = mysqli_query($db, $qry_other);
					  while($row_other_imgs = mysqli_fetch_assoc($res_other_picture))
					  {
						   if($row_other_imgs['a_images']!='' && file_exists("images/product_images/other_images/".$row_other_imgs['a_images'])){
					 ?>
							<?php /*?><li data-thumb="<?php echo $SITE_URL ?>images/product_images/other_images/<?php echo $row_other_imgs['a_images'] ?>"><?php */?>
							<li data-thumb="<?php echo $SITE_URL ?>images/product_images/other_images/<?php echo $row_other_imgs['a_images']; ?>">
								<?php /*?><img  class="img_box" src="<?php echo $SITE_URL ?>images/product_images/other_images/<?php echo $row_other_imgs['a_images'] ?>" /><?php */?>
								
								<img src="<?php echo $SITE_URL ?>images/product_images/other_images/<?php echo $row_other_imgs['a_images']; ?>" alt="<?php echo $row_other_imgs['a_name']; ?>" class="img_box"/>

							</li>

							<?php /*?><li data-thumb="<?php echo $SITE_URL ?>watermark.php?image=images/product_images/other_images/<?php echo $row_other_imgs['a_images'] ?>&amp;watermark=images/watermark.png"> <img class="img_box" src="<?php echo $SITE_URL ?>watermark.php?image=images/product_images/other_images/<?php echo $row_other_imgs['a_images'] ?>&amp;watermark=images/watermark.png" /> </li><?php */?>

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
						<h3><?php echo $model_name;?></h3>
					  </div>
					  <p class="mid"><?php echo $model_description; ?></p>
					  <h4 class="hide">Product Price</h4>
					  <ul class="">
						<li>
						  <h2>Rs. <?php echo $model_price;?></h2>
						</li>
					  </ul>
            <?php if($model_original_price > 0){ ?><p><span class="origianl_price">Rs. <?php echo $model_original_price; ?></span></p><?php } ?>
					  <?php /*?><div class="send">
						<button id="buy_now">Buy now</button>
            </div><?php */
            if(!in_array($_SESSION['V_Country'], $HideCountry)){
            ?>
					  <div class="send">
						  <button id="add_to_cart" >Add to Cart</button>
					  </div>
            <?php } ?>
					</div>
				  </div>
          	
        </div>
        <div class="other-iteam">
          <div class="row">
            <div class="col-md-12">
              <div class="heading-section">
                <h2>Other <span>Products</span></h2>
              </div>
            </div>
          </div>
          <div class="row">
          <?php 
            //$qry_relate = "SELECT * FROM access WHERE brand_id = ".$brand_id." AND a_type = ".$a_type." AND status = 'Y' ORDER BY id ASC LIMIT 4";
			$qry_relate = "SELECT access.*, access_model.model_id FROM access_model 
							LEFT JOIN access ON access.id = access_model.access_id 
						WHERE model_id = ".$scooter_id." AND access.status = 'Y' AND access.id != '".$access_id."' ";
            $res_relate = mysqli_query($db,$qry_relate);
            while($row_relate = mysqli_fetch_array($res_relate)){
           ?>
            <div class="col-md-3 col-sm-6">
              <div class="portfolio-wrapper">
                <div class="portfolio-thumb">
                  <!--<img src="<?php echo $SITE_URL ?>images/product_images/<?php echo $row_relate['a_picture'] ?>" alt="" />-->
                  <?php /*?><img src="<?php echo $SITE_URL ?>watermark.php?image=images/product_images/<?php echo $row_relate['a_picture'] ?>&amp;watermark=images/watermark.png" alt="" /><?php */?>

                  <img src="<?php echo $SITE_URL ?>images/product_images/<?php echo $row_relate['a_picture']; ?>" />

                  <div class="hover">
                    <div class="hover-iner"> <a class="fancybox" href="<?php echo $SITE_URL ?>product/<?php echo $row_relate['slug']?>"><img src="images/link-icon.png" alt="" /></a> </div>
                  </div>
                </div>
                <div class="label-text">
                  <h3><?php echo $row_relate['a_name'] ?></h3>
                  <span class="text-category hide">Rs <?php echo $row_relate['a_price'] ?></span> </div>
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
<!--<script src="<?php echo $SITE_URL ?>js/vendor/jquery-1.11.0.min.js"></script>-->
<!--<script src="<?php echo $SITE_URL ?>js/bootstrap.js"></script>-->
<script src="<?php echo $SITE_URL ?>js/jis.jquery.min.js"></script>
<script src="<?php echo $SITE_URL ?>js/vendor/jquery.gmap3.min.js"></script>

    <script type="text/javascript">
       $(document).ready(function(){
              $("#buy_now").on('click',function(){
                  $.ajax({
                      url: "<?php echo $SITE_URL ?>data/",
                      type : "POST",
                      data: {
                          flag: "buy_now",
                          pro_id : '<?php echo $model_id ?>',
                          pro_price: '<?php echo $model_price ?>',
                      },
                      success:function(data){
                          if(data=='success')
                          {
                             window.location.href = "<?php echo $SITE_URL ?>checkout/";
                          }
                      }
                  });
              });
              $("#add_to_cart").on('click',function(){
                  $.ajax({
                      url: "<?php echo $SITE_URL ?>data/",
                      type : "POST",
                      data: {
                          flag: "add_to_cart",
                          pro_id : '<?php echo $model_id ?>',
                          pro_price: '<?php echo $model_price ?>',
                      },
                      success:function(data){
                          var data = data.split(',');
                          if(data[0]=='success')
                          {
                            window.location.href = "?add=Y";
                          }
                      }
                  });
              });
       });
      </script>
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
