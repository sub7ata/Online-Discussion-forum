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

/***************User semail exists function*******************/

function email_exists($email) {

	$sql="SELECT user_id FROM users WHERE email = '$email'";

	$result = query($sql);

if(row_count($result) == 1) {

	return true;

}else{

	return false;
	}

}


function details_exits($email){

	$sql="SELECT user_id FROM users WHERE email = '$email' AND active = 0";

	$result = query($sql);

if(row_count($result) == 1) {

	return true;

}else{

	return false;
	}

}


function check_approve($email){

	$sql="SELECT user_id FROM users WHERE email = '$email' AND approve = 1";

	$result = query($sql);

if(row_count($result) == 1) {

	return true;

}else{

	return false;
	}

}



function login_details_exits($email){

	$sql="SELECT user_id FROM users WHERE email = '$email' AND active = 1";

	$result = query($sql);

if(row_count($result) == 1) {

	return true;

}else{

	return false;
	}

}


function username_exists($username) {

	$sql="SELECT user_id FROM users WHERE username = '$username'";

	$result = query($sql);

	if(row_count($result)==1) {

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

/*********************----User Validationfunction----***************************/

function validate_user_registration(){

	$errors=[];
	$min = 3;
	$max = 20;

if($_SERVER['REQUEST_METHOD']=="POST"){

	$first_name	     =clean($_POST['first_name']);
	$last_name	     =clean($_POST['last_name']);
	$username		 =clean($_POST['username']);
	$email	  		 =clean($_POST['email']);
	$password  		 =clean($_POST['password']);

$confirm_password=clean($_POST['confirm_password']);


if(email_exists($email)){

	$errors[]="Sorry that email already is registered";
}


if(username_exists($username)){

	$errors[]="Sorry that username is already is taken";

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



if(strlen($last_name) < $min){

	$errors[] = "Your last name cannot be less than {$min} characters";

}


if(strlen($last_name) > $max){

$errors[] = "Your last name cannot be more than {$max} characters";

}

if(!preg_match("/[a-zA-Z'-]/",$last_name)) {
$errors[]="Invalid last name";
}


if(strlen($username) < $min){

	$errors[] = "Your username cannot be less than {$min} characters";

}


if(strlen($username) > $max){

	$errors[] = "Your username cannot be more than {$max} characters";

}


if(strlen($email)<$min) {

	// $errors[]="Your email cannot be less than {$min} characters";
$errors[]="Invalid email address. Please enter currect email address";
}

// if(!preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/",$email)) {
//     $errors[]="Invalid email address";
// }

// if(validEmail($email)){
// 	$errors[]="Invalid email address";
// }

if($password!==$confirm_password){

	$errors[]="Your password fields do not match";
}

if (empty($password )){
	$errors[]="Please enter password";
}

if(empty($confirm_password)) {
    $errors[]="Please enter Confirm password";
}

if(preg_match("/([%\$#\*]+)/", $password)){
	 $errors[]="Speacial chrecter are not allowed";
}

if (strlen($password) < '5') {
	$errors[]="Invalid password. Password must be 5 numbers";
}

if (strlen($password) > '5') {
	$errors[]="Invalid password. Password must be 5 numbers";
}


if(!empty($errors)) {

	foreach ($errors as $error) {

	echo validation_errors($error); 

	}
}else{
	if(register_user($first_name,$last_name,$username,$email,$password)){

	set_message("<div class='alert alert-success'>
    <strong>Success!</strong>Please check your email or spam folder for activation link.</div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 2000);
	</script>
    ");


		redirect("register.php");
		}else{
		set_message("<div class='bg-danger text-center'> Sorry! We could not register the user </div>
				
			<script type='text/javascript'>
    		window.setTimeout(function() {
    			$('.alert').fadeTo(500, 0).slideUp(500, function(){
        			$(this).remove(); 
    			});
			}, 2000);
			</script>	
			
			");

		redirect("index.php");

		}
	} 
}
}


/******************-------Register user function-------**********************/


function register_user($first_name,$last_name,$username,$email,$password) {

	$first_name = escape($first_name);
	$last_name= escape($last_name);
	$username = escape($username);
	$email = escape($email);
	$password = escape($password);

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');

if(email_exists($email)) {

	return false;

}else if (username_exists($username)) {

	return false;

}else{

	$password = md5($password);
	$validation_code = md5($username);

$sql = "INSERT INTO users(first_name,last_name,username,email,password,u_date_time,validation_code,active,approve)";

$sql.="VALUES('$first_name','$last_name','$username','$email','$password','$date','$validation_code',0,0)";

	$result=query($sql);
	confirm($result);





require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'onlinesms4you@gmail.com';                 // SMTP username
$mail->Password = 'mou721445';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to


$mail->setFrom('onlinesms4you@gmail.com', 'Online Discussion Forum');
$mail->addAddress($email);  
$mail->addReplyTo('no-reply@gmail.com', 'Np-reply');

$mail->isHTML(true);                                  // Set email format to HTML


$mail->Subject = 'Activate Account';
$mail->Body    = "Please click <a href='localhost/ODF/activate.php?email=$email&code=$validation_code'>this link </a>to activate your Account";
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}







// $subject="Activate Account";

// $msg="Please click the link below to activate your Account http://localhost/login/activate.php
// ?email=$email&email&code=&validation_code";

// $header="From: noreply@youtwebsite.com";

// send_email($email,$subject,$msg,$headers);

	return true;
	}
}


/*****************-----Activate user function-----********************/

function activate_user(){
 
	if($_SERVER['REQUEST_METHOD'] == "GET") {

		if(isset($_GET['email'])) {
 
			$email = clean ($_GET['email']);

			$validation_code = clean($_GET['code']);

			$sql = "SELECT * FROM users WHERE email = '".escape($_GET['email'])."' AND validation_code = '".escape($_GET['code'])."' AND active = 0";

			$result = query($sql);
			confirm($result);

	if(row_count($result)==1) {

		$sql2 = "UPDATE users SET active = 1, validation_code = 0 WHERE email = '".escape($email)."' AND validation_code = '".escape($validation_code)."' ";

		$result2 = query($sql2);
		confirm($result2);

		
		set_message("<div class='alert alert-success'>Your account has been activated please 
     	<strong>login</strong></div> 
		<script type='text/javascript'>
   		window.setTimeout(function() {
    	$('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    	});}, 2500);
		</script>");

		redirect("login.php");

	}else{
	 	set_message("<div class='alert alert-danger'>
    	<strong>Sorry!</strong> Your account could not be activated</div> 
		<script type='text/javascript'>
    	window.setTimeout(function() {
    	$('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    	});}, 2500);
		</script>
    	");

		redirect("login.php");

	}

		}

	}
}   //end of function


// *****************************************************************
// ******************* Active account 2 **********************//
// &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&


function active_ac() {

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		if(isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {

			$email = clean($_POST['email']);

		if(email_exists($email)) {

			if(details_exits($email)){

			$validation_code = md5($email . microtime());

		setcookie('temp_access_code', $validation_code, time() + 60);

$sql = "UPDATE users SET validation_code ='".escape($validation_code)."'WHERE email ='".escape($email)."' ";

	$result = query($sql);
	confirm($result);




require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'onlinesms4you@gmail.com';                 // SMTP username
$mail->Password = 'mou721445';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to


$mail->setFrom('onlinesms4you@gmail.com', 'Online Discussion Forum');
$mail->addAddress($email);  
$mail->addReplyTo('no-reply@gmail.com', 'Np-reply');

$mail->isHTML(true);                                  // Set email format to HTML


$mail->Subject = 'Activate Account';
$mail->Body    = "Please click <a href='localhost/ODF/activate.php?email=$email&code=$validation_code'>this link </a>to activate your Account";
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
	}, 2500);
	</script>
    ");


				redirect("index.php");

			}else{
				echo validation_errors("This email is already active");
			}

	}else{

	echo validation_errors("This emails does not exits");

	}
	}else{

		redirect("index.php");

	}


	if(isset($_POST['cancel_submit'])) {

		redirect("login.php");

	}

	}			// post function


 	}			 // end of function



/*****************-----Validate user login function-----********************/


function validate_user_login() {

	$errors=[];
	$min = 3;
	$max = 20;

	if($_SERVER['REQUEST_METHOD']=="POST") {


	$email	  		 =clean($_POST['email']);
	$password  		 =clean($_POST['password']);
	$remember 		 = isset($_POST['remember']);

	if(empty($email)) {

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


if(email_exists($email)){
	if(login_details_exits($email)){
		if(check_approve($email)){

	if(login_user($email, $password, $remember)) {
		
set_message("<div class='alert alert-success'>
     Welcome <strong>$_SESSION[email]</strong> you have successfully logged in!</div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 2000);
	</script>
    ");

		redirect("index.php");

	} else {

	echo validation_errors("Password does not match");
}

	}else{
		
	echo validation_errors("Your account active is under processing. Please wait some time");
}
}else{

	 echo validation_errors("Please active your account");
}
}else{

    echo validation_errors("Email provided is not on recognised");
}
}

	}
} // function



/*****************-----User login function-----********************/
#################################################################
function login_user($email,$password,$remember) {
 $sql = "SELECT password, user_id FROM users WHERE email = '".escape($email)."' AND active = 1 AND approve = 1";
$result = query($sql); 

// session update
$query = "UPDATE users SET online = 1 WHERE email = '".escape($email)."'";
	$resultQuery = query($query);
	confirm($resultQuery);

if(row_count($result) == 1) {

$row = fetch_array($result);
$db_password = $row['password'];

	if(md5($password) === $db_password){

		if($remember == "on") {
		setcookie('email',$email,time() + 86400);
	}

		$_SESSION['email'] = $email;

		return true;
	}else{
		return false;
	}
return true;
}else{
return false;
}
}	// end of function



/*****************-----logged in function-----********************/

function logged_in() {
	if(isset($_SESSION['email']) || isset ($_COOKIE['email'])) {

		return true;

	}else{

		return false;
	}
}	/// end of function




//************************Random Validation code generate***************************/
//**********************************************************************************/

function randomCode() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}




/*****************-----Recover password function-----********************/

function recover_password() {

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		if(isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {

			$email = clean($_POST['email']);

		if(email_exists($email)) {

			// $validation_code = md5($email . microtime());
		    $validation_code = randomCode();

		setcookie('temp_access_code', $validation_code, time() + 60);

$sql = "UPDATE users SET validation_code ='".escape($validation_code)."'WHERE email ='".escape($email)."' ";

	$result = query($sql);
	confirm($result);





require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'onlinesms4you@gmail.com';                 // SMTP username
$mail->Password = 'mou721445';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('onlinesms4you@gmail.com', 'Online Discussion Forum');
$mail->addAddress($email);  
$mail->addReplyTo('no-reply@gmail.com', 'Np-reply');

$mail->isHTML(true);                                  // Set email format to HTML


$mail->Subject = 'Please reset your password';

$mail->Body = "<div class='panel panel-primary' style='text-align:center;'>
Here is your password reset code<br> <h1><mark>{$validation_code}</mark></h1>	<br> <a href='localhost/ODF/code.php?email=$email&code=$validation_code'>Click here</a> to reset your password </div>";

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}







	// $subject = "Please reset your password";
	// $message = "Here is your password reset code {$validation_code}Click here to reset your password http://localhost/code.php?email=$email&code=$validation_code";

	// $headers = "From: noreplay@yourwebsite.com";

	// 		if(!send_email($email, $subject, $message, $headers)) {

	// 	echo validation_errors("Email could not be sent ");

	// 			}

				// set_message("<p class='bg-success text-center'>Please check your email or spam folder for a password reset code </p>");
				
set_message("<div class='alert alert-success'>
     Welcome  Please check your <strong>email</strong> or <strong>spam folder</strong> for a password reset code </div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 2500);
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

		redirect("login.php");

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
						$sql = "SELECT user_id FROM users WHERE validation_code = '".escape($validation_code)."' AND email = '".escape($email)."'";

						$result=query($sql);


						if(row_count($result)==1) {

							setcookie('temp_access_code', $validation_code, time() + 300);

							redirect("reset.php?email=$email&code=$validation_code");
						
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
	}, 2500);
	</script>
    ");
			redirect("recover.php");
		}
	} //end of function



/*****************-----Password Reset Function-----********************/


function password_reset() {

if(isset($_COOKIE['temp_access_code'])) {

	if(isset($_GET['email']) && isset($_GET['code'])) {

		if(isset($_SESSION['token']) && (isset($_POST['token']))) {

			if ($_POST['token'] === $_SESSION['token']) {

				if (empty($_POST['password']) || empty($_POST['confirm_password'])) {
    				echo validation_errors("Please enter password");
    				}elseif (preg_match("/([%\$#\*]+)/", $_POST["password"])){
    					echo validation_errors("Speacial chrecter are not allowed");
    					}elseif (strlen($_POST["password"]) < '6') {
        					echo validation_errors("Invalid password. Password must be at least 6 numbers");
    						}elseif (strlen($_POST["password"]) > '8') {
        						echo validation_errors("Invalid password. Password cannot be greater than 8 numbers");
    							}else{
				
				if($_POST['password']===$_POST['confirm_password']) {

					$updated_password = md5($_POST['password']);

					$sql = "UPDATE users SET password ='".escape($updated_password)."',validation_code = 0 WHERE email = '".escape($_GET['email'])."'";

					query($sql);

					// set_message("<p class='bg-danger text-center'> Your passwords has been sucessfully updated, please login</p>");

     set_message("<div class='alert alert-success'>
    Your passwords has been sucessfully updated, please <strong>login!</strong></div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 2500);
	</script>
    ");

				


require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
                        

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'onlinesms4you@gmail.com';                 // SMTP username
$mail->Password = 'mou721445';                           // SMTP password
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

redirect("login.php");	

				}else{
					echo validation_errors("Password does not match the confirm password");
					
				}

		}




			} //  compaire token

		} //token
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
	}, 2500);
	</script>
    ");
		redirect("recover.php");
}
} // end of function


/*********************    Add Question validation     ************************/
function validate_addQuestion(){

	$errors=[];
	$min = 10;
	$max = 1440;

if($_SERVER['REQUEST_METHOD']=="POST"){

	$subject_id	     =clean($_POST['subject_id']);
	$question	     =clean($_POST['question']);

if(isset($_REQUEST['subject_id']) && $_REQUEST['subject_id'] == '0') {
    $errors[]="Please select a subject";
}

if(strlen($question) < $min) {
    $errors[]="Your question cannot be less than {$min} characters";
}

if (strlen($question) > $max ) {
    $errors[]="Your question cannot be more than {$max} characters";
}

    if(!empty($errors)) {

	foreach ($errors as $error) {

	echo validation_errors($error);

	}
}else{
	if(insert_question($subject_id,$question)){

        set_message("<div class='alert alert-success'>
    <strong>Success!</strong> Sucessfully insert ! </div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 2500);
	</script>
    ");

		redirect("addQuestion.php");
		}else{

	set_message("<div class='alert alert-danger'>
    <strong>Warning!</strong> Sorry! Not insert. </div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 2500);
	</script>
    ");

		redirect("addQuestion.php");

		}
	}
  }
}   //End Function




/*****************----Add Question function----*******************/

function insert_question($subject_id,$question) {

    $subject_id = escape($subject_id);
	$question = escape($question);

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');
	
$qry="SELECT user_id FROM users WHERE email='$_SESSION[email]'";
$result = query($qry);
confirm($result);
$row=fetch_array($result);
$id = $row['user_id'];

$sql = "INSERT INTO questions(q_subject_id,question,q_date_time,q_email,q_user_id,a_q,a_s,user_approve)";

$sql.="VALUES($subject_id,'$question','$date','{$_SESSION['email']}',$id,0,1,1)";

	$result=query($sql);
	confirm($result);

	return true;
	}   //  End Function




/***********--------------Contact function-------------*************/

function validate_contact(){

	$errors=[];
	$min = 3;
	$max = 20;

if($_SERVER['REQUEST_METHOD']=="POST"){

	$email	     =clean($_POST['email']);
    $mobile_no   =clean($_POST['mobile_no']);
    $subject     =clean($_POST['subject']);
    $message     =clean($_POST['message']);


 /*
if(!preg_match("/[a-zA-Z'-]/",$name)) {
    $errors[]="Invalid first name";
} //end of name validaton
 */


 // email validation
if(strlen($email) < $min) {
    $errors[]="Your email cannot be less than {$min} characters";
}

if (strlen($email) > 30 ) {
    $errors[]="Your email cannot be more than 30 characters";
}

if(!preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/",$email)) {
    $errors[]="Invalid email address";
}//end of email address validation

// mobile number validation
if(strlen($mobile_no) < 10) {
    $errors[]="Your mobile number cannot be less than 10 number";
}

if (strlen($mobile_no) > 13 ) {
    $errors[]="Your mobile number cannot be more than 13 number";
}

if(!preg_match("/^[0-9]{10}+$/",$mobile_no)) {
    $errors[]="Invalid mobile number";
}


// name validation
/*if(empty($subject)) {

	$errors[]="Subject field cannot be empty";
}*/

if(strlen($subject) < $min) {
    $errors[]="Your subject name cannot be less than {$min} characters";
}

if (strlen($subject) > $max ) {
    $errors[]="Your subject name cannot be more than {$max} characters";
}

if(!preg_match("/[a-zA-Z'-]/",$subject)) {
    $errors[]="Invalid subject name";
} //end of name validaton



// message  validation
/*if(empty($message)) {

	$errors[]="Message field cannot be empty";
}*/

if(strlen($subject) < $min) {
    $errors[]="Your message cannot be less than {$min} characters";
}

if (strlen($message) > 140) {
    $errors[]="Your subject name cannot be more than 140 characters";
}

if(!preg_match("/[a-zA-Z'-]/",$message)) {
    $errors[]="Invalid message";
} //message validaton




    if(!empty($errors)) {

	foreach ($errors as $error) {

	echo validation_errors($error);

	}
}else{
	if(insert_message($email,$mobile_no,$subject,$message)){

		set_message("<div class='alert alert-success  text-center'><strong>Thank you!</strong> Your message has been sent successfully</div> 
			<script type='text/javascript'>
    		window.setTimeout(function() {
    			$('.alert').fadeTo(500, 0).slideUp(500, function(){
        			$(this).remove(); 
    			});
			}, 5000);
			</script>");

		redirect("contact.php");
		}else{
		set_message("<div class='alert alert-danger'  text-center'><strong>Sorry</strong>, your message could not be sent </div>");

		redirect("contact.php");

		}
	}
  }
}   //End Function




/***********----- Insert contact message-----***************/

function insert_message($email,$mobile_no,$subject,$message) {

	$email = escape($email);
	$mobile_no= escape($mobile_no);
	$subject = escape($subject);
    $message = escape($message);

    date_default_timezone_set('Asia/Kolkata');
     $date = date('Y-m-d H:i:s');

$sql = "INSERT INTO messages(email,mobile_no,subject,message,date_time)";

$sql.="VALUES('$email','$mobile_no','$subject','$message','$date')";

	$result=query($sql);
	confirm($result);

	return true;
}   //  End Function






/************---------- Validation of add Answer----------**************/

function validate_addAnswer(){

	$errors=[];
	$min = 3;
	$max = 1000000;

    $uploadOk = 1;

    $image_dir = "images/";

    $pdf_dir="pdf/";

    $video_dir="videos/"; 

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['submit'])){

    $answer	     =clean($_POST['answer']);
    $q_id	     =clean($_POST['q_id']);
    $s_id	     =clean($_POST['s_id']);

//    image
    $image = $_FILES['image'];
    $filename = $_FILES["image"] ["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "images/".$filename;

//    pdf
    $pdf = $_FILES['pdf'];
    $pdfName = $_FILES["pdf"] ["name"];
    $tempPdfName = $_FILES["pdf"]["tmp_name"];
    $folder_pdf = "pdf/".$pdfName;

//    video
    $video = $_FILES['video'];
    $videoName = $_FILES["video"] ["name"];
    $tempVideoName = $_FILES["video"]["tmp_name"];
    $folder_video = "videos/".$videoName;


    // answer validation
 if (empty ($answer)) {
    $errors[]="Your answer cannot empty !";

 }


if (strlen($answer) > $max ) {
    $errors[]="Your answer cannot be more than {$max} characters";
}





    // image validation

  if(!empty($_FILES['image']['tmp_name']) && ($_FILES['image']['name'])){

    $image_file = $image_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($image_file,PATHINFO_EXTENSION));


    $check =  getimagesize($tempname);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $errors[] = "File is not an image.";
        $uploadOk = 0;
    }


if (file_exists($image_file)) {
    $errors[] = "Sorry, image already exists.";
    $uploadOk = 0;
}


if ($_FILES["image"]["size"] > 500000) {
    $errors[] = "Sorry, your image is too large.";
    $uploadOk = 0;
}





if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
   $errors[] = "Sorry, only JPG, JPEG & PNG files are allowed.";
    $uploadOk = 0;
}





if ($uploadOk == 0) {
    $errors[] = "Sorry, your image was not uploaded.";






} else {
    if ( move_uploaded_file($tempname,$folder)) {
//        $errors[] = "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
         set_message("<div class='alert alert-success text-center'><strong>Sucessfully insert !</strong></div>");
    } else {
//        $errors[] = "Sorry, there was an error uploading your file.";
        	set_message("<p class='bg-danger text-center'> Sorry! Not insert </p>");
    }
}

  }else{

  }





//    pdf validations

  if(!empty($_FILES['pdf']['tmp_name']) && ($_FILES['pdf']['name'])){

    $pdf_file = $pdf_dir . basename($_FILES["pdf"]["name"]);
    $pdfFileType = strtolower(pathinfo($pdf_file,PATHINFO_EXTENSION));

//
//    $check =  getimagesize($temppdfname);
//    if($check !== false) {
//        $uploadOk = 1;
//    } else {
//        $errors[] = "File is not an image.";
//        $uploadOk = 0;
//    }

//      if ( $_FILES['pdf']['name'] != "application/pdf") {
////			print "Error occured while uploading file : ".$_FILES['pdfFile']['name']."<br/>";
//			 $errors[] = "Invalid  file extension, should be pdf !!"."<br/>";
////			print "Error Code : ".$_FILES['pdfFile']['error']."<br/>";
//      }





if (file_exists($pdf_file)) {
    $errors[] = "Sorry, pdf already exists.";
    $uploadOk = 0;
}


if ($_FILES["pdf"]["size"] > 500000) {
    $errors[] = "Sorry, your pdf is too large.";
    $uploadOk = 0;
}





if($pdfFileType != "pdf" ) {
   $errors[] = "Sorry, only pdf are allowed.";
    $uploadOk = 0;
}





if ($uploadOk == 0) {
    $errors[] = "Sorry, your pdf was not uploaded.";






} else {
    if ( move_uploaded_file($tempPdfName,$folder_pdf)) {
//        $errors[] = "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
         set_message("<div class='alert alert-success text-center'><strong>Sucessfully insert !</strong></div>");
    } else {
//        $errors[] = "Sorry, there was an error uploading your file.";
        	set_message("<p class='bg-danger text-center'> Sorry! Not insert </p>");
    }
}

  }else{

  }



//    pdf store end









//    video validation

  if(!empty($_FILES['video']['tmp_name']) && ($_FILES['video']['name'])){

    $video_file = $video_dir . basename($_FILES["video"]["name"]);
    $videoFileType = strtolower(pathinfo($video_file,PATHINFO_EXTENSION));

//
//    $check =  getimagesize($temppdfname);
//    if($check !== false) {
//        $uploadOk = 1;
//    } else {
//        $errors[] = "File is not an image.";
//        $uploadOk = 0;
//    }

//      if ( $_FILES['pdf']['name'] != "application/pdf") {
////			print "Error occured while uploading file : ".$_FILES['pdfFile']['name']."<br/>";
//			 $errors[] = "Invalid  file extension, should be pdf !!"."<br/>";
////			print "Error Code : ".$_FILES['pdfFile']['error']."<br/>";
//      }





if (file_exists($video_file)) {
    $errors[] = "Sorry, file already exists.";
    $uploadOk = 0;
}


if ($_FILES["video"]["size"] >  8000000) {
   $errors[] = "Sorry, your file is too large.";
   $uploadOk = 0;
}



//
//
//if($videoFileType != "video" ) {
//   $errors[] = "Sorry, only video are allowed.";
//    $uploadOk = 0;
//}
//




if ($uploadOk == 0) {
    $errors[] = "Sorry, your video was not uploaded.";






} else {
    if ( move_uploaded_file($tempVideoName,$folder_video)) {
//        $errors[] = "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
         // set_message("<div class='alert alert-success text-center'><strong>Sucessfully insert !</strong></div>");

set_message("<div class='alert alert-success'>
    <strong>Success!</strong> Sucessfully insert. </div> 
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



//    video store end



    if(!empty($errors)) {

	foreach ($errors as $error) {

	echo validation_errors($error);

	}
}else{
	if(insert_answer($filename,$folder,$pdfName,$folder_pdf,$videoName,$folder_video,$answer,$q_id,$s_id)){

        // set_message("<div class='alert alert-success text-center'><strong>Sucessfully insert !</strong></div>");
        
        set_message("<div class='alert alert-success'>
    <strong>Success!</strong> Sucessfully insert ! </div> 
	<script type='text/javascript'>
    window.setTimeout(function() {
    $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
	}, 5000);
	</script>
    "); 
 
		redirect("answer.php");
		}else{
		set_message("<p class='bg-danger text-center'> Sorry! Not insert </p>");

		redirect("answer.php");

		}
    }

}

}



/************----------Function of add Answer----------**************/


function insert_answer($filename,$folder,$pdfName,$folder_pdf,$videoName,$folder_video,$answer,$q_id,$s_id) {

	$answer = escape($answer);


    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');



$qry="SELECT user_id FROM users WHERE email='$_SESSION[email]'";
$result = query($qry);
confirm($result);
$row1=fetch_array($result);
$id = $row1['user_id'];

$q_no = $q_id;



$sql = "INSERT INTO answers(image,img_src,pdf,pdf_src,video,video_src,answer,a_date_time,a_user_id,q_no,a_subject_id,a_a,a_s,a_q,user_approve,status)";

$sql.= "VALUES('$filename','$folder','$pdfName','$folder_pdf','$videoName','$folder_video','$answer','$date','$id','$q_no','$s_id',0,1,1,1,'unread')";

	$result1=query($sql);
	confirm($result1);

	return true;
	}





/********-----Validation Change Password-----********/

function validate_changePassword(){

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


		redirect("setting.php");
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

		redirect("setting.php");

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
    $sql = "SELECT * FROM users WHERE email = '".$_SESSION["email"]."' AND active = 1 ";
    $result = query($sql);
    if(row_count($result) == 1) {

        $row = fetch_array($result);
        $db_pass = $row['password'];

	if(md5($curnt_pass) === $db_pass){
        $new_pass = md5($new_pass);

    $sql2 = "UPDATE users SET password ='$new_pass' WHERE email = '".$_SESSION["email"]."' ";

		$result2 = query($sql2);
		confirm($result2);

            return true;

    }else{
            return false;
    }

		}

}

}



// // Function to create read more link of a content with link to full page
// function readMore($content,$link,$var,$id, $limit) {
// $content = substr($content,0,$limit);
// $content = substr($content,0,strrpos($content,' '));
// $content = $content." <a href='$link?$var=$id'>Read More...</a>";
// return $content;
// }






/***********--------------Validation function of account setting-------------*************/

function validate_accountSetting(){

	$errors=[];
	$min = 1;
	$max = 20;

	$uploadOk = 1;
	$image_dir = "Profile_picture/";

if($_SERVER['REQUEST_METHOD']=="POST"){

    $education      =clean($_POST['education']);
    $emp            =clean($_POST['emp']);
    $add   	        =clean($_POST['add']);
    $password 		=clean($_POST['password']);
    

		$image = $_FILES['user_pic'];
		$filename = $_FILES["user_pic"] ["name"];
		$tempname = $_FILES["user_pic"]["tmp_name"];
		$folder = "Profile_picture/".$filename;

if(isset($_REQUEST['education']) && $_REQUEST['education'] == '0') {
		$errors[]="Please select your quelification degree.";
}

if(strlen($emp) < $min) {
    $errors[]="Your employment credential cannot be less than {$min} characters";
}

if (strlen($emp) > $max ) {
    $errors[]="Your employment credential name cannot be more than {$max} characters";
}


if(strlen($add) < $min) {
    $errors[]="Your address cannot be less than {$min} characters";
}

if (strlen($add) > $max ) {
    $errors[]="Your address name cannot be more than {$max} characters";
}

if(!preg_match("/[a-zA-Z'-]/",$emp)) {
    $errors[]="Invalid employment name";
}



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
	if(insert_accountDetails($education,$emp,$add,$filename,$folder,$password)){

		// set_message("<div class='alert alert-success  text-center'><strong>Thank you!</strong> Your message has been sent successfully</div>");


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


		redirect("account_setting.php");
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
    }, 2000);
    </script>
    ");

		redirect("account_setting.php");

		}
	}
  }
}   //End Function




/***********----- function account setting-----***************/

function insert_accountDetails($education,$emp,$add,$filename,$folder, $password) {

	$education  = escape($education);
	$emp        = escape($emp);
	$add        = escape($add);

    date_default_timezone_set('Asia/Kolkata');
     $date = date('Y-m-d H:i:s');


$sqluser = "SELECT password, user_id FROM users WHERE email = '$_SESSION[email]' ";
$resultuser = query($sqluser);
if(row_count($resultuser) == 1) {

$rowuser = fetch_array($resultuser);
$db_password = $rowuser['password'];
$id = $rowuser['user_id'];

if(md5($password) === $db_password){


	// $qry="SELECT user_id FROM users WHERE email='$_SESSION[email]'";
	// $result = query($qry);
	// confirm($result);
	// $row1=fetch_array($result);
	
    
 	$sql = "UPDATE users SET 
    education   = '$education', 
    employment  = '$emp', 
    address     = '$add', 
    profile_pic = '$filename', 
    pic_src     = '$folder' 
    WHERE user_id = '$id'";
        
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







/************---------- Validation of add Comment----------**************/

function validate_addComment(){

	$errors=[];
	$min = 3;
	$max = 1000000;
    
    $uploadOk = 1;
	$image_dir = "images/discussion/";
    
    $pdf_dir="pdf/discussion/";

    $video_dir="videos/discussion/";


if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['secondSubmit'])){
  //  if($_SERVER['REQUEST_METHOD']=="POST"){

    $comment	 =clean($_POST['comment']);
    $url 		 =clean($_POST['url']);
    $q_id	     =clean($_POST['q_id']);
    $a_id	     =clean($_POST['a_id']);
    
    
    $image = $_FILES['image'];
    $filename = $_FILES["image"] ["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "images/discussion/".$filename;

    //    pdf
    $pdf = $_FILES['pdf'];
    $pdfName = $_FILES["pdf"] ["name"];
    $tempPdfName = $_FILES["pdf"]["tmp_name"];
    $folder_pdf = "pdf/discussion/".$pdfName;
    
    //    video
    $video = $_FILES['video'];
    $videoName = $_FILES["video"] ["name"];
    $tempVideoName = $_FILES["video"]["tmp_name"];
    $folder_video = "videos/discussion/".$videoName;




    // answer validation
 if (empty ($comment)) {
    $errors[]="Your answer cannot empty !";

 }

if (strlen($comment) > $max ) {
    $errors[]="Your answer cannot be more than {$max} characters";
}


if (empty ($url)) {
   
}else{
	if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
     $errors[] = "Please enter valid URL";
}
}




// $check = parse_url($url,PHP_URL_HOST);
// if(null!==$check){


// }else{
// 	if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
//       $errors[] = "Please enter valid URL";
//     }
// }

 // if (filter_var($url, FILTER_VALIDATE_URL) == false) {
 //       $errors[] = "Please enter valid URL";
 //    }
   
  if(!empty($_FILES['image']['tmp_name']) && ($_FILES['image']['name'])){

    $image_file = $image_dir . basename($_FILES["image"]["name"]);
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


if ($_FILES["image"]["size"] > 500000) {
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
        //$errors[] = "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
         set_message("<div class='alert alert-success text-center'><strong>Sucessfully insert !</strong></div>");
    } else {
//        $errors[] = "Sorry, there was an error uploading your file.";
        	set_message("<p class='bg-danger text-center'> Sorry! Not insert </p>");
    }
}

  }else{

  }
    
  
    
    
    
    
//    pdf validations

  if(!empty($_FILES['pdf']['tmp_name']) && ($_FILES['pdf']['name'])){

    $pdf_file = $pdf_dir . basename($_FILES["pdf"]["name"]);
    $pdfFileType = strtolower(pathinfo($pdf_file,PATHINFO_EXTENSION));

//
//    $check =  getimagesize($temppdfname);
//    if($check !== false) {
//        $uploadOk = 1;
//    } else {
//        $errors[] = "File is not an image.";
//        $uploadOk = 0;
//    }

//      if ( $_FILES['pdf']['name'] != "application/pdf") {
////			print "Error occured while uploading file : ".$_FILES['pdfFile']['name']."<br/>";
//			 $errors[] = "Invalid  file extension, should be pdf !!"."<br/>";
////			print "Error Code : ".$_FILES['pdfFile']['error']."<br/>";
//      }





if (file_exists($pdf_file)) {
    $errors[] = "Sorry, pdf already exists.";
    $uploadOk = 0;
}


if ($_FILES["pdf"]["size"] > 500000) {
    $errors[] = "Sorry, your pdf is too large.";
    $uploadOk = 0;
}





if($pdfFileType != "pdf" ) {
   $errors[] = "Sorry, only pdf are allowed.";
    $uploadOk = 0;
}





if ($uploadOk == 0) {
    $errors[] = "Sorry, your pdf was not uploaded.";






} else {
    if ( move_uploaded_file($tempPdfName,$folder_pdf)) {
//        $errors[] = "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
         set_message("<div class='alert alert-success text-center'><strong>Sucessfully insert !</strong></div>");
    } else {
//        $errors[] = "Sorry, there was an error uploading your file.";
        	set_message("<p class='bg-danger text-center'> Sorry! Not insert </p>");
    }
}

  }else{

  }



//    pdf store end





//    video validation

  if(!empty($_FILES['video']['tmp_name']) && ($_FILES['video']['name'])){

    $video_file = $video_dir . basename($_FILES["video"]["name"]);
    $videoFileType = strtolower(pathinfo($video_file,PATHINFO_EXTENSION));

//
//    $check =  getimagesize($temppdfname);
//    if($check !== false) {
//        $uploadOk = 1;
//    } else {
//        $errors[] = "File is not an image.";
//        $uploadOk = 0;
//    }

//      if ( $_FILES['pdf']['name'] != "application/pdf") {
////			print "Error occured while uploading file : ".$_FILES['pdfFile']['name']."<br/>";
//			 $errors[] = "Invalid  file extension, should be pdf !!"."<br/>";
////			print "Error Code : ".$_FILES['pdfFile']['error']."<br/>";
//      }





if (file_exists($video_file)) {
    $errors[] = "Sorry, file already exists.";
    $uploadOk = 0;
}


//if ($_FILES["video"]["size"] > 500000) {
//    $errors[] = "Sorry, your file is too large.";
//    $uploadOk = 0;
//}
//


//
//
//if($videoFileType != "video" ) {
//   $errors[] = "Sorry, only video are allowed.";
//    $uploadOk = 0;
//}
//




if ($uploadOk == 0) {
    $errors[] = "Sorry, your video was not uploaded.";






} else {
    if ( move_uploaded_file($tempVideoName,$folder_video)) {
//        $errors[] = "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
         set_message("<div class='alert alert-success text-center'><strong>Sucessfully insert !</strong></div>");
    } else {
//        $errors[] = "Sorry, there was an error uploading your file.";
        	set_message("<p class='bg-danger text-center'> Sorry! Not insert </p>");
    }
}

  }else{

  }



//    video store end



    
    
    


    if(!empty($errors)) {

	foreach ($errors as $error) {

	echo validation_errors($error);
 
	}
}else{
	if(insert_comment($comment,$filename,$folder,$pdfName,$folder_pdf,$videoName,$folder_video,$url,$q_id,$a_id)){

		set_message("<div class='alert alert-success  text-center'><strong>Thank you!</strong> Your message has been sent successfully</div> 
			<script type='text/javascript'>
    		window.setTimeout(function() {
    			$('.alert').fadeTo(500, 0).slideUp(500, function(){
        			$(this).remove(); 
    			});
			}, 1000);
			</script>");
		header("location: details.php?a_id=$a_id");
		}else{
		set_message("<p class='bg-danger text-center'> Sorry! Not insert </p>");

		redirect("details.php?a_id=$a_id");

		}
    }

}
 
}



/************----------Function of add Comment----------**************/


function insert_comment($comment,$filename,$folder,$pdfName,$folder_pdf,$videoName,$folder_video,$url,$q_id,$a_id) {

	$comment = escape($comment);
	$url 	 = escape($url);


    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');



$qry="SELECT user_id FROM users WHERE email='$_SESSION[email]'";
$result = query($qry);
confirm($result);
$row1=fetch_array($result);
$id = $row1['user_id'];

$q_no = $q_id;
$a_no = $a_id;

// ######################### Insert in Answer Vote ########################

$sql = "INSERT INTO answer_vote(upvotes, downvotes, reports, answer_ID)";

// INSERT INTO `answer_vote` (`ans_vote_ID`, `upvotes`, `downvotes`, `reports`, `answer_ID`) VALUES (NULL, '0', '0', '0', '6');

$sql.= "VALUES('0', '0', '0', '$a_no')";


	$result=query($sql);
	confirm($result);

$sql = "INSERT INTO discussion(communication,image,img_src,pdf,pdf_src,video,video_src,link,d_user_id,q_no,a_no,d_date_time,approve)";

$sql.= "VALUES('$comment','$filename','$folder','$pdfName','$folder_pdf','$videoName','$folder_video','$url','$id','$q_no','$a_no','$date',1)";

	$result1=query($sql);
	confirm($result1);


	return true;
	}







/***********--------------Single Comment function-------------*************/

function validate_comment(){

	$errors=[];
	$min = 3;
	$max = 20;

 if($_SERVER['REQUEST_METHOD']=="POST"){
 // if($_POST['firstSubmit']){
 	if ( isset($_POST['firstSubmit']) )   {

	$comment	 =clean($_POST['comment']);
	$q_id	     =clean($_POST['q_id']);
    $a_id	     =clean($_POST['a_id']);
   

if(empty($comment)) {

	$errors[]="Your comment cannot be empty";
}


    if(!empty($errors)) {

	foreach ($errors as $error) {

	echo validation_errors($error);

	}
}else{
	if(insert_dis_comment($comment,$a_id,$q_id)){

		set_message("<div class='alert alert-success  text-center'><strong>Thank you!</strong> Your message has been sent successfully</div> 
			<script type='text/javascript'>
    		window.setTimeout(function() {
    			$('.alert').fadeTo(500, 0).slideUp(500, function(){
        			$(this).remove(); 
    			});
			}, 5000);
			</script>");

		header("location: details.php?a_id=$a_id");
		}else{
		set_message("<div class='alert alert-danger'  text-center'><strong>Sorry</strong>, your message could not be sent </div>");

		redirect("index.php");

		}
	}
  }
}   //End Function
}



/***********----- Insert discussion message-----***************/

function insert_dis_comment($comment,$a_id,$q_id) {
	echo "data: $comment";
	$comment = escape($comment);
	$q_id    = escape($q_id);
	$a_id    = escape($a_id);
	
    date_default_timezone_set('Asia/Kolkata');
     $date = date('Y-m-d H:i:s');


$qry="SELECT user_id FROM users WHERE email='$_SESSION[email]'";
$result = query($qry);
confirm($result);
$row1=fetch_array($result);
$id = $row1['user_id'];

$q_no = $q_id;
$a_no = $a_id;


$sql = "INSERT INTO discussion(communication,d_user_id,q_no,a_no,d_date_time,approve)";

$sql.= "VALUES('$comment','$id','$q_no','$a_no','$date',1)";


	$result=query($sql);
	confirm($result);

	return true;
}   //  End Function








/***********--------------User Query function-------------*************/

function validate_post_query(){

	$errors=[];
	$min = 3;
	$max = 20;

if($_SERVER['REQUEST_METHOD']=="POST"){

	$subject	 =clean($_POST['subject']);
    $p_query     =clean($_POST['p_query']);

if(empty($subject)) {

	$errors[]="Subject field cannot be empty";
}
    
if(empty($p_query)) {

	$errors[]="Message field cannot be empty";
}


    if(!empty($errors)) {

	foreach ($errors as $error) {

	echo validation_errors($error);

	}
}else{
	if(insert_cus_query($subject,$p_query)){

		set_message("<div class='alert alert-success  text-center'><strong>Thank you!</strong> Your message has been sent successfully</div> 
			<script type='text/javascript'>
    		window.setTimeout(function() {
    			$('.alert').fadeTo(500, 0).slideUp(500, function(){
        			$(this).remove(); 
    			});
			}, 5000);
			</script>");

		redirect("query.php");
		}else{
		set_message("<div class='alert alert-danger'  text-center'><strong>Sorry</strong>, your message could not be sent </div>");

		redirect("query.php");

		}
	}
  }
}   //End Function




/***********----- Insert User Query message-----***************/

function insert_cus_query($subject,$p_query) {

	$subject = escape($subject);
    $p_query = escape($p_query);
  
    date_default_timezone_set('Asia/Kolkata');
     $date = date('Y-m-d H:i:s');
    
    
$qry="SELECT user_id FROM users WHERE email='$_SESSION[email]'";
$result = query($qry);
confirm($result);
$row1=fetch_array($result);
$id = $row1['user_id'];


$sql = "INSERT INTO post_query(user_subject,user_description,user_des_time,user_des_id,status)";

$sql.="VALUES('$subject','$p_query','$date','$id','unread')";

	$result=query($sql);
	confirm($result);

	return true;
}   //  End Function



























?>