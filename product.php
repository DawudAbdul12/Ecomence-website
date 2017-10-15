<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<?php
  ######### GET PRODUCT ID FROM THE LINK ########
   if(isset($_GET['product_id'])){
	$product_id = $_GET['product_id'];  
	 $product_id = my_simple_crypt( $product_id, 'd');
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

//echo "<script> window.location.replace('product.php?product_id={$product_id}') </script>";
}

?>

 
<!DOCTYPE html>
<html>
	<head>
		
		<!-- Website Title & Description for Search Engine purposes -->
		<title>Gentspack - Product</title>
		<meta name="description" content="">
		
		<!-- Mobile viewport optimized -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-glyphicons.css" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link href="css/global-styles.css" rel="stylesheet">
		<link href="css/product-styles.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		
		<!-- Include Modernizr in the head, before any other Javascript -->
		<script src="js/modernizr-2.6.2.min.js"></script>
		
		<!-- FOR ADD TO CART --> 
		<script type="text/javascript" src="jquery.js"></script> 
	    <script type="text/javascript" src="JS/echo.js"></script> 
		<script type="text/javascript" src="add_cart.js"></script> 
		
	</head>
	<body class="white">

	<!-- NAVIGATION -->
	<?php  require_once("includes/header.php");?>
	<!-- NAVIGATION -->
	
	<header class="bg-1">
		<div class="content-inner">
			<div class="inside">
				<h2><strong>PRODUCT</strong></h2>
			</div>	
		</div>
	</header>
	                   <?php
	                           $tb_select = "SELECT * FROM product_tb WHERE id = {$product_id} ORDER by id DESC ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
							   $prod_id = $row['0'];
							   $product_name = $row['1'];
							   $regular_price = $row['2'];
				               $sale_price = $row['3'];
							   $stock_qty = $row['4'];
							   $description = $row['13'];
							   $attribute = $row['attribute'];
							   $brand = $row['brand'];
							   $image = $row['14'];
							   $category_id = $row['6'];
							   
						          }
							    ?>

	<div class="container section-3">
		<div class="row flex">
			<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
				<div class="row">
		            <div class="col-lg-2 col-md-3 col-sm-3 hidden-xs" id="slider-thumbs">
		                <!-- Bottom switcher of slider -->
		                <div class="row">
			                <ul class="hide-bullets">
			                	<li class="col-lg-12 col-md-12 col-sm-12 text-center">
			                		<button href="#myCarousel" role="button" data-slide="prev">
			                			<i class="fa fa-chevron-up"></i>
			                		</button>
			                	</li>
			                    
								
								<?php
								$num = 0;
	                           $tb_select_image = "SELECT * FROM product_image_tb WHERE product_id = {$product_id} ORDER by id ASC ";
							   $result_image = mysqli_query($connect,$tb_select_image);
							   if(!$result_image){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_image = mysqli_fetch_array($result_image)){
						      if($num == 0){
							    ?>
								<li class="col-lg-12 col-md-12 col-sm-12">
			                        <a class="thumbnail" id="carousel-selector-0">
			                            <img src="<?php echo $row_image['image'];?>">
			                        </a>
			                    </li>
								<?php }else{?>

			                    <li class="col-lg-12 col-md-12 col-xs-12">
			                        <a class="thumbnail" id="carousel-selector-<?php echo $num;?>">
			                            <img src="<?php echo $row_image['image'];?>">
			                        </a>
			                    </li>
                                
								<?php 
								}
								$num = $num + 1;
								}
								
								?>
								
			                   
								
			                    <li class="col-lg-12 col-md-12 col-sm-12 text-center">
			                		<button href="#myCarousel" role="button" data-slide="next">
			                			<i class="fa fa-chevron-down"></i>
			                		</button>
			                	</li>
								
			                </ul>
			            </div>    
		            </div>
		            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
		                <div class="row">
			                <div class="col-xs-12" id="slider">
			                    <!-- Top part of the slider -->
			                    <div class="row">
			                        <div class="col-sm-12" id="carousel-bounding-box">
			                            <div class="carousel slide" id="myCarousel">
			                                <!-- Carousel items -->
			                                <div class="carousel-inner">
			                                   
                                           
								<?php
								$num = 0;
	                           $tb_select_image = "SELECT * FROM product_image_tb WHERE product_id = {$product_id} ORDER by id ASC ";
							   $result_image = mysqli_query($connect,$tb_select_image);
							   if(!$result_image){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_image = mysqli_fetch_array($result_image)){
						        
								if($num < 1){
								
							    ?>
								               <div class="active item" data-slide-number="0">
			                                        <img src="<?php echo $row_image['image'];?>">
			                                    </div>
												<?php }else{?>
												
			                                    <div class="item" data-slide-number="<?php echo $num;?>">
			                                        <img src="<?php echo $row_image['image'];?>">
			                                    </div>
									<?php 
								}
								
								$num = $num + 1;
								
								}
								
								?>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </div>    
		            </div>
		            <!--/Slider-->
		            <div class="col-xs-12 visible-xs" id="slider-thumbs">
		                <!-- Bottom switcher of slider -->
		                <div class="row">
			                <ul class="hide-bullets">
			                   
								<?php
								$num = 0;
	                           $tb_select_image = "SELECT * FROM product_image_tb WHERE product_id = {$product_id} ORDER by id ASC ";
							   $result_image = mysqli_query($connect,$tb_select_image);
							   if(!$result_image){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_image = mysqli_fetch_array($result_image)){
						     if($num == 0){
							    ?>
								
								 <li class="col-xs-4">
			                        <a class="thumbnail" id="carousel-selector-0">
			                            <img src="<?php echo $row_image['image'];?>" >
			                        </a>
			                    </li>
								<?php }else{?>

			                    <li class="col-xs-4">
			                        <a class="thumbnail" id="carousel-selector-<?php echo $num;?>">
			                            <img src="<?php echo $row_image['image'];?>">
			                        </a>
			                    </li>
								
								<?php 
								}
								$num = $num + 1;
								}
								
								?>

			                    
			                </ul>
			            </div>    
		            </div>
		        </div>
			</div>
			
							  
			<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
				<h6><?php echo $product_name;?></h6>
			<!--	<div class="row clearfix">
					<div class="col-lg-12">
						<ul class="pull-left marg-right ul-1">
							<li><i class="fa fa-star"></i></li>
							<li><i class="fa fa-star"></i></li>
							<li><i class="fa fa-star"></i></li>
							<li><i class="fa fa-star-o"></i></li>
							<li><i class="fa fa-star-o"></i></li>
						</ul>
						<p class="small pull-left">1 customer review</p>
					</div>
				</div>	-->
				                 <?php
									 
									  $regular_price= "&#8373; ".number_format($regular_price, 2);
									  $sale_price= "&#8373; ".number_format($sale_price, 2);
									  
									  ?>
			<p class="lead">
			
			 <?php if($sale_price > 0){?>
			 
		     <strong><?php echo $sale_price;?></strong>
	         <span style="font-size: 14px; color: #e7e7e7;margin-left: 5px;"><strike><?php echo $regular_price; ?></strike></span>
			 
			 <?php }else{?>
			 
			  <strong><?php echo $regular_price;?></strong>
			  
			 <?php }?>
			 
			 </p>
				
				<hr>
				<p class="mid-p"><?php echo $description;?></p>
				<hr>
				<p class="small"><?php echo $stock_qty;?> in stock</p>
				<p class="small"><?php echo $attribute;?></p>
				<p class="small"><?php echo $brand;?></p>
				
				<div class="row">
					<div class="col-lg-12">
						<form class="pull-left" Method="POST"> 
						
							<select class="form-control" name="quantity" >
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								
							</select>
							<input type="hidden" name="pid" value="<?php echo $prod_id; ?>" >
						    <button class="btn-1 pull-left">ADD TO CART</button>
						<!--<i class="fa fa-heart-o box pull-right"></i>-->
						</form>
					</div>
				</div>
				<!--
				<p><span>SKU: </span><strong>JKR-009</strong></p>
				<p><span>Category:</span> <strong class="spec-color">Jacket</strong></p>
				<p><span>Category:</span> <strong class="spec-color">Men's Clothing, Stylish</strong></p>
				<p><span>Brand:</span> <strong class="spec-color">Majestic, Obey.</strong></p>
				<div class="row clearfix">
					<div class="col-lg-12">
						<p class="pull-left"><strong>SHARE</strong></p>
						<ul class="pull-left ul-2">
							<li><i class="fa fa-facebook"></i></li>
							<li><i class="fa fa-twitter"></i></li>
							<li><i class="fa fa-google-plus"></i></li>
							<li><i class="fa fa-linkedin"></i></li>
						</ul>
					</div>
				</div>
				
				-->
			</div>
		</div>
	</div>

	<div class="container section-1">
		<div class="row">
			<div class="col-lg-12">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
					<!--<li><a data-toggle="tab" href="#reviews">REVIEWS (1)</a></li>-->
				</ul>
				<div class="tab-content">
					<div id="description" class="tab-pane fade in active">
						<?php echo $description;?>
					</div>
				<!--	<div id="reviews" class="tab-pane">
						<p>This product is made for men in the latest Fall Collection 2015. Check out its full information</p>
						<ul>
							<li>Asymmetrical Zip</li>
							<li>Freestyle, one size fit all</li>
							<li>Brands: Majestic, Obey</li>
							<li>Color: All Black</li>
							<li>Poncho with hat</li>
							<li>Trendy item this winter</li>
						</ul>
					</div>-->
				</div>
			</div>
		</div>
	</div>

	<div class="container section-2">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h4>RELATED PRODUCTS</h4>
				<hr class="section-rule">
			</div>
		</div>
		<div class="row">
							<!--######### PHP CODE #######-->
					           <?php 
			     // This sets the range of rows to query for the chosen $pagenum
				 $limit = "limit 0,4";
				// This is your query again, it is for grabbing just one page worth of rows by applying $limit
							   
							   if(isset($category_id)){
							   
	  $tb_select = "SELECT * FROM product_tb WHERE category = '{$category_id}' AND ID != '{$product_id}' AND publish = 'Yes' ORDER by ID DESC {$limit}";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_new = mysqli_fetch_array($result)){
							  $prod_id = $row_new['0'];
							  
							  
							    ?>

			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center margin-but" id="<?php echo $row_new['ID']; ?>">
		<!--product image with hover change  -->
			   <div class="imageBox">
	           <div class="imageInn">
			   <?php $encryp_product_id = my_simple_crypt($row_new['0'], 'e' );?>
	           <a href="product.php?product_id=<?php echo $encryp_product_id; ?>"><img src="<?php echo $row_new['image']; ?>" class="img-responsive" alt="Default Image"></a>
	           </div>
			    <?php 
	                          $tb = "SELECT * FROM product_image_tb WHERE product_id = {$prod_id} ORDER by id ASC limit 2";
							   $rst = mysqli_query($connect,$tb);
							   if(!$rst){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_image = mysqli_fetch_array($rst)){
								   $Hover_image = $row_image['image'];
							   }
							    ?>
			   
			   
	           <div class="hoverImg">
	           <a href="product.php?product_id=<?php echo $encryp_product_id; ?>"><img src="<?php echo  $Hover_image; ?>" class="img-responsive"alt="Profile Image"> </a>
	         </div>
	        </div>
		<!--product image with hover change  -->
				<p><?php echo $row_new['product_name']; ?></p>
				<?php if($row_new['sale_price'] != 0){ ?>
				<div class="label label-success price"><span class="glyphicon glyphicon-tag"></span> <sup></sup> Sale! </div>
				<?php }?>
				              <?php
									  $regular_price = $row_new['regular_price'];
									  $sale_price = $row_new['sale_price'];
									  
									  $regular_price= "&#8373; ".number_format($regular_price, 2);
									  $sale_price= "&#8373; ".number_format($sale_price, 2);
									  
									  ?>
				
		           <?php 

				if($row_new['sale_price'] != 0){
										
					?>
					
					<p>
			<strong><?php echo $sale_price;?></strong>
	         <span style="font-size: 14px; color: #e7e7e7;margin-left: 5px;"><strike><?php echo $regular_price; ?></strike></span>
			 <input type="hidden" id="<?php echo $row_new['ID']; ?>_price" value="<?php echo $row_new['sale_price'];?>"> 
				</p>
				
				<?php 
				}else{
				?>
				<p>
			<strong><?php echo $regular_price;?></strong>
	         <!--<span style="font-size: 14px; color: #e7e7e7;margin-left: 5px;"><strike>¢1000</strike></span>-->
			  <input type="hidden" id="<?php echo $row_new['ID']; ?>_price" value="<?php echo $row_new['regular_price'];?>"> 
				</p>
				<?php 
				}
				?>
				
		<input type="hidden" name="pid" id="<?php echo $row_new['ID']; ?>product_id" value="<?php echo $row_new['ID']; ?>">
				
			<button type="button" class="btn btn-primary"  id="<?php echo $row_new['ID'];?>success_message" onclick="cart('<?php echo $row_new['ID']; ?>')" > <span class="psa"><i class="fa fa-shopping-cart "></i></span> Add to Cart</button>
			
			
			</div>
			<?php 
			}
			}?>
	
		</div>
	</div>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				 	<p class="pull-left">Copyrights &copy; 2017. All Rights Reserved.</p>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<ul class="right">
						<li><i class="fa fa-facebook"></i></li>
				 		<li><i class="fa fa-twitter"></i></li>
				 		<li><i class="fa fa-google-plus"></i></li>
				 		<li><i class="fa fa-instagram"></i></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	
	
	<!-- First try for the online version of jQuery-->
	<script src="http://code.jquery.com/jquery.js"></script>
	
	<!-- If no online access, fallback to our hardcoded version of jQuery -->
	<script>window.jQuery || document.write('<script src="js/jquery-1.8.2.min.js"><\/script>')</script>
	
	<!-- Bootstrap JS -->
	<script src="js/bootstrap.min.js"></script>
	
	<!-- Custom JS -->
	<script src="js/script.js"></script>

	<script type="text/javascript">
		 jQuery(document).ready(function($) {
		 
		        //Handles the carousel thumbnails
		        $('[id^=carousel-selector-]').click(function () {
		        var id_selector = $(this).attr("id");
		        try {
		            var id = /-(\d+)$/.exec(id_selector)[1];
		            console.log(id_selector, id);
		            jQuery('#myCarousel').carousel(parseInt(id));
		        } catch (e) {
		            console.log('Regex failed!', e);
		        }
		    });
		        // When the carousel slides, auto update the text
		        $('#myCarousel').on('slid.bs.carousel', function (e) {
		                 var id = $('.item.active').data('slide-number');
		                $('#carousel-text').html($('#slide-content-'+id).html());
		        });
		});
	</script>	
	</body>
</html>

