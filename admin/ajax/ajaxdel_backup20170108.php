<?
include('../../config.php') ;
/*-----------------------------------
刪除
-------------------------------------*/
if($_POST['postkind'] == "category")
{
	$db -> del("delete from ".$_POST['table']." where ITEM ='".$_POST['item']."' or LOCATE('".$_POST['item']."<br>',DOC_PATH)!=0") ;
}
if($_POST['postkind'] == "data")
{
	$db -> del("delete from ".$_POST['table']." where ITEM ='".$_POST['item']."'") ;
	$arr = array ('control'=> $_POST['control'] , 'kind'=> 1 , 'page'=> $_POST['page'] ) ;
	echo json_encode($arr);
}
if($_POST['postkind'] == "muchdata")
{
	$delitem = explode("." , $_POST['item']) ;
	foreach($delitem as $key => $value)
	{
		$db -> del("delete from ".$_POST['table']." where ITEM ='".$value."'") ;
	}
	$arr = array ('control'=> $_POST['control'] , 'kind'=> 1 , 'page'=> $_POST['page'] ) ;
	echo json_encode($arr);
}
?>
