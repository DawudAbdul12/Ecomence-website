<?php  require_once("includes/session.php");?>
<?php confirm_session();?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>
<?php	
// Script Error Reporting
 // Error_reporting(E_ALL);
 // ini_set('display_errors','1');


	/************************************* START GET POST FUNCTION  ********************************/
					           if(isset($_GET['edit_product'])){
								$edit_product = $_GET['edit_product'];  
					             }
	/*************************************END GET POST FUNCTION  ********************************/

	

/*********************************************************************************************/
		/************************    FOR INSERT NEWS   ***********************/
/*********************************************************************************************/

if(isset($_POST['submit'])){
   $errors = array();
   //$name2=basename($_FILES['pic']['name']);
   // $t_name2=$_FILES['pic']['tmp_name'];
	//$dir='img';
	
	$product_name = mysqli_real_escape_string($connect,$_POST['product_name']);
	$regular_price = mysqli_real_escape_string($connect,$_POST['regular_price']);
	$sale_price = mysqli_real_escape_string($connect,$_POST['sale_price']);
	$stock_qty = mysqli_real_escape_string($connect,$_POST['stock_qty']);
	$stock_status = mysqli_real_escape_string($connect,$_POST['stock_status']);
	
	$category = mysqli_real_escape_string($connect,$_POST['category']);
	if(!isset($_POST['brand'])){
	$brand = 0;
	}else{
	$brand = mysqli_real_escape_string($connect,$_POST['brand']);
	}
	if(!isset($_POST['attribute'])){
	$attribute = 0;
	}else{
	$attribute = mysqli_real_escape_string($connect,$_POST['attribute']);
	}
	$feature = mysqli_real_escape_string($connect,$_POST['feature']);
	$tag = mysqli_real_escape_string($connect,$_POST['tag']);
	$publish = mysqli_real_escape_string($connect,$_POST['publish']);
	$date = mysqli_real_escape_string($connect,$_POST['date']);
	$description = mysqli_real_escape_string($connect,$_POST['description']);
	
	$product_image = $_FILES['picx']['name'][0];
	 
	 // CHECK IMAGE 
	 if(empty($product_image)){
	 
	 $message = "<strong ><span class=\"label label-danger\"> Please Upload image for the product </span></strong>".mysqli_error($connect);
	 $errors =$message;
	 
	 }
	
     // CHECK AND SEE WHETHER PRODUCT EXIST OF NOT
	 $query="SELECT *  ";
	 $query.=" FROM product_tb  ";
	 $query.=" WHERE product_name = '{$product_name}'  ";
	 
   $result_set = mysqli_query($connect,$query);
    if(!$result_set){
				 die("Database connection failed: ".mysqli_error($connect));
							}
    if(mysqli_num_rows($result_set) == 1){
	
	$message = "<strong ><span class=\"label label-danger\"> Please the record already Exist </span></strong>".mysqli_error($connect);
	
	}else{
	 
	 
	if(empty($errors)){
	
	
	//$publish = mysqli_real_escape_string($connect,$_POST['']);

	//$publish_by = $_SESSION['user_name'];
	    $name2 = basename($_FILES['picx']['name'][0]);
        $t_name2 = $_FILES['picx']['tmp_name'][0];
		
		$dir='img';
		if(move_uploaded_file($t_name2,$dir."/".$name2)){
  $query ="INSERT INTO product_tb(product_name,regular_price,sale_price,stock_qty,stock_status,category,brand,attribute,feature,tag,publish,date,description,image)
		           VALUES ('{$product_name}','{$regular_price}','{$sale_price}','{$stock_qty}','{$stock_status}','{$category}','{$brand}','{$attribute}','{$feature}','{$tag}','{$publish}','{$date}','{$description}','img/{$name2}')";
  $pagess = mysqli_query($connect,$query);
  }
   if($pagess){
   
   // GET PRODUCT ID
   
      $query="SELECT *  ";
	 $query.=" FROM product_tb ";
	 $query.=" WHERE product_name = '{$product_name}' order by id desc limit 1 ";
	 
   $result_set = mysqli_query($connect,$query);
    if(!$result_set){
				 die("Database connection failed: ".mysqli_error($connect));
							}
    if(mysqli_num_rows($result_set) >= 1){
     
	 // GET PRODUCT ID
	   $product_data = mysqli_fetch_array($result_set);
	   $product_id = $product_data['ID'];
	   ############### INSERT FIRST PICTURE ###################
	   
	     $query_image="INSERT INTO product_image_tb(product_id,image)
		  VALUES ('{$product_id}','img/{$name2}')";
          $check_image = mysqli_query($connect,$query_image);
		  
	   ################## END OF INSERT FIRST PICTURE #########
	   // UPLOAD IMAGE CODE
	   foreach($_FILES['picx']['name'] as $key => $val){
        //upload and stored images
		$name=basename($_FILES['picx']['name'][$key]);
        $t_name=$_FILES['picx']['tmp_name'][$key];
		$dir='img';
		
		if(move_uploaded_file($t_name,$dir."/".$name)){
          $query_image="INSERT INTO product_image_tb(product_id,image)
		         VALUES ('{$product_id}','img/{$name}')";
          $check_image = mysqli_query($connect,$query_image);
 
        }else{

	$message = "<strong><span class=\"label label-danger\"> Image failed! </span></strong>".mysqli_error($connect);
          }
		  
		  
    }
	// UPLOAD IMAGE CODE
	   
	
       
   
   $message = "<strong><span class=\"label label-success\">Please You Have Successfully Added New Record </span></strong>".mysqli_error($connect);
 
 
 }
 // end of GET ID
  }  else{
	 echo "upload failed!".mysqli_error($connect);
	  $message = "<strong><span class=\"label label-danger\"> upload failed! </span></strong>".mysqli_error($connect);
	}

 
}

}
}




	

