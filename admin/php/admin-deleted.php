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
                <div class="card-header bg-danger"><h2>total users on site</h2></div>
                    <div class="card-body">
                        <div class="table-responsive" id="totalDeleted">
                            <p class="card-text text-center lead">loading....</p> 
                        </div>
                    </div>
            </div>
        </div>   
    </div>
</div>
<?php require 'admin-footer.php'; ?>