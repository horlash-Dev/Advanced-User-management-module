<?php 
 
 require_once '../vendor/autoload.php';
 $verify= new user();
if (isset($_GET['idverify'])) {
$mail= $_GET['idverify'];
if ($verify->emailVerify($mail)) {
	header("location: forgo_t.php?emailinfo");
	exit();
  }
}else{
	header("location: forgo_t.php?linknull");
	exit();
}

 ?>

