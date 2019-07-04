<?php include("includes/header.php") ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<?php

    if(logged_in()){

    } else {

        redirect("login.php");
    }

?>

<?php include("includes/nav.php") ?>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="col-sm-12">
                <div class="panel panel-white post panel-shadow">


<form action="" method="POST">

<?php
if(isset($_GET['edit'])){
$q = intval($_GET['edit']);

$sqlEdit = "SELECT * FROM discussion WHERE discussion_id = '".$q."' ";
$resultEdit = query($sqlEdit);
confirm($resultEdit);
$rowEdit = fetch_array($resultEdit);
$old_comments=$rowEdit['communication'];
}
?>

 <div class="form-group">
            <label for="message-text" class="col-form-label">Write Message:</label>
            <textarea cols=40  rows=3 name="comment"><?php echo "$old_comments"; ?></textarea>
          </div>



     <?php

        /////////// UPDATE QUERY

            if(isset($_POST['update_discussion'])) {

                $comment = escape($_POST['comment']);

        $stmt = mysqli_prepare($con, "UPDATE discussion SET communication = '$comment' WHERE discussion_id = $d_id ");

                 mysqli_stmt_bind_param($stmt, 'si', $comment);

                 mysqli_stmt_execute($stmt);


                         if(!$stmt){

                          die("QUERY FAILED" . mysqli_error($con));

                      }

                      mysqli_stmt_close($stmt);


                      // redirect("index.php");

                     header("location: details.php?a_id=$a_id");

                    set_message("<div class='alert alert-info'>
                    <strong>Update!</strong> successfull !</div>

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


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary" name="update_discussion">Submit</button>


      </div>
     </form>
     
<?php include "includes/footer.php" ?>
