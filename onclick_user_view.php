<?php include("includes/header.php") ?>
<?php include("includes/nav.php") ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-white post panel-shadow" style="background-color: #B0E0E6;">
<div class="row">
              <div class="col-md-8 col-md-offset-2" >

                
                
             
                

                <div class="text-center">
                  <h2 style="color:royalblue;">


                  </h2>
                </div>

<?php
if(isset($_GET['user_id'])){
$a_id = $_GET['user_id'];

$sql1 = "SELECT * FROM users WHERE user_id ='$a_id'";
$result1 = query($sql1);
confirm($result1);
$row=fetch_array($result1);

?>


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
                                      
                                      <?php echo "<a href='Profile_picture/$row[profile_pic]' target='_blank'><img src='Profile_picture/".$row["profile_pic"]."' alt=' ' class='img-circle' style=' width: 140px; height: 140px;'  /></a>";?>
                                  </label>
                              </div>
                          </div>
                      </div>
                      <hr style="border-color: #4169E1">
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
                      <hr style="border-color: #4169E1">
        
<?php
  $sqlVote = "SELECT count(1) FROM questions WHERE q_user_id ='$a_id'";
   $resVote = query($sqlVote);
    confirm($resVote);
    $rowVoteDis = fetch_array($resVote);
    $totalReportDis = $rowVoteDis[0];
?>

                    <div class="col-xs-12 divider text-center">
                <div class="col-xs-12 col-sm-4 emphasis">
                    <h2><strong> <?php echo   $totalReportDis; ?> </strong></h2>                    
                    <p><small>Post qoestions</small></p>
               
                </div>

<?php
  $sqlVote = "SELECT count(1) FROM answers WHERE a_user_id ='$a_id'";
   $resVote = query($sqlVote);
    confirm($resVote);
    $rowVoteDis = fetch_array($resVote);
    $totalReport = $rowVoteDis[0];
?>
                <div class="col-xs-12 col-sm-4 emphasis">
                    <h2><strong><?php echo   $totalReport; ?></strong></h2>                    
                    <p><small>Post answers</small></p>
                 
                </div>


<?php
  $sqlVotes = "SELECT count(1) FROM answer_vote WHERE user_ID ='$a_id'";
   $resVotes = query($sqlVotes);
    confirm($resVotes);
    $rowVotes = fetch_array($resVotes);
    $totalVots = $rowVotes[0];
?>
                  <div class="col-xs-12 col-sm-4 emphasis">
                    <h2><strong> <?php echo $totalVots; ?> </strong></h2>                    
                    <p><small>Upvotes</small></p>
                 
                </div>
                        </div>
                      </form>
                    </div>
                  </div>
                <?php } ?>
                  </div>
              </div>
          </div>
      </div>
</div>
</div>
<?php include("includes/footer.php") ?>
