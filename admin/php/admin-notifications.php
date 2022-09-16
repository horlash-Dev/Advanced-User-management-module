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
                <div class="card-header bg-primary"><h2>all activities notification</h2></div>
                    <div class="card-body">
                        <div class="table-responsive" id="totalnotification">
                            <p class="card-text text-center lead">loading....</p> 
                        </div>
                    </div>
            </div>
        </div>   
    </div>
</div>

<?php require 'admin-footer.php'; ?>