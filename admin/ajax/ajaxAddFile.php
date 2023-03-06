<?
include('../../config.php') ;
/*-----------------------------------
多檔上傳撈圖、刪圖
-------------------------------------*/
if($_POST['thisImgStatus'] == 'add')
{//新增時刪除圖片
	$db -> del("delete from uploadfile where ITEM ='".$_POST['item']."'") ;
	$file ="../../upload/".$_POST['value']."";
	if(file_exists($file))
	{
		unlink($file);
	}
}
if($_POST['thisImgStatus'] == 'modefy')
{//修改時刪除圖片
	$record = $db -> getfirst("select * from ".$_POST['thisTable']." where ITEM ='".$_POST['thisItem']."'") ;
	$column = strtoupper($_POST['thisCol']) ;
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
	$db -> update("update ".$_POST['thisTable']." set ".$column." = '".$fileList."' where ITEM ='".$_POST['thisItem']."'") ;
	//刪除舊檔案
	$file ="../../upload/".$_POST['value']."";
	if(file_exists($file))
	{
		unlink($file);
	}
}
if($_GET['page_status'] == 'add')
{//新增
	echo "<div style=\"width:100%;float:left;\">" ;
	$result = $db -> query("select * from uploadfile where MEMBER_NUM = '".$_SESSION['system_item']."' order by SORT ASC") ;
	while( $record = $db -> getarray($result) )
	{
		echo "<span class=\"muchFile\"><font style=\"color:#ff0000;cursor:pointer;text-align:right;width:80%;display:block;\" thisTable=\"uploadfile\" thisItem=\"".$record['ITEM']."\" thisCol=\"FILENAME\" thisImgStatus=\"add\" thisvalue=\"".$record['ITEM']."\" thisimg=\"".$record['FILENAME']."\" class=\"clickimgs\">刪除</font><a href=\"../upload/".$record['FILENAME']."\" class=\"lightbox\" rel=\"".$_GET['addfileRel']."\"><img src=\"../upload/".$record['FILENAME']."\"></a></span>" ;
	}
	echo "</div>" ;
}
if($_GET['page_status'] == 'modefy')
{//修改
	$record = $db -> getfirst("select * from ".$_GET['table']." where DELETE_ID =0 and ITEM ='".$_GET['item']."'") ;
	$imgList = explode(",",$record[strtoupper($_GET['columnen'])]) ;
	echo "<div style=\"width:100%;float:left;\">" ;
	foreach($imgList as $key => $value)
	{
		if($value != null)
		{
			echo "<span class=\"muchFile\"><font style=\"color:#ff0000;cursor:pointer;text-align:right;width:80%;display:block;\" thisTable=\"".$_GET['table']."\" thisItem=\"".$_GET['item']."\" thisCol=\"".$_GET['columnen']."\" thisImgStatus=\"modefy\" thisvalue=\"".$record['ITEM']."\" thisimg=\"".$value."\" class=\"clickimgs\">刪除</font><a href=\"../upload/".$value."\" class=\"lightbox\" rel=\"".$_GET['addfileRel']."\"><img src=\"../upload/".$value."\"></a></span>" ;
		}
	}

	$result = $db -> query("select * from uploadfile where MEMBER_NUM = '".$_SESSION['system_item']."' order by SORT ASC") ;
	while( $record = $db -> getarray($result) )
	{
		if( in_array($record['FILENAME'] , $imgList) == false )
		{
			echo "<span class=\"muchFile\"><font style=\"color:#ff0000;cursor:pointer;text-align:right;width:80%;display:block;\" thisTable=\"uploadfile\" thisItem=\"".$record['ITEM']."\" thisCol=\"FILENAME\" thisImgStatus=\"modefy\" thisvalue=\"".$record['ITEM']."\" thisimg=\"".$record['FILENAME']."\" class=\"clickimgs\">刪除</font><a href=\"../upload/".$record['FILENAME']."\" class=\"lightbox\" rel=\"".$_GET['addfileRel']."\"><img src=\"../upload/".$record['FILENAME']."\"></a></span>" ;
		}
	}
	echo "</div>" ;
}
?>
<script type="text/javascript">
$(function() {
    $(".lightbox").lightbox({fitToScreen: true});
});
$(document).ready(function(){
//多檔刪除
	$('.clickimgs').click(function(){
		$(this).parent().remove() ;
		$.post('./ajax/ajaxAddFile.php',{ 'item':$(this).attr('thisvalue') , 'value':$(this).attr('thisimg') , 'thisImgStatus':$(this).attr('thisImgStatus') , 'thisTable':$(this).attr('thisTable') , 'thisItem':$(this).attr('thisItem') , 'thisCol':$(this).attr('thisCol') },function(){},'json');
	}) ;
}) ;
</script>