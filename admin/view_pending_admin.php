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
                     Pending admins
                   </div>
                 </h1>

<?php display_message(); ?>
<?php
$sql ="SELECT * FROM admin WHERE  approve= 0 ";
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
                                <th>Email</th>
                                <th>Name</th>
                                <th>Invitation Code</th>
                                <th>Date</th>
                                <th>Delete</th>
                                <th>Approve</th>
                            </thead>

<?php
while($row =fetch_array($result))
{
$id=$row["admin_id"];
$date = $row["admin_date_time"];
$dt = date("g:i a - d/m/Y", strtotime($date));
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

                                <td>
                                    <a href="view_pending_admin.php?delete=<?php echo $id?>"
                                    onclick="return confirm('Are you sure ?')"> <p data-placement="top" data-toggle="tooltip" title="delete"><button class="btn btn-danger btn-xs" data-title="delete" data-toggle="modal" type="delete" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button></p></a>
                                </td>

                                 <td>
                            <a href="view_pending_admin.php?accept=<?php echo $id?>"onclick="return confirm('Are you sure ?')">
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
    $sql="DELETE FROM admin WHERE admin_id='$delete_id'";
    query($sql);
    header("location: view_all_admins.php");

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
    if(isset($_GET['accept'])){
    $accept_id=$_GET['accept'];

$quer = "UPDATE admin SET approve = 1 WHERE admin_id = '$accept_id'";
query($quer);

    header("location: view_pending_admin.php");

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
<?php include "includes/admin_footer.php" ?>
