<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>
<?php

 if ($_SESSION['items'] < 5){
	 
	 echo "<script> window.location.replace('cart.php') </script>";
	 
 }else{
	 
   // $_SESSION['items'] = 0;
 }
/*********************************************************************************************/
		/************************    FOR INSERT BRAND   ***********************/
/*********************************************************************************************/
             
			 
    if(isset($_POST['submit'])){
    $errors = array();
	$fullname = mysqli_real_escape_string($connect,$_POST['fullname']);
	$sname = mysqli_real_escape_string($connect,$_POST['sname']);
	$company = mysqli_real_escape_string($connect,$_POST['company']);
	$email = mysqli_real_escape_string($connect,$_POST['email']);
	$phone = mysqli_real_escape_string($connect,$_POST['phone']);
	$phone1 = mysqli_real_escape_string($connect,$_POST['phone1']);
	$country = mysqli_real_escape_string($connect,$_POST['country']);
	$address = mysqli_real_escape_string($connect,$_POST['address']);
	$address_1 = mysqli_real_escape_string($connect,$_POST['address_1']);
	$city = mysqli_real_escape_string($connect,$_POST['city']);
	$state = mysqli_real_escape_string($connect,$_POST['state']);
	$zip_code = mysqli_real_escape_string($connect,$_POST['zip_code']);
	$date = $_POST['date'];

	
	$total_item = $_POST['total_items'];
	$total_amount = $_POST['total_amount'];
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
	
$query ="INSERT INTO customer_tb(fname,sname,company,email,phone,phone1,country,address,address1,city,state,zip_code,date,time)
VALUES ('{$fullname}','{$sname}','{$company}','{$email}','{$phone}','{$phone1}','{$country}','{$address}','{$address1}','{$city}','{$state}','{$zip_code}','{$date}','{$time}')";

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
	 $ship_to = $address." ".$address_1;
	 $payment_method = $_POST['payment_type'];;
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
	$_SESSION['gentspack'] = $found_user['0'];
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

$_SESSION['email'] = $email;

if($payment_method == "Mpower"){

echo "<script> window.location.replace('mpower.php') </script>";
}else{
	
	echo "<script> window.location.replace('summary.php') </script>";
	
}
//$message = "<strong><span class=\"label label-success\">{$client_id} | {$order_id} Please You Have Successfully Added New Record </span></strong>".mysqli_error($connect);

//  END OF SUBMIT
}
/*********************************************************************************************/
				/***************** 		END ADD BRAND 	***********************/
  /*********************************************************************************************/




