<?php

/*******************-----helper function-----********************/

function clean($string){

	return htmlentities($string); 
}

function redirect($location){

	return header("Location:{$location}");
}

function set_message($message) {

	if(!empty($message )){

	$_SESSION['message'] = $message;
	}else{

	$message="";

	}
}

function display_message(){

	if(isset($_SESSION['message'])){

	echo $_SESSION['message'];

	unset($_SESSION['message']);
	}
}


function token_generator(){

	$token= $_SESSION['token'] = md5 (uniqid(mt_rand(),true));

	return $token;
}


function validation_errors($error_message)
{

$error_message = <<<DELIMITER

<div class="alert alert-danger alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
	</button>
	<strong>Warning!</strong> $error_message;
</div>
<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 5000);
</script>
DELIMITER;

return $error_message;
}

/***************Admin email exists function*******************/


function adminRequest_email_exists($admin_email) {

	$sql="SELECT admin_id FROM admin_request WHERE admin_email = '$admin_email'";

	$result = query($sql);

if(row_count($result) == 1) {

	return true;

}else{

	return false;
	}

}



function admin_email_exists($admin_email) {

	$sql1="SELECT admin_id FROM admin WHERE admin_email = '$admin_email'";

	$result1 = query($sql1);

if(row_count($result1) == 1) {

	return true;

}else{

	return false;
	}

}


function send_email($email,$subject,$msg, $headers ){

	return mail($email, $subject, $msg, $headers);

}


function validEmail($email){
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }
    // Split it into sections to make life easier
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
        if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
            return false;
        }
    }
    if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
            return false; // Not enough parts to domain
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                return false;
            }
        }
    }

    return true;
}






/*********************----Admin Invitation_code Request Validation----***************************/

function validate_Request(){

	$errors=[];
	$min = 3;
	$max = 20;

if($_SERVER['REQUEST_METHOD']=="POST"){

	$first_name	     =clean($_POST['first_name']);
	$last_name	     =clean($_POST['last_name']);
    $admin_email	 =clean($_POST['admin_email']);
    $qualification	 =clean($_POST['qualification']);


if(admin_email_exists($admin_email)){

	$errors[]="Sorry that email already is registered";
}


if(adminRequest_email_exists($admin_email)){

	$errors[]="Sorry this email already requested";
}

if(!preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/",$admin_email)) {
	$errors[]="Invalid email address";
}

if(validEmail($admin_email)){
	$errors[]="Invalid email address";
}

     //First Name validation


if(strlen($admin_email)<$min) {

	$errors[]="Your email cannot be less than {$min} characters";
}


if(strlen($first_name) < $min){

	$errors[] = "Your first name cannot be less than {$min} characters";

}


if(strlen($first_name) > $max){

	$errors[] = "Your first name cannot be more than {$max} characters";

}

    if(!preg_match("/[a-zA-Z'-]/",$first_name)) {
    $errors[]="Invalid first name";
}


    //Last Name validation

if(strlen($last_name) < $min){

	$errors[] = "Your last name cannot be less than {$min} characters";

}


if(strlen($last_name) > $max){

$errors[] = "Your last name cannot be more than {$max} characters";

}

     if(!preg_match("/[a-zA-Z'-]/",$last_name)) {
    $errors[]="Invalid last name";
     }


 // Education
 //
if(strlen($qualification) < $min){

	$errors[] = "Your Education credential cannot be less than {$min} characters";

}


if(strlen($qualification) > $max){

$errors[] = "Your Education credential cannot be more than {$max} characters";

}

     if(!preg_match("/[a-zA-Z'-]/",$qualification)) {
    $errors[]="Invalid Education credential";
     }





if(!empty($errors)) {

	foreach ($errors as $error) {

	echo validation_errors($error);

	}
}else{
	if(admin_request($admin_email,$first_name,$last_name,$qualification)){

		set_message("<div class='alert alert-success'>
    <strong>Success!</strong> Please check your email or spam folder for activation link.</div>
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
	}, 5000);
	</script>
    ");


		redirect("admin_register.php");
		}else{
		set_message("<p class='bg-danger text-center'> Sorry! We could not register the user </p>");

		redirect("admin_register.php");

		}
	}
}
}   //End Function




