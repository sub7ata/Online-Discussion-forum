<?php include "includes/admin_header.php";?>
<?php
if(admin_logged_in()){

} else {
redirect("admin_login.php");
}
?>
<?php include "includes/admin_navigation.php" ?>

<?php 

if(isset($_GET['query_id'])){
$solution_id = $_GET['query_id'];
 

  $quer = "UPDATE post_query SET status = 'read' WHERE query_id = '$solution_id' ";
  query($quer);

        
  $qry="SELECT * FROM post_query WHERE query_id = $solution_id";
  $result = query($qry);
  confirm($result);
  $row=fetch_array($result);
  $date = $row["user_des_time"];
  $dt = date("F d, Y", strtotime($date));
  $user_id = $row["user_des_id"];
}
 ?>


<div id="wrapper">
  <div<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-white post panel-shadow">
              <div class="row">
              <div class="col-md-8 col-md-offset-2" >
                <br>
              <div class="well">
<?php
$sqlUser = "SELECT * FROM users WHERE user_id='$user_id'";
$resultUser = query($sqlUser);
confirm($resultUser);
$rowUser=fetch_array($resultUser);
?>                                

<div style="margin-top:50px;">
    <div>
      <p><?php echo $dt; ?></p>
    </div> 
    <div>
    To:<span style="color: #4169E1;"> support.odf@odfmail.com </span><br>
    From: <span style="color: #4169E1;"><?php echo $rowUser["email"]; ?></span>
    </div>
       <hr>
    <div>
          To, <br>
    Online Discussion Forum,
    </div>
    <br>
    <div class="text-center">
     <b> Subject: <?php echo $row['user_subject']; ?></b>
    </div>
    <br>
    <div >
      <p>Dear Sir/Madam, 


  
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
                  <?php echo htmlspecialchars_decode($row["user_description"]); ?>
                </div>
                  

<div class="pull-right" style="margin-top: 20px;">
  <p><b>Thanking you so much.<br>Yours Truly,</b> <br>  

<?php
echo ucwords($rowUser['first_name']);
echo " ";
echo ucwords($rowUser['last_name']);
  ?>
</p>

</div> 
               </div>
              </div>
               
              <!--  <div style="margin-bottom:100px; margin-top: 50px;" class="text-center">
                   <?php echo htmlspecialchars_decode($row['admin_description']); ?>  
               </div>
               -->

                  </div>

<a href="user_request.php" class="btn btn-primary btn-circle" role="button" style="margin-bottom: 30px;"><i class="fa fa-arrow-left" aria-hidden="true"> Back </i></a>

               </div>
             </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/admin_footer.php" ?>