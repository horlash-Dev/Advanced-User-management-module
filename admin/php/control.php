<?php 
namespace admin\php;
use admin\php\adminDB;
/**
 * 
 */
class control extends adminDB
{
	
	public function login_admin($value)
	{
		return parent::adminLogin($value);
	}

	public function adminData()
	{
		return parent::totalData();
	}
	public function totalInfos($data)
	{
		return parent::totalInfo($data);
	}
	public function Verification($data)
	{
		return parent::totalVerification($data);
	}
	public function Gender()
	{
		return parent::totalgender();
	}
	public function emailStatics()
	{																										
		return parent::emailStatics();
	}
	public function totalUsers($id)
	{
		return parent::totalUser($id);
	}
	public function userUpdate($fname,$lname,$user,$dob,$email,$verified,$id)
	{
		return parent::userUpdt($fname,$lname,$user,$dob,$email,$verified,$id);
	}
	public function usersInfo($id)
	{
		return parent::userInfo($id);
	}
	public function Deltusers($value,$ids)
	{
		return parent::Deltuser($value,$ids);
	}
		public function muteUser($value,$date,$ids)
	{
		return parent::mute($value,$date,$ids);
	}
	public function login_details()
	{
		return parent::login_detail();
	}
	public function allPost()
	{
		return parent::totalPost();
	} 
	public function usermuted($id)
	{
		return parent::umuted($id);
	}
	public function feedbackadmin()
	{
		return parent::feedbackAD();
	}
	public function replied($ids)
	{
		return parent::adminreply($ids);
	}
	public function replyNotification($uid,$reply)
	{
		return parent::replyNoti($uid,$reply);
	}
	public function allNotification($data)
	{
		return parent::totalNotification($data);
	}
	public function deletenoti($ids)
	{
		return parent::Deltnotify($ids);
	}
	public function notifyrows()
	{
		return parent::notifyRows();
	}
	public function notifyupdate()
	{
		return parent::notifyUpdt();
	}
	public function expUser()
	{
		return parent::exportUser();
	}
	public function total_hits()
	{
		return parent::total_hit();
	}
	public function visitor()
	{
		return parent::total_visitor();
	}

}


 ?>