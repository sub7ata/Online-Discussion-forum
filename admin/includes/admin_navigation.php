<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">ODF Admin</a>
    </div>
    <ul class="nav navbar-right top-nav">

  <?php
if (isset($_SESSION['admin_email'])) {   
    
$sql = "SELECT * FROM admin WHERE admin_email='$_SESSION[admin_email]'";
$result = query($sql);
confirm($result);
$row=fetch_array($result); 
$post_pic=$row['admin_pic'];
}elseif(isset($_COOKIE['admin_email'])){
$_SESSION['admin_email']=$_COOKIE['admin_email'];
$sql = "SELECT * FROM admin WHERE admin_email='$_SESSION[admin_email]'";
$result = query($sql);
confirm($result);
$row=fetch_array($result); 
$post_pic=$row['admin_pic'];

}
?>
 
<meta http-equiv="refresh" content="15" >

<?php if(admin_logged_in()): ?>

<!-- <li>
            <a href="">Users Online: <span class="usersonline">
            <meta http-equiv="refresh" content="15" >


<?php
$sqlStatus = "SELECT online FROM users WHERE online = 1 ";

$resultStatus = query($sqlStatus);
confirm($resultStatus);
    $i=0;
while($rowStatus =fetch_array($resultStatus))
{
$i++;
}
?>
        <span class="badge badge-light" style="background-color: red;"><?php echo "$i";?></span>

        </span></a></li> -->
        <!-- <li><a href="../index.php">HOME SITE</a></li> -->


<?php
$sqlInbox = "SELECT status FROM post_query WHERE status = 'unread'";

$resultInbox = query($sqlInbox);
confirm($resultInbox);
    $j=0;
while($rowInbox =fetch_array($resultInbox))
{
$j++;
}
?>



 <li><a href="user_request.php"><i class="fa fa-inbox"></i> Inbox: <span class="badge badge-light" style="background-color: red;" ><?php echo $j; ?></span></a></li>

<script type="text/javascript">
    var old_count = 0;

setInterval(function(){    
    $.ajax({
        type : "POST",
        url : "file.php",
        success : function(data){
            if (data > old_count) {
                alert('new record on i_case');
                old_count = data;
            }
        }
    });
},1000);
</script>

        <!--   <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li> -->

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
<?php
    echo ucwords($row['first_name']);
    echo " ";
    echo ucwords($row['last_name']);
?>

            <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>

                    <a href="admin_ac_setting.php"><i class="fa fa-fw fa-gear"></i> Setting</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="admin_logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
 
    </ul>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>



<!-- Subject dropdown -->

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#subject_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Subjects <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="subject_dropdown" class="collapse">
                    <li>
                        <a href="view_approved_subjects.php"><i class="glyphicon glyphicon-ok"></i> Subjects</a>
                    </li>
                    <li>
                        <a href="view_pending_subjects.php"><i class="glyphicon glyphicon-ban-circle"></i> Block Subjects</a>
                    </li>
                    <li>
                        <a href="admin_add_subject.php"><i class="glyphicon glyphicon-plus"></i> Add Subject</a>
                    </li>
                </ul>
            </li>



<!-- Question Dropdown -->
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa fa-question"></i> Questions <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="view_approved_questions.php"><i class="glyphicon glyphicon-ok"></i> Verified Questions</a>
                    </li>
                    <li>
                        <a href="view_pending_questions.php"><i class="glyphicon glyphicon-remove"></i> Not Verified Questions</a>
                    </li>
                </ul>
            </li>

<li>
    <a href="javascript:;" data-toggle="collapse" data-target="#ans_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Answers <i class="fa fa-fw fa-caret-down"></i></a>
    <ul id="ans_dropdown" class="collapse">
        <li>
            <a href="view_approved_answers.php"><i class="glyphicon glyphicon-ok"></i> Verified Answers</a>
        </li>
        <li>
            <a href="view_pending_answers.php"><i class="glyphicon glyphicon-remove"></i> Not Verified Answers</a>
        </li>
    </ul>
</li>

          <!--   <li>
                <a href="view_all_questions.php"><i class="fa fa-fw fa-file"></i> View all questions</a>
            </li> -->


           <!--  <li>
                <a href="view_all_answers.php"><i class="fa fa-fw fa-file"></i> Answers</a>
            </li>
 -->
          <!--   <li>
                <a href="./categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
            </li> -->


            <!-- <li>
                <a href="view_all_admins.php"><i class="fa fa-fw fa-user"></i> View all Admins</a>
            </li> -->

          

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa fa-users"></i> Manage User<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="view_approved_users.php"><i class="glyphicon glyphicon-ok"></i> Verified Users</a>
                    </li>
                    <li>
                        <a href="view_pending_user.php"><i class="glyphicon glyphicon-remove"></i> Not Verified Users</a>
                    </li>
                </ul>
            </li>

            <li class="">
                <a href="view_public_contact.php"><i class="fa-fw fa fa-tty"></i> Contact info</a>
            </li>

              <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i class="fa fa-fw fa-arrows-v"></i> Manage Admin<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo1" class="collapse">
                    <li>
                        <a href="view_approved_admin.php"><i class="glyphicon glyphicon-ok"></i> Admins</a>
                    </li>
                    <li>
                    <a href="view_pending_admin.php"><i class="glyphicon glyphicon-ban-circle"></i> Admins (Block)</a>
                    </li>
                      <li>
                    <a href="view_admin_request.php"><i class="glyphicon glyphicon-sort-by-attributes-alt"></i> Admins (Request)</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="admin_profile.php"><i class="fa fa-fw fa-user-md"></i> Profile</a>
            </li>
        </ul>
    </div>
    <?php endif; ?>
</nav>
