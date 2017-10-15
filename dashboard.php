<?php require_once("includes/session.php");?>
<?php confirm_session();?>
<?php require_once("includes/connection.php");?>
<?php 

//require_once("includes/function.php");?>



<!DOCTYPE html>
<html>  
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
        <link rel="shortcut icon" href="assets/images/favicon.ico">

       <title><?php echo $page_title;?></title>
        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <!-- App css -->
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
		
		
		 <script src="jquery.js"></script> 
		   <script src="jquery-1.12.0.min.js"></script>
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
		
						 $('#'+id+'success_message').fadeIn().html("<td><span class='label label-success'><i class='fa  fa-check-circle'></i></span> </td>");  
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
                                <h4 class="page-title">Dashboard</h4>
                            </li>
                        </ul>

                        

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
            <!-- Top Bar End -->
			
        <?php require_once("includes/backend_header.php");?>	
		
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
           <div class="content-page">
               
               <!-- Start content -->
                <div class="content">
                    <div class="container">
                       <!--######  TOTAL SALES #### -->
					   
					    <?php
							   
							   $current_year = date("Y");
							   
							   $tb_select = "SELECT sum(totalmount) as 'totalsales' FROM order_tb WHERE YEAR(date) = {$current_year} ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error($connect));
							   }
							   while($row = mysqli_fetch_array($result)){
							   
							    $totalsales = $row['totalsales'];
							  }
							   if($totalsales == 0){}else{
							  $year_share = ceil(($totalsales/$totalsales)*100);
							  }
					 ?>
					   
					   
					     <!--######  TOTAL SALES #### -->
					   
					   

                        <div class="row">

                            <div class="col-lg-3 col-md-6">
                        		<div class="card-box">
                                   

                        			<h4 class="header-title m-t-0 m-b-30">Today's Sales</h4>
									
									 <!--######  TODAYS SALES #### -->
									
									<?php
							   
							   $todays = date("Y-m-d");
							   $tb_select = "SELECT sum(totalmount) as 'todayssales' FROM order_tb WHERE date = '{$todays}' ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error($connect));
							   }
							   while($row = mysqli_fetch_array($result)){
							   
							    $todayssales = $row['todayssales'];
							  }
							  if($todayssales == 0){}else{
							  $todays_share = ceil(($todayssales/$totalsales)*100);
							  }
					           ?>
									
                                    <div class="widget-chart-1">
                                        <div class="widget-chart-box-1">
                                            <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#f05050 "
                                               data-bgColor="#F9B9B9" value="<?php echo $todays_share; ?>"
                                               data-skin="tron" data-angleOffset="180" data-readOnly=true
                                               data-thickness=".15"/>
                                        </div>

                                        <div class="widget-detail-1">
                                            <h2 class="p-t-10 m-b-0"> GHC <?php echo

                                               $todayssales = number_format($todayssales, 2);
											 
											
											
											?> </h2>
                                            <p class="text-muted">today's Sales</p>
                                        </div>
                                    </div>
									
									
                        		</div>
                            </div><!-- end col -->
								
								 <!--######  TODAYS SALES #### -->
							
                            <div class="col-lg-3 col-md-6">
                        		<div class="card-box">
                                   

                        			<h4 class="header-title m-t-0 m-b-30">This Week Sales</h4>	
							<!--######  THIS WEEK SALES #### -->
									<?php
							   
							  $today = getdate();
				              $curMonth =  date("m");
							  $weekStartDate = $today['mday'] - $today['wday'];
							  $weekEndDate = $today['mday'] - $today['wday']+6;
							  
	                           ///$month =  date("m");
							   
							   $tb_select = "SELECT sum(totalmount) as 'weeksales' FROM order_tb WHERE MONTH(date) = '{$curMonth}' AND DAY(date) BETWEEN '{$weekStartDate}' AND '{$weekEndDate}'";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error($connect));
							   }
							   while($row = mysqli_fetch_array($result)){
							   
							    $weeksales = $row['weeksales'];
							  }
							   if($week_share == 0){}else{
							  $week_share = ceil(($weeksales/$totalsales)*100);
							  }
					           ?>	
										
                                    <div class="widget-box-2">
                                        <div class="widget-detail-2">
                                            <span class="badge badge-success pull-left m-t-20"><?php echo $week_share;?>% <i class="zmdi zmdi-trending-up"></i> </span>
                                            <h2 class="m-b-0"> GHC <?php echo
                                             
											 $weeksales = number_format($weeksales, 2);
											//$weeksales;
											?> </h2>
                                            <p class="text-muted m-b-25">Week sales</p>
                                        </div>
                                        <div class="progress progress-bar-success-alt progress-sm m-b-0">
                                            <div class="progress-bar progress-bar-success" role="progressbar"
                                                 aria-valuenow="<?php echo $week_share;?>" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: <?php echo $week_share;?>%;">
                                                <span class="sr-only"><?php echo $week_share;?>% Complete</span>
                                            </div>
                                        </div>
                                    </div>
									
									
									
                        		</div>
                            </div><!-- end col -->
                             <!--######  THIS WEEK SALES #### -->
							 
							 
                            <div class="col-lg-3 col-md-6">
                        		<div class="card-box">
                                    
									<!--######  THIS MONTH SALES #### -->
									<?php
							   
							 
							  
	                           $thismonth =  date("m");
							   
							   $tb_select = "SELECT sum(totalmount) as 'thismonthsales' FROM order_tb WHERE MONTH(date) = '{$thismonth}'";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error($connect));
							   }
							   while($row = mysqli_fetch_array($result)){
							   
							    $thismonthsales = $row['thismonthsales'];
							  }
							  if($thismonthsales == 0){}else{
							  $month_share = ceil(($thismonthsales/$totalsales)*100);
							  }
					           ?>	
									  
									  

                        			<h4 class="header-title m-t-0 m-b-30">This Month Sales</h4>

                                    <div class="widget-chart-1">
                                        <div class="widget-chart-box-1">
                                            <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#ffbd4a"
                                               data-bgColor="#FFE6BA" value="<?php echo $month_share; ?>"
                                               data-skin="tron" data-angleOffset="180" data-readOnly=true
                                               data-thickness=".15"/>
                                        </div>
                                        <div class="widget-detail-1">
                                            <h2 class="p-t-10 m-b-0"> GHC <?php echo 
											
											 $thismonthsales = number_format($thismonthsales, 2);
											//$thismonthsales;
											?> </h2>
                                            <p class="text-muted">This Month Sales</p>
                                        </div>
                                    </div>
                        		</div>
                            </div><!-- end col -->
                           
						   <!--######  THIS MONTH SALES #### -->
							
							
                            <div class="col-lg-3 col-md-6">
                        		<div class="card-box">
                                   
                              <!--######  THIS YEAR SALES #### -->
                        			<h4 class="header-title m-t-0 m-b-30">This Year Sales</h4>

                                    <div class="widget-box-2">
                                        <div class="widget-detail-2">
                                            <span class="badge badge-pink pull-left m-t-20"><?php echo $year_share; ?>% <i class="zmdi zmdi-trending-up"></i> </span>
                                            <h2 class="m-b-0"> GHC <?php echo 
											
											//$totalsales; 
											$totalsales = number_format($totalsales, 2);
											
											?> </h2>
                                            <p class="text-muted m-b-25">Yearly Sales</p>
                                        </div>
                                        <div class="progress progress-bar-pink-alt progress-sm m-b-0">
                                            <div class="progress-bar progress-bar-pink" role="progressbar"
                                                 aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: <?php echo $year_share; ?>%;">
                                                <span class="sr-only"><?php echo $year_share;?>% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                        		</div>
                            </div><!-- end col -->
                            <!--######  THIS YEAR SALES #### -->
                        </div>
                        <!-- end row -->

                 




                        <div class="row">
                            

                            <div class="col-lg-12">
                                <div class="card-box">
                                    

                        			<h4 class="header-title m-t-0 m-b-30">Today's Sales</h4>

                                    <div class="table-responsive">
                                        <table class="table">
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
								  
							   $tb_select = "SELECT * FROM order_tb WHERE date = '{$todays}' order by id desc  ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
							   
								?>
                                    <tr id="<?php echo $row['0']; ?>">
								
										<td id="<?php echo $row['0'];?>success_message">
										<?php if($row['10'] == "Cancelled"){?>
										<span class="label label-danger"><i class="fa fa-times-circle"></i></span>
										<?php }elseif($row['10'] == "Completed"){ ?>
										<span class="label label-success"><i class="fa  fa-check-circle"></i></span>
										<?php }elseif($row['10'] == "Pending"){ ?>
										<span class="label label-pink"><i class="fa  fa-ellipsis-h"></i></span>
										<?php }else{ ?>
										<span class="label label-warning"><i class="fa  fa-exclamation-circle"></i></span>
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
                                    </div>
                                </div>
                            </div><!-- end col -->

                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->
				
   <!-- foooter  --->
      <?php require_once("includes/backend_footer.php");?>
   <!-- foooter  --->
            </div>
            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
           

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
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- KNOB JS -->
        <!--[if IE]>
        <script type="text/javascript" src="assets/plugins/jquery-knob/excanvas.js"></script>
        <![endif]-->
        <script src="assets/plugins/jquery-knob/jquery.knob.js"></script>

        <!--Morris Chart-->
		<script src="assets/plugins/morris/morris.min.js"></script>
		<script src="assets/plugins/raphael/raphael-min.js"></script>

        <!-- Dashboard init -->
        <script src="assets/pages/jquery.dashboard.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>

</html>
	