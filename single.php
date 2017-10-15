<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

 <?php
  ######### GET PRODUCT ID FROM THE LINK ########
   if(isset($_GET['product_id'])){
	$product_id = $_GET['product_id'];  					
			}
  ######### GET PRODUCT ID FROM THE LINK ########
 ?>
 
 <?php
	
// SECTION 1 (IF USER ATTEMPTS TO ADD SOMETHING TO THE CART FROM THE PRODUCT PAGE)

if(isset($_POST['pid'])){
$pid = $_POST['pid'];
$quantity = $_POST['quantity'];
$wasFound = false;
$i=0;
// if the cart session variable is not set or cart array is empty
if(!isset($_SESSION["cart_product"]) || count($_SESSION["cart_product"]) < 1){
   // RUN IF THE CART IS EMPTY OR NOT SET
$_SESSION["cart_product"] = array(0 => array("item_id" => $pid, "quantity" => $quantity));

}else{
  // RUN IF THE CART AT LEAST ONE ITEM IN IT
foreach($_SESSION["cart_product"] as $each_item){
 $i++;
while(list($key, $value) = each($each_item)){
if($key =="item_id" && $value == $pid){
// the item is in cart already so let's adjust it quantity using array_splice()
array_splice($_SESSION["cart_product"], $i-1,1,array(array("item_id" => $pid, "quantity" => $each_item['quantity'] + $quantity)));
 $wasFound = true;

}

}

}

if($wasFound == false){
array_push($_SESSION["cart_product"],array("item_id" => $pid, "quantity" => 1));

}
}

echo "<script> window.location.replace('single.php?product_id={$product_id}') </script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  	<!-- Meta information -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"><!-- Mobile Specific Metas -->
    <meta name="format-detection" content = "telephone=no"><!-- Telephone Metas -->
    <meta name="description" content="Doppio Ritorto">
	                        <?php
	                           $tb_select_tag = "SELECT * FROM product_tb WHERE id = {$product_id} ORDER by id DESC ";
							   $result_tag = mysqli_query($connect,$tb_select_tag);
							   if(!$result_tag){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_tag = mysqli_fetch_array($result_tag)){
							   $tag = $row_tag['tag'];
						          }
							    ?>
    <meta name="keywords" content="<?php echo $tag;?>">
    <!-- Title -->
    <title> Doppio Ritorto  </title>

    <!-- favicon icon -->
    <link rel="shortcut icon" href="images/Favicon.ico">
    
    <!-- CSS Stylesheet -->
    <link href="css/font-awesome.min.css" rel="stylesheet"><!-- font awesome --> 
    <link href="css/bootstrap.css" rel="stylesheet"><!-- bootstrap css -->
    <link href="css/owl.carousel.css" rel="stylesheet"><!-- carousel Slider -->
    <link href="css/owl.carousel_old.css" rel="stylesheet"><!-- carousel Slider -->
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
	
	<!-- FOR NOTIFICATION-->
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
 <!-- FOR NOTIFICATION-->
	
	<script type="text/javascript" src="jquery.js"></script> 
		<script type="text/javascript">

    $(document).ready(function(){
       $("#link_hov").hover(show_cart());
      $.ajax({
        type:'post',
        url:'store_items.php',
        data:{
          total_cart_items:"totalitems"
        },
        success:function(response) {
		
		  var array_data = String(response).split("<br/>");
		  document.getElementById("total_items").innerHTML = array_data[0]; //response;
		  document.getElementById("total_Amt").innerHTML = array_data[1]; //response;
          //document.getElementById("total_items").value=response;
        }
      });

    });
	
	
	

    function cart(id)
    {
	 toastr.success('Product Added to Cart');
	  var ele=document.getElementById(id);
	  //var img_src=ele.getElementsByTagName("img")[0].src;
	  var product_id=document.getElementById(id+"product_id").value;
	  var price=document.getElementById(id+"_price").value;
	 //alert(<?php echo count($_SESSION['cart_product']);?>);
	 //alert(price);
	 
	  $.ajax({
        type:'post',
        url:'store_items.php',
        data:{
          //item_src:img_src,
          itemID:product_id,
          item_price:price
        },
        success:function(response){
		show_cart();
		var array_data = String(response).split("<br/>");
		
         // document.getElementById("total_Amt").value=array_data[0]; //response;
		  
		  document.getElementById("total_items").innerHTML = array_data[0]; //response;
		 document.getElementById("total_Amt").innerHTML = array_data[1]; //response;
                         
						 // $('#'+id+'success_message').fadeIn().html("<img src='icon.png' style='width:10px;height:10px;'>");  
						   $('#success_message').fadeIn().html("<a href='cart.php'><i class='fa fa-check-circle-o fa-2x'></i></a>");  
                          setTimeout(function(){  
                             $('#success_message').fadeOut("Slow");  
                         }, 2000);  
        }
      });
	
    }
   
    function show_cart()
    {
	
      $.ajax({
      type:'post',
      url:'store_items.php',
      data:{
        showcart:"cart"
      },
      success:function(response) {
        document.getElementById("mycart").innerHTML=response;
        //$("#mycart").slideToggle();
      }
     });

    }
	
</script>
	
	
    
</head>

<body class="innerPage">
	<div id="wapper">
        <header class="clearfix">
            <a href="index.php" class="logo"><img src="images/logo.png" alt=""></a>
            <div class="mobile-btn">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
            <div class="user_access">
               <!--  <div id="language_flag"><a href="#" class="active">English</a></div> -->
                <div id="currency"><a href="#">GHC</a></div>
				<span id="success_message"><i class=""></i></span>
                <!--<div id="user_account"><a href="login.html">Account</a></div>-->
                <div id="search_box">
                    <a href="javascript:void(0);"><i class="fa fa-search"></i></a>
                    <div class="search-form">
                        <div class="box">
                            <input type="text" placeholder="Enter Keywords To Search...">
                            <input type="submit" value="">
                        </div>
                        <div class="icon"><i class="fa fa-close"></i></div>
                    </div>
                </div>
				
                <div id="cart-icon">
                    
					<a href="#" id="link_hov"><img src="images/cart-icon.png" alt="cart-icon" /></a>
					
					<span id="total_items"></span>
					&#8373; <span id="total_Amt"></span>
					
                    <div class="cart-quckView">
                        <div class="inner-box">
						
						<div id="mycart"></div>
                            
                   
                        </div>
                    </div>
                </div>
				
            </div>
			
			<?php
	                           $tb_select_menu = "SELECT * FROM product_tb WHERE id = {$product_id} ORDER by id DESC ";
							   $result_menu = mysqli_query($connect,$tb_select_menu);
							   if(!$result_menu){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_menu = mysqli_fetch_array($result_menu)){
							   
							   $categ = $row_menu['6'];
							   $liproduct = $row_menu['1'];
							   
							   
							   
						          }
							    ?>
            <nav class="navMenu">
                 <ul>
                    <li><a href="index.php">Home</a></li>
					
                          <?php 
							  $parent = 0;
	                          $tb_select = "SELECT * FROM category_tb WHERE parent = {$parent} LIMIT 0,5";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_cat = mysqli_fetch_array($result)){

							   $parent_id = $row_cat['0'];
							   
							        ?>
								
						 <li class="" >
						  <a href="list.php?category=<?php echo $row_cat['0']; ?>"><?php echo $row_cat['1']; ?></a>

							
						 </li>	
										  <?php }?>
				
                    <?php require_once("includes/header.php");?>
					
                </ul>
            </nav> 
        </header>
        <section class="content">
            <div class="breadcrumbs">
                <div class="container">
                    <ul>
                        <li><a href="index.php">Home</a></li>
						 <?php
						       $tb_select_ctg = "SELECT * FROM category_tb WHERE id = {$categ} ORDER by id DESC ";
							   $result_ctg = mysqli_query($connect,$tb_select_ctg);
							   if(!$result_ctg){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_ctg = mysqli_fetch_array($result_ctg)){
							   ?>
                        <li><a href="list.php?category=<?php echo $row_ctg['0']; ?>"><?php echo $row_ctg['1']; ?></a></li>
						<?php }?>
                        <li><?php echo $liproduct;?></li>
                    </ul>
                </div>
            </div>  
            <div class="products">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="product-slider">
                                <div id="sync1" class="owl-carousel">
								<?php
	                           $tb_select_image = "SELECT * FROM product_image_tb WHERE product_id = {$product_id} ORDER by id ASC ";
							   $result_image = mysqli_query($connect,$tb_select_image);
							   if(!$result_image){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_image = mysqli_fetch_array($result_image)){
						
							    ?>
                                    <div class="item"><img src="<?php echo $row_image['image'];?>" alt="image" /></div>
									<?php } ?>
                                    <!--<div class="item"><img src="images/product-img/img21.png" alt="image" /></div>
                                    <div class="item"><img src="images/product-img/img22.png" alt="image" /></div>
                                    <div class="item"><img src="images/product-img/img23.png" alt="image" /></div>
                                    <div class="item"><img src="images/product-img/img21.png" alt="image" /></div>
                                    <div class="item"><img src="images/product-img/img22.png" alt="image" /></div>-->
                                </div>
                                <div id="sync2" class="owl-carousel">
								<?php
	                           $tb_select_image = "SELECT * FROM product_image_tb WHERE product_id = {$product_id} ORDER by id ASC ";
							   $result_image = mysqli_query($connect,$tb_select_image);
							   if(!$result_image){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_image = mysqli_fetch_array($result_image)){
						
							    ?>
                                    <div class="item"><img src="<?php echo $row_image['image'];?>" alt="image" /></div>
									<?php } ?>
                                   <!-- <div class="item"><img src="images/product-img/img20.png" alt="image" /></div>
                                    <div class="item"><img src="images/product-img/img21.png" alt="image" /></div>
                                    <div class="item"><img src="images/product-img/img22.png" alt="image" /></div>
                                    <div class="item"><img src="images/product-img/img23.png" alt="image" /></div>
                                    <div class="item"><img src="images/product-img/img21.png" alt="image" /></div>
                                    <div class="item"><img src="images/product-img/img22.png" alt="image" /></div>-->
                                </div>
                        </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="productDetail">
							 
							 <?php 
		
	                          $tb_select_product = "SELECT * FROM product_tb WHERE ID = {$product_id} ORDER by id DESC  limit 1";
							   $result_product = mysqli_query($connect,$tb_select_product);
							   if(!$result_product){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_product = mysqli_fetch_array($result_product)){
						
							    ?>
							 
							 
                                <h1><?php echo $row_product['product_name']; ?></h1>
                               
                                <div class="product-price">
								
								   <!-- PRICE CODE ---->
											<?php if($row_product['sale_price'] != 0){
									
									  $regular_price = $row_product['regular_price'];
									  $sale_price = $row_product['sale_price'];
									  
									  $regular_price= "₵ ".number_format($regular_price, 2);
									  $sale_price= "₵ ".number_format($sale_price, 2);
									?>
                                         <span class="new-price"><?php echo $sale_price; ?></span>
								         <span class="old-price"><?php echo $regular_price; ?></span>
										 
										 <input type="hidden" id="<?php echo $row_product['ID']; ?>_price" value="<?php echo $row_product['sale_price'];?>"> 
										<?php }else{?>
										
										 <span class="new-price"><?php echo $regular_price; ?></span>
										 <input type="hidden" id="<?php echo $row_product['ID']; ?>_price" value="<?php echo $row_product['regular_price'];?>"> 
										 <?php }?>
										 
										 <!-- PRICE CODE ---->
                                  
                                  
                                </div>
                                <p><?php echo $row_product['description']; 
								  
								  $description = $row_product['description'];
								  $cat = $row_product['category'];
								
								?></p>
								
                                <div class="availability">Availability : <span class="in-stock">In stock</span></div>
                                <form class="variations_form cart" method="post">
							   <div class="qty">

									<?php if($row_product['feature'] =="Promotion" && $row_product['coupon'] != ""){?>
                                     
									  <a href="<?php echo $row_product['coupon'];?>" class="btn-yellow" target="_blank"><span>Get Coupon</span></a>
									
									<?php }else{?>
									<label>Qty :</label>
									<input type="number"  name="quantity" value="1" class="jsSelect-box" >
									<input type="hidden" name="pid" value="<?php echo $row_product['ID']; ?>">
                                    <button class="btn-yellow">Add to cart</button>
									
									<?php }?>
                                </div>
								</form>
								<?php }?>
                               
                            </div>
                        </div>
                    </div>
                    <div class="product-desc">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#pro-desc" aria-controls="pro-desc" role="tab" data-toggle="tab">Product Description</a></li>
                        
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="pro-desc">
                                <p><?php echo $description; ?></p>
                                
                            </div>
                          
                        </div>
    
                    </div>
                </div>
            </div> 
            <div class="featured-products products-slider "> 
                <div class="container">
                    <h1>Featured Products</h1>
                    <h2>Find your style from us</h2>
                    <div class="owl-carousel" id="featured-products-slider">
					
					      <?php 
							  
	                          $tb_select = "SELECT * FROM product_tb WHERE category = {$cat} ORDER by id DESC  limit 0,10";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_sale = mysqli_fetch_array($result)){
						       if($product_id == $row_sale['0']){}else{
							    ?>
					
                        <div class="item">
                            <div class="productBox visible" id="<?php echo $row_sale['ID']; ?>">
                                <div class="product-img">
                                    <div class="product-labels">
                                       
                                    </div>
                                    <img src="<?php echo $row_sale['image']; ?>" alt="banner" />
                                    <div class="actions">
                                        <ul class="add-to-links">
                                           
                                            <li><a title="" href="single.php?product_id=<?php echo $row_sale[0];?>"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            <li style="cursor:pointer" id="success_message"><a title=""  onclick="cart('<?php echo $row_sale['ID']; ?>')" ><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
											
											<input type="hidden" name="pid" id="<?php echo $row_sale['ID']; ?>product_id" value="<?php echo $row_sale['ID']; ?>">
											
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name"><?php echo $row_sale['product_name']; ?></p>
                                    <div class="product-price">
									
									 <!-- PRICE CODE ---->
									 <?php
									  $regular_price = $row_sale['regular_price'];
									  $sale_price = $row_sale['sale_price'];
									  
									  $regular_price= "₵ ".number_format($regular_price, 2);
									  $sale_price= "₵ ".number_format($sale_price, 2);
									  
									  ?>
											<?php if($row_sale['sale_price'] != 0){
									
									?>
                                         <span class="new-price"><?php echo $sale_price; ?></span>
								         <span class="old-price"><?php echo $regular_price; ?></span>
										 
										 <input type="hidden" id="<?php echo $row_sale['ID']; ?>_price" value="<?php echo $row_sale['sale_price'];?>"> 
										<?php }else{?>
										
										 <span class="new-price"><?php echo $regular_price; ?></span>
										 <input type="hidden" id="<?php echo $row_sale['ID']; ?>_price" value="<?php echo $row_sale['regular_price'];?>"> 
										 <?php }?>
										 
										 <!-- PRICE CODE ---->
                                  
									
                                   
                                    </div>
                                </div>
                            </div>
                        </div>  
						
						<?php 
						
						}#CLOSE OF IF CONDITION
						
						}# CLOSE OF WHILE LOOP
						?>
					
                    </div> 
                </div>
            </div> 
            
     
        </section>
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
    <script type="text/javascript" src="js/owl.carousel.min-old.js"></script>
    <script type="text/javascript" src="js/jquery.customSelect.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</body>

</html>
