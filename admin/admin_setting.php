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
                    <small>
                    <p class="text-center">Use the form below to change your password. Your password cannot be the same as your name.</p>
                    </small>
                    </h1>

<?php display_message(); ?>
<?php validate_adminChangePassword();?>
                    
                    <div class="col-sm-6 col-sm-offset-3" style="margin-bottom: 140px;">
                        <div class="panel-group">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <br><br>
                                </div>
                                <div class="panel-body">
                                    <form method="post" id="passwordForm">
                                        <div class="form-group">
                                            <input type="password" class="input-lg form-control" name="curnt_pass" id="curnt_pass" placeholder="Current Password" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="input-lg form-control" name="new_pass" id="new_pass" placeholder="New Password" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="input-lg form-control" name="repeat_pass" id="repeat_pass" placeholder="Repeat Password" autocomplete="off">
                                        </div>
                                        <div class="row">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Changing Password..." name="submit" value="Change Password">
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="text-center">
                                            <a href="recover.php" tabindex="5" class="forgot-password" style="color:#8B0000;">Forgot Password?</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php include "includes/admin_footer.php" ?>