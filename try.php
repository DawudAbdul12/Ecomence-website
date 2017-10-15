<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>


<?php
                              
// This first query is just to get the total count of 
                                 
							    $published = "Yes";
								$tb_select = "SELECT COUNT(id) FROM blog_tb WHERE published = 

'{$published}' ";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error($connect));
							   }
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
// This makes sure the page number isn't below 1, or more than our $last page
if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}

// This shows the user what page they are on, and the total number of pages
$textline1 = "News (<b>$rows</b>)";
$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
// Establish the $paginationCtrls variable
$paginationCtrls = '';
// If there is more than 1 page worth of results
if($last != 1){
	/* First we check if we are on page one. If we are then we don't need a link to 
	   the previous page or the first page so we do nothing. If we aren't then we
	   generate links to the first page, and to the previous page. */
	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'"><i class="fa fa-chevron-left"></i> PREVIOUS </a> &nbsp &nbsp 

&nbsp';
		// Render clickable number links that should appear on the left of the target page number
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
			}
	    }
    }
	// Render the target page number, but without it being a link
	$paginationCtrls .= ''.$pagenum.' &nbsp; ';
	// Render clickable number links that should appear on the right of the target page number
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
		if($i >= $pagenum+4){
			break;
		}
	}
	// This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp &nbsp  <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">NEXT <i class="fa fa-chevron-right"></i></a> ';
    }
}

?>


<!DOCTYPE html>

<html>
	<head>
		
		<!-- Website Title & Description for Search Engine purposes -->
		<title>Gentspack - Blog</title>
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
	
	<header class="bg-3" style="margin-top:90px;background:url(images/blog-banner.png)">
		<div class="content-inner">
			<div class="inside">
				<!--<h2><strong>BLOG</strong></h2>-->
			</div>	
		</div>
	</header>

	<div class="section-1">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<p class="text-center">A gentleman is characterized by his actions. His words are just mere validations of 

them...</p>
				</div>
			</div>
			<div class="row blog">
			 
			    <?php
								
				// This sets the range of rows to query for the chosen $pagenum
				$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
				// This is your query again, it is for grabbing just one page worth of rows by applying $limit
				              // $limit = "limit 0,6";
				               $status = "Yes";
				               $tb_select = "SELECT * FROM blog_tb WHERE published = '{$status}' ORDER BY id DESC $limit";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
							  
							   ?>
							   
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-bot">
                                                                                <?php $encryp_blog_id = my_simple_crypt($row['0'], 'e' ); ?>
					<a href="single_news.php?news=<?php echo $encryp_blog_id ;?>">
					<img src="<?php echo $row['pic'];?>" class="img-responsive">
                                                                                     </a>
					<h3><?php 
					
						 $str = strip_tags($row["title"]);
						 
							  if(strlen($str)> 20){
							  
							 $str = substr($str,0,20)."<span style=\"font-size:9px\"> ...</span>";
							 
							echo html_entity_decode($str);
							
							}elseif(strlen($str) <= 20){
							
							echo html_entity_decode($str);
							
							}
					
					?></h3>
					<p class="small"><?php if(empty($row['source'])){}else{?>
					Source : <?php echo $row['source'];?> } ?> |    <?php  echo date('M d Y',strtotime($row['date'])); ?></span></p>
                                                                                     
					
					<p> <?php 
					
					                      $str_content = strip_tags($row["content"]);
										 
											  if(strlen($str_content)> 130){
											  
											 $str_content = substr($str_content,0,130)." ...";
											 
											echo html_entity_decode($str_content);
											
											}elseif(strlen($str_content) <= 130){
											
											echo html_entity_decode($str_content);
											
											}
					
					
					?> </p>
					<?php $encryp_blog_id = my_simple_crypt($row['0'], 'e' ); ?>
					<a href="single_news.php?news=<?php echo $encryp_blog_id ;?>"> READ MORE</a>
				</div>
				
				<?php }?>
			</div>
		
			
			<div class="row">
				<div class="col-lg-12 text-center">
					<!-- panination -->
			<nav aria-label="Page navigation">
  <ul class="pagination">
   <!-- <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>-->
	<?php echo $paginationCtrls;?>
	
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

