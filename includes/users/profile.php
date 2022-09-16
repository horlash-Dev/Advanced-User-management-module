<?php 
require 'header.in.php';
 $arrayName = array('fname' =>$Current->cFname,'lname' =>$Current->cLname); 
$fullname= implode(" ", $arrayName);
$date= date('D M Y, h:i:a', strtotime($Current->Create_at)); 

 ?>
<main id="section1">
	<div class="container">
		<div class="wrapper" id="content1">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="content">
						<p id="rtt"></p>
						<blockquote><strong>dear <?= $Current->cFname; ?></strong></blockquote>
						<div class="message">
							<h2>welcome to your profile</h2>
							<h5><blockquote>click on the below to view</blockquote></h5>
							<div class="blockquote-footer"><b>advanced settings....</b></div>
							<div class="links">
								<a href="" class="btn btn-primary btn-md px-3"><i class="fas fa-cogs m-2"></i>settings</a>
								<a href="" class="btn btn-primary btn-md px-3"><i class="fas fa-cogs m-2"></i>change password</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="content">
						<div class="head">
							<?php if (!$Current->cPic): ?>
							<img src="../../img/war.png" width="100">
							<?php else: 
								echo "<img src='../uploads/profile".$Current->cid.".jpg?id='".mt_rand()." width='100'>";
								?>					
							<?php endif ?>
							<div style="display: inline-block;">
								<h3><?= $fullname; ?></h3>
							<i>member@user management system</i></div>
						</div>
						<div><p id="info"></p></div>
						<div class="card border-primary">
							<div class="card-body list-group list-group-flush">
								<h3 class=""><i class="fas fa-user"></i>profille details</h3>
								<hr>
								<p class="card-text py-2 m-1 rounded list-group-item"><b>fullname : <span class="px-2"><?= $fullname; ?></span></p>
									<p class="card-text py-2 m-1 rounded list-group-item"><b>username : <span class="px-2"><?= $Current->cUser; ?></span></p>
									<p class="card-text py-2 m-1 rounded list-group-item"><b>email : <span class="px-2"><?= $Current->cEmail; ?></span></p>
									<p class="card-text py-2 m-1 rounded list-group-item"><b>gender : <span class="px-2"><?= $Current->cGender; ?></span></p>
									<p class="card-text py-2 m-1 rounded list-group-item"><b>date of birth : <span class="px-2"><?= $Current->cDob; ?></span></p>
									<p class="card-text py-2 m-1 rounded list-group-item"><b>email verification : <span class="px-2"><?= $Current->verification; ?></span>
										<?php if ($Current->cVerify == false): ?>
											<a href="" class="btn btn-danger btn-sm" id="mailVerify">verify now</a>	
										<?php endif ?>
									</p>
									<div class="blockquote-footer list-group-item"><strong>registered on: <?= $date; ?></strong></div>

							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>

		<!-- 2222 -->
		<div class="wrapper"  id="content2">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="content">
						<blockquote><strong>dear <?= $Current->cFname; ?></strong></blockquote>
						<div class="message">
							<h2>here you can make changes</h2>
							<h5><blockquote>to your account by editing & updating your details...</blockquote></h5>
							<div class="links">
								<a href="" class="btn btn-primary btn-md px-3"><i class="fas fa-cogs m-2"></i>back to profile</a>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="content">
						<div class="title bg-secondary text-center"><h2>make changes</h2></div>
						<div class="head">
							<?php if (!$Current->cPic): ?>
							<img src="../../img/war.png" width="100">
							<?php else: 
								echo "<img src='../uploads/profile".$Current->cid.".jpg?'".mt_rand()."; width='100'>";
								?>					
							<?php endif ?>
							<div style="display: inline-block;">
							<h3><?= $fullname; ?></h3>
							<i>member@user management system</i></div>
						</div>
					<form class="form" id="userData" action="" method="" enctype="multipart/form-data">
						<div><p id="Err"></p></div>
						<div class="input-group mb-4 px-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="">add profile image</span>
						  </div>
						  <div class="custom-file">
						    <input type="file" class=" custom-file-input" name="profileImage">
						    <label class="custom-file-label " for="inputGroupFile01">Choose file</label>
						  </div>
						</div>
						<input type="submit" name="" id="fileSubmit" value="upload image" class="btn btn-primary btn-md px-2 py-2"><i class=" m-2">
					</form>
				<form class="form-inline" id="userData1" action="" method="">
					<input type="hidden" name="myid" class="form-control" value="<?= $Current->cid; ?>">
			<div class="input-group mb-4 px-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
 		 </div>
  		<input type="text" class="form-control" value="<?= $Current->cFname; ?>" id="" name="fname" placeholder="firstname">
		</div>
		<div class="input-group mb-4 px-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
 		 </div>
  		<input type="text" class="form-control" value="<?= $Current->cLname; ?>" id="lname" name="lname" placeholder="lastname">
		</div>
		<div class="input-group mb-4 px-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
 		 </div>
  		<input type="text" class="form-control" value="<?= $Current->cUser; ?>" id="" name="username" placeholder="username">
		</div>
		<div class="input-group mb-4 px-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
 		 </div>
  		<input type="date" class="form-control" value="<?= $Current->cDob; ?>" id="" name="date" placeholder="date">
		</div>
		<div class="input-group mb-4 px-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
 		 </div>
  			<select class="form-control" name="gender">
  				<option value=""   <?php if ($Current->cGender === null){ echo 'selected';}?>>select gender</option>
  				<option value="male" <?php if ($Current->cGender === "male"){ echo 'selected';}?>>male</option>
  				<option value="female" <?php if ($Current->cGender === "female"){ echo 'selected';}?>>female</option>
  			</select>
		</div>
		<input type="submit" name="" id="profileUP" value="update profile" class="btn btn-primary btn-block px-2 py-2"><i class=" m-2">
					</form>
					</div>
				</div>
				
			</div>
		</div>

<!-- 333 -->
		<div class="wrapper"  id="content3">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="content">
						<blockquote><strong>dear <?= $Current->cFname; ?></strong></blockquote>
						<div class="message">
							<h2>here you can change your security details</h2>
							<h5><blockquote>by updating your password</blockquote></h5>
							<div class="blockquote-footer"><i class="lead"><b>note:</b>keep your password save</i></b></div>
							<div class="links">
								<a href="" class="btn btn-primary btn-md px-3"><i class="fas fa-cogs m-2"></i>back to profile</a>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="content">
				<div class="title bg-secondary text-center"><h2>change password</h2></div>
				<div><p id="Error"></p></div>
			<form class="" id="userData2" action="" method="">		
			<div class="input-group mb-4 px-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
 		 </div>
  		<input type="text" class="form-control"  id="" name="upass" placeholder="currrent password">
		</div>
		<div class="input-group mb-4 px-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
 		 </div>
  		<input type="text" class="form-control"  id="newpass" name="newpass" placeholder="new password">
		</div>
		<div class="input-group mb-4 px-3">
  		<div class="input-group-prepend">
    		<span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
 		 </div>
  		<input type="text" class="form-control"  id="ucpass" name="ucpass" placeholder="confirm password">
		</div>
		<input type="submit" name="" id="passSubmit" value="change password" class="btn btn-primary btn-block px-2 py-2"><i class=" m-2">
					</form>
					</div>
				</div>
				
			</div>
		</div>

	</div>

</main>


 <?php require 'footer.in.php'; ?>