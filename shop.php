<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<?php
							$status = "Yes";
							
							if(isset($_GET['category'])){
							
	                        $category =  $_GET['category'];
	                        $category_id = my_simple_crypt( $category, 'd');
							
				                // This first query is just to get the total count of 
					 $tb_select = "SELECT COUNT(id) FROM product_tb WHERE  category = '{$category_id}' AND publish = '{$status}'";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error($connect));
							   }
							   
                                }else{
								
					          // This first query is just to get the total count of 
					           $tb_select = "SELECT COUNT(id) FROM product_tb WHERE publish = '{$status}'";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error($connect));
							   }
							   
								   }// END OF IF STATEMENT
	
                             // This first query is just to get the total count of 
							   $row = mysqli_fetch_array($result);                       



// Here we have the total row count
$rows = $row[0];
// This is the number of results we want displayed per page
$page_rows = 12;
// This tells us the page number of our last page
$last = ceil($rows/$page_rows);
// This makes sure $last cannot be less than 1
if($last < 1){
	$last = 1;
}
// Establish the $pagenum variable
$pagenum = 1;
// Get pagenum from URL vars if it is present, else it is = 1
if(isset($_GET['pn'])){
	$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
	
}

// check and see whether the showing page number is more than the total page number
	$showing_product =  $pagenum * $page_rows;
	if($showing_product > $rows){
	$showing_product = $rows ;
	}else{
	$showing_product;
	}
	// check and see whether the showing page number is more than the total page number

// This makes sure the page number isn't below 1, or more than our $last page
if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}

// This shows the user what page they are on, and the total number of pages
$textline1 = "Product (<b>$rows</b>)";
$textline2 = "Showing <b>1 - $showing_product </b> of <b>$rows</b> results";
// Establish the $paginationCtrls variable
$paginationCtrls = '';
// If there is more than 1 page worth of results
if($last != 1){
	/* First we check if we are on page one. If we are then we don't need a link to 
	   the previous page or the first page so we do nothing. If we aren't then we
	   generate links to the first page, and to the previous page. */
	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		
		if(isset($category_id)){
		
		$paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?category='.$category.'&pn='.$previous.'"> <i class="fa fa-chevron-left"></i></a></li>';
		
		}else{
		$paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'"> <i class="fa fa-chevron-left"></i></a></li>';
		}
		
		
		// Render clickable number links that should appear on the left of the target page number
		if(isset($category_id)){
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?category='.$category.'&pn='.$i.'">'.$i.'</a></li> ';
			}
	    }
		
		}else{
		
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a></li> ';
			}
	    }
		
		}
		
    }
	// Render the target page number, but without it being a link
	$paginationCtrls .= '<li class="active"><a >'.$pagenum.'</a></li>';
	// Render clickable number links that should appear on the right of the target page number
	for($i = $pagenum+1; $i <= $last; $i++){
	 
	 if(isset($category_id)){
		$paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?category='.$category.'&pn='.$i.'">'.$i.'</a></li> ';
		if($i >= $pagenum+4){
			break;
		}
		}else{
		
		$paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a></li> ';
		if($i >= $pagenum+4){
			break;
		}
		}// END OF IF
		
	}
	// This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
		
		if(isset($category_id)){
        $paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?category='.$category.'&pn='.$next.'"><i class="fa fa-chevron-right"></i></a></li> ';
		}else{
		$paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'"><i class="fa fa-chevron-right"></i></a></li> ';
		}// END OF IF
    }
}

