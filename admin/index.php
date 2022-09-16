<?php 
session_start();
//echo $_SESSION['admin_connected'];
if (isset($_SESSION['admin_connected'])) {
	header("location: php/admin_dashboard.php");
	exit();
}
 ?>

<!DOCTYPE html>
<html>
<head>
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
	<title></title>
	<style type="text/css">
		html,body{
			height: 100%;
		}
		.row{

		}
	</style>
</head>
<body>
<section>
	
	<div class="container h-100">
		<div class="head">
				<h2>admin login panel</h2><i class="fas fa-lock"></i>
			</div>
		<div class="row h-100 justify-content-center align-items-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h2>admin login <i class="fas fa-lock"></i></h2>
					</div>
	<div class="card-body">
		<div><p class="message"></p></div>
	<form  action="" method="POST" id="adminData">
      <div class="form-group">
        <label>panel username</label>
        <input type="text" name="user-admin" class="form-control" id="user" placeholder="username"
        value=''> 
    	</div>
    	<div class="form-group">
        <label>panel password</label>
        <input type="text" name="pass-admin" class="form-control" id="user" placeholder="passowrd"
        value=''> 
    	</div>
		<input type="submit" name="login" id="login-admin" class="btn btn-success btn-block m-1 text-center" value="login">
    </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/verify.ad.js"></script>
	<script src="assets/js/sweetalert2.all.min.js"></script>
</body>
</html>