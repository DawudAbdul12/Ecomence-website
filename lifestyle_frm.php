<?php  require_once("includes/session.php");?>
<?php //confirm_session();?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>
<?php	
//Script Error Reporting
 

	/************************************* START GET POST FUNCTION  ********************************/
					           if(isset($_GET['edit_ls'])){
								$edit_ls = $_GET['edit_ls'];  
					             }
	/*************************************END GET POST FUNCTION  ********************************/

/*********************************************************************************************/
		/************************    FOR INSERT NEWS   ***********************/
/*********************************************************************************************/

if(isset($_POST['submit'])){
   $errors = array();
  
	$title = mysqli_real_escape_string($connect,$_POST['title']);
	//$time = mysqli_real_escape_string($connect,$_POST['time']);
	$date = mysqli_real_escape_string($connect,$_POST['date']);
	$tag = mysqli_real_escape_string($connect,$_POST['tag']);
	$publish = mysqli_real_escape_string($connect,$_POST['publish']);
	$link = $_POST['link'];
	$description = mysqli_real_escape_string($connect,$_POST['description']);
	$lf_image = $_FILES['picx']['name'];
	$publish_by = $_SESSION['user_name'];
	 
	 // CHECK IMAGE 
	 if(empty($lf_image)){
	 
	 $message = "<strong ><span class=\"label label-danger\"> Please Upload image for the product </span></strong>".mysqli_error($connect);
	 $errors = $message;
	 
	 }
	
	if(empty($errors)){
	
	    $publish_by = $_SESSION['user_name'];
	    $name2 = basename($_FILES['picx']['name']);
        $t_name2 = $_FILES['picx']['tmp_name'];
		$dir='img';
		if(move_uploaded_file($t_name2,$dir."/".$name2)){
  $query ="INSERT INTO lifestyle_tb(pic,title,date,content,tag,posted_by,published,link)
		           VALUES ('img/{$name2}','{$title}','{$date}','{$description}','{$tag}','{$publish_by}','{$publish}','{$link}')";
  $page = mysqli_query($connect,$query);
  }else{
	  $message = "<strong><span class=\"label label-danger\"> upload failed! </span></strong>".mysqli_error($connect);
	}// END OF IMAGE UPLOAD
   if($page){
 
   $message = "<strong><span class=\"label label-success\">Please You Have Successfully Added New Record </span></strong>".mysqli_error($connect);
 }else{
	  $message = "<strong><span class=\"label label-danger\"> upload failed! </span></strong>".mysqli_error($connect);
	}
}// END OF ERROR


}// END OF SUBMIT




	

