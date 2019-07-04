
<!-- Start of modal  -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
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
         
    <input type="  " name="dis_id" value=" " id="d_id_input"> 

         
<?php

 if(isset($_GET['submit'])){
//  $dis_id = $_GET['dis_id'];
    // if(isset($_REQUEST['dis_id']))    
    // $dis_id = escape($_POST['dis_id']);
// if($_SERVER['REQUEST_METHOD']=="POST"){
 $q_id       =clean($_POST['dis_id']);

$sql = "SELECT * FROM discussion WHERE discussion_id = '$dis_id' ";
$result=(query($sql));
while($row =fetch_array($result)) {
  $com = $row['communication'];
  // echo "$com";
  
                
  ?>

 <div class="form-group">
            <label for="message-text" class="col-form-label">Write Message:</label>
            <textarea cols=40  rows=3 name="comment"><?php echo $com; ?></textarea> 
          </div>

<?php 
}
}
?>
      

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


                     redirect("index.php");
                    // set_message("<div class='alert alert-success text-center'><strong>Update successfull !</strong></div>");
                    set_message("<div class='alert alert-info'>
                    <strong>Info!</strong> Update successfull !</div>

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
    </div>
  </div>
 </div> <!--End of modal  -->