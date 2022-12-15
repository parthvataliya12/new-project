
<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
    	<button id ="button" class="navbar-toggle">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a href="<?php echo $SITE_URL ?>"><img src="<?php echo $SITE_URL; ?>images/logo.png" title="Paragon Accessories Pvt. Ltd" alt="Paragon Accessories Pvt. Ltd" ></a>
	</div>
	<div class="top-search">
            <form action="<?php echo $SITE_URL ?>search/" method="get">
                <input name="s" type="text" placeholder="Search for product...">
                <input type="submit" class="btn" value=''>
             </form>   
    </div>	   
	</div>
    
  <div class="navigation-main">
    <div class="container">
       <div class="collapse navbar-collapse js-navbar-collapse target mobile-menu" id="close">
            <a href="#" class="close-menu" onclick="hide('close')"><i class="fa fa-closet"></i></a>
                <ul class="nav navbar-nav">
                    <li class="dropdown mega-dropdown">
                        <a href="<?php echo $SITE_URL."brands/" ?>" class="dropdown-toggle" data-toggle="dropdown">Brands <span class="caret"></span></a><span class="caret"></span>				
                        <div class="dropdown-menu">
                            <ul>
                                <?php 
                                    $qry_brand_nav  = "SELECT * FROM brands WHERE status = 'Y' ORDER BY setord ASC";
                                    $res_brand = mysqli_query($db,$qry_brand_nav);
                                    while($row_brand_nav = mysqli_fetch_array($res_brand)){
    
                                    /*if($row_brand_nav['setord']!=2&&$row_brand_nav['setord']!=5){
                                        echo '<li>';
                                    }*/
                                    
                                 ?>
                                    <li>
                                        <a href="<?php echo $SITE_URL.'brands/'.$row_brand_nav['slug']; ?>/"><?php echo  $row_brand_nav['brand_name']?></a>
    
                                        
                                            <?php 
                                                $qry_mod_nav  = "SELECT * FROM models WHERE brand_id = ".$row_brand_nav['id']." AND status = 'Y' ORDER BY setord ASC";
                                                $res_mod_nav = mysqli_query($db,$qry_mod_nav);
                                                if(mysqli_num_rows($res_mod_nav)){ ?>
                                                <ul>
                                                <?php while($row_mod_nav = mysqli_fetch_array($res_mod_nav)){ ?>
                                            
                                                <li><a href="<?php echo $SITE_URL.'model/'.$row_mod_nav['slug'] ?>/"><i class="fa fa-caret-right"></i> <?php echo $row_mod_nav['model_name'] ?></a>
                                                
                                                    <?php 
                                                        $qry_mod_nav2  = "SELECT access_model.access_id, access.a_name, access.slug FROM access_model LEFT JOIN access ON access.id = access_model.access_id WHERE access_model.model_id = ".$row_mod_nav['id']." AND access.brand_id = ".$row_brand_nav['id']." AND access.status = 'Y' ORDER BY setord ASC";
                                                        $res_mod_nav2 = mysqli_query($db,$qry_mod_nav2);
                                                        if(mysqli_num_rows($res_mod_nav2)){ ?>
                                                        <ul>
                                                        <?php while($row_mod_nav2 = mysqli_fetch_array($res_mod_nav2)){ ?>
    
                                                        <li><a href="<?php echo $SITE_URL.'product/'.$row_mod_nav2['slug'] ?>/"><i class="fa fa-caret-right"></i> <?php echo $row_mod_nav2['a_name'] ?></a></li>
    
                                                    <?php } ?>
                                                        </ul>
                                                    <?php } ?>
                                                
                                                </li>
                                            
                                            <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                <?php 
                                  /*if($row_brand_nav['setord']!=1&&$row_brand_nav['setord']!=4){
                                        echo '</li>';
                                    }*/
                                } ?>
                                </ul>				
                        </div>
                    </li>            
                    <li><a href="<?php echo $SITE_URL ?>about-us/">About us</a></li>
                    <?php /* ?><li class="dropdown mega-dropdown">
                        <a href="<?php echo $SITE_URL ?>products/" class="dropdown-toggle" data-toggle="dropdown">Products <span class="caret"></span></a><span class="caret"></span>				
                        <div class="dropdown-menu mega-dropdown-menu">
                            <div class="container">
                            <ul>
                                <li class="col-sm-3">
                                    <ul>
                                        <li class="dropdown-header">Scooter Accessories</li>                            
                                    </ul>
                                </li>
                                 <li class="col-sm-3">
                                    <ul>    
                                        <?php
                                           $qry_scooter_nav = "SELECT * FROM access WHERE a_type = '1' GROUP BY a_name ORDER BY setord ASC ";
                                            $res_scooter_nav = mysqli_query($db, $qry_scooter_nav);
                                            $i=1;
                                            while($row_scooter_nav = mysqli_fetch_assoc($res_scooter_nav)){
                                                
                                                ?>
                                                <li>
                                                    <a href="<?php echo $SITE_URL."product/".$row_scooter_nav['slug']?>/"><i class="fa fa-angle-right"></i>
                                                     <?php echo  $row_scooter_nav['a_name'];?>
                                                    </a>
                                                </li>
                                             <?php 
                                                    if($i%4==0)
                                                    {
                                                        echo '</ul></li><li class="col-sm-3"><ul>';
                                                    }
                                                    $i++; 
                                                } ?>
                                    </ul>
                                 </li>            
                            </ul>
                            <div class="saprator"></div>
                            <ul>					
                            <li class="col-sm-3">
                                <ul>
                                    <li class="dropdown-header">Bike Accessories</li>
                                </ul>
                            </li>                    
                            <li class="col-sm-3">
                                          <ul>    
                                            <?php
                                               $qry_scooter_nav = "SELECT * FROM access WHERE a_type = '2' GROUP BY a_name ORDER BY setord ASC ";
                                                $res_scooter_nav = mysqli_query($db, $qry_scooter_nav);
                                                $i=1;
                                                while($row_scooter_nav = mysqli_fetch_assoc($res_scooter_nav)){
                                                    
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo $SITE_URL?>product/<?php echo  $row_scooter_nav['slug']?>/"><i class="fa fa-angle-right"></i>
                                                            <?php echo  $row_scooter_nav['a_name'];?>
                                                        </a>
                                                    </li>
                                            <?php 
                                                if($i%6==0)
                                                    {
                                                        echo '</ul></li><li class="col-sm-3"><ul>';
                                                    }$i++; 
                                                } ?>
                                        </ul>
                                   </li>
                               </ul>				
                            </div>
                        </div>				
                    </li><?php */ ?>
                    <li><a href="<?php echo $SITE_URL ?>faq/">FAQ</a></li>
                                    
                     <?php /*if(isset($_SESSION['cart']) && count($_SESSION['cart']['item_id'])>0){ ?>
                     <li><a href="<?php echo $SITE_URL ?>cart/" id = menu_cart><i class="fa fa-shopping-cart"></i> Cart (<?php echo count($_SESSION['cart']['item_id']) ?>)</a></li>
                     <?php }*/ ?>
    
                     <?php  if(isset($_SESSION['paragone_user']) && $_SESSION['paragone_user']['id']!='') {?>
                     <!--<li><a href="<?php echo $SITE_URL ?>profile/">Profile</a></li>
                     <li><a href="<?php echo $SITE_URL ?>logout/">Logout</a></li>-->
    
                   <?php /*?> <?php } else{ ?>
                    <li><a href="<?php echo $SITE_URL ?>register/">Register</a></li>
                    <li><a href="<?php echo $SITE_URL ?>login/">Login</a></li><?php */?>
                    
                    
                    <?php } ?>
                    
                    <li><a href="<?php echo $SITE_URL ?>contact-us/">Contact us</a></li>
                </ul>
                 <div class="nav-cart"><a href="<?php echo $SITE_URL ?>cart/" id = menu_cart><i class="fa fa-shopping-cart"></i> Cart (<?php echo count($_SESSION['cart']['item_id']) ?>)</a></div>
                <ul class="nav navbar-nav account-menu">
                	<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <span class="caret"></span></a><span class="caret"></span>				
                        <div class="dropdown-menu">
                        <ul>
                           <?php if(isset($_SESSION['paragone_user']) && $_SESSION['paragone_user']['id']!='') {?>
                           	<li><a href="<?php echo $SITE_URL ?>profile/">Profile</a></li>
                     		<li><a href="<?php echo $SITE_URL ?>logout/">Logout</a></li>
                           <?php }else{ ?> 
                            <li><a href="<?php echo $SITE_URL ?>register/">Register</a></li>
                            <li><a href="<?php echo $SITE_URL ?>login/">Login</a></li>
                            <?php } ?>
                        </ul>
                        </div>
                    </li>
                </ul>
               
                
           </div>
    </div>
  </div>
<!-- /.nav-collapse -->
 </nav>
