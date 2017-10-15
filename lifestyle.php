<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<?php

                             // This first query is just to get the total count of 
                               $status  = "Yes";
					           $tb_select = "SELECT COUNT(id) FROM lifestyle_tb WHERE published = '{$status}'";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error($connect));
							   }
                             // This first query is just to get the total count of 
							   $row = mysqli_fetch_array($result);                       

// Here we have the total row count
$rows = $row[0];
// This is the number of results we want displayed per page
$page_rows = 9;
// This tells us the page number of our last page
$last = ceil($rows/$page_rows);
// This makes sure $last cannot be less than 1
if($last < 1){
	$last = 1;
}
// Establish the $pagenum variable
$pagenum = 1;
// Get pagenum from URL vars if it is present, else it is = 1
if(isset($_GET['pn'])){
	$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
	
}

// check and see whether the showing page number is more than the total page number
	
	// check and see whether the showing page number is more than the total page number

// This makes sure the page number isn't below 1, or more than our $last page
if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}

// This shows the user what page they are on, and the total number of pages
$textline1 = "Lifestyle (<b>$rows</b>)";
//$textline2 = "Showing <b>1 - $showing_product </b> of <b>$rows</b> results";
// Establish the $paginationCtrls variable
$paginationCtrls = '';
// If there is more than 1 page worth of results
if($last != 1){
	/* First we check if we are on page one. If we are then we don't need a link to 
	   the previous page or the first page so we do nothing. If we aren't then we
	   generate links to the first page, and to the previous page. */
	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		
		$paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'"> <i class="fa fa-chevron-left"></i></a></li>';

		// Render clickable number links that should appear on the left of the target page number
		if(isset($category_id)){
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?category='.$category.'&pn='.$i.'">'.$i.'</a></li> ';
			}
	    }
		
		}else{
		
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a></li> ';
			}
	    }
		
		}
		
    }
	// Render the target page number, but without it being a link
	$paginationCtrls .= '<li class="active"><a >'.$pagenum.'</a></li>';
	// Render clickable number links that should appear on the right of the target page number
	for($i = $pagenum+1; $i <= $last; $i++){
	 
	 if(isset($category_id)){
		$paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?category='.$category.'&pn='.$i.'">'.$i.'</a></li> ';
		if($i >= $pagenum+4){
			break;
		}
		}else{
		
		$paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a></li> ';
		if($i >= $pagenum+4){
			break;
		}
		}// END OF IF
		
	}
	// This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
		

		$paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'"><i class="fa fa-chevron-right"></i></a></li> ';
		
    }
}

?>

<!DOCTYPE html>
<html>
	<head>
		<!-- Website Title & Description for Search Engine purposes -->
		<title>Gentspack - Lifestyle</title>
		<meta name="description" content="">
		
		<!-- Mobile viewport optimized -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-glyphicons.css" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link href="css/global-styles.css" rel="stylesheet">
		<link href="css/promotion-styles.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
		<link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		
		<!-- Include Modernizr in the head, before any other Javascript -->
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
			<div class="inside">
				<h2><strong>LIFESTYLE</strong></h2>
			</div>	
		</div>
	</header>

	<div class="section-1">
		<div class="container">
		
			<div class="row">
				<div class="col-lg-12">
					<p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, uis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo	consequat. Duis aute irure dolor.</p>
				</div>
			</div>
			<div class="row">
			     <?php
								
				// This sets the range of rows to query for the chosen $pagenum
				$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
				// This is your query again, it is for grabbing just one page worth of rows by applying $limit
				               //$limit = "limit 0,9";
				               $status = "Yes";
				               $tb_select = "SELECT * FROM lifestyle_tb WHERE published = '{$status}' ORDER BY id DESC $limit";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
							   
							   ?>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-bot">
			<img src="<?php echo $row['pic'];?>" class="img-responsive dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown">
					<div class="dropdown-menu" aria-labelledby="dropdownMenu1">
					<h4><?php echo $row['title'];?></h4>
						<?php echo $row['content'];?>
						<h4>SHARE</h4>
						<!--
						<ul>
							<li><i class="fa fa-facebook"></i></li>
							<li><i class="fa fa-twitter"></i></li>
							<li><i class="fa fa-google-plus"></i></li>
							<li><i class="fa fa-instagram"></i></li>
						</ul>-->
						
				<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
				<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
				<a class="a2a_button_facebook"></a>
				<a class="a2a_button_twitter"></a>
				<a class="a2a_button_google_plus"></a>
				
				</div>
				<script async src="https://static.addtoany.com/menu/page.js"></script>
				
						<?php if(empty($row['link'])){}else{?>
						<a href="<?php echo $row['link'];?>" target="_blank" class="btn">Visit</a>
						<?php }?>
						
					</div>
				</div>
				<?php }?>
				
				
			</div>
		
			<div class="row">
				<div class="col-lg-12 text-center">
					<!-- panination -->
			<nav aria-label="Page navigation">
  <ul class="pagination">
<?php echo $paginationCtrls; ?>
  </ul>
</nav>
	<!-- pagination -->
				</div>
			</div>
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
	
	<!-- Custom JS -->
	<script src="js/script.js"></script>	
	</body>
</html>

