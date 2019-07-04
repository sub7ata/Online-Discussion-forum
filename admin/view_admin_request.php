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
                     Admins Request
                   </div>
                 </h1>

                  <?php display_message(); ?>

<?php
    $sql = "SELECT * FROM admin_request WHERE invitation_code = 1";

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
                                <th>Qualification</th>
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
                                $a_m = $row["admin_email"];
                            ?>
                            <tr class="<?php if(isset($classname)) echo $classname;?>">
                                <td>
                                    <?php echo $row["admin_id"];?>
                                </td>
                                <td>
                                    <?php echo $row["admin_email"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["first_name"]; ?>
                                     <?php echo $row["last_name"]; ?>
                                </td>
                                 <td>
                                    <?php echo $row["education"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["invitation_code"]; ?>
                                </td>
                                <td>
                                    <?php echo $dt; ?>
                                </td>

                                <td>
                                    <a href="view_admin_request.php?delete=<?php echo $id?>"
                                    onclick="return confirm('Are you sure ?')"> <p data-placement="top" data-toggle="tooltip" title="delete"><button class="btn btn-danger btn-xs" data-title="delete" data-toggle="modal" type="delete" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button></p></a>
                                </td>

                        <td>
                            <a href="view_admin_request.php?accept=<?php echo $id?>"onclick="return confirm('Are you sure ?')">
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
    $sql="DELETE FROM admin_request WHERE admin_id='$delete_id'";
    query($sql);
    header("location: view_admin_request.php");

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

// Fetch data
$sql = "SELECT * FROM admin_request  WHERE admin_id = '$accept_id'";
$result = query($sql);
confirm($result);
$row=fetch_array($result);

$post_email             =$row['admin_email'];
$post_first_name        =$row['first_name'];
$post_last_name         =$row['last_name'];
$post_education         =$row['education'];
$post_password          =$row['password'];
$post_invitation_code   =$row['invitation_code'];
$post_validation_code   =$row['validation_code'];

// Insert data
 date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');

$sqlQuery = "INSERT INTO admin(admin_email,first_name,last_name,education,password,invitation_code,admin_date_time,validation_code,active,approve)";

$sqlQuery.="VALUES('$post_email','$post_first_name','$post_last_name','$post_education','$post_password','$post_invitation_code','$date','$post_validation_code',0,1)";
    $resultQuery=query($sqlQuery);
    confirm($resultQuery);

// Delete old data
$sqlDelete="DELETE FROM admin_request WHERE admin_id = '$accept_id'";
query($sqlDelete);

// Send mail

require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'subratadasbca@gmail.com';                 // SMTP username
$mail->Password = 'niy@tik@lip@d@';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to


$mail->setFrom('subratadasbca@gmail.com', 'Online Discussion Forum');
$mail->addAddress($post_email);  
$mail->addReplyTo('no-reply@gmail.com', 'Np-reply');

$mail->isHTML(true);                                  // Set email format to HTML


$mail->Subject = 'Activate Account';
$mail->Body    = "<h1>Welcome to Online Disscussion Forum</h1><br>Hi<br>Mr./Mrs. {$post_first_name} $post_last_name  
<br>Please click <a href='localhost/ODF/admin/activate.php?admin_email=$post_email&code=$post_validation_code'>this link </a>to activate your Account";
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}




    header("location: view_admin_request.php");

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
