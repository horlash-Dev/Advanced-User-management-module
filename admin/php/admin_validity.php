<?php
use admin\php\control as admincontrol;
require_once '../../vendor/autoload.php';
$command= new control();
$timeline= new user();
$admincontrol= new admincontrol();
session_start();
date_default_timezone_set('africa/lagos');
if (isset($_POST['adminDB']) && $_POST['adminDB'] === "DBconnected") {
	 $username= $command->intInput($_POST['user-admin']);
	 $password= $command->intInput($_POST['pass-admin']);
	if (isset($command->error)) {
    echo $command->erMsg("empty field");
    }elseif ($command->valInput($username)) {echo $command->erMsg("minimum of 4-18 character`s allowed/alphanumeric");}elseif ($command->passwordVerify($password)) {
        echo $command->erMsg("minimum of 6-10 characters & symbols_.,!*$\?#@%|");
    }else{  if ($connect= $admincontrol->login_admin($username)) {
    		if (password_verify($password, $connect['pass_admin'])) {
    			print_r("admin-connected!");
    			$_SESSION['admin_connected']= $connect['user_admin'];
    		}else{echo $command->erMsg("danger, password error, wrong parameters....");}
    	}else{
    		echo $command->erMsg("danger, something went wrong, wrong parameters....");
    	}
   }
}
//admin select users
if (isset($_POST['usersinfo'])) {
    $id= $_POST['usersinfo'];
   $data= $admincontrol->usersInfo($id);
    echo json_encode($data);
}
//admin user info update
if (isset($_POST['admin_users'])) {
    $id= $_POST['admin_users'];
    $data= $admincontrol->usersInfo($id);
    echo json_encode($data);
}
//admin update users
if (isset($_POST['usrUt']) && $_POST['usrUt'] === "update") {
    
$id =$_POST['uid'];
    $date =$_POST['dupdate'];
     $fname = $command->intInput($_POST['fupdate']);
    $lname = $command->intInput($_POST['lupdate']);
    $user = $command->intInput($_POST['urupdate']);
    $email = $command->intInput($_POST['eupdate']);
    $verified = $_POST['vupdate'];
    if (isset($command->error)) {
    echo $command->erMsg("empty field");
    }elseif ($command->valInput($fname) || $command->valInput($lname) || $command->valInput($user)) {echo $command->erMsg("minimum of 4-18 character`s allowed/alphanumeric");}
    else{
        if ($admincontrol->userUpdate($fname,$lname,$user,$date,$email,$verified,$id) !== false) {
            print_r("admin-update-success!!");
        }else{$command->erMsg("oops! something went wrong!");}
    }

}
//feedback reply
if (isset($_POST['feedbackmsg'])) {
    $uid = $command->intInput($_POST['id']);
    $id = $command->intInput($_POST['ids']);
    $message = $command->intInput($_POST['feedbackmsg']);
    if (isset($command->error)) {
        echo $command->erMsg("fields empty");
    }elseif ($admincontrol->replyNotification($uid,$message) && $admincontrol->replied($id)) {
        print_r('admin-replied!');
    }
}
///admin delete a user
if (isset($_POST['delNo'])) {
     $id= $_POST['delNo'];
     $admincontrol->Deltusers(false,$id);

 } 

 ///restore a user
if (isset($_POST['resNo'])) {
     $id= $_POST['resNo'];
     $admincontrol->Deltusers(true,$id);

 }


   //mute a user
if (isset($_POST['muteNo'])) {
     $id= $_POST['muteNo'];
     $date= date('Y-m-d H:i:s',STRTOTIME(date('h:i:sa')));
     $admincontrol->muteUser(true,$date,$id) !== false;

 }

    //delete a user post
if (isset($_POST['upost'])) {
     $id= $_POST['upost'];
     $timeline->delete($id);
 }

    //delete a user notificationnotirows($id)
if (isset($_POST['delnotify'])) {
     $id= $_POST['delnotify'];
     $admincontrol->deletenoti($id);
 }
     //delete a user 
if (isset($_POST['notify'])) {
    if ($_POST['notify'] != '') {
        $admincontrol->notifyupdate();
    }
    $counter= $admincontrol->notifyrows();
    $datas = array('counter' => $counter);
    echo json_encode($datas);
 }
 //export=admin-users-download
 
