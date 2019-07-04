<?php include "includes/admin_header.php" ?>

<?php

    if(admin_logged_in()){

    } else {
    redirect("admin_login.php");
    }

?>

<div id="wrapper">
<?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                        <h1 class="page-header">
                          <div class="text-center"> Not verified users</div>
                        </h1>

<?php display_message();  ?>


<?php
$sql ="SELECT * FROM users WHERE  approve = 0";
$result=(query($sql));

if(row_count($result)<=0)
 {
?>
          <div class="col-md-8 col-md-offset-2">
             <div class='alert alert-danger text-center'><strong>Not Found !</strong></div>
          </div>

<?php
} else {
?>


                    <div class="table-responsive">
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                                <th>SL.No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Delete</th>
                                <th>Approve</th>
                            </thead>

<?php
while($row =fetch_array($result))
  {
    $id=$row["user_id"];
    $date = $row["u_date_time"];
    $dt = date("g:i a - d/m/Y", strtotime($date));
?>

                            <tr class="<?php if(isset($classname)) echo $classname;?>">
                                <td> <?php echo$row["user_id"];?></td>
                                <td><?php echo $row["username"]; ?></td>
                                <td> <?php echo $row["email"]; ?></td>
                                <td><?php echo ucwords($row["first_name"]); ?>
                                    <?php echo ucwords($row["last_name"]); ?>
                                </td>
                                <td><?php echo $dt; ?></td>
                                <td>
                                     <a href="view_pending_user.php?delete=<?php echo $id?>"
                                    onclick="return confirm('Are you sure ?')"> <p data-placement="top" data-toggle="tooltip" title="delete"><button class="btn btn-danger btn-xs" data-title="delete" data-toggle="modal" type="delete" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button></p></a>
                                </td>

                                 <td>
                            <a href="view_pending_user.php?accept=<?php echo $id?>"onclick="return confirm('Are you sure ?')">
                            <p data-placement="top" data-toggle="tooltip" title="Accept"><button class="btn btn-success btn-xs" data-title="Accept" data-toggle="modal" data-target="#accept"><span class="glyphicon glyphicon-ok"></span></button></p></a>
                                </td>
                            </tr>

<?php
  }
}
echo "</table>";
?>


<?php
    if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];

    $sql1="DELETE FROM users WHERE user_id='$del_id'";
    query($sql1);

    $sql2="DELETE FROM questions WHERE q_user_id='$del_id'";
    query($sql2);

    $sql="DELETE FROM answers WHERE a_user_id='$del_id'";
    query($sql);


    header("location: view_pending_user.php");

    set_message("<div class='alert alert-danger'>
    <strong>Danger!</strong> Delete successfull.
    </div>

    <script type='text/javascript'>
    window.setTimeout(function() {
      $('.alert').fadeTo(500, 0).slideUp(500, function(){
         $(this).remove();
      });
    }, 1000);
    </script>
    ");
   }
  ?>



<?php
    if(isset($_GET['accept'])){
    $accept_id=$_GET['accept'];

$quer = "UPDATE users SET approve = 1 WHERE user_id = '$accept_id'";
query($quer);

$quer1 = "UPDATE questions SET user_approve = 1 WHERE q_user_id = '$accept_id'";
query($quer1);

$quer2 = "UPDATE answers SET user_approve = 1 WHERE a_user_id = '$accept_id'";
query($quer2);

$quer3 = "UPDATE discussion SET approve = 1 WHERE d_user_id = '$accept_id'";
query($quer3);

// ######################### WELCOME MESSAGE #############################
$sql = "INSERT INTO post_solution(admin_subject,admin_description,admin_des_time,query_id,query_user_id,status)";

$sql.="VALUES('Welcome','Welcome to O.D.F ! As Manager of ODF, I would like to personally welcome you as a new advertiser. You are another fortunate taking part in the ODF.  Our associates are licensed contractors with lifetime of experience in real estate maintenance. We have assigned John Doe to take care of your account. Please feel free to contact our office at +91 9932259291 at any time and we will immediately take care of any problems. Again, thank you for choosing ODF.','$date',0,'$accept_id','unread')";

  $result=query($sql);
  confirm($result);



    header("location: view_pending_user.php");

    set_message("<div class='alert alert-info'>
    <strong>Info!</strong> Approve successfull.</div>

    <script type='text/javascript'>
      window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
        });
      }, 2000);
    </script>
    ");
   }
  ?>


              </table>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include "includes/admin_footer.php" ?>
