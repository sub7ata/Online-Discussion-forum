<?php include "includes/admin_header.php" ?>

<?php

    if(admin_logged_in()){

    } else {

    redirect("admin_login.php");

    }

?>
<div id="wrapper">
 <?php include "includes/admin_navigation.php" ?>

    <?php
    $sql = "SELECT * FROM admin WHERE approve = 1";
    $result=(query($sql));
    if(row_count($result)>0)
    {
    ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">

                   <div class="text-center">
                     Available admins
                   </div>
                 </h1>

                  <?php display_message(); ?>

                    <div class="table-responsive">
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                                <th>SL.No</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Invitation Code</th>
                                <th>Date</th>
                                <th>Delete</th>
                                <th>Block</th>
                                <th>Send Message</th>
                            </thead>
                            <?php
                            while($row =fetch_array($result))
                            {
                                $id=$row["admin_id"];
                                $date = $row["admin_date_time"];
                                $dt = date("g:i a - d/m/Y", strtotime($date));
                                $a_m = $row["admin_email"];
                            ?>
                            <tr class="<?php if(isset($classname)) echo $classname;?>">
                                <td>
                                    <?php echo$row["admin_id"];?>
                                </td>
                                <td>
                                    <?php echo $row["admin_email"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["first_name"]; ?>
                                     <?php echo $row["last_name"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["invitation_code"]; ?>
                                </td>
                                <td>
                                    <?php echo $dt; ?>
                                </td>
<?php
$admin_email = $_SESSION['admin_email'];
if( $admin_email !== $a_m){
?>
                                <td>
                                    <a href="view_approved_admin.php?delete=<?php echo $id?>"
                                    onclick="return confirm('Are you sure ?')"> <p data-placement="top" data-toggle="tooltip" title="delete"><button class="btn btn-danger btn-xs" data-title="delete" data-toggle="modal" type="delete" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button></p></a>
                                </td>

                                <td>
                        <a href="view_approved_admin.php?block=<?php echo $id?>"onclick="return confirm('Are you sure ?')">
                        <p data-placement="top" data-toggle="tooltip" title="Block">
                          <button class="btn btn-warning btn-xs" data-title="Block" data-toggle="modal" data-target="#accept">
                            <span class="glyphicon glyphicon-ban-circle"></span></button></p></a>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><span class="glyphicon glyphicon-envelope"></span></button>
                                </td>
<?php }?>
                            </tr>

<?php
  }
}
echo "</table>";
?>


<?php
    if(isset($_GET['delete'])){
        $delete_id=$_GET['delete'];
    $sql="DELETE FROM admin WHERE admin_id='$delete_id'";
    query($sql);
    header("location: view_approved_admin.php");

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

    $quer = "UPDATE admin SET approve = 0 WHERE admin_id = '$block_id'";
    query($quer);         
        
    header("location: view_approved_admin.php");
   
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

    <!-- send message -->

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
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>

</div>
<?php include "includes/admin_footer.php" ?>
