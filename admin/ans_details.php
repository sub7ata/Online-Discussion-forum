<?php include "includes/admin_header.php" ?>
 
<?php

if(admin_logged_in()){
    
} else {

redirect("admin_login.php");
}

?>
<?php include "includes/admin_navigation.php" ?>
<div id="wrapper">
   
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
        <div class="col-md-10 col-md-offset-1">
            <div class="col-sm-12">
                <div class="panel panel-white post panel-shadow">
                <?php display_message();  ?>
                

<?php
if(isset($_GET['a_id'])){
$a_id = $_GET['a_id'];

$quer = "UPDATE answers SET status = 'read' WHERE a_no = '$a_id'";
query($quer);

$sql ="SELECT * FROM subjects
        JOIN questions
        ON subjects.subject_id = questions.q_subject_id
        JOIN answers
        ON subjects.subject_id = answers.a_subject_id
        WHERE questions.q_no=answers.q_no
        AND questions.a_s = 1 AND answers.a_q = 1  AND answers.a_no = $a_id ";
        $result = query($sql);
        confirm($result);
        $row=fetch_array($result);
        $ques=htmlspecialchars_decode($row["question"]);
        $img=$row["image"];
        $post_video = $row["video"];
        $post_pdf = $row["pdf"];
        $q_user_id= $row["a_user_id"];
        $q_email = $row["q_email"];

        $a_id = $row["a_no"];
        $q_id = $row["q_no"];

        $dateTime = $row["q_date_time"];
        $questionsDate = date('j-F-Y \a\t g:i a', strtotime($dateTime));

        $date_Time = $row["a_date_time"];
        $answersDate = date('j-F-Y \a\t g:i a', strtotime($date_Time));

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

<?php echo "<a href='../Profile_picture/$r[profile_pic]' target='_blank'><img src='../Profile_picture/".$r["profile_pic"]."' id='userpic' class='img-circle' style=' width: 60px; height: 60px; margin: 6px;'  /></a>";?>

                        </div>
<br>
                        <div class="pull-left meta">
                            <div style="margin-top: 12px;">

 by<a href="#" style="text-decoration:none;">
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
                            <div class="text-justify" style="color:black;margin-top: 100px;">
                                <p>

                                   <hr>

                                   <div class="pull-left image">

<?php
    $sql_ans ="SELECT * FROM users WHERE user_id = '$q_user_id'";
    $res_ans = query($sql_ans);
    confirm($res_ans);
    $row_ans=fetch_array($res_ans);
?>

    <?php echo "<a href='../Profile_picture/$row_ans[profile_pic]' target='_blank'><img src='../Profile_picture/".$row_ans["profile_pic"]."' id='userpic' class='img-circle' style=' width: 60px; height: 60px; margin: 6px;'  /></a>";?>


                                   </div>

                                   <div class="pull-left meta">
                                       <div >
                                            <a href="#" style="text-decoration:none;">
                                                <b>

<?php
    $sq = "SELECT * FROM users WHERE user_id = $q_user_id";
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
<?php echo "<a href='../images/$row[image]' target='_blank' id='image' ><img src='../images/".$row["image"]."' class='img-responsive' alt=''  height='355'/></a>";?>
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
<?php echo "<a href='../pdf/$row[pdf]' target='_blank' id='pdf'>
        <embed src='../pdf/".$row["pdf"]."' id='pdf' alt=''  height='355'  /> </a>";?>
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
<?php echo "<a href='../videos/$row[video]' target='_blank' id='vd'>   <video id='vd' controls>
  <source src='../videos/".$row["video"]."' class='img-responsive' type='video/mp4'>
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


<!-- autoplay loop class="embed-responsive-item" -->
                        </div>











<?php } ?>






<!--                        Discussion Section-->



<div class="well">
     
    <form method="post" id="submit_form" action="" >

     <input type="hidden" name="q_id" value="<?php echo $q_id; ?>" id="q_id">
    <input type="hidden" name="a_id" value="<?php echo $a_id; ?>" id="a_id">

   <!--  <div class="input-group">
        <input type="text" id="userComment" name="comment" class="form-control input-sm chat-input" placeholder="Write your message here..." />
        <span class="input-group-btn" onclick="addComment()">
            <button href="#" class="btn btn-primary btn-sm" name="firstSubmit" type="firstSubmit"><span class="glyphicon glyphicon-comment"></span> Add Comment</button>
        </span>
    </div> -->

    </form>
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingThree">
                <h5 class="mb-0">

                    <a href="view_approved_answers.php" class="btn btn-primary btn-circle" role="button" ><i class="fa fa-arrow-left" aria-hidden="true"> Back </i></a>
<!--                   btn btn-link collapsed-->
                    <button class="btn btn-primary btn-circle" data-toggle="collapse" data-target="#collapseThree" style="float: right;">
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


<?php
$sqlcomment ="SELECT * FROM discussion WHERE q_no = '$q_id' AND a_no = '$a_id' AND approve = 1";

$resultcomment=(query($sqlcomment));
 if(row_count($resultcomment)<=0)
 {
?>
          
        <div class='alert alert-danger text-center'><strong>Not Found !</strong></div>                              
<?php
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




<li class="left clearfix">
    <span class="chat-img1 pull-left">





<?php

    $s ="SELECT * FROM users WHERE user_id = '$d_user_id'";
    $res = query($s);
    confirm($res);
    $r=fetch_array($res);
    $email = $r['email'];
    ?>

    <?php echo "<a href='../Profile_picture/$r[profile_pic]' target='_blank'><img src='../Profile_picture/".$r["profile_pic"]."' id='userpic' class='img-circle' style=' width: 30px; height: 30px; margin: 6px;'  /></a>";?>
<span style="color: #02225a;">
 <?php
    echo ucwords($r['first_name']);
    echo " ";
    echo ucwords($r['last_name']);
?>
</span>

</span>
                <div class="chat-body1 clearfix">
<!--                    <p style="text-align:justify;">-->

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

    <i  class="pull-right">

        <li class="dropdown">
       <!--  <span class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i>
            </span> -->


            <ul class="dropdown-menu">

       <!--          <li><a href="edit_ans.php?edit=<?php echo $d_id; ?>&a_id=<?php echo $a_id; ?>"onclick="return confirm('Are you sure ?')">
                    <button type="submit" name="edit"
                     class="btn btn-info"  data-whatever="@getbootstrap"><span class="fa fa-pencil"></span> Edit...</button></a>
                </li>
           
            <li>
                <a href="details.php?delete=<?php echo $d_id; ?>&a_id=<?php echo $a_id; ?>"onclick="return confirm('Are you sure ?')"><button class="btn btn-danger" data-title="delete" type="delete"><span class="fa fa-trash-o"></span> Delete...</button></a>
            </li>
 -->
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
    <?php echo htmlspecialchars_decode($rowcomment['communication']); ?>
    <br>
<?php
if (empty ($link)) {

}else{
?>

<div style="margin-bottom: 20px;"><b>See this: </b><a href="<?php echo $link ?>" target="_blank"><?php echo $link ?></a></div>

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




          <!--   <div class="stats">
                 <button type="button" class="btn btn-link" onclick="return confirm('Are you sure ?')" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Replay</button>

                <button type="button" class="btn btn-link">Upvote</button>
            </div> -->

                        <div class="chat_time pull-right" >

                                <?php echo $newDate; ?>
                        </div>
                </div>

</li>




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


<?php
$i++;
}
 }

?>



                                            </ul>
                                        </div>
                                        <!--chat_area-->
                                        <div class="message_write">

<!-- 

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

                                            </form> -->


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

<?php include "includes/admin_footer.php" ?>
