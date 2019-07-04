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
            
                <?php display_message();  ?>
                <?php validate_addComment(); ?>

 
            <?php
if(isset($_GET['q_id'])){ 
$q_id = $_GET['q_id'];
        
 $sql ="SELECT * FROM subjects
            JOIN questions
            ON subjects.subject_id = questions.q_subject_id
            JOIN answers
            ON subjects.subject_id = answers.a_subject_id WHERE questions.q_no=answers.q_no AND questions.a_s = 1 AND answers.a_q = 1 AND answers.a_a = 1 AND answers.user_approve = 1 AND questions.user_approve = 1 AND answers.q_no = $q_id";
          
            $result=(query($sql));
            $count=1;
            while($row =fetch_array($result))
            {
            $ques  = htmlspecialchars_decode($row["question"]);
            $a_id  = $row["a_no"];
            $email = $row["q_email"];
            $dateTime = $row["q_date_time"];
            $newDate = date('j-F-Y \a\t g:i a', strtotime($dateTime));
            $userID = $row["q_user_id"];
            ?>
            <div class="col-sm-12">
                <div class="panel panel-white post panel-shadow">
                    <div class="post-heading" style="margin-bottom:0px;">
                        <h4 style="color:black; font-family: Times New Roman;">

                        <?php if(!logged_in()): ?>
<span class="pull-right"><a href="login.php" style="margin-bottom: 0px;" class="">Login </a>to read more.</span>
                        <?php endif; ?>

                        <hr>
                        <div style="color:black; font-size: 20px;">
                            <p ><?php echo "{$ques}"?>  </p>
                        </div>
                        <p><b>Subject: </b>
                            <?php echo $row["sub_name"]; ?>
                        </p>
                        </h4>

                     
                        <div class="pull-left image">
                            <?php
                            $s ="SELECT * FROM users WHERE email = '$email'";
                            $res = query($s);
                            confirm($res);
                            $r=fetch_array($res);
                            ?>
                            <?php echo "<a href='Profile_picture/$r[profile_pic]' target='_blank'><img src='Profile_picture/".$r["profile_pic"]."' id='userpic' class='img-circle' style=' width: 60px; height: 60px; margin: 6px;'  /></a>";?>
                        </div>
                         <div >   <!--  style="margin-top: 22px;"--> 
                            <p>
                                by
                                <a href="onclick_user_view.php?user_id=<?php echo $userID; ?>" style="text-decoration:none;">
                                    <b>
                                    <?php
                                    $sqlUserName = "SELECT * FROM users WHERE user_id = '$userID'";
                                    $resultUserName = query($sqlUserName);
                                    confirm($resultUserName);
                                    $rowUserName=fetch_array($resultUserName);
                                    
                                    echo ucwords($rowUserName['first_name']);
                                    echo " ";
                                    echo ucwords($rowUserName['last_name']);
                                    ?>
                                    </b>
                                </a>
                            </p>
                       
                        <h6 class="text-muted time">
                        <p><span class="glyphicon glyphicon-time"></span> Posted on
                        <?php echo $newDate; ?>
                    </p>
                    </h6>
                </div>
                </div>

                <div class="post-description" style="margin-top:0px;">
                  
                <b>Answer: </b>
               
                    <div class="text-justify" style="color:black;"> 

                <p><?php echo substr(htmlspecialchars_decode($row['answer']),0,100); ?></p>
                
                                <a class="btn btn-primary" href="details.php?a_id=<?php echo $a_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    </div>
                   
                </div>

            </div>
        </div>
        <?php
        $count++;
        }
    }
        ?>
  



</div>
</div>


</div>
</div>

<?php include "includes/footer.php" ?>
