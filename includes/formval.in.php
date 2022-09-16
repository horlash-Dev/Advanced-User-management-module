<?php 
require_once '../vendor/autoload.php';
$command = new view();
session_start();
if (isset($_POST['register']) && $_POST['register'] === "save") {
	$fname = $command->intInput($_POST['fname']);
	$lname = $command->intInput($_POST['lname']);
	$email = $command->intInput($_POST['mail']);
	$user = $command->intInput($_POST['users']);
	$password = $command->intInput($_POST['pass']);
	$hash = password_hash($password, PASSWORD_DEFAULT); 
	if (isset($command->error)) {
	echo $command->erMsg("empty field");
	} elseif ($command->Mail($email) == true) {
		echo $command->erMsg("email already taken");
	}elseif ($command->user($user) == true) {
		echo $command->erMsg("username already taken");
	}

	else{
		if ($command->insert($fname,$lname,$email,$user,$hash)) {
			 $sucess = $command->sucMsg("successfully registred");
			echo $sucess= "success";
			$_SESSION['details'] = $user;
			}else {
				if ($command->insert($fname,$lname,$email,$user,$hash) == false){
						echo $command->erMsg("oops!! something went wrong!");
				}
				
			}
	}

}
	

		
	

	
 ?>