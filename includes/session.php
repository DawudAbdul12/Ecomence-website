<?php 
	
	session_start();
	
function confirm_session(){
if(!isset($_SESSION['user_name'])){
   header("LOCATION:login-user.php");
   exit;
}
}

?>