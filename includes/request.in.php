<?php
//require_once '../classes/view.class.php';
require_once '../vendor/autoload.php';
session_start();
$lKey = new view(); 
if (isset($_POST['login']) && $_POST['login'] === "access") {
	$user= $lKey->intInput($_POST['users']);
	$password= $lKey->intInput($_POST['pass']);
	if (isset($lKey->error)) {
		echo $lKey->erMsg("fill out blank fields");
	}elseif ($verify= $lKey->login($user)) {
		if (password_verify($password, $verify['Pass'])) {
			if (!empty($_POST['remember'])) {
				setcookie("username",$user,time()+(2*60),'/');
				setcookie("password",$password,time()+(2*60),'/');
			}else{
				setcookie("username","",'/');
				setcookie("password","",'/');
			}
			echo $logged= "success";
			$_SESSION['details'] = $user;
			 $lKey->sucMsg("account loggedin succefully");
		}else{
			echo $lKey->erMsg("password donot match");
		}
	}else{
		echo $lKey->erMsg("login details error");
	}
}



 ?>