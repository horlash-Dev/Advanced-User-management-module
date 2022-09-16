<?php 
 require_once '../vendor/autoload.php';
 $timeline= new user;
$Current= new session();
$Current->ids();
$Current->intP();
 date_default_timezone_set('Africa/Lagos');
 $date= date('Y-m-d H:i:s',STRTOTIME(date('h:i:sa')));
if (isset($_POST['logout']) && $_POST['logout'] === "logout_check") {
	$start = $_SESSION['start_time'];
    $timer = time();
  if ($timer > $_SESSION['expire_time']) {
  session_unset();
  session_destroy();
  print_r('logout_success');
  }
}
$notification = array(['type' =>'Admin','message' =>'new note added!'],
['type' =>'Admin','message' =>'note updated!'],
['type' =>'Admin','message' =>'feedback sent!'],
['type' =>'Admin','message' =>'note deleted!'],
['type' =>'Admin','message' =>'profile image added!'],
['type' =>'Admin','message' =>'password changed!'],
['type' =>'Admin','message' =>'profile updated!']);

//login check
if (isset($_POST['timesout']) && $_POST['timesout'] === "login_check") {
	$id= $Current->cid;
	$Current->login_checks($date,$id);
}
if (isset($_POST['addStory']) && $_POST['addStory'] === "subject") {
	$id= $timeline->intInput($_POST['ids']);
	$subject= $timeline->intInput($_POST['title']);
	$time= $timeline->intInput($_POST['addtext']);
			//mute user
if ($mute= $timeline->muteduser($Current->cid)) {
	echo $timeline->erMsg("dear user,sorry for the incovenience your account has been suspended for the next 48 hours. <b>why :<b/> due to violation of our terms and condition try again...");
		$ctime= time() - strtotime($mute['last_muted']);
		if (($ctime > 86400)) {
			$timeline->unmute($Current->cid);}		
}else{
	if (isset($timeline->error)) {
		echo $timeline->erMsg("fileds empty");
	}elseif ($timeline->userV($subject)  || $timeline->userV($time)) {
        echo $timeline->erMsg("minimum of 4/alphanumeric & symbols_.,!*$\?#@%|{() only");
    }elseif ($timeline->insertTimeline($id,$subject,$time) !== null) {
    	$timeline->Notification($id,$notification[0]['type'],$notification[0]['message']);
		print_r('success-user');
	}else{
		echo $timeline->erMsg("oops something went wrong!!");
	}
}
}//read($eid)
//store update data
if (isset($_POST['upStory']) && $_POST['upStory'] === "update") {
	$id= $timeline->intInput($_POST['uid']);
	$subject= $timeline->intInput($_POST['tupdate']);
	$text= $timeline->intInput($_POST['updatetext']);
	if (isset($timeline->error)) {
		echo $timeline->erMsg("fileds empty");
	}elseif ($timeline->userV($subject)  || $timeline->userV($text)) {
        echo $timeline->erMsg("minimum of 4/alphanumeric & symbols_.,!*$\?#@%|{() only");
    }elseif ($timeline->update($id,$subject,$text) !== false) {
    	$timeline->Notification($Current->cid,$notification[1]['type'],$notification[1]['message']);
		print_r('info-updated');
	}else{
		echo $timeline->erMsg("oops something went wrong!!");	
	}
}

//update data
if (isset($_POST['fetch'])) {
	$udata= $_POST['fetch'];
	if ($data= $timeline->readAll($udata)) {
		echo json_encode($data);
	}
}
//delete data
if (isset($_POST['delNo'])) {
	$data= $_POST['delNo'];
	$timeline->delete($data);
	$timeline->Notification($Current->cid,$notification[3]['type'],$notification[3]['message']);
}
//display userdata
if (isset($_POST['info'])) {
	$info= $_POST['info'];
	if ($data= $timeline->readAll($info)) {
		echo json_encode($data);
	}
}
//update profile info
if (isset($_POST['info']) && $_POST['info'] === "profileupdt") {
	$id =$_POST['myid'];
	$date =$_POST['date'];
	$gender= $_POST['gender'];
	 $fname = $timeline->intInput($_POST['fname']);
    $lname = $timeline->intInput($_POST['lname']);
    $user = $timeline->intInput($_POST['username']);
    if (isset($timeline->error)) {
    echo $timeline->erMsg("empty field");
    }elseif ($timeline->valInput($fname) || $timeline->valInput($lname) || $timeline->valInput($user)) {echo $timeline->erMsg("minimum of 4-18 character`s allowed/alphanumeric");}
    else{
		$timeline->profileUpdate($fname,$lname,$user,$date,$gender,$id); 
		echo $success= "profile succesfully updated"; 
		$timeline->Notification($id,$notification[6]['type'],$notification[6]['message']);	
    }

}
//update profile image
if (isset($_FILES['profileImage'])) {
	 $filename= $_FILES['profileImage']['name'];
	 $filesize= $_FILES['profileImage']['size'];
	 $filedir= $_FILES['profileImage']['tmp_name'];
	 $filerror= $_FILES['profileImage']['error'];

	 $Ext= explode(".", $filename);
	  $filext= strtolower(end($Ext));
	 $type = array('jpg','png','jpeg','gif');
		if ($filerror != true) {
		if (!in_array($filext, $type)) {
	 	echo $timeline->erMsg("file extenion invalid");
	 	}else {
	 	if ($filesize < 500000) {
	 		$uploadId= $Current->ids();
	 			$DESt= "uploads/profile" . $uploadId . ".$filext";
	 			move_uploaded_file($filedir, $DESt);
	 			$timeline->upload($uploadId);
	 			$timeline->Notification($uploadId,$notification[4]['type'],$notification[4]['message']);
	 		echo ("profile updated"); }else{
	 		echo $timeline->erMsg("error, file too big 500kb max");
	 	}	
	 }
	} else {echo $timeline->erMsg("error, no file to upload"); }	 
}
//change password
if (isset($_POST['changep']) && $_POST['changep'] === "password") {
 	
	 $upass = $timeline->intInput($_POST['upass']);
    $newpass = $timeline->intInput($_POST['newpass']);
    $ucpass = $timeline->intInput($_POST['ucpass']);
    if (isset($timeline->error)) {
    	echo $timeline->erMsg("fill in the blanks");
    }elseif ($newpass !== $ucpass) {
    	echo $timeline->erMsg("confirm password donot match");
    }elseif ($timeline->passwordVerify($newpass)) {
        echo $timeline->erMsg("minimum of 6-10 characters & symbols_.,!*$\?#@%|");
    }else{
    	$hash= password_hash($newpass, PASSWORD_DEFAULT);
    	if (password_verify($upass, $Current->cPass) !==false) {
    	$confirm= $timeline->changePwd($hash,$Current->cid);
    	if ($confirm !== null) {
    		echo $success= "password changed";
    		$timeline->Notification($Current->cid,$notification[5]['type'],$notification[5]['message']);
    	}
    	}else{
    		echo $timeline->erMsg("invalid old password!");
    	}
    }
 }
 ///feedback message 
