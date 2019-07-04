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
                        <div class="text-center"> Pending questions</div>
               </h1>
                <?php display_message(); ?>



<?php
$sql ="SELECT * FROM subjects
INNER JOIN questions ON subjects.subject_id = questions.q_subject_id WHERE questions.a_q = 0 AND questions.user_approve = 1";


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

                    <div class="table-responsive">
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                                <th>SL. No</th>
                                <th>Question</th>
                                <th>Subject</th>
                                <th>By</th>
                                <th>Date</th>
                                <th>Delete</th>
                                <th>Accept</th>
                            </thead>
                            <?php
                            $i = 1;
                            while($row = mysqli_fetch_array($result))
                            {
                                $id=$row["q_no"];
                                $date = $row["q_date_time"];
                                $dt = date("g:i a - d/m/Y", strtotime($date));
                            ?>
                            <tr class="<?php if(isset($classname)) echo $classname;?>">
                                <td>
                                    <?php echo $i;?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars_decode($row["question"]); ?>
                                </td>
                                <td>
                                    <?php echo $row["sub_name"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["q_email"]; ?>
                                </td>
                                <td>
                                    <?php echo $dt; ?>
                                </td>
                                <td>
                                   <a href="view_pending_questions.php?delete=<?php echo $id?>"
                                    onclick="return confirm('Are you sure ?')"> <p data-placement="top" data-toggle="tooltip" title="delete"><button class="btn btn-danger btn-xs" data-title="delete" data-toggle="modal" type="delete" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button></p></a>
                                </td>
                                <td>
                                <a href="view_pending_questions.php?accept=<?php echo $id?>"onclick="return confirm('Are you sure ?')">
                                    <p data-placement="top" data-toggle="tooltip" title="Accept"><button class="btn btn-success btn-xs" data-title="Accept" data-toggle="modal" data-target="#accept"><span class="glyphicon glyphicon-ok"></span></button></p></a>
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

    header("location: view_pending_questions.php");
    
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
    if(isset($_GET['accept'])){ 
    $accept_id=$_GET['accept'];
          

$quer1 = "UPDATE questions SET a_q = 1 WHERE q_no = '$accept_id'";
query($quer1);

$quer2 = "UPDATE answers SET a_q = 1 WHERE q_no = '$accept_id'";
query($quer2);


    header("location: view_pending_questions.php");
 
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
</div>
<?php include "includes/admin_footer.php" ?>