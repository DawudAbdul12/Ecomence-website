<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>
    							  
								   <?php
								   ##### ARRAY FOR ALL IDS #######
								   
								   $all_categories = array();
								   
								    ##### ARRAY FOR ALL IDS #######
									$attri_id  = null;
								    $brnd_id = null;
									  ######### GET CATEGORY ID FROM THE LINK ########
									 if(isset($_GET['category'])){
									   $category_id = preg_replace('#[^0-9]#', '', $_GET['category']);
								      $all_categories[] = $category_id;
								
	                          $tb_select = "SELECT * FROM category_tb WHERE parent = {$category_id} ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_cat = mysqli_fetch_array($result)){

							    $all_categories[] =  $row_cat['0'];
							        
						        }
										 
												}
												if(isset($_GET['attr'])){
									           $attri_id = preg_replace('#[^0-9]#', '', $_GET['attr']);
												}
												
												if(isset($_GET['brnd'])){
									          $brnd_id = preg_replace('#[^0-9]#', '', $_GET['brnd']);
												}
									  ######### GET CATEGORY ID FROM THE LINK ########
									 ?>

							<?php
											  $status = "Yes";
											 // This first query is just to get the total count of 
											 //  $product_id =  $_SESSION['product_id'];
											   if(isset($attri_id)){
												$tb_select = "SELECT COUNT(id) FROM product_tb WHERE publish = '{$status}' AND category IN (".implode(',',$all_categories).") AND attribute = {$attri_id} ";
												}elseif(isset($brnd_id)){
												$tb_select = "SELECT COUNT(id) FROM product_tb WHERE publish = '{$status}' AND category IN (".implode(',',$all_categories).") AND brand = {$brnd_id} ";
												}else{
												$tb_select = "SELECT COUNT(id) FROM product_tb WHERE publish = '{$status}' AND category IN (".implode(',',$all_categories).")";
												}
											   $result = mysqli_query($connect,$tb_select);
											   if(!$result){
											   die ("SELECT TABLE FAILED".mysqli_error($connect));
											   }
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
				// This makes sure the page number isn't below 1, or more than our $last page
				if ($pagenum < 1) { 
					$pagenum = 1; 
				} else if ($pagenum > $last) { 
					$pagenum = $last; 
				}

				// This shows the user what page they are on, and the total number of pages
				$textline1 = "$rows";
				$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
				// Establish the $paginationCtrls variable
				$paginationCtrls = '';
				
				// $paginationCtrls = "<ul class=\"pagination\">";
				// If there is more than 1 page worth of results
				if($last != 1){
					/* First we check if we are on page one. If we are then we don't need a link to 
					   the previous page or the first page so we do nothing. If we aren't then we
					   generate links to the first page, and to the previous page. */
					if ($pagenum > 1) {
						$previous = $pagenum - 1;
						 if(isset($attri_id)){
						 
						$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?category='.$category_id.'&pn='.$previous.'&attr='.$attri_id.'"> Previous</a>';
						
						}elseif(isset($brnd_id)){
						 $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?category='.$category_id.'&pn='.$previous.'&brnd='.$brnd_id.'"> Previous</a>';
						}else{
						$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?category='.$category_id.'&pn='.$previous.'"> Previous</a>';
						
						}
						
						// Render clickable number links that should appear on the left of the target page number
						for($i = $pagenum-4; $i < $pagenum; $i++){
							if($i > 0){
							     if(isset($attri_id)){ 
							   $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?category='.$category_id.'&pn='.$i.'&attr='.$attri_id.'" > '.$i.'</a> ';
						      }elseif(isset($brnd_id)){
							
								$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?category='.$category_id.'&pn='.$i.'&brnd='.$brnd_id.'" > '.$i.'</a> ';
								
							  }else{
							  
							  $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?category='.$category_id.'&pn='.$i.'" > '.$i.'</a> ';
							
							}

							
							}
						}
					}
					// Render the target page number, but without it being a link
					$paginationCtrls .= ''.$pagenum.' &nbsp; ';
					// Render clickable number links that should appear on the right of the target page number
					for($i = $pagenum+1; $i <= $last; $i++){
					
					
						   if(isset($attri_id)){ 
							   $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?category='.$category_id.'&pn='.$i.'&attr='.$attri_id.'" > '.$i.'</a>';
						      }elseif(isset($brnd_id)){
							
								$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?category='.$category_id.'&pn='.$i.'&brnd='.$brnd_id.'" > '.$i.'</a> ';
								
							  }else{
							  
							  $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?category='.$category_id.'&pn='.$i.'" > '.$i.'</a> ';
							
							}
						
						
						if($i >= $pagenum+4){
							break;
						}
					}
					// This does the same as above, only checking if we are on the last page, and then generating the "Next"
					if ($pagenum != $last) {
						$next = $pagenum + 1;
						if(isset($attri_id)){
						 
						$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?category='.$category_id.'&pn='.$next.'&attr='.$attri_id.'"> Next</a>';
						
						}elseif(isset($brnd_id)){
						 $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?category='.$category_id.'&pn='.$next.'&brnd='.$brnd_id.'"> Next</a>';
						}else{
						$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?category='.$category_id.'&pn='.$next.'"> Next</a>';
						
						}
				
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
						  $('#'+id+'success_message').fadeIn().html("<li><a href='cart.php'><i class='fa fa-check-circle-o '></i><span class='text-success'>View Cart</span></a> </li>");  
                          //setTimeout(function(){  
                            //   $('#'+id+'success_message').fadeOut("Slow");  
                         // }, 2000);  
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


         <br/>
        <section class="content">
            <div class="breadcrumbs">
                <div class="container">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <?php
						       $tb_select_ctg = "SELECT * FROM category_tb WHERE id = {$nav} ORDER by id DESC ";
							   $result_ctg = mysqli_query($connect,$tb_select_ctg);
							   if(!$result_ctg){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_ctg = mysqli_fetch_array($result_ctg)){
							   ?>
                        <li><?php echo $row_ctg['1']; ?></li>
						<?php }?>
                      
                    </ul>
                </div>
            </div>  
            <div class="products-list">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-4">
                            <div class="sideBar">
                                <div class="comapre-product sideBox">
								 <?php
						       $tb_select_cat = "SELECT * FROM category_tb WHERE id = {$nav} LIMIT 1";
							   $result_c = mysqli_query($connect,$tb_select_cat);
							   if(!$result_c){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_c = mysqli_fetch_array($result_c)){
							   
							   $nav_title = $row_c['1'];
							   $nav_id = $row_c['0'];
							   }
							        ?>
                                    <div class="heading"><?php echo $nav_title;?></div>
                                    <div class="innerContent">
                                    
                                         <div class="filterBox">
                               
                                            <ul>
											<?php 
											  
											  $tb_select = "SELECT * FROM category_tb WHERE parent = {$nav} ";
											   $result = mysqli_query($connect,$tb_select);
											   if(!$result){
											   die ("SELECT TABLE FAILED".mysqli_error());
											   }
											   
											   while($row_cat = mysqli_fetch_array($result)){
											   
											   //$parent_id = $row_cat['0'];
											   
											   if($row_cat['0'] == $category_id){
											   
											?>
											<li><a href="list_sub.php?category=<?php echo $row_cat['0']; ?>"><strong><?php echo $row_cat['1'];?></strong></a></li>
											<?php }else{ ?>
											<li><a href="list_sub.php?category=<?php echo $row_cat['0']; ?>"><?php echo $row_cat['1'];?></a></li>
											<?php 
											}// close tag of the IF statement
											
											} 
											
											?>
								
                                            </ul>
                                        </div>

                                        <div class="filterBox">
                                            <h3>LIMITED  CASUAL WEAR </h3>
                                            <ul>
											                       <?php
									//  STATEMENT FOR FEATURED PRODUCT 
									      $attr_id = array();
										   $tb_select_cat_attribute_tb = "SELECT * FROM category_attribute_tb WHERE category IN (".implode(',',$all_categories).") ORDER BY ID DESC " ;
													  $result_cat_atrr_tb = mysqli_query($connect,$tb_select_cat_attribute_tb);
										   if(!$result_cat_atrr_tb){
										   die ("SELECT TABLE FAILED".mysqli_error());
										   }
										   while($row_cat_attri_tb = mysqli_fetch_array($result_cat_atrr_tb)){
										    
											$attr_id[] = $row_cat_attri_tb['attribute'];
											  }
											if(empty($attr_id)){
											
											}else{
										   $tb_select_attr_tb = "SELECT id,name FROM attribute_tb WHERE id IN (".implode(',',$attr_id).") ORDER BY id DESC " ;
										   $result_attr_tb = mysqli_query($connect,$tb_select_attr_tb);
										   if(!$result_attr_tb){
										   die ("SELECT TABLE FAILED".mysqli_error());
										   }

										   while($row_attr_tb = mysqli_fetch_array($result_attr_tb)){
										   
										    if($row_attr_tb[0] == $attri_id){
										   
										   echo '<b><li style=""><a href="'.$_SERVER['PHP_SELF'].'?category='.$category_id.'&attr='.$row_attr_tb['0'].'" >'.$row_attr_tb['1'].'</a></li></b>';
										   }else{
										   
										    echo '<li style=""><a href="'.$_SERVER['PHP_SELF'].'?category='.$category_id.'&attr='.$row_attr_tb['0'].'" >'.$row_attr_tb['1'].'</a></li>';
										   }
										   ?>
										   
										   <?php 
										  }
										  
										  }// end of if statement
										  

                                    ?>
											
                                            </ul>
                                        </div>
                                        <div class="filterBox">
                                            <h3>Top Brands</h3>
                                            <ul>
											
											 <?php
											 $cat_id = array();
									//  STATEMENT FOR FEATURED PRODUCT 
										   $tb_select_cat_brand_tb = "SELECT * FROM category_brand_tb WHERE category IN (".implode(',',$all_categories).") ORDER BY id DESC " ;
										   $result_cat_brand_tb = mysqli_query($connect,$tb_select_cat_brand_tb);
										   if(!$result_cat_brand_tb){
										   die ("SELECT TABLE FAILED".mysqli_error());
										   }
										   while($row_cat_brand_tb = mysqli_fetch_array($result_cat_brand_tb)){
										    
											$cat_id[] = $row_cat_brand_tb['brand'];

										  }
										  if(empty($cat_id)){
											
											}else{
										  
										   $tb_select_brand_tb = "SELECT DISTINCT ID, NAME FROM brand_tb WHERE ID IN (".implode(',',$cat_id).") ORDER BY id DESC " ;
										   $result_brand_tb = mysqli_query($connect,$tb_select_brand_tb);
										   if(!$result_brand_tb){
										   die ("SELECT TABLE FAILED".mysqli_error());
										   }
                                             
										   while($row_brand_tb = mysqli_fetch_array($result_brand_tb)){
										    if($row_brand_tb[0] == $brnd_id){
										   echo '<b><li style=""><a href="'.$_SERVER['PHP_SELF'].'?category='.$category_id.'&brnd='.$row_brand_tb['0'].'" >'.$row_brand_tb['1'].'</a></li></b>';
										   }else{
										   
										    echo '<li style=""><a href="'.$_SERVER['PHP_SELF'].'?category='.$category_id.'&brnd='.$row_brand_tb['0'].'" >'.$row_brand_tb['1'].'</a></li>';
										   
										   }
										   ?>
										   
										   <?php 
										  }
									}// END OF IF STATEMENT
                                    ?>
									
									
                                            </ul>
                                        </div> 
                                    </div>
                                </div>
                                <div class="comapre-product sideBox">
                                    <div class="heading">Compare Products </div>
                                    <div class="innerContent">
                                        You have no items to compare.
                                    </div>
                                </div>
                                <div class="sale-product">
                                    <img src="images/sale-img.png" alt="sale-img" class="img-responsive" />
                                </div>
                            </div>
                        </div> 
                        <div class="col-md-9  col-sm-8">
                        <div class="row">
                        <section class="">
							    <h3> <?php echo $title;?></h3>
                        </section>
                        </div>
                        <!-- 
                            <div class="row"> 
                           <div class="col-md-8">
                                  <figure class="effect-layla imgBox"> 
                                <img src="images/product-img/img1.png" alt="product image">          
                            </figure>
                             </div>

                             <div class="row">
                             <div class="col-md-4">
                                  <figure class="effect-layla imgBox"> 
                                <img src="images/product-img/img1.png" alt="product image">          
                            </figure>
                             </div>

                             <div class="col-md-4">
                                  <figure class="effect-layla imgBox"> 
                                <img src="images/product-img/img1.png" alt="product image">          
                            </figure>
                             </div>
                             </div>
                            </div>

                               -->
                       
                            <div class="customize-product">
                                 <!-- 
                                <div class="product-show">
                                    <label>Show</label>
                                    <div class="jsSelect-box">
                                        <select class="styled">
                                            <option>9</option>
                                            <option>20</option>
                                            <option>25</option>
                                        </select>
                                    </div>
                                    <label> Per Page</label>
                                </div>
								 -->
                                <div class="sorting">
                                    
                                    <div class="jsSelect-box">
                                       <label><?php echo $textline2; ?></label>
                                    </div>
                                   
                                </div>
								
                            </div>
							
						
                            <div class="row products">
							
							  <?php
							  
							   //  STATEMENT FOR FEATURED PRODUCT 
									       // This sets the range of rows to query for the chosen $pagenum
				                           $limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
				                      // This is your query again, it is for grabbing just one page worth of rows by applying $limit
							   
									//  STATEMENT FOR FEATURED PRODUCT 
							  
							  
							   if(isset($attri_id)){
							   
							    $tb_select_list = "SELECT * FROM product_tb  WHERE category IN (".implode(',',$all_categories).") AND attribute = {$attri_id} ORDER by id DESC {$limit} ";
	               
							   }elseif(isset($brnd_id)){
							   
							      $tb_select_list = "SELECT * FROM product_tb  WHERE category IN (".implode(',',$all_categories).") AND brand = {$brnd_id} ORDER by id DESC {$limit} ";
							  
							  }else{

							   $tb_select_list = "SELECT * FROM product_tb  WHERE category IN (".implode(',',$all_categories).") ORDER by id DESC {$limit} ";
							  
							   }
							   
							   $result_list = mysqli_query($connect,$tb_select_list);
							   if(!$result_list){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_list = mysqli_fetch_array($result_list)){
						
							    ?>
							
                                <div class="col-md-4 col-sm-6">
                                    <div class="productBox" id="<?php echo $row_list['ID']; ?>">
                                        <div class="product-img">
                                            <!-- <div class="product-labels">
                                                <div class="sale-label">sale</div>
                                            </div> -->
                                            <img src="<?php echo $row_list['image']; ?>" alt="banner" />
                                            <div class="actions">
                                                <ul class="add-to-links">
                                                    <li><a title="" href="single.php?product_id=<?php echo $row_list['0'];?>"><i class="fa fa-eye"></i><span>view</span></a></li>
                                                    <li style="cursor:pointer" id="<?php echo $row_list['ID'];?>success_message" ><a title="" onclick="cart('<?php echo $row_list['ID']; ?>')" ><i class="fa fa-shopping-cart"></i><span>Cart</span></a></li>
													<input type="hidden" name="pid" id="<?php echo $row_list['ID']; ?>product_id" value="<?php echo $row_list['ID']; ?>">
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-info" >
                                            <p class="product-name"><?php echo $row_list['product_name']; ?></p>
                                            <div class="product-price">
									<?php
									  $regular_price = $row_list['regular_price'];
									  $sale_price = $row_list['sale_price'];
									  
									  $regular_price= "₵ ".number_format($regular_price, 2);
									  $sale_price= "₵ ".number_format($sale_price, 2);
									  
									  ?>
											
										<?php 
										
										
										if($row_list['sale_price'] != 0){
										
										?>
										
								          <span class="new-price"><?php echo $sale_price;?></span>
								         <span class="old-price"><?php echo $regular_price; ?></span>
										 
										 <input type="hidden" id="<?php echo $row_list['ID']; ?>_price" value="<?php echo $row_list['sale_price'];?>"> 
										 
									     <?php }else{?>
										  
								         <span class="new-price"><?php echo $regular_price; ?></span>
										 <input type="hidden" id="<?php echo $row_list['ID']; ?>_price" value="<?php echo $row_list['regular_price'];?>"> 
                                        <?php }?>
							
							
							
							
							
                                         
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
								
								<?php } ?>

                              
                            </div>


                              <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
                        </div>
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
