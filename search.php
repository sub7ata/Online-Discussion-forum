<?php include("includes/header.php") ?>
<?php include("includes/nav.php") ?>

<div class="col-md-8 col-md-offset-2">
    <div class="well" style="background-color: White;">
        <form action="" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control"  placeholder="Search...">
                <span class="input-group-btn">
                    <button name="submit"class="btn btn-default btn-larg" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>


<?php    
      if(isset($_POST['submit'])){
            $search=$_POST['search'];
          if(!empty($search)){
           // $query="SELECT * FROM questions WHERE question LIKE '%$search%' ";
           // $search_query=mysqli_query($connection,$query);// false
//            $query = "SELECT *
//            FROM 	subject
//            JOIN	questions
//            ON	subject.subject_id = questions.subject_id
//            WHERE	questions.question LIKE '%$search%' AND questions.approve = 1; ";   
              
              
 // $query ="SELECT * FROM subjects 
 //        JOIN questions
 //        ON subjects.subject_id = questions.q_subject_id
 //        JOIN answers
 //        ON subjects.subject_id = answers.a_subject_id WHERE questions.q_no=answers.q_no AND questions.a_s = 1 AND answers.a_q = 1 AND answers.a_a = 1 AND questions.question LIKE '%$search%' ";


$query = "SELECT * FROM subjects
        JOIN questions
        ON subjects.subject_id = questions.q_subject_id
        JOIN answers
        ON subjects.subject_id = answers.a_subject_id WHERE questions.q_no=answers.q_no AND questions.a_s = 1 AND answers.a_q = 1 AND answers.a_a = 1 AND answers.user_approve = 1 AND questions.question LIKE '%$search%' ";  
              
              
            $search=query($query);
            if(!$search){
                die("QUERY FAILED".mysqil_error($connection));
            }
                $count=mysqli_num_rows($search);
                if($count==0){
?>
                                    <div class="col-md-8 col-md-offset-2">
                                        <div id="text-font">
                                            <div class="well" style="background-color: white;">
                                                 <div class='alert alert-danger text-center'><strong>Question Not Found</strong> <br> We're sorry, we couldn't find the <br>question you requested.</div>
                                                 <div class="text-center">
                                               <a class="btn btn-primary" href="search.php" role="button">OK</a>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                    <?php
                }else{
                    $i=1;
                    while($row =fetch_array($search)){
                         $subject=$row["sub_name"];
    $a_id  = $row["a_no"];
    $ques  = htmlspecialchars_decode($row["question"]);
    $q_id  = $row["q_no"];
    $email = $row["q_email"];
    $dateTime = $row["q_date_time"];
    $newDate = date('j-F-Y \a\t g:i a', strtotime($dateTime));
    $userID = $row["q_user_id"];
                    ?>
 <div class="col-md-8 col-md-offset-2">
 <div class="well" style="background-color:white;">

<?php if(!logged_in()): ?>
    <span class="pull-right"><a href="login.php" style="margin-bottom: 0px;" class="">Login </a>to read more.</span>
<?php endif; ?>

        <hr>
        <h4 style="color:#17178D; font-family: Times New Roman;">
        Q. No: <?php echo" {$i}";?></h4>
        <a href="trend_details.php?q_id=<?php echo $q_id;?>"> <h4 style="color:#0EB1E2; font-family: Times New Roman;">

<?php echo htmlspecialchars_decode($row["question"]);?>

        </h4></a>
        <p><b>Subject:</b>

<?php echo "{$subject}"; ?>
<?php
$s ="SELECT * FROM users WHERE email = '$email'";
$res = query($s);
confirm($res);
$r=fetch_array($res);
?>
            
        </p>
        
        <span class="chat-img1 pull-left">

<?php echo "<a href='Profile_picture/$r[profile_pic]' target='_blank'><img src='Profile_picture/".$r["profile_pic"]."' alt=' ' id='userpic' class='img-circle' style=' width: 45px; height: 45px; margin: 6px;'  /></a>";?>

        </span>
        <div style="margin-top: 22px;">
            by
            <a href="onclick_user_view.php?user_id=<?php  echo $userID; ?>" style="text-decoration:none;">

<?php
    $sqlUserName = "SELECT * FROM users WHERE user_id = '$userID'";
    $resultUserName = query($sqlUserName);
    confirm($resultUserName);
    $rowUserName=fetch_array($resultUserName);
                
    echo ucwords($rowUserName['first_name']);
    echo " ";
    echo ucwords($rowUserName['last_name']);
?>

            </a>
            <small><p><span class="glyphicon glyphicon-time"></span>
            Posted on <?php echo $newDate; ?>
        </p>
        </small>
    </div>
    <div style="margin-top: 22px;">
        <section>
            <div class="pull-left">
                <b >Answer: </b>
            </div>
            <div class="text-justify" style="color:black;">
                <p >

<?php echo substr(htmlspecialchars_decode($row['answer']),0,100); ?>

                </p>
                <a class="btn btn-primary" href="details.php?a_id=<?php echo $a_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </section>
    </div>
    <hr>
</div>
</div>

<?php
                        
$i++;                   }
    }
}
      }
mysqli_close($con);
?>

           
           
           
<script type="text/javascript">
	function refreshPage(){
		if(confirm("Are you sure, want to refresh?")){
			location.reload();
		}				
	}
</script>




<?php include("includes/footer.php") ?>