?>
<!DOCTYPE html>
<html>
	<head>
		
		<!-- Website Title & Description for Search Engine purposes -->
		<title>Gentspack - Shop</title>
		<meta name="description" content="">
		
		<!-- Mobile viewport optimized -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-glyphicons.css" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link href="css/global-styles.css" rel="stylesheet">
		<link href="css/shop-styles.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
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

	<header class="bg-3">
		<div class="content-inner">
			<div class="inside">
				<h2><strong>SHOP</strong></h2>
			</div>	
		</div>
	</header>

	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
				<!--<div class="prod">
					<h4>FILTER SELECTION</h4>
					<hr>
					<div class="mid clearfix">
						<p>
							<span class="pull-left spec">Price:64-390</span>
							<span class="pull-right"><button class="btn3">FILTER</button></span>
						</p>
					</div>
				</div>-->
				<div class="prod">
					<h4>PRODUCT CATEGORIES</h4>
					<hr>
					<ul class="clearfix">
					<!-- CATEGORY --->
					 <?php 
							  $parent = 0;
	                          $tb_select = "SELECT * FROM category_tb WHERE parent = {$parent} ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_cat = mysqli_fetch_array($result)){
							   
							   $parent_id = $row_cat['0'];
							   
							   
							   //COUNT PRODUCT 

						     $tb_count = "SELECT count(ID) as total FROM product_tb WHERE category = {$parent_id} ";
							   $result_count = mysqli_query($connect,$tb_count);
							   if(!$result_count){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   $data = mysqli_fetch_assoc($result_count);
                               $total_product = $data['total'];
							  
                               // END OF COUNT PRODUCT							   
							   
							        ?>
									
<li>
<?php $encryp_category = my_simple_crypt($row_cat['0'], 'e' );?>
<?php if($category_id == $row_cat['0']){
$category_showig =  $row_cat['1'];
?>

<span class="pull-left"><?php echo $row_cat['1']; ?></span><span class="pull-right">(<?php echo $total_product;?>)</span>

<?php }else{?>

<a href="shop.php?category=<?php echo $encryp_category; ?>" ><span class="pull-left"><?php echo $row_cat['1']; ?></span><span class="pull-right">(<?php echo $total_product;?>)</span></a>

<?php }?>
</li>
						<hr>
						
						<?php }?>
					</ul>
				</div>
				<div class="prod">
					<h4>RECENT PRODUCTS</h4>
					<hr>
					<!--######### PHP CODE #######-->
					           <?php 
	                          $tb_select = "SELECT * FROM product_tb ORDER by id DESC limit 0,5";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_new = mysqli_fetch_array($result)){
							  
							    ?>
					<div class="clearfix mid">
				<?php $encryp_product_id = my_simple_crypt($row_new['ID'], 'e' );?>
				<a href="product.php?product_id=<?php echo $encryp_product_id; ?>">
						<img src="<?php echo $row_new['image']; ?>" width="100" class="img-responsive pull-left marg">
						</a>
						<p class="small"><?php echo $row_new['product_name']; ?></p>
						
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
						<div class="clearfix"></div>
						<hr>
						
					</div>
					
					<?php }?>
				
				</div>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
				<div class="row">
					<div class="col-lg-12">
						<form class="form-inline"> 
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<b>All <?php echo $category_showig; ?> Product(s)</b> | <label><?php echo $textline2;?></label>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="right flex">
									
									<!--
										<select class="form-control marg-right">
											<option>Default Sorting</option>
										</select>
										<select class="form-control marg-right">
											<option>12</option>
										</select>
										<button class="btn1 marg-right">
											<i class="fa fa-th-large"></i>
										</button>
										<button class="btn2">
											<i class="fa fa-bars"></i>
										</button>-->
									</div>	
								</div>	
							</div>
						</form>
					</div>
				</div>
				<div class="section-2">
					<div class="row">
						<!--######### PHP CODE #######-->
					           <?php 
			     // This sets the range of rows to query for the chosen $pagenum
				 $limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
				// This is your query again, it is for grabbing just one page worth of rows by applying $limit
							   
							   if(isset($category_id)){
	                          $tb_select = "SELECT * FROM product_tb WHERE category = '{$category_id}' ORDER by id DESC {$limit}";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_new = mysqli_fetch_array($result)){
							   $prod_id = $row_new['ID'];
							  
							  
							    ?>

			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center margin-but" id="<?php echo $row_new['ID']; ?>">
		<!--product image with hover change  -->
			   <div class="imageBox">
	           <div class="imageInn">
			   <?php $encryp_product_id = my_simple_crypt($row_new['ID'], 'e' );?>
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
	           <a href="product.php?product_id=<?php echo $encryp_product_id; ?>"><img src="<?php echo $Hover_image; ?>" class="img-responsive"alt="Profile Image"> </a>
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
                

                <?php }
				
				}else{
							  
							  $tb_select = "SELECT * FROM product_tb ORDER by id DESC {$limit}";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_new = mysqli_fetch_array($result)){
                                 $prod_id = $row_new['ID'];

					  ?>
		<!--######### PHP CODE #######-->
		
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center margin-but" id="<?php echo $row_new['ID']; ?>">
		<!--product image with hover change  -->
			   <div class="imageBox">
	           <div class="imageInn">
			   <?php $encryp_product_id = my_simple_crypt($row_new['ID'], 'e' );?>
				<a href="product.php?product_id=<?php echo $encryp_product_id; ?>">
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
			    <a href="product.php?product_id=<?php echo $encryp_product_id; ?>">
	           <img src="<?php echo $Hover_image; ?>" class="img-responsive"alt="Profile Image">
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
				
			}// end if
				
				?>
					</div>


				</div>

				<div class="row text-center">	
						<div class="col-md-12"> 
								<!-- panination -->
			<nav aria-label="Page navigation">
  <ul class="pagination">
  <?php echo $paginationCtrls; ?>
   <!-- <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li> -->
  </ul>
</nav>
	<!-- pagination -->
							</div>
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

