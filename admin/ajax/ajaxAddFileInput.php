<?
include('../../config.php') ;
/*-----------------------------------
多檔上傳撈圖、刪圖
-------------------------------------*/
$inputFile = $_GET['columnen']."input" ; //多檔上傳欄位名字


if( $_POST['manyinput'] == 'true' )
{
	$db -> update("update uploadfile set TOPIC = '".$_POST['thisValue']."' where ITEM ='".$_POST['thisItem']."'") ;
}


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
	$result = $db -> query("select * from uploadfile order by SORT ASC") ;
	while( $record = $db -> getarray($result) )
	{
		echo "<span class=\"muchFile\"><font style=\"color:#ff0000;cursor:pointer;text-align:right;width:80%;display:block;\" thisTable=\"uploadfile\" thisItem=\"".$record['ITEM']."\" thisCol=\"FILENAME\" thisImgStatus=\"add\" thisvalue=\"".$record['ITEM']."\" thisimg=\"".$record['FILENAME']."\" class=\"clickimgs\">刪除</font><a href=\"../upload/".$record['FILENAME']."\" class=\"lightbox\" rel=\"".$_GET['addfileRel']."\"><img src=\"../upload/".$record['FILENAME']."\"></a><input type=\"text\" class=\"".$inputFile."\" thisItem=\"".$record['ITEM']."\" value=\"".$record['TOPIC']."\" style=\"width:75px;margin-top:5px;float:left;\" /></span>" ;
	}
	echo "</div>" ;
}
if($_GET['page_status'] == 'modefy')
{//修改
	$record = $db -> getfirst("select * from ".$_GET['table']." where DELETE_ID =0 and ITEM ='".$_GET['item']."'") ;
	$imgList = explode(",",$record[strtoupper($_GET['columnen'])]) ;

	$topicList = explode(",",$record[strtoupper($inputFile)]) ;
	echo "<div style=\"width:100%;float:left;\">" ;
	foreach($imgList as $key => $value)
	{
		if($value != null)
		{
			echo "<span class=\"muchFile\"><font style=\"color:#ff0000;cursor:pointer;text-align:right;width:80%;display:block;\" thisTable=\"".$_GET['table']."\" thisItem=\"".$_GET['item']."\" thisCol=\"".$_GET['columnen']."\" thisImgStatus=\"modefy\" thisvalue=\"".$record['ITEM']."\" thisimg=\"".$value."\" class=\"clickimgs\">刪除</font><a href=\"../upload/".$value."\" class=\"lightbox\" rel=\"".$_GET['addfileRel']."\"><img src=\"../upload/".$value."\"></a><input type=\"text\" class=\"".$inputFile."\" name=\"".$inputFile."[]\" thisItem=\"".$record['ITEM']."\" value=\"".$topicList[$key]."\" style=\"width:75px;margin-top:5px;float:left;\" /></span>" ;
		}
	}

	$result = $db -> query("select * from uploadfile order by SORT ASC") ;
	while( $record = $db -> getarray($result) )
	{
		if( in_array($record['FILENAME'] , $imgList) == false )
		{
			echo "<span class=\"muchFile\"><font style=\"color:#ff0000;cursor:pointer;text-align:right;width:80%;display:block;\" thisTable=\"uploadfile\" thisItem=\"".$record['ITEM']."\" thisCol=\"FILENAME\" thisImgStatus=\"modefy\" thisvalue=\"".$record['ITEM']."\" thisimg=\"".$record['FILENAME']."\" class=\"clickimgs\">刪除</font><a href=\"../upload/".$record['FILENAME']."\" class=\"lightbox\" rel=\"".$_GET['addfileRel']."\"><img src=\"../upload/".$record['FILENAME']."\"></a><input type=\"text\" class=\"".$inputFile."\" name=\"".$inputFile."[]\" thisItem=\"".$record['ITEM']."\" value=\"".$record['TOPIC']."\" style=\"width:75px;margin-top:5px;float:left;\" /></span>" ;
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
		$.post('./ajax/ajaxAddFileInput.php',{ 'item':$(this).attr('thisvalue') , 'value':$(this).attr('thisimg') , 'thisImgStatus':$(this).attr('thisImgStatus') , 'thisTable':$(this).attr('thisTable') , 'thisItem':$(this).attr('thisItem') , 'thisCol':$(this).attr('thisCol') },function(){},'json');
	}) ;
	
	
	//值新增
	$('input[class="<?=$inputFile?>"]').change(function(){
		$.post('./ajax/ajaxAddFileInput.php',{ 'thisValue':$(this).val() , 'thisItem':$(this).attr('thisItem') , 'manyinput':'true' },function(){},'json');
	}) ;
	
	
	
	
	
	
}) ;
</script>