<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<?php confirm_session();?>

<?php	
if(isset($_GET['q'])){
$q = $_GET['q'];
?>
                      
							     <?php
								
							   $tb_select_brand = "SELECT * FROM attribute_tb  ";
							   $result_brand = mysqli_query($connect,$tb_select_brand);
							   if(!$result_brand){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   
							   while($row_brand = mysqli_fetch_array($result_brand)){
							   $attribute_id  = $row_brand['ID'];
							   // CATEGORY AND BRAND CODE 
							   // SELECTED CODE
								 
							   $tb_select_CA = "SELECT * FROM category_attribute_tb WHERE category = {$q}  ";
							   $result_brand_CA = mysqli_query($connect,$tb_select_CA);
							   if(!$result_brand_CA){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_attribute_CA = mysqli_fetch_array($result_brand_CA)){
							   $category_attribute_id = $row_attribute_CA['attribute'];
							   
							   if($category_attribute_id == $attribute_id){
								
								 echo  "<option value=\"{$row_brand['name']}\" >{$row_brand['name']}</option>";
								
								}
							 
							   }// END CATEGORRY attribute TABLE
							  
							    
								}// END OF Attribute CODE
							   ?>
									
<?php	
}
?>