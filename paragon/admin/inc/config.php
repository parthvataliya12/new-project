<?php

/**

 * config.php

 *

 * Author: websdeveloperindia.com

 *

 * Global configuration file

 *

 */



// Include Template class

require 'classes/Template.php';



// Create a new Template Object

$one                               = new Template('Paragon Accessories', '', 'assets'); // Name, version and assets folder's name



// Global Meta Data

$one->author                       = 'Paragon Accessories';

$one->robots                       = 'noindex, nofollow';

$one->title                        = 'Paragon Accessories - Admin Dashboard';

$one->description                  = 'Paragon Accessories - Admin Dashboard';



// Global Included Files (eg useful for adding different sidebars or headers per page)

$one->inc_side_overlay             = 'base_side_overlay.php';

$one->inc_sidebar                  = 'base_sidebar.php';

$one->inc_header                   = 'base_header.php';



// Global Color Theme

$one->theme                        = 'city';       // '' for default theme or 'amethyst', 'city', 'flat', 'modern', 'smooth'



// Global Body Background Image

$one->body_bg                      = 'assets/img/photos/photo15@2x.jpg';       // eg 'assets/img/photos/photo10@2x.jpg' Useful for login/lockscreen pages



// Global Header Options

$one->l_header_fixed               = true;     // True: Fixed Header, False: Static Header



// Global Sidebar Options

$one->l_sidebar_position           = 'left';   // 'left': Left Sidebar and right Side Overlay, 'right;: Flipped position

$one->l_sidebar_mini               = false;    // True: Mini Sidebar Mode (> 991px), False: Disable mini mode

$one->l_sidebar_visible_desktop    = true;     // True: Visible Sidebar (> 991px), False: Hidden Sidebar (> 991px)

$one->l_sidebar_visible_mobile     = false;    // True: Visible Sidebar (< 992px), False: Hidden Sidebar (< 992px)



// Global Side Overlay Options

$one->l_side_overlay_hoverable     = false;    // True: Side Overlay hover mode (> 991px), False: Disable hover mode

$one->l_side_overlay_visible       = false;    // True: Visible Side Overlay, False: Hidden Side Overlay



// Global Sidebar and Side Overlay Custom Scrolling

$one->l_side_scroll                = true;     // True: Enable custom scrolling (> 991px), False: Disable it (native scrolling)



// Global Active Page (it will get compared with the url of each menu link to make the link active and set up main menu accordingly)

$one->main_nav_active              = basename($_SERVER['PHP_SELF']);



// Global Main Menu

$one->main_nav                     = array(

	 array(

        'name'  => '<span class="sidebar-mini-hide">Activity</span>',//Activity        

        'type'  => 'heading'

		),



    array(

        'name'  => '<span class="sidebar-mini-hide">Dashboard</span>',//Dashboard

        'icon'  => 'si si-speedometer',

        'url'   => 'index.php'

    ),

	

	array(

        'name'  => '<span class="sidebar-mini-hide">Brands</span>',//Profile

        'icon'  => 'si si-badge',

      	 'sub'   => array(

			array(

				'name'	=>	'Manage Brands',

				'icon'  => 'si si-list',

				'url'	=>	'manage_brands.php'	

			),

			array(

				'name'	=>	'Add Brand',

				'icon'  => 'si si-plus',

				'url'	=>	'add_brand.php'	

			)

		)	

    ),

    array(

        'name'  => '<span class="sidebar-mini-hide">Models</span>',//Profile

        'icon'  => 'si si-layers',

      	 'sub'   => array(

			array(

				'name'	=>	'Manage Models',

				'icon'  => 'si si-list',

				'url'	=>	'manage_models.php'	

			),

			array(

				'name'	=>	'Add Model',

				'icon'  => 'si si-plus',

				'url'	=>	'add_model.php'	

			)

		)	

    ),

	array(

        'name'  => '<span class="sidebar-mini-hide">Accessories</span>',//Profile

        'icon'  => 'si si-wrench',

      	 'sub'   => array(

			array(

				'name'	=>	'Manage Accessories',

				'icon'  => 'si si-list',

				'url'	=>	'manage_access.php'	

			),

			array(

				'name'	=>	'Add Accessories',

				'icon'  => 'si si-plus',

				'url'	=>	'add_access.php'	

			)

		)	

    ),

    array(

        'name'  => '<span class="sidebar-mini-hide">GST</span>',//Profile

        'icon'  => 'si si-action-redo',

      	 'url'	=> 'update_tax.php'

    ),

    array(

        'name'  => '<span class="sidebar-mini-hide">Users</span>',//Profile

        'icon'  => 'si si-users',

      	 'sub'   => array(

			array(

				'name'	=>	'Manage Users',

				'icon'  => 'si si-list',

				'url'	=>	'manage_users.php'	

			),

			array(

				'name'	=>	'Add User',

				'icon'  => 'si si-plus',

				'url'	=>	'add_user.php'	

			)

		)	

    ),

    array(

        'name'  => '<span class="sidebar-mini-hide">Orders</span>',//Profile

        'icon'  => 'si si-briefcase',

      	'url'	=>	'manage_orders.php'	

    ),
	
	array(

        'name'  => '<span class="sidebar-mini-hide">Subscribers</span>',//Profile

        'icon'  => 'si si-users',

      	'url'	=>	'manage_subscribers.php'	

    ),

);



