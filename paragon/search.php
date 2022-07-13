<?php

include('connect.php');

$pgname = 'search';

if (!isset($_GET['s']) && $_GET['s'] == '') {

	header("location:" . $SITE_URL);
}

$term =  $_GET['s'];

//$qry_srch ="SELECT * FROM access WHERE a_name LIKE '%".$term ."%' ORDER BY id ";

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

    <style type="text/css">
    .portfolio-item {
        min-height: 400px;
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

                        <h2>Search Results</h2>

                    </div>

                </div>



            </div>

        </div>

    </div>

    <div id="products-post">

        <div class="container">

            <div class="col-md-12 col-sm-12 col-xs-12 brand_main">

                <div class="row" id="Container">

                    <?php

					$NoProduct = 1;
					$qry_srch = "SELECT access.*, access_model.model_id FROM access_model 
										LEFT JOIN access ON access.id = access_model.access_id 
										WHERE access.status = 'Y' AND (a_name LIKE '%" . $term . "%' ) ORDER BY `id` DESC ";

					$res_srch = mysqli_query($db, $qry_srch);

					$toral_search = mysqli_num_rows($res_srch);

					if ($toral_search > 0) {

						$NoProduct = 0;
						while ($row_srch = mysqli_fetch_assoc($res_srch)) {

							$model_id = $row_srch['model_id'];
							$res_model_details = mysqli_query($db, "SELECT * FROM models WHERE id = '" . $model_id . "' ORDER BY id ASC");
							$row_model_details = mysqli_fetch_array($res_model_details);

							$model_type = $row_model_details['model_type'];
							$model_name = $row_model_details['model_name'];

							?>

                    <div class="col-md-3 col-sm-6 mix portfolio-item">
                        <div class="portfolio-wrapper">
                            <div class="portfolio-thumb">
								<a href="<?php echo $SITE_URL; ?>product/<?php echo $row_srch['slug']; ?>">
								<?php if($row_srch['a_discount']){ ?>
										<div class="badge_discount" ><span><?php echo $row_srch['a_discount']; ?>% <small>Off</small></span></div>
									<?php } ?>

                                    <?php if ($row_srch['a_picture'] != '') { ?>
                                    <img src="<?php echo $SITE_URL ?>images/product_images/<?php echo $row_srch['a_picture']; ?>"
                                        alt="<?php echo $row_srch['a_name']; ?>" class="model_img" />
                                    <?php } ?>
                                </a>
                            </div>
                            <h3><?php echo $row_srch['a_name']; ?></h3>
							<p><?php if($row_srch['a_original'] > 0){ ?><span class="origianl_price">Rs. <?php echo $row_srch['a_original']; ?></span><?php } ?>
                                    <span class="price">Rs. <?php echo $row_srch['a_price']; ?></span>
                                </p>
                            <p><a href="javascript:;" data-id="<?php echo $row_srch['id']; ?>"
                                    data-price="<?php echo $row_srch['a_price']; ?>"
                                    class="add-to-cart-btn add_to_cart">Add to Cart</a></p>
                        </div>
                    </div>

                    <?php } ?>

                    <?php }

					/*
							$qry_srch = "SELECT models.* FROM models WHERE models.status = 'Y' AND (model_name LIKE '%".$term ."%' OR model_description LIKE '%".$term ."%') ORDER BY `id` DESC ";

							$res_srch = mysqli_query($db,$qry_srch);

							$toral_search = mysqli_num_rows($res_srch);

                            if($toral_search>0)
                            {

								$NoProduct = 0;
                                while($row_srch = mysqli_fetch_assoc($res_srch)){

                            	$model_id = $row_srch['id'];
								$model_name = $row_srch['model_name'];
								$model_slug = $row_srch['slug'];
								$model_pic = $row_srch['model_display_picture'];
                            	?>

                    <div class="col-md-3 col-sm-6 mix portfolio-item ">
                        <div class="portfolio-wrapper">
                            <div class="portfolio-thumb">
                                <a href="<?php echo $SITE_URL ?>model/<?php echo $model_slug; ?>/">
                                    <?php if($model_pic!=''){ ?>
                                    <img src="<?php echo $SITE_URL ?>images/product_images/<?php echo $model_pic; ?>"
                                        alt="<?php echo $model_name; ?>" class="model_img" />
                                    <?php } ?>
                                </a>
                            </div>
                            <h3><?php echo $model_name; ?></h3>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                        </div>
                    </div>

                    <?php } ?>

                    <?php } 
						
						
						$qry_srch = "SELECT brands.* FROM brands WHERE brands.status = 'Y' AND LOWER(brand_name) LIKE '%".strtolower($term)."%' ORDER BY `id` DESC ";

							$res_srch = mysqli_query($db,$qry_srch);

							$toral_search = mysqli_num_rows($res_srch);

                            if($toral_search>0)
                            {

								$NoProduct = 0;
                                while($row_srch = mysqli_fetch_assoc($res_srch)){

                            	$model_id = $row_srch['id'];
								$model_name = $row_srch['brand_name'];
								$model_slug = $row_srch['slug'];
								$model_pic = $row_srch['brand_image'];
                            	?>

                    <div class="col-md-3 col-sm-6 mix portfolio-item ">
                        <div class="portfolio-wrapper">
                            <div class="portfolio-thumb">
                                <a href="<?php echo $SITE_URL ?>brand/<?php echo $model_slug; ?>/">
                                    <?php if($model_pic!=''){ ?>
                                    <img src="<?php echo $SITE_URL ?>images/product_images/<?php echo $model_pic; ?>"
                                        alt="<?php echo $model_name; ?>" class="model_img" />
                                    <?php } ?>
                                </a>
                            </div>
                            <h3><?php echo $model_name; ?></h3>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                        </div>
                    </div>

                    <?php } ?>

                    <?php } */


					if ($NoProduct) {
						echo '
								<h3>No search product</h3>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
								<p>&nbsp;</p>
							';
					}

					?>



                </div>

            </div>

        </div>

    </div>

    <?php include_once('sticky-cart.php'); ?>

    <?php include('footer.php') ?>



    <!--<script src="js/vendor/jquery-1.11.0.min.js"></script>-->

    <script src="js/bootstrap.js"></script>

    <script src="js/vendor/jquery.gmap3.min.js"></script>

    <script src="js/plugins.js"></script>

    <script src="js/main.js"></script>

    <script src="js/menu_slide.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $(".add_to_cart").on('click', function() {
            $.ajax({
                url: "<?php echo $SITE_URL ?>data/",
                type: "POST",
                data: {
                    flag: "add_to_cart",
                    pro_id: $(this).data('id'),
                    pro_price: $(this).data('price'),
                },
                success: function(data) {
                    var data = data.split(',');
                    if (data[0] == 'success') {
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