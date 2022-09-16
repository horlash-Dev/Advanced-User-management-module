<?php 
namespace admin\php;
require_once '../../vendor/autoload.php';
use admin\config\adminconnect;
class adminDB extends adminconnect
{
	protected function adminLogin($value)
	{
		$fetch= $this->db->prepare("SELECT pass_admin, user_admin FROM my_admin WHERE user_admin= ?");
		$fetch->execute([$value]);
		$result= $fetch->fetch(\PDO::FETCH_ASSOC); 
		return $result;
	}
	 function intInsert($password)
	{	
		$sql= "INSERT INTO my_admin (user_admin,pass_admin) Values ('qamvid', ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$password]);
		return true;
	}

	protected function totalData()
	{
		$stmt=$this->db->prepare("SELECT COUNT(*) AS total FROM myuser WHERE deleted != '0'");
		$stmt->execute();
		$result= $stmt->fetch();	
		$data= $result['total'];
		return $data;
	}

		protected function totalInfo($data)
	{
		$stmt=$this->db->prepare("SELECT COUNT(*) AS total FROM $data");
		$stmt->execute();
		$result= $stmt->fetch();	
		$data= $result['total'];
		return $data;
	}
		protected function totalNotification($data)
	{
		$stmt=$this->db->prepare("SELECT * FROM  admin_notification WHERE type= ? ORDER BY id DESC");
		$stmt->execute([$data]);
		$result= $stmt->fetchAll();	
		return $result;
	}
		protected function notifyRows()
	{
		$stmt = $this->db->prepare("SELECT * FROM admin_notification WHERE status= '0' AND type != 
			'users'");
		$stmt->execute();
		$result = $stmt->RowCount();
		return $result;
	}
		protected function notifyUpdt()
	{
		$stmt= $this->db->prepare("UPDATE admin_notification SET status= '1' WHERE status= '0' AND type != 'users'");
		$stmt->execute();
		return true;
	}
		protected function totalVerification($data)
	{
		$stmt=$this->db->prepare("SELECT COUNT(*) AS total FROM myuser WHERE verified= ?");
		$stmt->execute([$data]);
		$result= $stmt->fetch();	
		$data= $result['total'];
		return $data;
	}

		protected function totalgender()
	{
		$stmt=$this->db->prepare("SELECT gender, COUNT(*) AS total FROM myuser WHERE gender !='' GROUP BY gender ");
		$stmt->execute();
		$result= $stmt->fetchAll();	
		return $result;
	}
		protected function emailStatics()
	{
		$stmt=$this->db->prepare("SELECT verified, COUNT(*) AS total FROM myuser GROUP BY verified ");
		$stmt->execute();
		$result= $stmt->fetchAll();	
		return $result;
	}

		protected function totalUser($id)
	{	$sql = "SELECT * FROM myuser WHERE deleted= :id ORDER BY id DESC";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute(['id'=>$id]);
		$result = $stmt->fetchAll();
		return $result;
	}

		protected function exportUser()
	{	$sql = "SELECT * FROM myuser ORDER BY id DESC";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute();
		$result = $stmt->fetchAll();
		return $result;
	}
		protected function userInfo($id)
	{	$sql = "SELECT * FROM myuser WHERE id= :id";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute(['id'=>$id]);
		$result = $stmt->fetch();
		return $result;
	}
		protected function totalPost()
	{	$sql = "SELECT * FROM usertimeline order by id desc";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	protected function userUpdt($fname,$lname,$user,$dob, $email, $verified,$id){
		$sql = "UPDATE myuser SET Fname= ?, Lname= ?, User= ?, dob= ?, Email= ?, verified= ? where id= ?";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute([$fname,$lname,$user,$dob,$email,$verified,$id]);
		return true;	
	}
			protected function Deltuser($value,$ids)
	{
		$stmt= $this->db->prepare("UPDATE myuser SET deleted= ?   WHERE id= ?");
		$stmt-> execute([$value,$ids]);
		return true;
	}
	protected function mute($value,$date,$ids)
	{
		$stmt= $this->db->prepare("UPDATE myuser SET mute_id= ?, last_muted= ? WHERE id= ?");
		$stmt-> execute([$value,$date,$ids]);
		return true;
	}
		protected function umuted($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM myuser WHERE mute_id != 0 AND id= ?");
		$stmt->execute([$id]);
		$result = $stmt->fetch();
		return $result;
	}
		protected function login_detail()
	{	$sql = "SELECT * FROM login_session WHERE last_seen > DATE_SUB(NOW(), INTERVAL 30 SECOND)";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute();
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}
		protected function login_id()
	{	$sql = "SELECT id FROM login_session WHERE last_seen > DATE_SUB(NOW(), INTERVAL 30 SECOND)";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute();
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}

		protected function feedbackAD()
	{	$sql = "SELECT feedback.id,feedback.uid,feedback.subject,feedback.feedback,feedback.created_at, myuser.User,myuser.Email FROM feedback INNER  JOIN myuser ON feedback.uid = myuser.id WHERE reply != '1'  ORDER BY feedback.id DESC";
		$stmt = $this->db->prepare($sql);
		$stmt-> execute();
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}
	 function replyNoti($uid,$reply)
	{	
		$sql= "INSERT INTO admin_notification (uid,type,message) Values (?,'users', ?)";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$uid,$reply]);
		return true;
	}

		protected function adminreply($ids)
	{
		$stmt= $this->db->prepare("UPDATE feedback SET reply= '1' WHERE id= ?");
		$stmt-> execute([$ids]);
		return true;
	}
		protected function Deltnotify($ids)
	{
		$stmt= $this->db->prepare("DELETE FROM admin_notification WHERE id= ?");	
		$stmt-> execute([$ids]);
		return true;
	}

		protected function total_hit()
	{
		$stmt= $this->db->prepare("SELECT SUM(total_views) AS total FROM total_hits");	
		$stmt-> execute();
		$result= $stmt->fetch();
		$data= $result['total'];
		return $data;
	}

		protected function total_visitor()
	{
		$stmt= $this->db->prepare("SELECT total_views FROM total_hits WHERE index_id= 'welcome_page'");	
		$stmt-> execute();
		$result= $stmt->fetch();
		$data= $result['total_views'];
		return $data;
	}
	







}

 ?>