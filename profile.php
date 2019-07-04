<?php include("includes/header.php") ?>
<?php

  	if(logged_in()){

  	} else {

  		redirect("login.php");
  	} 

?>
<?php include("includes/nav.php") ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-white post panel-shadow">
<div class="row">
              <div class="col-md-8 col-md-offset-2" >

                
                
            
                

                <div class="text-center">
                  <h2 style="color:royalblue;">

                    <?php
if (isset($_SESSION['email']))
$sql = "SELECT * FROM users WHERE email ='$_SESSION[email]'";
$result = query($sql);
confirm($result);
$row=fetch_array($result);
                    echo ucwords($row['first_name']);
                    echo " ";
                    echo ucwords($row['last_name']);
                    ?>

                  </h2>
                </div>

                <!-- <div class="well" style="background-color:White;"> -->
              <div class="panel panel-primary" >
                <div class="panel-body ">
                  <form action="#" method="post" class="form-horizontal" >
                      <div class="form-group">
                      <label for="avatar" class="col-sm-2 control-label"><!--Userame--></label>
                          <div class="col-sm-10">
                              <div class="custom-input-file">
                                  <label class="uploadPhoto">
<!--                                      <img src="Profile_picture/user.png" alt="User" class="img-circle" style=" width: 140px; height: 140px;">-->
                                      
                                     
<?php 
if (!strlen($post_pic) < 1 || !empty($post_pic)) {
?>
 <?php echo "<a href='Profile_picture/$row[profile_pic]' target='_blank'><img src='Profile_picture/".$row["profile_pic"]."' alt=' ' class='img-circle' style=' width: 140px; height: 140px;'  /></a>";?>
<?php
}
else
{
  echo "<img src='Profile_picture/user.png' alt='User' class='img-circle' style=' width: 140px; height: 140px; margin-top: 6px;'>";
} 

?>



                                  </label>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="name" class="col-sm-2 control-label">Userame</label>
                          <div class="col-sm-10">

                              <p style="color:#02225a;"> <?php echo $row['username']; ?> </p>

                          </div>
                      </div>

                      <div class="form-group">
                          <label for="nickName" class="col-sm-2 control-label">Name</label>
                          <div class="col-sm-10">
                            <p style="color:#02225a;">
                              <?php
                              echo ucwords($row['first_name']);
                              echo " ";
                              echo ucwords($row['last_name']);
                              ?>
                            </p>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="email" class="col-sm-2 control-label">Email</label>
                          <div class="col-sm-10">
                            <p style="color:#02225a;"> <?php echo $row['email'];?> </p>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="email" class="col-sm-2 control-label">Education credential</label>
                            <div class="col-sm-10">
                              <p style="color:#02225a;"><?php echo $row['education']; ?></p>
                      </div>
                      </div>

                      <div class="form-group">
                          <label for="email" class="col-sm-2 control-label">Employment credential</label>
                          <div class="col-sm-10">
                            <p style="color:#02225a;"><?php echo $row['employment']; ?></p>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="newPassword" class="col-sm-2 control-label">Address</label>
                          <div class="col-sm-10">
                            <p style="color:#02225a;"><?php echo $row['address']; ?></p>
                          </div>
                      </div>
        
                      <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <a href="account_setting.php" class="btn btn-primary btn-circle pull-right"> Edit </a>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  </div>
              </div>
          </div>
      </div>
</div>
</div>
<?php include("includes/footer.php") ?>