if (isset($_GET['export']) && $_GET['export'] === "admin-users-download"){
    header("content-type: Application/xls");
    header("content-disposition: attachment; filename=xproject-user.xls");
    header("pragma: no-cache");
    header("expires: 0");
   $data= $admincontrol->expUser();

   if ($data) {    
        $output= '';
       
            $output.='<table class="table table-bordered table-stripped">';
            $output.='<thead class="table-light text-left">
                                    <tr>
                                        <th scope="col">#id</th>
                                        <th scope="col">profile-pic</th>
                                        <th scope="col">firstname</th>
                                        <th scope="col">lastname</th>
                                        <th scope="col">email</th>
                                        <th scope="col">username</th>
                                        <th scope="col">gender</th>
                                        <th scope="col">date of birth</th>
                                        <th scope="col">hash</th>
                                        <th scope="col">#EM-V</th>
                                        <th scope="col">#EM-token</th>
                                        <th scope="col">muted</th>
                                        <th scope="col">last_muted</th>
                                        <th scope="col">registered on</th>
                                        <th scope="col">deleted-status</th>
                                        <th scope="col">actions/user-state</th>
                                        
                                    </tr>
                                </thead><tbody>';
                                 foreach ($data as $myusers => $fetch) {
                                         if ($admincontrol->usermuted($fetch['id'])) {
                                    $mute= 'inactive muted';
                                }else{$mute= 'active';}
                                
             $output.='                 
                                     <tr>
                                        <td>'.$fetch['id'].'</td>
                                        <td>'.$fetch['pic'].'</td>
                                        <td>'.$fetch['Fname'].'</td>
                                        <td>'.$fetch['Lname'].'</td>
                                        <td>'.$fetch['Email'].'</td>
                                        <td>'.$fetch['User'].'</td>
                                        <td>'.$fetch['gender'].'</td>
                                        <td>'.$fetch['dob'].'</td>
                                        <td>'.$fetch['Pass'].'</td>
                                        <td>'.$fetch['verified'].'</td>
                                        <td>'.$fetch['tokenEX'].'</td>
                                        <td>'.$fetch['mute_id'].'</td>
                                        <td>'.$fetch['last_muted'].'</td>
                                        <td>'.date('Y-M-D h:i a', strtotime($fetch['created_at'])).'</td>
                                         <td>'.$fetch['deleted'].'</td>
                                        <td>
                                        <span id="alerticon" class="badge badge-primary text-center">'.$mute.'</span>
                                        </td>
                                        
                                    </tr>';}
            $output.='<tbody></table>'; 
            
            echo $output;
        }
}
 //total login uusers 
if (isset($_POST['expire']) && $_POST['expire'] === "login_expire") {
    if ($login=$admincontrol->login_details()) {
   $output= '';
    $output.='<table class="table table-stripped table-bordered">';
    $output.=' <h6 class="text-center text-success"><strong>'.count($login).' &nbsp;users is currently active</strong></h6>';
    $output.='              <thead>
                <tr>
                <th>#</th>
                <th>email</th>
                <th>username</th>
                <th>profile-pic</th>
                <th>last seen</th>
                </tr>
              </thead><tbody>';
   foreach ($login as $key => $info) {
    $data= $admincontrol->usersInfo($info['user_id']);
    if ($data['pic'] != '1') {  $data['pic']= '<img src="../../img/war.png" width="80">';  }else{
        $data['pic']=  '<img src="../../includes/uploads/profile'.$data['id'].'.jpg" width="80">'; }
    $output.='          
                <tr>
                  <td>'.$data['id'].'</td>
                  <td>'.$data['Email'].'</td>
                  <td>'.$data['User'].'</td>
                  <td>'.$data['pic'].'</td>
                  <td>'.date('Y-M-D h:i:s a',strtotime($info['last_seen'])).'</td>
                </tr>';}

    $output.='</tbody></table>';  
 echo $output;
 }else{echo '): no users is online';} }
//total users
if (isset($_POST['admin_user']) && $_POST['admin_user'] === "Users-Data") {
      $count= $admincontrol->adminData();
    $data= $admincontrol->totalUsers(true);
    if ($data) {    
        $output= '';
       
            $output.='<table class="table table-bordered table-stripped">';
                $output.='<h6 class="text-center text-success"><strong>'.$count.' &nbsp;users is currently registered on site...</strong></h6>';
            $output.='<thead class="table-light text-left">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">profile</th>
                                        <th scope="col">firstname</th>
                                        <th scope="col">lastname</th>
                                        <th scope="col">email</th>
                                        <th scope="col">username</th>
                                        <th scope="col">gender</th>
                                        <th scope="col">date of birth</th>
                                        <th scope="col">#EM-V</th>
                                        <th scope="col">registered on</th>
                                        <th scope="col">actions</th>
                                        
                                    </tr>
                                </thead><tbody>';
                                 foreach ($data as $myusers => $fetch) {
                                    if ($fetch['pic'] != '1') {
                                        $fetch['pic']= '<img src="../../img/war.png" width="80">';
                                    }else{
                                        $fetch['pic']=  '<img src="../../includes/uploads/profile'.$fetch['id'].'.jpg" width="80">'; }
                                         if ($admincontrol->usermuted($fetch['id'])) {
                                    $mute= 'inactive muted';
                                }else{$mute= 'active';}
                                
             $output.='                 
                                     <tr>
                                        <td>'.$fetch['id'].'</td>
                                        <td>'.$fetch['pic'].'</td>
                                        <td>'.$fetch['Fname'].'</td>
                                        <td>'.$fetch['Lname'].'</td>
                                        <td>'.$fetch['Email'].'</td>
                                        <td>'.$fetch['User'].'</td>
                                        <td>'.$fetch['gender'].'</td>
                                        <td>'.$fetch['dob'].'</td>
                                        <td>'.$fetch['verified'].'</td>
                                        <td>'.date('Y-M-D h:i a', strtotime($fetch['created_at'])).'</td>
                                        <td><a href="#" data-toggle="modal" data-target="#page-data" id="'.$fetch['id'].'" class="btn infoData btn-primary btn-sm m-1"><i class="fas fa-pen fa-1x"></i>view</a>
                                        <a href="#" data-toggle="modal" data-target="#adminModal" id="'.$fetch['id'].'" class="btn editData btn-primary btn-sm m-1"><i class="fas fa-pen fa-1x"></i>edit</a>
                                        <a href="#" id="'.$fetch['id'].'" class="btn btn-danger delData btn-sm m-1"><i class="fas fa-bin fa-1x"></i>delete</a>
                                        <span id="alerticon" class="badge badge-primary text-center">'.$mute.'</span>
                                        </td>
                                        
                                    </tr>';}
            $output.='<tbody></table>'; 
            
            echo $output;
    }else{echo 'no user records';}
}

///total post

if (isset($_POST['admin_user']) && $_POST['admin_user'] === "Users-POST") {
    $count= $admincontrol->totalInfos('usertimeline');
    $data= $admincontrol->allPost();
    if ($data) {    
        $output= '';
       
            $output.='<table class="table table-bordered table-stripped">';
             $output.='<h6 class="text-center text-success"><strong>'.$count.' &nbsp;post is currently on 
             site</strong></h6>';
            $output.='<thead class="table-light text-left">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">subject</th>
                                        <th scope="col">title</th>
                                        <th scope="col">date posted</th>
                                        <th scope="col">edited on</th>
                                        <th scope="col">actions</th>
                                        
                                    </tr>
                                </thead><tbody>';
                                 foreach ($data as $myusers => $fetch) {
             $output.='                 
                                     <tr>
                                        <td>'.$fetch['cid'].'</td>
                                        <td>'.$fetch['subject'].'</td>
                                        <td>'.$fetch['timeline'].'</td>
                                        <td>'.date('Y-M-D h:i a', strtotime($fetch['created_at'])).'</td>
                                        <td>'.date('Y-M-D h:i a', strtotime($fetch['update_at'])).'</td>
                                        <td>
                                        <a href="#"  id="'.$fetch['cid'].'" class="btn muteData btn-primary btn-sm m-1"><i class="fas fa-pen fa-1x"></i>mute</a>
                                        <a href="#" id="'.$fetch['id'].'" class="btn btn-danger postdelData btn-sm m-1"><i class="fas fa-bin fa-1x"></i>delete</a>
                                        </td></tr>';}
            $output.='<tbody></table>'; 
            
            echo $output;
    }else{echo 'no post records';}
}

///total feedback of users

if (isset($_POST['admin_user']) && $_POST['admin_user'] === "Users-feedb") {
    $count= $admincontrol->totalInfos('feedback');
    $data= $admincontrol->feedbackadmin();
    if ($data) {    
        $output= '';
       
            $output.='<table class="table table-bordered table-stripped">';
             $output.='<h6 class="text-center text-success"><strong>'.$count.' &nbsp;feedback is currently on 
             site</strong></h6>';
            $output.='<thead class="table-light text-left">
                                    <tr>
                                        <th scope="col">username</th>
                                        <th scope="col">email</th>
                                        <th scope="col">subject</th>
                                        <th scope="col">feedback</th>
                                        <th scope="col">date sent</th>
                                        <th scope="col">actions</th>
                                        
                                    </tr>
                                </thead><tbody>';
                                 foreach ($data as $myusers => $fetch) {
             $output.='                 
                                     <tr>
                                        <td>'.$fetch['User'].'</td>
                                        <td>'.$fetch['Email'].'</td>
                                        <td>'.$fetch['subject'].'</td>
                                        <td>'.$fetch['feedback'].'</td>
                                        <td>'.date('Y-M-D h:i a', strtotime($fetch['created_at'])).'</td>
                                        <td>
                                        <a href="#" data-toggle="modal" data-target="#fdbmodal" fid="'.$fetch['id'].'" id="'.$fetch['uid'].'" class="btn feedbData btn-primary btn-sm m-1"><i class="fas fa-reply fa-1x"></i>reply</a>
                                        </td></tr>';}
            $output.='<tbody></table>'; 
            
            echo $output;
    }else{echo 'no feedback records';}
}


//toatal all nofications

if (isset($_POST['admin_user']) && $_POST['admin_user'] === "Users-notify") {
    //$count= $admincontrol->allNotification('feedback');
    $data= $admincontrol->allNotification('admin');
    $reset= $admincontrol->allNotification('Password reset');
    $user= $admincontrol->allNotification('User_added');
    $mail= $admincontrol->allNotification('Email Verification');
    if ($data) {    
        $output= '';
       
            $output.='<table class="table table-bordered table-stripped">';
             $output.='<h6 class="text-center text-success"><strong>'.count($data).' &nbsp; users activiites notification is currently on 
             site</strong></h6>';
            $output.='<thead class="table-light text-left">
                                    <tr>
                                        <th scope="col">User-id</th>
                                        <th scope="col">title</th>
                                        <th scope="col">alert</th>
                                        <th scope="col">notification</th>
                                        <th scope="col">date-time</th>
                                        <th scope="col">actions</th>
                                        
                                    </tr>
                                </thead><tbody>';
                                 foreach ($data as $myusers => $fetch) {
             $output.='                 
                                     <tr>
                                        <td>'.$fetch['uid'].'</td>
                                        <td>'.$fetch['type'].'</td>
                                        <td>new notification</td>
                                        <td>'.$fetch['message'].'</td>
                                        <td>'.date('Y-M-D h:i a', strtotime($fetch['created_at'])).'</td>
                                        <td>
                                        <a href="#" id="'.$fetch['id'].'" class="btn notifyData btn-primary btn-sm m-1"><i class="fas fa-bin fa-1x"></i>delete</a>
                                        </td></tr>';}
            $output.='<tbody></table>';

            ///password reset 
            $output2= '';
       
            $output2.='<table class="table table-bordered table-stripped">';
             $output2.='<h6 class="text-center text-success"><strong> '.count($reset).'&nbsp; password reset by users so far..</strong></h6>';
            $output2.='<thead class="table-light text-left">
                                    <tr>
                                        <th scope="col">User-id</th>
                                        <th scope="col">title</th>
                                        <th scope="col">alert</th>
                                        <th scope="col">notification</th>
                                        <th scope="col">date-time</th>
                                        <th scope="col">actions</th>
                                        
                                    </tr>
                                </thead><tbody>';
                                 foreach ($reset as $myusers => $fetch) {
             $output2.='                 
                                     <tr>
                                        <td>'.$fetch['uid'].'</td>
                                        <td>'.$fetch['type'].'</td>
                                        <td>new notification</td>
                                        <td>'.$fetch['message'].'</td>
                                        <td>'.date('Y-M-D h:i a', strtotime($fetch['created_at'])).'</td>
                                        <td>
                                        <a href="#" id="'.$fetch['id'].'" class="btn notifyData btn-primary btn-sm m-1"><i class="fas fa-bin fa-1x"></i>delete</a>
                                        </td></tr>';}
            $output2.='<tbody></table>';
            //user-new-added
            $output3= '';
       
            $output3.='<table class="table table-bordered table-stripped">';
             $output3.='<h6 class="text-center text-success"><strong> '.count($user).' &nbsp; users registered so far...</strong></h6>';
            $output3.='<thead class="table-light text-left">
                                    <tr>
                                        <th scope="col">User-id</th>
                                        <th scope="col">title</th>
                                        <th scope="col">alert</th>
                                        <th scope="col">notification</th>
                                        <th scope="col">date-time</th>
                                        <th scope="col">actions</th>
                                        
                                    </tr>
                                </thead><tbody>';
                                 foreach ($user as $myusers => $fetch) {
             $output3.='                 
                                     <tr>
                                        <td>'.$fetch['uid'].'</td>
                                        <td>'.$fetch['type'].'</td>
                                        <td>new notification</td>
                                        <td>'.$fetch['message'].'</td>
                                        <td>'.date('Y-M-D h:i a', strtotime($fetch['created_at'])).'</td>
                                        <td>
                                        <a href="#" id="'.$fetch['id'].'" class="btn notifyData btn-primary btn-sm m-1"><i class="fas fa-bin fa-1x"></i>delete</a>
                                        </td></tr>';}
            $output3.='<tbody></table>';
            //emal verified..
            $output4= '';
       
            $output4.='<table class="table table-bordered table-stripped">';
             $output4.='<h6 class="text-center text-success"><strong>'.count($mail).' &nbsp; users verified thier email so far...</strong></h6>';
            $output4.='<thead class="table-light text-left">
                                    <tr>
                                        <th scope="col">User-id</th>
                                        <th scope="col">title</th>
                                        <th scope="col">alert</th>
                                        <th scope="col">notification</th>
                                        <th scope="col">date-time</th>
                                        <th scope="col">actions</th>
                                        
                                    </tr>
                                </thead><tbody>';
                                 foreach ($mail as $myusers => $fetch) {
             $output4.='                 
                                     <tr>
                                        <td>'.$fetch['uid'].'</td>
                                        <td>'.$fetch['type'].'</td>
                                        <td>new notification</td>
                                        <td>'.$fetch['message'].'</td>
                                        <td>'.date('Y-M-D h:i a', strtotime($fetch['created_at'])).'</td>
                                        <td>
                                        <a href="#" id="'.$fetch['id'].'" class="btn notifyData btn-primary btn-sm m-1"><i class="fas fa-bin fa-1x"></i>delete</a>
                                        </td></tr>';}
            $output4.='<tbody></table>';

            echo $output;
            echo $output2;
            echo $output3;
            echo $output4;
    }else{echo 'no new  notification';}
}

//total deleted post
if (isset($_POST['admin_user']) && $_POST['admin_user'] === "Users-Deleted") {
      $count= $admincontrol->totalUsers(false);
    $datas= $admincontrol->totalUsers(false);
    if ($datas) {    
        $output= '';
       
            $output.='<table class="table table-bordered table-stripped">';
            $output.='<thead class="table-light text-left">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">profile</th>
                                        <th scope="col">firstname</th>
                                        <th scope="col">lastname</th>
                                        <th scope="col">email</th>
                                        <th scope="col">username</th>
                                        <th scope="col">gender</th>
                                        <th scope="col">date of birth</th>
                                        <th scope="col">#EM-V</th>
                                        <th scope="col">registered on</th>
                                        <th scope="col">actions</th>
                                        
                                    </tr>
                                </thead><tbody>';
                                 foreach ($datas as $myusers => $fetch) {
                                    if ($fetch['pic'] != '1') {
                                        $fetch['pic']= '<img src="../../img/war.png" width="80">';
                                    }else{
                                        $fetch['pic']=  '<img src="../../includes/uploads/profile'.$fetch['id'].'.jpg" width="80">'; }
                                
             $output.='                 
                                     <tr>
                                        <td>'.$fetch['id'].'</td>
                                        <td>'.$fetch['pic'].'</td>
                                        <td>'.$fetch['Fname'].'</td>
                                        <td>'.$fetch['Lname'].'</td>
                                        <td>'.$fetch['Email'].'</td>
                                        <td>'.$fetch['User'].'</td>
                                        <td>'.$fetch['gender'].'</td>
                                        <td>'.$fetch['dob'].'</td>
                                        <td>'.$fetch['verified'].'</td>
                                        <td>'.date('Y-M-D h:i a', strtotime($fetch['created_at'])).'</td>
                                        <td><a href="#" id="'.$fetch['id'].'" class="btn restoreData btn-primary btn-sm m-1"><i class="fas fa-cogs fa-1x"></i>restore</a>
                                        
                                    </tr>';}
            $output.='<tbody></table>'; 
            
            echo $output;
    }else{echo 'no deleted records';}
}
 ?>