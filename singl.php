<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>
<?php// confirm_session();?>

 <?php
  ######### GET PRODUCT ID FROM THE LINK ########
   if(isset($_GET['product_id'])){
	$product_id = $_GET['product_id'];  					
			}
  ######### GET PRODUCT ID FROM THE LINK ########
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  	<!-- Meta information -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"><!-- Mobile Specific Metas -->
    <meta name="format-detection" content = "telephone=no"><!-- Telephone Metas -->
    
    <!-- Title -->
    <title> Doppio Ritorto </title>
   <!-- favicon icon -->
    <link rel="shortcut icon" href="images/Favicon.ico">
    
    <!-- CSS Stylesheet -->
    <link href="css/font-awesome.min.css" rel="stylesheet"><!-- font awesome --> 
    <link href="css/bootstrap.css" rel="stylesheet"><!-- bootstrap css -->
    <link href="css/owl.carousel.css" rel="stylesheet"><!-- carousel Slider -->
    <link href="css/animate.css" rel="stylesheet"><!-- css3 animation -->
    <link href="css/jquery-ui.css" rel="stylesheet"><!-- Range css -->
    <link href="css/docs.css" rel="stylesheet"><!--  template structure css -->
    <link href="css/css3.css" rel="stylesheet"><!-- css3 animation -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"> <!-- googel font -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<div id="wapper">
        <header class="clearfix">
            <a href="index.html" class="logo"><img src="images/logo.png" alt=""></a>
            <div class="mobile-btn">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
            <div class="user_access">
               <!--  <div id="language_flag"><a href="#" class="active">English</a></div> -->
                <div id="currency"><a href="#">GHC</a></div>
                <div id="user_account"><a href="login.html">Account</a></div>
                <div id="search_box">
                    <a href="#"><i class="fa fa-search"></i></a>
                    <div class="search-form">
                        <div class="box">
                            <input type="text" placeholder="Enter Keywords To Search...">
                            <input type="submit" value="">
                        </div>
                        <div class="icon"><i class="fa fa-close"></i></div>
                    </div>
                </div>
                <div id="cart-icon">
                    <a href="#"><img src="images/cart-icon.png" alt="cart-icon" /></a>
                    <div class="cart-quckView">
                        <div class="inner-box">
                            <div class="cart-item">
                                <div class="img"><img src="images/product-img/cart-img2.jpg" alt=""></div>
                                <div class="product-name">Product title 02</div>
                                <div class="price">₵255.00</div>
                                <div class="close-icon"><a href="#"><i aria-hidden="true" class="fa fa-times-circle"></i></a></div>
                                <div class="edit-icon"><a href="#"><i aria-hidden="true" class="fa fa-pencil"></i></a></div>
                            </div>
                            <div class="cart-item">
                                <div class="img"><img src="images/product-img/cart-img2.jpg" alt=""></div>
                                <div class="product-name">Product title 02</div>
                                <div class="price">₵255.00</div>
                                <div class="close-icon"><a href="#"><i aria-hidden="true" class="fa fa-times-circle"></i></a></div>
                                <div class="edit-icon"><a href="#"><i aria-hidden="true" class="fa fa-pencil"></i></a></div>
                            </div>
                            <div class="total">2 items, Total: ₵510.00</div>
                            <div class="cart-btn">
                                <a href="#" class="btn-yellow">VIEW CART</a>
                                <a href="#" class="btn-yellow pull-right">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navMenu">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#">Men</a></li>
                    <li><a href="#">Accessories</a></li>
                    <li><a href="#">Sales</a></li>
                    <li><a href="#">Brands</a></li>
                    
                    
                    
                    <li class="sub-nav styel2">
                        <a href="#">Help</a>
                        <div class="megamenu">
                            <ul>
                                <li><a href="#">Size Guide</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">FAQ</a></li>
                                
                            </ul>
                        </div>
                    </li>	
                </ul>
            </nav> 
        </header>



      <!--  -->
        <section class="content ">
            <div class="breadcrumbs" style="
    padding-top: 100px;
