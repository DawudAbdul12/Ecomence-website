
    	  <?php

    	  // DECRYPT FUNCTION AND ENCRYPT FUNCTION

function my_simple_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
}



		  function confirm_query($result_set){
			if(!$result_set){
				 die("Database connection failed: ".mysqli_error());
							}
							}
							function mysql_prep($value){
  $magic_quotes_active = get_magic_quotes_gpc();
  $new_enough_php = function_exists("mysql_real_escape_string");
   if($new_enough_php){
      if($magic_quotes_active){$value = stripslashes($value);}
	    $value = mysql_real_escape_string($value);
   }else{
      if(!magic_quotes_active){$value = addslashes($value);}
   
   }
     return $value;
  
  }

  
function get_subject_by_id($subject_id) {
		 global $connection;
		 $query = "SELECT * ";
		 $query .= "FROM subject ";
		 $query .= "WHERE id=" . $subject_id ." ";
		 $query .= "LIMIT 1";
		 $result_set = mysql_query($query, $connection);
		 confirm_query($result_set);
		 if($subject = mysql_fetch_array($result_set)) {
		 return $subject;
		 } else{
		   return NULL;
		 }
		 }
		 function get_video_by_id($subject_id) {
		 global $connection;
		 $query = "SELECT * ";
		 $query .= "FROM videos ";
		 $query .= "WHERE id=" . $subject_id ." ";
		 $query .= "LIMIT 1";
		 $result_set = mysql_query($query, $connection);
		 confirm_query($result_set);
		 if($subject = mysql_fetch_array($result_set)) {
		 return $subject;
		 } else{
		   return NULL;
		 }
		 }
		 function get_event_by_id($subject_id) {
		 global $connection;
		 $query = "SELECT * ";
		 $query .= "FROM event ";
		 $query .= "WHERE id=" . $subject_id ." ";
		 $query .= "LIMIT 1";
		 $result_set = mysql_query($query, $connection);
		 confirm_query($result_set);
		 if($subject = mysql_fetch_array($result_set)) {
		 return $subject;
		 } else{
		   return NULL;
		 }
		 }
		 function get_images_by_id($subject_id) {
		 global $connection;
		 $query = "SELECT * ";
		 $query .= "FROM pictures ";
		 $query .= "WHERE id=" . $subject_id ." ";
		 $query .= "LIMIT 1";
		 $result_set = mysql_query($query, $connection);
		 confirm_query($result_set);
		 if($subject = mysql_fetch_array($result_set)) {
		 return $subject;
		 } else{
		   return NULL;
		 }
		 }
		 function get_album_by_id($subject_id) {
		 global $connection;
		 $query = "SELECT * ";
		 $query .= "FROM album ";
		 $query .= "WHERE id=" . $subject_id ." ";
		 $query .= "LIMIT 1";
		 $result_set = mysql_query($query, $connection);
		 confirm_query($result_set);
		 if($subject = mysql_fetch_array($result_set)) {
		 return $subject;
		 } else{
		   return NULL;
		 }
		 }
		 function get_advert_by_id($subject_id) {
		 global $connection;
		 $query = "SELECT * ";
		 $query .= "FROM advertisement ";
		 $query .= "WHERE id=" . $subject_id ." ";
		 $query .= "LIMIT 1";
		 $result_set = mysql_query($query, $connection);
		 confirm_query($result_set);
		 if($subject = mysql_fetch_array($result_set)) {
		 return $subject;
		 } else{
		   return NULL;
		 }
		 }
		 function get_about_by_id($subject_id) {
		 global $connection;
		 $query = "SELECT * ";
		 $query .= "FROM about_us ";
		 $query .= "WHERE id=" . $subject_id ." ";
		 $query .= "LIMIT 1";
		 $result_set = mysql_query($query, $connection);
		 confirm_query($result_set);
		 if($subject = mysql_fetch_array($result_set)) {
		 return $subject;
		 } else{
		   return NULL;
		 }
		 }
		  function get_contact_id($subject_id) {
		 global $connection;
		 $query = "SELECT * ";
		 $query .= "FROM contact ";
		 $query .= "WHERE id=" . $subject_id ." ";
		 $query .= "LIMIT 1";
		 $result_set = mysql_query($query, $connection);
		 confirm_query($result_set);
		 if($subject = mysql_fetch_array($result_set)) {
		 return $subject;
		 } else{
		   return NULL;
		 }
		 }
		  ?>