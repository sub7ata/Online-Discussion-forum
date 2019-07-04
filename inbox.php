<?php include("includes/header.php") ?>
<?php

  	if(logged_in()){

  	} else {

  		redirect("login.php");
  	}

?>
<?php include("includes/nav.php") ?>

<div class="tab-content">
               <div class="tab-pane fade in active" id="home">
                   <div class="list-group">
                       <a href="#" class="list-group-item">
                           <div class="checkbox">
                               <label>
                                   <input type="checkbox">
                               </label>
                           </div>
                           <span class="glyphicon glyphicon-star-empty"></span><span class="name" style="min-width: 120px;
                               display: inline-block;">Bhaumik Patel</span> <span class="">This is big title</span>
                           <span class="text-muted" style="font-size: 11px;">- Hi hello how r u ?</span> <span
                               class="badge">12:10 AM</span> <span class="pull-right"><span class="glyphicon glyphicon-paperclip">
                               </span></span></a><a href="#" class="list-group-item">
                                   <div class="checkbox">
                                       <label>
                                           <input type="checkbox">
                                       </label>
                                   </div>
                                   <span class="glyphicon glyphicon-star-empty"></span><span class="name" style="min-width: 120px;
                                       display: inline-block;">Bhaumik Patel</span> <span class="">This is big title</span>
                                   <span class="text-muted" style="font-size: 11px;">- Hi hello how r u ?</span> <span
                                       class="badge">12:10 AM</span> <span class="pull-right"><span class="glyphicon glyphicon-paperclip">
                                       </span></span></a><a href="#" class="list-group-item read">
                                           <div class="checkbox">
                                               <label>
                                                   <input type="checkbox">
                                               </label>
                                           </div>
                                           <span class="glyphicon glyphicon-star"></span><span class="name" style="min-width: 120px;
                                               display: inline-block;">Bhaumik Patel</span> <span class="">This is big title</span>
                                           <span class="text-muted" style="font-size: 11px;">- Hi hello how r u ?</span> <span
                                               class="badge">12:10 AM</span> <span class="pull-right"><span class="glyphicon glyphicon-paperclip">
                                               </span></span></a>
                   </div>
               </div>
               <div class="tab-pane fade in" id="profile">
                   <div class="list-group">
                       <div class="list-group-item">
                           <span class="text-center">This tab is empty.</span>
                       </div>
                   </div>
               </div>
               <div class="tab-pane fade in" id="messages">
                   ...</div>
               <div class="tab-pane fade in" id="settings">
                   This tab is empty.</div>
           </div>
           
           <?php include("includes/footer.php") ?>
