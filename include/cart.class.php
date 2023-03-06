<?
/*
 *  @author : wu
 *  @description : 購物車class
 *  @version : 1.0 2010/03/25
*/
class cart
{
	public $db ;
	private $pitem ;   //產品ITEM 
	private $pid ;     //購買者SESSION_ID
	private $pnum ;    //購買數量
	private $ptable ;  //資料表
	private $ptime ;   //時間
	
	function __construct()
	{
		global $db ;
		$this -> db = $db ;
	}
/*
將物品加入購物車
@ptable 關連性資料表(產品有多個資料表的時候)
@pitem  產品的ITEM值
@pid    使用者的session_id
@pnum   數量  
*/
	function addCart($ptable , $pitem , $pid , $pnum)
	{
		$check = $this -> db -> getcount("select * from cart where DELETE_ID =0 and PITEM ='".$pitem."' and PID ='".$pid."' and PTABLE ='".$ptable."'") ;
		if($check >= 1)
		{
			$this -> db -> update("update cart set PNUM ='".$pnum."' where PITEM ='".$pitem."' and PID ='".$pid."' and PTABLE ='".$ptable."'") ;
			return true;
		}
		else
		{
			$this -> db -> insert("insert into cart(PITEM , PNUM , PID , PTABLE , MODEFY_TIME , SET_TIME , DELETE_ID)values('".$pitem."' , '".$pnum."' , '".$pid."' , '".$ptable."' , now() , now() , 0)") ;
			return true;
		}
	}

/*
會員登入後，將cart資料表的PID更新為登入後的SESSION
@pid      購買者SESSION_ID
@prevPid  購買者未登入的SESSION_ID
*/
	function loginCart( $pid , $prevPid )
	{
		$result = $this -> db -> query("select * from cart where PID ='".$prevPid."'") ;
		while( $record = $this -> db ->getarray($result) )
		{
			$this -> db -> update("update cart set PID = '".$pid."' where ITEM='".$record['ITEM']."'") ;
		}
		
	}

/*
購物車第二步驟，將選定的商品數量更新至資料表
@pnum    數量 
@pitem   產品item值 
*/
	function updateCart($pitem , $prow )
	{
		foreach($pitem as $key => $value)
		{
			$this -> db -> update("update cart set PNUM = '".$prow[$key]."' where ITEM='".$pitem[$key]."'") ;
		}
	}
	
/*
將購物車超過時間的資料刪除
@ptime 時間
*/
	function longCart($ptime)
	{
		$this -> db -> del( "delete from cart where MODEFY_TIME < NOW() - INTERVAL '".$ptime."' MINUTE");
	}
/*
刪除相對應的貨物
@ptable  資料表
@pid     購買者SESSION_ID
@pitem   刪除的貨品
*/
	function delCart($ptable , $pid , $pitem )
	{
		if($pitem != null)
		{
			$this -> db -> del( "delete from ".$ptable." where PID='".$pid."' and ITEM ='".$pitem."'") ;
		}
		else
		{
			$this -> db -> del( "delete from ".$ptable." where PID='".$pid."'") ;
		}
	}
}
?>