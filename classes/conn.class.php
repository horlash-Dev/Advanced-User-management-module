<?php 
/**
 * 
 */
class conn
{private $host="localhost";
private $username="horlash";
private $root="12345";
private $dbh="admin_user";
protected $db;
	
	function __construct()
	{	$option = array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
		try {
			$this->db = new PDO("mysql:host=$this->host;dbname=$this->dbh", $this->username, $this->root, $option);
			//echo('connected');
		} catch (PDOException $e) {
			echo "connection_failed" . $e->getMessage();
		}
	}

	protected function myCon()
	{
		# code...
	}
}
