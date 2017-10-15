<?php  //require_once("includes/session.php");
	session_start();
?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>
<?php
if(isset($_POST['login'])){
	
    $errors = array();
	$require_fields = array('username','password');
	foreach($require_fields as $filedname){
	if(!isset($_POST[$filedname]) || empty($_POST[$filedname])){
	    $errors[] = $filedname;
	} 
	}
	 $username= mysqli_real_escape_string($connect,$_POST['username']);
	 $password= mysqli_real_escape_string($connect,$_POST['password']);
	 $hashed_password = sha1($password);
	if(empty($errors)){
	$query="SELECT *  ";
	 $query.=" FROM users_tb  ";
	 $query.=" WHERE uname = '{$username}'  ";
	 $query.=" AND encrypt= '{$hashed_password}'  ";
	 
	  
   $result_set = mysqli_query($connect,$query);
    if(!$result_set){
				 die("Database connection failed: ".mysqli_error($connect));
							}
    if(mysqli_num_rows($result_set) == 1){
	  
	   $found_user = mysqli_fetch_array($result_set);
	    if($found_user['status'] == "Block"){
		 $message = "<strong style=\"color:#F00;\">Your are Blocked.Please Contact your Administrator</strong>";
		}elseif($found_user['activated'] == 0){
		$_SESSION['user_id'] = $found_user['ID'];
		//$message = "<strong style=\"color:#F00;\">Please Your Account is Not Activate. Please Check Your Email to Activate Your Account.</strong>";
		 echo "<script> window.location.replace('first_change_pass.php?page={$found_user['ID']}')</script>";
		
		}else{
	   $_SESSION['user_id'] = $found_user['ID'];
	   $_SESSION['user_name']= $found_user['uname'];
	   $_SESSION['type']= $found_user['type'];
	   
	   echo "<script> window.location.replace('dashboard.php') </script>";
	}
	}else {
      $message = "<strong style=\"color:#F00;\">Incorrect Username and Password </strong>";
	}
	
	}else {
	 $message = "<strong style=\"color:#F00;\">Please Enter your Username and Password </strong>";
	}
	}
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App title -->
      <title>Gents Pack - ADMIN</title>

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
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <a href="#" class="logo"><img src="img\logo.png" ></a>
              
				
            </div>
        	<div class="m-t-40 card-box">
                <div class="text-center">
                    <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
					<p><?php If(!empty($message)){
					echo $message;
					}
					?></p>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal m-t-20" action="login-user.php" method="POST" enctype="multipart/form-data">

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Username" name="username">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" placeholder="Password" name="password" >
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-custom">
                                    <input id="checkbox-signup" type="checkbox">
                                    <label for="checkbox-signup">
                                        Remember me
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="form-group text-center m-t-30">
                            <div class="col-xs-12">
                                <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit" name="login">Log In</button>
                            </div>
                        </div>

                        
                    </form>

                </div>
            </div>
            <!-- end card-box-->

           
            
        </div>
        <!-- end wrapper page -->
        

        
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
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
	
	</body>
	</html>