<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<?php

			if(isset($_POST['itemID'])){
			// Excute some code
			$itemID = $_POST['itemID'];
			$quantity = $_POST['item_quantity'];
			$quantity = preg_replace('#[^0-9]#i',"",$quantity);
			if($quantity >= 100){$quantity = 99;}
			if($quantity <= 1){$quantity = 1;}

			$i = 0;
			foreach($_SESSION['cart_product'] as $each_item){
				$i++;
				while(list($key,$value) = each($each_item)){
			   if($key == "item_id" && $value == $itemID){
				// that item is in cart already so let's adjust its quantity using array
				array_splice($_SESSION["cart_product"], $i-1,1,array(array("item_id" => $itemID, "quantity" => $quantity)));

			 }

			}

			}
			}
?>