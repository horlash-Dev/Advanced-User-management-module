<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Instantiation and passing `true` enables exceptions
require_once '../vendor/autoload.php';
$mail = new PHPMailer(true);
$command = new view();
session_start();
if (isset($_POST['register']) && $_POST['register'] === "save") {
        date_default_timezone_set('Africa/Lagos');
    $date= date('Y-m-d H:i:s',STRTOTIME(date('h:i:sa')));
    $fname = $command->intInput($_POST['fname']);
    $lname = $command->intInput($_POST['lname']);
    $email = $command->intInput($_POST['mail']);
    $user = $command->intInput($_POST['users']);//valInput($value)
    $password = $command->intInput($_POST['pass']);
    $hash = password_hash($password, PASSWORD_DEFAULT); 
    if (isset($command->error)) {
    echo $command->erMsg("empty field");
    }elseif ($command->valInput($fname) || $command->valInput($lname) || $command->valInput($user)) {echo $command->erMsg("minimum of 4-18 character`s allowed/alphanumeric");} elseif ($command->Mail($email) == true) {
        echo $command->erMsg("email already taken or invalid email");
    }elseif ($command->user($user) == true) {
        echo $command->erMsg("username already taken");
    }elseif ($command->passwordVerify($password)) {
        echo $command->erMsg("password must be minimum of 6-10 characters & symbols_.,!*$\?#@%|");
    }else{
        if ($command->insert($fname,$lname,$email,$user,$hash)) {
             $sucess = $command->sucMsg("successfully registred");
            echo $sucess= "success";
            ///verify email
 $command->linkExp($email);
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
} catch (Exception $e) {}
       $_SESSION['details'] = $email;
       if (!isset($_SESSION['details'])) {
        echo $command->erMsg("fatal!! something went wrong!");
        }else{$fetch= $command->userInfo($email);
            $command->notification($fetch['id'],"User_added","upon successfull registration new user added!!") && $command->login_time($fetch['id'],$date) !== false;} 
       }else {
                if ($command->insert($fname,$lname,$email,$user,$hash) == false){
                        echo $command->erMsg("oops!! something went wrong!"); }
            }
    }

}
 ///login validation

$lKey = new view(); 
if (isset($_POST['login']) && $_POST['login'] === "access") {
    $user= $lKey->intInput($_POST['users']);
    $password= $lKey->intInput($_POST['pass']);
    date_default_timezone_set('Africa/Lagos');
    $date= date('Y-m-d H:i:s',STRTOTIME(date('h:i:sa')));
    if (isset($lKey->error)) {
        echo $lKey->erMsg("fill out blank fields");
    }elseif ($lKey->valInput($user)) {
         echo $lKey->erMsg("minimum of 4-18 character`s allowed/alphanumeric");
    }elseif ($verify= $lKey->login($user)) {
        if (password_verify($password, $verify['Pass'])) {
            if (!empty($_POST['remember'])) {
                setcookie("username",$user,time()+(2*60),'/');
                setcookie("password",$password,time()+(2*60),'/');
            }else{
                setcookie("username","",'/');
                setcookie("password","",'/');
                $command->log_delt($verify['id']);
            }if ($command->login_time($verify['id'],$date) !== false) {
            echo $logged= "success";
            $email= $verify['Email'];
            $_SESSION['details'] = $email;
            $_SESSION['start_time'] = time();
             $_SESSION['expire_time'] = $_SESSION['start_time'] + (20 * 60);
             $lKey->sucMsg("account loggedin succefully");   
                }
        }else{
            echo $lKey->erMsg("password donot match");
        }
    }else{
        echo $lKey->erMsg("login details error/user not found");
    }
}

//next

   

        
    