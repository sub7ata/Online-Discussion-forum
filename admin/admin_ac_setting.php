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
          <div class="panel panel-white post panel-shadow">
            <div class="row">
              <div class="col-md-8 col-md-offset-2" >
                <div class="text-center">
                  <h2 style="color:royalblue;">Update Profile</h2>
                </div>

<?php display_message(); ?>
<?php validate_admin_ac_Setting(); ?>

                <div class="well" style="background-color:White;">
                  
                  <form role="form" action="admin_ac_setting.php"  method="post" class="form-horizontal" id="submit_form" enctype="multipart/form-data">
                    
                    <div class="form-group">
                      <label for="avatar" class="col-sm-2 control-label">
                        
                      </label>
                       <div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename"> <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Choose pdf</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="user_pic"/> <!-- rename it -->
                    </div>
                </span>
                
            </div>
                      
                      
<!--
                      <div class="col-sm-10">
                        <div class="custom-input-file">
                          <label class="uploadPhoto">
                            <img src="images/ProfilePicture/user.png" alt="User" class="img-circle" style=" width: 140px; height: 140px;">
                             Edit
                            <input type="file" class="change-avatar" class="form-control" name="user_pic" id="user_pic"  style="display: none;">
                          </label>
                        </div>
                      </div>
-->
                   

                   
                   
                   
                   
                   
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
                        
                        <b style="color:#02225a;"><?php echo $row['admin_email']; ?></b>
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
                        <a href="admin_setting.php" class="btn btn-primary btn-circle pull-left">Change password</a>
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
    
    
    
<style type="text/css">
  .container{
    /*margin-top:20px;*/
}
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
        }        
        reader.readAsDataURL(file);
    });  
});
</script>
    
    
    <?php include "includes/admin_footer.php" ?>