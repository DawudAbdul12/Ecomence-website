<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<?php	

	/************************************* START GET POST FUNCTION  ********************************/
					           if(isset($_GET['order_id'])){
								$order_id = $_GET['order_id'];  
								
					             }
	/*************************************END GET POST FUNCTION  ********************************/

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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App title -->
        <title>ORDER INVOICE</title>

        <!-- App CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

      

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="dashboard.php" class="logo"><img src="img\logo.png" style="width:150px; height:50px;"><i class=""> <img src="img\logo.png"></i></a>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">

                        <!-- Page title -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left">
                                    <i class="zmdi zmdi-menu"></i>
                                </button>
                            </li>
                            <li>
                                <h4 class="page-title">Invoice</h4>
                            </li>
                        </ul>

                        <!-- Right(Notification and Searchbox -->
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <!-- Notification -->
                                <div class="notification-box">
                                    <ul class="list-inline m-b-0">
                                        <li>
                                            <a href="" class="right-bar-toggle">
                                                <i class="zmdi zmdi-notifications-none"></i>
                                            </a>
                                            <div class="noti-dot">
                                                <span class="dot"></span>
                                                <span class="pulse"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Notification bar -->
                            </li>
                           
                        </ul>

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
           
				 <?php require_once("includes/backend_header.php");?>
           
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>ORDER </h4>
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
                                        <div class="hidden-print">
                                            <div class="pull-right">
							     <form action="invoice.php?order_id=<?php echo $order_id;?>" Method="Post">
                                <select name="status">
								<option <?php if( $order_status == "Pending"){echo "Selected";}?> value="Pending">Pending</option>
								<option <?php if( $order_status == "Cancelled"){echo "Selected";}?>  value="Cancelled">Cancelled</option>
								<option <?php if( $order_status == "Completed"){echo "Selected";}?>  value="Completed">Completed</option>
								</select>
								<input type="hidden" value="<?php echo $order_id;?>" name="order_id">
                          
                                                <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                <button class="btn btn-primary waves-effect waves-light" name="submit">Submit</button>
												</form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- end row -->


                    </div> <!-- container -->

                </div> <!-- content -->

                 <!-- foooter  --->
      <?php require_once("includes/backend_footer.php");?>
   <!-- foooter  --->
            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            <div class="side-bar right-bar">
                <a href="javascript:void(0);" class="right-bar-toggle">
                    <i class="zmdi zmdi-close-circle-o"></i>
                </a>
                <h4 class="">Notifications</h4>
                <div class="notification-list nicescroll">
                    <ul class="list-group list-no-border user-list">
                        <li class="list-group-item">
                            <a href="#" class="user-list-item">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-2.jpg" alt="">
                                </div>
                                <div class="user-desc">
                                    <span class="name">Michael Zenaty</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">2 hours ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="user-list-item">
                                <div class="icon bg-info">
                                    <i class="zmdi zmdi-account"></i>
                                </div>
                                <div class="user-desc">
                                    <span class="name">New Signup</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">5 hours ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="user-list-item">
                                <div class="icon bg-pink">
                                    <i class="zmdi zmdi-comment"></i>
                                </div>
                                <div class="user-desc">
                                    <span class="name">New Message received</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">1 day ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item active">
                            <a href="#" class="user-list-item">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-3.jpg" alt="">
                                </div>
                                <div class="user-desc">
                                    <span class="name">James Anderson</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">2 days ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item active">
                            <a href="#" class="user-list-item">
                                <div class="icon bg-warning">
                                    <i class="zmdi zmdi-settings"></i>
                                </div>
                                <div class="user-desc">
                                    <span class="name">Settings</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">1 day ago</span>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /Right-bar -->

        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>

</html>