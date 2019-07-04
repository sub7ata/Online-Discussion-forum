<?php include("includes/header.php") ?>
<?php include("includes/nav.php") ?>
<?php

    if(logged_in()){
      
    } else {

      redirect("login.php");
    }

     ?> 
<?php display_message();  ?>
<?php validate_addAnswer(); ?>

<div class="container">
	<div class="row">
    <div class="col-md-12 cd">
        
<?php

$sql = "SELECT *
FROM 	subjects
JOIN	questions
ON	subjects.subject_id = questions.q_subject_id WHERE questions.a_s = 1 AND questions.a_q = 1 ORDER BY q_no DESC";
//            
// $sql ="SELECT * FROM subjects
//        JOIN questions
//        ON subjects.subject_id = questions.subject_id
//        JOIN answers
//        ON subjects.subject_id = answers.subject_id WHERE questions.q_no=answers.q_no AND questions.a_s = 1 AND answers.a_q = 1 AND answers.a_a = 1 ";           
   
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
  
<div class="col-md-8 col-md-offset-2">
<div class="text-center"  >
    <h2><a href="answer.php" style="font-size:30px;text-decoration: none;font-family:Times New Roman;" id="hov">Questions for you</a></h2> 
</div>
 

</div>
                  
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   <th>Q.No</th>
                   <th>Question</th>
                    <th>Subject</th>
                    <th>By</th>
                     <th>Date</th>
                     <th>Edit</th>
                     <th>Answered</th>
                     <!-- <th>Views</th> -->
                   </thead>


<?php
$i=1;
while($row =fetch_array($result))
{
  $date = $row["q_date_time"];
  $que_user_id = $row["q_user_id"];
  $dt = date("g:i a - d/m/Y", strtotime($date));
  $q_id=$row["q_no"];
  $s_id=$row["subject_id"]; 
?>

<tr class="<?php if(isset($classname)) echo $classname;?>">

<td>
  <?php echo $i;?>
</td>

<td>
<?php
  $sqlStatus = "SELECT q_no,a_no FROM answers WHERE q_no = $q_id AND a_s = 1 AND a_q = 1 AND a_a = 1 AND user_approve = 1 ";
  $resultStatus = query($sqlStatus);
  confirm($resultStatus);
  $q_count=0;
  while($rowStatus =fetch_array($resultStatus))
  {
    $a_id=$rowStatus["a_no"];
    $q_count++;
  }
?>
<?php 
if(row_count($resultStatus) > 0 ) {
?>
<a style="color: #1A0DB3;" href="trend_details.php?q_id=<?php echo $q_id;?>"><?php echo htmlspecialchars_decode($row["question"]); ?></a>
<?php 

}else{
  ?>
  <a style="color: #1A0DB3" onclick="funalerts(<?php echo $a_id;?>);" href="#"  ><?php echo htmlspecialchars_decode($row["question"]); ?></a>
  <?php
}

?>  

</td>

<td>
  <?php echo $row["sub_name"]; ?>
</td>

<td>

<?php 
 $sqlq = "SELECT first_name, last_name FROM users WHERE user_id ='$que_user_id'";
        $resultq = query($sqlq);
        confirm($resultq);
        $rowq=fetch_array($resultq);

        echo ucwords($rowq['first_name']);
        echo " ";
        echo ucwords($rowq['last_name']);


 ?>

 </td>

<td>
  <?php echo $dt; ?>
</td>
   
 <td>
  <p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" onclick="fun(<?php echo $q_id;?>);func(<?php echo $s_id;?>);" ><span class="glyphicon glyphicon-pencil"></span></button></p>
</td>

<td>
  <div class="text-center"><?php echo "$q_count"; ?></div>
</td>

<!--  <td>
<div id="CounterVisitor">        
</div>
 </td> -->

</tr>
<?php
$i++;
}
}
echo "</table>";
mysqli_close($con);
?> 
</table>
          
                
      
            </div>
            
        </div>
	</div>
</div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h5 class="modal-title custom_align text-center" id="Heading" style="color: royalblue">You are currently using O.D.F in English. Please write your answer in English. </h5>
            </div>

<div class="modal-body">
<form method="post" id="submit_form" action="" enctype="multipart/form-data">

              

                <div>
                     <div class="form-group">
<!--                        <textarea  name="answer" id="message" class="form-control" rows="9" cols="25" placeholder="Please enter your question.."required></textarea>-->
                        
                 <textarea name="answer" id="message" class="form-control" rows="15" cols="25" placeholder="Please enter your question..">
                     
                 </textarea>
                    </div>
                   
<!--                   -->
                    <div class="text-center">
                        <div class="form-group">
                                  
                           
                            <label class="col-md-4 control-label" for="filebutton">Image: </label>
                            <input name="image" class="input-file" id="filebutton" accept="image/png, image/jpeg, image/gif" type="file">
                        </div>
                        
                        

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Pdf: </label>
                            <input name="pdf" class="input-file" id="filebutton" accept="application/pdf,application/vnd.ms-excel" type="file">
                        </div>



                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Video: </label>
                            <input name="video" class="input-file" value=" 8000000" id="i_file" accept="video/mp4,video/x-m4v,video/*" type="file">
                        </div>



                    </div>
                    
<!--                    -->
                  

                    <div class="modal-footer ">
                        <button type="submit" onclick="form_submit()" name="submit" id="submit" class="btn btn-success btn-lg" style="width: 100%;"  value="submit"><span class="glyphicon glyphicon-ok-sign" ></span> Submit</button>
                    </div>
                     <input type="hidden" name="q_id" value="" id="q_id_input">
               <input type="hidden" name="s_id" value="" id="s_id_input">
                </div>
              </form>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div> <!-- /.modal-dialog -->

<script type="text/javascript">
      
        $('#submit').click( function() {
  //check whether browser fully supports all File API
  if (window.File && window.FileReader && window.FileList && window.Blob)
  {
    //get the file size and file type from file input field
    var fsize = $('#i_file')[0].files[0].size;
    var ftype = $('#i_file')[0].files[0].type;
    var fname = $('#i_file')[0].files[0].name;
    
    if(fsize>8000000) //do something if file size more than 1 mb (1048576)
    {
      alert("Type :"+ ftype +" | "+ fsize +" bites\n(File: "+fname+") Too big!");
    }else{
      alert("Type :"+ ftype +" | "+ fsize +" bites\n(File :"+fname+") You are good to go!");
    }
  }else{
    alert("Please upgrade your browser, because your current browser lacks some new features we need!");
  }
});
</script> 


    
<script type="text/javascript">

    function fun(p)
    {
        document.getElementById('q_id_input').value=p;
         
    }
    
     function func(q)
    {
         document.getElementById('s_id_input').value=q;
    }
   
</script>

<!-- <script type="text/javascript">
   var n = localStorage.getItem('on_load_counter');

    if (n === null) {
        n = 0;
    }

    n++;

    localStorage.setItem("on_load_counter", n);

    document.getElementById('CounterVisitor').innerHTML = n;

</script>

<script type="text/javascript">
$('#button-a').click(function(){
swal("Here's the title!", "...and here's the text!");
});
</script>
 -->
<script type="text/javascript">

    function funalerts(p)
    {
swal({
  title: "Oh, hi!",
  text: " Sorry, I didn't find answers.",
  // showConfirmButton: false,
  button: false,
  timer: 1500
  
})
         
    }
    
</script>




<?php include("includes/footer.php") ?>