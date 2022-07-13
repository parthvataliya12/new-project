<?php include '../connect.php'; ?>

<?php

$pg_name = 'dashboard';

if(!isset($_SESSION['user'])&&$_SESSION['user']['type']=='AdmiN')

{

	header('Location:'.$SITE_URL);

}





?>

<?php require 'inc/config.php'; ?>

<?php require 'inc/views/template_head_start.php'; ?>

<!-- Page JS Plugins CSS -->

<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/slick/slick.min.css">

<link rel="stylesheet" href="<?php echo $one->assets_folder; ?>/js/plugins/slick/slick-theme.min.css">

<?php require 'inc/views/template_head_end.php'; ?>

<?php require 'inc/views/base_head.php'; ?>

<!-- Page Header -->

<div class="content bg-image overflow-hidden" style="background-image: url('<?php echo $one->assets_folder; ?>/img/photos/photo3@2x.jpg');">

  <div class="push-50-t push-15">

    <h1 class="h2 text-white animated zoomIn">Hello, Admin!</h1>

    <!--<h2 class="h5 text-white-op animated zoomIn">Welcome Administrator</h2>-->

	

  </div>

</div>

<!-- END Page Header -->



<!-- Stats -->



<!-- END Page Content -->

  <div class="content">

    <div class="row">

      <div class="col-sm-6 col-lg-4">

            <div class="block block-themed block-rounded">

                <div class="block-header bg-modern-dark">

                    <ul class="block-options">

                       <li>

                            <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>

                        </li>

                    </ul>

                    <h3 class="block-title">Brands</h3>

                </div>

                <div class="block-content">

                   <div class="row">

                    <div class="col-md-12">

                     <a href="manage_brands.php"> <div class="block-content block-content-full block-content-mini bg-primary text-white push-15 ">

                            <i class="fa fa-list text-black-op text-left"></i> 

                            <span class="text-center push-30-l">Manage Brands</span>

                        </div></a>

                        

                      </div>

                     <div class="col-md-12">

                     <a href="add_brand.php"> <div class="block-content block-content-full block-content-mini bg-primary text-white push-15 ">

                            <i class="fa fa-plus text-black-op text-left"></i> 

                            <span class="text-center push-30-l">Add Brand</span>

                        </div></a>

                        

                      </div>

                   </div> 

                </div>

            </div>

        </div>

        <div class="col-sm-6 col-lg-4">

            <div class="block block-themed block-rounded">

                <div class="block-header bg-modern-dark">

                    <ul class="block-options">

                       <li>

                            <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>

                        </li>

                    </ul>

                    <h3 class="block-title">Models</h3>

                </div>

                <div class="block-content">

                   <div class="row">

                    <div class="col-md-12">

                     <a href="manage_models.php"> <div class="block-content block-content-full block-content-mini bg-primary text-white push-15 ">

                            <i class="fa fa-list text-black-op text-left"></i> 

                            <span class="text-center push-30-l">Manage Models</span>

                        </div></a>

                        

                      </div>

                     <div class="col-md-12">

                     <a href="add_model.php"> <div class="block-content block-content-full block-content-mini bg-primary text-white push-15 ">

                            <i class="fa fa-plus text-black-op text-left"></i> 

                            <span class="text-center push-30-l">Add Model</span>

                        </div></a>

                        

                      </div>

                   </div> 

                </div>

            </div>

        </div>

       <div class="col-sm-6 col-lg-4">

            <div class="block block-themed block-rounded">

                <div class="block-header bg-modern-dark">

                    <ul class="block-options">

                       <li>

                            <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>

                        </li>

                    </ul>

                    <h3 class="block-title">Accessories</h3>

                </div>

                <div class="block-content">

                   <div class="row">

                    <div class="col-md-12">

                     <a href="manage_access.php"> <div class="block-content block-content-full block-content-mini bg-primary text-white push-15 ">

                            <i class="fa fa-list text-black-op text-left"></i> 

                            <span class="text-center push-30-l">Manage Accessories</span>

                        </div></a>

                        

                      </div>

                     <div class="col-md-12">

                     <a href="add_access.php"> <div class="block-content block-content-full block-content-mini bg-primary text-white push-15 ">

                            <i class="fa fa-plus text-black-op text-left"></i> 

                            <span class="text-center push-30-l">Add Accessories</span>

                        </div></a>

                        

                      </div>

                   </div> 

                </div>

            </div>

        </div>

         <div class="col-sm-6 col-lg-4">

            <div class="block block-themed block-rounded">

                <div class="block-header bg-modern-dark">

                    <ul class="block-options">

                       <li>

                            <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>

                        </li>

                    </ul>

                    <h3 class="block-title">Orders</h3>

                </div>

                <div class="block-content">

                   <div class="row">

                    <div class="col-md-12">

                     <a href="update_tax.php"> <div class="block-content block-content-full block-content-mini bg-primary text-white push-15 ">

                            <i class="fa fa-list text-black-op text-left"></i> 

                            <span class="text-center push-30-l">GST</span>

                        </div></a>

                        

                      </div>

                     <div class="col-md-12">

                     <a href="manage_orders.php"> <div class="block-content block-content-full block-content-mini bg-primary text-white push-15 ">

                            <i class="fa fa-list text-black-op text-left"></i> 

                            <span class="text-center push-30-l">Orders</span>

                        </div></a>

                        

                      </div>

                   </div> 

                </div>

            </div>

        </div>

         <div class="col-sm-6 col-lg-4">

            <div class="block block-themed block-rounded">

                <div class="block-header bg-modern-dark">

                    <ul class="block-options">

                       <li>

                            <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>

                        </li>

                    </ul>

                    <h3 class="block-title">Users</h3>

                </div>

                <div class="block-content">

                   <div class="row">

                    <div class="col-md-12">

                     <a href="manage_users.php"> <div class="block-content block-content-full block-content-mini bg-primary text-white push-15 ">

                            <i class="fa fa-list text-black-op text-left"></i> 

                            <span class="text-center push-30-l">Manage Users</span>

                        </div></a>

                        

                      </div>

                     <div class="col-md-12">

                     <a href="add_user.php"> <div class="block-content block-content-full block-content-mini bg-primary text-white push-15 ">

                            <i class="fa fa-plus text-black-op text-left"></i> 

                            <span class="text-center push-30-l">Add Users</span>

                        </div></a>

                        

                      </div>

                   </div> 

                </div>

            </div>

        </div>

    </div>

  </div>

    </main>

<!-- END Stats -->

<!-- Page Content -->



<!-- END Page Content -->

<?php require 'inc/views/base_footer.php'; ?>

<?php require 'inc/views/template_footer_start.php'; ?>

<!-- Page Plugins -->

<script src="<?php echo $one->assets_folder; ?>/js/plugins/slick/slick.min.js"></script>

<script src="<?php echo $one->assets_folder; ?>/js/plugins/chartjs/Chart.min.js"></script>

<!-- Page JS Code -->

<script src="<?php echo $one->assets_folder; ?>/js/pages/base_pages_dashboard.js"></script>

<script>

    $(function(){

        // Init page helpers (Slick Slider plugin)

        App.initHelpers('slick');

    });

</script>

<?php require 'inc/views/template_footer_end.php'; ?>