/*********************************************************************************************/
				/***************** 		END ADD DETAILS 	***********************/
  /*********************************************************************************************/
  
  if(isset($_POST['update'])){

    
    $id = $_GET['edit_product'];
   $product_name = mysqli_real_escape_string($connect,$_POST['product_name']);
	$regular_price = mysqli_real_escape_string($connect,$_POST['regular_price']);
	$sale_price = mysqli_real_escape_string($connect,$_POST['sale_price']);
	$stock_qty = mysqli_real_escape_string($connect,$_POST['stock_qty']);
	$stock_status = mysqli_real_escape_string($connect,$_POST['stock_status']);
	$category = mysqli_real_escape_string($connect,$_POST['category']);
	if(!isset($_POST['brand'])){
	$brand = 0;
	}else{
	$brand = mysqli_real_escape_string($connect,$_POST['brand']);
	}
	if(!isset($_POST['attribute'])){
	$attribute = 0;
	}else{
	$attribute = mysqli_real_escape_string($connect,$_POST['attribute']);
	}
	$feature = mysqli_real_escape_string($connect,$_POST['feature']);
	$tag = mysqli_real_escape_string($connect,$_POST['tag']);
	$publish = mysqli_real_escape_string($connect,$_POST['publish']);
	$date = mysqli_real_escape_string($connect,$_POST['date']);
	$description = mysqli_real_escape_string($connect,$_POST['description']);
	$product_image_id = mysqli_real_escape_string($connect,$_POST['product_image_id']);
	
	// UPDATE PRODUCT
	   
	   //$publish_by = $_SESSION['user_name'];
	    $name2=basename($_FILES['pic']['name']);
        $t_name2=$_FILES['pic']['tmp_name'];
		$dir='img';
		if(move_uploaded_file($t_name2,$dir."/".$name2)){
	
	     $query="UPDATE product_tb SET
				product_name ='{$product_name}',
				regular_price ='{$regular_price}',
				sale_price ='{$sale_price}',
				stock_qty ='{$stock_qty}',
				stock_status ='{$stock_status}',
				category ='{$category}',
				brand ='{$brand}',
				attribute ='{$attribute}',
				feature ='{$feature}',
				tag ='{$tag}',
				publish ='{$publish}',
				description ='{$description}',
				image = 'img/{$name2}'
                WHERE ID = '{$id}'				
			";	
			
			$query_proudct_img="UPDATE product_image_tb SET
				image = 'img/{$name2}'
                WHERE id = '{$product_image_id}'				
			";			
		
		$result_img = mysqli_query($connect,$query_proudct_img);

			}else{
			$query="UPDATE product_tb SET
				product_name ='{$product_name}',
				regular_price ='{$regular_price}',
				sale_price ='{$sale_price}',
				stock_qty ='{$stock_qty}',
				stock_status ='{$stock_status}',
				category ='{$category}',
				brand ='{$brand}',
				attribute ='{$attribute}',
				feature ='{$feature}',
				tag ='{$tag}',
				publish ='{$publish}',
				description ='{$description}'
                WHERE ID = '{$id}'				
			";			
			}
			
		$result = mysqli_query($connect,$query);
		if(mysqli_affected_rows($connect) == 1){
		//success
		//echo "<p>success</p>";
		//header("LOCATION:staffarea.php");
		
		
		
		 foreach($_FILES['picx']['name'] as $key => $val){
        //upload and stored images
		$name=basename($_FILES['picx']['name'][$key]);
        $t_name=$_FILES['picx']['tmp_name'][$key];
		$dir='img';
		
		if(move_uploaded_file($t_name,$dir."/".$name)){
          $query_image="INSERT INTO product_image_tb(product_id,image)
		         VALUES ('{$id}','img/{$name}')";
          $check_image = mysqli_query($connect,$query_image);
 
        }else{

	  $message = "<strong><span class=\"label label-danger\"> Image failed! </span></strong>".mysqli_error($connect);
          }
		  
		  
    }
	
		 $message = "<strong><span class=\"label label-success\">Record Updated Successfully </span></strong>".mysqli_error($connect);
		  // UPLOAD IMAGE CODE
	  
	// UPLOAD IMAGE CODE
		}else{
		
		 foreach($_FILES['picx']['name'] as $key => $val){
        //upload and stored images
		$name=basename($_FILES['picx']['name'][$key]);
        $t_name=$_FILES['picx']['tmp_name'][$key];
		$dir='img';
		
		if(move_uploaded_file($t_name,$dir."/".$name)){
          $query_image="INSERT INTO product_image_tb(product_id,image)
		         VALUES ('{$id}','img/{$name}')";
          $check_image = mysqli_query($connect,$query_image);
 
        }else{

	  $message = "<strong><span class=\"label label-danger\"> Image failed! </span></strong>".mysqli_error($connect);
          }
    }
		
	//	$message = "<strong><span class=\"label label-danger\">Please Edit the Content before you Update </span></strong>".mysqli_error($connect);
		
		}
}
                

  
  /*********************************************************************************************/
				/***************** 		START OF CLOSE ***********************/
  /*********************************************************************************************/
  
  
							
								/* 		CLOSE CODE  FOR NEWS 		*/
							if(isset($_POST['close'])){
					
							echo "<script> window.location.replace('product_tb.php') </script>";
							
							}
  
  /*********************************************************************************************/
				/***************** 		END OF CLOSE	***********************/
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
	  
	   <!-- form Uploads -->
        <link href="assets/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />
		
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
 
 <style type="text/css">
