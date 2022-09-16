<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" type="text/css" href="fontawesome/css/solid.min.css">
<link rel="stylesheet" type="text/css" href="fontawesome/css/regular.min.css">
<link rel="stylesheet" type="text/css" href="fontawesome/css/brands.min.css">
<link rel="stylesheet" type="text/css" href="data/datatables.min.css">
<link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
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
		padding: 15px;
		max-width: 100%;
	}
	p,cite {
		padding-top: 12px;
		justify-content: flex-end;
		display:block;
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
            <a class="navbar-brand" href=""><i class="fas fa-anchor fa-2x"></i></a>
            
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href=""><i class="fas fa-home fa-1x m-1"></i>Home</a>
                    </li>
                            <li class="nav-item">
                                <a class="nav-link" href=""><i class="fas fa-home fa-1x m-1"></i>account info</a>
                            </li>   
                            <li class="nav-item">
                                <a class="nav-link" href=""><i class="fas fa-home fa-1x m-1"></i>feedback</a>
                            </li>   
                            <li class="nav-item">
                                <a class="nav-link" href=""><i class="fas fa-home fa-1x m-1"></i>Tesmonials</a>
                            </li>     
                            <li class="nav-item">
                                <a class="nav-link" href=""><i class="fas fa-bell fa-1x m-1"></i>notifications</a>
                          </li>
                            <li class="nav-item dropdown">
							    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
							    <div class="dropdown-menu">
							      <a class="dropdown-item" href="#">Action</a>
							      <a class="dropdown-item" href="#">Another action</a>
							      <a class="dropdown-item" href="#">Something else here</a>
							      <div class="dropdown-divider"></div>
							      <a class="dropdown-item" href="#">Separated link</a>
							    </div>
							  </li>
            </ul>
            </div>
        </nav>
    </section>

<div class="container">
	<div class="wrapper ">
	<div class="jumbotron mt-4">
	<div class="menus">
	<ul class="nav justify-content-end">
  <li class="nav-item">
    <a class="nav-link active" href="#"><i class="fas fa-home fa-1x m-1"></i>My Account</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#"><i class="fas fa-home fa-1x m-1"></i>notifications</a>
  </li>
</ul>
</div>

		<div class="row">
			<div class="col-lg-7 col-md-6 col-xs-5">
			<div class="content">
				<div class="img-al">
					<blockquote><i class="fas fa-anchor fa-2x px-4"></i></blockquote>
					<img src="img/ban1.jpg" align="left" height="350"  alt="welcome image" class="img-responsive">
				</div>
				
				</div>
				
			</div>
			<div class="col-lg-5 col-md-5 col-xs-5">
				<div class="content">
					<div class="content-text">
						<h2 class="">welcome to your dashboard <i>xplore</i></h2>
						<cite class="text-center"><b>Lorem ipsum dolor sit amet, consectetur adipisicing elit</b></cite>
						<p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
						<div class="meta mt-4 mb-1">
							<hr>
							<blockquote><i><b>connect with us ....</b></i></blockquote>
							<a href="#"><i class="fab fa-whatsapp m-1 fa-1x"></i></a>
							<a href="#"><i class="fab fa-twitter m-1 fa-1x"></i></a>
							<a href="#"><i class="fab fa-instagram m-1 fa-1x"></i></a>
						</div>
						<a href="#" class="btn text-center btn-outline-secondary btn-md mt-2">click here</a>
						<a href="#" class="btn text-center btn-primary px-3  btn-md mt-2 ">click here</a>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
</div>

 <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>