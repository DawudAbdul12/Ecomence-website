<?php  require_once("includes/session.php");?>
<?php confirm_session();?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<?php	

  /*********************************************************************************************/
				/***************** 		START OF DELETE	***********************/
  /*********************************************************************************************/
								
								/* 		DELETE CODE  FOR NEWS 		*/
							if(isset($_GET['del_product'])){
							$id = mysqli_real_escape_string($connect,$_GET['del_product']);
							$query = "DELETE FROM product_tb WHERE ID = {$id} LIMIT 1";
							$result = mysqli_query($connect,$query);
							if(mysqli_affected_rows($connect) == 1){
							
							echo "<script> window.location.replace('product_tb.php') </script>";
							}else{
							  echo "<p>delete Failed</p>".mysqli_error($connect);
							}
							}
							
  /*********************************************************************************************/
				/***************** 		END OF DELETE	***********************/
  /*********************************************************************************************/
  
  
?>

<!DOCTYPE html>
<html>
    

<head>
        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
 <link href="assets/plugins/summernote/dist/summernote.css" rel="stylesheet" /><!-- Custom box css -->
        <!-- App title -->
        <title><?php echo $page_title;?></title>
		
		<!-- DataTables -->
        <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

      
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
		
		
		<script type="text/javascript" src="jquery.js"></script> 
		<script type="text/javascript">

    function update_order(id)
    {
	  var ele=document.getElementById(id);
	  var order_id=document.getElementById(id+"order_id").value;
	 
	 //alert(order_id);
	 
	  $.ajax({
        type:'post',
        url:'order_complete.php',
        data:{
          //item_src:img_src,
          OrderID:order_id
        },
        success:function(response){
		
						 $('#'+id+'success_message').fadeIn().html("<td><i class='fa fa-check-circle-o'></i><span class='text-success'></span></a> </td>");  
                         setTimeout(function(){  
                              $('#'+id+'success').fadeOut("Slow");  
                          }, 700);  
        }
      });
	
    }
    
	
