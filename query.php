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
        <div class="col-sm-10 col-sm-offset-1" id="logout">
        <div class="panel panel-white post panel-shadow">
<?php validate_post_query(); ?>
<?php display_message();  ?>
           
            <div class="comment-tabs" style="margin: 50px 50px 50px 50px;">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="#comments-logout" role="tab" data-toggle="tab">
                            <h4 class="reviews text-capitalize">Inbox</h4>
                        </a>
                    </li>
                    <li>
                        <a href="#add-comment" role="tab" data-toggle="tab">
                            <h4 class="reviews text-capitalize">Compose</h4>
                        </a>
                    </li>
<!--
                    <li>
                        <a href="#sent" role="tab" data-toggle="tab">
                            <h4 class="reviews text-capitalize">Sent</h4>
                        </a>
                    </li>
-->
                </ul>
                <div class="tab-content">

                    <div class="tab-pane active" id="comments-logout">

<?php 
$sql = "SELECT * FROM post_solution WHERE query_user_id = $post_user_id ORDER BY solution_id DESC";
$result = query($sql);
if(row_count($result)<=0) 
 {
     ?>
          <div class="col-md-8 col-md-offset-2">
             <div class='alert alert-danger text-center'><strong>Not Found !</strong></div>                                  
              </div>
<?php
} else {
$i=1;

confirm($result);
while($row =mysqli_fetch_assoc($result))
{
    $date = $row["admin_des_time"];
    $dt = date("g:i a - d/m/Y", strtotime($date));
    $query_id = $row["solution_id"];
    $status = $row["status"];
?>
                       
<!--                        <table class="table table-inbox table-hover">-->
                            <table id="mytable" class="table table-inbox table-hover">
                            <tbody>
                                <tr class="unread">
                                    <td class="view-message  dont-show">
                                    <?php echo substr($row['admin_subject'],0,10); ?>
                                    </td>
                                    
                                    <td class="view-message ">
                                    <p><?php echo substr(htmlspecialchars_decode($row['admin_description']),0,200); ?>...</p>
                                    </td>
                                    
                                    <td class="view-message  text-right">
                                    <?php echo $dt; ?>
                                    </td>
                                    
<!--                                    <td class="view-message text-right">March 15</td>-->
                                 <!--    <td class="view-message text-right"> 
                                    <a href="query_details.php?sol_id=<?php echo $query_id; ?>">View</a> 
                                    </td> -->
                                    
<td class="view-message text-right">

<?php
    if($status == 'read'){
?>
     <a style="color: #9400D3;" href="query_details.php?sol_id=<?php echo $query_id; ?>">View</a> 
<?php
    }else{
?>
 <a href="query_details.php?sol_id=<?php echo $query_id; ?>">View</a> 
 <?php
    }
?>

</td>

                                    <td class="view-message text-right"> 
                                       
                                        <a href="query.php?delete=<?php echo $query_id; ?>">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        
<?php
 $i++;
    }
}
?>
                        

                    </div>


                    <div class="tab-pane" id="add-comment">
                        <form role="form" class="form-horizontal" method="post">
<!--
                            <div class="form-group">
                                <label class="col-lg-2 control-label">To</label>
                                <div class="col-lg-10">
                                    <input type="text" placeholder="" id="inputEmail1" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Cc / Bcc</label>
                                <div class="col-lg-10">
                                    <input type="text" placeholder="" id="cc" class="form-control">
                                </div>
                            </div>
-->
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Subject</label>
                                <div class="col-lg-10">
                                    <input type="text" placeholder="" id="inputPassword1" name="subject" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Message</label> 
                                <div class="col-lg-10">
                                    <textarea rows="10" cols="30" class="form-control" id="" name="p_query"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-info pull-right" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="sent">
                        <table class="table table-inbox table-hover">
                            <tbody>
                                <tr class="unread">
<!--                                    <td class="inbox-small-cells"><i class="fa fa-star"></i></td>-->
                                    <td class="view-message  dont-show">PHPClass</td>
                                    <td class="view-message ">Added a new class: Login Class Fast Site</td>
                                    <td class="view-message  text-right">9:27 AM</td>
                                    <td class="view-message text-right">March 15</td>
                                    <td class="view-message text-right"> <a href="">View</a></td>
                                    <td class="view-message text-right">Delete</td>
                                </tr>
<!--
                                <tr class="unread">
                                    <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                    <td class="view-message dont-show">Google Webmaster </td>
                                    <td class="view-message">Improve the search presence of WebSite</td>
                                    <td class="view-message  text-right">9:27 AM</td>
                                    <td class="view-message text-right">March 15</td>
                                    <td class="view-message text-right">Delete</td>
                                </tr>
-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
   </div>
</div>

<?php
    if(isset($_GET['delete'])){
        $delete_id=$_GET['delete'];
    $sql="DELETE FROM post_solution WHERE solution_id = '$delete_id'";
    query($sql);
    header("location: query.php");
  
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