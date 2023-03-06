<?
require('../../../config.php') ;
/*
$db_username = "shenteya_lin" ;
$db_password = "ydc1234" ;
$db_database = "shenteya_lin".$_GET['lang'] ;
$db_hostname = "localhost" ;
$db -> close() ;
$db = new dbClass($db_username , $db_password , $db_database , $db_hostname);
$db->connect();
$db->select();
mysql_query("set names 'utf8'") ;
*/
if(!empty($_FILES))
{
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$new_name = time()."_".rand(1,9999) ;
	//取得副檔名
	$type_file = strtolower(strrchr($_FILES['Filedata']['name'], ".")) ;
	$filesname = $new_name.$type_file ;
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/' ;
	$targetFile =  str_replace('//','/',$targetPath) . $filesname ;
	copy($tempFile,$targetFile) ;
	if($type_file=='.jpg' || $type_file=='.jpeg'){
		$file = $targetFile;
		$quality = 90;
		$img = imagecreatefromjpeg($file);
		@imagejpeg($img, $file, $quality);
		@imagedestroy($img);
	}
	$db -> insert("Insert into uploadfile( FILENAME , MEMBER_NUM ) values ( '".$filesname."' , '".$_SESSION['system_item']."' )") ;
	$insert_id = $db ->getid() ;
	$db -> update("update uploadfile set SORT ='".$insert_id."' where ITEM ='".$insert_id."'") ;
	echo "1";
}
?>