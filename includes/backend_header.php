  <?php 
	//$link = $_SERVER['PHP_SELF'];
	//$link = basename(__FILE__);
	$link = basename($_SERVER['PHP_SELF']);
	
	
	?>
  
  <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!-- User -->
						<?php
						
							    $check =  $_SESSION['user_id'];
								//$check = 10;
								$tb_select = "SELECT * FROM users_tb WHERE id = {$check}";
								$result = mysqli_query($connect,$tb_select);
								if(!$result){
								die ("SELECT TABLE FAILED".mysqli_error($connect));
									}
								while($row = mysqli_fetch_array($result)){
								
								?>
                                            
                    <div class="user-box">
                        <div class="user-img">
						<?php if(!empty($row['7'])){
						
						echo "<img src=\"{$row['7']} \" alt=\"{$row['1']}\" title=\"{$row['1']}\" class=\"img-circle img-thumbnail img-responsive\">";
						}else{
						echo "<img src=\"img/User Male-48 (1).png\" alt=\"{$row['1']}\" title=\"\" class=\"img-circle img-thumbnail img-responsive\">";
						
						}?>
                           
							
                        </div>
						<br/>
		
                        <h5><a href="#"><?php echo $row['1']; }?></a> </h5>
                        <ul class="list-inline">
                            <li>
                                <a href="change_pass.php?page=<?php echo $check;?>" >
                                    <i class="zmdi zmdi-settings"></i>
                                </a>
                            </li>

                            <li>
                                <a href="logout.php" class="text-custom">
                                    <i class="zmdi zmdi-power"></i>
                                </a>
                            </li>
							
							
                        </ul>
			
                    </div>
                    <!-- End User -->

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                       <ul>
                        	<li class="text-muted menu-title">Navigation</li>

                             <li>
                 <a href="dashboard.php" <?php if($link == "dashboard.php"){?> class="active" <?php }?>  class="waves-effect" ><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
                            </li>
							
							<li>
                                <a href="order_tb.php" <?php if($link == "order_tb.php"){?> class="active" <?php }?> class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Orders </span> </a>
                            </li>
							
							 <li class="has_sub">
                                <a href="javascript:void(0);" <?php if($link == "product_tb.php" || $link == "product_frm.php" ){?> class="active" <?php }?> class="waves-effect"><i class="zmdi zmdi-collection-text"></i><span>Products </span> </a>
                                <ul class="list-unstyled">
                                    <li <?php if($link == "product_tb.php"){?> class="active" <?php }?> ><a href="product_tb.php">Products</a></li>
                                    <li  <?php if($link == "product_frm.php"){?> class="active" <?php }?> ><a href="product_frm.php">Add Product</a></li>
                                    
                                </ul>
                            </li>
							
							 <li class="has_sub">
                                <a href="javascript:void(0);" <?php if($link == "blog_tb.php" || $link == "add_news.php" ){?> class="active" <?php }?> class="waves-effect"><i class="zmdi zmdi-collection-text"></i><span>Blog </span> </a>
                                <ul class="list-unstyled">
                                <li <?php if($link == "blog_tb.php"){?> class="active" <?php }?> ><a href="blog_tb.php">All Blog</a></li>
                               <li <?php if($link == "add_news.php"){?> class="active" <?php }?> ><a href="add_news.php">Blog</a></li>
                                    
                                </ul>
                            </li>
							
							<li>
                 <a href="slider.php" <?php if($link == "slider.php"){?> class="active" <?php }?>  class="waves-effect" ><i class="zmdi zmdi-view-dashboard"></i> <span> Slider </span> </a>
                            </li>
							
							
							 <li class="has_sub">
                                <a href="javascript:void(0);" <?php if($link == "gallery_tb.php" || $link == "add_photos.php" ){?> class="active" <?php }?> class="waves-effect"><i class="zmdi zmdi-collection-text"></i><span>Gallery </span> </a>
                                <ul class="list-unstyled">
                                    <li <?php if($link == "gallery_tb.php"){?> class="active" <?php }?> ><a href="gallery_tb.php">All Gallery(ies)</a></li>
                                    <li  <?php if($link == "add_photos.php"){?> class="active" <?php }?> ><a href="add_photos.php">Gallery</a></li>
                                    
                                </ul>
                            </li>
							

							  <li>
                                <a href="category.php" <?php if($link == "category.php"){?> class="active" <?php }?>  class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Categories </span> </a>
                            </li>
							
							 <li class="has_sub">
                                <a href="javascript:void(0);" <?php if($link == "lifestyle_frm.php" || $link == "lifestyle_tb.php" ){?> class="active" <?php }?> class="waves-effect"><i class="zmdi zmdi-collection-text"></i><span>Lifestyle </span> </a>
                                <ul class="list-unstyled">
                                <li <?php if($link == "lifestyle_tb.php"){?> class="active" <?php }?> ><a href="lifestyle_tb.php">All Life Style(s)</a></li>
                               <li <?php if($link == "lifestyle_frm.php"){?> class="active" <?php }?> ><a href="lifestyle_frm.php">Add Life Style</a></li>
                                    
                                </ul>
                            </li>
							
                            <li>
                                <a href="brand.php" <?php if($link == "brand.php"){?> class="active" <?php }?>  class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Brands </span> </a>
                            </li>
							
							
                            <li>
                                <a href="attribute.php"  <?php if($link == "attribute.php"){?> class="active" <?php }?> class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Attributies </span> </a>
                            </li>
							
						
							
							<?php if($_SESSION['type'] == "Administrator"){?>
							<li>
                                <a href="page-register-user.php"  <?php if($link == "page-register-user.php"){?> class="active" <?php }?> class="waves-effect "><i class="zmdi zmdi-view-dashboard"></i> <span> Add User </span> </a>
                            </li>
                                        <?php }else{?>  
										
							<?php }?>  
							
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>
            <!-- Left Sidebar End -->