/************----------Insert Admin Request and generate Invitation code-----------************/

function admin_request($admin_email,$first_name,$last_name,$qualification) {

    $admin_email   = escape($admin_email);
	$first_name	   = escape($first_name);
	$last_name	   = escape($last_name);
	$qualification = escape($qualification);

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');

if(admin_email_exists($admin_email)) {

	return false;
}else{

	$invitation_code = md5($admin_email. microtime());

$sql = "INSERT INTO admin_request(admin_email,first_name,last_name,education,invitation_code,admin_date_time,active,approve)";

$sql.="VALUES('$admin_email','$first_name','$last_name','$qualification','$invitation_code','$date',0,0)";

	$result=query($sql);
	confirm($result);




require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;


$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'subratadasbca@gmail.com';                 // SMTP username
$mail->Password = 'niy@tik@lip@d@';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to


$mail->setFrom('subratadasbca@gmail.com', 'Online Discussion Forum');
$mail->addAddress($admin_email);  
$mail->addReplyTo('no-reply@gmail.com', 'Np-reply');

$mail->isHTML(true);                                  // Set email format to HTML


$mail->Subject = 'Invitation code';
$mail->Body    = "Your invitation code is <br><h1>{$invitation_code}</h1>";
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}


	return true;
	}
}   //  End Function






/*********************----Admin Registation Validation Function----***************************/

function validate_admin_registration(){

	$errors=[];
	$min = 3;
	$max = 20;

if($_SERVER['REQUEST_METHOD']=="POST"){

    $admin_email	 =clean($_POST['admin_email']);
    $password  		 =clean($_POST['password']);
    $invitation_code =clean($_POST['invitation_code']);
	$confirm_password=clean($_POST['confirm_password']);



    if(!preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/",$admin_email)) {
    $errors[]="Invalid email address";
    }


if(strlen($admin_email)<$min) {

	$errors[]="Your email cannot be less than {$min} characters";
}

if(validEmail($admin_email)){
	$errors[]="Invalid email address";
}

if(strlen($password) < $min){

    $errors[] = "Your password cannot be less than {$min}";
}

if(strlen($password) > $max){

    $errors[] = "Your password cannot be more than {$max}";
}


if($password!==$confirm_password){

	$errors[]="Your password fields do not match";
}


if(!empty($errors)) {

	foreach ($errors as $error) {

	echo validation_errors($error);

	}
}else{
	if(register_admin($admin_email,$password,$invitation_code)){

		

		set_message("<div class='alert alert-success'>
    <strong>Success!</strong> Please check your email or spam folder for activation link.</div>
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
	}, 5000);
	</script>
    ");


		redirect("admin_login.php");
		}else{

set_message("<div class='alert alert-danger'>
    <strong>Sorry!</strong> We could not register. </div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 5000);
	</script>
    ");

		redirect("admin_login.php");

		}
	}
}
}   //End Function




/************----------Admin Registation-----------************/

function register_admin($admin_email,$password,$invitation_code) {

    $admin_email = escape($admin_email);
    $password = escape($password);
    $invitation_code = escape($invitation_code);

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');



  $sql = "SELECT * FROM admin_request WHERE admin_email = '$admin_email' AND invitation_code = '$invitation_code'";

    $result = query($sql);
    if(row_count($result) == 1) {

        $row = fetch_array($result);
        $db_invitation_code = $row['invitation_code'];
        $password = md5($password);
        // $validation_code = md5($password);

$validation_code = md5($admin_email . microtime());

	 // if(md5($admin_email) === $db_invitation_code){
  //        $password = md5($password);
  //        $validation_code = md5($password);



  //   $sql = "SELECT * FROM admin WHERE admin_email = '$admin_email' AND invitation_code = '$invitation_code'";

  //   $result = query($sql);
  //   if(row_count($result) == 1) {

  //       $row = fetch_array($result);
  //       $db_invitation_code = $row['invitation_code'];

	 // if(md5($admin_email) === $db_invitation_code){
  //        $password = md5($password);
  //        $validation_code = md5($password);

	$sql1 = "UPDATE admin_request SET
	password					= '$password',
	invitation_code		= 1,
	admin_date_time  	= '$date',
	validation_code 	= '$validation_code',
	active     				= 0,
	approve 					= 0
	WHERE admin_email 		= '$admin_email'";

		$result1=query($sql1);
		confirm($result1);

	return true;
// }
}else{
//
// 	$password = md5($password);
// 	$validation_code = md5($first_name);
//
// $sql = "INSERT INTO admin(admin_email,first_name,last_name,education,password,invitation_code,admin_date_time,validation_code,active,approve)";
//
// $sql.="VALUES('$admin_email','$first_name','$last_name','0',$password','$invitation_code','$date','$validation_code',0,0)";
//

		return false;

	}
}   //  End Function


