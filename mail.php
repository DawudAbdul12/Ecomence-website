<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<?php	

	/************************************* START GET POST FUNCTION  ********************************/
					           if(isset($_GET['order_id'])){
								$order_id = $_GET['order_id'];  
								
					             }
	/*************************************END GET POST FUNCTION  ********************************/
       $order_id = 20; 
	?>

<?php
 
  //  UPDATE ORDER TABLE
   if(isset($_POST['submit'])){
  
     $id = $_POST['order_id'];
	 $status = mysqli_real_escape_string($connect,$_POST['status']);


	    $query="UPDATE order_tb SET
				complete_status	 = '{$status}'
                WHERE id = '{$id}'			
			";			
		$result = mysqli_query($connect,$query);
		if(mysqli_affected_rows($connect) == 1){
		//success
		 $message = "<strong><span class=\"label label-success\">Record Updated Successfully </span></strong>".mysqli_error($connect);
		}else{
		// ERROR
		$message = "<strong><span class=\"label label-danger\">Update Failed </span></strong>".mysqli_error($connect);
		}
		
		//echo "<script> window.location.replace('invoice.php?order_id='"+$id+"')</script>";
	    
		//echo $message;
  }
?>


<!DOCTYPE html>
<html>
   
<head>
       
        <!-- App Favicon -->
       
        <!-- App title -->
        <title>ORDER INVOICE</title>

        <!-- App CSS -->
        <link href="http://gentspack.effectstudiosgh.com/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
       
       
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

      

    </head>


    <body>

        <!-- Begin page -->
        <div id="wrapper" style="padding:20px 20px 20px 20px">
		
            
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <img src="http://gentspack.effectstudiosgh.com/img\logo.png" style="width:150px; height:50px;"><h4>ORDER </h4>
                                    </div>
									
                                                	    <?php
								//$order_id = 1;
								
							   $tb_select = "SELECT * FROM order_tb WHERE id = {$order_id} order by id desc  ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
							   $order_id = $row['0'];
							   $customer_name = $row['2'];
							   $customer_phone = $row['3'];
							   $contact_info = $row['5'];
							   $order_date = $row['6']."  ".$row['7'] ;
							   $total_amount = $row['8'];
							   $order_status = $row['10'];
							   }
											?>
									
									
									
                                    <div class="panel-body">
                                        <div class="clearfix">
                                            <div class="pull-left">
                                                <h3 class="logo"><?php echo $customer_name;?></h3>
                                            </div>
                                            <div class="pull-right">
                                                <h4>Invoice #<?php echo $order_id;?> <br>
                                                    <i class="fa fa-phone"></i>  <strong><?php echo  $customer_phone;?></strong>
                                                </h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="pull-left m-t-30">
                                                    <address>
                                                      <strong><?php echo  $customer_name;?></strong><br>
                                                      <?php echo $contact_info;?></br>
                                                      <abbr title="Phone">P:</abbr> <?php echo $customer_phone;?>
                                                      </address>
                                                </div>
                                                <div class="pull-right m-t-30">
												<!--######## ORDER STATUS VALIDATION #######-->
                                                    <p><strong>Order Date: </strong>  <?php echo $order_date;?></p>
                                                    <p class="m-t-10"><strong>Order Status: </strong> 
													<?php if($order_status == "Pending"){?>
													<span class="label label-pink"><?php echo $order_status;?></span>
													<?php }elseif($order_status == "Completed"){?>
													<span class="label label-success"><?php echo $order_status;?></span>
													<?php }else{?>
													<span class="label label-danger"><?php echo $order_status;?></span>
													<?php } ?>
													</p>
													
													<!--######## END OF ORDER STATUS VALIDATION #######-->
                                                    <p class="m-t-10"><strong>Order ID: </strong> #<?php echo $order_id;?></p>
                                                </div>
                                            </div><!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div class="m-h-50"></div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table m-t-30">
                                                        <thead>
                                                            <tr><th>#</th>
                                                            <th>Item</th>
                                                            <th>Image</th>
                                                            <th>Quantity</th>
                                                            <th>Unit Cost</th>
                                                            <th>Total</th>
                                                        </tr>
														</thead>
                                                        <tbody>
												 <?php 
												 
												 ########################### ORDER QUERY ####################################
											   $tb_select_order = "SELECT * FROM order_product_tb WHERE order_id = {$order_id} order by id desc  ";
											   $result_order = mysqli_query($connect,$tb_select_order);
											   if(!$result_order){
											   die ("SELECT TABLE FAILED".mysqli_error());
											   }
											   while($row_order = mysqli_fetch_array($result_order)){
											   $product_id = $row_order['2'];
											   $quantity = $row_order['1'];
											  #######################  PRODUCT QUERY #############################
											   $tb_select_product = "SELECT * FROM product_tb WHERE id = {$product_id} order by id desc  ";
											   $result_product = mysqli_query($connect,$tb_select_product);
											   if(!$result_product){
											   die ("SELECT TABLE FAILED".mysqli_error());
											   }
											   while($row_product = mysqli_fetch_array($result_product)){
											 
															?>
                                                            <tr>
                                                                <td>1</td>
                                                                <td><?php echo $row_product['1']; ?></td>
                                                                <td><img src="<?php echo $row_product['image']; ?>" width="50px" height="50px"></td>
                                                                <td><?php echo $quantity;?></td>
                                                                <td> x 
																<?php 
                                                                $total_quantity = $quantity + $total_quantity;
																
																if($row_product['sale_price'] != 0){
																$unit_price = $row_product['sale_price'];
																$unit_price = number_format($unit_price, 2);
																echo $unit_price;
																
																}else{
																$unit_price = $row_product['regular_price'];
																$unit_price = number_format($unit_price, 2);
																echo $unit_price;
																
																}
																?>
																
																</td>
                                                                <td>
																
																<?php 
																if($row_product['sale_price'] != 0){
																$total_price = $row_product['sale_price'] * $quantity;
																$total_price = number_format($total_price, 2);
																
																}else{
																
																$total_price = $row_product['regular_price'] * $quantity;
																$total_price = number_format($total_price, 2);
																
																}
																echo $total_price;
																?>
																
																
																</td>
                                                            </tr>
															
															<?php

															} // end of product list
															
															} // end of order list
															?>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="clearfix m-t-40">
                                                    <h5 class="small text-inverse font-600">PAYMENT TERMS AND POLICIES</h5>

                                                    <small>
                                                        All accounts are to be paid within 7 days from receipt of
                                                        invoice. To be paid by cheque or credit card or direct payment
                                                        online. If account is not paid within 7 days the credits details
                                                        supplied as confirmation of work undertaken will be charged the
                                                        agreed quoted fee noted above.
														
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-6 col-md-offset-3">
                                                <p class="text-right"><b>Total Quantity:</b> <?php echo $total_quantity;?> items</p>
												<p class="text-right"><b>Sub-total:</b> <?php 
												
												$total_amount = number_format($total_amount, 2);
												echo $total_amount;
												
												?></p>
                                                <p class="text-right">Discout: 0%</p>
                                                <p class="text-right">VAT: 0%</p>
                                                <hr>
                                                <h3 class="text-right">GHC  <?php echo $total_amount;?></h3>
                                            </div>
                                        </div>
                                        <hr>
                                        
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- end row -->


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


 
        </div>
        <!-- END wrapper -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="http://gentspack.effectstudiosgh.com/assets/js/jquery.min.js"></script>
        <script src="http://gentspack.effectstudiosgh.com/assets/js/bootstrap.min.js"></script>
        <script src="http://gentspack.effectstudiosgh.com/assets/js/detect.js"></script>
        <script src="http://gentspack.effectstudiosgh.com/assets/js/fastclick.js"></script>
        <script src="http://gentspack.effectstudiosgh.com/assets/js/jquery.slimscroll.js"></script>
        <script src="http://gentspack.effectstudiosgh.com/assets/js/jquery.blockUI.js"></script>
        <script src="http://gentspack.effectstudiosgh.com/assets/js/waves.js"></script>
        <script src="http://gentspack.effectstudiosgh.com/assets/js/jquery.nicescroll.js"></script>
        <script src="http://gentspack.effectstudiosgh.com/assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="http://gentspack.effectstudiosgh.com/assets/js/jquery.core.js"></script>
        <script src="http://gentspack.effectstudiosgh.com/assets/js/jquery.app.js"></script>

    </body>

</html>