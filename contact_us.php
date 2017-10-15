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
    <title> Doppio Ritorto | Contact Us </title>

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
        
        <section class="content homeAnimation">
            <div class="product-category">

            </div>
            <div class="featured-products products-slider"> 
                <div class="container">
                    <h1>Contact Us</h1>


                    <!-- contact form -->
                         <div class="row">
      <div class="col-sm-8 col-sm-offset-2 form-box">
                            <div class="form-top">
                             
                                <p>Send us a message</p>
                            </div>
                            <div class="form-bottom contact-form">
                                <form action="http://www.a2omag.com/contact-us" method="post">
                                  <input type="hidden" name="sent" id="sent" value="1">
                                  <div class="form-group">
                                        <label class="sr-only" for="message_name">Name</label>
                                        <input type="text" name="message_name" placeholder="Name..." class="contact-f contact-name form-control" id="contact-name" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="message_email">Email</label>
                                        <input type="text" name="message_email" placeholder="Email..." class="contact-f contact-email form-control" id="contact-email" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="message_subject">Subject</label>
                                        <input type="text" name="message_subject" placeholder="Subject..." class="contact-f contact-subject form-control" id="contact-subject" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="message_text">Message</label>
                                        <textarea name="message_text" placeholder="Message..." class="contact-f contact-message form-control" id="contact-message" rows="6"></textarea>
                                    </div>
                                   
                                    
                                    <button type="submit" class="btn-yellow">Submit</button>
                                </form>
                            </div>
                        </div>

     
    </div>
                    <!-- contact form -->
                    

                
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
