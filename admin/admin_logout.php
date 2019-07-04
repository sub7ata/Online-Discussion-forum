<?php include("functions/admin_init.php");

unset($_SESSION['admin_email']);

if(isset($_COOKIE['admin_email'])) {

	unset($_COOKIE['admin_email']);
   
	
	 setcookie('admin_email','',time() -86400);
}
redirect("admin_login.php");

   // set_message("<div class='alert alert-success text-center'><strong>You have been successfully logged out!</strong></div>");
   

set_message("<div class='alert alert-success'>
    <strong>Success!</strong> You have been successfully logged out! </div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 5000);
	</script>
    ");
?>