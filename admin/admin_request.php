<?php include("includes/admin_header.php") ?>
<?php 
    if (admin_logged_in()) {
        redirect("index.php");
    }

 ?>
<?php include("includes/admin_navigation.php") ?>

<div class="row">
    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

<?php display_message(); ?>
<?php validate_Request(); ?>

            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Request to Admin</div>
                    <div style="float:right; font-size: 100%; position: relative; top:-10px"><a href="admin_register.php">Register</a></div>
                </div>
                <div style="padding-top:30px" class="panel-body">
                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                    <form id="signupform" class="form-horizontal" role="form" method="post" role="form" style="display: block;">
                        <div class="alert alert-error"></div>
                        
                        <div id="signupalert" style="display:none" class="alert alert-danger">
                            <p><?=$_SESSION['message']?></p>
                            <span></span>
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="col-md-3 control-label">First Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-md-3 control-label">Last Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-3 control-label">Email</label>
                            <div class="col-md-9">
                                <input type="email" id="email" class="form-control" name="admin_email" placeholder="Email Address" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="col-md-3 control-label">Edu-credential</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="qualification"              name="qualification" placeholder="Education credential" required="required">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <!-- Button -->
                            <div class="col-md-offset-3 col-md-9">
                                <button id="btn-signup" type="submit" class="btn btn-info pull-right"><i class="icon-hand-right"></i>Submit</button>
                                <span style="margin-left:8px;"></span>
                            </div>
                        </div>
                        <div style="border-top: 1px solid #999; padding-top:20px" class="form-group">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/admin_footer.php") ?>