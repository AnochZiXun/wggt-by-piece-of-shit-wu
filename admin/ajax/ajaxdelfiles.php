<?
include('../../config.php') ;
/*-----------------------------------
修改刪除圖片
-------------------------------------*/
$record = $db -> getfirst("select * from ".$_POST['table']." where ITEM ='".$_POST['item']."'") ;
$column = strtoupper($_POST['column']) ;
$explodevalue = explode(",",$record[$column]) ;
$fileList = '' ;
foreach($explodevalue as $key => $value)
{
	if($value != $_POST[value])
	{
		$i++ ;
		$fileList .= $value ;
		if((count($explodevalue)-1) != $i)
		{
			$fileList .= "," ;
		}
	}
}
$db -> update("update ".$_POST['table']." set ".$column." = '".$fileList."' where ITEM ='".$_POST['item']."'") ;
//刪除舊檔案
$file ="../../upload/".$_POST['value']."";
if(file_exists($file))
{
	unlink($file);
}
?>
