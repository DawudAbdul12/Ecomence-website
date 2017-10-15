<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<?php
                                $status = "Yes";
								$feature = "Promotion";
          
								$tb_select = "SELECT COUNT(id) FROM product_tb WHERE publish = '{$status}' AND feature = '{$feature}' ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error($connect));
							   }
							   $row = mysqli_fetch_array($result);                       



// Here we have the total row count
$rows = $row[0];
// This is the number of results we want displayed per page
$page_rows = 8;
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
// This makes sure the page number isn't below 1, or more than our $last page
if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}

// This shows the user what page they are on, and the total number of pages
$textline1 = "Testimonials (<b>$rows</b>)";
$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
// Establish the $paginationCtrls variable
$paginationCtrls = '';
// If there is more than 1 page worth of results
if($last != 1){
	/* First we check if we are on page one. If we are then we don't need a link to 
	   the previous page or the first page so we do nothing. If we aren't then we
	   generate links to the first page, and to the previous page. */
	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		//$paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'"> <i class="fa fa-chevron-left"></i>    PREVIOUS </a></li>';
		// Render clickable number links that should appear on the left of the target page number
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a></li> ';
			}
	    }
    }
	// Render the target page number, but without it being a link
	$paginationCtrls .= '<li  style="padding-bottom:3px;border-bottom:1px solid black">'.$pagenum.'</li>';
	// Render clickable number links that should appear on the right of the target page number
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a></li> ';
		if($i >= $pagenum+4){
			break;
		}
	}
	// This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">NEXT   <i class="fa fa-chevron-right"></i></a></li> ';
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
    <title> Doppio Ritorto | coupon </title>

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
	
	<!-- FOR NOTIFICATION-->
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
 <!-- FOR NOTIFICATION-->
	
	<script type="text/javascript" src="jquery.js"></script> 
		<script type="text/javascript">

    $(document).ready(function(){
       $("#link_hov").hover(show_cart());
      $.ajax({
        type:'post',
        url:'store_items.php',
        data:{
          total_cart_items:"totalitems"
        },
        success:function(response) {
		
		  var array_data = String(response).split("<br/>");
		  document.getElementById("total_items").innerHTML = array_data[0]; //response;
		  document.getElementById("total_Amt").innerHTML = array_data[1]; //response;
          //document.getElementById("total_items").value=response;
        }
      });

    });
	
	
	

    function cart(id)
    {
	 toastr.success('Product Added to Cart');
	  var ele=document.getElementById(id);
	  //var img_src=ele.getElementsByTagName("img")[0].src;
	  var product_id=document.getElementById(id+"product_id").value;
	  var price=document.getElementById(id+"_price").value;
	 //alert(<?php echo count($_SESSION['cart_product']);?>);
	 //alert(price);
	 
	  $.ajax({
        type:'post',
        url:'store_items.php',
        data:{
          //item_src:img_src,
          itemID:product_id,
          item_price:price
        },
        success:function(response){
		show_cart();
		var array_data = String(response).split("<br/>");
		
         // document.getElementById("total_Amt").value=array_data[0]; //response;
		  
		  document.getElementById("total_items").innerHTML = array_data[0]; //response;
		 document.getElementById("total_Amt").innerHTML = array_data[1]; //response;
                         
						 // $('#'+id+'success_message').fadeIn().html("<img src='icon.png' style='width:10px;height:10px;'>");  
						   $('#success_message').fadeIn().html("<a href='cart.php'><i class='fa fa-check-circle-o fa-2x'></i></a>");  
                          setTimeout(function(){  
                             $('#success_message').fadeOut("Slow");  
                         }, 2000);  
        }
      });
	
    }
   
    function show_cart()
    {
	
      $.ajax({
      type:'post',
      url:'store_items.php',
      data:{
        showcart:"cart"
      },
      success:function(response) {
        document.getElementById("mycart").innerHTML=response;
        //$("#mycart").slideToggle();
      }
     });

    }
	
