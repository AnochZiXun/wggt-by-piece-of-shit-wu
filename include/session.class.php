<?
class session
{
	public $db ;
	function closeSession()
	{
		session_unset();
		session_destroy();
	}
	function readSession($item)
	{
		if($session = $this -> db -> getfirst("select * from member where ITEM='".$item."'"))
		{
			return $session;
		}
		else
		{
			return "";
		}
	}
	function writeSession($id,$data)
	{
		if($session=$this->db->getfirst("select * from member where ITEM='".$item."'"))
		{
			$this->db->update("update session set data='".$data."' , ip='".$ip."' , timenow='".$time."' where id='".$id."'");
			return true;
		}
		else
		{
			$this->db->insert("insert into session (id,data,ip,time,timenow) values ('".$id."','".$data."','".$ip."','".$time."','".$time."')");
			return true;
		}
	}
}

?>