.thumbimage {
    float:left;
    width:100px;
    position:relative;
    padding:5px;
	margin-right:3px;
	border:1px solid #ebeff2;
}
</style>
     
        <script src="assets/js/modernizr.min.js"></script>
		
		<script>

		$(document).ready(function(){
		myFunction();
		
		});
		
		
		
       function myFunction(){
	   
    var x = document.getElementById("mySelect").selectedIndex;
   var y = document.getElementsByTagName("option")[x].value;
   
    //alert(y);
	showBrands(y);
	showAttr(y);
     }
	 
	 
	// SELECT BRANDS
function showBrands(str) {
  var xhttp;    
  if (str == "") {
    document.getElementById("show").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("show").innerHTML = this.responseText;
    }else{
	document.getElementById("show").innerHTML = "<img src='loading.gif' />";
	}
  };
  xhttp.open("GET", "brand_and_attribute.php?q="+str, true);
  xhttp.send();
}


	// SELECT BRANDS
function showAttr(str){
  var xhttp;    
  if (str == "") {
    document.getElementById("show1").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("show1").innerHTML = this.responseText;
    }else{
	document.getElementById("show1").innerHTML = "<img src='loading.gif' />";
	}
  };
  xhttp.open("GET", "category_and_attribute.php?q="+str, true);
  xhttp.send();
}
</script>




