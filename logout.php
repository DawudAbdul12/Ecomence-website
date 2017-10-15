<?php  require_once("includes/function.php");?>
<?php  
	 session_start();
	$_SESSION = array();
	// 3 Destroy the session cookie
	 if(isset($_COOKIE[session_name()])){
	   setcookie(session_name(),'',time()-42000,'/');
	 }
    // 4. Destroy the session
      session_destroy();
	  echo "<script> window.location.replace('index.php') </script>";
	  exit;

  ?>