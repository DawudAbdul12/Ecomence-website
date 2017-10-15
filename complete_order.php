<?php  require_once("includes/session.php");?>
<?php 
if(!isset($_SESSION['fullname'])){
  echo "<script> window.location.replace('index.php') </script>";
   exit;
}
?>

<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>


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
            <a href="index.php" class="logo"><img src="images/logo.png" alt=""></a>
            <div class="mobile-btn">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
            <div class="user_access">
               <!--  <div id="language_flag"><a href="#" class="active">English</a></div> -->
                <div id="currency"><a href="#">GHC</a></div>
               
                
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
         <section class="inner-pageBanner">
                <img src="images/top-banner/cart-Banner.png" alt="">
                <div class="banner-text">
                    <h2>Checkout</h2>
                </div>
            </section>
        <!--  -->

        <!--  -->
            <div class="checkout-content">
                <div class="container">
                  <!--  <div class="step-box">
                        <div class="title">1. Log In / Register</div>
                        <div class="step1">
                            <div class="new-customer">
                                <h3>NEW CUSTOMER</h3>
                                <h4>Register with us for future convenience</h4>
                                <div class="radio-row">
                                    <label for="radio-01" class="label_radio"><input type="radio" checked="" value="1" id="radio-01" name="sample-radio"> Register Account</label>
                                </div>
                                <div class="radio-row">
                                    <label for="radio-02" class="label_radio r_on"><input type="radio" checked="" value="1" id="radio-02" name="sample-radio"> Checkout us Guest</label>
                                </div>
                                <p>A Message  here for customers </p>
                            </div>
                            <div class="login-info">
                                <h3>REGISTERED CUSTOMER</h3>
                                <div class="note">We will send order details to this email address</div>
                                <div class="input-box">
                                    <label>Please enter your email address</label>
                                    <input type="text">
                                </div>
                                <div class="input-box">
                                    <label>Please enter your Password</label>
                                    <input type="password">
                                </div>
                                <div class="submit-box">
                                    <a href="#" class="btn-yellow">Continue</a>
                                </div>
                            </div>
                        </div>
                    </div> -->
					
                   
					
                    <div class="step-box">
                        <div class="title">
					
						<h3><i class='fa fa-check-circle-o fa-3x'></i>
						<br/>
						Yatta!! <strong><?php echo $_SESSION['fullname'];?></strong>,  Your order is on the way</h3>
						</div>
                        <div class="step3">
                            <table class="order-table">
                                <tbody><tr>
                                <th>Item Details</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
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
                                        <div class="small-text"><?php echo $row["product_name"];?></div>
                                        <div class="product-info">
                                            <div class="img">
                                                <img src="<?php echo  $row["image"];?>" alt="" style="width:100px;height:100px">
                                            </div>
                                            <div class="details">
                                                <div class="name"><?php echo $row["product_name"];?></div>
                                                <!--<p>Product Description </p>-->
                                            </div>
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
                                    <td><div class="small-text">quantity</div><?php echo $quantity;?></td>
									
									<td><div class="small-text">Subtotal</div>₵ <?php
                                      
							    $total_sub = $subtotal;
								$total_sub = number_format($total_sub, 2);
								echo $total_sub;
								$subtotal;
									
									?></td>
                                </tr>
								
								<?php
								 $totalamount = $subtotal + $totalamount;
			                 $totalQty = $totalQty + $quantity;
                                 }
								
								}
							
							
								}
								
								?>
                            </tbody></table>
                            <div class="total-info">
                                <div class="right-info">
								    <div class="sub-total">Order ID:<span>#<?php echo $_SESSION['Doppio'];?></span></div>
								    <div class="sub-total">Quantity:<span> <?php echo $totalQty;?> items</span></div>
                                    <div class="sub-total">Total:<span>₵ <?php 
									 $totalamount = number_format($totalamount, 2);
							       echo $totalamount;
									?></span></div>
                                    <div class="sub-total">Delivery Charges:<span>₵ 00.00</span></div>
                                    <div class="total">Total Amount <span>₵ <?php echo $totalamount;?></span></div>
                                </div>
								 <input type="hidden" value="<?php echo $totalQty;?>"  name="total_items">
			                  <input type="hidden" value="<?php echo $totalamount;?>"  name="total_amount">	 
                               
                                
                            </div>
                            <div class="Proceed-btn">
                                <a href="index.php" class="btn-yellow">Shop Again!</a>
                            </div>
							
                        </div>
                    </div>
                   <!--  <div class="step-box">
                        <div class="title">4. Make Payment</div>
                        <div class="step4">
                            <div class="tab-menu">
                                <ul class="tab-nav">
                                    <li class="active"><a href="javascript:;" class="saveCard_li">Saved Card</a></li>
                                    <li><a href="javascript:;" class="creditCard_li">Credit Card</a></li>
                                    <li><a href="javascript:;" class="debitCard_li">Debit Card</a></li>
                                </ul> 
                                <div class="tab-content save-card saveCard">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="card-box">
                                                <div class="title">
                                                    <div class="card-name">HDFC</div>
                                                    <a href="#" class="remove-link">Remove Card</a>
                                                </div>
                                                <div class="card-info">
                                                    <div class="card-detail">
                                                        <img src="images/visa-cardImg.png" alt="">
                                                        <div class="number">4854 XXXX XXXX 8717</div>
                                                        <input type="text" placeholder="CVV">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card-box">
                                                <div class="title">
                                                    <div class="card-name">HDFC</div>
                                                    <a href="#" class="remove-link">Remove Card</a>
                                                </div>
                                                <div class="card-info">
                                                    <div class="card-detail">
                                                        <img src="images/visa-cardImg.png" alt="">
                                                        <div class="number">4854 XXXX XXXX 8717</div>
                                                        <input type="text" placeholder="CVV">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card-box">
                                                <div class="title">
                                                    <div class="card-name">HDFC</div>
                                                    <a href="#" class="remove-link">Remove Card</a>
                                                </div>
                                                <div class="card-info">
                                                    <div class="card-detail">
                                                        <img src="images/visa-cardImg.png" alt="">
                                                        <div class="number">4854 XXXX XXXX 8717</div>
                                                        <input type="text" placeholder="CVV">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content card-tab creditCard">
                                    <div class="card-type">
                                        <span>Pay using Credit Card :</span>
                                        <div class="logo">
                                            <img src="images/visa-cardImg.png" alt="">
                                            <img src="images/master-cardImg.png" alt="">
                                            <img src="images/maestro-cardImg.png" alt="">
                                            <img src="images/rupay-img.png" alt="">
                                        </div>
                                    </div>
                                    <div class="card-input">
                                        <div class="card-number">
                                            <input type="text" placeholder="Card Number">
                                        </div>
                                        <div class="month-details">
                                            <input type="text" placeholder="MM / YY">
                                            <label>Expiry Date</label>
                                        </div>
                                        <div class="cvv-number">
                                            <input type="text" placeholder="CVV">
                                        </div>
                                        <div class="card-name">
                                            <input type="text" placeholder="Name on Card">
                                        </div>
                                        <div class="payment-btn">
                                            <a href="#" class="btn-yellow">Save And Pay</a>
                                        </div>
                                        <div class="note">This card will be saved for a faster payment experience</div>
                                    </div>
                                    <p><span>100% </span>Safe and Secure Payments</p>
                                    <p><span>TrustPay: </span>100% Payment Protection, Easy Returns Policy</p>
                                    <p>By placing the order, I have read and agreed to snapdeal.com   <a href="#">Terms of Use</a> &nbsp;|&nbsp;<a href="#">  Terms of Sale</a></p>
                                </div>
                                <div class="tab-content card-tab debitCard">
                                    <div class="card-type">
                                        <span>Pay using Debit Card :</span>
                                        <div class="logo">
                                            <img src="images/visa-cardImg.png" alt="">
                                            <img src="images/master-cardImg.png" alt="">
                                            <img src="images/maestro-cardImg.png" alt="">
                                            <img src="images/rupay-img.png" alt="">
                                        </div>
                                    </div>
                                    <div class="card-input">
                                        <div class="card-number">
                                            <input type="text" placeholder="Card Number">
                                        </div>
                                        <div class="month-details">
                                            <input type="text" placeholder="MM / YY">
                                            <label>Expiry Date</label>
                                        </div>
                                        <div class="cvv-number">
                                            <input type="text" placeholder="CVV">
                                        </div>
                                        <div class="card-name">
                                            <input type="text" placeholder="Name on Card">
                                        </div>
                                        <div class="payment-btn">
                                            <a href="#" class="btn-yellow">Save And Pay</a>
                                        </div>
                                        <div class="note">This card will be saved for a faster payment experience</div>
                                    </div>
                                    <p><span>100% </span>Safe and Secure Payments</p>
                                    <p><span>TrustPay: </span>100% Payment Protection, Easy Returns Policy</p>
                                    <p>By placing the order, I have read and agreed to snapdeal.com   <a href="#">Terms of Use</a> &nbsp;|&nbsp;<a href="#">  Terms of Sale</a></p>
                                </div>
                            </div>
                        </div>
                    </div> -->
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

<?php
unset($_SESSION["cart_product"]);
unset($_SESSION['Doppio']);
unset($_SESSION['fullname']);
?>
