<?php  require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/function.php");?>

<?php
  ######### GET NEWS ID FROM THE LINK ########
   if(isset($_GET['news'])){
   $news_id = $_GET['news'];  
   $news_id = my_simple_crypt($news_id, 'd' ); 
   $tb_select = "SELECT * FROM blog_tb WHERE ID = {$news_id} AND published = 'Yes' ORDER by id DESC  limit 1";
   $result = mysqli_query($connect,$tb_select);
   if(!$result){
   die ("SELECT TABLE FAILED".mysqli_error());
   }
   while($row = mysqli_fetch_array($result)){
   
    $id = $row['0'];
	$title =  $row['title'];
	$date =  $row['date'];
	$posted_by =  $row['posted_by'];
	$content =  $row['content'];
	$image =  $row['image'];
	$tag =  $row['tag'];
						
			}
  ######### GET NEWS ID FROM THE LINK ########
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
		<link href="css/chest-styles.css" rel="stylesheet">
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
				<h2><strong>INSIDE MY CHEST</strong></h2>
			</div>	
		</div>
	</header>
	
	<div class="container">
		<div class="row space">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 section-2">
			 	<h2><?php echo $title;?></h2>
			 	<p class="lead"><span style="text-transform: uppercase;">AUTHOR: <?php echo $posted_by ;?> | <?php  echo date('M d Y',strtotime($date));?></span></p>
			 	<br>
			 	<?php echo $content; ?>
			 	<p class="spec">
			 		<strong>TAGS: </strong>
			 		<em><?php echo $tag;?></em>
			 	</p>
			 	<p class="spec">
			 		<strong>SHARE: </strong>
			 		<!--<i class="fa fa-facebook"></i>
			 		<i class="fa fa-twitter"></i>
			 		<i class="fa fa-google-plus"></i>
			 		<i class="fa fa-linkedin"></i>-->
				<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
				<!--<a class="a2a_dd" href="https://www.addtoany.com/share"></a>-->
				<a class="a2a_button_facebook"></a>
				<a class="a2a_button_twitter"></a>
				<a class="a2a_button_google_plus"></a>
				</div>
				<script async src="https://static.addtoany.com/menu/page.js"></script>
			 	</p>
			 	<hr>
			 	<!--<h3>LEAVE A COMMENT</h3>
			 	<form class="form-group">
			 		<textarea class="form-control" rows="8"></textarea>
			 	</form>-->
			 	<h3>RELATED POSTS</h3>
			 	<div class="row related">
			 		<?php
								
				// This sets the range of rows to query for the chosen $pagenum
				//$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
				// This is your query again, it is for grabbing just one page worth of rows by applying $limit
				               $limit = "limit 0,3";
				               $status = "Yes";
				               $tb_select = "SELECT * FROM blog_tb WHERE published = '{$status}' AND id != {$news_id} ORDER BY id DESC $limit";
							   $result = mysqli_query($connect,$tb_select);
							   if(!$result){
							   die ("SELECT TABLE FAILED".mysqli_error());
							   }
							   while($row = mysqli_fetch_array($result)){
							  
							   ?>
							   
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-bot">
					<img src="<?php echo $row['pic'];?>" class="img-responsive">
					<h3><?php 
					
						 $str = strip_tags($row["title"]);
						 
							  if(strlen($str)> 20){
							  
							 $str = substr($str,0,20)."<span style=\"font-size:9px\"> ...</span>";
							 
							echo $str;
							
							}elseif(strlen($str) <= 20){
							
							echo $str;
							
							}
					
					?></h3>
					<p class="small"><span style="text-transform: uppercase;">POSTED BY <?php echo $row['posted_by'];?> | <?php  echo date('M d Y',strtotime($row['date'])); ?></span></p>
					
					<p> <?php 
					
					                      $str_content = strip_tags($row["content"]);
										 
											  if(strlen($str_content)> 130){
											  
											 $str_content = substr($str_content,0,130)." ...";
											 
											echo $str_content;
											
											}elseif(strlen($str_content) <= 130){
											
											echo $str_content;
											
											}
					
					
					?> </p>
					<?php $encryp_blog_id = my_simple_crypt($row['0'], 'e' ); ?>
					<a href="single_news.php?news=<?php echo $encryp_blog_id; ?>">READ MORE</a>
				</div>
				
				<?php }?>
			 	</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 section-3">
			 	<!--<h4>RECENT POST</h4>
			 	<hr>
			 	<div class="col-lg-12 clearfix">
			 		<img src="images/img-1.jpg" class="pull-left margin-right img-responsive">
			 		<h5>Reviving The Check Shirt</h5>
			 		<p class="small">October 21, 2015</p>
			 	</div>
			 	<div class="col-lg-12 clearfix">
			 		<img src="images/img-1.jpg" class="pull-left margin-right img-responsive">
			 		<h5>Beard & Moustache Trend</h5>
			 		<p class="small">August 11, 2015</p>
			 	</div>
			 	<div class="col-lg-12 clearfix">
			 		<img src="images/img-1.jpg" class="pull-left margin-right img-responsive">
			 		<h5>Modern Man's Elegance</h5>
			 		<p class="small">August 11, 2015</p>
			 	</div>-->
			 	<img src="images/img1.jpg" class="img-responsive">
			 	<div class="feed">
			 		<h4>TWITTER FEED</h4>
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

