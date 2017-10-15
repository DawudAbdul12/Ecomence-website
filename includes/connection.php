<?php 
$connect = mysqli_connect("localhost", "root", "concord", "shop_db");
if(!$connect){
die("connection fail: ". mysqli_error());
}

$page_title = "Gents Pack - ADMIN";
   
?>