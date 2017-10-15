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
    <title> Doppio Ritorto | Size Guide </title>

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
	
	
	<script type="text/javascript" src="jquery.js"></script> 
		<script type="text/javascript">

    $(document).ready(function(){
    show_cart();
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
	
	  var ele=document.getElementById(id);
	  //var img_src=ele.getElementsByTagName("img")[0].src;
	  var product_id=document.getElementById(id+"product_id").value;
	  var price=document.getElementById(id+"_price").value;
	 
	 
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
                        //  setTimeout(function(){  
                         //      $('#'+id+'success_message').fadeOut("Slow");  
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
						
						 <li class="" >
						  <a href="list.php?category=<?php echo $row_cat['0']; ?>"><?php echo $row_cat['1']; ?></a>
									
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
                            <h3>Size Guide</h3>
                            <p class="text-center">Use our handy measurement charts to find the right size for your perfect style.</p>
                        </section>
                        </div>
                        <hr>

                        <!-- where the table comes -->
                            <div class=" texc ">

                            <table class="table table-striped table-bordered"> 
                            <thead> 
                                <tr> 
                                    <th>Casual Shirts</th> 
                                    <th class="text-center">Size</th> 
                                   <!--  <th></th> 
                                    <th></th> 
                                    <th></th> 
                                    <th></th> 
                                    <th></th> 
                                    <th></th> 
                                    <th></th>  -->
                                   <!--  <th>Last Name</th> 
                                    <th>Username</th> --> 
                                </tr> 
                            </thead> 
                            <tbody> 
                             <tr> 
                              <th scope="row"></th> 
                               <td>XS</td>
                               <td>S</td> 
                               <td>M</td>
                               <td>L</td> 
                               <td>XL</td> 
                               <td>XXL</td> 
                               <td>XXXL</td>
                               <td>XXXXL</td>
                             </tr> 
                             <tr> 
                              <th scope="row">Neck (To Fit)</th> 
                              <td>14</td> 
                              <td>14.5-15</td> 
                              <td>15.5-16</td>
                              <td>16.5-17</td>
                              <td>17.5-18</td>
                              <td>18.5-19</td>
                              <td>19.5-20</td>
                              <td>20.5-21</td> 
                              </tr> 
                            <tr> 
                             <th scope="row">Chest (To Fit)</th> 
                              <td>32-34</td> 
                              <td>35-37</td> 
                              <td>38-40</td>
                              <td>41-43</td>
                              <td>44-46</td>
                              <td>47-49</td>
                              <td>50-52</td>
                              <td>52-54</td>  
                            </tr>
                        </tbody> 
                            </table>
                                       
                                    </div>
                        <!-- where the tables comes -->

                        <!-- Measuring advice -->
                            <div class="">
                                <div class="row text-left ">
                                    <h3>Measuring advice</h3>
                                    <p> <strong>Find your clothing size</strong> </p>
                                    <p>Take your actual body measurements as they are more accurate than measuring over your clothes</p>


                                    <!-- 3 col md -->
                                    <div class="col-md-4 texc ">
                                        <p>
                                    <strong> (1) Collar:</strong>  <br>
                                          measure around the base of the neck where the collar sits.
                                        </p>

                                        <p>
                                            <strong>(2) Chest:</strong> <br>
                                           measure the chest at the fullest part, placing the tape close up under the arms.
                                        </p>

                                        <p>
                                            <strong>(3) Waist:</strong> <br>
                                            measure the natural waistline
                                        </p>

                                        <p>
                                           <strong> (4) Inside Leg:</strong>  <br>
                                            measure from the crotch to where your trouser is normally worn on the shoe
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <img src="images/sz.png" alt="">
                                    </div>
                                    <div class="col-md-4 texc ">
                                        <p>
                                    <strong> (5) Body Length:</strong>  <br>
                                          To determine jacket length requirements, measure from the centre back of your neck line to the natural hemline. Check size guide to establish if a Short, Medium, Long or Extra Long length is required. Jacket lengths vary depending on the style or the fit of the garment.
                                        </p>
                                    </div>
                                    <!-- 3 col md -->
                                </div>
                            </div>

                        <!-- Measuring advice -->




                      


                         
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
