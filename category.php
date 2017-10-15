<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>
<?php// confirm_session();?>
<?php	

	/************************************* START GET POST FUNCTION  ********************************/
					           if(isset($_GET['edit_category'])){
								$edit_category = $_GET['edit_category'];  
								
					             }
	/*************************************END GET POST FUNCTION  ********************************/

	

/*********************************************************************************************/
		/************************    FOR INSERT NEWS   ***********************/
/*********************************************************************************************/

if(isset($_POST['submit'])){
   $errors = array();
   $name2=basename($_FILES['pic']['name']);
    $t_name2=$_FILES['pic']['tmp_name'];
	$dir='img';
	$name = mysqli_real_escape_string($connect,$_POST['name']);
	$date = mysqli_real_escape_string($connect,$_POST['date']);
	$parent = mysqli_real_escape_string($connect,$_POST['parent']);
	$desc = mysqli_real_escape_string($connect,$_POST['desc']);
	$publish = mysqli_real_escape_string($connect,$_POST['publish']);
	
	 $query="SELECT *  ";
	 $query.=" FROM category_tb ";
	 $query.=" WHERE name = '{$name}'  ";
	 
   $result_set = mysqli_query($connect,$query);
    if(!$result_set){
				 die("Database connection failed: ".mysqli_error($connect));
							}
    if(mysqli_num_rows($result_set) >= 1){
	
	$message = "<strong ><span class=\"label label-danger\"> Please the record already Exist </span></strong>".mysqli_error($connect);
	
	}else{
	 
	if(empty($errors)){

	if(empty($name2)){
	$image="";
  $query ="INSERT INTO category_tb(name,description,parent,date,publish,image)
		           VALUES ('{$name}','{$desc}','{$parent}','{$date}','{$publish}','{$image}')";
  $check = mysqli_query($connect,$query);
   if($check){
   
   //CATEGORY BRAND TABLE CODE
     $query="SELECT *  ";
	 $query.=" FROM category_tb ";
	 $query.=" WHERE name = '{$name}' order by ID desc limit 1 ";
	 
   $result_set = mysqli_query($connect,$query);
    if(!$result_set){
				 die("Database connection failed: ".mysqli_error($connect));
							}
    if(mysqli_num_rows($result_set) >= 1){
	// get the latest id
	$category_data = mysqli_fetch_array($result_set);
	$latest_category_id = $category_data['ID'];
	
	$chech_brand = $_POST['brand'];
	if(!empty($chech_brand)){

	foreach ($_POST['brand'] as $brand){

     // INSERT STATEMET FOR CATEGORYBRAND TABLE
	 $query_CB_tb="INSERT INTO category_brand_tb(category,brand)
		           VALUES ('{$latest_category_id}','{$brand}')";
      $check_CB_tb = mysqli_query($connect,$query_CB_tb);
       
    }
	}
	
	$chech_attribute = $_POST['attribute'];
	
	 if(!empty($chech_attribute)){
     foreach ($_POST['attribute'] as $attribute){

     // INSERT STATEMET FOR CATEGORYBRAND TABLE
	 $query_CA_tb="INSERT INTO category_attribute_tb(category,attribute)
		           VALUES ('{$latest_category_id}','{$attribute}')";
      $check_CA_tb = mysqli_query($connect,$query_CA_tb);
       
     }
}


	}
   
   //END OF CATEGORY BRAND CODE
   
   $message = "<strong><span class=\"label label-success\">Please You Have Successfully Added New Record </span></strong>".mysqli_error($connect);
 // header("LOCATION:dashboard.php");
 
  }  else{
	 echo "upload failed!".mysqli_error($connect);
	  $message = "<strong><span class=\"label label-danger\"> upload failed! </span></strong>".mysqli_error($connect);
	}

 
	}elseif(!empty($name2)){
	if(move_uploaded_file($t_name2,$dir."/".$name2) ){
  $query ="INSERT INTO category_tb(name,description,parent,date,image,publish)
		           VALUES ('{$name}','{$desc}','{$parent}','{$date}','img/{$name2}','{$publish}')";
  $check = mysqli_query($connect,$query);
   if($check){
   
   //CATEGORY BRAND TABLE CODE
     $query="SELECT *  ";
	 $query.=" FROM category_tb ";
	 $query.=" WHERE name = '{$name}' order by ID desc limit 1 ";
	 
   $result_set = mysqli_query($connect,$query);
    if(!$result_set){
				 die("Database connection failed: ".mysqli_error($connect));
							}
    if(mysqli_num_rows($result_set) >= 1){
	// get the latest id
	$category_data = mysqli_fetch_array($result_set);
	$latest_category_id = $category_data['ID'];
	
	$chech_brand = $_POST['brand'];
	if(!empty($chech_brand)){

	foreach ($_POST['brand'] as $brand){

     // INSERT STATEMET FOR CATEGORYBRAND TABLE
	 $query_CB_tb="INSERT INTO category_brand_tb(category,brand)
		           VALUES ('{$latest_category_id}','{$brand}')";
      $check_CB_tb = mysqli_query($connect,$query_CB_tb);
       
}
}

	}
   
   //END OF CATEGORY BRAND CODE
   
   
   $chech_attribute = $_POST['attribute'];
	
	 if(!empty($chech_attribute)){
   // START OF ATTRIBUTE
   foreach ($_POST['attribute'] as $attribute){

     // INSERT STATEMET FOR CATEGORYBRAND TABLE
	 $query_CA_tb="INSERT INTO category_attribute_tb(category,attribute)
		           VALUES ('{$latest_category_id}','{$attribute}')";
      $check_CA_tb = mysqli_query($connect,$query_CA_tb);
       
}
}
// END OF ATTRIBUTE
   
   //success
   $message = "<strong><span class=\"label label-success\">Please You Have Successfully Added New Record </span></strong>".mysqli_error($connect);
 // header("LOCATION:dashboard.php");
 
  }  else{
	 echo "upload failed!".mysqli_error($connect);
	  $message = "<strong><span class=\"label label-danger\"> upload failed! </span></strong>".mysqli_error($connect);
	}

 }
	}
	
	
}

}
}

