 <?php include("includes/header.php") ?>
 <?php

  	if(logged_in()){

  	} else {

  		redirect("login.php");
  	}

?>
<?php include("includes/nav.php") ?>


<?php 

if(isset($_GET['sol_id'])){
$solution_id = $_GET['sol_id'];
 

  $quer = "UPDATE post_solution SET status = 'read' WHERE solution_id = '$solution_id' ";
  query($quer);

        
  $qry="SELECT * FROM post_solution WHERE solution_id = $solution_id";
  $result = query($qry);
  confirm($result);
  $row=fetch_array($result);
  $date = $row["admin_des_time"];
  $dt = date("F d, Y", strtotime($date));
}
 ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-white post panel-shadow">
              <div class="row">
              <div class="col-md-8 col-md-offset-2" >
                <br>
              <div class="well">
     <?php
if (isset($_SESSION['email'])) {
$sqlUser = "SELECT * FROM users WHERE email='$_SESSION[email]'";
$resultUser = query($sqlUser);
confirm($resultUser);
$rowUser=fetch_array($resultUser);
$email = $rowUser['email'];
}
  ?>                             

<div style="margin-top:50px;">
    <div>
      <p><?php echo $dt; ?></p>
    </div>
     <div>
    To:<span style="color: #4169E1;"><?php echo $rowUser["email"]; ?></span><br>
    From: <span style="color: #4169E1;">support.odf@odfmail.com</span>
    </div>
       <hr>
    <div >
      <p>Dear Mr. / Mrs. 

<?php 
echo ucwords($rowUser['first_name']);
echo " ";
echo ucwords($rowUser['last_name']);
 ?>
  
    </p>
    </div>
</div>      
      


<!-- <div style="margin-top:50px;">
    <h3 style="color: #04247d;"><?php echo $row['admin_subject']; ?></h3>
    <small>From admin</small>
    <small class="pull-right"></small>
</div>  -->     
<div class="text-center">
               <div style="margin-bottom:100px; margin-top: 20px; text-align:justify;">
                <div>
                  <?php echo htmlspecialchars_decode($row["admin_description"]); ?>
                </div>
                  

<div class="pull-right" style="margin-top: 50px;">
  <p><b>Sincerely,</b> <br>Online Discussion Forum</p>

</div> 
               </div>
              </div>
               
              <!--  <div style="margin-bottom:100px; margin-top: 50px;" class="text-center">
                   <?php echo htmlspecialchars_decode($row['admin_description']); ?>  
               </div>
               -->

                  </div>

<a href="query.php" class="btn btn-primary btn-circle" role="button" style="margin-bottom: 30px;"><i class="fa fa-arrow-left" aria-hidden="true"> Back </i></a>

               </div>
             </div>
            </div>
        </div>
    </div>
</div>




<?php include("includes/footer.php") ?>