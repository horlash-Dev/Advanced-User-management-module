<?php 
//require_once 'main.class.php';
class control extends main implements database,formValidation
{	public $error;

	public function insert($fname,$lname,$email,$user,$password)
	{
		return $this->intInsert($fname,$lname,$email,$user,$password);
	}
	
	public function userInfo($eData)
	{
	return $this->intSelect($eData);
	}
		public function row()
	{
		return $this->intRow();
	}
	public function login($data)
	{
		return $this->intLogin($data);
	}
	public function login_time($id,$date)
	{
		return  parent::login_ses($id,$date);
	}
	public function log_delt($id)
	{
		return parent::log_del($id);
	}
	public function login_checks($timeout,$id)
	{
		return parent::login_check($timeout,$id);
	}
	public function linkExp($value)
	{
		return $this->linkEx($value);
	}
		public function notification($id,$topic,$timeline)
	{
		return parent::intNotification($id,$topic,$timeline);
	}
	public function intInput($value)
	{	if (empty($value)) {
			return $this->error = $value;
		}else{
		$value = trim($value);
		$value = stripslashes($value);
		$value = filter_var($value, FILTER_SANITIZE_STRING);
		$value = htmlspecialchars($value);
		return $value;	
		}
		
	}
	public function valInput($value)
	{	if (!preg_match("/^[a-zA-Z0-9\s]{4,18}$/", $value)) {
		return $value;
	}
	}
	public function Mail($value)
	{	$value= filter_var($value, FILTER_SANITIZE_EMAIL);
		if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
			return $value;
		}
		return $this->intMail($value);
	}
	public function user($user)
	{
		return $this->intUser($user);
	}
	public function passwordVerify($value)
	{if (!preg_match("/^[a-zA-Z0-9_.,!*$?#@%|\s]{6,10}$/", $value)) {
		return $value;
	}
	}
	public function userV($value)
	{if (!preg_match("/^[a-zA-Z0-9_.,!*$?#@%{}()|;\s]{4,200}$/", $value)) {
		return $value;
	}
	}
	public function fgtDel($value)
	{
		return $this->resetDel($value);
	}
	public function fgtInsert($rmail,$token,$tokenVerify)
	{
		return $this->resetInsert($rmail,$token,$tokenVerify);
	}
	public function authToken($vtoken)
	{
		return parent::intToken($vtoken);
	}
		public function verify($vtoken)
	{
		return parent::tokenVerify($vtoken);
	}
	public function updtpass($password,$mail)
	{
		return parent::Updtpassword($password,$mail);
	}
	public function erMsg($output)
	{	$output = "
	<div class='alert alert-danger alert-dismissible'>
	<button class='close' data-dismiss='alert'>&times</button>
	<span><b>".$output."</b></span></div>";
	return $output;
	}
	public function sucMsg($output)
	{	$output = "
	<div class='alert alert-success alert-dismissible'>
	<button class='close' data-dismiss='alert'>&times</button>
	<span><b>".$output."</b></span></div>";
	return $output;
	}

	public function timeGone($time)
	{	 //date_timezone_set();
		date_default_timezone_set('Africa/Lagos');
		$time= strtotime($time)? strtotime($time): $time;
		$current= time() - $time;
		switch ($current) {
			case $current <= 60:
				return "just now";
				break;

			case $current >= 60 && $current <= 3600:
				return (round($current/60) == 1)? "a minute ago...": round($current/60)." minutes ago..";
				break;
			case $current >= 3600 && $current <= 86400:
				return (round($current/3600) == 1)? "an hour ago...": round($current/3600)." hours ago..";
				break;

			case $current >= 86400 && $current <= 604800:
				return (round($current/86400) == 1)? "one day ago...": round($current/86400)." days ago..";
				break;
			case $current >= 604800 && $current <= 2600640:
				return (round($current/604800) == 1)? "one week ago...": round($current/604800)." weeks ago..";
				break;
			case $current >= 2600640 && $current <= 31207680 :
				return (round($current/2600640) == 1)? "a months ago...": round($current/2600640)." months ago..";
				break;

			case $current >= 31207680 :
				return (round($current/31207680) == 1)? "a year ago...": round($current/31207680)." years ago..";
				break;
		}
	}

	// public function empty($fname,$lname,$email,$user,$password)
	// { if (empty($fname) || empty($lname) || empty($mail) || empty($user) || empty($password)) {
	// return true;
	// }
	// }
}
 ?>