/*****************-----Activate admin function-----********************/

function activate_admin(){

	if($_SERVER['REQUEST_METHOD'] == "GET") {

		if(isset($_GET['admin_email'])) {

			$admin_email = clean ($_GET['admin_email']);

			$validation_code = clean($_GET['code']);

			$sql = "SELECT admin_id FROM admin WHERE admin_email = '".escape($_GET['admin_email'])."' AND validation_code = '".escape($_GET['code'])."'";

			$result = query($sql);
			confirm($result);

	if(row_count($result)==1) {

		$sql2 = "UPDATE admin SET active = 1, validation_code = 0 WHERE admin_email = '".escape($admin_email)."' AND validation_code = '".escape($validation_code)."' ";

		$result2 = query($sql2);
		confirm($result2);

		// set_message("<p class='bg-success text-center'>  </p>") ;

		set_message("<div class='alert alert-success'>
    <strong>Success!</strong> Your account has been activated please login.</div>
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
	}, 5000);
	</script>
    ");

		redirect("admin_login.php");

	}else{
		set_message("<p class='bg-danger text-center'>Sorry! Your account could not be activated</p>") ;

		redirect("admin_login.php");

	}

		}

	}
}   //end of function






/*****************-----Validate Admin login function-----********************/


function validate_admin_login() {

	$errors=[];
	$min = 3;
	$max = 20;

	if($_SERVER['REQUEST_METHOD']=="POST") {

	$admin_email	 =clean($_POST['admin_email']);
	$password  		 =clean($_POST['password']);
	$remember 		 = isset($_POST['remember']);

	if(empty($admin_email)) {

	$errors[]="Email field cannot be empty";

	}

	if(empty($password)) {

	$errors[]="Password field cannot be empty";

	}



	if(!empty($errors)) {

	foreach ($errors as $error) {

	echo validation_errors($error);

	}
}else{

	if(login_admin($admin_email, $password, $remember)) {
		set_message("<div class='alert alert-success'>
    <strong>Success!</strong> You have successfully logged in! </div>
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
	}, 5000);
	</script>
    ");

		redirect("index.php.");

	} else {

	echo validation_errors("Your credentials are not correct");
    }
  }
 }
} //-----end of function------




/*****************-----Admin login function-----********************/

function login_admin($admin_email,$password,$remember) {

 $sql = "SELECT password, admin_id FROM admin WHERE admin_email = '".escape($admin_email)."'AND active=1 AND approve=1";

$result = query($sql);
if(row_count($result) == 1) {

$row = fetch_array($result);
$db_password = $row['password'];

	if(md5($password) === $db_password){

		if($remember == "on") {
	setcookie('admin_email',$admin_email,time() + 86400);
	}

		$_SESSION['admin_email'] = $admin_email;

		return true;
	}else{
		return false; 
	}
        return true;
    }else{
        return false;
    }
} //------end of function-----





/*****************-----logged in function-----********************/

function admin_logged_in() {
	if(isset($_SESSION['admin_email']) || isset ($_COOKIE['admin_email'])) {

		return true;

	}else{

		return false;
	}
}	/// end of function






/*****************-----Recover password function-----********************/

