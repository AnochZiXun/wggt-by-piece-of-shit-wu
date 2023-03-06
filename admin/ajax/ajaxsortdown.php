<?
include('../../config.php') ;
/*-----------------------------------
排序
-------------------------------------*/
if($_POST['kind'] == 0)
{
	$nowitem = $db -> getfirst("select * from ".$_POST['table']." where ITEM ='".$_POST['nowitem']."'") ;
	$downitem = $db -> getfirst("select * from ".$_POST['table']." where SORT > '".$nowitem['SORT']."' and CATE_INDEX ='".$nowitem['CATE_INDEX']."' order by SORT ASC") ;
}
else
{
	$nowitem = $db -> getfirst("select * from ".$_POST['table']." where ITEM ='".$_POST['nowitem']."'") ;
	$downitem = $db -> getfirst("select * from ".$_POST['table']." where SORT > '".$nowitem['SORT']."' order by SORT ASC") ;
}

if($downitem['ITEM'] != null)
{
	$db -> update("update ".$_POST['table']." set SORT = '".$nowitem['SORT']."' where ITEM ='".$downitem['ITEM']."'") ;
	$db -> update("update ".$_POST['table']." set SORT = '".$downitem['SORT']."' where ITEM ='".$nowitem['ITEM']."'") ;
}
	$arr = array ('control'=> $_POST['control'] , 'kind'=> $_POST['kind'] , 'page'=> $_POST['page'] ) ;
	echo json_encode($arr);

?>
