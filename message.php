<?php include("includes/header.php") ?>
<?php include("includes/nav.php") ?>
                           
<?php                   
if (isset($_SESSION['email'])) {     
$sql = "SELECT * FROM users WHERE email='$_SESSION[email]'";   
$result = query($sql);
confirm($result);
$row=fetch_array($result);
}
?>
<div class="row">
 <div class="container text-center">
    <h2 class="alert alert-success" role="alert">
  	<?php

  	if(logged_in()){
//  		echo " Welcome ";  
//        echo ucwords($row['first_name']); 
//        echo " ";
//        echo ucwords($row['last_name']);
  	} else {

  		redirect("index.php");
  	}

  	 ?> 


<form action="" method="post" id="frmLogout">
    <div class="member-dashboard">Welcome
        <?php echo ucwords($row['first_name']); ?>
        <?php echo " ";?>
        <?php echo ucwords($row['last_name']);?>, You have successfully logged in!<br> Click to <a href="logout.php" class="btn btn-info" role="button"><span class="fa fa-power-off"></span> Log Out</a>
    </div>
</form>
  </h2>
</div>
</div>

<?php include("includes/footer.php") ?>