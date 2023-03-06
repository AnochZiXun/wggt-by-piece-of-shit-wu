<?
//網站系統設定
require('../config.php') ;
//後台設定檔引入
require('./config_top.php') ;
require('./config.php') ;
require('./main/lang.php') ;
if(!$_SESSION['system_id'])
{//無session值，導回登入頁
	header("Location: login.php?error_mark=3") ;
    exit ; 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-tw" />
<meta name="Author" content="Huang Chang Wu" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="Cache-Control" content="no-cache" />
<link rev="Huang Chang Wu" href="mailto:awu0307@hotmail.com" />
<link href="css/css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/selectjs.js"></script>
<script type="text/javascript" src="js/history.js"></script>
<title><?=$system_name?>管理後臺</title>
<script type="text/javascript">
$(document).ready(function(){
	$('#ajaxload').ajaxStart(function(){
		$(this).show();
	}).ajaxStop(function(){
		$(this).hide() ;
	});
//左邊空的移除
	$('.left_main_zone').each(function(){
		if( $('>ul' ,this).html() == '' || $('>ul' ,this).html() == null )
		{
			$(this).remove() ;
		}
	}) ;
//調高
	if(parseInt(navigator.appVersion)>3) 
	{
		if(navigator.appName=="Netscape") 
		{
			winH = window.innerHeight;
			changeHeight = 'min-height:'+ (winH - 121 - 30) +'px;';
			changeHeightMenu = 'min-height:'+ (winH - 121 - 30 - 60) +'px;';
		}
		if(navigator.appName.indexOf("Microsoft")!=-1) 
		{
			winH = document.documentElement.clientHeight;
			changeHeight = 'min-height:'+(winH - 121 - 30)+'px;_height:'+(winH - 121 - 30)+'px;';
			changeHeightMenu = 'height:'+ (winH - 121 - 30 - 50) +'px;';
		}
		$('#mainContent').attr('style',changeHeight) ;
		$('#mainMenu').attr('style',changeHeight) ;
		$('#menuStart').attr('style',changeHeightMenu) ;
	}
}) ;

function loadContent(hash)
{// 根據傳回的 hash（錨點），AJAX 置換顯示的內容
    if(hash) 
	{//重新讀取指定頁面
		$("#mainContent").load(hash);
    }
	else 
	{//如果沒有回傳值，代表已經回到 AJAX 的初始狀態頁，清空顯示的內容
		$("#mainContent").empty();
    }
}
</script>
</head>
<body>
<div id="container">
<div id="ajaxload"><img src="./images/loadimg.gif" /></div>
<?
//Logo、語系檔
require('./main/header.php') ;
?>

<div id="mainMenu" style="">
<?
//左方選單
require('./main/left.php') ;
?>
</div>
<div id="mainContent" style="">

</div>
<?
//底部版權宣告
require('./main/footer.php') ;
?>
</div>
<script type="text/javascript">
//紀錄步驟
//index
$.history.init(loadContent);
var url = './main/content.php';
url = url.replace(/^.*#/, '');
$.history.load(url);
//left
$('#gopath').click(function(){
	window.open($(this).attr('thishref')) ;
}) ;
$('#goindex').click(function(){
	location.href = $(this).attr('thishref') ;
}) ;
</script>
</body>
</html>