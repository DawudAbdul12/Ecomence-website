<?php require_once("includes/session.php");?>
<?php
if($_SESSION['type'] != "Administrator"){
   header("LOCATION:login-user.php");
   exit;
}?>
<?php confirm_session();?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<?php
/************************************* START GET POST FUNCTION  ********************************/
					           if(isset($_GET['users'])){
								$edit_user = $_GET['users'];  
								
					             }
	/*************************************END GET POST FUNCTION  ********************************/
	
	?>
<?php	
 
if(isset($_POST['submit'])){

   $errors = array();
   
   $name=basename($_FILES['small_img']['name']);
	$t_name=$_FILES['small_img']['tmp_name'];
	$dir='img';
	$email = mysqli_real_escape_string($connect,$_POST['Email']);
	$date = mysqli_real_escape_string($connect,$_POST['date']);
	$username = mysqli_real_escape_string($connect,$_POST['Username']);
	$password = mysqli_real_escape_string($connect,$_POST['Password']);
	$cpassword = mysqli_real_escape_string($connect,$_POST['Cpassword']);
	$type = mysqli_real_escape_string($connect,$_POST['Type']);
	$Status = mysqli_real_escape_string($connect,$_POST['Status']);
	$activated = 0;
	
	$hashed_password = sha1($password);
    IF($password != $cpassword){
	  $errors = "<strong style=\"color:#F00; padding:20px 20px 0px 0px;\">PASSWORD DOESNT MATCH</strong>";
	  $message = $errors;
	}
	if(empty($errors)){
	
     $query="SELECT *  ";
	 $query.=" FROM users_tb  ";
	 $query.=" WHERE uname = '{$username}'  ";
	 $query.=" AND encrypt= '{$hashed_password}'  ";
	 
	  
   $result_set = mysqli_query($connect,$query);
    if(!$result_set){
				 die("Database connection failed: ".mysqli_error($connect));
							}
    if(mysqli_num_rows($result_set) >= 1){
	   
	   $message = "<strong style=\"color:#F00;\"> The User already Exist </strong>";
	
	}else {

	if(move_uploaded_file($t_name,$dir."/".$name) ){
  $query ="INSERT INTO users_tb(uname,encrypt,email,type,status,date,image,activated)
 VALUES ('{$username}','{$hashed_password}','{$email}','{$type}','{$Status}','{$date}','img/{$name}','{$activated}')";
  $pagess = mysqli_query($connect,$query);
   if($pagess){
   $message = "<strong style=\"color:#F00; padding:20px 20px 0px 0px;\">Please You Have Successfully Added A New User </strong>".mysqli_error($connect);
 // header("LOCATION:dashboard.php");
 
  } else{
	 echo "upload failed!".mysqli_error($connect);
	  $message = "<strong style=\"color:#F00; padding:20px 20px 0px 0px;\"> upload failed!</strong>".mysqli_error($connect);
	}

 }
}

}

     
	}
	
	
	// START OF UPDATE USER SCRIPT
	
	
	
	if(isset($_POST['update'])){

    $errors = array();
    $id = $_GET['users'];
	$type = mysqli_real_escape_string($connect,$_POST['Type']);
	$Status = mysqli_real_escape_string($connect,$_POST['Status']);
	if(empty($errors)){
   
	 $query="UPDATE users_tb SET
				type ='{$type}',
				status ='{$Status}'				
                WHERE ID = '{$id}'				
			";		
  $result = mysqli_query($connect,$query);
		if(mysqli_affected_rows($connect) == 1){
		//echo "<script> window.location.replace('login-user.php') </script>";
		$message = "<strong style=\"color:#F00; padding:20px 20px 0px 0px;\">Record Updated Successfully</strong>".mysqli_error($connect);
		}else{
	 echo "upload failed!".mysqli_error($connect);
	  $message = "<strong style=\"color:#F00; padding:20px 20px 0px 0px;\"> Update failed!. check the form and Update again </strong>".mysqli_error($connect);
	}

	  
	}

}

