<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>


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
		<link href="css/index-styles.css" rel="stylesheet">
		<link href="css/carousel-styles.css" rel="stylesheet">
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
	<body class="index">
	
	<!-- NAVIGATION -->
	<?php  require_once("includes/header.php");?>
	<!-- NAVIGATION -->
      
                        <?php 
	                          $tb_select = "SELECT * FROM slider_tb ORDER by id DESC ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							    $num = 0;

							   ?>
	              

	<div class="carousel slide" id="myCarousel1" data-interval="5000" data-ride="carousel">
		<div class="carousel-inner">
                        <?php
							   while($row_slider = mysqli_fetch_array($result)){
		
							    ?>

            <?php if($num == 0){?>

           <div class="item active">
				<div class="fill">
	<div class="fill" style="background-image:  url(<?php echo $row_slider['image'];?>);"></div>
				</div>
			</div>

			<?php }else{ ?>
			
			<div class="item">
				<div class="fill" style="background-image:  url(<?php echo $row_slider['image'];?>);"></div>
			</div>
          <?php } ?>

	
			<?php 
             $num = $num + 1;
			}

			?>

		</div>

		<a data-slide="prev" href="#myCarousel1" class="left carousel-control"><i class="fa fa-angle-left "></i></a>
        <a data-slide="next" href="#myCarousel1" class="right carousel-control"><i class="fa fa-angle-right "></i></a>
	</div><!--End of Carousel--> 


	<div class="container section-1">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h3>FEATURED PRODUCTS</h3>
				<hr class="section-rule">
			</div>
		</div>
		<div class="row flex">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="ih-item square effect6 from_top_and_bottom">
					<div class="img">	
						<img src="images/bck1.jpg" class="img-responsive">
					</div>	
					<div class="info">
						<h3>SOCKS</h3>
					</div>	
				</div>	
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="row flex">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="ih-item square effect6 from_top_and_bottom">
							<div class="img">	
								<img src="images/bck2.jpg" class="img-responsive">
							</div>	
							<div class="info">
								<h3 style="font-size: 14px;">LONG TIES</h3>
							</div>	
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="ih-item square effect6 from_top_and_bottom">
							<div class="img">	
								<img src="images/bck3.jpg" class="img-responsive">
							</div>	
							<div class="info">
								<h3 style="font-size: 14px;">LAPEL FLOWER</h3>
							</div>	
						</div>	
					</div>


				</div>
				<div class="row flex">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 base">
						<div class="ih-item square effect6 from_top_and_bottom">
							<div class="img">	
								<img src="images/bck2.jpg" class="img-responsive">
							</div>	
							<div class="info">
								<h3 style="font-size: 14px;">LONG TIES</h3>
							</div>	
						</div>	
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 base">
						<div class="ih-item square effect6 from_top_and_bottom">
							<div class="img">	
								<img src="images/bck3.jpg" class="img-responsive">
							</div>	
							<div class="info">
								<h3 style="font-size: 14px;">BOW TIE</h3>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container section-2">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h3>MOST POPULAR</h3>
				<hr class="section-rule">
				<!--<p class="small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>-->
			</div>
		</div>
		<div class="row">
          <!--######### PHP CODE #######-->
					           <?php 
	                          $tb_select = "SELECT * FROM product_tb ORDER by id DESC limit 0,4";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_new = mysqli_fetch_array($result)){
							  
							    ?>

			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center margin-but set-height1" id="<?php echo $row_new['ID']; ?>">
		<!--product image with hover change  -->
			   <div class="imageBox">
	           <div class="imageInn">
			    <?php 
				$encryp_product_id = my_simple_crypt($row_new['ID'], 'e' );
			$prod_id = $row_new['ID'];
				?>
			   <a href="product.php?product_id=<?php echo $encryp_product_id ;?>">
	           <img src="<?php echo $row_new['image']; ?>" class="img-responsive" alt="Default Image">
			   </a>
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
			    <a href="product.php?product_id=<?php echo $encryp_product_id ;?>">
	           <img src="<?php echo $Hover_image;?>" class="img-responsive"alt="Profile Image">	 
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
                

                <?php } ?>
		<!--######### PHP CODE #######-->


		</div>
	</div>

	<div class="section-3">
		<div class="container">
			<div class="row text-center">
			   
				<h3 class="paddown">COMMERCIALS</h3>
		 <?php
								
				// This sets the range of rows to query for the chosen $pagenum
				//$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
				// This is your query again, it is for grabbing just one page worth of rows by applying $limit
				              $limit = "limit 0,3";
				               $status = "Yes";
				               $tb_select = "SELECT * FROM lifestyle_tb WHERE published = '{$status}' ORDER BY id DESC $limit";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
							  
							   ?>
							   
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-bot">
					<img src="<?php echo $row['pic'];?>" class="img-responsive">
					<h3><?php 
					
						 $str = strip_tags($row["title"]);
						 
							  if(strlen($str)> 20){
							  
							 $str = substr($str,0,20)."<span style=\"font-size:9px\"> ...</span>";
							 
							echo $str;
							
							}elseif(strlen($str) <= 20){
							
							echo $str;
							
							}
					
					?></h3>
					
					
					<p> <?php 
					
					                      $str_content = strip_tags($row["content"]);
										 
											  if(strlen($str_content)> 130){
											  
											 $str_content = substr($str_content,0,130)." ...";
											 
											echo $str_content;
											
											}elseif(strlen($str_content) <= 130){
											
											echo $str_content;
											
											}
					
					
					?> </p>
					<?php if(!empty($row['link'])){?>
					<a href="<?php echo $row['link']; ?>" target="_blank"> LEARN MORE</a>
					<?php }else{}?>
				</div>
				
				<?php }?>
				
				<!--<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 down">
					<img src="images/index1.jpg" class="img-responsive">
					<h5>MY CHEST</h5>
					<p  class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore </p>
				</div>
				
				
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 down">
					<img src="images/index2.jpg" class="img-responsive">
					<h5>INSIDE MY CHEST</h5>					
					<p  class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore </p>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 down">
					<img src="images/index3.jpg" class="img-responsive">
					<h5>MY CHEST</h5>	
					<p  class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore </p>
				</div> -->
			</div>
		</div>
	</div>




	<div class="container section-2">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h4>LATEST POSTS</h4>
				<hr class="section-rule">
				<!--<p class="small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>-->
			</div>
		</div>
		<div class="row">
		
		 <?php
								
				// This sets the range of rows to query for the chosen $pagenum
				//$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
				// This is your query again, it is for grabbing just one page worth of rows by applying $limit
				               $limit = "limit 0,3";
				               $status = "Yes";
				               $tb_select = "SELECT * FROM blog_tb WHERE published = '{$status}' ORDER BY id DESC $limit";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
							  
							   ?>
							   
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-bot">
					<img src="<?php echo $row['pic'];?>" class="img-responsive">
					<h3><?php 
					
						 $str = strip_tags($row["title"]);
						 
							  if(strlen($str)> 20){
							  
							 $str = substr($str,0,20)."<span style=\"font-size:9px\"> ...</span>";
							 
							echo $str;
							
							}elseif(strlen($str) <= 20){
							
							echo $str;
							
							}
					
					?></h3>
					<p class="small"><span style="text-transform: uppercase;">POSTED BY <?php echo $row['posted_by'];?> | <?php  echo date('M d Y',strtotime($row['date'])); ?></span></p>
					
					<p> <?php 
					
					                      $str_content = strip_tags($row["content"]);
										 
											  if(strlen($str_content)> 130){
											  
											 $str_content = substr($str_content,0,130)." ...";
											 
											echo $str_content;
											
											}elseif(strlen($str_content) <= 130){
											
											echo $str_content;
											
											}
					
					
					?> </p>
					<?php $encryp_news_id = my_simple_crypt($row['id'], 'e' );?>
					<a href="single_news.php?news=<?php echo $encryp_news_id ;?>">READ MORE</a>
				</div>
				
				<?php }?>
		
				<!--<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 down">
					<img src="images/index1.jpg" class="img-responsive">
					<h4>MY CHEST</h4>
					<p class="lead">POSTED BY YAW | APRIL 26 2017</p>
					<p class="spec">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore</p>
					<a href="#">READ MORE</a>
				</div>-->
				
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

