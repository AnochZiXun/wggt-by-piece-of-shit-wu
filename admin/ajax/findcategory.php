<?
include('../../config.php') ;
/*-----------------------------------
尋找分類
-------------------------------------*/
$rows = $db -> getcount("select * from ".$_POST['table']." where DELETE_ID =0 and CATE_INDEX ='".$_POST['item']."'") ;
if($_POST['SelectCheck'] == 'true')
{
	$SelectCheck = "" ;
}
else
{
	$SelectCheck = "validate=\"required:true\"" ;
}
if($rows != 0)
{
	$level = $_POST['nowlevel'] + 1 ;
	$responseString = "<div id=\"datacategory".$level."\">" ;
	$responseString .= "<select name=\"datacategory".$level."\" nowlevel=\"".$level."\" title=\"請選擇分類\" ".$SelectCheck."><option value=\"\"></option>" ;
	$result = $db -> query("select * from ".$_POST['table']." where DELETE_ID =0 and CATE_INDEX ='".$_POST['item']."' order by SORT ASC") ;
	while($record = $db -> getarray($result))
	{
		$responseString .= "<option value=\"".$record['ITEM']."\">".$record[$_POST['topic']]."</option>" ;
	}
	$responseString .= "</select></div>" ;
	$arr = array ('select'=> $responseString , 'level'=> $level , 'check'=> "havecategory" ) ;
	echo json_encode($arr);
}
else
{
	$arr = array ('check'=> "nocategory" ) ;
	echo json_encode($arr);
}
?>
