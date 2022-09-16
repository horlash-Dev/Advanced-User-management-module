<?php 
 require_once 'vendor/autoload.php';
 $admin= new user;
 $user_ip=$_SERVER['REMOTE_ADDR'];
$page_id= true;
$date= date('Y-m-d');
if ($admin->total_crf($page_id,$user_ip)) {
	$admin->total_hits($page_id,'home_page');
}else{
	$admin->hits_insert($user_ip,$page_id,$date) !== false;
	$admin->total_hits($page_id,'home_page');
}
date_default_timezone_set('africa/lagos');
 if (isset($_GET['post'])) {
	$page= $_GET['post'];}else{$page= 1;}

$Current= new session();
 $Current->sessionData();


 ?>
  <!DOCTYPE html>
<html lang="en">
<head>
	<title><?= ucfirst(basename($_SERVER['PHP_SELF'], ".php")); ?> | xProject</title>
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
<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/owl.theme.default.min.css">

<style type="text/css">
	section {
		margin-bottom: 50px;
		font-family: sans-serif;
		font-size: 14px;
		letter-spacing: 1px;
		text-transform: capitalize;
		font-weight: 500;
	}
	.navbar ul li {
		padding: 2px;
	}
	.navbar-brand{
		margin-left: 50px;
	}
	.container {
		width: 100%;
		margin: 0 auto ;
	}
	.wrapper {
		padding: 10;
		margin: 20px;
	}
	.jumbotron{
		max-width: 100%;
		padding: 2%;
		border-radius: 0px;
		font-weight: 450;
		text-transform: capitalize;
		display: inline-block;
		font-size: 14px;
		font-family: sans-serif;
	}
	.menus{
		margin-top: -20px;
		font-family: sans-serif;
		font-size: 13px;
		font-weight: 400;
	}
	.content-text{
		max-width:  90%;
		padding: 10px;
		font-size: 13px;
	}
	h2{
		font-size: 23px;
		font-weight: 600;
		padding-top: 15px;
		max-width: 100%;
	}
	p,cite {
		padding-top: 10px;
		padding-bottom: 15px;
		justify-content: flex-end;
		display:block;
		text-transform: lowercase;
		text-align: left;
	}
	.meta{
		max-width: 80%;
	}
	.btn {
		font-size: 13px;
	}

</style>
</head>
<body>  
 <section id="nav-bar">
    <nav class="navbar navbar-expand-lg  navbar-light">
            <a class="navbar-brand" href="">xProject&nbsp;<i class="fas fa-anchor fa-1.2x"></i></a>
            
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "../home.php")
                        ?"active":"";?>" href="home.php"><i class="fas fa-home fa-1x m-1"></i>Home</a>
                    </li>
                            <li class="nav-item">
                                <a class="nav-link" href="includes/users/profile.php"><i class="fas fa-user-circle fa-1x m-1"></i>account info</a>
                            </li>   
                            <li class="nav-item">
                                <a class="nav-link" href="includes/users/feedback.php"><i class="fas fa-comment-dots fa-1x m-1"></i>feedback</a>
                            </li>     
                            <li class="nav-item">
                                <a class="nav-link" href="includes/users/notification.php"><i class="fas fa-bell fa-1x m-1"></i>notification <span id="alerticon" class="badge badge-primary"></span></a>
							    </li>
							     <li class="nav-item dropdown">
							    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Hi!&nbsp;<i class="fas fa-user"><?= $Current->cFname;?></i></a>
							    <div class="dropdown-menu">
							      <a class="dropdown-item" href="#"><i class="fas fa-cog"></i>settings</a>
							      <a class="dropdown-item" href="includes/logout.in.php"> <i class="fas fa-cog"></i>logout</a>
							    
							  </li> 
						</ul>
            </div>
        </nav>

<div class="container">
	<div class="wrapper ">
		<?php if ($Current->verification === 'please verify your email!') {
			echo "<div class='alert alert-danger alert-dismissible'>
	<button class='close' data-dismiss='alert'>&times</button>
	<span><b>dear user we've sent you an email to validate your account, please check your mailbox...*</b></span></div>";
		} ?>
	<div class="main mt-4">
	<div class="row menus">
	<ul class="nav">
	 <div class="nav-heading">
	 <h3><i class="fas fa-home fa-1x m-1"></i>timeline</h3>
	 </div>
  <li class="nav-item">
    <a class="nav-link active" href="#"><i class="fas fa-home fa-1x m-1"></i>My Account</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#"><i class="fas fa-user fa-1x m-1"></i>welcome back! <?= $Current->cFname;?></a>
  </li>
