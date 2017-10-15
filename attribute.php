<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>
<?php confirm_session();?>
<?php	

	/************************************* START GET POST FUNCTION  ********************************/
					           if(isset($_GET['edit_attribute'])){
								$edit_attribute = $_GET['edit_attribute'];  
								
					             }
	/*************************************END GET POST FUNCTION  ********************************/

	

/*********************************************************************************************/
		/************************    FOR INSERT BRAND   ***********************/
/*********************************************************************************************/
             
			 
			 


if(isset($_POST['submit'])){
   $errors = array();
   
	$name = mysqli_real_escape_string($connect,$_POST['name']);
	$date = mysqli_real_escape_string($connect,$_POST['date']);
	$desc = mysqli_real_escape_string($connect,$_POST['desc']);
    
	// CHECK TO SEE WHETHER IT EXIST OR NOT
	 $query="SELECT *  ";
	 $query.=" FROM attribute_tb  ";
	 $query.=" WHERE name = '{$name}'  "; 
   $result_set = mysqli_query($connect,$query);
    if(!$result_set){
				 die("Database connection failed: ".mysqli_error($connect));
							}
    if(mysqli_num_rows($result_set) == 1){
	
	$message = "<strong ><span class=\"label label-danger\"> Please the record already Exist </span></strong>".mysqli_error($connect);
	
	}else{
	 
	if(empty($errors)){
    
	// check and see whether image is empty
	
	$query ="INSERT INTO attribute_tb(name,description,date)
		           VALUES ('{$name}','{$desc}','{$date}')";
  $check = mysqli_query($connect,$query);
   if($check){
   $message = "<strong><span class=\"label label-success\">Please You Have Successfully Added New Record </span></strong>".mysqli_error($connect);
 
  }  else{
	 echo "upload failed!".mysqli_error($connect);
	  $message = "<strong><span class=\"label label-danger\"> upload failed! </span></strong>".mysqli_error($connect);
	}

} // end of errors


}// end of submit
}
/*********************************************************************************************/
				/***************** 		END ADD BRAND 	***********************/
  /*********************************************************************************************/
  
  
  
  
  /*********************************************************************************************/
				/***************** 		UPDATE   	***********************/
  /*********************************************************************************************/

  
  if(isset($_POST['update'])){
      $id = $_GET['edit_attribute'];
    
	$name = mysqli_real_escape_string($connect,$_POST['name']);
	$date = mysqli_real_escape_string($connect,$_POST['date']);
	$desc = mysqli_real_escape_string($connect,$_POST['desc']);
 
	

	$query="UPDATE attribute_tb SET
				name ='{$name}',
				description ='{$desc}'
                WHERE ID = '{$id}'				
			";			
		$result = mysqli_query($connect,$query);
		if(mysqli_affected_rows($connect) == 1){
		//success
		 $message = "<strong><span class=\"label label-success\">Record Updated Successfully </span></strong>".mysqli_error($connect);
		}else{
		// ERROR
		$message = "<strong><span class=\"label label-danger\">Update Failed </span></strong>".mysqli_error($connect);
		
		}

   

}