</script>

   
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
                                <h4 class="page-title">Order Table</h4>
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
                
				<!--NEWS TABLE FIELD-->
				<div class="content">
                  
				   <!--################### STATISTIC ROW #########################################-->
				   
				       <div class="row">
					 
						
						<?php $totalTV = 50;
						 $date = date("d-M-Y");
						?>
						
						<div class="col-lg-3 col-md-6">
                        		<div class="card-box">
                                   

                        			<h4 class="header-title m-t-0 m-b-30">Total Orders</h4>
										 <?php
										
							   $tb_select = "SELECT count(id) as 'total_order' FROM order_tb  ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error($connect));
							   }
							   while($row = mysqli_fetch_array($result)){
							   
							    $total_order = $row['total_order'];
							  }
											?>
											
											<?php 
											  if($total_order == 0){}else{
											  $total =  ceil(($total_order/$total_order)*100);
											  }
											   ?>
											   
                                    <div class="widget-box-2">
                                        <div class="widget-detail-2">
                                            <span class="badge badge-pink pull-left m-t-20"><?php echo $total; ?>% <i class="zmdi zmdi-trending-up"></i> </span>
                                            <h2 class="m-b-0"> <?php echo $total_order; ?> </h2>
                                            <p class="text-muted m-b-25">Today's Total Record(s)</p>
                                        </div>
                                        <div class="progress progress-bar-pink-alt progress-sm m-b-0">
                                            <div class="progress-bar progress-bar-pink" role="progressbar"
                                                 aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: <?php echo $total; ?>%;">
                                                <span class="sr-only"><?php echo $total; ?>% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                        		</div>
                            </div><!-- end col -->

                        
						
						
						 <div class="col-lg-3 col-md-6">
                        		<div class="card-box">
                                   
                        			<h4 class="header-title m-t-0 m-b-30">Completed Orders</h4>
										
										 <?php
								$status = "completed";
							   $tb_select = "SELECT count(id) as 'completed_order' FROM order_tb WHERE 	complete_status ='{$status}' ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error($connect));
							   }
							   while($row = mysqli_fetch_array($result)){
							   
							    $totalcompleted = $row['completed_order'];
							  }
											?>
										
                                    <div class="widget-box-2">
									<?php 
											 if($total_order == 0){}else{ 
											  $total =  ceil(($totalcompleted/$total_order)*100);
											  }
											   ?>
                                        <div class="widget-detail-2">
                                            <span class="badge badge-success pull-left m-t-20"><?php echo $total;?>% <i class="zmdi zmdi-trending-up"></i> </span>
                                            <h2 class="m-b-0"> <?php echo $totalcompleted;?> </h2>
                                            <p class="text-muted m-b-25">Total Complete orders</p>
                                        </div>
                                        <div class="progress progress-bar-success-alt progress-sm m-b-0">
                                            <div class="progress-bar progress-bar-success" role="progressbar"
                                                 aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: <?php echo $total;?>%;">
                                                <span class="sr-only"><?php echo $total;?>% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                        		</div>
                            </div><!-- end col -->
						
						

                            <div class="col-lg-3 col-md-6">
                        		<div class="card-box">
                                    

                        			<h4 class="header-title m-t-0 m-b-30">Pending orders</h4>
									
									 <?php
							   $status = "pending";
							   $tb_select = "SELECT count(id) as 'pending' FROM order_tb WHERE 	complete_status ='{$status}'";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error($connect));
							   }
							   while($row = mysqli_fetch_array($result)){
							   
							    $totalpending = $row['pending'];
							  }
											?>

						
									<?php 
											   if($total_order == 0){}else{ 
											  $total_orders_pending =  ceil(($totalpending/$total_order)*100);
											  }
											   ?>
                                         <div class="widget-box-2">
									
                                        <div class="widget-detail-2">
                                            <span class="badge badge-warning pull-left m-t-20"><?php echo $total_orders_pending;?>% <i class="zmdi zmdi-trending-up"></i> </span>
                                            <h2 class="m-b-0"> <?php echo $totalpending;?> </h2>
                                            <p class="text-muted m-b-25">Total Pending Orders</p>
                                        </div>
                                        <div class="progress progress-bar-warning-alt progress-sm m-b-0">
                                            <div class="progress-bar progress-bar-warning" role="progressbar"
                                                 aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: <?php echo $total_orders_pending;?>%;">
                                                <span class="sr-only"><?php echo $total_orders_pending;?>% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                        		</div>
                            </div><!-- end col -->

                           

                            <div class="col-lg-3 col-md-6">
                        		<div class="card-box">
                                   

                        			<h4 class="header-title m-t-0 m-b-30">Cancelled Orders</h4>
									
									 <?php
										$status = "Cancelled";
							   $tb_select = "SELECT count(id) as 'cancelled' FROM order_tb WHERE complete_status ='{$status}' ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error($connect));
							   }
							   while($row = mysqli_fetch_array($result)){
							   
							    $totalcancelled = $row['cancelled'];
							  }
							?>
                                     <?php 
											   if($total_order == 0){}else{ 
											  $total_order_canccelled =  ceil(($totalcancelled/$total_order)*100);
											  }
											   ?>

                                    <div class="widget-box-2">
									
                                        <div class="widget-detail-2">
                                            <span class="badge badge-danger pull-left m-t-20"><?php echo $total_order_canccelled;?>% <i class="zmdi zmdi-trending-up"></i> </span>
                                            <h2 class="m-b-0"> <?php echo $totalcancelled;?> </h2>
                                            <p class="text-muted m-b-25">Total Cancelled orders</p>
                                        </div>
                                        <div class="progress progress-bar-danger-alt progress-sm m-b-0">
                                            <div class="progress-bar progress-bar-danger" role="progressbar"
                                                 aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: <?php echo $total_order_canccelled;?>%;">
                                                <span class="sr-only"><?php echo $total_order_canccelled;?>% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                        		</div>
                            </div><!-- end col -->

                            
				   
				   </div>
				   
						
				   <!--################### STATISTIC ROW #########################################-->
						
						
													
                  


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                   
                                    <div class="row">
                                        
                                        <div class="col-lg-15">
                             
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th>Order</th>
												<th>Purchased</th>
											    <th>Deliver to</th>
												 <th>Date</th>
												 <th>Total</th>
												<th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
								
                                  <?php
								  
							   $tb_select = "SELECT * FROM order_tb  order by id desc  ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
							   
								?>
                                    <tr id="<?php echo $row['0']; ?>">
								
										<td id="<?php echo $row['0'];?>success_message">
										<?php if($row['10'] == "Cancelled"){?>
										<i class="fa fa-times-circle"></i>
										<?php }elseif($row['10'] == "Completed"){ ?>
										<i class="fa  fa-check-circle"></i>
										<?php }elseif($row['10'] == "Pending"){ ?>
										<i class="fa  fa-ellipsis-h"></i>
										<?php }else{ ?>
										<i class="fa  fa-exclamation-circle"></i>
										<?php }?>
										
										</td>
										
                                        <td>
										# <?php echo $row['0'];?>&nbsp | &nbsp <?php echo $row['2'];?> <br/>
										<i class="fa fa-phone"></i> <?php echo $row['3'];?> 
									
										</td>
										
										<td><?php echo $row['4'];?> items </td>
										
										<td><?php echo $row['5'];?></td>
										
										<td><i class="fa  fa-clock-o"></i> <?php echo $row['6'];?>
										    <br/>
											<?php echo $row['7'];?>
										</td>
										<td>₵ <?php 
										$totalamount = $row['8'];
										echo $totalamount = number_format($totalamount, 2);
										
										  ?><br/>
										    <?php echo $row['9'];?>
										</td>
										
										<td> 
										<?php if($row['10'] != "Completed"){?>
										 <input type="hidden" name="pid" id="<?php echo $row['0']; ?>order_id" value="<?php echo $row['0']; ?>">
										<button onclick="update_order('<?php echo $row['0']; ?>')" id="<?php echo $row['0'];?>success" ><i class="fa  fa-check"></i></button>
										
										<?php }?>
									
										<a href="invoice.php?order_id=<?php echo $row['0']; ?>"> <button><i class="fa  fa-eye"></i></button></a>
									
										</td>
                                    </tr>
									<?php }   ?>
                                        </tbody>
                                    </table>
											
											
											
                                        
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->
			<!--NEWS END-->
				

 <!-- foooter  --->
      <?php require_once("includes/backend_footer.php");?>
   <!-- foooter  --->

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


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
          <script src="assets/pages/jquery.inbox.js"></script>
		  
        <!-- Validation js (Parsleyjs) -->
        <script type="text/javascript" src="assets/plugins/parsleyjs/dist/parsley.min.js"></script>
			
			 <!--form validation init-->
        <script src="assets/plugins/summernote/dist/summernote.min.js"></script>
		
		   <!-- Modal-Effect -->
        <script src="assets/plugins/custombox/dist/custombox.min.js"></script>
        <script src="assets/plugins/custombox/dist/legacy.min.js"></script>
		
		
        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script type="text/javascript">
			$(document).ready(function() {
				$('form').parsley();
			});
		</script>
		
        <script>

            jQuery(document).ready(function(){

                $('.summernote').summernote({
                    height: 320,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
                });

            });
        </script>
		
		

        <!-- Datatables-->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();

        </script>
		

    </body>

</html>

<?php
	 if(isset($connect)){
	 mysqli_close($connect);
	 }
?>