function recover_password() {

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		if(isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {

			$email = clean($_POST['admin_email']);

		if(admin_email_exists($email)) {

			$validation_code = md5($email . microtime());

		setcookie('temp_access_code', $validation_code, time() + 60);

$sql = "UPDATE admin SET validation_code ='".escape($validation_code)."'WHERE admin_email ='".escape($email)."' ";

	$result = query($sql);
	confirm($result);


//Send mail


require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'subratadasbca@gmail.com';                 // SMTP username
$mail->Password = 'niy@tik@lip@d@';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('subratadasbca@gmail.com', 'Online Discussion Forum');
$mail->addAddress($email);  
$mail->addReplyTo('no-reply@gmail.com', 'Np-reply');

$mail->isHTML(true);                                  // Set email format to HTML


$mail->Subject = 'Please reset your password';

$mail->Body = "Here is your password reset code<br> <h1>{$validation_code}</h1>	<br> <a href='localhost/ODF/admin/admin_code.php?email=$email&code=$validation_code'>Click here</a> to reset your password";

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}



				
set_message("<div class='alert alert-success'>
     Welcome  Please check your <strong>email</strong> or <strong>spam folder</strong> for a password reset code </div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 5000);
	</script>
    ");


				redirect("index.php");

	}else{

	echo validation_errors("This emails does not exits");

	}
	}else{

		redirect("index.php");

	}


	if(isset($_POST['cancel_submit'])) {

		redirect("admin_login.php");

	}

	}			// post function


 	}			 // end of function









/*****************-----Code validation-----********************/
// #################################################################
// ##################################################################


function validate_code() {
		
	if(isset($_COOKIE['temp_access_code'])) {

		if(!isset($_GET['email']) && !isset($_GET['code'])){

			redirect("index.php");

				}else if (empty($_GET['email']) || empty($_GET['code'])) {
		
					redirect("index.php");
				}else{
					if (isset($_POST['code'])) {
						# code...
						$email = clean($_GET['email']);
						$validation_code = clean($_POST['code']);

						$sql = "SELECT admin_id FROM admin WHERE validation_code = '".escape($validation_code)."' AND admin_email = '".escape($email)."'";

						$result=query($sql);


						if(row_count($result)==1) {

							setcookie('temp_access_code', $validation_code, time() + 300);

							redirect("admin_reset.php?email=$email&code=$validation_code");
						
						} else {

							 echo validation_errors("Sorry worng validation code");

						}
					}
				}
			}else{
			// set_message("<p class='bg-danger text-center'> Sorry your validation cookie was expired </p>") ;
			
			set_message("<div class='alert alert-danger'>
    <strong>Warning!</strong> Sorry your validation cookie was expired </div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 5000);
	</script>
    ");
			redirect("admin_recover.php");
		}
	} //end of function






/*****************-----Password Reset Function-----********************/


function password_reset() {

if(isset($_COOKIE['temp_access_code'])) {

	if(isset($_GET['email']) && isset($_GET['code'])) {

		if(isset($_SESSION['token']) && (isset($_POST['token']))) {

			if ($_POST['token'] === $_SESSION['token']) {

				if($_POST['password']===$_POST['confirm_password']) {

					$updated_password = md5($_POST['password']);

					$sql = "UPDATE admin SET password ='".escape($updated_password)."',validation_code = 0 WHERE admin_email = '".escape($_GET['email'])."'";

					query($sql);

					// set_message("<p class='bg-danger text-center'> Your passwords has been sucessfully updated, please login</p>");

     set_message("<div class='alert alert-success'>
    Your passwords has been sucessfully updated, please <strong>login!</strong></div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 5000);
	</script>
    ");

				


require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
                        

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'subratadasbca@gmail.com';                 // SMTP username
$mail->Password = 'niy@tik@lip@d@';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('subratadasbca@gmail.com', 'Online Discussion Forum');
$mail->addAddress($email);  
$mail->addReplyTo('no-reply@gmail.com', 'Np-reply');

$mail->isHTML(true);                                  // Set email format to HTML


$mail->Subject = 'Please reset your password';

$mail->Body = "Your passwords has been sucessfully updated, please <strong>login!</strong>";

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

redirect("admin_login.php");	

				}else{
					
					set_message("<div class='alert alert-danger'>
    <strong>Warning!</strong> Password does not match the confirm password. </div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 5000);
	</script>
    ");
				}

			}




}
}
} else {

	// set_message("<p class='bg-danger text-center'>Sorry your time has expired </p>");
set_message("<div class='alert alert-danger'>
    <strong>Warning!</strong> Sorry your time has expired </div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 5000);
	</script>
    ");
		redirect("admin_recover.php");
}
} // end of function







