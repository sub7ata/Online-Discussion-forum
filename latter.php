 <?php include("includes/header.php") ?>
 <?php

  	if(logged_in()){

  	} else {

  		redirect("login.php");
  	}

?>
<?php include("includes/nav.php") ?>



<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-white post panel-shadow">
              <div class="row">
              <div class="col-md-8 col-md-offset-2" >
                <br>
              <div class="well">
              
<!--                  <h2 style="color:royalblue;">Update Profile</h2>-->

<div style="margin-top:50px;">
    <div>
      <p>September 1,2018</p>
    </div>
    <div >
      <p>Dear Mr. / Mrs. </p>
    </div>
   <!--  <small>From admin</small>
    <small class="pull-right">Date</small> -->
</div>      
               <div class="text-center">
               <div style="margin-bottom:100px; margin-top: 20px; text-align:justify;">
                   I was so excited to hear about the XXX position at Fairygodboss because as an XXX major, I spend a lot of time thinking about unconscious bias, gender roles, and diversity efforts in the workforce. Specifically, I'm interested in Fairygodboss because there's so much potential to alter women's career paths and happiness. Transparency is so important, and this mission aligns with my view of an ideal world.

I'm great at bringing 0 to X. In my last role, I owned and launched three major public-private partnerships ($XXXM each): XXXX, XXXX, XXXX. In each city, these hubs were a one-stop shop for all the tech and startup information. It was my job to understand each city's startup ecosystem and communicate and convey the information externally.

As the sole non-developer, I worked on both strategy and execution, specifically on the cross section of content, user acquisition, marketing, business development, community, and product.

My resume is attached, and I’m happy to send over any additional information you might need. Thank you for your consideration!

<div class="pull-right" style="margin-top: 50px;">
  <p><b>Sincerely,</b> <br>Online Discussion Forum</p>

</div> 
               </div>
              </div>
               
<!-- <a href="query.php" class="pull-left" style="font-size: 20px; margin-bottom:50px;">Back</a> -->
                </div>

<a href="query.php" class="btn btn-primary btn-circle pull-right" role="button" style="margin-bottom: 30px;"><i class="fa fa-arrow-left" aria-hidden="true"> Back </i></a>

               </div>
             </div>
            </div>
        </div>
    </div>
</div>



<?php include("includes/footer.php") ?>