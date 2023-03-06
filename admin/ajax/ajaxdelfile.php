<?
include('../../config.php') ;
/*-----------------------------------
修改刪除圖片
-------------------------------------*/
$_POST['column'] = strtoupper($_POST['column']) ;
$db -> update("update ".$_POST[table]." set ".$_POST['column']." = '' where ITEM ='".$_POST['item']."'") ;

//刪除舊檔案
$file ="../../upload/".$_POST['value']."";
if(file_exists($file))
{
	unlink($file);
}
?>