/*********************    Add Subject validation     ************************/
function validate_addSubject(){

	$errors=[];
	$min = 2;
	$max = 20;

if($_SERVER['REQUEST_METHOD']=="POST"){

	$subject_code	     =clean($_POST['subject_code']);
	$subject_name	     =clean($_POST['subject_name']);


if(strlen($subject_code) < $min) {
    $errors[]="Your subject code cannot be less than {$min} characters";
}

if (strlen($subject_code) > $max ) {
    $errors[]="Your subject code cannot be more than {$max} characters";
}

if(strlen($subject_name) < $min) {
    $errors[]="Your subject name cannot be less than {$min} characters";
}

if (strlen($subject_name) > $max ) {
    $errors[]="Your subject name cannot be more than {$max} characters";
}

    if(!empty($errors)) {

	foreach ($errors as $error) {

	echo validation_errors($error);

	}
}else{
	if(insert_subject($subject_code,$subject_name)){

		// set_message("<div class='alert alert-success text-center'><strong>Sucessfully insert !</strong></div>");

		set_message("<div class='alert alert-success'>
    <strong>Success!</strong> Sucessfully insert.  </div>
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
	}, 5000);
	</script>
    ");

		redirect("admin_add_subject.php");
		}else{
		//set_message("<p class='bg-danger text-center'> Sorry! Not insert </p>");
		//$errors[]="Sorry that subject already is registered";

	set_message("<div class='alert alert-danger'>
    <strong>Danger!</strong> Sorry that subject already is registered.
  	</div>

    <script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
    }, 5000);
    </script>
    ");

		redirect("admin_add_subject.php");

		}
	}
  }
}   //End Function




/*****************----Add Subject function----*******************/

function insert_subject($subject_code,$subject_name) {

    $subject_code = escape($subject_code);
	$subject_name = escape($subject_name);

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');


	$sql="SELECT sub_code, sub_name FROM subjects WHERE sub_code = '$subject_code' OR sub_name = '$subject_name'";

	$result = query($sql);

	if(row_count($result) == 0) {

		$qry="SELECT admin_id FROM admin WHERE admin_email='$_SESSION[admin_email]'";
	$result = query($qry);
	confirm($result);
	$row=fetch_array($result);
	$id = $row['admin_id'];

	$sql = "INSERT INTO subjects(sub_code,sub_name,sub_date_time,sub_uploaded_by,s_admin_id)";

	$sql.="VALUES('$subject_code','$subject_name','$date','{$_SESSION['admin_email']}',$id)";

	$result=query($sql);
	confirm($result);

	return true;
	}else{

	return false;

	}


	}   //  End Function




/*********************    Add Question validation     ************************/
function validate_adminAddQuestion(){

	$errors=[];
	$min = 10;
	$max = 140;

if($_SERVER['REQUEST_METHOD']=="POST"){


	$subject_id 	=clean($_POST['subject_id']);
	$question_des	 =clean($_POST['question_des']);

 if(isset($_REQUEST['subject_id']) && $_REQUEST['subject_id'] == '0') {
     $errors[]="Please select a subject";
 }

if(strlen($question_des) < $min) {
    $errors[]="Your question cannot be less than {$min} characters";
}

if (strlen($question_des) > $max ) {
    $errors[]="Your question cannot be more than {$max} characters";
}

    if(!empty($errors)) {

	foreach ($errors as $error) {

	echo validation_errors($error);

	}
}else{
	if(insert_adminQuestion($subject_id,$question_des)){

		set_message("<div class='alert alert-success text-center'><strong>Sucessfully insert !</strong></div>");

		redirect("admin_add_question.php");
		}else{
		set_message("<p class='bg-danger text-center'> Sorry! Not insert </p>");

		redirect("admin_add_question.php");

		}
	}
  }
}   //End Function




