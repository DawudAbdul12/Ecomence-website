<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>
<!DOCTYPE html>
<html>
	<head>
		
		<!-- Website Title & Description for Search Engine purposes -->
		<title>Gentspack - Contact</title>
		<meta name="description" content="">
		
		<!-- Mobile viewport optimized -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-glyphicons.css" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link href="css/global-styles.css" rel="stylesheet">
		<link href="css/promotion-styles.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
		<link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		
		<!-- Include Modernizr in the head, before any other Javascript -->
		<script src="js/modernizr-2.6.2.min.js"></script>
		
		<!-- FOR ADD TO CART --> 
		<script type="text/javascript" src="jquery.js"></script> 
	    <script type="text/javascript" src="JS/echo.js"></script> 
		<script type="text/javascript" src="add_cart.js"></script> 
		
	</head>
	<body class="black">

     <!-- NAVIGATION -->
	<?php  require_once("includes/header.php");?>
	<!-- NAVIGATION -->

	<header class="bg-3">
		<div class="content-inner">
			<div class="inside">
				<h2><strong>CONTACT US</strong></h2>
			</div>	
		</div>
	</header>

	<div class="contact-area">
		<div class="container-fluid">
			<div class="row flex">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad contact-info">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
							<img src="images/address.png" class="img-responsive" style="margin-left:auto;margin-right:auto;">
							<h3>ADDRESS</h3>
							<p>Somewhere in Accra</p>
							<p>1st Floor</p>
							<p style="margin-bottom:30px;">Osu, Accra</p>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
							<img src="images/phone.png" class="img-responsive" style="margin-left:auto;margin-right:auto;">
							<h3>PHONE</h3>
							<p style="margin-bottom:30px;">+233(0)334412345</p>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
							<img src="images/email.png" class="img-responsive" style="margin-left:auto;margin-right:auto;">
							<h3>EMAIL</h3>
							<p style="margin-bottom:30px;">gentspack@gmail.com</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 no-pad bg-grey">
					<BLOCKQUOTE>	
						<h2>SEND US A MESSAGE</h2>
						<p>Do not hesitate to send us a message. We are really looking forward to hearing from you</p>
					</BLOCKQUOTE>	
					<form class="form-horizontal">
						<div class="form-group">
							<div class="col-lg-12">
                            	<input id="form_name" type="text" name="name" class="form-control" placeholder="Your Name">
                            </div>	
						</div>
						<div class="form-group">
							<div class="col-lg-12">
                            	<input id="form_email" type="email" name="email" class="form-control" placeholder="Email address">
                            </div>	
						</div>
						<div class="form-group">
							<div class="col-lg-12">
                            	<input id="form_number" type="text" name="number" class="form-control" placeholder="Mobile Number">
                            </div>	
						</div>
						<div class="form-group">
							<div class="col-lg-12">
		                    	<textarea name="message" placeholder="Enter Message" class="form-control" rows="4"></textarea>
		                    </div>	
		                </div>
		                <button class="form-btn">SUBMIT</button>
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

