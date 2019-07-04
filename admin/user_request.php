<?php include "includes/admin_header.php" ?>

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
                    <h1 class="page-header">

                   <div class="text-center">
                    User Message
                   </div>
                 </h1>

                  <?php display_message(); ?>
<?php
    $sql = "SELECT * FROM post_query ORDER BY query_id DESC";
    $result=(query($sql));
   

if(row_count($result)<=0) 
 {
     ?>
          <div class="col-md-8 col-md-offset-2">
             <div class='alert alert-danger text-center'><strong>Not Found !</strong></div>                                  
              </div>
<?php
} else {

    ?>

                    <div class="table-responsive">
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                                <th>SL.No</th>
                                <th>Subject</th>
                                <th>Description</th>
                                <th>From</th>
                                <th>Date</th>
                                <!-- <th>Response</th> -->
                                <th>Delete</th>
                                <th>Send Message</th>
                                <th>View</th>
                            </thead>
                            <?php
                            $i=1;
                            while($row =fetch_array($result))
                            {
                            	$query_id = $row["query_id"];
                                $user_id = $row["user_des_id"];
                                $date = $row["user_des_time"];
                                $dt = date("g:i a - d/m/Y", strtotime($date));
                                $response = $row["response"];
                                $status = $row["status"];
                            ?>
                            <tr class="<?php if(isset($classname)) echo $classname;?>">
                                <td>
                                    <?php echo $i ;?>
                                </td>

                                <td>
                                    <?php echo $row["user_subject"]; ?>
                                </td>
                                <td >
                                    <p><?php echo substr(htmlspecialchars_decode($row['user_description']),0,200); ?>...</p>  
                                </td>
            
								<td>
<?php

$sqlUser = "SELECT * FROM users WHERE user_id = $user_id";
$resultUser = query($sqlUser);
confirm($resultUser);
$rowUser=fetch_array($resultUser);

?>

<?php
    echo ucwords($rowUser['first_name']);
    echo " ";
    echo ucwords($rowUser['last_name']);
?>
<br>
<?php echo $rowUser["email"]; ?>
								</td>


                                <td>
                                    <?php echo $dt; ?>
                                </td>

                               <!--  <td>
                                    <?php
                                        if($response == 1){
?>
<div class="text-center"><i class="fa fa-circle" style="font-size:25px;color:green;"></i></div>
<?php
                                        }else{
?>
<div class="text-center"><i class="fa fa-circle" style="font-size:26px;color:red"></i></div>
<?php
                                        }
                                    ?>
                                </td> -->

                                <td>
                                    <a href="user_request.php?delete=<?php echo $query_id?>"
                                    onclick="return confirm('Are you sure ?')"> <p data-placement="top" data-toggle="tooltip" title="delete"><button class="btn btn-danger btn-xs" data-title="delete" data-toggle="modal" type="delete" data-target="#delete"><span class="glyphicon glyphicon-trash"></span></button></p></a>
                                </td> 

                             <!--    <td>

                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" onclick="fun(<?php echo $query_id;?>);func(<?php echo $user_id;?>);" ><span class="glyphicon glyphicon-envelope"></span></button>

                                </td> -->


<td>
<?php
    if($response == 1){
?>

<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" onclick="fun(<?php echo $query_id;?>);func(<?php echo $user_id;?>);" ><span class="fa fa-envelope-o" aria-hidden="true""></span></button>

<?php
    }else{
?>

<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" onclick="fun(<?php echo $query_id;?>);func(<?php echo $user_id;?>);" ><span class="fa fa-envelope-o" aria-hidden="true"></span></button>

<?php
    }
?>
</td>


<td class="view-message text-right">

<?php
    if($status == 'read'){
?>
    <a style="color: #9400D3;" href="admin_post_query_details.php?query_id=<?php echo $query_id; ?>">View</a>
<?php
    }else{
?>
    <a href="admin_post_query_details.php?query_id=<?php echo $query_id; ?>">View</a>
 <?php
    }
?>

</td>
                            </tr>
                            <?php
                            $i++;
                            }
                            }
                        echo "</table>";
                        ?>

<?php
    if(isset($_GET['delete'])){
        $delete_id=$_GET['delete'];
    $sql="DELETE FROM post_query WHERE query_id = '$delete_id'";
    query($sql);
    header("location: user_request.php");
  
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
                    </table>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- send message -->
 <?php validate_UserMess(); ?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">

                <form method="POST">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Subject:</label>
                        <input type="text" class="form-control" name="sub_name" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" name="mess_name" id="message-text"></textarea>
                    </div>
                    <input type="hidden" name="query_id" value="" id="query_id_input">
                    <input type="hidden" name="user_id" value="" id="user_id_input">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        
        
        
        
    </div>
</div>


<script type="text/javascript">

    function fun(p)
    {
        document.getElementById('query_id_input').value=p;
         
    }
    
     function func(q)
    {
         document.getElementById('user_id_input').value=q;
    }
   
</script>

  <?php include "includes/admin_footer.php" ?>