/*****************----Add Question function----*******************/

function insert_adminQuestion($subject_id,$question_des) {

	$subject_id   = escape($subject_id);
	$question_des = escape($question_des);

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');
	/*$eventname = mysql_real_escape_string($_POST['email']);*/
$qry="SELECT admin_id FROM admin WHERE admin_email='$_SESSION[admin_email]'";
$result = query($qry);
confirm($result);
$row=fetch_array($result);
$id = $row['admin_id'];
    $admin='ODF';
$sql = "INSERT INTO questions(subject_id,question,q_date_time,q_email,user_id)";

$sql.="VALUES($subject_id,'$question_des','$date','ODF','$id')";

	$result=query($sql);
	confirm($result);

	return true;
	}   //  End Function{$_SESSION['admin_email']}







/********-----Validation Change Password-----********/

function validate_adminChangePassword(){

	$errors=[];
	$min = 8;
	$max = 20;

if($_SERVER['REQUEST_METHOD']=="POST"){

	$curnt_pass	     =clean($_POST['curnt_pass']);
	$new_pass	     =clean($_POST['new_pass']);
	$repeat_pass	 =clean($_POST['repeat_pass']);

$confirm_password=clean($_POST['repeat_pass']);

if(strlen($new_pass) < $min) {
    $errors[]="Your password cannot be less than {$min} characters";
}

if(strlen($new_pass) > $max) {
    $errors[]="Your password cannot be more than {$max} characters";
}

//if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]
//{6,15}$/',($_POST['new_pass']))) {
 //   $errors[]='Password must contain 6 characters of letters, numbers and
//    at least one special character.';
//}


if($new_pass!==$repeat_pass){

	$errors[]="Your password fields do not match";
}

 
if(!empty($errors)) {

	foreach ($errors as $error) {

	echo validation_errors($error);

	}
}else{
	if(change_password($curnt_pass,$new_pass,$repeat_pass)){

        // set_message("<div class='alert alert-success text-center'><strong>Congratulations You have successfully changed your password !</strong></div>");


        set_message("<div class='alert alert-success'>
    	<strong>Success!</strong> Congratulations You have successfully changed your password.</div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 5000);
	</script>
    ");


		redirect("admin_setting.php");
		}else{
		// set_message("<p class='bg-danger text-center'> Sorry! Not Changed </p>");

		 set_message("<div class='alert alert-danger'>
    	<strong>Warning!</strong> Sorry! Not Changed. </div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 5000);
	</script>
    ");

		redirect("admin_setting.php");

		}
	}
}
}







/********-----Function Change Password-----********/

function change_password($curnt_pass,$new_pass,$repeat_pass){

	$curnt_pass  = escape($curnt_pass);
	$new_pass    = escape($new_pass);
	$repeat_pass = escape($repeat_pass);

    if(isset($_POST['submit']))
    {
    $sql = "SELECT * FROM admin WHERE admin_email = '".$_SESSION["admin_email"]."' AND active = 1 ";
    $result = query($sql);
    if(row_count($result) == 1) {

        $row = fetch_array($result);
        $db_pass = $row['password'];

	if(md5($curnt_pass) === $db_pass){
        $new_pass = md5($new_pass);

    $sql2 = "UPDATE admin SET password ='$new_pass' WHERE admin_email = '".$_SESSION["admin_email"]."' ";

		$result2 = query($sql2);
		confirm($result2);

            return true;

    }else{
            return false;
    }

		}

}

}












/***********--------------Validation function of account setting-------------*************/