/*********************************************************************************************/
				/***************** 		END ADD DETAILS 	***********************/
  /*********************************************************************************************/
  
  if(isset($_POST['update'])){

    $id = $_GET['edit_category'];
    $name2=basename($_FILES['pic']['name']);
    $t_name2=$_FILES['pic']['tmp_name'];
	$dir='img';
	$name = mysqli_real_escape_string($connect,$_POST['name']);
	$date = mysqli_real_escape_string($connect,$_POST['date']);
	$parent = mysqli_real_escape_string($connect,$_POST['parent']);
	$desc = mysqli_real_escape_string($connect,$_POST['desc']);
	$publish = mysqli_real_escape_string($connect,$_POST['publish']);
	
	if(empty($name2)){

	$query="UPDATE category_tb SET
				name ='{$name}',
				description ='{$desc}',
				parent ='{$parent}',
				publish = '{$publish}'
                WHERE ID = '{$id}'				
			";			
		$result = mysqli_query($connect,$query);
		
		
		// START CODE FOR BRAND
		//STEP 1 DELETE EXISTING RECORD UNDER CURRENT CATEGORY
	    $query_sel = "DELETE FROM category_brand_tb WHERE  category = {$id} ";
		$result_del = mysqli_query($connect,$query_sel);
		  
		  
          $chech_brand = $_POST['brand'];
	      if(!empty($chech_brand)){
		foreach($_POST['brand'] as $brand){
      // UPDATE STATEMET FOR CATEGORYBRAND TABLE
	 //STEP 2 INSERT NEW BRAND(s) UNDER THIS CATEGORY
	  $query_CB_tb="INSERT INTO category_brand_tb(category,brand)
		           VALUES ('{$id}','{$brand}')";
      $check_CB_tb = mysqli_query($connect,$query_CB_tb);
	  }
	  }
	  // END CODE FOR BRAND
	  
	  
	  // START CODE FOR ATTRIBUTE
	  //STEP 1 DELETE EXISTING RECORD UNDER CURRENT CATEGORY
	    $query_del_T = "DELETE FROM category_attribute_tb WHERE category = {$id} ";
		$result_del_T = mysqli_query($connect,$query_del_T);
		
     $chech_attribute = $_POST['attribute'];
	 if(!empty($chech_attribute)){
		foreach ($_POST['attribute'] as $attribute){
      // UPDATE STATEMET FOR CATEGORYBRAND TABLE
	 //STEP 2 INSERT NEW BRAND(s) UNDER THIS CATEGORY
	  $query_CT_tb="INSERT INTO category_attribute_tb(category,attribute)
		           VALUES ('{$id}','{$attribute}')";
      $check_CT_tb = mysqli_query($connect,$query_CT_tb);
       // END CODE FOR ATTRIBUTE
                   }
				   }

		//success
		
		 $message = "<strong><span class=\"label label-success\">Record Updated Successfully </span></strong>".mysqli_error($connect);

}elseif(!empty($name2)){
    if(move_uploaded_file($t_name2,$dir."/".$name2)){
	$query="UPDATE category_tb SET
				name = '{$name}',
				description = '{$desc}',
				parent = '{$parent}',
				image = 'img/{$name2}',
				publish = '{$publish}'
                WHERE ID = '{$id}'				
			";			
		$result = mysqli_query($connect,$query);
		if(mysqli_affected_rows($connect) == 1){
		
		
		//STEP 1 DELETE EXISTING RECORD UNDER CURRENT CATEGORY
	    $query_sel = "DELETE FROM category_brand_tb WHERE category = {$id} ";
		$result_del = mysqli_query($connect,$query_sel);
        $chech_brand = $_POST['brand'];
		if(!empty($chech_brand)){
		foreach ($_POST['brand'] as $brand){
      // UPDATE STATEMET FOR CATEGORYBRAND TABLE
	 //STEP 2 INSERT NEW BRAND(s) UNDER THIS CATEGORY
	  $query_CB_tb="INSERT INTO category_brand_tb(category,brand)
		           VALUES ('{$id}','{$brand}')";
      $check_CB_tb = mysqli_query($connect,$query_CB_tb);
       
                   }
				   
				   }
	 // START CODE FOR ATTRIBUTE
	  //STEP 1 DELETE EXISTING RECORD UNDER CURRENT CATEGORY
	    $query_del_T = "DELETE FROM category_attribute_tb WHERE category = {$id} ";
		$result_del_T = mysqli_query($connect,$query_del_T);
     
	 
	 $chech_attribute = $_POST['attribute'];
	 if(!empty($chech_attribute)){
		foreach ($_POST['attribute'] as $attribute){
      // UPDATE STATEMET FOR CATEGORYBRAND TABLE
	 //STEP 2 INSERT NEW BRAND(s) UNDER THIS CATEGORY
	  $query_CT_tb="INSERT INTO category_attribute_tb(category,attribute)
		           VALUES ('{$id}','{$attribute}')";
      $check_CT_tb = mysqli_query($connect,$query_CT_tb);
       // END CODE FOR ATTRIBUTE
                   }
}
		
		//success
		 $message = "<strong><span class=\"label label-success\">Updated succefully </span> </strong>".mysqli_error($connect);
		}else{
		
		$message = "<strong> <span class=\"label label-danger\"> Update Failed </span></strong> ".mysqli_error($connect);
		
		}
   }else{
		
		$message = "<strong> <span class=\"label label-danger\">Select Another Image </span></strong>".mysqli_error($connect);
		
		}


}

}

  
  
  
  
  /*********************************************************************************************/
				/***************** 		START OF DELETE	***********************/
  /*********************************************************************************************/
  
  
							
								/* 		DELETE CODE  FOR NEWS 		*/
							if(isset($_GET['del_category'])){
							$id = mysqli_real_escape_string($connect,$_GET['del_category']);
							// DELETE CATEGORY
							$query = "DELETE FROM category_tb WHERE ID = {$id} LIMIT 1";
							$result = mysqli_query($connect,$query);
							
							if(mysqli_affected_rows($connect) == 1){
							// DELETE BRANDS UNDER CATEGORY
							$query_brand = "DELETE FROM category_brand_tb WHERE category = {$id} ";
							$result_brand = mysqli_query($connect,$query_brand);
							
							// DELETE ATTRIBUTE UNDER CATEGORY
							$query_attribute = "DELETE FROM category_attribute_tb WHERE category = {$id} ";
							$result_attribute = mysqli_query($connect,$query_attribute);
							
							echo "<script> window.location.replace('category.php') </script>";
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
		
		    <!-- Plugins css-->
        <link href="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="assets/plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="assets/plugins/select2/dist/css/select2.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/select2/dist/css/select2-bootstrap.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
        <link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
		<link href="assets/plugins/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
		<link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
		<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

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

        <script src="assets/js/modernizr.min.js"></script>
   
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
                                <h4 class="page-title">Categories</h4>
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
                    <h4 class="text-uppercase font-bold m-b-0">Add New Category </h4>
					<p class="text font-14 m-b-30">Product categories for your store can be managed here. To change the order of categories on the front-end</p>
					<p><?php If(!empty($message)){
					echo $message;
					}
					?></p>
					
                </div>
				<br/>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            
									<?php if(empty($edit_category)){?>
									
                                            <form class="form-horizontal group-border-dashed" action="category.php" method="POST" enctype="multipart/form-data">
                                              
						<input type ="hidden"  value="<?php echo date("d-M-Y") ; ?>" name="date"/> 
													
								<h5><b>Name *</b></h5>
                            <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Name" name="name">
                            </div>
                        </div>
												 <h5><b>Parent</b></h5>
									
										 <div class="form-group">
                                                    
                                   <div class="col-sm-12">
                                    <select class="form-control select2" name="parent">
									 <option value="0">None</option>
							   <?php $tb_select = "SELECT * FROM category_tb ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   
							   while($row = mysqli_fetch_array($result)){
							   
							                if($row['parent'] == 0){
											$parent_id = $row['ID'];
											echo "<option value=\"{$row['ID']}\">{$row['name']}</option>";
											
											//  NESTED SELECT STATEMENT 
											 $tb_select_nest = "SELECT * FROM category_tb WHERE parent = {$parent_id} " ;
													  $result_nest = mysqli_query($connect,$tb_select_nest);
										   if(!$result_nest){
										   die ("SELECT TABLE FAILED".mysqli_error());
										   }
										   
										   while($row_nest = mysqli_fetch_array($result_nest)){
										   
											 echo "<option value=\"{$row_nest['parent']}\">- {$row_nest['name']}</option>";
											
											}
											
											}else{
											?>
											
                                            
                                     <?php } // END OF IF
									 
									 }// END OF LOOP
									 ?>
                                    </select>
                                        </div>
                                                    
                                     </div>								
												
												
			                                     <h5><b>Image</b></h5>
												<div class="form-group">
                                                    
                                                    <div class="col-sm-12">
                                                        <input type="file"  accept="image/*;capture=camera" class="form-control"  name="pic"/>
                                                    </div>
                                                </div>
												<div class="form-group">
								<h5 class="m-t-30"><b>Select Brand</b></h5>
                                    <p class="text-muted m-b-15 font-13">
                                        Select Brand that will come under this category
                                    </p>

                                    <select name="brand[]" class="multi-select" multiple="" id="my_multi_select3" >
											
							     <?php
								 // BRAND CODE

								 $tb_select_brand = "SELECT * FROM brand_tb ";
							   $result_brand = mysqli_query($connect,$tb_select_brand);
							   if(!$result_brand){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   
							   while($row_brand = mysqli_fetch_array($result_brand)){
							  echo  "<option value=\"{$row_brand['ID']}\">{$row_brand['name']}</option>";

							   }
							   
							   // END OF BRAND CODE
							   ?>
							
                                    </select>
									</div>
									
									<div class="form-group">
									
									<h5 class="m-t-30"><b>Select Attribute</b></h5>
                                    <p class="text-muted m-b-15 font-13">
                                        Select Attribute that will come under this category
                                    </p>

                                    <select multiple="multiple" class="multi-select" id="my_multi_select1" name="attribute[]" data-plugin="multiselect">
                                        <?php
								 // ATTRIBUTE CODE

								 $tb_select_attribute = "SELECT * FROM attribute_tb ";
							   $result_attribute = mysqli_query($connect,$tb_select_attribute);
							   if(!$result_attribute){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   
							   while($row_attribute = mysqli_fetch_array($result_attribute)){
							  echo  "<option value=\"{$row_attribute['ID']}\">{$row_attribute['name']}</option>";

							   }
							   
							   // END OF ATTRIBUTE CODE
							   ?>
                                    </select>
									</div>

									
									 
									
												<h5><b>Description</b></h5>
                                                <div class="form-group">
												
												<div class="col-sm-12">
													
													<textarea rows="10" cols=45 name="desc"></textarea>
														</div>
											     </div>
												 
								<h5><b>Publish</b></h5>		 
	                            <select class="form-control select2" Name="publish" required="Select User Type">
            
							  <option value="Yes">Yes</option>
							  <option value="No">No</option>
							  
                              </select>

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
										
										
										
										
										
	<form class="form-horizontal group-border-dashed" action="category.php?edit_category=<?php echo $edit_category;?>"  method="POST" enctype="multipart/form-data">
                                   
				<?php
								
							   $tb_select_category = "SELECT * FROM category_tb WHERE ID = {$edit_category} ";
							   $result_category = mysqli_query($connect,$tb_select_category);
							   if(!$result_category){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_category = mysqli_fetch_array($result_category)){
											?>
									
													
								<h5><b>Name *</b></h5>
                            <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Name" name="name" value ="<?php echo $row_category['name']; ?>" >
                            </div>
                        </div>
												 <h5><b>Parent</b></h5>
									
										 <div class="form-group">
                                                    
                                   <div class="col-sm-12">
                                    <select class="form-control select2" name="parent">
									 <option value="0">None</option>
							   <?php $tb_select = "SELECT * FROM category_tb ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   
							   while($row = mysqli_fetch_array($result)){
							   
							                if($row['parent'] == 0){
											$parent_id = $row['ID'];
											
											// CHECK FOR SELECTED VERSION
											
											if($row_category['parent'] == $parent_id ){
											
											echo "<option value=\"{$row['ID']}\" selected >{$row['name']}</option>";
											
											}else{
											
											echo "<option value=\"{$row['ID']}\">{$row['name']}</option>";
											
											}
											
											//  NESTED SELECT STATEMENT 
											 $tb_select_nest = "SELECT * FROM category_tb WHERE parent = {$parent_id} " ;
											 $result_nest = mysqli_query($connect,$tb_select_nest);
										   if(!$result_nest){
										   die ("SELECT TABLE FAILED".mysqli_error());
										   }
										   
										   while($row_nest = mysqli_fetch_array($result_nest)){
										   
											 echo "<option value=\"{$row_nest['parent']}\">- {$row_nest['name']}</option>";
											 
											}
											
											}else{
											?>
											
                                            
                                     <?php } // END OF IF
									 
									 }// END OF LOOP
									 ?>
                                    </select>
                                        </div>
                                                    
                                     </div>								
												
												
			                                     <h5><b>Image</b></h5>
												<div class="form-group">
                                                    
                                                    <div class="col-sm-12">
                                                <input type="file"  accept="image/*;capture=camera" class="form-control"  name="pic"/>
                                                    </div>
                                                </div>
										
										<img src="<?php echo $row_category['5'];?>" width="50px" height="50px">
												
												<div class="form-group">
								<h5 class="m-t-30"><b>Select Brand</b></h5>
                                    <p class="text-muted m-b-15 font-13">
                                        Select Brand that will come under this category
                                    </p>

                                    <select name="brand[]" class="multi-select" multiple="" id="my_multi_select3" >
											
							     <?php
								
							   $tb_select_brand = "SELECT * FROM brand_tb ";
							   $result_brand = mysqli_query($connect,$tb_select_brand);
							   if(!$result_brand){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   
							   while($row_brand = mysqli_fetch_array($result_brand)){
							   $brand_id  = $row_brand['ID'];
							   // CATEGORY AND BRAND CODE 
							   // SELECTED CODE
								 
							   $tb_select_CA = "SELECT * FROM category_brand_tb WHERE category = {$edit_category} AND brand = {$brand_id} ";
							   $result_brand_CA = mysqli_query($connect,$tb_select_CA);
							   if(!$result_brand_CA){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_brand_CA = mysqli_fetch_array($result_brand_CA)){
							   $category_brand_id = $row_brand_CA['brand'];
							 
							   }// END CATEGORRY BRAND TABLE
							  
							    if($category_brand_id == $brand_id){
								
								 echo  "<option value=\"{$row_brand['ID']}\" selected>{$row_brand['name']}</option>";
								
								}else{

							    echo  "<option value=\"{$row_brand['ID']}\">{$row_brand['name']}</option>";
                                
								}
								
								
							   }// END OF BRAND CODE
							   
							  
							   ?>
							
                                    </select>
									</div>
									
									<div class="form-group">
									
									<h5 class="m-t-30"><b>Select Attribute</b></h5>
                                    <p class="text-muted m-b-15 font-13">
                                        Select Attribute that will come under this category
                                    </p>

                                    <select multiple="multiple" class="multi-select" id="my_multi_select1" name="attribute[]" data-plugin="multiselect">
                                        <?php
								 // ATTRIBUTE CODE

							 $tb_select_attribute = "SELECT * FROM attribute_tb ";
							   $result_attribute = mysqli_query($connect,$tb_select_attribute);
							   if(!$result_attribute){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   
							   while($row_attribute = mysqli_fetch_array($result_attribute)){
							   
							   $attribute_id  = $row_attribute['ID'];
							   // CATEGORY AND ATTRIBUTE CODE 
							   // SELECTED CODE
								 
							   $tb_select_CT = "SELECT * FROM category_attribute_tb WHERE category = {$edit_category} AND attribute = {$attribute_id} ";
							   $result_atrribute_CT = mysqli_query($connect,$tb_select_CT);
							   if(!$result_atrribute_CT){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_atrribute_CT = mysqli_fetch_array($result_atrribute_CT)){
							   $category_attribute_id = $row_atrribute_CT['attribute'];
							 
							   }// END CATEGORRY BRAND TABLE
							   
							  
							    if($category_attribute_id == $attribute_id){
								
							  echo  "<option value=\"{$row_attribute['ID']}\" selected>{$row_attribute['name']}</option>";
								
								}else{

							     echo  "<option value=\"{$row_attribute['ID']}\">{$row_attribute['name']}</option>";
                                
								}
							   
							   }
							   
							   // END OF ATTRIBUTE CODE
							   ?>
                                    </select>
									</div>

									
									 
									
												<h5><b>Description</b></h5>
                                                <div class="form-group">
												
												<div class="col-sm-12">
													
													<textarea rows="10" cols=45 name="desc"><?php echo $row_category['2'];?></textarea>
														</div>
											     </div>
												 
												 <h5 class="m-t-30"><b>Publish</b></h5>
                                    
                                    <select class="form-control select2" Name="publish" required="Select User Type">
						   
							  <option <?php if($row_category['6'] == "Yes"){echo "Selected = selected";}  ?> value="Yes">Yes</option>
							  <option <?php if($row_category['6'] == "No"){echo "Selected = selected";}  ?> value="No">No</option>
							  
                                    </select>

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
												   
												
                                      

										
										<?php }// END OF WHILE LOOP
										
										echo " </div>";
										}// IF STATEMENT
										
										?>
										 
                                        </div><!-- end col -->
                                    </div><!-- end row -->
									<!-- END OF ADD NEWS-->
								
								
					
					
                    </div> <!-- container -->
					
					<!-- TABLE AREA --> 
					
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
												<th>IMAGE</th>
												<th>PUBLISH</th>
												<th>SETTINGS</th>
                                            </tr>
                                        </thead>

                                        <tbody>
								
                                                	    <?php
							   $tb_select = "SELECT * FROM category_tb order by ID desc  ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
							   if($row['3'] == 0){
							   $parent_id = $row['0'];
											?>
                                    <tr>
                                        <td><?php echo $row['0'];?></td>
										 <td><?php echo $row['1'];?></td>
										<td><?php echo $row['2'];?> </td>
										<td><?php echo $row['4'];?></td>
										<td><img src="<?php echo $row['5'];?>" width="30px" height="30px"> </td>
										<td><?php echo $row['6'];?></td>
										<td><?php echo "<a href=\"category.php?edit_category=".urlencode($row['0'])."\">Read</a> |  <a href=\"category.php?del_category=".urlencode($row['0'])."\" onClick =\"return confirm('Are you sure You want to Delete')\">Delete</a>";?></td>
										
                                    </tr>
									<?php
									//  NESTED SELECT STATEMENT 
											 $tb_select_nest = "SELECT * FROM category_tb WHERE parent = {$parent_id} " ;
													  $result_nest = mysqli_query($connect,$tb_select_nest);
										   if(!$result_nest){
										   die ("SELECT TABLE FAILED".mysqli_error());
										   }
										   
										   while($row_nest = mysqli_fetch_array($result_nest)){
										  

                                    ?>
									 <tr>
                                        <td><?php echo $row_nest['0'];?></td>
										 <td>- <?php echo $row_nest['1'];?></td>
										<td><?php echo $row_nest['2'];?> </td>
										<td><?php echo $row_nest['4'];?></td>
										<td><img src="<?php echo $row_nest['5'];?>" width="30px" height="30px"> </td>
										<td><?php echo $row['6'];?></td>
										<td><?php echo "<a href=\"category.php?edit_category=".urlencode($row_nest['0'])."\">Read</a> |  <a href=\"category.php?del_category=".urlencode($row_nest['0'])."\" onClick =\"return confirm('Are you sure You want to Delete')\">Delete</a>";?></td>
                                    </tr>
									
									<?php 
			
									
									}// End nested statement loop
									
									}else{ 
									// nothing 
									
									} 
									
									}   ?>
                                            
                                     
                                        </tbody>
                                    </table>
											
											
											
                                        
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div>
                            </div><!-- end col -->

					
					
					
					
					
					
					
					<!-- END OF TABLE AREA --> 
					

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

        <!-- Plugins Js -->
        <script src="assets/plugins/switchery/switchery.min.js"></script>
        <script src="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script type="text/javascript" src="assets/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="assets/plugins/select2/dist/js/select2.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
        <script src="assets/plugins/moment/moment.js"></script>
     	<script src="assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
     	<script src="assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
     	<script src="assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
     	<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
            jQuery(document).ready(function() {

                //advance multiselect start
                $('#my_multi_select3').multiSelect({
                    selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    afterInit: function (ms) {
                        var that = this,
                            $selectableSearch = that.$selectableUl.prev(),
                            $selectionSearch = that.$selectionUl.prev(),
                            selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                            selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                            .on('keydown', function (e) {
                                if (e.which === 40) {
                                    that.$selectableUl.focus();
                                    return false;
                                }
                            });

                        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                            .on('keydown', function (e) {
                                if (e.which == 40) {
                                    that.$selectionUl.focus();
                                    return false;
                                }
                            });
                    },
                    afterSelect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    },
                    afterDeselect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    }
                });

                // Select2
                $(".select2").select2();

                $(".select2-limiting").select2({
				  maximumSelectionLength: 2
				});

            });

            //Bootstrap-TouchSpin
            $(".vertical-spin").TouchSpin({
                verticalbuttons: true,
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary",
                verticalupclass: 'ti-plus',
                verticaldownclass: 'ti-minus'
            });
            var vspinTrue = $(".vertical-spin").TouchSpin({
                verticalbuttons: true
            });
            if (vspinTrue) {
                $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
            }

            $("input[name='demo1']").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary",
                postfix: '%'
            });
            $("input[name='demo2']").TouchSpin({
                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary",
                maxboostedstep: 10000000,
                prefix: '$'
            });
            $("input[name='demo3']").TouchSpin({
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary"
            });
            $("input[name='demo3_21']").TouchSpin({
                initval: 40,
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary"
            });
            $("input[name='demo3_22']").TouchSpin({
                initval: 40,
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary"
            });

            $("input[name='demo5']").TouchSpin({
                prefix: "pre",
                postfix: "post",
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary"
            });
            $("input[name='demo0']").TouchSpin({
                buttondown_class: "btn btn-primary",
                buttonup_class: "btn btn-primary"
            });

            // Time Picker
            jQuery('#timepicker').timepicker({
                defaultTIme : false
            });
            jQuery('#timepicker2').timepicker({
                showMeridian : false
            });
            jQuery('#timepicker3').timepicker({
                minuteStep : 15
            });

            //colorpicker start

            $('.colorpicker-default').colorpicker({
                format: 'hex'
            });
            $('.colorpicker-rgba').colorpicker();

            // Date Picker
            jQuery('#datepicker').datepicker();
            jQuery('#datepicker-autoclose').datepicker({
                autoclose: true,
                todayHighlight: true
            });
            jQuery('#datepicker-inline').datepicker();
            jQuery('#datepicker-multiple-date').datepicker({
                format: "mm/dd/yyyy",
                clearBtn: true,
                multidate: true,
                multidateSeparator: ","
            });
            jQuery('#date-range').datepicker({
                toggleActive: true
            });

            //Date range picker
            $('.input-daterange-datepicker').daterangepicker({
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-default',
                cancelClass: 'btn-primary'
            });
            $('.input-daterange-timepicker').daterangepicker({
                timePicker: true,
                format: 'MM/DD/YYYY h:mm A',
                timePickerIncrement: 30,
                timePicker12Hour: true,
                timePickerSeconds: false,
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-default',
                cancelClass: 'btn-primary'
            });
            $('.input-limit-datepicker').daterangepicker({
                format: 'MM/DD/YYYY',
                minDate: '06/01/2016',
                maxDate: '06/30/2016',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-default',
                cancelClass: 'btn-primary',
                dateLimit: {
                    days: 6
                }
            });

            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

            $('#reportrange').daterangepicker({
                format: 'MM/DD/YYYY',
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2016',
                maxDate: '12/31/2016',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                drops: 'down',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-success',
                cancelClass: 'btn-default',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });

            //Bootstrap-MaxLength
            $('input#defaultconfig').maxlength()

            $('input#thresholdconfig').maxlength({
                threshold: 20
            });

            $('input#moreoptions').maxlength({
                alwaysShow: true,
                warningClass: "label label-success",
                limitReachedClass: "label label-danger"
            });

            $('input#alloptions').maxlength({
                alwaysShow: true,
                warningClass: "label label-success",
                limitReachedClass: "label label-danger",
                separator: ' out of ',
                preText: 'You typed ',
                postText: ' chars available.',
                validate: true
            });

            $('textarea#textarea').maxlength({
                alwaysShow: true
            });

            $('input#placement').maxlength({
                alwaysShow: true,
                placement: 'top-left'
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