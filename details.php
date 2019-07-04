<?php include("includes/header.php") ?>
<?php

    if(logged_in()){

    } else {

        redirect("login.php");
    }

?>

<?php include("includes/nav.php") ?>



<?php 
if (isset($_SESSION['email'])) {
$sql = "SELECT * FROM users WHERE email ='$_SESSION[email]'";
$result = query($sql);
confirm($result);
$row=fetch_array($result);
$user_ID = $row['user_id'];
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="col-sm-12">
                <div class="panel panel-white post panel-shadow">
                <?php display_message();  ?>
                <?php validate_addComment(); ?>


<?php
if(isset($_GET['a_id'])){
$a_id = $_GET['a_id'];

$sql ="SELECT * FROM subjects 
        JOIN questions
        ON subjects.subject_id = questions.q_subject_id
        JOIN answers
        ON subjects.subject_id = answers.a_subject_id
        WHERE questions.q_no=answers.q_no
        AND questions.a_s = 1 AND answers.a_q = 1 AND answers.a_a = 1 AND answers.a_no = $a_id ";
        $result = query($sql);
        confirm($result);
        $row=fetch_array($result);
        $ques=htmlspecialchars_decode($row["question"]);
        $img=$row["image"];
        $post_video = $row["video"];
        $post_pdf = $row["pdf"];
        $a_user_id= $row["a_user_id"];
        $q_user_id= $row["q_user_id"];
        $q_email = $row["q_email"];

        $a_id = $row["a_no"];
        $q_id = $row["q_no"];

        $dateTime = $row["q_date_time"];
        $questionsDate = date('j-F-Y \a\t g:i a', strtotime($dateTime));

        $date_Time = $row["a_date_time"];
        $answersDate = date('j-F-Y \a\t g:i a', strtotime($date_Time));

?>

<!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->
<!--############################ Query of Views Count ############################ -->
<!-- ***************************************************************************** -->
<?php
          
  if(isset($_GET['a_id'])){
    $a_id = $_GET['a_id'];

$qryView="SELECT * FROM answer_view_count WHERE answer_ID = $a_id AND user_ID = $user_ID";

$result = query($qryView);

if(row_count($result) == 1) {

}else{

$sqlView = "INSERT INTO answer_view_count(view, answer_ID, user_ID)";
$sqlView.= "VALUES( 1,'$a_id','$user_ID')";

    $result1View=query($sqlView);
    confirm($result1View);
    }
}     
?>





                    <div class="post-heading">
                        <h4 style="color:black; font-family: Times New Roman;">
                            <hr>
                            <div style="color:black; font-size: 20px;">
                                <p>
                                    <?php echo "{$ques}"?>
                                </p>
                            </div>

                            <p><b>Subject: </b>

                                <?php echo $row["sub_name"]; ?>

                        </h4>

                        <div class="pull-left image">


<?php
    $s ="SELECT * FROM users WHERE email = '$q_email'";
    $res = query($s);
    confirm($res);
    $r=fetch_array($res);

    $firstName = ucwords($r["first_name"]);
    $lastName = ucwords($r["last_name"]);
?>

<?php echo "<a href='Profile_picture/$r[profile_pic]' target='_blank'><img src='Profile_picture/".$r["profile_pic"]."' id='userpic' class='img-circle' style=' width: 60px; height: 60px; margin: 6px;'  /></a>";?>

                        </div>

                        <div class="pull-left meta">
                            <div style="margin-top: 12px;">

 by<a href="onclick_user_view.php?user_id=<?php echo $q_user_id; ?>" style="text-decoration:none;">
        <b >
    <?php
    echo "{$firstName}";
    echo " ";
    echo "{$lastName}";
    ?>

        </b>
    </a>

                            </div>
                            <h6 class="text-muted time">
                                <p><span class="glyphicon glyphicon-time"></span> Posted on

                                    <?php echo $questionsDate; ?>

                                </p>
                            </h6>
                        </div>
                    </div>
                    <div class="post-description">

                        <section>
                            <br>
                            <div class="pull-left">
                                <!-- <b>Answer: </b> -->
                            </div>
                            <div class="text-justify" style="color:black;">
                                <p>

                                   <hr>

                                   <div class="pull-left image">

<?php
    $sql_ans ="SELECT * FROM users WHERE user_id = '$a_user_id'";
    $res_ans = query($sql_ans);
    confirm($res_ans);
    $row_ans=fetch_array($res_ans);
?>

    <?php echo "<a href='Profile_picture/$row_ans[profile_pic]' target='_blank'><img src='Profile_picture/".$row_ans["profile_pic"]."' id='userpic' class='img-circle' style=' width: 60px; height: 60px; margin: 6px;'  /></a>";?>


                                   </div>

                                   <div class="pull-left meta">
                                       <div >
                                            <a href="onclick_user_view.php?user_id=<?php echo $a_user_id; ?>" style="text-decoration:none;">
                                                <b>

<?php
    $sq = "SELECT * FROM users WHERE user_id = $a_user_id";
    $res = query($sq);
    confirm($res);
    $roww = fetch_array($res);
    $firstName = ucwords($roww["first_name"]);
    $lastName = ucwords($roww["last_name"]);
    echo "{$firstName}";
    echo " ";
    echo "{$lastName}";
?>

                                                </b>
                                            </a>
                                        </div>
                                       <h6 class="text-muted time">

            <p><span class="glyphicon glyphicon-time" ></span>  Answered: <?php echo $answersDate; ?></p>

                                       </h6>
                                   </div>
                                   <div class="post-description" style="margin-top: 100px;">
                                    <?php echo htmlspecialchars_decode($row['answer']); ?>
                                    </div>
                            </div>
                        </section>
                        <div>
<div class="embed-responsive embed-responsive-16by9" id='image' style="margin-bottom: 40px;">
<?php echo "<a href='images/$row[image]' target='_blank' id='image' ><img src='images/".$row["image"]."' class='img-responsive' alt=''  height='355'/></a>";?>
</div>
<script type="text/javascript">
    var x='<?php echo $row["image"];?>';
    var v=document.getElementById("image");
        if(x.length>0)
        {
            v.style.display="block";
        }
        else
        {
            v.style.display="none";
        }
</script>
<div class="embed-responsive embed-responsive-16by9" id='pdf' style="margin-bottom: 40px;">
<?php echo "<a href='pdf/$row[pdf]' target='_blank' id='pdf'>
        <embed src='pdf/".$row["pdf"]."' id='pdf' alt=''  height='355'  /> </a>";?>
</div>
<script type="text/javascript">
    var x='<?php echo $post_pdf;?>';
    var v=document.getElementById("pdf");
        if(x.length>0)
        {
            v.style.display="block";
        }
        else
        {
            v.style.display="none";
        }
</script>
<div class="embed-responsive embed-responsive-16by9" id='vd' style="margin-bottom: 40px;">
<?php echo "<a href='videos/$row[video]' target='_blank' id='vd'>   <video id='vd' controls>
  <source src='videos/".$row["video"]."' class='img-responsive' type='video/mp4'>
</video>  </a>";?>
</div>
<script type="text/javascript">
    var x='<?php echo $post_video;?>';
    var v=document.getElementById("vd");
        if(x.length>0)
        {
            v.style.display="block";
        }
        else
        {
            v.style.display="none";
        }
</script>



<?php 
if (isset($_SESSION['email'])) {
$sql = "SELECT * FROM users WHERE email ='$_SESSION[email]'";
$result = query($sql);
confirm($result);
$row=fetch_array($result);
$user_ID = $row['user_id'];
$email =$row['email'];

// Views Count

}
?>

<?php

if( $user_ID === $a_user_id){

?>







                            <!-- #####Session Section Upvote Count ##### -->
<?php
  $sqlVote = "SELECT count(1) FROM answer_vote WHERE upvotes = 1  AND answer_ID = $a_id";
   $resVote = query($sqlVote);
    confirm($resVote);
    $rowVote = fetch_array($resVote);
    $totalUpvote = $rowVote[0];
?>

                            <!-- ##### Downvote Count ##### -->
<?php
  $sqlVote = "SELECT count(1) FROM answer_vote WHERE downvotes = 1  AND answer_ID = $a_id";
   $resVote = query($sqlVote);
    confirm($resVote);
    $rowVote = fetch_array($resVote);
    $totalDownvote = $rowVote[0];
?>


                            <!-- ##### Report Count ##### -->
<?php
  $sqlVote = "SELECT count(1) FROM answer_vote WHERE reports = 1  AND answer_ID = $a_id";
   $resVote = query($sqlVote);
    confirm($resVote);
    $rowVote = fetch_array($resVote);
    $totalReport = $rowVote[0];
?>



<form method="post" action="details.php?a_id=<?php echo $a_id?>" enctype="multipart/form-data">



<!-- ###################################  Views Count  ######################################### -->
<!-- <i class="fa fa-eye-slash" aria-hidden="true"></i> -->

<?php
  $sqlView = "SELECT count(1) FROM answer_view_count WHERE view = 1  AND answer_ID = $a_id";
   $resView = query($sqlView);
    confirm($resView);
    $rowView = fetch_array($resView);
    $totalView = $rowView[0];
?>

  <span type="btn" style="text-decoration: none;" class="btn btn-link" name="view" id="view"><span class="fa fa-eye-slash"></span> Views <span class="badge badge-light" style="background-color: #6EBEEC;"><?php echo $totalView; ?></span></span>


                            <!-- ##### Upvote ##### -->



     <span type="btn" style="text-decoration: none;" class="btn btn-link" name="upvote" id="upvote"><span class="glyphicon glyphicon-arrow-up"></span> Upvotes <span class="badge badge-light" style="background-color: #6EBEEC;"><?php echo $totalUpvote; ?></span></span>


 

                            <!-- ##### Downvote ##### -->
                            
    <span type="btn" style="text-decoration: none;" class="btn btn-link" id="downvote" name="downvote"><span class="glyphicon glyphicon-arrow-down"></span> Downvotes <span class="badge badge-light" style="background-color: #6EBEEC;"><?php echo '-'.$totalDownvote; ?></span></span>




                            <!-- ##### Report ##### -->

     <span type="btn" style="text-decoration: none;" class="btn btn-link" id="report"  name="report"><i class="fa fa-exclamation-triangle"></i> Reports <span class="badge badge-light" style="background-color: #6EBEEC;"><?php echo $totalReport; ?></span></span>

        </form>









<?php 

}else{

?>





<!-- ########################-Users Upvote Section Start -############################### -->

<?php
          
    if(isset($_POST['upvote'])){

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');

$sql = "INSERT INTO answer_vote(upvotes, downvotes, reports, answer_ID, user_ID, date_time)";
$sql.= "VALUES( 1, 0, 0, '$a_id','$user_ID','$date')";

    $result1=query($sql);
    confirm($result1);

    header("Location: details.php?a_id=$a_id", true, 303);
    }
          
?>


<?php
          
    if(isset($_POST['unupvote'])){

 $sql="DELETE FROM answer_vote WHERE user_ID = '$user_ID' AND upvotes = 1";
    query($sql);

    header("Location: details.php?a_id=$a_id", true, 303);
    }
          
?>




<!-- ########################- Downvote Section Start -############################### -->

<?php
          
    if(isset($_POST['downvote'])){
   
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');

$sql = "INSERT INTO answer_vote(upvotes, downvotes, reports, answer_ID, user_ID, date_time)";
$sql.= "VALUES( 0, 1, 0, '$a_id','$user_ID','$date')";

    $result1=query($sql);
    confirm($result1);
      header("Location: details.php?a_id=$a_id", true, 303);
    } 

?>

<?php
          
    if(isset($_POST['updownvote'])){

    $sqlDown="DELETE FROM answer_vote WHERE user_ID = '$user_ID' AND downvotes = 1";
    query($sqlDown);

      header("Location: details.php?a_id=$a_id", true, 303);
    } 

?>



<!-- ########################- Report Section Start -############################### -->

<?php
          
    if(isset($_POST['report'])){
    
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');

$sql = "INSERT INTO answer_vote(upvotes, downvotes, reports, answer_ID, user_ID, date_time)";
$sql.= "VALUES( 0, 0, 1, '$a_id','$user_ID','$date')";

    $result1=query($sql);
    confirm($result1);
      header("Location: details.php?a_id=$a_id", true, 303);
    }

?>

<?php
          
    if(isset($_POST['unreport'])){

 $sql="DELETE FROM answer_vote WHERE user_ID = '$user_ID' AND reports = 1";
    query($sql);

    header("Location: details.php?a_id=$a_id", true, 303);
    }
          
?>





                            <!-- ##### Upvote Count ##### -->
<?php
  $sqlVote = "SELECT count(1) FROM answer_vote WHERE upvotes = 1  AND answer_ID = $a_id";
   $resVote = query($sqlVote);
    confirm($resVote);
    $rowVote = fetch_array($resVote);
    $totalUpvote = $rowVote[0];
?>

                            <!-- ##### Downvote Count ##### -->
<?php
  $sqlVote = "SELECT count(1) FROM answer_vote WHERE downvotes = 1  AND answer_ID = $a_id";
   $resVote = query($sqlVote);
    confirm($resVote);
    $rowVote = fetch_array($resVote);
    $totalDownvote = $rowVote[0];
?>


                            <!-- ##### Report Count ##### -->
<?php
  $sqlVote = "SELECT count(1) FROM answer_vote WHERE reports = 1  AND answer_ID = $a_id";
   $resVote = query($sqlVote);
    confirm($resVote);
    $rowVote = fetch_array($resVote);
    $totalReport = $rowVote[0];
?>


<!-- #############################  VOTE Section  ############################# -->

   <div class="stats">



<form method="post" action="details.php?a_id=<?php echo $a_id?>" enctype="multipart/form-data">



<!-- ###################################  Views Count  ######################################### -->
<!-- <i class="fa fa-eye-slash" aria-hidden="true"></i> -->

<?php
  $sqlView = "SELECT count(1) FROM answer_view_count WHERE view = 1  AND answer_ID = $a_id";
   $resView = query($sqlView);
    confirm($resView);
    $rowView = fetch_array($resView);
    $totalView = $rowView[0];
?>

  <span type="btn" style="text-decoration: none;" class="btn btn-link" name="view" id="view"><span class="fa fa-eye-slash"></span> Views <span class="badge badge-light" style="background-color: #6EBEEC;"><?php echo $totalView; ?></span></span>


                            <!-- ##### Upvote ##### -->

    <?php
$sqlSub = "SELECT * FROM answer_vote WHERE upvotes = 1 AND user_id = $user_ID  AND answer_ID = $a_id AND downvotes = 0 AND reports = 0";

    $result = (query($sqlSub));
    if(row_count($result)<=0)
    {
?>

     <button type="submit" style="text-decoration: none;" class="btn btn-link" name="upvote" id="upvote" onClick="window.location.reload();"><span class="glyphicon glyphicon-arrow-up"></span> Upvotes <span class="badge badge-light" style="background-color: #6EBEEC;"><?php echo $totalUpvote; ?></span></button>

<?php
    }else{
        $row =fetch_array($result);
        $upvotes = $row['upvotes'];
?>


<button type="submit" style="color: #9400D3; text-decoration: none;" class="btn btn-link" name="unupvote" onClick="window.location.reload();"><span class="glyphicon glyphicon-arrow-up"></span> Upvotes <span class="badge badge-light" style="background-color: #9400D3;"><?php echo $totalUpvote; ?></span></button>

<?php
    }
?>
 

                            <!-- ##### Downvote ##### -->
   <?php
$sqlSub = "SELECT * FROM answer_vote WHERE downvotes = 1 AND user_id = $user_ID  AND answer_ID = $a_id AND upvotes = 0";

    $result = (query($sqlSub));
    if(row_count($result)<=0)
    {

?>
                             
    <button type="submit" style="text-decoration: none;" class="btn btn-link" id="downvote" name="downvote"><span class="glyphicon glyphicon-arrow-down"></span> Downvotes <span class="badge badge-light" style="background-color: #6EBEEC;"><?php echo '-'.$totalDownvote; ?></span></button>
<?php
    }else{
        $row =fetch_array($result);
         $downvotes = $row['downvotes'];
?>
                            
    <button type="submit" style="color: #9400D3; text-decoration: none;" class="btn btn-link" name="updownvote"><span class="glyphicon glyphicon-arrow-down"></span> Downvotes <span class="badge badge-light" style="background-color: #9400D3;"><?php echo '-'.$totalDownvote; ?></span></button>

<?php
    }
?>



                            <!-- ##### Report ##### -->
 <?php
$sqlSub = "SELECT * FROM answer_vote WHERE reports = 1 AND user_id = $user_ID  AND answer_ID = $a_id AND downvotes = 0";

    $result = (query($sqlSub));
    if(row_count($result)<=0)
    {
?>

     <button type="submit" style="text-decoration: none;" class="btn btn-link" id="report"  name="report"><i class="fa fa-exclamation-triangle"></i> Reports <span class="badge badge-light" style="background-color: #6EBEEC;"><?php echo $totalReport; ?></span></button>

<?php
    }else{
    $row =fetch_array($result);
    $reports = $row['reports'];
?>

   <button type="submit" style="color: #9400D3; text-decoration: none;" class="btn btn-link" name="unreport"><i class="fa fa-exclamation-triangle"></i> Reports <span class="badge badge-light" style="background-color: #9400D3;"><?php echo $totalReport; ?></span></button>  

<?php
    }
?>


        </form>
    </div>
</div>




<?php } ?>














<!-- block button -->
   <script type="text/javascript">
                               var x='<?php echo $upvotes;?>';
                              
                                  var v=document.getElementById("downvote");
                                  var d=document.getElementById("report");

                               if(x.length>0)
                                   {
                                     v.setAttribute("disabled", "disabled"); 
                                     d.setAttribute("disabled", "disabled"); 
                                      // v.style.visibility="visible";
                                   // v.style.display = "none";
                                   // d.style.display = "none";
                                   }
                                  else
                                      {
                                        v.style.display = "block";
                                        d.style.display = "block";
                                        // v.style.visibility="block";
                                      }

     </script>

      <script type="text/javascript">
                               
                               var y='<?php echo $downvotes;?>';
                               
                                  var a=document.getElementById("upvote");
                                  var b=document.getElementById("report");
                                  
                               if(y.length>0)
                                   {
                                      
                                      // v.style.visibility="visible";
                                   // a.style.display = "none";
                                   // b.style.display = "none";
                                    a.setAttribute("disabled", "disabled"); 
                                    b.setAttribute("disabled", "disabled"); 
                                   }
                                  else
                                      {
                                        a.style.display = "block";
                                        b.style.display = "block";
                                        // v.style.visibility="block";
                                      }

     </script>

      <script type="text/javascript">
                              
                               var z='<?php echo $reports;?>';
                                  var m=document.getElementById("upvote");
                                  var n=document.getElementById("downvote");
                                  
                               if(z.length>0)
                                   {
                                      
                                      // v.style.visibility="visible";
                                   // m.style.display = "none";
                                   // n.style.display = "none";
                                    m.setAttribute("disabled", "disabled"); 
                                    n.setAttribute("disabled", "disabled"); 
                                   }
                                  else
                                      {
                                        m.style.display = "block";
                                        n.style.display = "block";
                                        // v.style.visibility="block";
                                      }

     </script>
<!-- end -->





<?php } ?>






<!-- ################################################################################### -->

<!-- ################################################################################## -->

        <!-- #########################  Discussion Section  ########################-->

<?php if(logged_in()): ?>

<div class="well" style="padding: 40px;">
     <?php validate_comment(); ?>

<div class="text-center" style="margin-bottom: 10px; color: #04247d; background-color: #FFFF00;">
    <strong>Share your opinion in the comment section and you can view this discussion.</strong>
</div>

    <form method="post" id="submit_form" action="" >

     <input type="hidden" name="q_id" value="<?php echo $q_id; ?>" id="q_id">
    <input type="hidden" name="a_id" value="<?php echo $a_id; ?>" id="a_id">

    <div class="input-group">
        <input type="text" id="userComment" name="comment" class="form-control input-sm chat-input" placeholder="Write your message here..." />
        <span class="input-group-btn" onclick="addComment()" >
            <button href="#" class="btn btn-primary btn-sm" name="firstSubmit" type="firstSubmit"><span class="glyphicon glyphicon-comment"></span> Add Comment</button>
        </span>
    </div>

    </form>
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                  <!--  <a href="index.php" class="btn btn-primary btn-circle" role="button" ><i class="fa fa-arrow-left" aria-hidden="true"> Back </i></a> -->
<!--                   btn btn-link collapsed-->
                    <button class="btn btn-primary btn-circle" data-toggle="collapse" data-target="#collapseThree" style="float: right; margin-bottom: 50px;">
         All Discussion
        </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">

                <div class="card-body">
                    <div class="main_section">
                        <div class="container">
                            <div class="chat_container">


                                <div class="col-sm-6">
                                    <!--message_section-->
                                    <div class="row">

                                        <div class="chat_area">
                                            <ul class="list-unstyled">



<!-- #######################         User ID compaire          ########################### -->

<?php 
if (isset($_SESSION['email']))
$sql = "SELECT * FROM users WHERE email ='$_SESSION[email]'";
$result = query($sql);
confirm($result);
$row=fetch_array($result);
$user_ID = $row['user_id'];
?>
<?php
$sqlcomment ="SELECT * FROM discussion WHERE q_no = '$q_id' AND a_no = '$a_id' AND approve = 1 ";

$resultcomment=(query($sqlcomment));
 if(row_count($resultcomment)<=0)
 {

} else {

$i=1;
while($rowcomment =fetch_array($resultcomment))
{

$d_user_id = $rowcomment["d_user_id"];
$dateTime = $rowcomment["d_date_time"];
$d_id = $rowcomment["discussion_id"];
$post_video = $rowcomment["video"];
$post_pdf = $rowcomment["pdf"];
$post_image = $rowcomment['image'];
$link = $rowcomment['link'];

$newDate = date('j-F-Y \a\t g:i a', strtotime($dateTime));
?>
<?php
if($d_user_id == $user_ID)
{
?>



        <!-- ################################################################################## -->
        <!-- #############################   RIGHT SIDE START   ############################### -->
        <!-- ################################################################################## -->
<?php

    $s ="SELECT * FROM users WHERE user_id = '$d_user_id'";
    $res = query($s);
    confirm($res);
    $r=fetch_array($res);
    $email = $r['email'];
?>
       <div class="well" style="border-color: blue;">
        <li class="left clearfix admin_chat">
                     <span class="chat-img1 pull-right">
                     
                    <?php 
                            echo "<a href='Profile_picture/$r[profile_pic]' target='_blank'><img src='Profile_picture/".$r["profile_pic"]."' id='userpic' class='img-circle' style=' width: 30px; height: 30px; margin: 6px;'  /></a>"
                    ;?>
                     </span>
                    
                    <div class="chat_time pull-right" style="margin-top: 10px; color: #0000FF;">
                      <?php
                        echo ucwords($r['first_name']);
                        echo " ";
                        echo ucwords($r['last_name']);
                    ?>
                    </div>

<!-- ############################ EDIT AND DELETE ##############################-->
<div class="chat_time pull-left" style="margin-top: -50px;">
   

<h5 style="text-align:justify;">
<?php
$user_email = $r['email'];
$email = $_SESSION['email'];

if( $user_email === $email){

?>

    <i  class="pull-left">

        <li class="dropdown">
        <span class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i>
            </span>


            <ul class="dropdown-menu">

                <li><a href="edit_ans.php?edit=<?php echo $d_id; ?>&a_id=<?php echo $a_id; ?>"onclick="return confirm('Are you sure ?')">
                    <button type="submit" name="edit"
                     class="btn btn-info"  data-whatever="@getbootstrap"><span class="fa fa-pencil"></span> Edit...</button></a>
                </li>
           
            <li>
                <a href="details.php?delete=<?php echo $d_id; ?>&a_id=<?php echo $a_id; ?>"onclick="return confirm('Are you sure ?')"><button class="btn btn-danger" data-title="delete" type="delete"><span class="fa fa-trash-o"></span> Delete...</button></a>
            </li>

<?php
    if(isset($_GET['delete'])){
        $delete_id=$_GET['delete'];

    $sql1="SELECT * FROM discussion WHERE discussion_id  ='$delete_id'";
    $result1= query($sql1);
    $res1=mysqli_fetch_array($result1);
    $filename = $res1['image'];
    $pdfName = $res1['pdf'];
    $videoName = $res1['video'];

    unlink("images/discussion/".$filename);
    unlink("pdf/discussion/".$pdfName);
    unlink("videos/discussion/".$videoName);

    $sql="DELETE FROM discussion WHERE discussion_id = '$delete_id'";
    query($sql);

      header("location: details.php?a_id=$a_id");

    set_message("<div class='alert alert-danger'>
    <strong>Delete!</strong> successfull.
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

            </ul>
        </li>
    </i>


<?php }?>
<br>
<br>
<br>
<div class="chat-body1 clearfix " style="margin-top: 0px;">
    <?php echo htmlspecialchars_decode($rowcomment['communication']); ?>
</div>


<?php
if (empty ($link)) {

}else{
?>

<div style="margin-bottom: 20px;">
    <b><p>See this:</p></b><a href="<?php echo $link ?>" target="_blank"><?php echo $link ?></a>
</div>

<?php
}

?>
<div  style="margin-bottom: 20px;">
<?php echo "<a href='images/discussion/$rowcomment[image]' target='_blank' id='image$i' ><img src='images/discussion/".$rowcomment["image"]."' alt='' width='500' height='250'/> </a>";?>
  </div>

  <div style="margin-bottom: 20px;">
<?php echo "<a href='pdf/discussion/$rowcomment[pdf]' target='_blank' id='pdf$i'>
        <embed src='pdf/discussion/".$rowcomment["pdf"]."' id='pdf$i' alt='' width='500' height='250' style='margin-top:10px;'   /> </a>";?>
</div>

<div style="margin-bottom: 20px;">
<?php echo "<a href='videos/discussion/$rowcomment[video]' target='_blank' id='vd$i'>   <video id='vd$i' width='500' style='margin-top:10px;'  controls>
  <source src='videos/discussion/".$rowcomment["video"]."'  type='video/mp4'>
</video>  </a>";?>
</div>
</h5>

</div>
 <script type="text/javascript">
                               var x='<?php echo $post_video;?>';
                                  var v=document.getElementById("vd<?php echo $i;?>");
                               if(x.length>0)
                                   {
                                    v.style.display="block";
                                   }
                                  else
                                      {
                                         v.style.display="none";
                                      }

                            </script>


                             <script type="text/javascript">
                               var x='<?php echo $post_pdf;?>';
                                  var v=document.getElementById("pdf<?php echo $i;?>");
                               if(x.length>0)
                                   {
                                      v.style.display="block";
                                   }
                                  else
                                      {
                                         v.style.display="none";
                                      }

                            </script>


                             <script type="text/javascript">
                               var x='<?php echo $post_image;?>';
                                  var v=document.getElementById("image<?php echo $i;?>");
                               if(x.length>0)
                                   {
                                      v.style.display="block";
                                   }
                                  else
                                      {
                                        v.style.display="none";
                                      }

                            </script>




                     <div class="chat-body1 clearfix " style="margin-top: 60px;">
                        <div class="chat_time pull-left"> 
                            <small style="color: #04247d;">
                                <?php echo $newDate; ?>
                            </small> 
                        </div>
                     </div>


                            <!-- ##### Discussion Upvote Count ##### -->
<?php
  $sqlVote = "SELECT count(1) FROM discussion_vote WHERE discussion_id = $d_id";
   $resVote = query($sqlVote);
    confirm($resVote);
    $rowVoteDis = fetch_array($resVote);
    $totalUpvoteDis = $rowVoteDis[0];
?>

                            <!-- ##### Discussion Downvote Count ##### -->
<?php
  $sqlVote = "SELECT count(1) FROM discussion_vote WHERE downvotes = 1 AND discussion_id = $d_id";
   $resVote = query($sqlVote);
    confirm($resVote);
    $rowVoteDis = fetch_array($resVote);
    $totalDownvoteDis = $rowVoteDis[0];
?>


                            <!-- ##### Discussion Report Count ##### -->
<?php
  $sqlVote = "SELECT count(1) FROM discussion_vote WHERE reports = 1 AND discussion_id = $d_id";
   $resVote = query($sqlVote);
    confirm($resVote);
    $rowVoteDis = fetch_array($resVote);
    $totalReportDis = $rowVoteDis[0];
?>





<!-- ############################# Discussion VOTE Section  ############################# -->
 <div class="chat-img1 pull-right">
   <!-- <div class="stats pull-left"> -->

                            <!-- ##### Discussion Upvote ##### -->

     <button type="btn" style="text-decoration: none;" class="btn btn-link" name="dis_upvote" id="dis_upvote"><span class="glyphicon glyphicon-arrow-up"></span> Upvotes <span class="badge badge-light" style="background-color: #6EBEEC;"><?php echo $totalUpvoteDis; ?></span></button>


 

                            <!-- ##### Discussion Downvote ##### -->
                              
  <!--   <button type="btn" style="text-decoration: none;" class="btn btn-link" id="dis_downvote" name="dis_downvote"><span class="glyphicon glyphicon-arrow-down"></span> Downvotes <span class="badge badge-light" style="background-color: #6EBEEC;"><?php echo '-'.$totalDownvoteDis; ?></span></button> -->




                            <!-- ##### Discussion Report ##### -->


    <!--  <button type="btn" style="text-decoration: none;" class="btn btn-link" id="dis_report" name="dis_report"><i class="fa fa-exclamation-triangle"></i> Reports <span class="badge badge-light" style="background-color: #6EBEEC;"><?php echo $totalReportDis; ?></span></button>
 -->


    <!-- </div> -->
</div>
           </li>
                                                </div>
                                    

        <!-- #############################   RIGHT SIDE END   ############################### -->


<?php 
}else{

    $s ="SELECT * FROM users WHERE user_id = $d_user_id";
    $res = query($s);
    confirm($res);
    $r=fetch_array($res);
    $email = $r['email'];

?>


        <!-- ################################################################################## -->
        <!-- #############################   LEFT SIDE START   ################################ -->
        <!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->

<div class="well" style="border-color: darkslategray;">
    <li class="left clearfix">


                    
                    <span class="chat-img1 pull-left">
                    
                         <?php echo "<a href='Profile_picture/$r[profile_pic]' target='_blank'><img src='Profile_picture/".$r["profile_pic"]."' id='userpic' class='img-circle' style=' width: 30px; height: 30px; margin: 6px;'  /></a>"
                         ?>
                     </span>
                     <div class="chat-body1 clearfix"  style="margin-top: 10px; color: #0000FF;">
                        <?php
                        echo ucwords($r['first_name']);
                        echo " ";
                        echo ucwords($r['last_name']);
                    ?>
                    </div>


                    <div>
                        

<h5 style="text-align:justify;">
<?php
$user_email = $r['email'];
$email = $_SESSION['email'];
// echo $user_email;
// echo $email;
// echo $d_id;
if( $user_email === $email){
 //echo $d_id;
?>

    <i  class="pull-left">

        <li class="dropdown">
        <span class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i>
            </span>


            <ul class="dropdown-menu">

                <li><a href="edit_ans.php?edit=<?php echo $d_id; ?>&a_id=<?php echo $a_id; ?>"onclick="return confirm('Are you sure ?')">
                    <button type="submit" name="edit"
                     class="btn btn-info"  data-whatever="@getbootstrap"><span class="fa fa-pencil"></span> Edit...</button></a>
                </li>
           
            <li>
                <a href="details.php?delete=<?php echo $d_id; ?>&a_id=<?php echo $a_id; ?>"onclick="return confirm('Are you sure ?')"><button class="btn btn-danger" data-title="delete" type="delete"><span class="fa fa-trash-o"></span> Delete...</button></a>
            </li>

<?php
    if(isset($_GET['delete'])){
        $delete_id=$_GET['delete'];

    $sql1="SELECT * FROM discussion WHERE discussion_id  ='$delete_id'";
    $result1= query($sql1);
    $res1=mysqli_fetch_array($result1);
    $filename = $res1['image'];
    $pdfName = $res1['pdf'];
    $videoName = $res1['video'];

    unlink("images/discussion/".$filename);
    unlink("pdf/discussion/".$pdfName);
    unlink("videos/discussion/".$videoName);

    $sql="DELETE FROM discussion WHERE discussion_id = '$delete_id'";
    query($sql);

      header("location: details.php?a_id=$a_id");

    set_message("<div class='alert alert-danger'>
    <strong>Delete!</strong> successfull.
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

            </ul>
        </li>
    </i>


<?php }?>

<div class="chat-body1 clearfix">
    <?php echo htmlspecialchars_decode($rowcomment['communication']); ?>
</div><!--end  -->

<?php
if (empty ($link)) {

}else{
?>

<div style="margin-bottom: 20px;"><b><p>See this:</p></b><a href="<?php echo $link ?>" target="_blank"><?php echo $link ?></a></div>

<?php
}

?>
<div style="margin-bottom: 20px;">
<?php echo "<a href='images/discussion/$rowcomment[image]' target='_blank' id='image$i' ><img src='images/discussion/".$rowcomment["image"]."' alt='' width='500' height='250'/>view</a>";?>
  </div>

  <div style="margin-bottom: 20px;">
<?php echo "<a href='pdf/discussion/$rowcomment[pdf]' target='_blank' id='pdf$i'>
        <embed src='pdf/discussion/".$rowcomment["pdf"]."' id='pdf$i' alt='' width='500' height='250' style='margin-top:10px;'   /> view</a>";?>
</div>

<div style="margin-bottom: 20px;">
<?php echo "<a href='videos/discussion/$rowcomment[video]' target='_blank' id='vd$i'>   <video id='vd$i' width='500' style='margin-top:10px;'  controls>
  <source src='videos/discussion/".$rowcomment["video"]."'  type='video/mp4'>
</video> view </a>";?>
</div>
</h5>


                    </div>
<script type="text/javascript">
                               var x='<?php echo $post_video;?>';
                                  var v=document.getElementById("vd<?php echo $i;?>");
                               if(x.length>0)
                                   {
                                    v.style.display="block";
                                   }
                                  else
                                      {
                                         v.style.display="none";
                                      }

                            </script>


                             <script type="text/javascript">
                               var x='<?php echo $post_pdf;?>';
                                  var v=document.getElementById("pdf<?php echo $i;?>");
                               if(x.length>0)
                                   {
                                      v.style.display="block";
                                   }
                                  else
                                      {
                                         v.style.display="none";
                                      }

                            </script>


                             <script type="text/javascript">
                               var x='<?php echo $post_image;?>';
                                  var v=document.getElementById("image<?php echo $i;?>");
                               if(x.length>0)
                                   {
                                      v.style.display="block";
                                   }
                                  else
                                      {
                                        v.style.display="none";
                                      }

                            </script>


                     <div class="chat-body1 clearfix">
                        <div class="chat_time pull-right">
                            <small style="color: #04247d;">
                                <?php echo $newDate; ?>
                            </small> 
                        </div>
                     </div><!--end  -->
                   



<!-- #########################  Discussion Vote System ######################### -->

<div style="margin:">





<!-- ####################- Discussion Downvote Section Start -################## -->

<?php
          
    if(isset($_POST['dis_downvote'])){
   
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');

$sql = "INSERT INTO discussion_vote(upvotes, downvotes, reports, discussion_ID, user_ID, date_time)";
$sql.= "VALUES( 0, 1, 0, '$a_id','$user_ID','$date')";

    $result1=query($sql);
    confirm($result1);
      header("Location: details.php?a_id=$a_id", true, 303);
    } 

?>

<?php
          
    if(isset($_POST['dis_updownvote'])){

    $sqlDown="DELETE FROM discussion_vote WHERE user_ID = '$user_ID' AND downvotes = 1";
    query($sqlDown);

      header("Location: details.php?a_id=$a_id", true, 303);
    } 

?>



<!-- ######################- DiscussionReport Section Start -#################### -->

<?php
          
    if(isset($_POST['dis_report'])){
    
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');

$sql = "INSERT INTO discussion_vote(upvotes, downvotes, reports, discussion_ID, user_ID, date_time)";
$sql.= "VALUES( 0, 0, 1, '$d_id','$user_ID','$date')";

    $result1=query($sql);
    confirm($result1);
      header("Location: details.php?a_id=$a_id", true, 303);
    }

?>

<?php
          
    if(isset($_POST['dis_unreport'])){

 $sql="DELETE FROM discussion_vote WHERE user_ID = '$user_ID' AND reports = 1";
    query($sql);

    header("Location: details.php?a_id=$a_id", true, 303);
    }
          
?>





                            <!-- ##### Discussion Upvote Count ##### -->
<?php
  $sqlVote = "SELECT count(1) FROM discussion_vote WHERE discussion_id = $d_id";
   $resVote = query($sqlVote);
    confirm($resVote);
    $rowVoteDis = fetch_array($resVote);
    $totalUpvoteDis = $rowVoteDis[0];
?>

                            <!-- ##### Discussion Downvote Count ##### -->
<?php
  $sqlVote = "SELECT count(1) FROM discussion_vote WHERE downvotes = 1";
   $resVote = query($sqlVote);
    confirm($resVote);
    $rowVoteDis = fetch_array($resVote);
    $totalDownvoteDis = $rowVoteDis[0];
?>


                            <!-- ##### Discussion Report Count ##### -->
<?php
  $sqlVote = "SELECT count(1) FROM discussion_vote WHERE reports = 1";
   $resVote = query($sqlVote);
    confirm($resVote);
    $rowVoteDis = fetch_array($resVote);
    $totalReportDis = $rowVoteDis[0];
?>

<!-- ############################# Discussion VOTE Section  ############################# -->

   <div class="stats">

<form method="post" action="details.php?a_id=<?php echo $a_id?>" enctype="multipart/form-data">






                            <!-- ##### Discussion Upvote ##### -->


<?php
$sqlBlockUser = "SELECT * FROM discussion_vote WHERE upvotes = 1 AND downvotes = 0 AND reports = 0 AND discussion_id = $d_id AND user_ID = $user_ID";

$resultBlockUser = query($sqlBlockUser);
confirm($resultBlockUser);
    $pu=0;
while($rowUserBlock = fetch_array($resultBlockUser))
{

        $dis_upvotes = $rowUserBlock['upvotes'];
        $dis_downvotes = $rowUserBlock['downvotes'];
        $dis_vote_id = $rowUserBlock['dis_vote_id'];
       
$pu++;
}

if($pu === 0){
    ?>

<a href="details.php?a_id=<?php echo $a_id?>&&upvote_insert_id=<?php echo $d_id?>" style="text-decoration: none;">
<p style="text-decoration: none;"  class="btn btn-link" name="dis_upvote" id="dis_upvote<?php echo $d_id; ?>" ><span class="glyphicon glyphicon-arrow-up"></span> Upvotes <span class="badge badge-light" style="background-color: #6EBEEC;"><?php echo $totalUpvoteDis; ?></span></p>
</a>

<!-- <a href="details.php?a_id=<?php echo $a_id?>&&downvote_insert_id=<?php echo $d_id?>" style="text-decoration: none;">

      <p type="submit" style="text-decoration: none;" class="btn btn-link" id="dis_downvote<?php echo $i; ?>" name="dis_downvote"><span class="glyphicon glyphicon-arrow-down"></span> Downvotes <span class="badge badge-light" style="background-color: #6EBEEC;"><?php echo '-'.$totalDownvoteDis; ?></span></p>

</a> -->

<!-- <button type="submit" style="text-decoration: none;" class="btn btn-link" id="dis_report<?php echo $i; ?>" name="dis_report"><i class="fa fa-exclamation-triangle"></i> Reports <span class="badge badge-light" style="background-color: #6EBEEC;"><?php echo $totalReportDis; ?></span></button> -->

    <?php
}else{
    ?>

<a href="details.php?a_id=<?php echo $a_id?>&&upvote-delete_id=<?php echo $d_id?>" style="color: #9400D3; text-decoration: none;" >

<p style="color: #9400D3; text-decoration: none;"  class="btn btn-link" name="dis_unupvote"><span class="glyphicon glyphicon-arrow-up"></span> Upvotes <span class="badge badge-light" style="background-color: #9400D3;"><?php echo $totalUpvoteDis; ?></span></p>

</a>

    <?php
}
?>




                            <!-- ##### Discussion Downvote ##### -->

   <?php

$sqlSub = "SELECT * FROM discussion_vote WHERE upvotes = 0 AND downvotes = 1 AND discussion_id = $d_id AND user_ID = $user_ID";

    $result = (query($sqlSub));
    if(row_count($result)<=0)
    {
?>
                                 

 <!-- <a href="details.php?a_id=<?php echo $a_id?>&&downvote_insert_id=<?php echo $d_id?>" style="text-decoration: none;">

      <p type="submit" style="text-decoration: none;" class="btn btn-link" id="dis_downvote<?php echo $i; ?>" name="dis_downvote"><span class="glyphicon glyphicon-arrow-down"></span> Downvotes <span class="badge badge-light" style="background-color: #6EBEEC;"><?php echo '-'.$totalDownvoteDis; ?></span></p>

</a> -->

<?php
    }else{
        $row =fetch_array($result);
        $dis_downvotes = $row['downvotes'];


       
?>
                            
   <!--  <button type="submit" style="color: #9400D3; text-decoration: none;" class="btn btn-link" name="dis_updownvote"><span class="glyphicon glyphicon-arrow-down"></span> Downvotes <span class="badge badge-light" style="background-color: #9400D3;"><?php echo '-'.$totalDownvoteDis; ?></span></button> -->
 
<?php
    }
?>



                            <!-- ##### Discussion Report ##### -->
                            
 <?php
$sqlSub = "SELECT * FROM discussion_vote WHERE reports = 1 AND user_id = $user_ID";

    $result = (query($sqlSub));
    if(row_count($result)<=0)
    {
?>

    <!--  <button type="submit" style="text-decoration: none;" class="btn btn-link" id="dis_report<?php echo $i; ?>" name="dis_report"><i class="fa fa-exclamation-triangle"></i> Reports <span class="badge badge-light" style="background-color: #6EBEEC;"><?php echo $totalReportDis; ?></span></button>
 -->
<?php
    }else{
    $row =fetch_array($result);
    $dis_reports = $row['reports'];
   
?>

  <!--  <button type="submit" style="color: #9400D3; text-decoration: none;" class="btn btn-link" name="dis_unreport"><i class="fa fa-exclamation-triangle"></i> Reports <span class="badge badge-light" style="background-color: #9400D3;"><?php echo $totalReportDis; ?></span></button>  
 -->
<?php
    }
?>


</div>

</form>
<!-- block button -->








<!-- ################################################################################# -->
<!--********************************* Insert Upvote ***********************************-->
<!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->

<?php
          
    if(isset($_GET['upvote_insert_id'])){
    $d_id=$_GET['upvote_insert_id'];

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');


$qry="SELECT * FROM discussion_vote WHERE discussion_id = $d_id AND user_ID = $user_ID ";

$resultQry = query($qry);

if(row_count($resultQry) == 1) {

}else{

$sql = "INSERT INTO discussion_vote(upvotes, downvotes, reports, discussion_ID, user_ID, date_time)";
$sql.= "VALUES( 1, 0, 0, '$d_id','$user_ID','$date')";

    $result1=query($sql);
    confirm($result1);

    header("Location: details.php?a_id=$a_id", true, 303);
    }
}     
?>

<!-- ################################################################################# -->
<!--********************************* Delete Upvote ***********************************-->
<!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->

<?php
          
    if(isset($_GET['upvote-delete_id'])){
    $d_id=$_GET['upvote-delete_id'];

    $sql="DELETE FROM discussion_vote WHERE discussion_id = '$d_id' AND user_ID = $user_ID";
    query($sql);

    header("Location: details.php?a_id=$a_id", true, 303);
    }
          
?>





<!-- ################################################################################# -->
<!--********************************* Insert Downvote ***********************************-->
<!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->


<?php
          
    if(isset($_GET['downvote_insert_id'])){
    $d_id=$_GET['downvote_insert_id'];

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');


$qry="SELECT * FROM discussion_vote WHERE discussion_id = $d_id AND user_ID = $user_ID ";

$resultQry = query($qry);

if(row_count($resultQry) == 1) {

}else{

$sql = "INSERT INTO discussion_vote(upvotes, downvotes, reports, discussion_ID, user_ID, date_time)";
$sql.= "VALUES( 1, 0, 0, '$d_id','$user_ID','$date')";

    $result1=query($sql);
    confirm($result1);

    header("Location: details.php?a_id=$a_id", true, 303);
    }
}     
?>




<!-- 

   <script type="text/javascript">
                               var x='<?php echo $dis_vote_id; ?>';
                              
                                  var v=document.getElementById("dis_downvote<?php echo $i; ?>");
                                  var d=document.getElementById("dis_report<?php echo $i; ?>");

                               // if(x.length>0)
                               if(x !== null && x !== '' && x !== 0)
                                   {
                                    // v.setAttribute("disabled", "disabled"); 
                                    // d.setAttribute("disabled", "disabled"); 
                                   v.style.display = "none";
                                   d.style.display = "none";
                                   }
                                  else
                                      {
                                        v.style.display = "block";
                                        d.style.display = "block";
                                      }

    </script>
 -->

<!-- 
      <script type="text/javascript">
                               
                               var y='<?php echo $dis_downvotes;?>';
                               
                                  var a=document.getElementById("dis_upvote");
                                  var b=document.getElementById("dis_report");
                                  
                               if(y.length>0)
                                   {
                                   a.style.display = "none";
                                   b.style.display = "none";
                                    // a.setAttribute("disabled", "disabled"); 
                                    // b.setAttribute("disabled", "disabled"); 
                                   }
                                  else
                                      {
                                        a.style.display = "block";
                                        b.style.display = "block";
                                      }

     </script>

      <script type="text/javascript">
                              
                               var z='<?php echo $dis_reports;?>';
                                  var m=document.getElementById("dis_upvote");
                                  var n=document.getElementById("dis_downvote");
                                  
                               if(z.length>0)
                                   {   
                                    m.style.display = "none";
                                    n.style.display = "none";
                                    // m.setAttribute("disabled", "dis_disabled"); 
                                    // n.setAttribute("disabled", "dis_disabled"); 
                                   }
                                  else
                                      {
                                        m.style.display = "block";
                                        n.style.display = "block";
                                      }

     </script> -->
<!-- end -->
        </div>
 
    </li>
</div>

        <!-- #############################   LEFT SIDE END   ############################### -->


<?php
        }
        $i++;
    }
}
?>






                                        </div>
                                        <!--chat_area-->
                                        <div class="message_write">



            <form method="post" id="submit_form" action="" enctype="multipart/form-data">

            <input type="hidden" name="q_id" value="<?php echo $q_id;?>" id="q_id">
            <input type="hidden" name="a_id" value="<?php echo $a_id;?>" id="a_id">

            <textarea class="form-control" name="comment" placeholder="type a message" ></textarea>
            <div class="clearfix"></div>
            <div class="form-group">
            <div class="input-group" style="margin-top:5px;">
            <div class="input-group-addon">http://</div>
            <input type="text" class="form-control" name="url" id="uploadMedia" placeholder=" Enter a valid link">
            </div>
            </div>

<div class="form-group">
    <label for="upload-1">
    <i class="fa fa-file-image-o" style="font-size:36px"></i>
  <input id="upload-1" type="file" accept="image/png, image/jpeg, image/gif" name="image" style="display: none;" aria-hidden="true">
  </label>

  <label for="upload-2" style="margin-left:210px;">
      <span class="fa fa-file-pdf-o" style="font-size:36px" aria-hidden="true"></span>
      <input type="file" id="upload-2" style="display:none;" accept="application/pdf,application/vnd.ms-excel" name="pdf" >
    </label>

    <label for="upload-3" style="margin-left:210px;">
    <span class="fa fa-file-video-o" style="font-size:36px" aria-hidden="true"></span>
  <input id="upload-3" type="file" name="video" accept="video/mp4,video/x-m4v,video/*" style="display:none;"></label>
</div>


                                           <div class="chat_bottom">
                                               <button type="submit" onclick="form_submit()" name="secondSubmit" id="submit" class="btn btn-success btn-lg" style="width: 100%;"  value="secondSubmit"><span class="glyphicon glyphicon-ok-sign" ></span> Submit</button>
                                          </div>

                                            </form>


                                        </div>
                                    </div>
                                </div>
                                <!--message_section-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
</div>


<?php endif; ?>

</div>
</div>
</div>
</div>

</div>
</div>

<script type="text/javascript">

     function func(q)
    {
         document.getElementById('d_id_input').value = q;
    }

</script>




<script type="text/javascript">

jQuery(function($) {
  $('input[type="file"]').change(function() {
    if ($(this).val()) {
         var filename = $(this).val();
         $(this).closest('.file-upload').find('.file-name').html(filename);
    }
  });
})

</script>

<?php include "includes/footer.php" ?>
