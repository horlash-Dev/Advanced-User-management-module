<?php  


/**
 * 
 */
class user extends control
{		public function read($eid, $start, $pages)
	{
		return parent::selectTimeline($eid,$start, $pages);
	}
		public function readAll($eid)
	{
		return parent::Timeline($eid);
	}
		public function urows($id)
	{
		return parent::userRow($id);
	}
	public function insertTimeline($id,$subject,$timeline)
	{
		return parent::intTimeline($id,$subject,$timeline);
	}
	public function update($id,$subject,$timeline)
	{
		return parent::timelineUpdt($subject,$timeline,$id);
	}
	public function delete($id)
	{
		return parent::Deltimeline($id);
	}
		public function profileUpdate($fname,$lname,$user,$dob,$gender,$id)
	{
		return parent::profileUpdt($fname,$lname,$user,$dob,$gender,$id);
	}
		public function upload($id)
	{
		return parent::imgLoad($id);
	}
		public function changePwd($value,$id)
	{
		return parent::changePassword($value,$id);
	}
		public function emailVerify($value)
	{
		return parent::mailVerify($value);
	} 
		public function Feedback($id,$topic,$timeline)
	{
		return parent::intFeedback($id,$topic,$timeline);
	}
		public function Notification($id,$topic,$timeline)
	{
		return parent::intNotification($id,$topic,$timeline);
	} 
		public function fNotification($id)
	{
		return parent::fetchNotification($id);
	}
		public function nRow($id)
	{
		return parent::notifyRow($id);
	}
	public function Nreload($id)
	{	
		return parent::notifyUpdt($id);
	}
	public function muteduser($id)
	{
		return parent::muted($id);
	}
	public function UNmute($ids)
	{
		return parent::unmute($ids);
	}

	public function total_crf($id,$ip)
	{
		return parent::total_confirm($id,$ip);
	}

	public function  hits_insert($ip,$id, $dates)
	{
		return parent::hit_insert($ip,$id, $dates);
	}
	public function total_hits($id,$page)
	{
		return parent::total_hit($id,$page);
	}
}


	// public function read()
	// {
	// 	return $this->intRead();
	// }
	// public function update($fname,$lname,$email,$user,$id)
	// {
	// 	return $this->intUpdt($fname,$lname,$email,$user,$id);
	// }
	// public function delete($id)
	// {
	// 	return $this->intDel($id);
	// }