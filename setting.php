<?php include("includes/header.php") ?>

<?php

  	if(logged_in()){

  	} else {

  		redirect("login.php");
  	}

?>

<?php include("includes/nav.php") ?>
<div class="container">
    <div class="col-sm-6 col-sm-offset-3">


<?php display_message();  ?>
<?php validate_changePassword(); ?>





        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <p class="text-center">Use the form below to change your password. Your password cannot be the same as your username.</p>
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



<?php include("includes/footer.php") ?>
