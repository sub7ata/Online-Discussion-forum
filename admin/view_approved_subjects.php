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
                    <div class="text-center">
                        Available subjects
                    </div>
                    </h1>
                    <div class="table-responsive">

                     <?php display_message();  ?>



    <?php
    $sql = "SELECT * FROM subjects WHERE a_s = 1";
    $result=(query($sql));


if(row_count($result)<=0)
 {
     ?>
            <div class="col-md-8 col-md-offset-2">
             <div class='alert alert-danger text-center'><strong>Not Found</strong></div>                                  
     
            </div>
<?php
} else {

    ?>


                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                                <th>SL. No</th>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Uploaded By</th>
                                <th>Date/Time</th>
                                <th>Delete</th>
                                <!-- <th>Edit</th> -->
                                 <th>Hide</th>             
                            </thead>
                            <?php
                            $k = 1;
                            while($row =fetch_array($result))
                            {
                                $sub_id=$row['subject_id'];
                                 $date = $row["sub_date_time"];
                                 $dt = date("g:i a - d/m/Y", strtotime($date));
                            ?>
                            <tr class="<?php if(isset($classname)) echo $classname;?>">
                                <td>
                                    <?php echo $k ;?>
                                </td>
                                <td>
                                    <?php echo $row["sub_code"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["sub_name"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["sub_uploaded_by"]; ?>
                                </td>
                                <td>
                                    <?php echo $dt; ?>
                                </td>
                                <td>
                                    <a href="view_approved_subjects.php?delete_sub=<?php echo $sub_id?>"onclick="return confirm('Are you sure ?')"><p data-placement="top" data-toggle="tooltip" title="delete"><button class="btn btn-danger btn-xs" data-title="delete" data-toggle="modal" type="delete" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button></p> </a>
                                </td>

                                <!-- <td>
                                    <a href="view_all_subjects.php?edit_sub=<?php echo $sub_id?>"onclick="return confirm('Are you sure ?')">
                                      <button type="edit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModalCenter"><span class="glyphicon glyphicon-edit"></span></button>
                                    </a>
                                </td>
                                       -->                          <td>
                    <a href="view_approved_subjects.php?block=<?php echo $sub_id?>"onclick="return confirm('Are you sure ?')">
                        <p data-placement="top" data-toggle="tooltip" title="Block"><button class="btn btn-warning btn-xs" data-title="Block" data-toggle="modal" data-target="#accept"><span class="glyphicon glyphicon-ban-circle"></span></button></p></a>
                                </td>
                            </tr>
                            <?php
                            $k ++;
                            }
                            }
                        echo "</table>";
                       
                        ?>

<?php 
    if(isset($_GET['delete_sub'])){ 
        $del_id=$_GET['delete_sub'];

    
    $sql1="DELETE FROM answers WHERE subject_id='$del_id'";
    query($sql1);

    $sql2="DELETE FROM questions WHERE subject_id='$del_id'";
    query($sql2);

    $sql="DELETE FROM subjects WHERE subject_id='$del_id'";
        query($sql);

    header("location: view_approved_subjects.php");
     // set_message("<div class='alert alert-success text-center'><strong>Delete successfull !</strong></div>");

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

$quer = "UPDATE subjects SET a_s = 0 WHERE subject_id = '$block_id'";
query($quer);


$quer1 = "UPDATE questions SET a_s = 0 WHERE q_subject_id = '$block_id'";
query($quer1);

$quer2 = "UPDATE answers SET a_s = 0 WHERE a_subject_id = '$block_id'";
query($quer2);








    header("location: view_approved_subjects.php");
    // set_message("<div class='alert alert-danger text-center'><strong>Blocked successfully!</strong></div>");
   

    set_message("<div class='alert alert-info'>
    <strong>Info!</strong> Blocked successfully!.</div>
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