/*********************************************************************************************/
				/***************** 		END OF UPDATE 	***********************/
  /*********************************************************************************************/


  
  
  
  
  /*********************************************************************************************/
				/***************** 		START OF DELETE	***********************/
  /*********************************************************************************************/
  
  
							
								/* 		DELETE CODE  FOR NEWS 		*/
							if(isset($_GET['del_attribute'])){
							$id = mysqli_real_escape_string($connect,$_GET['del_attribute']);
							$query = "DELETE FROM attribute_tb WHERE ID = {$id} LIMIT 1";
							$result = mysqli_query($connect,$query);
							if(mysqli_affected_rows($connect) == 1){
							
							echo "<script> window.location.replace('attribute.php') </script>";
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
                                <h4 class="page-title">Attributes</h4>
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
                            <div class="col-sm-4">
                                <div class="card-box">
                                    <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="zmdi zmdi-more-vert"></i>
                                        </a>
                                       
                                    </div>

                        			   <div class="text-center">
                    <h4 class="text-uppercase font-bold m-b-0">Add New ATTRIBUTE  </h4>
					<p class="text font-14 m-b-30">Product categories for your store can be managed here. To change the order of categories on the front-end</p>
					<p><?php If(!empty($message)){
					echo $message;
					}
					?></p>
					
                </div>
				<br/>

                                    <div class="row">
                                        <div class="col-lg-12">
									<?php if(empty($edit_attribute)){?>
                                            <form class="form-horizontal group-border-dashed" action="attribute.php" method="POST" enctype="multipart/form-data">
                                              
					         <input type ="hidden"  value="<?php echo date("d-M-Y") ; ?>" name="date"/> 

						  <p class="text font-14 m-b-30">Name *</p>
                         <div class="form-group ">
						
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Name" name="name">
                            </div>
                        </div>
						                     
												
                                         <p class="text font-14 m-b-30">Description</p>
                                      <div class="form-group">
							
								<div class="col-sm-12">
								<textarea rows="10" cols=45 name="desc"></textarea>
								</div>
							      </div>

											<div class="form-group">
                                                    <div class="col-sm-offset-6 col-sm-9 m-t-15">
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light" name ="submit">
                                                            Submit
                                                        </button>
                                                        <button type="reset" class="btn btn-default waves-effect m-l-5">
                                                            Cancel
                                                        </button>
														
                                                        
                                                    </div>
                                                </div>
												
												   </form>
												   
												
                                        </div><!-- end col -->

                                        <?php }else{?>
										
										
										
										
										
						 <form class="form-horizontal group-border-dashed" action="attribute.php?edit_attribute=<?php echo $edit_attribute;?>"  method="POST" enctype="multipart/form-data">		
								<?php
								
							   $tb_select = "SELECT * FROM attribute_tb WHERE ID = {$edit_attribute} ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
											?>
											
						  <p class="text font-14 m-b-30">Name *</p>
                         <div class="form-group ">
						
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Name" name="name" value="<?php echo $row['name'];?>">
                            </div>
                        </div>
						                   
										   
										   
                                         <p class="text font-14 m-b-30">Description</p>
                                      <div class="form-group">
							
								<div class="col-sm-12">
								<textarea rows="10" cols=45 name="desc"><?php echo $row['description'];?></textarea>
								</div>
							      </div>

											<div class="form-group">
                                                    <div class="col-sm-offset-6 col-sm-9 m-t-15">
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light" name ="update">
                                                            Update
                                                        </button>
                                                        <button type="reset" class="btn btn-default waves-effect m-l-5">
                                                            Cancel
                                                        </button>
														
                                                        
                                                    </div>
                                                </div>
												
												   </form>
												   
												
                                        </div><!-- end col -->
										
										
										<?php } // end of loop
										
										}// end of update
										
										?>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
									
					
                    </div> <!-- container -->
					
					<!-- table -->
					<div class="col-sm-8">
                                <div class="card-box">
                                   
                                    <div class="row">
                                        
                                        <div class="col-lg-15">
                             
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                
                                                <th>#</th>
											    <th>NAME</th>
												<th>DESC</th>
												<th>DATE</th>
												<th>SETTINGS</th>
                                            </tr>
                                        </thead>

                                        <tbody>
								
                                                	    <?php
							   $tb_select = "SELECT * FROM attribute_tb  order by ID desc  ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
											?>
                                    <tr>

                                        <td><?php echo $row['0'];?></td>
										 <td><?php echo $row['1'];?></td>
										<td><?php echo $row['2'];?> </td>
										<td><?php echo $row['3'];?></td>
										

										<td><?php echo "<a href=\"attribute.php?edit_attribute=".urlencode($row['0'])."\">Read</a> |  <a href=\"attribute.php?del_attribute=".urlencode($row['0'])."\" onClick =\"return confirm('Are you sure You want to Delete')\">Delete</a>";?></td>
                                    </tr>
                                    
									<?php }   ?>
                                            
                                     
                                        </tbody>
                                    </table>
											
											
											
                                        
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div>
                            </div><!-- end col -->

                </div> <!-- content -->
				
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