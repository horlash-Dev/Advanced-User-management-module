<?php 
//require_once '../classes/view.class.php';
require_once '../vendor/autoload.php';
$authFgt= new view();
if (isset($_POST['tokenAuth'])) {
	$newPassword= $authFgt->intInput($_POST['fpass']);
	$confirmPass= $authFgt->intInput($_POST['cfpass']);
	$idtoken= $authFgt->intInput($_POST['idtoken']);
	$tokenKey= $authFgt->intInput($_POST['tokenKey']);
	if (isset($authFgt->error)) {
		header("location: forgo_t.php?empty");
		exit();
	}elseif ($authFgt->passwordVerify($newPassword)) {
        echo $authFgt->erMsg("minimum of 6-10 characters & symbols_.,!*$\?#@%|");
    }	elseif ($newPassword !== $confirmPass) {
		header("location: forgo_t.php?matcherr");
		exit();
	}elseif ($row= $authFgt->verify($tokenKey)) { $row["token"];
		if (password_verify($idtoken, $row['token']) !== false) {
			if ($tokenMail= $authFgt->authToken($tokenKey)) {
				$mail= $tokenMail['rMail'];
				$hashedpass= password_hash($newPassword, PASSWORD_DEFAULT);
				if ($authFgt->updtpass($hashedpass,$mail) !== false) {
					if ($authFgt->fgtDel($mail) !== null) {
					header("location: forgo_t.php?success");
					exit();}
				}
			}else{
				header("location: forgo_t.php?expired");
				exit();
			}
		 }else{
		 	header("location: forgo_t.php?invalid-id");
		 exit();
		 }
}else{
		header("location: forgo_t.php?linkexp");
		exit();
	}

}else{
	header("location: forgo_t.php?404");
	exit();
}

 ?>