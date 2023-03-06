<?
include('../../config.php') ;
/*-----------------------------------
尋找分類
-------------------------------------*/
$rows = $db -> getcount("select * from ".$_POST['table']." where DELETE_ID =0 and CATE_INDEX ='".$_POST['item']."'") ;
if($rows != 0)
{
	$level = $_POST['nowlevel'] + 1 ;
	$responseString = "<span id=\"datacategory".$level."\">" ;
	$responseString .= "<select name=\"datacategory".$level."\" nowlevel=\"".$level."\"><option value=\"\">--請選擇--</option>" ;
	$result = $db -> query("select * from ".$_POST['table']." where DELETE_ID =0 and CATE_INDEX ='".$_POST['item']."' order by SORT ASC") ;
	while($record = $db -> getarray($result))
	{
		$responseString .= "<option value=\"".$record['ITEM']."\">".$record[$_POST['topic']]."</option>" ;
	}
	$responseString .= "</select></span>" ;
	$record = $db -> getfirst("select * from ".$_POST['table']." where DELETE_ID =0 and ITEM ='".$_POST['item']."'") ;
	$arr = array ('select'=> $responseString , 'level'=> $level , 'check'=> "havecategory" , 'catelist' => $record['DOC_PATH']."".$_POST['item']."<br>" ) ;
	echo json_encode($arr);
}
else
{
	$record = $db -> getfirst("select * from ".$_POST['table']." where DELETE_ID =0 and ITEM ='".$_POST['item']."'") ;
	$arr = array ('check'=> "nocategory" , 'catelist' => $record['DOC_PATH']."".$_POST['item']."<br>" ) ;
	echo json_encode($arr);
}
?>
