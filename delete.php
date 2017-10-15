<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<?php  
 //delete.php  
 if(!empty($_POST["id"]))  
 {  
 
      
      $id = mysqli_real_escape_string($connect,$_POST["id"]);
	  $query = "DELETE FROM photos_tb WHERE id = {$id} LIMIT 1";
	  $result = mysqli_query($connect,$query);
	  if(mysqli_affected_rows($connect) == 1){
	    unlink($_POST["img"]);	
	   echo "Deleted !!!";
	 }else{
	// echo "<p>delete Failed</p>".mysqli_error($connect);
		}
	  
	 
	  
      //if(unlink($_POST["path"]))  
      //{  
      //     echo 'Image Deleted';  
      //}  
	  
	  
 }  
 ?>