function validate_admin_ac_Setting(){

	$errors=[];
	$min = 1;
	$max = 20;

	$uploadOk = 1;
	$image_dir = "images/ProfilePicture/";

if($_SERVER['REQUEST_METHOD']=="POST"){

    // $education      =clean($_POST['education']);
    $emp            =clean($_POST['emp']);
    $add   	        =clean($_POST['add']);
    $password 		=clean($_POST['password']);
    

		$image = $_FILES['user_pic'];
		$filename = $_FILES["user_pic"] ["name"];
		$tempname = $_FILES["user_pic"]["tmp_name"];
		$folder = "images/ProfilePicture/".$filename;



  if(!empty($_FILES['user_pic']['tmp_name']) && ($_FILES['user_pic']['name'])){

    $image_file = $image_dir . basename($_FILES["user_pic"]["name"]);
    $imageFileType = strtolower(pathinfo($image_file,PATHINFO_EXTENSION));


    $check =  getimagesize($tempname);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $errors[] = "File is not an image.";
        $uploadOk = 0;
    }


if (file_exists($image_file)) {
    $errors[] = "Sorry, this picture name already exists please change picture name.";
    $uploadOk = 0;
}


if ($_FILES["user_pic"]["size"] > 500000) {
    $errors[] = "Sorry, your profile picture is too large.";
    $uploadOk = 0;
}





if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
   $errors[] = "Sorry, only JPG, JPEG & PNG files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) { 
    $errors[] = "Sorry, your profile picture was not uploaded.";


} else {
    if ( move_uploaded_file($tempname,$folder)) {
//        $errors[] = "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
         // set_message("<div class='alert alert-success text-center'><strong>Sucessfully insert !</strong></div>"); 
         
    	set_message("<div class='alert alert-success'>
    	<strong>Success!</strong> Sucessfully insert !</div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 5000);
	</script>
    ");


    } else {
//        $errors[] = "Sorry, there was an error uploading your file.";
        	set_message("<p class='bg-danger text-center'> Sorry! Not insert </p>");
    }
}

  }else{

  }

    if(!empty($errors)) {

	foreach ($errors as $error) {

	echo validation_errors($error);

	}
}else{
	if(insert_accountDetails($emp,$add,$filename,$folder,$password)){

		// set_message("<div class='alert alert-success  text-center'><strong>Thank you!</strong> Your message has been sent successfully</div>"); $education,$emp,


	set_message("<div class='alert alert-success'>
    <strong>Success!</strong> Your account successfully updated !</div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 5000);
	</script>
    ");


		redirect("admin_ac_setting.php");
		}else{
		// set_message("<div class='alert alert-danger'  text-center'><strong>Sorry</strong>, your message could not be sent </div>");
		
	set_message("<div class='alert alert-danger'>
    <strong>Danger!</strong> Update Failed !
  	</div>

    <script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
    }, 10000);
    </script>
    ");

		redirect("admin_ac_setting.php");

		}
	}
  }
}   //End Function $education,$emp,




/***********----- function account setting-----***************/

function insert_accountDetails($emp,$add,$filename,$folder, $password) {

	// $education  = escape($education);
	$emp        = escape($emp);
	$add        = escape($add);

    date_default_timezone_set('Asia/Kolkata');
     $date = date('Y-m-d H:i:s');


$sql = "SELECT password, admin_id FROM admin WHERE admin_email = '$_SESSION[admin_email]' ";
$result = query($sql);
if(row_count($result) == 1) {

$row = fetch_array($result);
$db_password = $row['password'];
$id = $row['admin_id'];

if(md5($password) === $db_password){


	// $qry="SELECT user_id FROM users WHERE email='$_SESSION[email]'";
	// $result = query($qry);
	// confirm($result);
	// $row1=fetch_array($result);
	
    
 	$sql = "UPDATE admin SET 
	
	employment = '$emp',
    address     = '$add', 
    admin_pic = '$filename', 
    ad_pic_src     = '$folder' 
    WHERE admin_id = '$id'";
        
	$result=query($sql);
	confirm($result);


		return true;
	}else{
		return false;
	}
return true;
}else{
return false;
}  
} 
   //  End Function