if (isset($_POST['feed']) && $_POST['feed'] === "feedback") {

	$title= $timeline->intInput($_POST['ftitle']);
	$text= $timeline->intInput($_POST['ftext']);
	if (isset($timeline->error)) {
		echo $timeline->erMsg("fields empty");
	}elseif ($timeline->userV($title) || $timeline->userV($text)) {
        echo $timeline->erMsg("minimum of 4/alphanumeric & symbols_.,!*$\?#@%|{() only");
    }elseif ($timeline->Feedback($Current->cid,$title,$text) !== false) {
		print_r('feedback sent');
		$timeline->Notification($Current->cid,$notification[2]['type'],$notification[2]['message']);
	}else{
		echo $timeline->erMsg("oops something went wrong!!");	
	}
}
//notification
if (isset($_POST['notify'])) {
	if ($_POST['notify'] != '') {
		$timeline->Nreload($Current->cid);
	}
	$notify= $timeline->fNotification($Current->cid);
	if ($notify) {
		$output= '';
		foreach ($notify as $data) {//'.date('Y-M-D h:ia', strtotime($data['created_at'])).'
			$output.= '<div class="c-content px-3 bg-light">			
						<p class="card-text"><h6>Dear user... &nbsp;&nbsp;&nbsp;</h6>'.$data['message'].'<br>
						<span>'.$timeline->timeGone($data['created_at']).'</span></p>
						</div>
					<hr class="bg-white">';
		}
	}else{
		echo '<h4 class="card-title">:( dear user you have no recent notification.</h4>';
	}
	$counter= $timeline->nRow($Current->cid);
	$datas = array('newnotification' => $output,'counter' => $counter);
	echo json_encode($datas);
}

///fetch from data

if (isset($_POST['display']) && $_POST['display']) {
$page= implode($_POST);
$ids= $Current->cid;
$row= $timeline->urows($ids);
 $start= ($page-1)*3;
$pages= '3';
	$total= ceil($row/$pages);
$data= $timeline->read($ids, $start, $pages);
	
if ($data) {
foreach ($data as $info) {	
	$display= '<div class="product-item col-md-4 col-lg-4 col-sm-6 col-xs-12">		
		<ul class="nav  justify-content">
  <li class="nav-item">
    <a class="nav-link active btn btn-sm btn-info infoBtn px-3 py-1 m-1" href="#" id='.$info['id'].'><i class="fas fa-info fa-1x m-1"></i>info</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active editBtn px-3 py-1 m-1 btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal2"  href="#" id='.$info['id'].'><i class="fas fa-pen fa-1x m-1"></i>edit</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active btn btn-sm btn-danger delBtn px-3 py-1 m-1" href="#" id='.$info['id'].'><i class="fas fa-bin fa-1x m-1"></i>delete</a>
  </li>
</ul>			
	<div class="product-item" data-aos="zoom-in-down" data-aos-duration="300">
	<h4 class="product-title mt-4 ml-3">'.$info['subject'].'</h4>
					 	<i id="dis">'.$info['id'].'</i>
							<cite class="lin px-1"><i class="fas fa-clock fa-1x m-1 "></i>published on&nbsp;&nbsp;&nbsp;'.$date= date('D M Y, h:i:a', strtotime($info['created_at'])).'</cite>
					 	<hr>
					 	 <p class="product-text px-2 py-2">'.substr($info['timeline'],0, 50).'...<a href="#" class="infoBtn" id='.$info['id'].'>read more</a><br></p>';
	$display.= '</div></div>';
echo $display;	
}
	for ($i=1; $i <$total; $i++) { 
		echo '<br><div class=""style="align-self: flex-end;"><a href="home.php?post='.$i.'" class="btn m-1 btn-sm btn-primary">'.$i.'</a></div>';}
if ($page > '1') {
	echo '<div class=""style="align-self: flex-end;"><a href="home.php?post='.($page-1).'"class=" btn btn-sm m-1 btn-primary">previous</a></div>';
}
if ($i > $page) {
	echo '<div class=""style="align-self: flex-end;"><a href="home.php?post='.($page+1).'" class=" btn btn-sm m-1 btn-primary">next</a></div>';
}
}else{
$output= '<h4><i>hey user :~) your timeline is empty<br/> click add story to start</i></h4>';
 echo $output;	
}
}
?>