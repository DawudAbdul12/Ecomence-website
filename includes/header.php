<?php 
	//$link = $_SERVER['PHP_SELF'];
	//$link = basename(__FILE__);
	$link = basename($_SERVER['PHP_SELF']);
	
	
	?>
<!-- FOR NOTIFICATION-->
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
 <!-- FOR NOTIFICATION-->
 
<nav class="navbar navbar-default">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-2">
					<div class="navbar-header page-scroll">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="index.php" class="navbar-brand page-scroll">MY LOGO</a>
						<div class="col-xs-12 text-center visible-xs spec-ul">
							<ul>
								<li><a href="#"><i class="fa fa-search"></i></a></li>
								<li><a href="cart.php"><i class="fa fa-shopping-cart"><span id="total_items_mobile"></span> &#8373; <span id="total_Amt_mobile"></span></i></a></li>
								
							</ul>
						</div>	
					</div>
				</div>
				<div class="col-lg-5 col-md-6 col-sm-8 col-lg-offset-1 col-md-offset-1">	
					<div class="nav-collapse collapse navbar-responsive-collapse" id="mainNavBar">
						<ul class="nav navbar-nav">
							<li  <?php if($link == "index.php"){?> class="active" <?php }?> ><a href="index.php">HOME</a></li>
							<li <?php if($link == "shop.php" || $link == "product.php" ){?> class="active" <?php }?> ><a href="shop.php">STORE</a></li>
							<li <?php if($link == "lifestyle.php"){?> class="active" <?php }?> ><a href="lifestyle.php">LIFESTYLE</a></li>
							<li <?php if($link == "album.php" || $link == "gallery.php"){?> class="active" <?php }?> ><a href="album.php">GALLERY</a></li>
							<li <?php if($link == "blog.php" || $link == "single_news.php"){?> class="active" <?php }?> ><a href="blog.php">BLOG</a></li>
							<li <?php if($link == "contact.php"){?> class="active" <?php }?> ><a href="contact.php">CONTACT</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12 col-lg-offset-1  hidden-xs">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#"><i class="fa fa-search"></i></a></li>
						<li><a href="cart.php"><i class="fa fa-shopping-cart"> <span id="total_items"></span>
					&#8373; <span id="total_Amt"></span></i></a></li>
						
					</ul>
				</div>




			</div>
		</div>
	</nav>