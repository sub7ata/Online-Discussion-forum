<?php include("includes/header.php") ?>
<?php include("includes/nav.php") ?>
<?php

    if(logged_in()){
      
    } else {

      redirect("login.php");
    }

     ?>
<div class="cotainer">        
                                   
                                   
                                    <!--   Questions-->
                                    
<div class="text-center">
    <h1>
    <div class="col-md-8 col-md-offset-2" style="color:#02195a;">
        <!-- <div class="well" style="background-color: White;"> -->
            <div class="panel panel-primary" >
    <div class="panel-body ">
       Questions
        </div>
    </div>
    </div>
    </h1>
</div>
  <div class="col-md-8 col-md-offset-2">
 <?php
          $sqlUser ="SELECT * FROM users WHERE email='$_SESSION[email]'";
          $resultUser = query($sqlUser);
          confirm($resultUser);
          $rowUser=fetch_array($resultUser); 
          $user_id=$rowUser['user_id'];
         ?>
         
<?php
    $sql = "SELECT * FROM subjects
    JOIN questions
    ON subjects.subject_id = questions.q_subject_id
    JOIN answers
    ON subjects.subject_id = answers.a_subject_id WHERE questions.q_no=answers.q_no AND questions.a_s = 1 AND answers.a_q = 1 AND answers.a_a = 1 AND answers.user_approve = 1 AND questions.q_user_id = '$user_id'";
    
//$sql = "SELECT * FROM answers WHERE a_user_id = '$user_id' ORDER BY a_no DESC";
    $result=(query($sql));
    if(row_count($result)<=0)
    {
?>

    <div class="well" style="background-color:white;">
        <div class='alert alert-danger text-center'><strong>Question Not Found</strong> <br> We're sorry, trying to added this subjects questions.</div>
    </div>

<?php
    } else {
    $i=1;
    while($row =fetch_array($result))
    {
    $subject=$row["sub_name"];
    $a_id  = $row["a_no"];
    $ques  = htmlspecialchars_decode($row["question"]);
    $a_id  = $row["a_no"];
    $email = $row["q_email"];
    $dateTime = $row["q_date_time"];
    $newDate = date('j-F-Y \a\t g:i a', strtotime($dateTime));
    $userID = $row["q_user_id"];
    $q_id=$row["q_no"];
?>

    <!-- <div class="well" style="background-color:white;"> -->
<div class="panel panel-primary" >
    <div class="panel-body ">
<?php if(!logged_in()): ?>
    <span class="pull-right"><a href="login.php" style="margin-bottom: 0px;" class="">Login </a>to read more.</span>
<?php endif; ?>

        <hr>
        <h4 style="color:#17178D; font-family: Times New Roman;">
        Q. No: <?php echo" {$i}";?></h4>
        <a href="trend_details.php?q_id=<?php echo $q_id;?>"> <h4 style="color:#1A0DB3; font-family: Times New Roman;">

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
            <a href="#" style="text-decoration:none;">

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
                <b> Answer: </b>
            </div>
            <div class="text-justify" style="color:black;">
                <p>

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
$i++;
}
}

?>
</div>


     <!--#############################  Answers  ###############################-->




<div class="text-center">
    <h1>
    <div class="col-md-8 col-md-offset-2" style="color:#02195a;">
 <div class="panel panel-primary" >
    <div class="panel-body ">
        Answers
        </div>
    </div>
    </div>
    </h1>
</div>
<div class="col-md-8 col-md-offset-2">
 <?php
          $sqlUser ="SELECT * FROM users WHERE email='$_SESSION[email]'";
          $resultUser = query($sqlUser);
          confirm($resultUser);
          $rowUser=fetch_array($resultUser); 
          $user_id=$rowUser['user_id'];
         ?>
         
<?php
    $sql = "SELECT * FROM subjects
    JOIN questions
    ON subjects.subject_id = questions.q_subject_id
    JOIN answers
    ON subjects.subject_id = answers.a_subject_id WHERE questions.q_no=answers.q_no AND questions.a_s = 1 AND answers.a_q = 1 AND answers.a_a = 1 AND answers.user_approve = 1 AND answers.a_user_id = '$user_id'";
    
//$sql = "SELECT * FROM answers WHERE a_user_id = '$user_id' ORDER BY a_no DESC";
    $result=(query($sql));
    if(row_count($result)<=0)
    {
?>

    <!-- <div class="well" style="background-color:white;"> -->
        <div class="panel panel-primary" >
    <div class="panel-body ">
        <div class='alert alert-danger text-center'><strong>Question Not Found</strong> We're sorry, trying to added this subject's questions.</div>
    </div>
</div>
</div>

<?php
    } else {
    $i=1;
    while($row =fetch_array($result))
    {
    $subject=$row["sub_name"];
    $a_id  = $row["a_no"];
    $ques  = htmlspecialchars_decode($row["question"]);
    $a_id  = $row["a_no"];
    $email = $row["q_email"];
    $dateTime = $row["q_date_time"];
    $newDate = date('j-F-Y \a\t g:i a', strtotime($dateTime));
    $userID = $row["q_user_id"];
    $q_id=$row["q_no"];
?>

    <!-- <div class="well" style="background-color:white;"> -->
        <div class="panel panel-primary" >
    <div class="panel-body ">

<?php if(!logged_in()): ?>
    <span class="pull-right"><a href="login.php" style="margin-bottom: 0px;" class="">Login </a>to read more.</span>
<?php endif; ?>

        <hr>
        <h4 style="color:#17178D; font-family: Times New Roman;">
        Q. No: <?php echo" {$i}";?></h4>
        <a href="trend_details.php?q_id=<?php echo $q_id;?>"> <h4 style="color:#1A0DB3; font-family: Times New Roman;">

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
            <a href="#" style="text-decoration:none;">

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
$i++;
}
}

?>
</div>


<?php include("includes/footer.php")?>