<?php include "includes/admin_header.php" ?>

<?php

if(admin_logged_in()){
    
} else {

redirect("admin_login.php");
}

?>
<div id="wrapper">
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                  <div class="text-center">
                      Pending answers
                  </div>
                    </h1>
                     <?php display_message();  ?>


<?php

$sql ="SELECT * FROM subjects
        JOIN questions
        ON subjects.subject_id = questions.q_subject_id
        JOIN answers
        ON subjects.subject_id = answers.a_subject_id WHERE questions.q_no=answers.q_no AND questions.a_s = 1 AND answers.a_q = 1 AND answers.a_a = 0 AND answers.user_approve = 1"; 



$result=(query($sql));

if(row_count($result)<=0)
 {
     ?>
            <div class="col-md-8 col-md-offset-2">
             <div class='alert alert-danger text-center'><strong>Not Found !</strong></div>                                  
     
            </div>
<?php
} else {

$i=1;
?>

                    <div class="table-responsive text-justify">
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                                <th>Q.No</th>
                                <th>Question</th>
                                <th>A.No</th>
                                <th>Answer</th>
                                <th>User ID</th>
                                <th>Name</th>
                                <!-- <th>Image</th>
                                <th>Pdf</th>
                                <th>Video</th> -->
                                <th>Date Time</th>
                                <th>Delete</th>
                                <th>Accept</th>
                                <th>View</th>
                            </thead>
<?php
$k=1;
while($row =fetch_array($result))
{
    $id=$row["a_no"];
    $post_video = $row["video"];
    $post_pdf = $row["pdf"];
    $post_image = $row['image'];
    $a_user_id = $row['a_user_id'];
    $status = $row['status'];
 
    $date = $row["a_date_time"];
    $dt = date("g:i a - d/m/Y", strtotime($date));
?>
                            <tr class="<?php if(isset($classname)) echo $classname;?>">
                                <td>
                                    <b><?php echo $row["q_no"];?></b>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars_decode($row["question"]);?>
                                </td>
                                 <td>
                                    <b><?php echo $row["a_no"];?></b>
                                </td>
                                <td>
                                  <?php echo substr(htmlspecialchars_decode($row['answer']),0,70); '...' ?>
                                </td>
<th>
  <div><p><?php echo $a_user_id; ?></p></div>
</th>


                                  <th>
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
    <br>
    <?php
    echo $roww["email"];
?>
                                  </th>

                              <!--  <td>
                <?php echo "<a href='../images/$row[image]' target='_blank' id='image$k' ><img src='../images/".$row["image"]."' alt='' width='100' height='50'/>view</a>";?>
                                    </td>
                               
                                 <td>
                         
<?php echo "<a href='../pdf/$row[pdf]' target='_blank' id='pdf$k' ><embed src='../pdf/".$row["pdf"]."' id='pdf$k' width='100' height='50' />view</a>";?>
                                 
                                </td>
                                 <td>
                                   
                                   
                                   
<?php echo "<a href='../videos/$row[video]' target='_blank' id='vd$k'><video width='100' id='vd$k' controls>
  <source src='../videos/".$row["video"]."' type='video/mp4'>
</video>view</a>";?>
                                </td> -->
                                <td>
                                    <?php echo $dt; ?>
                                </td>
                                <td>
                                      <a href="view_pending_answers.php?delete=<?php echo $id?>"
                                    onclick="return confirm('Are you sure ?')"> <p data-placement="top" data-toggle="tooltip" title="delete"><button class="btn btn-danger btn-xs" data-title="delete" data-toggle="modal" type="delete" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button></p></a>
                                </td>
                                <td>
                            <a href="view_pending_answers.php?accept=<?php echo $id?>"onclick="return confirm('Are you sure ?')">
                                    <p data-placement="top" data-toggle="tooltip" title="Accept"><button class="btn btn-success btn-xs" data-title="Accept" data-toggle="modal" data-target="#accept"><span class="glyphicon glyphicon-ok"></span></button></p></a>
                                </td>

                                <td>
<?php
    if($status == 'read'){
?>
     <a style="color: #9400D3;" href="ans_details.php?a_id=<?php echo $id; ?>">View</a> 
<?php
    }else{
?>
 <a href="ans_details.php?a_id=<?php echo $id; ?>">View</a> 
 <?php
}
?>
                                </td>
                            </tr>
                            
                            
                             
                            <script type="text/javascript">
                               var x='<?php echo $post_video;?>';
                                  var v=document.getElementById("vd<?php echo $k;?>");
                               if(x.length>0)
                                   {
                                      
                                      v.style.visibility="visible";
                                   }
                                  else
                                      {
                                        v.style.visibility="hidden";
                                      }

                            </script>
                            
                            
                             <script type="text/javascript">
                               var x='<?php echo $post_pdf;?>';
                                  var v=document.getElementById("pdf<?php echo $k;?>");
                               if(x.length>0)
                                   {
                                      
                                      v.style.visibility="visible";
                                   }
                                  else
                                      {
                                        v.style.visibility="hidden";
                                      }

                            </script>
                            
                            
                             <script type="text/javascript">
                               var x='<?php echo $post_image;?>';
                                  var v=document.getElementById("image<?php echo $k;?>");
                               if(x.length>0)
                                   {
                                      
                                      v.style.visibility="visible";
                                   }
                                  else
                                      {
                                        v.style.visibility="hidden";
                                      }

                            </script>
                            
                            
                            
                            <?php
                            $i++;
                            $k++;
                            }
                        }
                        echo "</table>";
                        ?>

<?php 
    if(isset($_GET['delete'])){ 
        $delete_id=$_GET['delete'];
        
        
             
    $sql1="SELECT * FROM answers WHERE a_no='$delete_id'";
    $result1= query($sql1);
    $res1=mysqli_fetch_array($result1);
    $imageName = $res1['image'];
    $pdfName = $res1['pdf'];
    $videoName = $res1['video'];
    unlink("../images/".$imageName);
    unlink("../pdf/".$pdfName);
    unlink("../videos/".$videoName);

        
        
    $sql="DELETE FROM answers WHERE a_no='$delete_id'";
    query($sql);
     header("location: view_pending_answers.php");

    set_message("<div class='alert alert-danger'>
    <strong>Danger!</strong> Delete successfull.
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


<?php 
    if(isset($_GET['accept'])){ 
        $accept_id=$_GET['accept'];
          
 $quer = "UPDATE answers SET a_a = 1 WHERE a_no = '$accept_id' ";
 query($quer);


    header("location: view_pending_answers.php");

    set_message("<div class='alert alert-info'>
    <strong>Info!</strong> Approve successfull.</div>
    
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
                   
                    </table>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include "includes/admin_footer.php" ?>