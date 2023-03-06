<?
include('../../config.php') ;
/*-----------------------------------
全部排序
-------------------------------------*/
foreach($_POST['sort'] as $key => $value)
{
	$db -> update("update ".$_POST['table']." set SORT ='".$value."' where ITEM ='".$_POST['item'][$key]."'") ;
}
?>
