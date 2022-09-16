<?php 
//require_once 'view.class.php';
session_start();
// $Current = new view;
// $userData= $Current->uDetails();
//  $cid= $userData['id'];
//  $cFname= $userData['Fname'];
//  $cLname= $userData['Lname'];
//  $cEmail= $userData['Email'];
//  $cUser= $userData['User'];
//  $cPass= $userData['Pass'];
// // $cFname= $userData[''];


class session extends view
{	public $verification;
	public $cid;
	public $cFname;
	public $cLname;
	public $cEmail;
	public $cUser;
	public $cPass;
	public $cDob;
	public $Create_at;
	public $cPic;
	public $cVerify;
	public $cDelete;
	public $cGender;
	public function sessionData()
	{
	if ($_SESSION['details'] != null) {
	$userData= parent::uDetails();
  $this->cid= $userData['id'];
  $this->cFname= $userData['Fname'];
  $this->cLname= $userData['Lname'];
 $this->cEmail= $userData['Email'];
 $this->cUser= $userData['User'];
 $this->cPass= $userData['Pass'];
 $this->cDob= $userData['dob'];
 $this->Create_at= $userData['created_at'];
 $this->cPic= $userData['pic'];
 $this->cVerify= $userData['verified'];	
 $this->cDelete= $userData['deleted'];
 $this->cGender= $userData['gender'];
 if ($this->cVerify == false) {
	$this->verification= "please verify your email!"; 
		}else{
			$this->verification= '<a href="#" class="btn btn-success btn-sm">verified!</a>';
		}
	} else{
	if ($_SERVER['REQUEST_URI'] === "/admin/home.php") {
	header("location: index.php");
}else{
	header("location: ../../index.php");
}

}
}
public function ids()
{	$userData= parent::uDetails();
	return $this->cid= $userData['id'];
}
public function intP()
{	$userData= parent::uDetails();
	 $this->cPass= $userData['Pass']; 
	 $this->cid= $userData['id'];
	$this->cEmail= $userData['Email'];
}

	public function __call($value, $arg)
	{	return parent::erMsg("file donot exists " . "=> " .$value . var_dump($arg));
		
	}
}

// parent::erMsg("dear user your email is yet to be verified, we've sent you an verification link");