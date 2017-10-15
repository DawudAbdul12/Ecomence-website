<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<script>
function myFunction(id){
	
 //toastr.success('Product Added to Cart');
	  var product_id = id;
	  var quantity = document.getElementById(id+"_quantity").value;
	 //alert(product_id);
	  $.ajax({
        type:'post',
        url:'adjust_quantity.php',
        data:{
          //item_src:img_src,
          itemID:product_id,
          item_quantity:quantity
        },
        success:function(response){
		
		window.location.replace('cart.php');
		
        }
      });

	
}

</script>
<?php
		    if(isset($_GET['index_to_remove']) && $_GET['index_to_remove']!=""){
			 // access the array and run code tp remove that array  index
			$key_to_remove = $_GET['index_to_remove'];
			if(count($_SESSION["cart_product"]) <= 1){
			unset($_SESSION["cart_product"]);
			}else{
		    unset($_SESSION["cart_product"][$key_to_remove]);
			//sort($_SESSION["cart_product"]);
		    
			}
			// REDIRECT 
			echo "<script> window.location.replace('cart.php') </script>";
			}
?>



<!DOCTYPE html>
<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		
		<!-- Website Title & Description for Search Engine purposes -->
		<title>Gentspack - Cart</title>
		<meta name="description" content="">
		
		<!-- Mobile viewport optimized -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-glyphicons.css" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link href="css/global-styles.css" rel="stylesheet">
		<link href="css/cart-styles.css" rel="stylesheet">
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
	

	<header class="bg-2">
		<div class="content-inner">
			<div class="inside">
				<h2><strong>SHOPPING CART</strong></h2>
			</div>	
		</div>
	</header>

	<div class="container">
		<div class="row space">
			<!--<div class="col-lg-12">
				<div class="alert alert-success" role="alert">
					<p><i class="fa fa-check-circle"></i> "Asymmetrical Zip Poncho" has been added to your cart</p>
				</div>
			</div>-->
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 section-2">
			 	<h6>YOUR SHOPPING CART</h6>
			 	<table class="table table-responsive">
					<thead>
						<tr style="text ">
							<th>PRODUCT</th>
							<th>PRICE</th>
							<th>QUANTITY</th>
							<th>TOTAL</th>
						</tr>
					</thead>
					<tbody>
					
							 <?php
							 
						if(!isset($_SESSION["cart_product"]) || count($_SESSION["cart_product"])< 1){

						 $cart_status = "Cart is empty";

						}else{
						 $i =0;
						foreach($_SESSION["cart_product"] as  $each_item){
						$item_id = $each_item['item_id'];
						$quantity = $each_item['quantity'];
						$sql = mysqli_query($connect,"SELECT * FROM product_tb WHERE ID ='{$item_id}' limit 1");
						while ($row = mysqli_fetch_array($sql)){

						 //echo $cartoupt;
						 
                      ?>
					  <div id="<?php echo $row['0'];?>" >
						<tr  >
					
							<td class="clearfix">
								<ul>
									<li>
		
        
<!--<a href="cart.php?index_to_update=<?php// echo $row["0"];?>" class="edit"><i class="fa fa-pencil"></i></a>-->

<a href="cart.php?index_to_remove=<?php echo $i;?>" class="edit"><i class="fa fa-trash"></i></a>
						
									</li>
									<li><img src="<?php echo  $row["image"];?>"  width="200px" class="img-responsive"></li>
									<li><strong><?php echo $row["product_name"];?></strong></li>
								</ul>
							</td>
							<td> <?php if($row["sale_price"] == 0){?>
								<?php 
								$unit_price = $row["regular_price"];
								$unit_price = number_format($unit_price, 2);
								echo $unit_price;
								
								 $subtotal = $quantity *  $row["regular_price"];
								
								?> </td>
								
								<?php  }else{?>
								 <?php 
								$unit_price = $row["sale_price"];
								$unit_price = number_format($unit_price, 2);
								echo $unit_price;
								
								$subtotal = $quantity *  $row["sale_price"];
								
								
								?>  </td>
								<?php }?>
								
							<td>
							
							
								
									<select id="<?php echo $row['0']; ?>_quantity" onchange="myFunction(<?php echo $row['0'];?>);">
									<?php for($x=1;$x < 50; $x++){?>
	  <option <?php if($quantity == $x){?> selected="Selected" <?php }?> value="<?php echo $x ?>"><?php echo $x ?></option>
									<?php }?>
									</select>
								
							</td>
							<td>
							    <?php 
							   
							    $total_sub = $subtotal;
								$total_sub = number_format($total_sub, 2);
								echo $total_sub; 
								
								?>
								</td>
							
						</tr>
						</div>

       <?php 
	   
	          $totalamount = $subtotal + $totalamount;
			  $totalQty = $totalQty + $quantity;
			  
			  $i++;
	  
	         } // end of while loop
	         
			 }// end for each
			 
			 }// end of if 
	   ?>						
					</tbody>
				</table>
			 	<div class="clearfix">
			 		<a href="index.php" class="btn-1 pull-left">CONTINUE SHOPPING</a>
			 	</div>
			 	<div class="row">
				<?php 
				      $limit = 'LIMIT 0,4';
			 		  $tb_select = "SELECT * FROM product_tb ORDER by id DESC {$limit}";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_new = mysqli_fetch_array($result)){


					  ?>
		<!--######### PHP CODE #######-->
		
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center margin-but set-height1" id="<?php echo $row_new['ID']; ?>">
		<!--product image with hover change  -->
			   <div class="imageBox">
	           <div class="imageInn">
			   <?php $encryp_product_id = my_simple_crypt($row_new['ID'], 'e' );?>
			   <a href="product.php?product_id=<?php echo $encryp_product_id ;?>">
	           <img src="<?php echo $row_new['image']; ?>" class="img-responsive" alt="Default Image">
			   </a>
	           </div>
	           <div class="hoverImg">
			    <a href="product.php?product_id=<?php echo $encryp_product_id ;?>">
	           <img src="<?php echo $row_new['image']; ?>" class="img-responsive"alt="Profile Image">
			   </a>
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
			 }// end while
			
				
				?>

			 	</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 section-3">
			 	<h6>COUPON CODES</h6>
			 	<div class="well well-1">
			 		<button class="btn-block btn-1">Coupon Code</button>
			 		<button class="btn-block btn-2">APPLY COUPON</button>
			 	</div>
			 	<h6>CART TOOLS</h6>
			 	<div class="well well-2">
			 		<p class="small clearfix">
			 			<span style="float:left;">Subtotal</span>
			 			<span style="float:right;">&#8373; <?php $totalamount = number_format($totalamount, 2);
							echo $totalamount; ?></span>
			 		</p>
			 		<hr>
					<p class="small clearfix">
			 			<span style="float:left;">Quantity</span>
			 			<span style="float:right;"><?php echo $totalQty; ?></span>
			 		</p>
			 		<hr>
			 		<p class="small clearfix">
			 			<span style="float:left;">Shipping</span>
			 			<span style="float:right;">Free Shipping</span>
			 		</p>
			 		<hr>
			 		<p class="small clearfix">
			 			<span style="float:left;">Total</span>
			 			<span style="float:right;">&#8373; <?php 
							echo $totalamount; ?></span>
			 		</p>
					<?php $_SESSION['items'] = $i;?>
					<p class="small clearfix">
			 			<span style="float:left;">Items</span>
						
			 			<span <?php if($i >= 5){?> style="float:right; font-size:15px" <?php }else{?> style="float:right; color:red; font-size:15px" <?php }?> ><?php 
							echo $i; ?></span>
			 		</p>
			 	</div>
				
			 	<button class="btn-3 btn-block"><a <?php if($i >= 5){?>href="check-out.php" <?php }else{?> href="#" <?php }?> style="color:white; display:block;width:100%;"><?php if($i >= 5){?>PROCEED TO CHECKOUT<?php }else{ $x=5 - $i; ?> <?php echo $x;?> Items left to Proceed
				<?php }?>
				</a></button>
			</div>
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
	</body>
</html>

