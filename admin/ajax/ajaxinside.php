<?
include('../../config.php') ;
/*-----------------------------------
inside.php的下拉選單
-------------------------------------*/
$columnName = strtoupper($_POST['name']) ;
$db -> update("update ".$_POST['table']." set  ".$columnName." = '".$_POST['value']."' where ITEM ='".$_POST['item']."'") ;
?>
