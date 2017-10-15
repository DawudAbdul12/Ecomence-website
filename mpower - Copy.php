<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>
<?php
$items_array[] = array();
$num = 0;
foreach($_SESSION["cart_product"] as  $each_item){
						$item_id = $each_item['item_id'];
						$quantity = $each_item['quantity'];
						$sql = mysqli_query($connect,"SELECT * FROM product_tb WHERE ID ='{$item_id}' limit 1");
						
						while ($row = mysqli_fetch_array($sql)){
                         $item_s ='item_'.$num.'';
						 $product_name = $row["product_name"];
						 $quantity = $quantity;
						 
						        if($row["sale_price"] == 0){
								$unit_price = $row["regular_price"];
								$unit_price = number_format($unit_price, 2);
								$subtotal = $quantity *  $row["regular_price"];
								
								}else{
									
								$unit_price = $row["sale_price"];
								$unit_price = number_format($unit_price, 2);
								$subtotal = $quantity *  $row["sale_price"];
								}
								
						 $unit_price = $unit_price;
						 $total_price = $subtotal;
						 $desc = $row["description"];
						 
			$items_array[] = array($item_s => array(
			      'name' => $product_name,
			      'quantity' => $quantity,
			      'unit_price' => $unit_price,
			      'total_price' => $subtotal,
			      'description' => '{Customer Name} order from Mycompany.com'
				),
						);
				
		        $all_total_price = $all_total_price +  $total_price;
				
						                       } //while
											  $num++; 
		                                        }//end of foreach
		//	$items_array[] = array('total_amount' => 700.00);
		//$items_array[] = array('description' => 'Total cost of 2 shirts');
	
 echo var_dump($items_array);

?>


<?php
/*
$invoice = array(
	'invoice' => array(
		//'items' => var_dump($items_array),
		
		'items' => array(
			'item_0' => array(
			      'name' => 'T Shirt',
			      'quantity' => 2,
			      'unit_price' => '35.0',
			      'total_price' => '700.0',
			      'description' => '{Customer Name} order from Mycompany.com'
				),
				
				
				'item_1' => array(
			      'name' => 'T Shirt',
			      'quantity' => 2,
			      'unit_price' => '40.0',
			      'total_price' => '500.0',
			      'description' => '{Customer Name} order from Mycompany.com'
				)
			),
			
			
			
			'total_amount' => $all_total_price,
		'description' => 'Total cost of 2 shirts'

		

	),
		
	'store' => array(
		'name' => 'Your Company Name Here',
		'tagline' => 'Your tagline',
		'phone' => '+2335417698',
		'website_url' => 'https://hubtel.com'
		),

	'actions' => array(
		'cancel_url' => 'https://hubtel.com',
		'return_url' => 'https://hubtel.com'
		),
	);

$clientId = 'qcfpxvnt';
$clientSecret = 'ugidysuh';
$basic_auth_key =  'Basic ' . base64_encode($clientId . ':' . $clientSecret);
$request_url = 'https://api.hubtel.com/v1/merchantaccount/onlinecheckout/invoice/create';
$create_invoice = json_encode($invoice);

$ch =  curl_init($request_url); 
       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt( $ch, CURLOPT_POST, true );  
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $create_invoice);  
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );  
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: '.$basic_auth_key,
		    'Cache-Control: no-cache',
		    'Content-Type: application/json',
		  ));

$result = curl_exec($ch); 
$error = curl_error($ch);
curl_close($ch);

if($error){
	echo $error;
}else{
	// redirect customer to checkout
	$response_param = json_decode($result);
	$redirect_url = $response_param->response_text;
	header('Location: '.$redirect_url);

}
*/
?>