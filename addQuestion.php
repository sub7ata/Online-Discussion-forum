<?php include("includes/header.php") ?>
<?php

  	if(logged_in()){

  	} else {

  		redirect("login.php");
  	}

  	 ?>


<?php include("includes/nav.php") ?>


<div class="container-fluid">
   <div class="col-md-8 col-md-offset-2">
   <?php display_message(); ?>
    <?php validate_addQuestion(); ?>
    </div>

<?php
$sql = "SELECT * FROM subjects WHERE a_s = 1 ORDER by sub_name ASC";
$result=(query($sql));
$i=1;
?>


    <div class="row">
        <div class="col-md-8 col-md-offset-2">

           <h1>Add Question</h1>
           <div class="panel panel-white post panel-shadow">
            <!-- <div class="well well-sm" style="background-color:white;"> -->
              <div class="post-description">
                <form method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <div class="input-group">
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-list"></span>
                                    </span>
                                <select id="subject" name="subject_id" class="form-control">
                                <option value="0" selected="">-----------Select Subject:------------</option>


                                 <?php
 while($row = mysqli_fetch_array($result))
 {
 	 $subject_id=$row["subject_id"];
 ?>

											<li><option  value=" <?php echo $row["subject_id"] ?>"> <?php echo $row["sub_name"]; ?></option></li>
<?php
 $i++;
   }
   echo "</table>";
   mysqli_close($con);
 ?>

                            </select>
                            </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Question</label>
                                <textarea name="question" id="message" class="form-control" rows="9" cols="25" placeholder="Please enter your question.."></textarea>
                                 <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>
                                  <button type="submit" name="submit" id="submit" class="btn btn-success pull-right" value="Go!">
                            Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php") ?>
