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

<section>
    <div class="container">
        <div class="col-md-10">
          <div class="table-responsive" id="totallogin">
            <p>loding...</p>
          </div>
        </div>
    </div>
</section>
<?php require 'admin-footer.php'; ?>