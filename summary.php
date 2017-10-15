<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>
<?php 
if(!isset($_SESSION['fullname']) || !isset($_SESSION['email']) ){
  echo "<script> window.location.replace('index.php') </script>";
   exit;
}
?>


<?php


// specify your email here

    $to = $_SESSION['email'];
	$from = 'Gentspack.com';
   
	
    // $message_human = $_POST['message_human'];
	// Construct subject of the email
	$subject = 'GentsPack Order ' . $name;

	//$body_message = "Weldone manan" ;
	$manan ='<html>  
	<head>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	
    <style type="text/css">
       
        hr {border-top:1px solid #e7e7e7;margin-top: 10px;margin-bottom:40px;}
        .forms {background: #fff;margin-top: 40px;margin-bottom: 40px;border-radius: 20px;}
        .forms h4 {margin-top:0px;margin-bottom:10px;}
        .forms span {background:#FF8ACC;color:#fff;padding:5px;}
        .table {margin-top:60px;}
        th,td {vertical-align: middle !important;}
        .next-sec {margin-top: 80px;margin-bottom: 60px;}
        .next-sec h4 {margin-bottom: 15px;}
        .next-sec hr {margin-top: 20px;margin-bottom: 5px;width: 250px;margin-right: 0px;}
        @media(min-width:768px){.align-right{text-align: right;}}
    </style>

</head>

<body>  ';   
          
		   
								//$order_id = 1;
								$order_id  = $_SESSION['gentspack'];
							   $tb_select = "SELECT * FROM order_tb WHERE id = {$order_id} order by id desc  ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
							   $order_id = $row['0'];
							   $customer_name = $row['2'];
							   $customer_phone = $row['3'];
							   $contact_info = $row['5'];
							   $order_date = $row['6']."  ".$row['7'] ;
							   $total_amount = $row['8'];
							   $order_status = $row['10'];
							   }
										
      $manan .='
    <div class="container forms">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="pull-right">
                    <h3>Invoice #'.$order_id .'</h3>
                </div>
                <div class="clearfix"></div>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="pull-right">
                    <h5><strong>Order Date: </strong> '.$order_date.'</h5>
                    <h5><strong>Order Status:</strong> <span> '.$order_status.'</span></h5>
                    <h5><strong>Order ID:</strong> # '.$order_id.'</h5>
                </div> 
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table class="table table-responsive">
                    <thead>
					
                        <tr>
                            <th>#</th>
                            <th>Item</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Unit Cost</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>';
					
					
												 $i = 1;
												 ########################### ORDER QUERY ####################################
											   $tb_select_order = "SELECT * FROM order_product_tb WHERE order_id = {$order_id} order by id desc  ";
											   $result_order = mysqli_query($connect,$tb_select_order);
											   if(!$result_order){
											   die ("SELECT TABLE FAILED".mysqli_error());
											   }
											   while($row_order = mysqli_fetch_array($result_order)){
											   $product_id = $row_order['2'];
											   $quantity = $row_order['1'];
											   
											  #######################  PRODUCT QUERY #############################
											   $tb_select_product = "SELECT * FROM product_tb WHERE id = {$product_id} order by id desc  ";
											   $result_product = mysqli_query($connect,$tb_select_product);
											   if(!$result_product){
											   die ("SELECT TABLE FAILED".mysqli_error());
											   }
											   while($row_product = mysqli_fetch_array($result_product)){
												  
											 
						$manan .='									
                        <tr>
                            <th scope="row">'.$i.'</th>
                            <td>'. $row_product['1'].'</td>
                            <td><img src="http://gentspack.effectstudiosgh.com/'.$row_product['image'].'" width="50px" height="50px" class="img-responsive"></td>
                            <td>'. $quantity.'</td>
                            <td>X'; 
							
                                                                $total_quantity = $quantity + $total_quantity;
																
																if($row_product['sale_price'] != 0){
																$unit_price = $row_product['sale_price'];
																$unit_price = number_format($unit_price, 2);
															$manan .= $unit_price;
																
																}else{
																$unit_price = $row_product['regular_price'];
																$unit_price = number_format($unit_price, 2);
																$manan .= $unit_price;
																
																}
																
							$manan .='
							
							</td>
                            <td>';
																if($row_product['sale_price'] != 0){
																$total_price = $row_product['sale_price'] * $quantity;
																$total_price = number_format($total_price, 2);
																
																}else{
																
																$total_price = $row_product['regular_price'] * $quantity;
																$total_price = number_format($total_price, 2);
																
																}
																$manan .= $total_price;
																
						$manan .='										
						</td>
                        </tr>';
						
						                     

															} // end of product list
															$i++;
															} // end of order list
															
                        
               $manan .='        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row next-sec">
        	<div class="col-lg-4 col-md-4 col-sm-6 hidden-xs">
        		<h4><strong>PAYMENT TERMS AND POLICIES</strong></h4>
        		<p>All accounts are to be paid within 7 days from receipt of Invoice. To be paid by cheque or credit card or direct payment online. If account is not paid within 7days the credits details supplied as confirmation of work undertaken will be charged the agreed quoted fee noted above.</p>
        	</div>
        	<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 align-right">
        		<h4><strong>Total Quantity:</strong>'. $total_quantity.'items</h4>
        		<h4><strong>Sub-total:</strong>';
												
												$total_amount = number_format($total_amount, 2);
												$manan .= $total_amount;
												
										
				$manan .='</h4>
        		<h4><strong>Discount:</strong> 0% </h4>
        		<h4><strong>VAT:</strong> 0% </h4>
        		<hr>
        		<h3><strong>GHC '.$total_amount.'</strong></h3>
        	</div>
        </div>    
    </div>

</body>

</html>';


	// Construct headers of the message
    $headers = 'From: ' . $from . "\r\n";
	//$headers .= 'Reply-To: ' . $from . "\r\n";
	$headers = "Content-Type: text/html; charset=UTF-8\r\n";
	
	$mail_sent = mail($to, $subject, $manan, $headers);
	
     ?>	
	

<!DOCTYPE html>
<html>
	<head>
		
		<!-- Website Title & Description for Search Engine purposes -->
		<title>Gents Pack - Checkout Summary</title>
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
		
	</head>
	<body class="white">

	<!-- NAVIGATION -->
	<?php  require_once("includes/header.php");?>
	<!-- NAVIGATION -->

	<header class="bg-2">
		<div class="content-inner">
			<div class="inside">
				<h2><strong>CHECKOUT SUMMARY</strong></h2>
			</div>	
		</div>
	</header>

	<div class="container summary" style="padding-top: 120px; padding-bottom: 60px;">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
				<h3>MY LOGO</h3>
				<div align="center"> <img src="images/success.png" style="width:100px;height:100px;"></div>
				
				<h1>Your order is on its way</h1>
				<img src="images/summary.png" class="img-responsive" style="margin-left: auto; margin-right: auto; margin-top: 10px; margin-bottom: 10px;">
				Yatta!! <strong><?php echo $_SESSION['fullname'] ;?></strong>,  Your Have Successfully Ordered Our Product(s).<br/> Our Team will Get Intouch With You.<br/>
				Thank You!.
			</div>
		</div>
	</div>
   <!--
	<div class="container sum" style="padding-bottom: 120px;">
		<div class="row">
			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<table class="table table-responsive" style="margin-top: 20px; margin-bottom: 60px;">
							<thead>
								<tr style="text ">
									<th>PRODUCT</th>
									<th>PRICE</th>
									<th>QUANTITY</th>
									<th>TOTAL</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="clearfix">
										<ul>
											<li><img src="images/cart-thumb.jpg" class="img-responsive"></li>
											<li><strong>Socks</strong></li>
										</ul>
									</td>
									<td>575.00</td>
									<td>
										<form class="form-group">
											<p><strong>1</strong></p>
										</form>
									</td>
									<td>575.00</td>
								</tr> 
								<tr>
									<td class="clearfix">
										<ul>
											<li><img src="images/cart-thumb.jpg" class="img-responsive"></li>
											<li><strong>Socks</strong></li>
										</ul>
									</td>
									<td>575.00</td>
									<td>
										<form class="form-group">
											<p><strong>1</strong></p>
										</form>
									</td>
									<td>575.00</td>
								</tr> 
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-ms-6 col-sm-6 col-xs-12 section-3 no-pad">
						<div class="well well-2 border-right" style="min-height: 155px; border-right: 1px solid #e3e3e3 !important;">
					 		<p class="small clearfix" style="padding-top: 15px;">
					 			<span style="float:left;">Subtotal</span>
					 			<span style="float:right;">575.00</span>
					 		</p>
					 		<hr>
					 		<p class="small clearfix">
					 			<span style="float:left;">Shipping</span>
					 			<span style="float:right;">Free Shipping</span>
					 		</p>
					 		<hr>
					 		<p class="small clearfix">
					 			<span style="float:left;">Total</span>
					 			<span style="float:right;">575.oo</span>
					 		</p>
					 	</div>
					</div>
					<div class="col-lg-6 col-ms-6 col-sm-6 col-xs-12 section-3 no-pad">
						<div class="well well-2 border-left" style="min-height: 155px; border-left: 1px solid #e3e3e3 !important;">
					 		<h3 style="color: #ffffff;">Your order has been shipped to:</h3>
					 		<p style="color: #ffffff;">23, Karneshie First Light, Accra, Ghana.</p>
					 	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
   -->
   <?php ?>
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
<?php
unset($_SESSION["cart_product"]);
unset($_SESSION['gentspack']);
unset($_SESSION['fullname']);
unset($_SESSION['email']);
unset($_SESSION['items']);
?>

