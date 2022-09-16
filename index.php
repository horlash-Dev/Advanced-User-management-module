<?php  
session_start();
if (isset($_SESSION['details'])) {
	header("location: home.php");
}
 require_once 'vendor/autoload.php';
 $admin= new user;
 $user_ip=$_SERVER['REMOTE_ADDR'];
$page_id= '2';
$date= date('Y-m-d');
if ($admin->total_crf($page_id,$user_ip)) {
	$admin->total_hits($page_id,'welcome_page');
}else{
	$admin->hits_insert($user_ip,$page_id,$date) !== false;
	$admin->total_hits($page_id,'welcome_page');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<link rel="stylesheet" type="text/css" href="assets/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/fontawesome/css/solid.min.css">
<link rel="stylesheet" type="text/css" href="assets/fontawesome/css/regular.min.css">
<link rel="stylesheet" type="text/css" href="assets/fontawesome/css/brands.min.css">
<link rel="stylesheet" type="text/css" href="assets/data/datatables.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/sweetalert2.min.css">
</head>
<body>
    
<div class="container">
	<div class="wrapper ">
		<div class="row justify-content-center">
			<div class="col-lg-5">
			<div class="jumbotron mt-4">
				<div class="content">
					<div class="c-link">
						<a href="#" class="btn btn-md btn-info m-2" id="run">register</a>
						<a href="#" class="btn btn-md btn-info m-2" id="run2">login</a>
					</div>
			<div class="card-group">
		<div class="card" id="card1" style="width: 22rem; display: none;">
						<div class="card-header">
							<h4>welcome to user system</h4>
							<p>please register below</p>
							<div class="card-line"><hr>
							<div class="px-2"><p id="popMsg"><b></b></p></div>
							</div>
						</div>
	<div class="card-body">
		<form  action="" method="POST" id="formData">
        <div class="form-group">
        	<div class="error"></div>
        	<div class=".nm"></div>
        <label>firstname</label>
        <input type="text" name="fname" class="form-control" id="fname" placeholder="firstname">
      </div>
       	<div class="input-group mb-2">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
 		 </div>
  		<input type="text" class="form-control"  id="lname" name="lname" placeholder="lastname">
		</div>
        <div class="form-group">
        <label>email</label>
        <input type="" name="mail" class="form-control" id="mail" placeholder="email">
      </div>
      <div class="form-group">
        <label>username</label>
        <input type="text" name="users" class="form-control" id="user" placeholder="username">
      </div>
      	<div class="input-group mb-2">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
 		 </div>
  		<input type="text" class="form-control"  id="pas" name="pass"  placeholder="password">
		</div>
		<div class="input-group mb-2">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
 		 </div>
  		<input type="text" class="form-control"  id="cpas" name="cpass" placeholder="confirm-password">
		</div>
       <input type="submit" name="register" id="register" class="btn btn-success btn-md px-2 m-1 text-center" value="sign up">
    </form>
</div>
</div>

<div class="card" id="card2" style="width: 22rem; ">
		<div class="card-header">
		<h4>welcome to user system</h4>
		<p>please login below</p>
				<div class="card-line"><hr>
					<div class="px-2"><p id="showMsg"><b></b></p></div>
				</div>
		</div>
	<div class="card-body">
		<form  action="" method="POST" id="formData2">
      <div class="form-group">
        <label>username</label>
        <input type="text" name="users" class="form-control" id="user" placeholder="username"
        value='<?php if (isset($_COOKIE['username'])) {echo $_COOKIE['username'];} ?>'> </div>
      	<div class="input-group mb-2">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
 		 </div>
  		<input type='text' class='form-control'  id='pass' name='pass' placeholder='password'
  		value='<?php if (isset($_COOKIE["password"])) {echo $_COOKIE["password"];} ?>' 
  		>
		</div>
		<div class="form-group">
        <label class="px-1">remember me</label>
        <input type="checkbox" name="remember" class="form-control-input" id="rem" 
        <?php if (isset($_COOKIE["password"])) { ?> checked="" <?php } ?> >
        <a href="#" class="lead float-right forgotBtn">forgot password?</a>
      </div>
       <input type="submit" name="login" id="login" class="btn btn-success btn-md px-2 m-1 text-center" value="sign in">
    </form>
</div>
</div>


<div class="card" id="card3" style="width: 22rem; display: none;">
		<div class="card-header">
		<h4>ohh! you forgot your password</h4>
		<p>email is required to retrieve your account</p>
				<div class="card-line"><hr>
					<div class="px-2"><p id="fgtMsg"><b></b></p></div>
				</div>
		</div>
	<div class="card-body">
		<form  action="" method="POST" id="formData3">
      	<div class="input-group mb-2">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1"><i class="fas fa-message"></i></span>
 		 </div>
  		<input type='email' class='form-control'  id='fmail' name='fmail' placeholder='email'>
		</div>
       <input type="submit" name="forgot" id="forgot" class="btn btn-success btn-md px-2 m-1 text-center" value="submit">
    </form>
</div>
</div>
				
					</div>
					
				</div>
					
				</div>
			</div>		
		</div>
	</div>
</div>

	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/validator.js"></script>
	<script src="assets/js/sweetalert2.all.min.js"></script>	


	<!-- <script src="https://unpkg.com/scrollreveal"></script> -->
</body>
</html>