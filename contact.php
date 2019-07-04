<?php include("includes/header.php") ?>

<?php include("includes/nav.php") ?>

   <div class="row">
   
   
    
   <hr>
    <div class="container-fluid">  


<?php display_message();?>
<?php validate_contact(); ?> 

    <div class="col-md-7">
      
        <div class="form-area">
            <form role="form" method="post" action="">
                <br style="clear:both">
                <h1> <span class="glyphicon glyphicon-comment"></span> Message </h1>
                <hr>
                <div class="form-group">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="mobile" name="mobile_no" placeholder="Mobile Number" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                </div>
                <div class="form-group">
                   
                 <textarea name="message" id="message" class="form-control" rows="9" cols="25" placeholder="Please enter your question.."></textarea>

<!--                    <textarea class="form-control" type="textarea" id="message" name="message" placeholder="How can we help you?" maxlength="140" rows="7" required></textarea>-->
                    <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>
                </div>

                <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right" value="Go!">Send </button>
            </form>
 
        </div>
    </div>
    
        <div class="col-md-5">
      
        <div class="form-area">
        <br style="clear:both">     
            <form role="form">
            <h1> <span class="glyphicon glyphicon-globe"></span> Our office</h1>
            <hr>

            <address><span class="glyphicons glyphicons-group-chat"></span>Jemua Road, Fuljhore, Durgapur, West Bengal 713206</address>
            <p><i class="glyphicon glyphicon-envelope"></i> Email:-mr.subrata.15@gmail.com</p>
            <p><i class="fa fa-facebook-square" aria-hidden="true"></i> facebook:- https://www.facebook.com/Hi.I.am.Subrata</p>
            <p><span class="glyphicon glyphicon-phone"></span> Mobile:- +91 9932311891 / +91 9932259291</p>
            <p><i class="fa fa-whatsapp" aria-hidden="true"> WhatsApp:- +91 9932311891</i></p>
            </form>
        </div>
    </div>

   
</div>
</div>

<?php include("includes/footer.php") ?>