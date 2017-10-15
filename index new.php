<?php  require_once("includes/session.php");?>
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
	
	<!-- FOR NOTIFICATION-->
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
 <!-- FOR NOTIFICATION-->
	
	
	<script type="text/javascript" src="jquery.js"></script> 
	
	<script type="text/javascript" src="JS/echo.js"></script> 
	
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
				<span id="success_message"><i class=""></i></span>
                <!--<div id="user_account"><a href="login.html">Account</a></div>-->
                <div id="search_box">
                    <a href="javascript:void(0);"><i class="fa fa-search"></i></a>
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
                    <li class="active"><a href="index.php">Home</a></li>
					
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
						<li class="">
                        <a href="list.php?category=<?php echo $row_cat['0']; ?>"><?php echo $row_cat['1']; ?></a>
                     
						 </li>	
										  <?php }?>
				
                    <?php require_once("includes/header.php");?>
					
                </ul>
            </nav> 
        </header>
        <section class="banner">
            <div class="owl-carousel" id="banner-slider">
                <div class="item">
                    <img src="images/top-banner/banner1.jpg" alt="banner" />
                    <div class="banner-conetnt">
                        <div class="container">
                            <span class="sub-heading">Our finest</span>
                            <p>Italian Collection</p>
                            <a href="/list.php?category=32" class="defatult-btn">shop</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="images/top-banner/banner2.jpg" alt="banner" />
                    <div class="banner-conetnt">
                        <div class="container">
                            <span class="sub-heading"></span>
                            <p>Exclusive Collection</p>
                            <a href="/list.php?category=32" class="defatult-btn">shop</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content homeAnimation">
            <div class="product-category">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 leftCol">
                          
                            <figure class="effect-layla imgBox">
                           
                                <img src="images/product-img/img1.png" alt="product image" />
                              
                                 <figcaption>
                                    <h3>Men’s Shoes</h3>
                                   <div class="shop-now" style="text-align:center"></div>
                                </figcaption>
                                			
                           </figure>
                      
                           <figcaption>
                               
                                    <div class="shop-now" style="text-align:center"><a href="list_sub.php?category=37">shop now</a></div>
                                </figcaption>
                           
                       
                            <figure class="effect-layla imgBox">   
                             <a href="list_sub.php?category=34">
                                <img src="images/product-img/img2.png" alt="product image" />
                             </a>
                                   <figcaption>
                                    <h3>Mens Shirt</h3>
                                    <div class="shop-now" style="text-align:center"></div>
                                </figcaption>
                               		
                            </figure>

                            <figcaption>
                                   
                                    <div class="shop-now" style="text-align:center"><a href="list_sub.php?category=34">shop now</a></div>
                                </figcaption>
                                     
                                

                        </div> 
                        <div class="col-sm-4">
                            <figure class="effect-layla imgBox"> 
                                <img src="images/product-img/img5.png" alt="product image" />
                                <figcaption>
                                    <h3>Men's</h3>
                                    <div class="shop-now"><a href="list_sub.php?category=34">shop now</a></div>
                                </figcaption>
                            </figure>
                           <div class="shop-now" style="text-align:center"><a href="list_sub.php?category=34">shop now</a></div>
                        </div>
                        <div class="col-sm-4 rightCol">
                            <figure class="effect-layla imgBox"> 
                                <img src="images/product-img/img3.png" alt="product image" />
                                <figcaption>
                                    <h3>belt for men's</h3>
                                    
                                </figcaption>			
                            </figure>
                              
                            <div class="shop-now" style="text-align:center"><a href="list_sub.php?category=38">shop now</a></div>

                            <figure class="effect-layla imgBox"> 
                                <img src="images/product-img/img4.png" alt="product image" />
                                <figcaption>
                                    <h3>watches</h3>
                                    
                                </figcaption>			
                            </figure>
                             <div class="shop-now" style="text-align:center"><a href="list.php?category=39">shop now</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="featured-products products-slider"> 
                <div class="container">
                    <h1>New Arrivals</h1>
                    <h2>Find your style from us</h2>
					
					
                    <div class="owl-carousel" id="featured-products-slider">
					  <!--######### PHP CODE #######-->
					           <?php 
	                          $tb_select = "SELECT * FROM product_tb ORDER by id DESC limit 0,10";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_new = mysqli_fetch_array($result)){
							  
							    ?>
					  
                        <div class="item">
                            <div class="productBox">
                                <div class="product-img">
                                    <div class="product-labels">
                                       <div class="new-label">new</div>
                                    </div>
                                    <img data-echo="images/giphy.gif" src="http://btsbay.justsimpletechnology.com/img/carousel4.jpg" alt="banner" />
                                    <div class="actions" id="<?php echo $row_new['ID']; ?>" >
                                        <ul class="add-to-links">
                                           <!--  <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li> -->
                                            <li><a title="<?php echo $row_new['product_name']; ?>" href="single.php?product_id=<?php echo $row_new['0'];?>"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            
										<li style="cursor:pointer" id="<?php echo $row_new['ID'];?>success_message"><a title="<?php echo $row_new['product_name']; ?>" onclick="cart('<?php echo $row_new['ID']; ?>')"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
										
										<!--<li><a href=""><i class='fa fa-check-circle-o '></i><span class="text-success"></span></a> </li>-->
										
										 <input type="hidden" name="pid" id="<?php echo $row_new['ID']; ?>product_id" value="<?php echo $row_new['ID']; ?>">
											
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
								
								
                                    <p class="product-name"><?php echo $row_new['product_name']; ?></p>
                                    <div class="product-price">
									
									<?php
									  $regular_price = $row_new['regular_price'];
									  $sale_price = $row_new['sale_price'];
									  
									  $regular_price= "₵ ".number_format($regular_price, 2);
									  $sale_price= "₵ ".number_format($sale_price, 2);
									  
									  ?>
											
										<?php 
										
										
										if($row_new['sale_price'] != 0){
										
										?>
										
								          <span class="new-price"><?php echo $sale_price;?></span>
								         <span class="old-price"><?php echo $regular_price; ?></span>
										 
										 <input type="hidden" id="<?php echo $row_new['ID']; ?>_price" value="<?php echo $row_new['sale_price'];?>"> 
										 
									     <?php }else{?>
										  
								         <span class="new-price"><?php echo $regular_price; ?></span>
										 <input type="hidden" id="<?php echo $row_new['ID']; ?>_price" value="<?php echo $row_new['regular_price'];?>"> 
                                        <?php }?>
							
										
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<?php }?>
						<!--######### PHP CODE #######-->

                    </div> 
                </div>
            </div>
            <div class="summer-collection">
                <div class="container">
                    <span class="sub-heading">Unique and high quality Italian Wear</span>
                    <p>Doppio Ritorto</p>
                    <a href="list.php?category=32" class="defatult-btn">shop now</a>
                </div>
            </div>
            <div class="bestseller products-slider"> 
                <div class="container">
                    <h1>Products On Sale</h1>
                    <h2>Quality Deals</h2>
					<div class="owl-carousel" id="bestseller-slider">
					          <!--######### PHP CODE #######-->
					           <?php 
							   $sale = 0;
							   
	                          $tb_select = "SELECT * FROM product_tb WHERE sale_price != {$sale} ORDER by id DESC  limit 0,10";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_sale = mysqli_fetch_array($result)){
						
							    ?>
                        <div class="item">
                            <div class="productBox">
                                <div class="product-img">
                                    <div class="product-labels">
                                       <div class="new-label">Sale</div>
                                    </div>
                                    <img src="<?php echo $row_sale['image']; ?>" alt="banner" />
                                    <div class="actions" id="<?php echo $row_sale['ID']; ?>" >
                                        <ul class="add-to-links">
                                           <!--  <li><a title="" href="#"><i class="fa fa-heart-o"></i><span>Wishlist</span></a></li> -->
                                            <li><a title="<?php echo $row_sale['product_name']; ?>" href="single.php?product_id=<?php echo $row_sale['0'];?>"><i class="fa fa-eye"></i><span>Quickview</span></a></li>
                                            
										<li style="cursor:pointer" id="<?php echo $row_sale['ID'];?>success_message"><a title="<?php echo $row_sale['product_name']; ?>" onclick="cart('<?php echo $row_sale['ID']; ?>')"><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
										
										<!--<li><a href=""><i class='fa fa-check-circle-o '></i><span class="text-success"></span></a> </li>-->
										
										 <input type="hidden" name="pid" id="<?php echo $row_sale['ID']; ?>product_id" value="<?php echo $row_sale['ID']; ?>">
											
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <p class="product-name"><?php echo $row_sale['product_name']; ?></p>
                                    <div class="product-price">
									
									<?php
											$regular_price = $row_sale['regular_price'];
									  $sale_price = $row_sale['sale_price'];
									  
									  $regular_price= "₵ ".number_format($regular_price, 2);
									  $sale_price= "₵ ".number_format($sale_price, 2);
									  
									  ?>
										<!-- PRICE CODE ---->
									   <?php if($row_sale['sale_price'] != 0){
									
									   ?>
                                         <span class="new-price"><?php echo $sale_price; ?></span>
								         <span class="old-price"><?php echo $regular_price; ?></span>
										 
										 <input type="hidden" id="<?php echo $row_sale['ID']; ?>_price" value="<?php echo $row_sale['sale_price'];?>"> 
										 
										<?php }else{?>
										
										 <span class="new-price"><?php echo $regular_price; ?></span>
										 <input type="hidden" id="<?php echo $row_sale['ID']; ?>_price" value="<?php echo $row_sale['regular_price'];?>"> 
										 
										 <?php }?>
										 
										 <!-- PRICE CODE ---->

                                    </div>
                                </div>
                            </div>
                        </div>
						
                       <?php }?>
						<!--######### PHP CODE #######-->


                    </div> 
                </div>
            </div>
            <div class="offers">
                <div class="container">
                    <div class="row">

                    <h1 class="text-center">Top Brands</h1>
					
					<?php
	                           $tb_select_brand = "SELECT * FROM brand_tb  ORDER by id DESC  limit 0,8";
							   $result_brand = mysqli_query($connect,$tb_select_brand);
							   if(!$result_brand){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_brand = mysqli_fetch_array($result_brand)){
						
							    ?>
						

                      <div class="col-sm-3 ">
					  <a href="brand_list.php?brand=<?php echo $row_brand['0']; ?>">
                            <figure class="effect-layla imgBox"> 
                                <img    src="<?php echo $row_brand['image']; ?>" alt="<?php echo $row_brand['1']; ?>">         
                            </figure>
							</a>
                        </div>
                                             
							<?php }?>				 
                       

                       
                    </div>
                </div>
            </div> 
        
            <div class="services">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                           <!--  <div class="serviceBlock">
                                <div class="service-icon"><i class="fa fa-support"></i></div>
                                <div class="serviceDetail">
                                    <label>Support 24/7</label>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesettin</p>
                                </div>
                            </div> -->
                        </div> 
                        <!-- <div class="col-sm-4">
                            <div class="serviceBlock">
                                <div class="service-icon"><i class="fa fa-money"></i></div>
                                <div class="serviceDetail">
                                    <label>Money back guarantee</label>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesettin</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="serviceBlock">
                                <div class="service-icon"><i class="fa fa-send-o"></i></div>
                                <div class="serviceDetail">
                                    <label>Free shipping</label>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesettin</p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
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
