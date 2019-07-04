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
                <div class="text-center">
                  <h2 style="color:royalblue;">Update Profile</h2>
                </div>

                <?php display_message(); ?>
                <?php validate_accountSetting(); ?>
<?php 

if (isset($_SESSION['email']))
$sql = "SELECT * FROM users WHERE email ='$_SESSION[email]'";
$result = query($sql);
confirm($result);
$row=fetch_array($result);

 ?>
                <!-- <div class="well" style="background-color:White;"> -->
                <div class="panel panel-primary" >
                  <div class="panel-body ">
                                
                  <form role="form" action="account_setting.php"  method="post" class="form-horizontal" id="submit_form" enctype="multipart/form-data">
                    <!-- <form method="post" id="submit_form" action="" enctype="multipart/form-data"> -->
                      <div class="form-group">
                      <label for="avatar" class="col-sm-2 control-label">
                        <?php  echo $row['username'];?>
                      </label>
                          <!-- <div class="col-sm-10">
                              <div class="custom-input-file">
                                  <label class="uploadPhoto">
                                      <img src="Profile_picture/user.png" alt="User" class="img-circle" style=" width: 140px; height: 140px;">
                                         
                                      <input type="file" class="change-avatar" class="form-control" name="user_pic" id="user_pic" accept="image/png, image/jpeg, image/gif" style="display: none;">
                                   </label>
                              </div>
                          </div> -->
<div class=" col-md-6 ">  
 <!-- image-preview-filename input [CUT FROM HERE]-->
            <div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Browse</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="user_pic"/> <!-- rename it -->
                    </div>
                </span>
            </div><!-- /input-group image-preview [TO HERE]--> 
</div>
                      </div> 

                      <div class="form-group">
                          <label for="name" class="col-sm-2 control-label">Registered Userame</label>
                          <div class="col-sm-10">
                            <!-- <input type="text" class="form-control" name="name" class="form-control" id="name" > -->
                              <b style="color:#02225a;"> <?php echo $row['username']; ?> </b>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="nickName" class="col-sm-2 control-label">Registered Name</label>
                          <div class="col-sm-10">
                            <b style="color:#02225a;">
                            <?php
                            echo ucwords($row['first_name']);
                            echo " ";
                            echo ucwords($row['last_name']);
                            ?>
                          </b>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="email" class="col-sm-2 control-label">Registered Email</label>
                          <div class="col-sm-10">
                            <!-- <input type="email" class="form-control" name="email" class="form-control" id="email" > -->
                            <b style="color:#02225a;"><?php echo $row['email']; ?></b>
                          </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-sm-2 control-label">Add education credential</label>
                            <div class="col-sm-10">
                          <select id="education" name="education" class="form-control">
                          <option value="0" selected="">-----------:Select  Quolification:------------</option>
                          <li><option  value="B.Sc">B.Sc</option></li>
                          <li><option  value="B.C.A">B.C.A</option></li>
                          <li><option  value="M.Sc">M.Sc</option></li>
                          <li><option  value="M.C.A">M.C.A</option></li>
                          <li><option  value="B.tech">B.tech</option></li>
                          </select>
                      </div>
                      </div>

                      <div class="form-group">
                          <label  class="col-sm-2 control-label">Add employment credential</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="emp" id="emp" placeholder="Enter employment credential" >
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-2 control-label">Address</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="add"  id="add" placeholder="Enter address">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-2 control-label">Enter password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control"  name="password" id="password" >
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                              <button class="btn btn-primary btn-circle pull-right" type="submit" id="submit" value="Go!">Update</button>
                              <a href="setting.php" class="btn btn-primary btn-circle">Change password</a>
                          </div>
                      </div>

                  </form>

                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                  </div>
              </div>
          </div>
      </div>
</div>
</div>

<style type="text/css">
/*  .container{
    margin-top:20px;
}*/
.image-preview-input {
    position: relative;
    overflow: hidden;
    margin: 0px;    
    color: #333;
    background-color: #fff;
    border-color: #ccc;    
}
.image-preview-input input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  padding: 0;
  font-size: 20px;
  cursor: pointer;
  opacity: 0;
  filter: alpha(opacity=0);
}
.image-preview-input-title {
    margin-left:2px;
}
</style>

<script type="text/javascript">
  $(document).on('click', '#close-preview', function(){ 
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
        }, 
         function () {
           $('.image-preview').popover('hide');
        }
    );    
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        
        reader.readAsDataURL(file);
    });  
});
</script>

<?php include("includes/footer.php") ?>
