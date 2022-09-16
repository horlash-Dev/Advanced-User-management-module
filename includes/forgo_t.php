<?php 
require 'header.php';
$errInfo= "";
$sucInfo= "";
if (isset($_GET['id']) && isset($_GET['token'])) {
	$id= $_GET['id'];
	$tokenKey= $_GET['token'];
	if (empty($id) || empty($tokenKey)) {
		header('location: forgo_t.php?tokenempty');
		exit();
	}else{
		if (ctype_xdigit($id) !== false && ctype_xdigit($tokenKey) !== false) {?>

 <div class="container">
	<div class="wrapper ">
		<div class="row justify-content-center">
			<div class="col-lg-5">
			<div class="jumbotron mt-4">
				<div class="content">

 <div class="card" id="card3" style="width: 22rem;">
		<div class="card-header">
		<h4>hey! reset your password  below </h4>
		<p> required to retrieve your account</p>
				<div class="card-line"><hr>
					<div class="px-2"><p id="fgtMsg"><b><?= $errInfo; ?></b></p></div>
				</div>
		</div>
	<div class="card-body">
		<form  action="retrieve.in.php" method="POST" id="formData3">
			<input type='hidden' class='form-control mb-2' name='idtoken' value="<?php echo $id; ?>">
			<input type='hidden' class='form-control mb-2' name='tokenKey' value="<?php echo $tokenKey; ?>">
      	<div class="input-group mb-2">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1"><i class="fab fa-message"></i></span>
 		 </div>
  		<input type='text' class='form-control'  id='fpass' name='fpass' placeholder='password'>
		</div>
		<div class="input-group mb-2">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1"><i class="fas fa-message"></i></span>
 		 </div>
  		<input type='text' class='form-control'  id='cfpass' name='cfpass' placeholder='confirm password'>
		</div>
       <input type="submit" name="tokenAuth" class="btn btn-success btn-md px-2 m-1 text-center" value="submit">
    </form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php 
	}else{
		header("location: forgo_t.php?tokenerr");
		exit();
	}
}
}
 ?>
<?php 
if (isset($_GET['id']) || isset($_GET['tokenKey'])) {
echo '<style type="">
		.wrapper-item{display: none;}</style>';	
}else{
if (isset($_GET['tokenempty']) || isset($_GET['tokenerr'])) {
		$errInfo = "
	<div class='alert alert-danger alert-dismissible'>
	<button class='close' data-dismiss='alert'>&times</button>
	<span><b>invalid link, try again.</b></span></div>";
	} elseif (isset($_GET['empty'])) {
		$errInfo = "
	<div class='alert alert-danger alert-dismissible'>
	<button class='close' data-dismiss='alert'>&times</button>
	<span><b>fill in the blanks, try again</b></span></div>";
	}elseif (isset($_GET['matcherr'])) {
		$errInfo = "
	<div class='alert alert-danger alert-dismissible'>
	<button class='close' data-dismiss='alert'>&times</button>
	<span><b>password donot match try again</b></span></div>";
	} elseif (isset($_GET['expired']) || isset($_GET['linkexp']) || isset($_GET['invalid-id']) || isset($_GET['linknull'])) {
		$errInfo = "
	<div class='alert alert-danger alert-dismissible'>
	<button class='close' data-dismiss='alert'>&times</button>
	<span><b>Token expired, try again.</b></span></div>";
	} elseif (isset($_GET['success'])) {
	$sucInfo=
"<div class='alert alert-success alert-dismissible'>
	<button class='close' data-dismiss='alert'>&times</button>
	<span><b>dear user you have successfully retrieve your password please login here <br/><a href='../index.php'>login here!!</a></b></span></div>";
	}
	elseif (isset($_GET['emailinfo'])) {
	$sucInfo=
"<div class='alert alert-success alert-dismissible'>
	<button class='close' data-dismiss='alert'>&times</button>
	<span><b>dear user please login to continue... <br/><a href='../index.php'>login here!!</a></b></span></div>";
	}
	}
 ?>

<div class="container wrapper-item">
	<div class="wrapper">
		<div class="row justify-content-center">
			<div class="col-lg-5">
			<div class="jumbotron mt-4">
				<div class="content">

	 <div class="card" id="card3" style="width: 22rem;">
		<div class="card-header">
		<h4>notification</h4>
		<?= $sucInfo;   ?>
		<div class="px-2"><p id="fgtMsg"><b><?= $errInfo; ?></b></p></div>
				
		</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php require 'footer.php'; ?>