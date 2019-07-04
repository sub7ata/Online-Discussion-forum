<?php include("includes/header.php") ?>
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

                        <!-- Start of modal  -->

                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- <h5 class="modal-title" id="exampleModalLabel">New message</h5> -->


                                <h5 class="modal-title custom_align text-center" id="Heading" style="color: #02225a;">You are currently using O.D.F in English. Please write your answer in English. </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">

                                    <?php
if(isset($_GET['edit']) && isset($_GET['a_id'])){
$d_id = intval($_GET['edit']);
$a_id = intval($_GET['a_id']);
$sqlEdit = "SELECT * FROM discussion WHERE discussion_id = $d_id ";
$resultEdit = query($sqlEdit);
confirm($resultEdit);
$rowEdit = fetch_array($resultEdit);
$old_comments=$rowEdit['communication'];
}
?>

                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Write Message:</label>
                                            <textarea cols=40 rows=3 name="comment"><?php echo "$old_comments"; ?></textarea>
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

<div class="modal-footer">
                                              
<a href="details.php?a_id=<?php echo $a_id; ?>" class="btn btn-primary btn-circle pull-left" role="button" ><i class="fa fa-arrow-left" aria-hidden="true"> Back </i></a>

<button type="submit" class="btn btn-primary btn-circle" name="update_discussion">Submit</button>

</div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "includes/footer.php" ?>