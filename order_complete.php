<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<?php
 
  //  UPDATE ORDER TABLE
  if(isset($_POST['OrderID'])){
  
     $id = $_POST['OrderID'];
	 $status = "Completed";


	$query="UPDATE order_tb SET
				complete_status	 ='{$status}'
                WHERE id = {$id}				
			";			
		$result = mysqli_query($connect,$query);
		if(mysqli_affected_rows($connect) == 1){
		//success
		 $message = "<strong><span class=\"label label-success\">Record Updated Successfully </span></strong>".mysqli_error($connect);
		}else{
		// ERROR
		$message = "<strong><span class=\"label label-danger\">Update Failed </span></strong>".mysqli_error($connect);
		}
		
		echo $message;
	exit();
  }
?>