">
                <div class="container">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#">Men</a></li>
                        <li><a href="#">Accessories</a></li>
                        <li>Blazers</li>
                    </ul>
                </div>
            </div> 
            <div class="products">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
						     <?php 
		
	                          $tb_select_product = "SELECT * FROM product_tb WHERE ID = {$product_id} ORDER by id DESC  limit 1";
							   $result_product = mysqli_query($connect,$tb_select_product);
							   if(!$result_product){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_product = mysqli_fetch_array($result_product)){
						
							    ?>
						
                        <div class="product-slider">
						
                                <div id="sync1" class="owl-carousel owl-theme" style="opacity: 1; display: block;">
                                    <div class="owl-wrapper-outer">
									<div class="owl-wrapper" style="width: 6840px; left: 0px; display: block; transition: all 1000ms ease; transform: translate3d(-1140px, 0px, 0px);">
									
								<?php
	                           $tb_select_image = "SELECT * FROM product_image_tb WHERE product_id = {$product_id} ORDER by id DESC ";
							   $result_image = mysqli_query($connect,$tb_select_image);
							   if(!$result_image){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_image = mysqli_fetch_array($result_image)){
						
							    ?>
									
									<div class="owl-item" style="width: 570px;">
									<div class="item"><img src="<?php echo $row_image['image'];?>" alt="<?php echo $row_image['image'];?>"></div>
									</div>
									
								<?php } ?>
								
									
									
										</div>
									</div>
                                </div>
								
                                <div id="sync2" class="owl-carousel owl-theme" style="opacity: 1; display: block;">
                                    <div class="owl-wrapper-outer">
									<div class="owl-wrapper" style="width: 2280px; left: 0px; display: block;">
									
									
									 <?php
	                           $tb_select_image = "SELECT * FROM product_image_tb WHERE product_id = {$product_id} ORDER by id DESC ";
							   $result_image = mysqli_query($connect,$tb_select_image);
							   if(!$result_image){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_image = mysqli_fetch_array($result_image)){
						
							    ?>
									
									<div class="owl-item" style="width: 190px;">
									<div class="item"><img src="<?php echo $row_image['image'];?>" alt="<?php echo $row_image['image'];?>"></div>
									</div>
									<?php } ?>
									
									
									</div>
									</div>
									<div style="clear:both;"></div>
                                <div class="owl-controls clickable"><div class="owl-buttons"><div class="owl-prev"><i class="fa fa-arrow-left"></i></div><div class="owl-next"><i class="fa fa-arrow-right"></i></div></div></div></div>
                        </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="productDetail">
							<!--######### PHP CODE TO GET PRODUCT INFORMATION #######-->
					           
                                <h1><?php echo $row_product['product_name']; ?></h1>
                                <img src="images/yellow-stars.png" alt="yellow-stars">
                                <div class="product-price">
								           
										   <?php if($row_product['sale_price'] != 0){?>
								          <span class="new-price">₵<?php echo $row_product['sale_price']; ?></span>
										  <div style="clear:both"></div>
										  <br/>
								         <span class="old-price">₵<?php echo $row_product['regular_price']; ?></span>
									     <?php }else{?>
										   <br/>
								         <span class="new-price">₵<?php echo $row_product['regular_price']; ?></span>
                                        <?php }?>
							
                                </div>
                                <p><?php echo $row_sale['description']; ?> </p>
                                <div class="availability">Availability : <span class="in-stock">In stock</span></div>
                                <div class="qty">
                                    <label>Qty :</label>
                                    <div class="jsSelect-box">
                                        <select class="styled hasCustomSelect" style="-webkit-appearance: menulist-button; width: 70px; position: absolute; opacity: 0; height: 33px; font-size: 12px;">
                                            <option>1</option>
                                            <option>2</option>
                                        </select><div class="customSelect styled customSelectChanged" style="display: inline-block;"><div class="customSelectInner" style="width: 58px; display: inline-block;">1</div></div>
                                    </div>
                                    <a href="#" class="btn-yellow">Add to cart</a>
                                </div>
                                
                               
                            </div>
                        </div>
                    </div>
                    <div class="product-desc">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#pro-desc" aria-controls="pro-desc" role="tab" data-toggle="tab" aria-expanded="true">Product Description</a></li>
                            <li role="presentation" class=""></li>
                            
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="pro-desc">
                                <p><?php echo $row_product['description']; ?></p>
                            </div>
                           
                        </div>
    
                    </div>
					
					 <!--######### PHP CODE TO GET PRODUCT INFORMATION #######-->
					 
					 <?php }?>
					
					
					
					
                </div>
            </div> 
			
			<!--
			
            <div class="featured-products products-slider "> 
                <div class="container">
                    <h1>Featured Products</h1>
                    <h2>Find your style from us</h2>
                    <div class="owl-carousel owl-theme owl-loaded" id="featured-products-slider">
                  
                    <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1200px, 0px, 0px); transition: 0s; width: 3600px;">
					 
					 <div class="owl-item cloned" style="width: 270px; margin-right: 30px;">
					  <div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                    </div>
                                    <img src="images/product-img/featured-product1.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 01</p>
                                    <div class="product-price">
                                        <span class="new-price">$280.00</span>
                                        <span class="old-price">$300.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					
					
					<div class="owl-item cloned" style="width: 270px; margin-right: 30px;">
					  <div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                    </div>
                                    <img src="images/product-img/featured-product1.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 01</p>
                                    <div class="product-price">
                                        <span class="new-price">$280.00</span>
                                        <span class="old-price">$300.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					
					
					<div class="owl-item cloned" style="width: 270px; margin-right: 30px;">
					  <div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                    </div>
                                    <img src="images/product-img/featured-product1.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 01</p>
                                    <div class="product-price">
                                        <span class="new-price">$280.00</span>
                                        <span class="old-price">$300.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="owl-item cloned" style="width: 270px; margin-right: 30px;">
					  <div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                    </div>
                                    <img src="images/product-img/featured-product1.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 01</p>
                                    <div class="product-price">
                                        <span class="new-price">$280.00</span>
                                        <span class="old-price">$300.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					
					
						
						<div class="owl-item cloned" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                        <div class="new-label">new</div>
                                    </div>
                                    <img src="images/product-img/featured-product2.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                    </div>
                                    <img src="images/product-img/featured-product3.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="new-label">new</div>
                                    </div>
                                    <img src="images/product-img/featured-product4.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                    </div>
                                    <img src="images/product-img/featured-product1.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 01</p>
                                    <div class="product-price">
                                        <span class="new-price">$280.00</span>
                                        <span class="old-price">$300.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                        <div class="new-label">new</div>
                                    </div>
                                    <img src="images/product-img/featured-product2.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                    </div>
                                    <img src="images/product-img/featured-product3.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="new-label">new</div>
                                    </div>
                                    <img src="images/product-img/featured-product4.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                    </div>
                                    <img src="images/product-img/featured-product1.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 01</p>
                                    <div class="product-price">
                                        <span class="new-price">$280.00</span>
                                        <span class="old-price">$300.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                        <div class="new-label">new</div>
                                    </div>
                                    <img src="images/product-img/featured-product2.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                    </div>
                                    <img src="images/product-img/featured-product3.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="new-label">new</div>
                                    </div>
                                    <img src="images/product-img/featured-product4.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
						 </div>
						  </div>
						   </div>
						   
						    <div class="owl-controls"><div class="owl-nav"><div class="owl-prev" style=""><img src="images/prev-slide.png" alt="prev-arrow"></div><div class="owl-next" style=""><img src="images/next-slide.png" alt="next-arrow"></div></div><div class="owl-dots" style=""><div class="owl-dot active"><span></span></div></div></div>
							
							</div> 
                </div>
            </div> 
			
			-->
			
			
			
			
			
			
            <div class="bestseller products-slider"> 
                <div class="container">
                    <h1>Bestseller</h1>
                    <h2>Find your style from us</h2>
                    <div class="owl-carousel owl-theme owl-loaded" id="bestseller-slider">
                          
                        
                        
                        
                    <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1200px, 0px, 0px); transition: 0s; width: 3600px;"><div class="owl-item cloned" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                    </div>
                                    <img src="images/product-img/featured-product5.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 01</p>
                                    <div class="product-price">
                                        <span class="new-price">$280.00</span>
                                        <span class="old-price">$300.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                        <div class="new-label">new</div>
                                    </div>
                                    <img src="images/product-img/featured-product6.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                    </div>
                                    <img src="images/product-img/featured-product7.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="new-label">new</div>
                                    </div>
                                    <img src="images/product-img/featured-product4.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                    </div>
                                    <img src="images/product-img/featured-product5.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 01</p>
                                    <div class="product-price">
                                        <span class="new-price">$280.00</span>
                                        <span class="old-price">$300.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                        <div class="new-label">new</div>
                                    </div>
                                    <img src="images/product-img/featured-product6.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                    </div>
                                    <img src="images/product-img/featured-product7.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item active" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="new-label">new</div>
                                    </div>
                                    <img src="images/product-img/featured-product4.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                    </div>
                                    <img src="images/product-img/featured-product5.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 01</p>
                                    <div class="product-price">
                                        <span class="new-price">$280.00</span>
                                        <span class="old-price">$300.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                        <div class="new-label">new</div>
                                    </div>
                                    <img src="images/product-img/featured-product6.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="sale-label">sale</div>
                                    </div>
                                    <img src="images/product-img/featured-product7.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div><div class="owl-item cloned" style="width: 270px; margin-right: 30px;"><div class="item">
                            <div class="productBox visible">
                                <div class="product-img">
                                    <div class="product-labels">
                                        <div class="new-label">new</div>
                                    </div>
                                    <img src="images/product-img/featured-product4.png" alt="banner">
                                    <div class="actions">
                                        <ul class="add-to-links">
                                            <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name">Product title 02</p>
                                    <div class="product-price">
                                        <span class="new-price">$255.00</span>
                                        <span class="old-price">$255.00</span>
                                    </div>
                                </div>
                            </div>
                        </div></div></div></div><div class="owl-controls"><div class="owl-nav"><div class="owl-prev" style=""><img src="images/prev-slide.png" alt="prev-arrow"></div><div class="owl-next" style=""><img src="images/next-slide.png" alt="next-arrow"></div></div><div class="owl-dots" style=""><div class="owl-dot active"><span></span></div></div></div></div> 
                </div>
            </div>
     
        </section>
      <!--  -->  
        
        <footer>
            <div class="top-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a class="logo" href="index.html">DOPPIO RITORTO SHOP</a>
                                   <p>We pride ourselves with our unique and high quality Italian merchandise produced by well established Italian household names from all across Italy to satisfy the medium to high end clientele.</p>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="social-links">
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <!-- <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li> -->
                                    </ul>
                                    <ul class="links">
                                        <li><a href="#">About Us</a></li>
                                        <li><a href="#">Testimonials</a></li>
                                        <li><a href="#">Terms & Conditions</a></li>
                                        <li><a href="#">Sales</a></li>
                                        <li><a href="#">Sign Up to Our Newsletter</a></li>
                                       <!--  <li><a href="#">International</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label>Newsletter !</label>
                                    <input type="email" class="form-control" placeholder="Your email address...">
                                    <button type="submit" class="btn-yellow">Subscribe</button>
                                </div>
                                
                            </form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="links">
                                        <li><a href="about-us.html">How to shop</a></li>
                                        <li><a href="#">Making payment</a></li>
                                        <li><a href="#">Size Guide</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">Contact</a></li>
                                    </ul>
                                </div>
                                 <div class="col-sm-6">
                                    <address>
                                        <p><i class="fa fa-map-marker"></i>Special Plaza II Shopping Mall Lagos Street East Legon, Accra -Ghana</p>
                                        <p><i class="fa fa-phone"></i>0233244368232</p>
                                       <!--  <p><i class="fa fa-fax"></i>516-482-3676</p> -->
                                        <p><i class="fa fa-envelope"></i><a href="mailto: enquire@doppioritorto.com"> enquire@doppioritorto.com</a></p>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-footer">
                <div class="container">
               
                    <p class="copy-right">Copyright &copy; 2017 by <span> Doppio Ritorto</span>. All rights reserved.</p>
                </div>
                <a id="goTop" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-arrow-circle-o-up"></i></a>
            </div> 
        </footer>
    </div>
    
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/placehlder.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</body>


</html>