?>
<!DOCTYPE html>
<html>
	<head>
		
		<!-- Website Title & Description for Search Engine purposes -->
		<title></title>
		<meta name="description" content="">
		
		<!-- Mobile viewport optimized -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-glyphicons.css" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link href="css/global-styles.css" rel="stylesheet">
		<link href="css/checkout-styles.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
		<link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="css/ihover.css" rel="stylesheet">
		
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

	<header class="bg-3">
		<div class="content-inner">
			<div class="inside">
				<h2><strong>CHECKOUT</strong></h2>
			</div>	
		</div>
	</header>

	<div class="checkout-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<h2><strong>CHECKOUT</strong></h2>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<h3>Billing Details</h3>
					<hr class="check-rule">
					<hr class="check-rule1">
					<form action="check-out.php" Method="Post" >
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">
								<label>First Name *</label>
								<input type="text" name="fullname" class="form-control" required >
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">
								<label>Last Name *</label>
								<input type="text" name="sname" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label>Company Name</label>
							<input type="text" name="company" class="form-control">
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">
								<label>Email Address *</label>
								<input type="email" name="email" class="form-control" required>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">
								<label>Phone Number*</label>
								<input type="text" name="phone" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label>Other Phone Number</label>
							<input type="text" name="phone1" class="form-control">
						</div>
						
						<div class="checkbox">
						 	<label><input type="checkbox" value=""><strong>Delivery address same as billing</strong></label>
						</div>
					
				</div>
				
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<h3>Address Details</h3>
					<hr class="check-rule">
					<hr class="check-rule1">
					<div class="form-group">
							<label>Country *</label>
							<input type="text" name="country" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address *</label>
							<input type="text" name="address" class="form-control" placeholder="Street address" required>
							<input type="text" name="address_1" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
						</div>
						<div class="form-group">
							<label>Town / City *</label>
							<input type="text" name="city" class="form-control" required>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">
								<label>State / County</label>
								<input type="text" name="state" class="form-control">
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 form-group">
								<label>Postcode / ZIP</label>
								<input type="text" name="zip_code" class="form-control">
							</div>
						</div>
						 <input type="hidden" value="<?php echo date("Y-m-d");?>"  name="date">
			                         <input type="hidden" value="<?php echo date("h:m:s");?>"  name="time">
					
				</div>
			</div>
			
			
			
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h3>Your Order</h3>
					<hr class="check-rule1">
					<table class="table .table-responsive">
						<thead>
						   	<tr>
						    	<th>Product</th>
						    	<th>Quantity</th>
						    	<th>Unit Price</th>
						    	<th>Total Price</th>
							</tr>
						</thead>
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
						<td><strong><?php echo $row["product_name"];?></strong></td>
						
						<td><strong><?php echo $quantity;?></strong></td>
						 <td><strong>&#8373;
								<?php if($row["sale_price"] == 0){?>
								<?php 
								
								$unit_price = $row["regular_price"];
								$unit_price = number_format($unit_price, 2);
								echo $unit_price;
								 $subtotal = $quantity *  $row["regular_price"];
								
								?></strong></td>
								
								<?php  }else{?>
								<?php 
								$unit_price = $row["sale_price"];
								$unit_price = number_format($unit_price, 2);
								echo $unit_price;
								$subtotal = $quantity *  $row["sale_price"];
								?></td>
								<?php }?>
								
						<td><strong>&#8373;<?php 
									$total_sub = $subtotal;
								$total_sub = number_format($total_sub, 2);
								echo $total_sub;
								
								$subtotal;
									
									?></strong></td>
						
						</tr>
						<?php 
						
						       $totalamount = $subtotal + $totalamount;
			                    $totalQty = $totalQty + $quantity;
						
						}
						}
						}
						
						?>
						<input type="hidden" value="<?php echo $totalamount;?>"  name="total_amount">	 
					  	<tbody>
					    	<tr>
					      		<th scope="row"><strong>Subtotal</strong></th>
					      		<td></td>
					      		<td></td>
					      		<td><strong>&#8373; <?php $totalamount = number_format($totalamount, 2); echo $totalamount; ?></strong></td>
					    	</tr>
					    	<tr>
					      		<th scope="row"><strong>Shipping</strong></th>
							    <td></td>
							    <td></td>
							    <td><strong>&#8373; 0.00</strong></td>
					    	</tr>
					    	<tr>
					      		<th scope="row"><strong>Total</strong></th>
					      		<td></td>
					      		<td></td>
					      		<td><strong>&#8373; <?php echo $totalamount; ?></strong></td>
					    	</tr>
					  	</tbody>
					</table>
					<input type="hidden" value="<?php echo $totalQty;?>"  name="total_items">
			                  
					<div class="radio">
						<label><input type="radio" name="payment_type" checked value="Cash on Delivery"><strong>Cash on Delivery</strong></label>
					</div>
					<div class="well">
						<h5>Pay with cash upon delivery</h5>
					</div>
					<div class="radio clearfix">
						<label class="pull-left"><input type="radio" name="payment_type" value="Mpower"><strong>Mpower</strong></label>
						<img src="images/pay.png" class="img-responsive pull-right">
					</div>
					<div class="well">
						<h5>Pay via Mpower; you can pay with your credit card ,Visa card, Mobile money if you don’t have a mpower account.</h5>
					</div>
					<button class="btn btn-block" name="submit" type="submit">PLACE ORDER</button>
					</form>
				</div>
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

