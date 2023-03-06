<?
/*
 *  @author : wu
 *  @description : 連線資料庫class
 *  @version : 1.0 2010/03/02
*/
class dbClass
{
	public $username; 
	public $password;
	public $database;
	public $hostname;
	public $result;
	
	function __construct($username,$password,$database,$hostname)
	{
		$this->username=$username;
		$this->password=$password;
		$this->database=$database;
		$this->hostname=$hostname;
	}
	
/*
 * 這個函數用於連接資料庫
 * @param 
 */
	function connect()
	{//
		$this->link=mysqli_connect($this->hostname,$this->username,$this->password,$this->database) or die("Sorry,can not connect to database");
		return $this->link;
	}
	function charset()
	{
		mysqli_set_charset($this->link, 'utf8');
	}
	function Close()//關閉資料庫函數 
	{//這個函數用於關閉資料庫
		mysqli_close($this->link); 
	}

/*
 * 這個函數用於送出查詢語句並返回結果，常用。
 * @param $sql string 資料庫搜尋語法
 * @return result 資料庫連線指標
 */	
	function query($sql)
	{
		if($this->result=mysqli_query($this->link,$sql))
		{
			return $this->result;
		}
	}
/*
$db -> escape($_GET['value']) ;
*/
    function escape($str)
    {
		return @mysqli_real_escape_string($this->link,$str);
    }

/*
以下函數用於以結果取回數組，一般與 while()循環、$db->query($sql)配合使用，例如：
$result=$db->query("select * from xzy_teachfl order by tpx");
while($row=$db->getarray($result))
{
	echo "$row[id] ";
}
*/
	function getarray($result)
	{
		return @mysqli_fetch_array($result);
	}
	function getarray2($result)
	{
		return @mysqli_fetch_array($result,MYSQL_ASSOC);
	}
/*
以下函數用於取得SQL查詢的第一行，一般用於查詢符合條件的行是否存在，例如：
用戶從表單提交的用戶名$username、密碼$password是否在用戶表"user"中，並返回其相應的數組：
if($user=$db->getfirst("select * from user where username='$username' and password='$password' "))
{
	echo "歡迎$username ，您的ID是 $user[id] ";
}
else
{
	echo "用戶名或密碼錯誤！";
}
*/
	function getfirst($sql)
	{
		return @mysqli_fetch_array($this->query($sql));
	}
	
/*
以下函數返迴符合查詢條件的總行數，例如用於分頁的計算等要用到，例如：
$totlerows=$db->getcount("select * from mytable");
echo "共有 $totlerows 條信息。";
*/
	function getcount($sql)
	{
		return @mysqli_num_rows($this->query($sql)); 
	}
	
/*
以下函數用於更新資料庫，例如用戶更改密碼：
$db->update("update user set password='$new_password' where userid='$userid' ");
*/
	function update($sql)
	{
		return $this->query($sql);
	}

/*
寫入資料庫，例如增加使用者
$db->insert("insert into member (ITEM , NAME , PASSWORD) values (null,'".$_POST['name']."','".$_POST['password']."')");
*/
	function insert($sql)
	{
		return $this->query($sql);
	}
	//$db->del("delete from admin where user='".$user."'");
	function del($sql)
	{
		return $this->query($sql);
	}
	function getid()
	{//取得寫入資料庫的ID
		return mysqli_insert_id($this->link);
	}
}
/*
	主要的函數就是這些，如果你自己有另外的需要，也可以自己添加上去。
	因為凡使用該類的都必須連結資料庫，下面就連結並選擇好資料庫吧。
*/
?>
