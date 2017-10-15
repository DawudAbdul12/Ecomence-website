<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<?php
  ######### GET  ID FROM THE LINK ########
   if(isset($_GET['gallery_id'])){
	$gallery_id = $_GET['gallery_id']; 
	$gallery_encry = my_simple_crypt($gallery_id, 'd');
			}
			
  ######### GET  ID FROM THE LINK ########
 ?>

<!DOCTYPE html>
<html>
	<head>
		
		<!-- Website Title & Description for Search Engine purposes -->
		<title>Gentspack - Gallery</title>
		<meta name="description" content="">
		
		<!-- Mobile viewport optimized -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-glyphicons.css" rel="stylesheet">
		
		<!-- Custom CSS -->
		
		<link href="css/lightbox.css" rel="stylesheet">

		<link href="css/global-styles.css" rel="stylesheet">
		<link href="css/promotion-styles.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
		<link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">

		<script src="js/modernizr-2.6.2.min.js"></script>
		
		<!-- FOR ADD TO CART --> 
		<script type="text/javascript" src="jquery.js"></script> 
	    <script type="text/javascript" src="JS/echo.js"></script> 
		<script type="text/javascript" src="add_cart.js"></script> 
		
	</head>
	<body class="black">

	<!-- NAVIGATION -->
	<?php  require_once("includes/header.php");?>
	<!-- NAVIGATION -->

	<header class="bg-3">
		<div class="content-inner">
			<div class="inside"><?php
			 $tb_select = "SELECT * FROM gallery_tb WHERE id = {$gallery_encry} ORDER BY id ASC ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){ ?>
				<h2><strong><?php echo $row['title'];?> GALLERY </strong></h2>
				<!--<h2><strong><?php// echo $row['date'];?></strong></h2>-->
							   <?php }?>
			</div>	
		</div>
	</header>


	<!--  -->

			

	<!--  -->

	<div class="section-1" style="padding-top:0px;">
		<div class="container-fluid">
			<div class="row">
			<?php
								
				// This sets the range of rows to query for the chosen $pagenum
				//$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
				// This is your query again, it is for grabbing just one page worth of rows by applying $limit
				               //$limit = "limit 0,9";
				               
				               $tb_select = "SELECT * FROM photos_tb WHERE gallery_id = {$gallery_encry} ORDER BY id ASC ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
							   
							   ?>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 no-pad">
					<a href="<?php echo $row['image']; ?>" data-lightbox="2" data-title=""><img src="<?php echo $row['image']; ?>" class="img-responsive"></a>
				</div>
				<?php }?>
				
			</div>
			
		    <!--	<div class="row spec">
				<div class="col-lg-12 text-center">
					<ul> 
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">NEXT <i class="fa fa-chevron-right"></i></a></li>
					</ul>
				</div>
			</div> -->
			
		</div>
	</div>
	

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				 	<p class="pull-left">Copyrights &copy; 2017. All Rights Reserved.</p>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<ul class="right">
						<li><i class="fa fa-facebook"></i></li>
				 		<li><i class="fa fa-twitter"></i></li>
				 		<li><i class="fa fa-google-plus"></i></li>
				 		<li><i class="fa fa-instagram"></i></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	
	
	<!-- First try for the online version of jQuery-->
	<script src="http://code.jquery.com/jquery.js"></script>
	
	<!-- If no online access, fallback to our hardcoded version of jQuery -->
	<script>window.jQuery || document.write('<script src="js/jquery-1.8.2.min.js"><\/script>')</script>
	
	<!-- Bootstrap JS -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/lightbox.js"></script>

	
	<!-- Custom JS -->
	<script src="js/script.js"></script>	
	</body>
</html>

