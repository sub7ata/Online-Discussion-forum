
<?php include("includes/header.php") ?>

<?php

    if(logged_in()){
        
    } else {

        redirect("login.php");
    }

     ?> 

<?php include("includes/nav.php") ?>
<?php 
    if(isset($_GET['delete'])){  
        $delete_id=$_GET['delete'];
        
        
        
             
    $sql="DELETE FROM discussion WHERE discussion_id = '$delete_id'";
    query($sql);
    // $res1=mysqli_fetch_array($result1);
    // $imageName = $res1['image'];
    // $pdfName = $res1['pdf'];
    // $videoName = $res1['video'];
    // unlink("../images/".$imageName);
    // unlink("../pdf/".$pdfName);
    // unlink("../videos/".$videoName);

    
      header("location: index.php");

    set_message("<div class='alert alert-danger'>
    <strong>Danger!</strong> Delete successfull.
    </div>

    <script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
    }, 2000);
    </script>
    ");
   }
  ?>

  <?php include("includes/footer.php") ?>