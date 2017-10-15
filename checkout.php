<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>
<?php
/*********************************************************************************************/
		/************************    FOR INSERT BRAND   ***********************/
/*********************************************************************************************/
             
			 
    if(isset($_POST['submit'])){
     $errors = array();
	$fullname = mysqli_real_escape_string($connect,$_POST['fullname']);
	//$billing_last_name = mysqli_real_escape_string($connect,$_POST['billing_last_name']);
	//$billing_company = mysqli_real_escape_string($connect,$_POST['billing_company']);
	$email = mysqli_real_escape_string($connect,$_POST['email']);
	$phone = mysqli_real_escape_string($connect,$_POST['phone']);
	$phone1 = mysqli_real_escape_string($connect,$_POST['phone1']);
	$address = mysqli_real_escape_string($connect,$_POST['address']);
	$address_1 = mysqli_real_escape_string($connect,$_POST['address_1']);
	$city = mysqli_real_escape_string($connect,$_POST['city']);
	$date = $_POST['date'];
	
	
	$total_item = mysqli_real_escape_string($connect,$_POST['total_items']);
	$total_amount = mysqli_real_escape_string($connect,$_POST['total_amount']);
	$time = $_POST['time'];
	$payment_method = mysqli_real_escape_string($connect,$_POST['payment_method']);
	$quantity = mysqli_real_escape_string($connect,$_POST['quantity']);
	
	// CHECK TO SEE WHETHER IT EXIST OR NOT
	 $query="SELECT *  ";
	 $query.=" FROM customer_tb  ";
	 $query.=" WHERE fname = '{$fullname}'  "; 
	 $query.=" AND  phone = '{$phone}' "; 
	 $query.=" AND  email = '{$email}' "; 
     $result_set = mysqli_query($connect,$query);
    if(!$result_set){
				 die("Database connection failed: ".mysqli_error($connect));
							}
    if(mysqli_num_rows($result_set) == 1){
	$found_user = mysqli_fetch_array($result_set);
	$client_id = $found_user['0'];
	
	$message = "<strong ><span class=\"label label-danger\"> Please the record already Exist </span></strong>".mysqli_error($connect);
	
	}else{
	 
	if(empty($errors)){
    
	// check and see whether image is empty
	
	$query ="INSERT INTO customer_tb(fname,address,address1,city,email,phone,phone1,date)
		           VALUES ('{$fullname}','{$address}','{$address1}','{$city}','{$email}','{$phone}','{$phone1}','{$date}')";
  $check = mysqli_query($connect,$query);
   if($check){
       // START GET THE CUSTOMER ID CODE
	   $query="SELECT *  ";
	 $query.=" FROM customer_tb  ";
	 $query.=" WHERE fname = '{$fullname}'  "; 
	 $query.=" AND  phone = '{$phone}' "; 
	 $query.=" AND  email = '{$email}' "; 
     $result_set = mysqli_query($connect,$query);
    if(!$result_set){
				 die("Database connection failed: ".mysqli_error($connect));
							}
    if(mysqli_num_rows($result_set) == 1){
	$found_user = mysqli_fetch_array($result_set);
	$client_id = $found_user['0'];
	}
	
      // END GET THE CUSTOMER ID CODE
	  
   $message = "<strong><span class=\"label label-success\">{$client_id}Please You Have Successfully Added New Record </span></strong>".mysqli_error($connect);
 
  }  else{
	 echo "upload failed!".mysqli_error($connect);
	  $message = "<strong><span class=\"label label-danger\"> upload failed! </span></strong>".mysqli_error($connect);
	}
     

} // end of errors


}// end of submit

   #### CODE FOR ORDER TABLE ####
   if($client_id != ""){
     ##### FOR INSERTING VALUES IN THE DATA BASE ####
     $fullname;
	 $_SESSION['fullname'] = $fullname;
	 $ship_to = $address." ".$address1;
	 $payment_method = "Cash On Delivery";
	  $complete_status = "Pending";
     $query ="INSERT INTO order_tb(customer_id,customer_name,phone_number,quantity,ship_to,date,time,totalmount,payment_method,complete_status)
		           VALUES ('{$client_id}','{$fullname}','{$phone}','{$total_item}','{$ship_to}','{$date}','{$time}','{$total_amount}','{$payment_method}','{$complete_status}')";
     $check = mysqli_query($connect,$query);
	 ##### END FOR INSERTING VALUES IN THE DATA BASE ####
	 
	 ##### CODE TO RETRIVE ORDER ID FROM THE DATABASE FOR PRODUCT PROCESSING ####
	 
	 // START GET THE CUSTOMER ID CODE
	   $query="SELECT *  ";
	 $query.=" FROM order_tb  ";
	 $query.=" WHERE customer_id = '{$client_id}'  "; 
	 $query.=" AND  customer_name = '{$fullname}'  "; 
	 $query.=" AND  date = '{$date}' "; 
	 $query.=" AND  time = '{$time}' "; 
     $result_set = mysqli_query($connect,$query);
    if(!$result_set){
				 die("Database connection failed: ".mysqli_error($connect));
							}
    if(mysqli_num_rows($result_set) == 1){
	$found_user = mysqli_fetch_array($result_set);
	$order_id = $found_user['0'];
	$_SESSION['Doppio'] =$found_user['0'];
	}
	
     ##### END CODE TO RETRIVE ORDER ID FROM THE DATABASE FOR PRODUCT PROCESSING ####
	 }
	#### END OF ORDER TABLE ####
 
 # CODE FOR ORDER PRODUCTS 
 if($client_id != ""){
if(!isset($_SESSION["cart_product"]) || count($_SESSION["cart_product"])< 1){

 
}else{
 $i =0;
foreach($_SESSION["cart_product"] as  $each_item){
$item_id = $each_item['item_id'];
$quantity = $each_item['quantity'];

   $client_id;
   $query ="INSERT INTO order_product_tb(quantity,product_id,client_id,order_id)
		           VALUES ('{$quantity}','{$item_id }','{$client_id}', '{$order_id}')";
   $check = mysqli_query($connect,$query);
}

}

}// END OF ORDER SCRIPT


echo "<script> window.location.replace('complete_order.php') </script>";

//$message = "<strong><span class=\"label label-success\">{$client_id} | {$order_id} Please You Have Successfully Added New Record </span></strong>".mysqli_error($connect);

//  END OF SUBMIT
}
/*********************************************************************************************/
				/***************** 		END ADD BRAND 	***********************/
  /*********************************************************************************************/




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
                        <div class="title">1.Delivery Address (Enter Your Delivery information and we will get back to you)
						<p><?php If(!empty($message)){
					echo $message;
					}
					?></p>
						</div>
                        <div class="step2">
                            <div class="row">
							<form  action="checkout.php"  method="post" enctype="multipart/form-data" >
                                <div class="col-sm-6">
                                    <h3> Delivery Address</h3>
                                    <div class="input-box">
                                        <label>Full Name</label>
                                        <input type="text" required name="fullname">
                                    </div>
                                    <div class="input-box">
                                        <label>Address </label>
                                        <input type="text" required name="address">
                                    </div>
                                    <div class="input-box">
                                        <label>Address Line 2</label>
                                        <input type="text" name="address_1">
                                    </div>
                                    <div class="input-box">
                                        <label>City </label>
                                        <input type="text" required name="city">
                                    </div>
                                    <!-- <div class="input-box">
                                        <label>State </label>
                                        <input type="text">
                                    </div> -->
                                    <div class="input-box">
                                        <label>Email Address </label>
                                        <input type="text" required name="email">
                                    </div>
                                    <div class="input-box">
                                        <label>Mobile Number </label>
                                        <input type="text" required name="phone">
                                    </div>
									<div class="input-box">
                                        <label>Other Mobile Number </label>
                                        <input type="text" name="phone1">
                                    </div>
									
									 <input type="hidden" value="<?php echo date("Y-m-d");?>"  name="date">
			                         <input type="hidden" value="<?php echo date("h:m:s");?>"  name="time">
									
                                </div>
								
                                
                            </div>
                            <!-- <div class="check-slide">
                                <label for="checkbox-01" class="label_check"><input type="checkbox" value="1" id="checkbox-01" name="sample-checkbox-01">Use different address for billing</label>
                            </div> -->
                            <!--<div class="submit-box">
                                <input type="submit" value="Deliver to this address" class="btn-yellow">
                            </div>-->
                        </div>
                    </div>
                    <div class="step-box">
                        <div class="title">2. Review Order</div>
                        <div class="step3">
                            <table class="order-table">
                                <tbody><tr>
                                <th>Item Details</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                </tr>
								
						<?php
							 $totalQty = 0;
							 $totalamount = 0;
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
									
									<td><div class="small-text">Subtotal</div>₵<?php 
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
								    <div class="sub-total">Quantity:<span> <?php echo $totalQty;?> items</span></div>
                                    <div class="sub-total">Total:<span>₵<?php
									$totalamount = number_format($totalamount, 2);
							      echo $totalamount;
							         ?></span></div>
                                    <div class="sub-total">Delivery Charges:<span>₵00.00</span></div>
                                    <div class="total">Total Amount <span>₵<?php echo $totalamount;?></span></div>
                                </div>
								 <input type="hidden" value="<?php echo $totalQty;?>"  name="total_items">
			                  <input type="hidden" value="<?php echo $totalamount;?>"  name="total_amount">	 
                                <div class="left-info">
                                    <div class="note">Review your order and select your delivery option</div>
                                    <div class="descount-box">
                                        <label>Have a promo code? <a href="javascript:;">Apply</a></label>
                                        <div class="descount-input">
                                            <input type="text" placeholder="Promo code">
                                            <input type="submit" value="Apply">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="Proceed-btn">
                                <button class="btn-yellow" name="submit">Proceed to checkout</button>
                            </div>
							</form>
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
