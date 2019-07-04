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
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <div class="text-center"> Approve questions</div>
               </h1>
                <?php display_message(); ?>



<?php
//$sql = "SELECT * FROM questions ORDER by q_no DESC";

$sql ="SELECT * FROM subjects
INNER JOIN questions ON subjects.subject_id=questions.q_subject_id WHERE questions.a_s = 1 AND questions.a_q = 1 AND questions.user_approve = 1 ORDER BY q_no DESC";

$result=(query($sql));
if(row_count($result)<=0)
 {
     ?>
          <div class="col-md-8 col-md-offset-2">
             <div class='alert alert-danger text-center'><strong>Not Found !</strong></div>                                  
     </div>

<?php
} else {
$i=1;
?>

                    <!-- <div class="table-responsive"> -->
                        <!-- <table id="mytable" class="table table-bordred table-striped"> -->
                            <table class="table table-bordred table-hover">
                            <thead>
                                <tr>
                                <th>Q.No</th>
                                <th>Question</th>
                                <th>S.ID</th>
                                <th>Subject</th>
                                <th>By</th>
                                <th>Date</th>
                                <th>Delete</th>
                                <th>Block</th>
                                <th>Answered</th>
                            </tr>
                            </thead>
                            <?php
                            while($row = mysqli_fetch_array($result))
                            {
                                $id=$row["q_no"];
                                 $date = $row["q_date_time"];
                                 $q_user_id = $row["q_user_id"];
                                 $dt = date("g:i a - d/m/Y", strtotime($date));
                            ?>
                            <tr class="<?php if(isset($classname)) echo $classname;?>">
                                <td>
                                    <b><?php echo $id;?></b>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars_decode($row["question"]); ?>
                                </td>
                                <th>
                                    <b><?php echo $row["subject_id"]; ?></b>
                                </th>
                                <td>
                                    <p style="color:#1A0DB3;"><?php echo $row["sub_name"]; ?></p>
                                </td>
                                <td>
    <?php
    $sq = "SELECT * FROM users WHERE user_id = $q_user_id";
    $res = query($sq);
    confirm($res);
    $roww = fetch_array($res);
    $firstName = ucwords($roww["first_name"]);
    $lastName = ucwords($roww["last_name"]);
    echo "{$firstName}";
    echo " ";
    echo "{$lastName}";
    ?>
    <br>
    <?php
    echo $roww["email"];
?>
                                </td>
                                <td>
                                    <?php echo $dt; ?>
                                </td>
                                <td>
                                   <a href="view_approved_questions.php?delete=<?php echo $id?>"
                                    onclick="return confirm('Are you sure ?')"> <p data-placement="top" data-toggle="tooltip" title="delete"><button class="btn btn-danger btn-xs" data-title="delete" data-toggle="modal" type="delete" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button></p></a>
                                </td>
                                <td>
                    <a href="view_approved_questions.php?block=<?php echo $id?>"onclick="return confirm('Are you sure ?')">
                        <p data-placement="top" data-toggle="tooltip" title="Block"><button class="btn btn-warning btn-xs" data-title="Block" data-toggle="modal" data-target="#accept"><span class="glyphicon glyphicon-ban-circle"></span></button></p></a>
                                </td>
                                <td>
<?php
  $sqlStatus = "SELECT q_no,a_no FROM answers WHERE q_no = $id AND a_s = 1 AND a_q = 1 AND a_a = 1 AND user_approve = 1 ";
  $resultStatus = query($sqlStatus);
  confirm($resultStatus);
  $q_count=0;
  while($rowStatus =fetch_array($resultStatus))
  {
    $a_id=$rowStatus["a_no"];
    $q_count++;
  }
?>

<div class="text-center"><b><?php echo $q_count; ?></b></div>
                                </td>
                            </tr>
                            <?php
                            $i++;
                            }
                        }
                        echo "</table>";
                        ?>


<?php 
    if(isset($_GET['delete'])){ 
        $delete_id=$_GET['delete'];
          $sql1="DELETE FROM answers WHERE q_no='$delete_id'";
          query($sql1);
          $sql="DELETE FROM questions WHERE q_no='$delete_id'";
          query($sql);
    header("location: view_approved_questions.php");

    set_message("<div class='alert alert-danger'>
    <strong>Danger!</strong> Delete successfull.
  </div>

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



<?php 
    if(isset($_GET['block'])){ 
        $block_id=$_GET['block'];

$quer1 = "UPDATE questions SET a_q = 0 WHERE q_no = '$block_id'";
query($quer1);

$quer2 = "UPDATE answers SET a_q = 0 WHERE q_no = '$block_id'";
query($quer2);


    header("location: view_approved_questions.php");
   
    set_message("<div class='alert alert-info'>
    <strong>Info!</strong> Blocked successfully.</div>
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

<?php include "includes/admin_footer.php" ?>