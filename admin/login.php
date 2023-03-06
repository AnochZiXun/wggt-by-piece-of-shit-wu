<?
//網站系統設定
require('../config.php') ;
/*-----------------------------------
登入and語系
-------------------------------------*/
if($_POST['login'] == "login")
{
	switch($_POST['language'])
	{//判斷是否為繁中語系
		case "cn" :
			$_SESSION['admin_database_session'] = "_cn" ;
			break ;
		case "en" :
			$_SESSION['admin_database_session'] = "_en" ;
			break ;
		case "jp" :
			$_SESSION['admin_database_session'] = "_jp" ;
			break ;
		case "es" :
			$_SESSION['admin_database_session'] = "_es" ;
			break ;
		case "ch" :
			$_SESSION['admin_database_session'] = "" ;
			break ;
	}
	if($_POST['language'] != null)
	{
		$db_database = $db_database_change.$_SESSION['admin_database_session'] ;
	}
	
	$db -> close() ;
	$db = new dbClass($db_username , $db_password , $db_database , $db_hostname);
	$db->connect();
	$db->charset();
	mysql_query("set names 'utf8'") ;
	
	if($record = $db -> getfirst("select * from sys_control where DELETE_ID =0 and ACCOUNT = '".$_POST['account']."' and PASSWORD ='".$_POST['password']."'"))
	{
		$db -> update("update sys_control set LOGIN_TIME = now() , LOGIN_IP ='".$_SERVER['REMOTE_ADDR']."' where ITEM ='".$record['ITEM']."'") ;
		$_SESSION['system_item']  = $record['ITEM'] ;
		$_SESSION['system_id']    = $record['ACCOUNT'] ;
		$_SESSION['system_pwd']   = $record['PASSWORD'] ;
		$_SESSION['system_status'] = $record['SELECT_GROUP'] ;
		header("Location: .") ;
		exit ; 
	}
	else
	{
		header("Location: login.php?error_mark=1") ;
		exit ; 
	}
	echo $db_database ;
}
/*-----------------------------------
切換語系
-------------------------------------*/
if($_POST['login'] == "change")
{
	switch($_POST['language'])
	{//判斷是否為繁中語系
		case "cn" :
			$_SESSION['admin_database_session'] = "_cn" ;
			break ;
		case "en" :
			$_SESSION['admin_database_session'] = "_en" ;
			break ;
		case "jp" :
			$_SESSION['admin_database_session'] = "_jp" ;
			break ;
		case "es" :
			$_SESSION['admin_database_session'] = "_es" ;
			break ;
		case "ch" :
			$_SESSION['admin_database_session'] = "" ;
			break ;
	}
	$db_database = $db_database_change.$_SESSION['admin_database_session'] ;
	$db -> close() ;
	$db = new dbClass($db_username , $db_password , $db_database , $db_hostname);
	$db->connect();
	$db->charset();
	mysql_query("set names 'utf8'") ;
	if($record = $db -> getfirst("select * from sys_control where DELETE_ID =0 and ACCOUNT = '".$_SESSION['system_id']."' and PASSWORD ='".$_SESSION['system_pwd']."'"))
	{
		$_SESSION['system_item']  = $record['ITEM'] ;
		$_SESSION['system_id']  = $record['ACCOUNT'] ;
		$_SESSION['system_pwd'] = $record['PASSWORD'] ;
		$_SESSION['system_status'] = $record['SELECT_GROUP'] ;
		header("Location: .") ;
		exit ; 
	}
	else
	{
		header("Location: login.php?error_mark=1") ;
		exit ; 
	}
}
/*-----------------------------------
登出
-------------------------------------*/
if ($_POST['login'] =="out")
{
	session_unset();
	session_destroy();
	header("Location: login.php?error_mark=2");
    exit ; 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-tw" />
<meta name="Author" content="Huang Chang Wu" />
<link rev="Huang Chang Wu" href="mailto:awu0307@hotmail.com" />
<link href="css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/selectjs.js"></script>
<title><?=$system_name?>系统登入</title>
</head>
<body>
<div id="container">
	<div id="header">
		<div id="logo"><h1><a href="login.php"><img src="images/logo.png" alt="" title="" /></a></h1></div>
		<div id="globalNav"></div>
	</div>
<?include('./main/lang.php')?>
<script type="text/javascript">
$(document).ready(function(){
	if(parseInt(navigator.appVersion)>3) 
	{
		if(navigator.appName=="Netscape") 
		{
			winW = window.innerWidth;
			winH = window.innerHeight;
			changeHeight = 'height:'+ (winH - 121 - 30) +'px;';
		}
		if(navigator.appName.indexOf("Microsoft")!=-1) 
		{
			winW = document.documentElement.clientWidth;
			winH = document.documentElement.clientHeight;
			changeHeight = 'min-height:'+(winH - 121 - 30)+'px;_height:'+(winH - 121 - 30)+'px;';
		}
		$('#content').attr('style',changeHeight) ;
	}
}) ;
</script>
	<div id="content" style="">
		<form name="form" action="login.php" method="post">
			<ul id="login" <?=(count($lang_array) == 1)?"style=\"top:130px;\"":""?>>
				<li><span class="inputWord">Account：</span><span class="inputBar"><input type="input" name="account" class="input" /></span></li>
				<li><span class="inputWord">Password：</span><span class="inputBar"><input type="password" name="password" class="input" /></span></li>
<?
if(count($lang_array) != 1)
{
?>
				<li><span class="inputWord">Language：</span><input type="button" value="--請選擇--" class="select" onclick="downToggle(this,'#selectBar')" onfocus="this.blur()" />
					<ul id="selectBar"><?=$lang_string?></ul>
				</li>
<?
}
?>
				
			</ul>
			<input type="hidden" name="language" value="" />
			<input type="hidden" name="login" value="login" />
			<div id="loginMenu">
				<input type="image" src="images/login.gif" class="menu" />
				<img src="images/reset.gif" class="menu" onclick="javascript:document.form.reset();"/>
			</div>
		</form>
	</div>
<?
//底部版權宣告
require('./main/footer.php') ;
?>
</div>
</body>
</html>