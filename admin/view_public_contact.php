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
                   <div class="text-center">Public Message</div>
                    </h1>

                     <?php display_message(); ?>
                  
                    <div class="table-responsive">
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                                <th>SL.No</th>     
                                <th>Email</th>
                                <th>Mobile No</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Dalete</th>
                                <th>Send Message</th>
                            </thead>


<?php
$sql = "SELECT * FROM messages ORDER by message_id DESC";
$result=(query($sql));

if(mysqli_num_rows($result) <= 0)
{
    set_message("<div class='alert alert-info'>
    <strong>Info!</strong> Sorry! No results found.</div>

    <script type='text/javascript'>
    window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
         });
    }, 2000);
    </script>
    ");
  
} else {

$i=1;
while($row =fetch_array($result))
{
    $id=$row["message_id"];

    $date = $row["date_time"];
    $dt = date("g:i a - d/m/Y", strtotime($date));
?>
                            <tr class="<?php if(isset($classname)) echo $classname;?>">
                                <td>
                                    <?php echo $i;?>
                                </td>
                                <td>
                                    <?php echo $row["email"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["mobile_no"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["subject"]; ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars_decode($row["message"]); ?>
                                </td>
                                <td>
                                    <?php echo $dt; ?>
                                </td>
                                <td>
                                  <a href="view_public_contact.php?delete_mess=<?php echo $id ?>"
                                    onclick="return confirm('Are you sure ?')"><p data-placement="top" data-toggle="tooltip" title="delete"><button class="btn btn-danger btn-xs" data-title="delete" data-toggle="modal" type="delete" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button></p> </a>
                                </td>

                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit"><span class="glyphicon glyphicon-comment"></span></button></p>
                                    </td>

                            </tr>
                            <?php
                             $i++;
                            }
                        }
                        echo "</table>";
                        ?>


<?php 
    if(isset($_GET['delete_mess'])){ 
        $del_id=$_GET['delete_mess'];

    $sql="DELETE FROM messages WHERE message_id='$del_id'";
    query($sql);
    header("location: view_public_contact.php");
    
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


                    </table>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Edit your answer </h4>
            </div>

<div class="modal-body">
<form id="submit"   method="post" action="answer.php">

               <input type="hidden" name="q_id" value="" id="q_id_input">
                <div>
                    <div class="form-group">
                        <textarea rows="4" col="4" class="form-control" placeholder="Enter your answer" name="answer" required></textarea>
                    </div>

                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Submit</button>
                    </div>
                </div>
              </form>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div> <!-- /.modal-dialog -->    
</div>
</div>

<?php include "includes/admin_footer.php" ?>