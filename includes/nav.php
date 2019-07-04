<nav class="navbar navbar-inverse navbar-fixed-top"  >
    <div class="container" >
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-3">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <!--       <a style="font-size: 20px" class="navbar-brand" href="index.php"><b>Online Discussion </b>Forum</a>-->
            <!-- <a class="navbar-brand" href="index.php"><b style="font-size:20px;color:white"> O.D.F</b></a>-->
                  <a class="navbar-brand" href="index.php"><b style="font-size:19px;color:white">Online Discussion </b>Forum</a>
        </div>



        <div class="collapse navbar-collapse" id="navbar-collapse-3">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php"><i class="fa fa-home" style="font-size:20px;"></i> Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Subject <span class="caret"></span></a>
                    <ul class="dropdown-menu">


<?php
$sql = "SELECT * FROM subjects WHERE subjects.a_s = 1 ORDER by sub_name ASC" ;
$result=(query($sql));
while($row = mysqli_fetch_array($result))
{
?>

<li><a href="subject.php?sub_id=<?php echo $row["subject_id"] ?>"><option value=" <?php echo $row["sub_name"] ?> "> <?php echo $row["sub_name"]; ?></option></a></li>


<?php 
}
?>

                    </ul>
                </li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>

            <!--Display function of Name,Username-->

<?php
if (isset($_COOKIE['email'])) {
$_SESSION['email'] = $_COOKIE['email'];
$sql = "SELECT * FROM users WHERE email ='$_COOKIE[email]'";
$result = query($sql);
confirm($result);
$row=fetch_array($result);
$post_pic=$row['profile_pic'];
$post_user_id = $row['user_id'];
}
else if (isset($_SESSION['email'])) {
$sql = "SELECT * FROM users WHERE email ='$_SESSION[email]'";
$result = query($sql);
confirm($result);
$row=fetch_array($result);
$post_pic=$row['profile_pic'];
$post_user_id = $row['user_id'];
}
?>


            <ul class="nav navbar-nav navbar-right">

                <!--Visible Before Login-->

                <?php if(!logged_in()): ?>  
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <?php endif; ?>

                <!--Visible After Login-->
                <?php if(logged_in()): ?>

                <li><a href="answer.php"><span class="glyphicon glyphicon-edit"></span> Trend</a></li>
                <li><a href="addQuestion.php"><span class="glyphicon glyphicon-edit"></span> Add Question</a></li>
                <li>
                  <span class="chat-img1 pull-right">


<?php 
if (!strlen($post_pic) < 1 || !empty($post_pic)) {
?>
  <?php echo "<a href='Profile_picture/$row[profile_pic]' target='_blank'><img src='Profile_picture/".$row["profile_pic"]."' alt=' ' id='userpic' class='img-circle' style=' width: 40px; height: 40px; margin-top: 6px;'  /></a>";?>
<?php
}
else
{
  echo "<img src='Profile_picture/user.png' alt='User' class='img-circle' style=' width: 40px; height: 40px; margin-top: 6px;'>";
} 

?>





                  
                 
                  
                  </span>
                </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">

                              <?php echo $row['username']; ?>

                              <b class="caret"></b></a>

                    <ul class="dropdown-menu">
                        <li><a href="profile.php"><i class="fa fa-fw fa-user-circle-o"></i>

                                <!-- Print Name-->
                                <?php
                                echo ucwords($row['first_name']);
                                echo " ";
                                echo ucwords($row['last_name']);
                                ?>

                                </a></li>
<!--                        <li><a href="inbox.php"><i class="fa fa-fw fa-inbox"></i> Inbox</a></li>-->
                        <li><a href="blog.php"><i class="fa fa-fw fa-address-card-o"></i> Blogs</a>
                        </li>

<?php 
$sql = "SELECT status FROM post_solution WHERE status = 'unread' AND query_user_id = $post_user_id";

$result = query($sql);
confirm($result);
    $i=0;
while($row =fetch_array($result))
{
$i++;
}
?>

                        <li><a href="query.php"><i class="fa fa-fw fa-question-circle-o"></i> Query/Inbox: <span class="badge badge-light" style="background-color: red;"><?php echo $i; ?></span></a>
                        </li>
                         <li><a href="account_setting.php"><i class="fa fa-fw fa-gear"></i> Account Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><span class="fa fa-fw fa-power-off"></span> Log Out</a></li>
                    </ul>
                </li>
                <?php endif; ?>

                <!--Search-->
                <li>
                    <a class="btn btn-default btn-outline btn-circle" data-toggle="collapse" href="#nav-collapse3" aria-expanded="false" aria-controls="nav-collapse3">Search</a>
                </li>
            </ul>
            <div class="collapse nav navbar-nav nav-collapse" id="nav-collapse3" >
                <form class="navbar-form navbar-right" role="search" method="post" action="search.php">
                    <div class="form-group">
                        <input name="search" type="text" class="form-control" placeholder="Search" />
                    </div>
                    <button name="submit" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-search"  aria-hidden="true"></span></button>
                </form>
            </div>
        </div>
    </div>
</nav> 


<?php if(logged_in()): ?>
<?php 
 $sqlblock = "SELECT * FROM users WHERE user_id = '$post_user_id'";
    $resultblock = query($sqlblock);
    confirm($resultblock);
    $rowblock=fetch_array($resultblock);
    $approve = $rowblock["approve"];

    if ($approve == 0) {
    unset($_SESSION['email']); 
    unset($_COOKIE['email']);
    }else{

    }

 ?>
   <?php endif; ?>


<script type="text/javascript">
var x='<?php echo $post_pic;?>';
var v=document.getElementById("userpic");
    if(x.length>0)
    {
        v.style.visibility="visible";
    }
    else
    {
        v.style.visibility="hidden";
    }
</script>