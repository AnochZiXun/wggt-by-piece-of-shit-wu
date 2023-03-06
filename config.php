<?php
ob_start();
session_start();
//設定時區為亞洲時間
date_default_timezone_set('Asia/Taipei');
//公司名稱
$system_name = "WGGT" ; 
// 網站真實位址 
$system_true_path = "http://wggt.io/" ; 
///fckeditor設定位置夾 需設定網站資料夾的名稱(虛擬主機只需設定 / )
$system_dictionary_path = "/" ;
//語系設定 example: ch:繁體中文,cn:簡體中文,en:English
$system_language = "ch:繁體中文" ;
$add_top_menu_string[] = "<a href=\"../index.php\" target='_blank'>前台首頁</a>" ;
//資料庫資訊
define("ROOT", dirname(__FILE__));
$ROOT_PATH = ROOT;
require_once(ROOT."/include/db.class.php");
require_once(ROOT."/include/functions.inc.php");
mb_internal_encoding('UTF-8');
$db_username = "awu0307" ; 
$db_password = "pdi730307" ; 
$db_database = "gwc" ;
$db_hostname = "wggt.ccj3rsmxkrmf.ap-southeast-1.rds.amazonaws.com" ;
$db = new dbClass($db_username , $db_password , $db_database , $db_hostname);
$db->connect();
$db->charset();

/*Contact*/
if( isset($_POST['send']) ){
	if( $_POST['name']!=null && $_POST['tel']!=null && $_POST['email']!=null && ValidateEmailAddress($_POST['email']) == true ){
		if( $db -> insert("Insert into contact( NAME , TEL , EMAIL , CONTENT , CATE_INDEX , DOC_PATH , MODEFY_TIME , SET_TIME , DELETE_ID , MEMBER_NUM , DOC_LEVEL ) values 
		( '".$_POST['name']."' , '".$_POST['tel']."' , '".$_POST['email']."' , '".$_POST['content']."' , 0 , '0<br>' , now() , now() , 0 , 1 , 1 )") ){
			$insert_id = $db ->getid() ;
			$db -> update("update contact set SORT ='".$insert_id."' where ITEM ='".$insert_id."'") ;

			$content = "" ;
			$content .= "姓名：".$_POST['name']."<br />" ;
			$content .= "電話：".$_POST['tel']."<br />" ;
			$content .= "EMAIL：".$_POST['email']."<br />" ;
			$content .= "內容：".nl2br($_POST['content'])."<br /><br /><br />" ;

			$to_mail = "awu0307@gmail.com" ;
			$mail_topic = "WGGT-聯絡我們" ;
			$from_mail = "wggt@wggt.io" ;
			Sent_Email($to_mail,$from_mail,$mail_topic,$content) ;


			header("Location: #?send=ok") ;
			exit ; 
		}else{
			header("Location: #?send=error") ;
			exit ; 
		}
	}else{
		header("Location: #?send=error") ;
		exit ; 
	}
}
//會員登出
if( _get('logout') == 1 ){
	unset($_SESSION["user_id"]) ;
}
?>