<script type="text/javascript">
 $("#imageupload").on('change', function () {
 
     //Get count of selected files
     var countFiles = $(this)[0].files.length;
 
     var imgPath = $(this)[0].value;
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     var image_holder = $("#preview-image");
     image_holder.empty();
 
     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
         if (typeof (FileReader) != "undefined") {
 
             //loop for each file selected for uploaded.
             for (var i = 0; i < countFiles; i++) {
 
                 var reader = new FileReader();
                 reader.onload = function (e) {
                     $("<img />", {
                         "src": e.target.result,
                             "class": "thumbimage"
                     }).appendTo(image_holder);
                 }
 
                 image_holder.show();
                 reader.readAsDataURL($(this)[0].files[i]);
             }
 
         } else {
             alert("This browser does not support FileReader.");
         }
     } else {
         alert("Pls select only images");
     }
 });
 </script>
   
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
                                <h4 class="page-title"></h4>
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
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="zmdi zmdi-more-vert"></i>
                                        </a>
                                       
                                    </div>

                        			   <div class="text-left">
                    <h4 class="text-uppercase font-bold m-b-0">ADD NEW PRODUCT </h4>
					<p><?php If(!empty($message)){
					echo $message;
					}
					?></p>
					
                </div>
				<br/>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            
									<?php if(empty($edit_product)){?>
									
                                            <form class="form-horizontal group-border-dashed" action="product_frm.php" method="POST" enctype="multipart/form-data">
                                              
											  <h5 class="m-t-30"><b>Product Name</b></h5>
											   <div class="form-group ">
							           <div class="col-xs-12">
								      <input class="form-control" type="text" required=""  Name="product_name" placeholder="Product Name">
							             </div>
						                        </div>
		
										<input type ="hidden"  value="<?php echo date("d-M-Y") ; ?>" name="date"/> 
									  
									  <h5 class="m-t-30"><b>Regular Price</b></h5>
								                <div class="form-group">
                                   
                                                    <div class="col-sm-12">
                                                        <input data-parsley-type="number" type="text"
                                                               class="form-control" required value="0.0"
                                                               placeholder="Enter only numbers" name="regular_price"/>
                                                    </div>
                                                </div>
										 
										<h5 class="m-t-30"><b>Sale Price</b></h5>
										 <div class="form-group">
                                   
                                                    <div class="col-sm-12">
                                                        <input data-parsley-type="number" type="text"
                                                               class="form-control" value="0.0"
                                                               placeholder="Enter only numbers" name="sale_price"/>
                                                    </div>
                                                </div>
										
									
																		
							     <h5 class="m-t-30"><b>Category</b></h5>  						
								 <div class="form-group">
                                   <div class="col-sm-12">
                            
							<select class="form-control select2" name="category" id="mySelect" onchange="myFunction()">
							
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
										   
											 echo "<option value=\"{$row_nest['0']}\">- {$row_nest['name']}</option>";
											
											}
											
											}else{
											?>
											
                                            
                                     <?php } // END OF IF
									 
									 }// END OF LOOP
									 ?>
									 
                                    </select>
                                   </div>               
                                 </div>	
								 
								 
								 
								  <h5 class="m-t-30"><b>Brand</b></h5>  	
								  
								 <div class="form-group" >
                                   <div class="col-sm-12" >
                                 
								 <select class="form-control select2" name="brand"  id="show" data-placeholder="Choose ..." >
                                     <option value="0">none</option>
                                    </select>
									
                                   </div>               
                                 </div>	
								 
								  <h5 class="m-t-30"><b>Attribute</b></h5>  						
								 <div class="form-group">
                                   <div class="col-sm-12">
                                    
									<select class="form-control select2" name="attribute" id="show1">
										 <option value="0">none</option>
										 
                                    </select>
									
                                   </div>               
                                 </div>	
								
								 
								  <h5 class="m-t-30"><b>Featured</b></h5>  						
								 <div class="form-group">
                                   <div class="col-sm-12">
                                         <select class="form-control select2" name="feature">
										 <option value="None">None</option>
                                      <option value="Featured">Featured</option>
									    <option value="Best Deals">Best Deals</option>
										 <option value="On Sale">On Sale</option>
										 <option value="Top Rated">Top Rated</option>
										  <option value="Best Sellers">Best Sellers</option>
                                    </select>
                                   </div>               
                                 </div>	
								 
								  <h5 class="m-t-30"><b>Stock Status</b></h5>   
										 <div class="form-group">     
                                                <div class="col-sm-12">
                                             <select class="form-control select2" name="stock_status">
                                                   
												   <option value="In stock">In stock</option>
												    <option value="Out Of Stock">Out Of Stock</option>
													
                                                 </select>
                                                    </div>
                                                </div>
												
												<h5 class="m-t-30"><b>Stock Quantity</b></h5>
										 <div class="form-group">
                                   
                                                    <div class="col-sm-12">
                                                        <input data-parsley-type="number" type="Number"
                                                               class="form-control" required value="1"
                                                               placeholder="Enter only numbers" name="stock_qty"/>
                                                    </div>
                                                </div>		
												
								 
								 <h5><b>Input Tags</b></h5>
                                    <p class="text-muted m-b-20 font-13">
                                        Just type your tag and press enter to automatically change it to a tags input field.
                                    </p>
                                    <div class="tags-default">
                                        <input type="text"  data-role="tagsinput" placeholder="add tags" name="tag"/>
                                    </div>
								 
								  <h5 class="m-t-30"><b>Publish</b></h5>  						
								 <div class="form-group">
                                   <div class="col-sm-12">
                                         <select class="form-control select2" name="publish">
                                       <option value="Yes">Yes</option>
									    <option value="No">No</option>
										 
                                    </select>
                                   </div>               
                                 </div>	
								
												
                                        </div><!-- end col -->

                                        <div class="col-lg-8">
                                          <h5><b>Product Short Description</b></h5>
                                    <p class="text-muted m-b-20 font-13">
                                       Some Brief Description Goes Here
                                    </p>
												
												  
                                                <div class="form-group">
												
												<div class="col-sm-12">
													
													<textarea class="summernote" name="description"></textarea>
														</div>
											
											</div>
											
										 <h4 class="m-t-30"><b>Add Product Image and Gallery</b></h4>  
											
											<div id="preview-image"></div>
                                           
											<div class="file-box m-l-15">
											
                                                <div class="fileupload add-new-plus">
                                                    <span><i class="zmdi-plus zmdi"></i></span>
                                                    <input id="imageupload" type="file" name="picx[]" multiple class="upload">
                                                </div>
                                            </div>
											
                                            
                                            
											  
										
											<div class="form-group">
                                                    <div class="col-sm-offset-9 col-sm-9 m-t-15">
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light" name ="submit">
                                                            Submit
                                                        </button>
                                                        <button type="submit" class="btn btn-default waves-effect m-l-5" name="try">
                                                            Reset
                                                        </button>
														
                                                        
                                                    </div>
                                                </div>
												
												   </form>
												   
						
										
                                        <?php }else{?>
										
										
										
										
										
	    <form class="form-horizontal group-border-dashed" action="product_frm.php?edit_product=<?php echo $edit_product;?>"  method="POST" enctype="multipart/form-data">
                             			
								<?php
								
							   $tb_select = "SELECT * FROM product_tb WHERE ID = {$edit_product} ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
											?>
							        
											  <h5 class="m-t-30"><b>Product Name</b></h5>
											   <div class="form-group ">
							           <div class="col-xs-12">
								      <input class="form-control" type="text" required=""  Name="product_name" value="<?php echo $row['product_name']; ?>" placeholder="Product Name">
							             </div>
						                        </div>
		
										<input type ="hidden"  value="<?php echo date("d-M-Y") ; ?>" name="date"/> 
									  
									  <h5 class="m-t-30"><b>Regular Price</b></h5>
								                <div class="form-group">
                                   
                                                    <div class="col-sm-12">
                                                        <input data-parsley-type="number" type="text"
                                                               class="form-control" required
                                                               placeholder="Enter only numbers" name="regular_price"  value="<?php echo $row['regular_price']; ?>"/>
                                                    </div>
                                                </div>
										 
										<h5 class="m-t-30"><b>Sale Price</b></h5>
										 <div class="form-group">
                                   
                                                    <div class="col-sm-12">
                                                        <input data-parsley-type="number" type="text"
                                                               class="form-control" value="<?php echo $row['sale_price']; ?>"
                                                               placeholder="Enter only numbers" name="sale_price"/>
                                                    </div>
                                                </div>
										<h5 class="m-t-30"><b>Stock Quantity</b></h5>
										 <div class="form-group">
                                   
                                                    <div class="col-sm-12">
                                                        <input data-parsley-type="number" type="Number"
                                                               class="form-control" required value="<?php echo $row['stock_qty']; ?>"
                                                               placeholder="Enter only numbers" name="stock_qty"/>
                                                    </div>
                                                </div>		
												
									 <h5 class="m-t-30"><b>Stock Status</b></h5>   
										 <div class="form-group">     
                                                <div class="col-sm-12">
                                            <select class="form-control select2" name="stock_status">
                                                   
												   <option <?php if($row['stock_status'] == "In stock"){echo "selected";} ?> value="In stock">In stock</option>
												    <option  <?php if($row['stock_status'] == "Out Of stock"){echo "selected";} ?> value="Out Of Stock">Out Of Stock</option>
													
                                                 </select>
                                                    </div>
                                                </div>
																		
							     <h5 class="m-t-30"><b>Category</b></h5>  						
								 <div class="form-group">
                                   <div class="col-sm-12">
                                  <select class="form-control select2" name="category">
                                      <option value="0">None</option>
							 <?php $tb_select = "SELECT * FROM category_tb ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   
							   while($row_cat = mysqli_fetch_array($result)){
							   
							                if($row_cat['parent'] == 0){
											$parent_id = $row_cat['ID'];
											
											// CHECK FOR SELECTED VERSION
											
											if($row['category'] == $parent_id ){
											
											echo "<option value=\"{$row_cat['ID']}\" selected >{$row_cat['name']}</option>";
											
											}else{
											
											echo "<option value=\"{$row_cat['ID']}\">{$row_cat['name']}</option>";
											
											}
											
											//  NESTED SELECT STATEMENT 
											 $tb_select_nest = "SELECT * FROM category_tb WHERE parent = {$parent_id} " ;
											 $result_nest = mysqli_query($connect,$tb_select_nest);
										   if(!$result_nest){
										   die ("SELECT TABLE FAILED".mysqli_error());
										   }
										   
										   while($row_nest = mysqli_fetch_array($result_nest)){
										   
											 $category_id = $row_nest['ID'];
											 
											 if($row['category'] == $category_id ){
											
											echo "<option value=\"{$row_nest['ID']}\" selected >-{$row_nest['name']}</option>";
											
											}else{
											
											echo "<option value=\"{$row_nest['ID']}\">-{$row_nest['name']}</option>";
											
											}
											 
										
											}
											
											}else{
											?>
											
                                     <?php } // END OF IF
									 
									  }// END OF LOOP
									 ?>
                                    </select>
                                   </div>               
                                 </div>	
								 
								  <h5 class="m-t-30"><b>Brand</b></h5>  						
								 <div class="form-group">
                                   <div class="col-sm-12">
                                         <select class="form-control select2" name="brand">
								      <option value="0">none</option>
								      <?php
								
								$brand_cate_id = $row['category'];
							   $tb_select_brand = "SELECT * FROM brand_tb ";
							   $result_brand = mysqli_query($connect,$tb_select_brand);
							   if(!$result_brand){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   
							   while($row_brand = mysqli_fetch_array($result_brand)){
							   $brand_id  = $row_brand['ID'];
							   $brand_name = $row_brand['name'];
							   // CATEGORY AND BRAND CODE 
							   // SELECTED CODE
								 
							   $tb_select_CA = "SELECT * FROM category_brand_tb WHERE category = {$brand_cate_id} AND brand = {$brand_id} ";
							   $result_brand_CA = mysqli_query($connect,$tb_select_CA);
							   if(!$result_brand_CA){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_brand_CA = mysqli_fetch_array($result_brand_CA)){
							   
							   $category_brand_id = $row_brand_CA['brand'];
							 
							   }// END CATEGORRY BRAND TABLE
							  
							    if($category_brand_id == $brand_id){
								
								// current brand
								$curent_brand_id = $row['brand'];
								
								if($curent_brand_id == $brand_name){ // current brand
								
								 echo  "<option value=\"{$row_brand['name']}\" selected>{$row_brand['name']}</option>";
								 
								}else{
								
								 echo  "<option value=\"{$row_brand['name']}\" >{$row_brand['name']}</option>";
								
								}// end of current brand
								
								
								}else{

							   // echo  "<option value=\"{$row_brand['ID']}\">{$row_brand['name']}</option>";
                                
								}
								
								
							   }// END OF BRAND CODE
							   
							  
							   ?>
										
										 
                                    </select>
                                   </div>               
                                 </div>	
								 
								  <h5 class="m-t-30"><b>Attribute</b></h5>  						
								 <div class="form-group">
                                   <div class="col-sm-12">
                                  <select class="form-control select2" name="attribute">
                                     <option value="0">none</option>
									 <?php
								 // ATTRIBUTE CODE
                              
							   $brand_cate_id = $row['category'];
							   $tb_select_attribute = "SELECT * FROM attribute_tb ";
							   $result_attribute = mysqli_query($connect,$tb_select_attribute);
							   if(!$result_attribute){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   
							   while($row_attribute = mysqli_fetch_array($result_attribute)){
							   
							   $attribute_id  = $row_attribute['ID'];
							   $attribute_name  = $row_attribute['name'];
							   // CATEGORY AND ATTRIBUTE CODE 
							   // SELECTED CODE
								 
							   $tb_select_CT = "SELECT * FROM category_attribute_tb WHERE category = {$brand_cate_id} AND attribute = {$attribute_id} ";
							   $result_atrribute_CT = mysqli_query($connect,$tb_select_CT);
							   if(!$result_atrribute_CT){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_atrribute_CT = mysqli_fetch_array($result_atrribute_CT)){
							   $category_attribute_id = $row_atrribute_CT['attribute'];
							 
							   }// END CATEGORRY BRAND TABLE
							   
							     $cat_attribute_id = $row['attribute'];
							  
							    if($category_attribute_id == $attribute_id){
								
								if($cat_attribute_id == $attribute_name){		// GET THE CURRENT BRAND
							 
							 echo  "<option value=\"{$row_attribute['name']}\" selected>{$row_attribute['name']}</option>";
							  
							  }else{
							  
							  echo  "<option value=\"{$row_attribute['name']}\">{$row_attribute['name']}</option>";
								}
								
								
								// END GET THE CURRENT BRAN
								
								}else{

							    // echo  "<option value=\"{$row_attribute['ID']}\">{$row_attribute['name']}</option>";
                                
								}
							   
							   }
							   
							   // END OF ATTRIBUTE CODE
							   ?>
                                    </select>
                                   </div>               
                                 </div>	
								 
								  <h5 class="m-t-30"><b>Feature</b></h5>  						
								 <div class="form-group">
                                   <div class="col-sm-12">
                                         <select class="form-control select2" name="feature">
										 
                                      <option  <?php if($row['feature'] == "None"){echo "selected";} ?> value="None">None</option>
									  <option  <?php if($row['feature'] == "Featured"){echo "selected";} ?> value="Featured">Featured</option>
									    <option  <?php if($row['feature'] == "Best Deals"){echo "selected";} ?> value="Best Deals">Best Deals</option>
										 <option <?php if($row['feature'] == "On Sale"){echo "selected";} ?> value="On Sale">On Sale</option>
										 <option <?php if($row['feature'] == "Top Rated"){echo "selected";} ?>  value="Top Rated">Top Rated</option>
										  <option <?php if($row['feature'] == "Best Sellers"){echo "selected";} ?>  value="Best Sellers">Best Sellers</option>
                                    </select>
                                   </div>               
                                 </div>	
								 
								 <h5><b>Input Tags</b></h5>
                                    <p class="text-muted m-b-20 font-13">
                                        Just type your tag and press enter to automatically change it to a tags input field.
                                    </p>
                                    <div class="tags-default">
                                        <input type="text"  data-role="tagsinput" placeholder="add tags" name="tag" value="<?php echo $row['tag']; ?>"/>
                                    </div>
									
									
								 
								  <h5 class="m-t-30"><b>Publish</b></h5>  						
								 <div class="form-group">
                                   <div class="col-sm-12">
                                         <select class="form-control select2" name="publish">
                                       <option <?php if($row['publish'] == "Yes"){echo "selected";} ?> value="Yes">Yes</option>
									    <option <?php if($row['publish'] == "No"){echo "selected";} ?> value="No">No</option>
                                    </select>
                                   </div>               
                                 </div>	
								  <h5 class="m-t-30"><b>Product Image</b></h5>  	
								   <div class="col-md-2">
                                    <img src="<?php echo $row['image'];?>" alt="image"  class="img-responsive img-thumbnail" />
								   </div>
								
								    <div class="file-box m-l-15">
											
                                                <div class="fileupload add-new-plus">
                                                    <span><i class="zmdi-plus zmdi"></i></span>
                                                    <input  type="file" name="pic" multiple class="upload">
                                                </div>
                                      </div>
								 
								
												
                                        </div><!-- end col -->

                                        <div class="col-lg-8"> 
                                            <h5><b>Product Short Description</b></h5>
                                    <p class="text-muted m-b-20 font-13">
                                       Some Brief Description Goes Here
                                    </p>
                                                <div class="form-group">
												<div class="col-sm-12">
													<textarea class="summernote" name="description"><?php echo $row['description']; ?></textarea>
														</div>
											
											</div>
											 <h4 class="m-t-30"><b>Product Gallery</b></h4>  
											
											
                                              <div id="preview-image"></div>
											  <div class="file-box m-l-15">
											
                                                <div class="fileupload add-new-plus">
                                                    <span><i class="zmdi-plus zmdi"></i></span>
                                                    <input id="imageupload" type="file" name="picx[]" multiple class="upload">
                                                </div>
                                            </div>
											  
									
									<?php
							   $product_image_id = "";
	                           $tb_select_image = "SELECT * FROM product_image_tb WHERE product_id = {$edit_product} ORDER by id ASC ";
							   $result_image = mysqli_query($connect,$tb_select_image);
							   if(!$result_image){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row_image = mysqli_fetch_array($result_image)){
						        if($row_image['image'] != $row['image']){
								   
							    ?>
								
								   <div class="col-md-2" id="<?php echo $row_image['id'];?>">
								    <span style="float:left" onclick="cart('<?php echo $row_image['id']; ?>')" value="<?php echo $row_image['id'];?>" class="btn btn-danger"><i class="fa  fa-times"></i></span>
                                    <img src="<?php echo $row_image['image'];?>" alt="image"  class="img-responsive img-thumbnail" />
									 <input type="hidden" id="<?php echo $row_image['id']; ?>product_image" value="<?php echo $row_image['image']; ?>">
									
								    </div>
                                    
									<?php }else{
									
									$product_image_id = $row_image['id'];
									
									
									}// END OF IF
                                          
										  }

									?>
									
                                   <input type="hidden" name="product_image_id" value="<?php echo $product_image_id;?>" >									
											
								
											<div class="form-group">
                                                    <div class="col-sm-offset-9 col-sm-9 m-t-15">
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light" name ="update">
                                                            Update
                                                        </button>
                                                        <button type="submit" class="btn btn-default waves-effect m-l-5" name="close">
                                                            Cancel
                                                        </button>
														
                                                        
                                                    </div>
                                                </div>
												
												   </form>
										
										
										<?php }
										}
										?>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
									<!-- END OF ADD NEWS-->
								
								
					
					
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
		
			 <!--form validation init-->
        <script src="assets/plugins/summernote/dist/summernote.min.js"></script>

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
		
		 <!-- file uploads js -->
        <script src="assets/plugins/fileuploads/js/dropify.min.js"></script>
        <script type="text/javascript">
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong appended.'
                },
                error: {
                    'fileSize': 'The file size is too big (1M max).'
                }
            });
        </script>

		
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
		
		
		<script type="text/javascript">
 $("#imageupload").on('change', function () {
 
     //Get count of selected files
     var countFiles = $(this)[0].files.length;
 
     var imgPath = $(this)[0].value;
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     var image_holder = $("#preview-image");
     image_holder.empty();
 
     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
         if (typeof (FileReader) != "undefined") {
 
             //loop for each file selected for uploaded.
             for (var i = 0; i < countFiles; i++) {
 
                 var reader = new FileReader();
                 reader.onload = function (e) {
                     $("<img />", {
                         "src": e.target.result,
                             "class": "thumbimage"
                     }).appendTo(image_holder);
                 }
 
                 image_holder.show();
                 reader.readAsDataURL($(this)[0].files[i]);
             }
 
         } else {
             alert("This browser does not support FileReader.");
         }
     } else {
         alert("Pls select only images");
     }
 });
 </script>
		

    </body>

</html>


<script>  
 
     


function cart(id)
    {
	
	  var ele=document.getElementById(id);
	  //var img_src=ele.getElementsByTagName("img")[0].src;
	  var product_img=document.getElementById(id+"product_image").value;
	  //var price=document.getElementById(id+"_price").value;
	 //alert(<?php echo count($_SESSION['cart_product']);?>);
	// alert(id);
	 
	  if(confirm("Are you sure you want to remove this image?"))  
           {  
		        
                $.ajax({  
                     url:"delete.php",  
                     type:"POST",  
                     data:{
					 id:id,
					 img:product_img
					 },  
                     success:function(response){  
                          if(response != '')  
                          {  
                             setTimeout(function(){  
                             $('#'+id).fadeOut("Slow");  
                         }, 200);  
						 
                          }  
                     }  
                });  
           }  
           else  
           {  
                return false;  
           }  
    }
      
 </script>

<?php
	 if(isset($connect)){
	 mysqli_close($connect);
	 }
?>