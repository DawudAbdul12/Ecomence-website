<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<?php
 
  //  DEFAULT LOAD
  if(isset($_POST['total_cart_items']))
  {
  
  //PRICE CHECK UP 
			
				 if(!isset($_SESSION["cart_product"]) || count($_SESSION["cart_product"])< 1){

				 $totalamount = 0.00;
				 
				   }else{
				 $totalamount = 0;
				foreach($_SESSION["cart_product"] as  $each_item){
				$item_id = $each_item['item_id'];
				
				$quantity = $each_item['quantity'];

				$sql = mysqli_query($connect,"SELECT * FROM product_tb WHERE ID ='{$item_id}' limit 1");
				  while ($row = mysqli_fetch_array($sql)){
				  if($row["sale_price"] != 0){
				   $price = $row["sale_price"];
				  }else{
				   $price = $row["regular_price"];
				   }
				  $totalprice = $price * $quantity; 	
				  $totalamount = $totalprice + $totalamount;
				 
				}
					
				}
				}// END OF ORDER SCRIPT
							
			//PRICE CHECK UP 
			###### PRICE SETUP ######
			  
              $totalamount = number_format($totalamount, 2);
			###### PRICE SETUP ######
			
   echo count($_SESSION['cart_product'])."<br/>".$totalamount;
	//echo count($_SESSION['name']);
	exit();
  }

  
  
 
  
  
    // ADD CART CODE
  
    if(isset($_POST['itemID']))
  {
			$pid = $_POST['itemID'];
			$price = $_POST['item_price'];
			
			$wasFound = false;
			$i=0;
			// if the cart session variable is not set or cart array is empty
			if(!isset($_SESSION["cart_product"]) || count($_SESSION["cart_product"]) < 1){
			   // RUN IF THE CART IS EMPTY OR NOT SET
			$_SESSION["cart_product"] = array(0 => array("item_id" => $pid, "quantity" => 1));
             
             //$totalAmt = $price;		
              
               $_SESSION['product_price'] = $_SESSION['product_price'] + $price;			  
			  
			}else{
			  // RUN IF THE CART AT LEAST ONE ITEM IN IT
			foreach($_SESSION["cart_product"] as $each_item){
			 $i++;
			while(list($key, $value) = each($each_item)){
			if($key =="item_id" && $value == $pid){
			// the item is in cart already so let's adjust it quantity using array_splice()
			array_splice($_SESSION["cart_product"], $i-1,1,array(array("item_id" => $pid, "quantity" => $each_item['quantity'] + 1)));
			 $wasFound = true;
              $_SESSION['product_price'] = $_SESSION['product_price'] + $price;	
			}

			}

			}

			if($wasFound == false){
			array_push($_SESSION["cart_product"],array("item_id" => $pid, "quantity" => 1));
            
			 $_SESSION['product_price'] = $_SESSION['product_price'] + $price;	
			
			}
			}
			
			//PRICE CHECK UP 
			
				 if(!isset($_SESSION["cart_product"]) || count($_SESSION["cart_product"])< 1){

				 $totalamount = 0.00;
				 
				   }else{
				 $totalamount = 0;
				foreach($_SESSION["cart_product"] as  $each_item){
				$item_id = $each_item['item_id'];
				
				$quantity = $each_item['quantity'];

				$sql = mysqli_query($connect,"SELECT * FROM product_tb WHERE ID ='{$item_id}' limit 1");
				  while ($row = mysqli_fetch_array($sql)){
				  if($row["sale_price"] != 0){
				   $price = $row["sale_price"];
				  }else{
				   $price = $row["regular_price"];
				   }
				  $totalprice = $price * $quantity; 	
				  $totalamount = $totalprice + $totalamount;
				 
				}
					
				}
				}// END OF ORDER SCRIPT
							
			//PRICE CHECK UP 
			
			
			
			
			
			//echo "<script> window.location.replace('index.php') </script>";
	//$_SESSION['name'][]=$_POST['item_name'];
   // $_SESSION['price'][]=$_POST['item_price'];
   // $_SESSION['src'][]=$_POST['item_src'];
             ###### PRICE SETUP ######
			  
              $totalamount= " ".number_format($totalamount, 2);
			###### PRICE SETUP ######
    echo count($_SESSION['cart_product'])."<br/>".$totalamount;
    exit();
  }
  
  
  ####################################################################################
		 //CODE FOR VIEWING CART
		 
       if(isset($_POST['showcart'])){
	               $total_qty= 0;
	              # CODE FOR ORDER PRODUCTS 
				  $totalAmount = 0;
				if(count($_SESSION["cart_product"]) < 1){
                     echo " <div class=\"cart-item\">";
							echo "<p>No  Products In the Cart</p>";
                     echo       "</div>";
			   
				}else{
				 
				foreach($_SESSION["cart_product"] as  $each_item){
				$item_id = $each_item['item_id'];
				$quantity = $each_item['quantity'];

				$sql = mysqli_query($connect,"SELECT * FROM product_tb WHERE ID ='{$item_id}' ");
				  while ($row = mysqli_fetch_array($sql)){
				  
				  if($row["sale_price"] !=0){
				   $price = $row["sale_price"];
				   
				   }else{
				   
				   $price = $row["regular_price"];
				   
				   }
				  $total_qty = $quantity + $total_qty;
				  $totalprice = $price * $quantity; 
                   $totalAmount = $totalprice + $totalAmount			  
							?>			  

							<div class="cart-item">
							<a href="single.php?product_id=<?php echo $row['0'];?>">
                                <div class="img"><img src="<?php echo $row["image"];?>" alt=""></div>
                                <div class="product-name"><?php echo $row["product_name"];?></div>
								<div class="price">Quantity <?php echo $quantity; ?> </div>
								
                                <div class="price">&#8373;<?php  
								
								 ###### PRICE SETUP ######
                                 $item_price = " ".number_format($price, 2);
								 echo $item_price
			                     ###### PRICE SETUP ######
								
								?></div>
                              
                            </a>
                            </div>
							
							
							
						<?php
					}
					
					}
					
					###### PRICE SETUP ######
                 $totalAmount= number_format($totalAmount, 2);
			     ###### PRICE SETUP ######
					 echo "<div class=\"total\">{$total_qty} items, Total: &#8373; {$totalAmount}</div>";
					 ?>
					  <div class="cart-btn">
                                <a href="cart.php" class="btn-yellow">VIEW CART</a>
                                <a href="checkout.php" class="btn-yellow pull-right">Checkout</a>
                       </div>
					 <?php
					}// END OF ORDER SCRIPT
    exit();	
  }
?>