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
                            <div class="text-center">Verified users</div>
                        </h1>
                        <?php display_message();  ?>



                        <?php
     $sql ="SELECT * FROM users WHERE  approve = 1";
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
                                            <th>Block</th>
                                            <th>Message</th>
                                        </thead>
                                        <?php
while($row =fetch_array($result))
{
    $id=$row["user_id"];
    $date = $row["u_date_time"];
    $dt = date("g:i a - d/m/Y", strtotime($date));
    ?>
                                            <tr class="<?php if(isset($classname)) echo $classname;?>">
                                                <td>
                                                    <?php echo$row["user_id"];?>
                                                </td>
                                                <td>
                                                    <?php echo $row["username"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["email"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo ucwords($row["first_name"]); ?>
                                                    <?php echo ucwords($row["last_name"]); ?>
                                                </td>
                                                <td>
                                                    <?php echo $dt; ?>
                                                </td>
                                                <td>
                                                    <a href="view_all_users.php?delete_user=<?php echo $id?>" onclick="return confirm('Are you sure ?')">
                                                        <p data-placement="top" data-toggle="tooltip" title="delete">
                                                            <button class="btn btn-danger btn-xs" data-title="delete" data-toggle="modal" type="delete" data-target="#delete">
                            <span class="glyphicon glyphicon-trash"></span></button></p>
                                                    </a>
                                                </td>

                                                <td>
                                                    <a href="view_approved_users.php?block=<?php echo $id?>" onclick="return confirm('Are you sure ?')">
                                                        <p data-placement="top" data-toggle="tooltip" title="Block">
                                                            <button class="btn btn-warning btn-xs" data-title="Block" data-toggle="modal" data-target="#accept">
                            <span class="glyphicon glyphicon-ban-circle"></span></button></p>
                                                    </a>
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" onclick="func(<?php echo $id;?>);"><span class="glyphicon glyphicon-envelope"></span></button>
                                                </td>

                                            </tr>

                                            <?php
                        }
                        }
                        echo "</table>";
                        ?>


                                                <?php
    if(isset($_GET['delete_user'])){
    $del_id=$_GET['delete_user'];

    $sql="DELETE FROM answers WHERE a_user_id='$del_id'";
    query($sql);

    $sql2="DELETE FROM questions WHERE q_user_id='$del_id'";
    query($sql);

    $sql3="DELETE FROM users WHERE user_id='$del_id'";
    query($sql3);

    header("location: view_all_users.php");
    
    set_message("<div class='alert alert-danger'>
    <strong>Danger!</strong> Delete successfull.</div>

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

$quer = "UPDATE users SET approve = 0 WHERE user_id = '$block_id'";
query($quer);
        
 
$quer1 = "UPDATE questions SET user_approve = 0 WHERE q_user_id = '$block_id'";
query($quer1);

$quer2 = "UPDATE answers SET user_approve = 0 WHERE a_user_id = '$block_id'";
query($quer2);   

$quer3 = "UPDATE discussion SET approve = 0 WHERE d_user_id = '$block_id'";
query($quer3);    

$online = "UPDATE users SET online = 0 WHERE user_id = '$block_id'";
query($online);  

    $sqlblock = "SELECT * FROM users WHERE user_id = '$block_id'";
    $resultblock = query($sqlblock);
    confirm($resultblock);
    $rowblock=fetch_array($resultblock);
    $useremail = $rowblock["email"];

if($useremail === $_SESSION['email']){
    unset($_SESSION['email']); 
    unset($_COOKIE['email']);
}
    header("location: view_approved_users.php");
   
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

            <?php validate_User_Individual_Mess(); ?>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                        </div>
                        <div class="modal-body">

                            <form method="POST">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Subject:</label>
                                    <input type="text" class="form-control" name="sub_name" id="recipient-name">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Message:</label>
                                    <textarea class="form-control" name="mess_name" id="message-text"></textarea>
                                </div>
                                <input type="hidden" name="query_id" value="" id="query_id_input">
                                <input type="hidden" name="user_id" value="" id="user_id_input">

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Send message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
<script type="text/javascript">

     function func(q)
    {
         document.getElementById('user_id_input').value=q;
    }
   
</script>




        </div>
    </div>




    <script type="text/javascript">
        function fun(p) {
            document.getElementById('q_id_input').value = p;
        }

    </script>



    <?php include "includes/admin_footer.php" ?>
