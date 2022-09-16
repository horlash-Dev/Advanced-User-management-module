<?php 
//require_once 'conn.class.php';
//$db = new conn();
class main extends conn
{	
	
	protected function intRead()
	{	$sql = "SELECT * FROM myuser";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute();
		$result = $stmt->fetchALL();
		foreach ($result as $row) {
			$data[] = $row;
		}
		return $data;
	}
	
	protected function intInsert($fname,$lname,$email,$user,$password)
	{	
		$sql = "INSERT INTO myuser (Fname,Lname,Email,User,Pass) VALUES (?,?,?,?,?)";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$fname,$lname,$email,$user,$password]);
		return true;
	}

	protected function intUpdt($fname,$lname,$email,$user,$id)
	{
		$sql = "UPDATE myuser SET Fname= ?,Lname= ?, Email= ?, User= ? where id=?";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute([$fname,$lname,$email,$user,$id]);
		return true;	
	}

	protected function intDel($id)
	{
		$stmt = $this->db->prepare("DELETE FROM myuser where id=$id");
		$stmt->execute();
		return true;
	}
	protected function intSelect($eData)
	{	$sql = "SELECT * FROM myuser where Email= ? AND deleted != 0";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute([$eData]);
		$result = $stmt->fetch() ;
		return $result;
		
	}
	protected function intRow()
	{
		$stmt = $this->db->prepare("SELECT * FROM usertimeline WHERE id= ?");
		$stmt->execute();
		$result = $stmt->RowCount();
		return $result;
	}
	protected function intMail($mail)
	{
		$sql= "SELECT Email FROM myuser WHERE Email= ?";
		$stmt= $this->db->prepare($sql);
		$stmt->execute([$mail]);
		$result= $stmt->fetch();
		return $result;
	}

 	protected function intUser($user)
	{
		$sql= "SELECT User FROM myuser WHERE User= ?";
		$stmt= $this->db->prepare($sql);
		$stmt->execute([$user]);
		$result= $stmt->fetch();
		return $result;
	}

	protected function intLogin($data)
	{ $stmt= $this->db->prepare("SELECT id, Email, Pass FROM myuser WHERE User=? AND deleted != 0");
		$stmt->execute([$data]);
		$result= $stmt->fetch();
		return $result;
	}
	protected function login_ses($id,$date)
	{	
		$sql= "INSERT INTO login_session (user_id, last_seen) Values (?, ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$id,$date]);
		return true;
	}
	protected function login_check($timeout,$id)
	{
		$sql = "UPDATE login_session SET last_seen= :timeout where user_id= :id";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute(['timeout'=>$timeout,'id'=>$id]);
		return true;	
	}
	protected function log_del($id)
	{
		$stmt= $this->db->prepare("DELETE FROM login_session WHERE user_id= ?");
		$stmt-> execute([$id]);
		return true;
	}

	protected function resetDel($mail)
	{
		$stmt= $this->db->prepare("DELETE FROM resetKey WHERE rMail= ?");
		$stmt-> execute([$mail]);
		return true;
	}
	protected function resetInsert($rmail,$token,$tokenVerify)
	{
		$stmt= $this->db->prepare("INSERT INTO resetKey (rMail, token, tokenVerify, rexpire) 
			VALUES(:rmail, :token, :tokenVerify, DATE_ADD(NOW(), INTERVAL 6 MINUTE))");
		$stmt->execute(['rmail'=>$rmail,'token'=>$token, 'tokenVerify'=>$tokenVerify]);
		return true;	
	}

	protected function intToken($vtoken)
	{
		$stmt= $this->db->prepare("SELECT rMail FROM resetKey WHERE tokenVerify= :vtoken AND rexpire >= NOW()");
		$stmt->execute(['vtoken'=>$vtoken]);
		$result= $stmt->fetch();
		return $result;

	}
	protected function tokenVerify($token)
	{
		$sql= "SELECT token FROM resetKey WHERE tokenVerify= :token";
		$stmt= $this->db->prepare($sql);
		$stmt->execute(['token'=>$token]);
		$result= $stmt->fetch();
		return $result;
	}

	protected function Updtpassword($password,$mail)
	{
		$sql = "UPDATE myuser SET Pass= :password where Email= :mail";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute(['password'=>$password,'mail'=>$mail]);
		return true;	
	}

	protected function intTimeline($id,$topic,$tl)
	{
				$stmt= $this->db->prepare("INSERT INTO usertimeline (cid, subject, timeline) 
			VALUES(:id, :topic, :tl)");
		$stmt->execute(['id'=>$id,'topic'=>$topic, 'tl'=>$tl]);
		return true;	
		// $stmt= $this->db->prepare("INSERT INTO usertimeline (cid, subject, timeline) 
		// 	VALUES(?,?,?)");
		// $stmt->execute([$id, $subject, $timeline]);
		// return true;		
	}


	protected function selectTimeline($eid, $start, $pages)
	{	$sql = "SELECT * FROM usertimeline  WHERE cid= ? ORDER BY id DESC LIMIT $start, $pages ";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute([$eid]);
		$result = $stmt->fetchAll();
		return $result;
		
	}

		protected function Timeline($id)
	{	$sql = "SELECT * FROM usertimeline WHERE id= :id";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute(['id'=>$id]);
		$result = $stmt->fetch();
		return $result;
	}	
	protected function userRow($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM usertimeline WHERE cid= ?");
		$stmt->execute([$id]);
		$result = $stmt->RowCount();
		return $result;
	}

		protected function timelineUpdt($subject,$timeline,$id){
		$sql = "UPDATE usertimeline SET subject= :subject, timeline= :timeline, update_at= NOW() where id= :id";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute(['subject'=>$subject,'timeline'=>$timeline,'id'=>$id]);
		return true;	
	}
		protected function Deltimeline($ids)
	{
		$stmt= $this->db->prepare("DELETE FROM usertimeline WHERE id= ?");
		$stmt-> execute([$ids]);
		return true;
	}

protected function profileUpdt($fname,$lname,$user,$dob,$gender,$id){
		$sql = "UPDATE myuser SET Fname= ?, Lname= ?, User= ?, dob= ?, gender= ? where id= ?";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute([$fname,$lname,$user,$dob,$gender,$id]);
		return true;	
	}

	protected function imgLoad($id)
	{
		$sql = "UPDATE myuser SET pic= '1' where id= ?";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute([$id]);
		return true;	
	}

	protected function changePassword($value,$id)
	{
		$stmt= $this->db->prepare("UPDATE myuser SET Pass= ? WHERE id= ?");
		$stmt->execute([$value, $id]);
		return true;
	}
	protected function linkEx($value)
	{
		$stmt= $this->db->prepare("UPDATE myuser SET tokenEX= DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE Email= ?");
		$stmt->execute([$value]);
		return true;
	}
	protected function mailVerify($value)
	{
		$stmt= $this->db->prepare("UPDATE myuser SET verified= '1' WHERE tokenEX >= NOW() AND Email= ?");
		$stmt->execute([$value]);
		return true;
	}
		protected function intFeedback($id,$topic,$timeline)
	{
		$stmt= $this->db->prepare("INSERT INTO feedback (uid, subject, feedback) VALUES(:id, :topic, :timeline)");
		$stmt->execute(['id'=>$id,'topic'=>$topic, 'timeline'=>$timeline]);
		return true;	
			
	}
		protected function intNotification($id,$topic,$timeline)
	{
		$stmt= $this->db->prepare("INSERT INTO admin_notification (uid, type, message) VALUES(:id, :topic, :timeline)");
		$stmt->execute(['id'=>$id,'topic'=>$topic, 'timeline'=>$timeline]);
		return true;	
			
	}
		protected function fetchNotification($id)
	{	$sql = "SELECT * FROM admin_notification WHERE uid= :id AND type= 'users' ORDER BY id DESC LIMIT 8";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute(['id'=>$id]);
		$result = $stmt->fetchAll();
		return $result;
	}
	protected function notifyRow($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM admin_notification WHERE status= '0' AND type= 'users' AND uid= ?");
		$stmt->execute([$id]);
		$result = $stmt->RowCount();
		return $result;
	}
		protected function notifyUpdt($id)
	{
		$stmt= $this->db->prepare("UPDATE admin_notification SET status= '1' WHERE status= '0' AND uid= ?");
		$stmt->execute([$id]);
		return true;
	}
		protected function muted($id)
	{
		$stmt = $this->db->prepare("SELECT last_muted FROM myuser WHERE mute_id != 0 AND id= ?");
		$stmt->execute([$id]);
		$result = $stmt->fetch();
		return $result;
	}
	protected function unmute($ids)
	{
		$stmt= $this->db->prepare("UPDATE myuser SET mute_id= '0' WHERE id= ?");
		$stmt-> execute([$ids]);
		return true;
	}	
		protected function total_hit($id,$page)
	{
		$stmt= $this->db->prepare("UPDATE total_hits SET page_id= ?, total_views= total_views +1 WHERE index_id= ?");
		$stmt-> execute([$id,$page]);
		return true;
	}

		protected function total_confirm($id,$ip)
	{
		$stmt= $this->db->prepare("SELECT * FROM hits_record  WHERE page_id= ? AND user_ip= ?");	
		$stmt-> execute([$id,$ip]);
		$result= $stmt->fetchAll();
		return $result;
	}
		 function hit_insert($ip,$id, $dates)
	{	
		$sql= "INSERT INTO hits_record (user_ip, page_id, dates) Values (?, ?, ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$ip,$id,$dates]);
		return true;
	}











}



	

	


// $ob = new main();
// print_r($ob->login("fredy")) ;

	


	