/*********************    Message to User validation     ************************/
function validate_UserMess(){

	$errors=[];

if($_SERVER['REQUEST_METHOD']=="POST"){

	$query_id	 =clean($_POST['query_id']);
	$user_id	 =clean($_POST['user_id']);
	$sub_name 	 =clean($_POST['sub_name']);
	$mess_name	 =clean($_POST['mess_name']);

if(empty($sub_name)) {

	$errors[]="Subject field cannot be empty";
}
    
if(empty($mess_name)) {

	$errors[]="Message field cannot be empty";
}

    if(!empty($errors)) {

	foreach ($errors as $error) {

	echo validation_errors($error);

	}
}else{
	if(insert_UserMess($sub_name,$mess_name,$query_id,$user_id)){

		// set_message("<div class='alert alert-success text-center'><strong>Sucessfully insert !</strong></div>");
		
			set_message("<div class='alert alert-success'>
    <strong>Success!</strong> Message send Sucessfully!</div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 1000);
	</script>
    ");

		redirect("user_request.php");
		}else{
		set_message("<p class='bg-danger text-center'> Sorry! Not insert </p>");

		redirect("user_request.php");

		}
	}
  }
}   //End Function




/*****************----Message to user function----*******************/

function insert_UserMess($sub_name,$mess_name,$query_id,$user_id) {

	$sub_name   = escape($sub_name);
	$mess_name  = escape($mess_name);
	$query_id   = escape($query_id);
	$user_id    = escape($user_id);

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');
	/*$eventname = mysql_real_escape_string($_POST['email']);*/
// $qry="SELECT admin_id FROM admin WHERE admin_email='$_SESSION[admin_email]'";
// $result = query($qry);
// confirm($result);
// $row=fetch_array($result);
// $id = $row['admin_id'];

$sql = "INSERT INTO post_solution(admin_subject,admin_description,admin_des_time,query_id,query_user_id,status)";

$sql.="VALUES('$sub_name','$mess_name','$date','$query_id','$user_id','unread')";

	$result=query($sql);
	confirm($result);

          
$quer = "UPDATE post_query SET response = 1 WHERE query_id = '$query_id'";
query($quer);


	return true;
	}   //  End Function{$_SESSION['admin_email']}




/*********************   individual Message to User validation     ************************/
function validate_User_Individual_Mess(){

	$errors=[];

if($_SERVER['REQUEST_METHOD']=="POST"){

	
	$user_id	 =clean($_POST['user_id']);
	$sub_name 	 =clean($_POST['sub_name']);
	$mess_name	 =clean($_POST['mess_name']);

if(empty($sub_name)) {

	$errors[]="Subject field cannot be empty";
}
    
if(empty($mess_name)) {

	$errors[]="Message field cannot be empty";
}

    if(!empty($errors)) {

	foreach ($errors as $error) {

	echo validation_errors($error);

	}
}else{
	if(insert_Individual_User_Mess($sub_name,$mess_name,$user_id)){

		// set_message("<div class='alert alert-success text-center'><strong>Sucessfully insert !</strong></div>");
		
			set_message("<div class='alert alert-success'>
    <strong>Success!</strong> Message send Sucessfully!</div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 1000);
	</script>
    ");

		redirect("user_request.php");
		}else{
		set_message("<p class='bg-danger text-center'> Sorry! Not insert </p>");

		redirect("user_request.php");

		}
	}
  }
}   //End Function




/*****************----Message to user function----*******************/

function insert_Individual_User_Mess($sub_name,$mess_name,$user_id) {

	$sub_name   = escape($sub_name);
	$mess_name  = escape($mess_name); 
	
	$user_id    = escape($user_id);

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');
	/*$eventname = mysql_real_escape_string($_POST['email']);*/
// $qry="SELECT admin_id FROM admin WHERE admin_email='$_SESSION[admin_email]'";
// $result = query($qry);
// confirm($result);
// $row=fetch_array($result);
// $id = $row['admin_id'];

$sql = "INSERT INTO post_solution(admin_subject,admin_description,admin_des_time,query_id,query_user_id,status)";

$sql.="VALUES('$sub_name','$mess_name','$date',0,'$user_id','unread')";

	$result=query($sql);
	confirm($result);

	return true;
	}   //  End Function{$_SESSION['admin_email']}











?>
