<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>
<?php
		    if(isset($_GET['index_to_remove']) && $_GET['index_to_remove']!=""){
			 // access the array and run code tp remove that array  index
			$key_to_remove = $_GET['index_to_remove'];
			if(count($_SESSION["cart_product"]) <= 1){
			unset($_SESSION["cart_product"]);
			}else{
		    unset($_SESSION["cart_product"][$key_to_remove]);
			sort($_SESSION["cart_product"]);
		    
			}
			// REDIRECT 
			echo "<script> window.location.replace('cart.php') </script>";
			}
?>

<?php

			if(isset($_POST['item_to_adjust']) && $_POST['item_to_adjust']!=""){
			// Excute some code
			$item_to_adjust = $_POST['item_to_adjust'];
			$quantity = $_POST['quantity'];
			$quantity = preg_replace('#[^0-9]#i',"",$quantity);
			if($quantity >= 100){$quantity = 99;}
			if($quantity <= 1){$quantity = 1;}

			$i = 0;
			foreach($_SESSION['cart_product'] as $each_item){
				$i++;
				while(list($key,$value) = each($each_item)){
			   if($key == "item_id" && $value == $item_to_adjust){
				// that item is in cart already so let's adjust its quantity using array
				array_splice($_SESSION["cart_product"], $i-1,1,array(array("item_id" => $item_to_adjust, "quantity" => $quantity)));


			 }

			}

			}
			}
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
	
		<script type="text/javascript" src="jquery.js"></script> 
		
    
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
				
               <!-- <div id="user_account"><a href="login.html">Account</a></div>
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
                    
					<a href="#" id="link_hov"><img src="images/cart-icon.png" alt="cart-icon" /></a>
					
					<span id="total_items"></span>
					&#8373; <span id="total_Amt"></span>
					
                    <div class="cart-quckView">
                        <div class="inner-box">
						
						<div id="mycart"></div>
                            
                           
                            <div class="cart-btn">
                                <a href="#" class="btn-yellow">VIEW CART</a>
                                <a href="#" class="btn-yellow pull-right">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>-->
				
				
            </div>
             <nav class="navMenu">
                 <ul>
                    <li ><a href="index.php">Home</a></li>
					
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
									<?php                       //  NESTED SELECT STATEMENT 
											$tb_select_nest = "SELECT * FROM category_tb WHERE parent = {$parent_id} ORDER BY NAME ASC LIMIT 0,10" ;
											 $result_nest = mysqli_query($connect,$tb_select_nest);
										   if(!$result_nest){
										   die ("SELECT TABLE FAILED".mysqli_error());
										   }
										   
										   while($row_nest = mysqli_fetch_array($result_nest)){
										   /*  $sub_cat = $row_nest['0'];
											 $x= 0;
											if($x == 0){
											echo "<div class=\"megamenu\">";
						                       echo   "<ul>";
											 }
				                             ?>
											 
											    <?php if($row_nest['0'] == $category_id ){
												# variable for navigation bar
											    $nav = $parent_id;
												 $title  = $row_nest['1'];
												?>
												<li class="active"><a href="list.php?category=<?php echo $row_nest['0']; ?>"><?php echo $row_nest['1']; ?></a></li>
												<?php }else{ ?>
												<li><a href="list.php?category=<?php echo $row_nest['0']; ?>"><?php echo $row_nest['1']; ?></a></li>
												 <?php
													}
													?>
								        <?php
										if($x == 0){
										echo  "</ul>";
										 echo      " </div>";
										}
										 $x++;
										 */
									      } // END 
										  
									      ?>
							
						 </li>	
										  <?php }?>
				
                    <?php require_once("includes/header.php");?>
					
                </ul>
            </nav> 
        </header>



        <!--  -->
                <div class="content">
            <section class="inner-pageBanner">
                <img alt="" src="images/top-banner/cart-Banner.png">
                <div class="banner-text">
                    <h2>Cart</h2>
                </div>
            </section>
            <div class="cart-view">
                <div class="container">
                    <div class="cart-table">
                        <table>
                            <tbody>
							<tr>
                                <th>Details</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>&nbsp;</th>
                            </tr>
							
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
							
                            <tr>
                                <td>
                                    <span class="small-text">Details</span>
                                    <div class="product-img">
                                        <img src="<?php echo  $row["image"];?>" alt="">
                                    </div>
                                    <div class="product-info">
                                        <div class="product-name"><?php echo $row["product_name"];?></div>
                                        <!--<p><span>Size:</span>XL</p>
                                        <p><span>Color:</span>Black</p>-->
                                    </div>
                                </td>
                                <td>
								<?php if($row["sale_price"] == 0){?>
								<span class="small-text">Price</span> ₵ <?php 
								$unit_price = $row["regular_price"];
								$unit_price = number_format($unit_price, 2);
								echo $unit_price;
								
								
								 $subtotal = $quantity *  $row["regular_price"];
								
								?></td>
								
								<?php  }else{?>
								<span class="small-text">Price</span> ₵ <?php 
								
								$unit_price = $row["sale_price"];
								$unit_price = number_format($unit_price, 2);
								echo $unit_price;
								
								$subtotal = $quantity *  $row["sale_price"];
								
								
								?></td>
								<?php }?>
								<form action="cart.php" METHOD="POST">
                                <td><span class="small-text">Quantity</span> <input type="number" name="quantity" class="quanitity-input" value="<?php echo $quantity;?>"></td>
                                <td><span class="small-text">Subtotal</span> ₵ <?php 
								
								$total_sub = $subtotal;
								$total_sub = number_format($total_sub, 2);
								echo $total_sub;
								
								$subtotal;
								
								
								?> </td>
								
                                <td><!-- FORM FOR REMOVINITEMS -->
                    <a href="cart.php?index_to_remove=<?php echo $i;?>" class="edit"><i class="fa fa-trash"></i></a>
					<input type="hidden" name="item_to_adjust" value="<?php echo $row["0"];?>">
                    <button><i class="fa fa-pencil"></i></button> 
					</form>
					</td>
					
                            </tr>
							
			<?php
			
			  $totalamount = $subtotal + $totalamount;
			  $totalQty = $totalQty + $quantity;
			  $i++;
				}

				}

				}

?>
                          
                        </tbody>
					</table>
                    </div>
                    <div class="descount-box">
                        <h3>Discount Codes</h3>
                        <div class="descount-input">
                            <label>Enter your coupon code if you have one.</label>
                            <input type="text">
                            <input type="submit" value="Apply Coupon" class="btn-yellow">
                        </div>
                    </div>
                    <div class="cart-total">
					  
					    <div class="total-row">
                            <p>Total Quantity: <span><?php echo $totalQty;?></span></p>
                        </div>
						
                        <div class="total-row">
                            <p>Cart Subtotal: <span>₵ <?php 
							
							$totalamount = number_format($totalamount, 2);
							echo $totalamount;
							
							
							?></span></p>
                        </div>
                       
                        <div class="total-row">   
                            <p><strong>Order Total:</strong> <span>₵ <?php echo $totalamount;?></span></p>
                        </div>
                    </div>
                    <div class="cart-btnBlock">
                        <a href="index.php" class="btn-yellow"><i class="fa fa-chevron-left"></i>Continue Shopping </a>
                        <a href="checkout.php" class="btn-yellow pull-right">Proceed to Checkout <i class="fa fa-chevron-right"></i></a>
                    </div>
                </div> 
            </div>
        </div>
        <!--  -->

  
       <?php require_once("includes/footer.php");?>

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
