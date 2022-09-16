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
                <div class="card-header bg-info"><h2>total feedback from users</h2></div>
                    <div class="card-body">
                        <div class="table-responsive" id="totalFeedb">
                            <p class="card-text text-center lead">loading....</p> 
                        </div>
                    </div>
            </div>
        </div>   
    </div>
</div>

<section>
    <div class="container">
        <div class="col-md-5">
               <!-- Modal --> <div class="modal fade" id="fdbmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true"> <div class="modal-dialog modal-dialog-scrollable"> <div class="modal-content"> <div class="modal-header"> <h3><i class="fas fa-user fa-1x m-1"></i>reply this feedback</h3><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div> <div class="modal-body"> 
            <br>
        <strong class="errClass"></strong>
        <form  action="" method="" id="feedbData" class="col-md-12">
        <div class="form-group border-info">
        <label>reply user</label>
     <textarea class="form-control border-info mt-2" id="feedbackdb"  placeholder="add text here..."  rows="4"></textarea>
      </div>
 
       <input type="submit" id="addfeed" class="btn btn-success btn-md px-2 m-1 text-center" value="send reply">
    </form></div></div> </div> </div>
         </div>
    </div>
</section>
<?php require 'admin-footer.php'; ?>