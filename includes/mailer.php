<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader require 'vendor/autoload.php';
require_once '../vendor/autoload.php';
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
//forgot password mailer....
$fgtKey = new view();
$Current= new session();
$Current->intP();
if (isset($_POST['forgot']) && $_POST['forgot'] === "token") {
$email= $fgtKey->intInput($_POST['fmail']);

if (isset($fgtKey->error)) {
	echo $fgtKey->erMsg("email is empty");
} elseif($fgtKey->Mail($email) == false){echo 
	$fgtKey->erMsg("oops! something went wrong, Email is not Registered.");
}
else{
$fgtKey->fgtDel($email);
 $token= bin2hex(random_bytes(3));
 $tokenHash= password_hash($token, PASSWORD_DEFAULT);
 $tokenVerify= uniqid();
 $tokenVerify= str_shuffle($tokenVerify);
 if ($fgtKey->fgtInsert($email,$tokenHash,$tokenVerify) !== false) {
    $fetch= $fgtKey->userInfo($email);
 	try {
    //Server settings
    $mail->SMTPDebug = 0;                      
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = conn::USERNAME;                     
    $mail->Password   = conn::PASSWORD;                         
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = 587;
    $mail->setFrom(conn::USERNAME, 'Qamvid User Management!!');    
    $mail->addAddress($email, 'Dear User');               
    $mail->addReplyTo(conn::USERNAME, 'launch complain');
    $mail->addCC($email);
    $mail->addBCC(conn::USERNAME);

    // Attachments
    //$mail->addAttachment('../img/war.png');    

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Reset Password';
    //$mail->msgHTML(file_get_contents('reset.html'), __DIR__)
    $mail->Body    = '<!DOCTYPE html>
<html>
<head>
	<style>
		.bold{
			text-transform: capitalize;
			font-size: 15px;
			font-family: helvetica;
			max-width: 100%;
			padding: 20px;
			margin: auto;
			text-align: justify;
			border-radius: 5px;
			background-color:rgba(0,0,0,0.1);
		}
	</style>
</head>
<body>
	<div class="bold">
<h3>qamvid user management system</h3>
<p>dear user you are receiving this mail because you request to <b>reset your password</b></p><br>
<i>kindly click the link below to reset</i><br>
<a href="http://localhost/admin/includes/forgo_t.php?id='.$token.'&token='.$tokenVerify.'" style="text-transform: lowercase;">
http://localhost/admin/reset.in.php?id='.$token.'&token='.$tokenVerify.'</a><br>
<i>donot mind the attachments, its an watermark</i>
</div>
</body>
</html>';
    $mail->AltBody = 'dear user you are receiving this mail because you request to <b>reset your password,kindly click the link below to reset, =>
    http://localhost/admin/includes/forgo_t.php?id='.$token.'&token='.$tokenVerify.'';
    $mail->send();
        $fgtKey->notification($fetch['id'],"Password reset","password reset link sent!!");
    echo $fgtKey->sucMsg("Success! Dear User We've Sent Reset Link To Reset Your Password,check your mailbox");
} catch (Exception $e) {
    echo $fgtKey->erMsg('oops! something went wrong, Message could not be sent.'.$mail->ErrorInfo.'');
}                                    
 	
 }else{
 	echo $fgtKey->erMsg("oops! something went wrong");
 }
}

		
}

///verify email
if (isset($_POST['email']) && $_POST['email'] === "verify") {
 $email= $Current->cEmail;
  $id= $Current->cid;
 $fgtKey->linkExp($email);
	try {
    //Server settings
    $mail->SMTPDebug = 0;                      
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = conn::USERNAME;                     
    $mail->Password   = conn::PASSWORD;                         
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = 587;
    $mail->setFrom(conn::USERNAME, 'Qamvid User Management!!');    
    $mail->addAddress($email, 'Dear User');               
    $mail->addReplyTo(conn::USERNAME, 'launch complain or reply to');
    $mail->addCC($email);
    $mail->addBCC(conn::USERNAME);

    // Attachments
    //$mail->addAttachment('../img/war.png');    

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Email Verification';
    //$mail->msgHTML(file_get_contents('reset.html'), __DIR__)
    $mail->Body    = '<!DOCTYPE html>
<html>
<head>
	<style>
		.bold{
			text-transform: capitalize;
			font-size: 15px;
			font-family: helvetica;
			max-width: 100%;
			padding: 20px;
			margin: auto;
			color: #000;
			text-align: justify;
			border-radius: 5px;
			background-color:rgba(0,0,0,0.1);
		}
	</style>
</head>
<body>
	<div class="bold">
<h3>qamvid user management system</h3>
<p>dear user you are receiving this mail because you request to <b>verify your email</b></p><br>
<i>kindly click the link below to continue...</i><br>
<a href="http://localhost/admin/includes/redirect.in.php?idverify='.$email.'" style="text-transform: lowercase;">
http://localhost/admin/includes/redirect.in.php?idverify='.$email.'</a><br>
<i></i>
</div>
</body>
</html>';
    $mail->AltBody = 'dear user you are receiving this mail because you request to <b>verify your email, kindly click the link below to continue, =>
    http://localhost/admin/includes/redirect.in.php?idverify='.$email.'';
    $mail->send();
        $fgtKey->notification($id,"Email Verification","Verification link sent!!");
    echo $fgtKey->sucMsg("Success! Dear User We've Sent you a verification Link, check your mailbox");
} catch (Exception $e) {
    echo $fgtKey->erMsg('oops! something went wrong, Message could not be sent.'.$mail->ErrorInfo.'');
}

}


 ?>