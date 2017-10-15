<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>
<?php
if(!isset($_SESSION['user_id'])){
echo "<script> window.location.replace('login-user.php') </script>";
   exit;
}?>
<?php //confirm_session();
/************************************* START GET POST FUNCTION  ********************************/
					           if(isset($_GET['page'])){
								$edit_password = $_GET['page'];  
								
					             }
	/*************************************END GET POST FUNCTION  ********************************/
	
	?>
<?php	

if(isset($_POST['submit'])){

   $errors = array();
   $id = $_GET['page'];
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
	$active = 1;
	
	
	$hashed_password = sha1($password);
    IF($password != $cpassword){
	  $errors = "<strong style=\"color:#F00; padding:20px 20px 0px 0px;\">PASSWORD DOESNT MATCH</strong>";
	  $message = $errors;
	}
	if(empty($errors)){
            

	if(move_uploaded_file($t_name,$dir."/".$name) ){
	
	
	
	     $query="UPDATE users_tb SET
				uname ='{$username}',
				encrypt ='{$hashed_password}',
				email ='{$email}',
				image ='img/{$name}',
				activated ='{$active}'
				
                WHERE ID = '{$id}'				
			";			

  $pagess = mysqli_query($connect,$query);
   if($pagess){
   echo "<script> window.location.replace('login-user.php') </script>";
  } else{
	 echo "upload failed!".mysqli_error($connect);
	  $message = "<strong style=\"color:#F00; padding:20px 20px 0px 0px;\"> upload failed!</strong>".mysqli_error($connect);
	}

 }else {
	 $query="UPDATE users_tb SET
				uname ='{$username}',
				encrypt ='{$hashed_password}',
				email ='{$email}',
				activated ='{$active}'
				
                WHERE ID = '{$id}'				
			";		
  $result = mysqli_query($connect,$query);
		if(mysqli_affected_rows($connect) == 1){
		echo "<script> window.location.replace('login-user.php') </script>";
		}else{
	 echo "upload failed!".mysqli_error($connect);
	  $message = "<strong style=\"color:#F00; padding:20px 20px 0px 0px;\"> upload failed!</strong>".mysqli_error($connect);
	}

	  
	}

}

	}
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

        <!-- App title -->
       <title>DOPPIO RITORTO - Settings</title>

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
                                <h4 class="page-title">Account Validation</h4>
                            </li>
                        </ul>

                        

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
            <!-- Top Bar End -->

               <!-- ========== Left Sidebar Start ========== -->
          
            <!-- Left Sidebar End -->


            <!-- ============================================================== -->
          <div class="wrapper-page">
            <div class="text-center">
                <a href="" class="logo"><span> Admin Dashboard<span></span></span></a>
                <p>Put Your Information,Password And Your Profile Picture.</p>
            </div>
        	<div class="m-t-40 card-box">
                <div class="text-center">
                    <h4 class="text-uppercase font-bold m-b-0">Register</h4>
					<p><?php If(!empty($message)){
					echo $message;
					}
					?></p>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal m-t-20" action="first_change_pass.php?page=<?php echo $edit_password; ?>" method="POST" enctype="multipart/form-data">
                         
						  <?php
							      $edit_password;
								$tb_select = "SELECT * FROM users_tb WHERE ID = {$edit_password} ";
								$result = mysqli_query($connect,$tb_select);
								if(!$result){
								die ("SELECT TABLE FAILED".mysqli_error());
									}
								while($row = mysqli_fetch_array($result)){
								?>
						<div class="form-group ">
							<div class="col-xs-12">
								<input class="form-control" type="email" required=""  Name="Email" placeholder="Email" value="<?php echo $row['3'];?>" >
								<input type ="hidden"  value="<?php echo date("d/m/Y") ; ?>" name="date"/> 
							</div>
						</div>

						<div class="form-group ">
							<div class="col-xs-12">
								<input class="form-control" type="text" required="" Name="Username" placeholder="Username" value="<?php echo $row['1'];?>">
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
								<input type="file" class="form-control" 
                             parsley-type="email" required="" placeholder="Enter a valid e-mail" name="small_img"/>
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
									Update
								</button>
							</div>
						</div>
                       <?php }?>
					</form>

                </div>
            </div>
            <!-- end card-box -->



        </div>
        <!-- end wrapper page -->
            <!-- ============================================================== -->
            <div class="content-page">
               
                <!-- foooter  --->
      <?php require_once("includes/backend_footer.php");?>
   <!-- foooter  --->

            </div>
            <!-- End content-page -->


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

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>

</html>
<?php
	 if(isset($connection)){
	 mysqli_close($connection);
	 }
?>