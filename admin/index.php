<?php include "includes/admin_header.php";?>

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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                    Welcome to admin
                    <small>
                             <small><?php
    echo ucwords($row['first_name']);
    echo " ";
    echo ucwords($row['last_name']);
?></small>
                    </small>
<small class="pull-right" style="color: #000000; margin-top: 15px; text-align: center;">
<?php
    date_default_timezone_set('Asia/Calcutta'); 
    echo date('D M d, Y G:i a');   
?>
</small>
                    </h1>
                </div>
            </div>
            <div class="row">
 <?php display_message(); ?>
 
 <!-- subject -->

<?php
$sqlSub = "SELECT subject_id FROM subjects WHERE a_s = 1 ";

$resultSub = query($sqlSub);
confirm($resultSub);
    $iSub=0;
while($rowSub = fetch_array($resultSub))
{
$iSub++;
}
?>

<?php
$sqlQuestionSub = "SELECT subject_id FROM subjects WHERE a_s = 0 ";

$resultQuestionSub = query($sqlQuestionSub);
confirm($resultQuestionSub);
    $iqSub=0;
while($rowQuestionSub =fetch_array($resultQuestionSub))
{
$iqSub++;
}
?>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <!-- <i class="fa fa-file-text fa-5x"></i> -->
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><small>Verified Subjects: <?php echo $iSub; ?></small></div>
                                    <div><small>Not Verified Subjects: <?php echo $iqSub; ?></small></div>
                                </div>
                            </div>
                        </div>
                        <a href="view_approved_subjects.php">
                            <div class="panel-footer">
                                <span class="pull-left">View available subjects</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
 <!-- end -->

<?php
$sql = "SELECT q_no FROM questions WHERE user_approve = 1 AND a_s = 1 AND a_q = 1";

$result = query($sql);
confirm($result);
    $i=0;
while($row =fetch_array($result))
{
$i++;
}
?>

<?php
$sqlQuestion = "SELECT q_no FROM questions WHERE user_approve = 0 OR a_s = 0 OR a_q = 0";

$resultQuestion = query($sqlQuestion);
confirm($resultQuestion);
    $iq=0;
while($rowQuestion =fetch_array($resultQuestion))
{
$iq++;
}
?>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <!-- <i class="fa fa-file-text fa-5x"></i> -->
                                    <i class="fa fa-question fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><small>Verified Questions: <?php echo $i; ?></small></div>
                                    <div><small>Not Verified Questions: <?php echo $iq; ?></small></div>
                                </div>
                            </div>
                        </div>
                        <a href="view_approved_questions.php">
                            <div class="panel-footer">
                                <span class="pull-left">View available questions</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>



<?php
$sqlans = "SELECT a_no FROM answers WHERE user_approve = 1 AND  a_a = 1 AND a_s = 1 AND a_q = 1 ";

$resultans = query($sqlans);
confirm($resultans);
    $k=0;
while($rowans = fetch_array($resultans))
{
$k++;
}
?>

<?php
$sqlansBlock = "SELECT a_no FROM answers WHERE user_approve = 0 OR  a_a = 0 OR a_s = 0 OR a_q = 0 ";

$resultansBlock = query($sqlansBlock);
confirm($resultansBlock);
    $kp=0;
while($rowansBlock = fetch_array($resultansBlock))
{
$kp++;
}
?>


                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><small>Verified Answers: <?php echo $k; ?></small></div>
                                    <div><small>Not Verified Answers: <?php echo $kp; ?></small></div>
                                </div>
                            </div>
                        </div>
                        <a href="view_approved_answers.php">
                            <div class="panel-footer">
                                <span class="pull-left">View available answers</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>



<?php
$sqluser = "SELECT user_id FROM users WHERE approve = 1 AND active = 1";

$resultuser = query($sqluser);
confirm($resultuser);
    $u=0;
while($rowuser = fetch_array($resultuser))
{
$u++;
}
?>


<?php
$sqlBlockUser = "SELECT user_id FROM users WHERE approve = 0 OR active = 0";

$resultBlockUser = query($sqlBlockUser);
confirm($resultBlockUser);
    $pu=0;
while($rowUserBlock = fetch_array($resultBlockUser))
{
$pu++;
}
?>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><small>Verified Users: <?php echo $u; ?></small></div>
                                    <div><small>Not verified Users: <?php echo $pu; ?></small></div>
                                </div>
                            </div>
                        </div>
                        <a href="view_approved_users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View available users</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
<?php
$sqladmin = "SELECT admin_id FROM admin WHERE approve = 1 AND active = 1";

$resultadmin = query($sqladmin);
confirm($resultadmin);
    $a=0;
while($rowuser = fetch_array($resultadmin))
{
$a++;
}
?>

<?php
$sqladmina = "SELECT admin_id FROM admin WHERE approve = 0 OR active = 0";

$resultadmina = query($sqladmina);
confirm($resultadmina);
    $aa=0;
while($rowusera = fetch_array($resultadmina))
{
$aa++;
}
?>

 <div class="col-md-3 col-md-offset-3">
                <!-- <div class="col-lg-3 col-md-6"> -->
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   <!--  <i class="fa fa-list fa-5x"></i> -->
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><small>Verified Admins: <?php echo $a; ?></small></div>
                                    <div><small>Not Verified Admins: <?php echo $aa; ?></small></div>
                                </div>
                            </div>
                        </div>
                        <a href="view_approved_admin.php">
                            <div class="panel-footer">
                                <span class="pull-left">View available admin</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

<?php 

$sqlMess = "SELECT message_id FROM messages ";
$resultMess = query($sqlMess);
confirm($resultMess);
$num = 0;
while($rowMess = fetch_array($resultMess))
{
$num++;
}

?>

<div class="col-md-3 ">
                <!-- <div class="col-lg-3 col-md-6"> -->
                    <div class="panel panel-primary" >
                        <div class="panel-heading" style="color: white;" >
                            <div class="row">
                                <div class="col-xs-3">
                                   <!--  <i class="fa fa-list fa-5x"></i> -->
                                    <i class="fa fa-envelope-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><small>Public request: <?php echo $num; ?></small></div>
                                </div>
                            </div>
                        </div>
                        <a href="view_public_contact.php">
                            <div class="panel-footer">
                                <span class="pull-left">View public message</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

<!-- </div> -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
    <?php include "includes/admin_footer.php" ?>
