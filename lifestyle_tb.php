<?php  require_once("includes/session.php");?>
<?php confirm_session();?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<?php	
  /*********************************************************************************************/
				/***************** 		START OF DELETE	***********************/
  /*********************************************************************************************/
								
								/* 		DELETE CODE  FOR NEWS 		*/
							if(isset($_GET['del_ls'])){
							$id = mysqli_real_escape_string($connect,$_GET['del_ls']);
							$query = "DELETE FROM lifestyle_tb WHERE id = {$id} LIMIT 1";
							$result = mysqli_query($connect,$query);
							if(mysqli_affected_rows($connect) == 1){
							
							echo "<script> window.location.replace('lifestyle_tb.php') </script>";
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
                                <h4 class="page-title">Life style</h4>
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
                
				<!--NEWS TABLE FIELD-->
				<div class="content">
                  
													
                  


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                   
                                    <div class="row">
                                        
                                        <div class="col-lg-15">
                             
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                
                                                <th>#</th>
												<th>Image</th>
											    <th>Title</th>
												 <th>Date</th>
                                                <th>Tag</th>
												<th>Published By</th>
												<th>Published</th>
												<th>Link</th>
												<th>Settings</th>
                                            </tr>
                                        </thead>

                                        <tbody>
								
                                                	    <?php
							   $tb_select = "SELECT * FROM lifestyle_tb  order by id desc  ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
											?>
                                    <tr>
									    
                                        <td><?php echo $row['0'];?></td>
										<td><img src="<?php echo $row['1'];?>" width="30px" height="30px"> </td>
										<td><?php echo $row['2'];?> </td>
										<td><?php echo $row['3'];?></td>
				
										<td><?php echo $row['5'];?></td>
										<td><?php echo $row['6'];?> </td>
										<td><?php echo $row['7'];?></td>
										<td><?php echo $row['8'];?></td>
										<td><?php echo "<a href=\"lifestyle_frm.php?edit_ls=".urlencode($row['0'])."\">Read</a> |  <a href=\"lifestyle_tb.php?del_ls=".urlencode($row['0'])."\" onClick =\"return confirm('Are you sure You want to Delete')\">Delete</a>";?></td>
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