</script>
    
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
               <!-- <div id="user_account"><a href="login.html">Account</a></div>-->
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
                            
                           
                          
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navMenu">
                 <ul>
                    <li><a href="index.php">Home</a></li>
					
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
						        
								
						<?php if($row_cat['0'] == $category_id ){
						
						# variable for navigation bar
						  $nav = $parent_id;
						  $title  = $row_cat['1'];
						
						?>
						
						<li class=" active" >
                        <a href="list.php?category=<?php echo $row_cat['0']; ?>"><?php echo $row_cat['1']; ?></a>
                         <?php }else{
						 ?>
						 <li class="" >
						  <a href="list.php?category=<?php echo $row_cat['0']; ?>"><?php echo $row_cat['1']; ?></a>
						 <?php
						 }
						 ?>
									
						 </li>	
						 
					<?php }?>
				
                    <?php require_once("includes/header.php");?>
					
                </ul>
            </nav> 
        </header>



        <section class="content">
            <div class="breadcrumbs">
                <div class="container">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#">Women</a></li>
                        <li><a href="#">Shoes</a></li>
                        <li>Sports</li>
                    </ul>
                </div>
            </div>  
            <div class="products-list">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-4">
                            <div class="sideBar">
                                <div class="comapre-product sideBox">
                                   
                                    <div class="innerContent">
                                    
                                         <div class="filterBox">
                                            <h3>QUICK LINKS</h3>
                                            <ul>
                                                 <li><a href="aboutus.php">About Us</a></li>
                                                <li><a href="terms_conditions.php">Terms & Conditions</a></li>
                                                <li><a href="sales_list.php">Sales</a></li>
                                                <li><a href="size_guide.php">Size Guide</a></li>
                                                <li><a href="terms_conditions.php">Privacy Policy </a></li>
                                                <li><a href="contact_us.php">Contact Us</a></li>
                                                
                                            </ul>
                                        </div>

                                       
                                    </div>
                                </div>
                                
                               
                            </div>
                        </div> 



                        <div class="col-md-9  col-sm-8">
                        <div class="row">
                        <section class="">
                            <h3>Coupon | Great brands for less</h3>
                            <p class="text-center">Get extra savings and create your look choosing from the best designer brands.</p>
                        </section>
                        </div>
                        <hr>

                        <!-- Promotion -->

                            <div class="row products list-view">
							<?php 
							$feature = "Promotion";
							$status= "Yes";
							
								// This sets the range of rows to query for the chosen $pagenum
								// $limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
								// This is your query again, it is for grabbing just one page worth of rows by applying $limit
							
							  $tb_select = "SELECT * FROM product_tb WHERE publish = '{$status}' AND feature = '{$feature}' ORDER by id DESC ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_promotion = mysqli_fetch_array($result)){
							   ?>
							
                                <div class="col-md-4 col-sm-6">
                                    <div class="productBox">
                                        <div class="product-img">
                                            <img src="<?php echo $row_promotion['image'];?>" alt="banner">
                                            <div class="actions">
                                                <ul class="add-to-links">
                                                    <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li>
                                                    <li><a title="" href="#"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                                    <li><a title="" href="#"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <p class="product-name"><?php echo $row_promotion['product_name'];?></p>
                                            <?php
                                               
											   $str = strip_tags($row_promotion['description']);
										 
											  if(strlen($str)> 250){
											  
											 $str = substr($str,0,300)." ...";
											 
											echo '<p class="product-detail">'.$str.'</p>';
											
											}elseif(strlen($str) <= 250){
											
											echo '<p class="product-detail">'.$str.'</p>';
											
											}
										
											?>
                                            <div class="button-row">
											     
                                             <?php if($row_promotion['coupon'] != "" && $row_promotion['feature'] == "Promotion"){?>
                                                <a href="<?php echo $row_promotion['coupon'];?>" class="btn-yellow" target="_blank"><span>Get Coupon</span></a>
												<?php }else{  }?>
												<a href="single.php?product_id=<?php echo $row_promotion['0'];?>" class="btn-yellow"><span>View</span></a>
												
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<?php }?>
                                
                             
                                
                            </div>
                           
                        <!-- Promotion -->

                       



                      


                         
                        </div>
                    </div>
                    
                </div>
            </div> 
             
			 
			            <!-- Promotion -->
                         <div class="container pager text-center">
									<ul>
			
								<?php echo $paginationCtrls;?>
				
									</ul>
						</div>
            
     
        </section>

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
