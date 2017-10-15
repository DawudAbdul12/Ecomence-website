
$(document).ready(function(){
       $("#link_hov").hover(show_cart());
	   //alert("it works");
      $.ajax({
        type:'post',
        url:'store_items.php',
        data:{
          total_cart_items:"totalitems"
        },
        success:function(response) {
		
		  var array_data = String(response).split("<br/>");
		  
		  document.getElementById("total_items").innerHTML = array_data[0]; //response;
		  document.getElementById("total_Amt").innerHTML = array_data[1]; //response;
          //document.getElementById("total_items").value=response;
		  // MOBILE VIEW
		   document.getElementById("total_items_mobile").innerHTML = array_data[0]; //response;
		    document.getElementById("total_Amt_mobile").innerHTML = array_data[1]; //response;
        }
      });

    });
	
	
	

    function cart(id)
    {
	
	toastr.success('Product Added to Cart');
	  var ele=document.getElementById(id);
	  //var img_src=ele.getElementsByTagName("img")[0].src;
	  var product_id=document.getElementById(id+"product_id").value;
	  var price=document.getElementById(id+"_price").value;
	 //alert(<?php echo count($_SESSION['cart_product']);?>);
	 //alert(price);
	 
	  $.ajax({
        type:'post',
        url:'store_items.php',
        data:{
          //item_src:img_src,
          itemID:product_id,
          item_price:price
        },
        success:function(response){
		show_cart();
		var array_data = String(response).split("<br/>");
		
         // document.getElementById("total_Amt").value=array_data[0]; //response;
		  
		  document.getElementById("total_items").innerHTML = array_data[0]; //response;
		 document.getElementById("total_Amt").innerHTML = array_data[1]; //response;
                         
						 // $('#'+id+'success_message').fadeIn().html("<img src='icon.png' style='width:10px;height:10px;'>");  
						  $('#success_message').fadeIn().html("<a href='cart.php'><i class='fa fa-check-circle-o fa-2x'></i></a>");  
                         setTimeout(function(){  
                             $('#success_message').fadeOut("Slow");  
                         }, 2000);  
        }
      });
	
    }
     
	 
	 
    function show_cart()
    {
	
      $.ajax({
      type:'post',
      url:'store_items.php',
      data:{
        showcart:"cart"
      },
      success:function(response) {
        document.getElementById("mycart").innerHTML=response;
        //$("#mycart").slideToggle();
      }
     });

    }