/*********************************************************************************************/
				/***************** 		END ADD DETAILS 	***********************/
  /*********************************************************************************************/
  
  if(isset($_POST['update'])){

    
    $id = $_GET['edit_ls'];
   $title = mysqli_real_escape_string($connect,$_POST['title']);
   $date = mysqli_real_escape_string($connect,$_POST['date']);
	$tag = mysqli_real_escape_string($connect,$_POST['tag']);
	$publish = mysqli_real_escape_string($connect,$_POST['publish']);
	$link = $_POST['link'];
	$description = mysqli_real_escape_string($connect,$_POST['description']);
	$publish_by = $_SESSION['user_name'];
	
	// UPDATE PRODUCT
	   
	   //$publish_by = $_SESSION['user_name'];
	    $name2=basename($_FILES['picx']['name']);
        $t_name2=$_FILES['picx']['tmp_name'];
		$dir='img';
		if(move_uploaded_file($t_name2,$dir."/".$name2)){
	     $query="UPDATE lifestyle_tb SET
				pic ='img/{$name2}',
				title ='{$title}',
				date ='{$date}',
				content ='{$description}',
				tag ='{$tag}',
				posted_by ='{$publish_by}',
				published ='{$publish}',
				link ='{$link}'
                WHERE id = '{$id}'				
			";	
			
			}else{
			$query="UPDATE lifestyle_tb SET
				title ='{$title}',
				date ='{$date}',
				content ='{$description}',
				tag ='{$tag}',
				posted_by ='{$publish_by}',
				published ='{$publish}',
				link ='{$link}'
                WHERE ID = '{$id}'				
			";			
			}
			
		$result = mysqli_query($connect,$query);
		if(mysqli_affected_rows($connect) == 1){
		//success
		//echo "<p>success</p>";
		//header("LOCATION:staffarea.php");
		 $message = "<strong><span class=\"label label-success\">Record Updated Successfully </span></strong>".mysqli_error($connect);
		  // UPLOAD IMAGE CODE
	  
	// UPLOAD IMAGE CODE
		}else{
	
	$message = "<strong><span class=\"label label-danger\">Please Edit the Content before you Update </span></strong>".mysqli_error($connect);
		
		}
}
                
  
  /*********************************************************************************************/
				/***************** 		START OF CLOSE ***********************/
  /*********************************************************************************************/
  
  
							
								/* 		CLOSE CODE  FOR NEWS 		*/
							if(isset($_POST['close'])){
					
							echo "<script> window.location.replace('blog_tb.php') </script>";
							
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

            <?php require_once("includes/backend_header.php");?>	
          
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
                    <h4 class="text-uppercase font-bold m-b-0">LIFE STYLE  </h4>
					<p><?php If(!empty($message)){
					echo $message;
					}
					?></p>
					
                </div>
				<br/>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            
									<?php if(empty($edit_ls)){?>
									
                                            <form class="form-horizontal group-border-dashed" action="lifestyle_frm.php" method="POST" enctype="multipart/form-data">
                                              
											  <h5 class="m-t-30"><b>Title</b></h5>
											   <div class="form-group ">
							           <div class="col-xs-12">
								      <input class="form-control" type="text" required=""  Name="title" placeholder="Add  Title">
							             </div>
						                        </div>
		
										
										
										
									  <h5 class="m-t-30"><b>Link</b></h5>
									    <div class="form-group ">
							           <div class="col-xs-12">
								      <input class="form-control" type="text"  Name="link" placeholder="Add Link">
							             </div>
						                        </div>
									
								 <h5><b>Date</b></h5>
                                    
                                <div class="form-group ">
							        <div class="col-xs-12">
                                        <input class="form-control" type ="date"  value="<?php echo date("Y-m-d"); ?>" name="date"/>
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
								 
								 <h4 class="m-t-30"><b>Add Image</b></h4>  
											
											<div id="preview-image"></div>
                                           
											<div class="file-box m-l-15">
											
                                                <div class="fileupload add-new-plus">
                                                    <span><i class="zmdi-plus zmdi"></i></span>
                                                    <input id="imageupload" type="file" name="picx" multiple class="upload" required>
                                                </div>
                                            </div>
								
												
                                        </div><!-- end col -->

                                        <div class="col-lg-8">
                                          <h5><b>Short Description</b></h5>
                                    <p class="text-muted m-b-20 font-13">
                                       Short Description Goes Here
                                    </p>
												
												  
                                                <div class="form-group">
												
												<div class="col-sm-12">
													
													<textarea class="summernote" name="description"></textarea>
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
									
										 <form class="form-horizontal group-border-dashed" action="lifestyle_frm.php?edit_ls=<?php echo $edit_ls;?>" method="POST" enctype="multipart/form-data">
                                              <?php
								
							   $tb_select = "SELECT * FROM lifestyle_tb WHERE ID = {$edit_ls} ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
							   $title = $row['title'];
								$tag = $row['tag'];
								$publish = $row['published'];
								$link = $row['link'];
								$description = $row['content'];
								$image = $row['pic'];
							    $date = $row['date'];
							   }
											?>
											  <h5 class="m-t-30"><b>Title</b></h5>
											   <div class="form-group ">
							           <div class="col-xs-12">
								      <input class="form-control" type="text" required=""  value="<?php echo $title; ?>" Name="title" placeholder="Add  Title">
							             </div>
						                        </div>
		
										
										
									  <h5 class="m-t-30"><b>link</b></h5>
											   <div class="form-group ">
							           <div class="col-xs-12">
								      <input class="form-control" type="text" required="" value="<?php echo $link; ?>" Name="link" placeholder="Add Link">
							             </div>
						                        </div>
												
										 <h5><b>Date</b></h5>
                                    
                                <div class="form-group ">
							        <div class="col-xs-12">
                                        <input class="form-control" type ="date"  value="<?php echo $date; ?>" name="date"/>
                                    </div>
								</div>
									
									
								 <h5><b>Input Tags</b></h5>
                                    <p class="text-muted m-b-20 font-13">
                                        Just type your tag and press enter to automatically change it to a tags input field.
                                    </p>
                                    <div class="tags-default">
                                        <input type="text"  data-role="tagsinput" placeholder="add tags" name="tag" value="<?php echo $tag; ?>"/>
                                    </div>
								 <h5 class="m-t-30"><b>Publish</b></h5>  						
								 <div class="form-group">
                                   <div class="col-sm-12">
                                         <select class="form-control select2" name="publish">
                                       <option <?php if($publish == "Yes"){echo "selected";} ?> value="Yes">Yes</option>
									    <option <?php if($publish == "No"){echo "selected";} ?> value="No">No</option>
                                    </select>
                                   </div>               
                                 </div>	
								  <h5 class="m-t-30"><b>Image</b></h5>  	
								   <div class="col-md-2">
								   <div id="preview-image">
                                    <img src="<?php echo $image;?>" alt="image"  class="img-responsive img-thumbnail" />
								   </div>
				
									</div>
                                           
											<div class="file-box m-l-15">
											
                                                <div class="fileupload add-new-plus">
                                                    <span><i class="zmdi-plus zmdi"></i></span>
                                                    <input id="imageupload" type="file" name="picx" multiple class="upload">
                                                </div>
                                            </div>
							
                                        </div><!-- end col -->

                                        <div class="col-lg-8">
                                          <h5><b>Short Description</b></h5>
                                    <p class="text-muted m-b-20 font-13">
                                      Short Description Goes Here
                                    </p>
												
												  
                                                <div class="form-group">
												
												<div class="col-sm-12">
													
													<textarea class="summernote" name="description"><?php echo $description;?></textarea>
														</div>
											
											</div>
											
										
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
												   
										
										
										<?php 
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