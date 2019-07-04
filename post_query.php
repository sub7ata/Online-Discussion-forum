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
            <div class="panel panel-default">
                <div class="panel-body">  
                <div class="form-group text-center">
                   <h2 style="color: #4a5f99;"> Post Query</h2>
                </div>              
                    <form accept-charset="UTF-8" action="" method="POST">
                        <div class="form-group">
                        <input type="textarea" class="form-control" name="">
                        </div>
                        <div class="form-group">
                        <textarea class="form-control counted" name="message" placeholder="Type in your message" rows="5" style="margin-bottom:10px;"></textarea>
                    </div>
                        <button class="btn btn-info pull-right" type="submit">Post Message</button>
                    </form>
                </div>
            </div>
        </div>
	</div>
</div>


<?php include("includes/footer.php") ?>