</ul>
</div>
<div class="row">
	<div class="col-md-8 col-xs-12">
				<div class="content">
					<div class="content-text">
						<h2 class="">welcome to your dashboard <i>xplore</i></h2>
						<h4>my name is sam <?= $Current->cFname; ?> </h4>
						<cite class="text-left"><b>i join cux i like  <?= $Current->cFname; ?> </b></cite>
						<div class="meta mt-4 mb-1">
						<a href="#" id="story" data-toggle="modal" data-target="#addModal" class="btn text-center btn-success btn-md mt-2"><i class="fas fa-info fa-1x m-1"></i>add story</a>
						<a href="#" class="btn text-center btn-primary px-3  btn-md mt-2 ">click here</a>
						</div>
						
					</div>
					
				</div>
			</div>
</div>
<div class="">
<div class="">
<div class="row content-item  justify-content-center">

	<input type="hidden" id="selection" value='<?= $page; ?>'>
	<h3>loading....</h3>		
			</div>
			</div>
			</div>
			
			          <!-- Modal --> <div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true"> <div class="modal-dialog modal-dialog-scrollable"> <div class="modal-content"> <div class="modal-header"> <h3><i class="fas fa-user fa-1x m-1"></i>add story</h3><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"> 
			          	<br>
			          <strong class="errClass"></strong>
        <form  action="" method="" id="formDatas" class="col-md-12">
        	<input type="hidden" name="ids" class="form-control" value="<?= $Current->cid; ?>">
        <div class="form-group border-success">
        <label>title</label>
        <input type="text" name="title" class="form-control border-success" id="subject" placeholder="title">
      </div>
      <textarea class="form-control border-success" name="addtext"  placeholder="add text" rows="6"></textarea>
       <input type="submit" name="story" id="addStory" class="btn btn-success btn-md px-2 m-1 text-center" value="add story">
    </form></div></div> </div> </div>

    <!-- modal 2 -->
           <!-- Modal --> <div class="modal fade" id="addModal2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true"> <div class="modal-dialog modal-dialog-scrollable"> <div class="modal-content"> <div class="modal-header"> <h3><i class="fas fa-user fa-1x m-1"></i>update timeline</h3>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
           <div class="modal-body">
           <br> <strong class="errMsg"></strong> 
        <form  action="" method="POST" id="formData2" class="col-md-12">
        	<input type="hidden" name="uid" id="uid" class="form-control">
        <div class="form-group border-primary">
        <label>title</label>
        <input type="text" name="tupdate" class="form-control border-primary" id="tsubject" placeholder="title">
      </div>
      <textarea class="form-control border-primary" id="ttext" name="updatetext" placeholder="add text" rows="6"></textarea>
       <input type="submit" name="update" id="Ustory" class="btn btn-primary btn-md px-2 m-1 text-center" value="update timeline">
    </form></div></div> </div> </div>
		
	</div>
</div>
</div>
</section>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/user_validator.js"></script>
	<script src="assets/js/responsive.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	<script src="assets/js/sweetalert2.all.min.js"></script>	


<!-- 	<script src="https://unpkg.com/scrollreveal"></script> -->
</body>
</html>
<!-- 	<ul class="nav justify-content">
  <li class="nav-item">
    <a class="nav-link active btn btn-sm btn-info px-3 py-1 m-1" href="#" id="infoBtn"><i class="fas fa-info fa-1x m-1"></i>info</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active px-3 py-1 m-1 btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal2" id="editBtn" href="#"><i class="fas fa-pen fa-1x m-1"></i>edit</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active btn btn-sm btn-danger px-3 py-1 m-1" id="delBtn" href="#"><i class="fas fa-bin fa-1x m-1"></i>delete</a>
  </li>
</ul>			
			<div class="product-item" data-aos="zoom-in-down" data-aos-duration="300"> --> 
					 
					<!--  	<h4 class="product-title mt-4 ml-3"> highschool</h4>
					 	<i id="dis"></i>
							<cite class="lin px-1"><i class="fas fa-clock fa-1x m-1 "></i>published on</cite>
					 	<hr>
					 	 <p class="product-text px-2 py-2">This is a wider card with supporting text below as a natural lead-in to additional content. <br></p> --> 
					 	<!-- </div> -->