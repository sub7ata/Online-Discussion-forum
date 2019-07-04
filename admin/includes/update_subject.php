    <form action="" method="post">
      <div class="form-group">


                        <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <div class="well">
                    <div class="text-center">
         <h3 for="cat-title">Edit Subject</h3>
       </div>

         
         
<?php

if(isset($_GET['edit_sub'])){
$sub_id = $_GET['edit_sub'];

        
$sql = "SELECT * FROM subjects WHERE subject_id = $sub_id ";
$result=(query($sql));
while($row =fetch_array($result)) {
  $sub_id = $row['subject_id'];
  $sub_name = $row['sub_name'];
  $sub_code = $row['sub_code'];
                
  ?>
  <div class="form-group">
 <label for="name">Subject Code</label>
 <input value="<?php echo $sub_code; ?>" type="text" class="form-control" name="sub_code">
</div>
<div class="form-group">
<label for="name">Subject Name</label>
 <input value="<?php echo $sub_name; ?>" type="text" class="form-control" name="sub_name">
</div>
<?php 
 }
}
?>
      

     <?php   

        /////////// UPDATE QUERY

            if(isset($_POST['update_subject'])) {

                $sub_code = escape($_POST['sub_code']);
                $sub_name = escape($_POST['sub_name']);

                $stmt = mysqli_prepare($con, "UPDATE subjects SET sub_code = '$sub_code',sub_name ='$sub_name' WHERE subject_id = $sub_id ");

                 mysqli_stmt_bind_param($stmt, 'si', $sub_code, $sub_name);

                 mysqli_stmt_execute($stmt);


                         if(!$stmt){
                      
                          die("QUERY FAILED" . mysqli_error($con));
                      
                      }

                      mysqli_stmt_close($stmt);


                     redirect("view_pending_subjects.php");
                    set_message("<div class='alert alert-success text-center'><strong>Update successfull !</strong></div>");
         }

    ?>


        <div class="form-group text-center">
          <input class="btn btn-success form-control" type="submit" name="update_subject" value="Update Category">
      </div>
      </div>
      </div>
    </div>
  </div>
</form>