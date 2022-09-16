<?php
 require 'admin-header.php'; 
session_start();
if (!isset($_SESSION['admin_connected'])) {
	header("location: ../index.php");
	exit();
}
 require_once '../../vendor/autoload.php';
 use admin\php\control as admincontrol;
$command= new admincontrol();
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary"><h2>total users on site</h2></div>
                    <div class="card-body">
                        <div class="table-responsive" id="totalUser">
                            <p class="card-text text-center lead">loading....</p> 
                        </div>
                    </div>
            </div>
        </div>   
    </div>
</div>

<section>
    <div class="container">
        <div class="col-md-10">
            <div class="modal fade" id="adminModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true"> <div class="modal-dialog modal-dialog-scrollable"> <div class="modal-content"> <div class="modal-header"> <h3><i class="fas fa-user fa-1x m-1"></i>update user info</h3>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
           <div class="modal-body">
           <br> <strong class="errMsg"></strong> 
        <form  action="" method="POST" id="adminData" class="col-md-8">
            <input type="hidden" name="uid" id="uid" class="form-control">
        <div class="form-group border-primary">
        <label>firstname</label>
        <input type="text" name="fupdate" class="form-control border-primary" id="fsubject" placeholder="">
      </div>
      <div>
      <label>lastname</label>
        <input type="text" name="lupdate" class="form-control border-primary" id="lsubject" placeholder="">
      </div>
      <div>
      <label>username</label>
        <input type="text" name="urupdate" class="form-control border-primary" id="ursubject" placeholder="">
      </div>
      <div>
      <label>email</label>
        <input type="email" name="eupdate" class="form-control border-primary" id="esubject" placeholder="">
      </div>
      <div>
      <label>date</label>
        <input type="date" name="dupdate" class="form-control border-primary" id="dsubject" placeholder="">
      </div>
      <div>
      <label>verified</label>
        <input type="" name="vupdate" class="form-control border-primary" id="vsubject" placeholder="">
      </div>
       <input type="submit" name="AdminUt" id="AdminUt" class="btn btn-primary btn-md px-2 m-1 text-center" value="update user info">
    </form></div></div> </div> </div>
        </div>
    </div>
</section>
<?php require 'admin-footer.php'; ?>

    <div class="footer-bottom-wrapper row">
                            <div class="col-lg-3 col-sm-6 col-12 footer-logo">
                                <div class="logo"><a href="index.html"><img src="images/logo/logo.png" alt="Logo"></a></div>
                                <a href="#" class="mail-address">info@gmail.com</a>
                                <a href="#" class="phone-number">504. 987. 1295</a>
                            </div> <!-- /.footer-logo -->
                            <div class="col-lg-3 col-sm-6 col-12 footer-list">
                                <h4>Quick Links</h4>
                                <ul>
                                    <li><a href="#">How it Works</a></li>
                                    <li><a href="#">Guarantee</a></li>
                                    <li><a href="#">Security</a></li>
                                    <li><a href="#">Report Bug</a></li>
                                    <li><a href="#">Pricing</a></li>
                                </ul>
                            </div> <!-- /.footer-list -->
                            <div class="col-lg-3 col-sm-6 col-12 footer-list">
                                <h4>About Us</h4>
                                <ul>
                                    <li><a href="about-us.html">About Singleton</a></li>
                                    <li><a href="#">Jobs</a></li>
                                    <li><a href="team.html">Team</a></li>
                                    <li><a href="testimonial.html">Testimonials</a></li>
                                    <li><a href="blog-grid.html">Blog</a></li>
                                </ul>
                            </div> <!-- /.footer-list -->
                            <div class="col-lg-3 col-sm-6 col-12 footer-list">
                                <h4>Become A Member</h4>
                                <ul>
                                    <li><a href="#">Contributor</a></li>
                                    <li><a href="#">Union Member</a></li>
                                    <li><a href="#">Processing</a></li>
                                    <li><a href="#">Legal Action</a></li>
                                </ul>
                            </div> <!-- /.footer-list -->
                        </div> <!-- /.footer-bottom-wrapper -->
                            <div class="col-md-6 col-sm-4 col-12">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>