// END OF UPDATE USER SCRIPT 
	
	
	
	
/*********************************************************************************************/
				/***************** 		END ADD USER	***********************/
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
                                <h4 class="page-title">User Register</h4>
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
                    <h4 class="text-uppercase font-bold m-b-0">Register</h4>
					<p><?php If(!empty($message)){
					echo $message;
					}
					?></p>
                </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                            <?php if(isset($edit_user)){?> 
							
							 <!--  START FOR UPDATE USER -->
							
							
                      <form class="form-horizontal m-t-20" action="page-register-user.php?users=<?php echo $edit_user;?>" method="POST" enctype="multipart/form-data">

						 <?php
							   $tb_select = "SELECT * FROM users_tb WHERE ID = {$edit_user} ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
											?>
                         <div class="form-group ">
							<div class="col-xs-12">
								<input class="form-control" type="text" required="" value=<?php echo $row['1'];?> Name="Username" placeholder="Username">
							</div>
						</div>
           
                                    
					
						<div class="form-group ">
							<div class="col-xs-12">
							          <select class="form-control select2" Name="Type" required="Select User Type">
                                  
										   <option>Select User Type</option>
                                            <option <?php if($row['4'] == "Administrator" ){ echo "selected = selected"; }?> value="Administrator">Administrator</option>
                                            <option <?php if($row['4'] == "User" ){ echo "selected = selected"; }?> value="User">User</option>
                                       
                                            </select>
			
							</div>
						</div>
						
						<div class="form-group ">
							<div class="col-xs-12">
								<select class="form-control select2" name="Status">

                                            <option  <?php if($row['5'] == "Unblock" ){ echo "selected = selected"; }?> value="Unblock">Unblock</option>
                                            <option  <?php if($row['5'] == "Block" ){ echo "selected = selected"; }?> value="Block">Block</option>
                                       
                                            </select>
							</div>
						</div>
						<?php }   ?>

						<div class="form-group text-center m-t-40">
							<div class="col-xs-12">
								<button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit" name ="update">
									Update
								</button>
							</div>
						</div>

					</form>
					
					
					 <!--  END FOR UPDATE USER -->
					
					
					<?php }else{?>	
					
                         <!--  START FOR ADD USER -->
			   <form class="form-horizontal m-t-20" action="page-register-user.php" method="POST" enctype="multipart/form-data">

						<div class="form-group ">
							<div class="col-xs-12">
								<input class="form-control" type="email" required=""  Name="Email" placeholder="Email">
								<input type ="hidden"  value="<?php echo date("d/m/Y") ; ?>" name="date"/> 
							</div>
						</div>

						<div class="form-group ">
							<div class="col-xs-12">
								<input class="form-control" type="text" required="" Name="Username" placeholder="Username">
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12">
								<input class="form-control" type="password" required="" Name="Password" placeholder="Password">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12">
								<input class="form-control" type="password" required="" Name ="Cpassword" placeholder="Confirm Password">
							</div>
						</div>
						
						<div class="form-group ">
							<div class="col-xs-12">
							          <select class="form-control select2" Name="Type" required="Select User Type">
                                  
										   <option>Select User Type</option>
                                            <option value="Administrator">Administrator</option>
                                            <option value="User">User</option>
                                       
                                            </select>
			
							</div>
						</div>
						
						<div class="form-group ">
							<div class="col-xs-12">
								<select class="form-control select2" name="Status">

                                            <option value="Unblock">Unblock</option>
                                            <option value="Block">Block</option>
                                       
                                            </select>
							</div>
						</div>
						
						<div class="form-group ">
							<div class="col-xs-12">
								<input type="file" class="form-control" 
                             parsley-type="" placeholder="Enter a valid e-mail" required="" name="small_img"/>
							</div>
						</div>
						
						
						
						

						<div class="form-group">
							<div class="col-xs-12">
								<div class="checkbox checkbox-custom">
									<input id="checkbox-signup" type="checkbox" checked="checked">
									<label for="checkbox-signup">I accept <a href="#">Terms and Conditions</a></label>
								</div>
							</div>
						</div>

						<div class="form-group text-center m-t-40">
							<div class="col-xs-12">
								<button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit" name ="submit">
									Register
								</button>
							</div>
						</div>

					</form>
					 <!--  END FOR ADD USER -->
					
				
					<?php } ?>


							
                                        
                                        </div><!-- end col -->
                                    </div><!-- end row -->
									<!-- END OF ADD NEWS-->
									
									     
								
                </div> 
				
				 </div> 
				 
				 
				 
				 
				   <div class="col-sm-8">
                                <div class="card-box">
                                    <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="zmdi zmdi-more-vert"></i>
                                        </a>
                                       
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            
                            <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                
                                                <th>USERNAME</th>
                                                <th>EMAIL</th>
                                                <th>TYPE</th>
												<th>STATUS</th>
												<th>DATE</th>
												<th>ACTIVE</th>
												<th>SETTINGS</th>
                                            </tr>
                                        </thead>

                                        <tbody>
										
										
                                           
                                                	    <?php
							   $tb_select = "SELECT * FROM users_tb order by id desc ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
											?>
                                    <tr>
                                        
                                        <td><?php echo $row['1'];?></td>
                                  
										<td> <?php echo $row['3'];?> </td>
                                        <td><?php echo $row['4'];?></td>
                                        <td><?php echo $row['5'];?></td>
										<td><?php echo $row['6'];?></td>
										<td><?php echo $row['9'];?></td>
				
										<td><?php echo "<a href=\"page-register-user.php?users=".urlencode($row['ID'])."\">Edit</a> ";?></td>
                                    </tr>
                                    
									<?php }   ?>
                                            
                                          
										  
										  
                                        </tbody>
                                    </table>
										
                                        
                                        </div><!-- end col -->
                                    </div><!-- end row -->
									<!-- END OF ADD NEWS-->
									
									     
								
                </div> 
				
				 </div> 
				 
				
				</div> <!-- rows -->
				
				</div> <!-- container -->
				
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