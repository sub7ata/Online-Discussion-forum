<?php include("functions/init.php");
	if(logged_in()){	


if (isset($_SESSION['email'])) {
	$query = "UPDATE users SET online = 0 WHERE email = '$_SESSION[email]'";
	$resultQuery = query($query);
	confirm($resultQuery);
}

///session_destroy();
unset($_SESSION['email']);
 
if(isset($_COOKIE['email'])) { 

$query = "UPDATE users SET online = 0 WHERE email = '$_COOKIE[email]'";
	$resultQuery = query($query);
	confirm($resultQuery);

	unset($_COOKIE['email']);
	
	 setcookie('email','',time() -86400);


}
echo "<center>You have successfully logged out!<br><a href='index.php'' class='icon-button star'>Return Home</button></center>";
//redirect("message.php");
        
        
        } else {

  		redirect("index.php");
  	}
        


?>



