<?
include('../../config.php') ;
if($_POST['manyfilesort'] == 'add')
{//新增的排序
	foreach($_POST['sort'] as $key => $value)
	{
		$db -> update("update uploadfile set SORT ='".$value."' where ITEM ='".$_POST['item'][$key]."'") ;
	}
}
if($_POST['manyfilesort'] == 'modefy')
{//修改的排序
	$imgsList = "" ;

	$a = 0 ;
	$arr_imgsList = array_unique($_POST['imgsList']) ;
	count($arr_imgsList) ;
	foreach($arr_imgsList as $key => $value)
	{
		$a++ ;
		
		if( count($arr_imgsList) != $a )
		{
			$imgsList .= $value."," ;
		}
		else
		{
			$imgsList .= $value ;
		}
	}
	//多檔欄位

	$db -> update("update ".$_POST['table']." set ".strtoupper($_POST['columnen'])." ='".$imgsList."'  where ITEM ='".$_POST['item']."'") ;
}
?>
<script type="text/javascript" src="js/dragsort.js"></script>
<script type="text/javascript" src="js/iprint.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<form name="manyfilesortform" id="manyfilesortform">
	<ul id="dataList">
<?
if($_GET['page_status'] == 'modefy')
{
	$record = $db -> getfirst("select * from ".$_GET['table']." where ITEM ='".$_GET['item']."'") ;
	$imgList = explode(",",$record[strtoupper($_GET['columnen'])]) ;

	
	
	
	foreach( $imgList as $key_in => $value_in )
	{
		if($value_in != null)
		{
?>
			<li style="float:left;width:100px;height:100px;overflow:hidden;">
				<img src="../upload/<?=$value_in?>" style="width:80px;height:auto;">
				<input type="hidden" name="item[]" value="<?=$record['ITEM']?>" />
				<input type="hidden" name="imgsList[]" value="<?=$value_in?>" />
			</li>
			<input type="hidden" name="sort[]" value="<?=$record['SORT']?>" />
<?
		}
	}
	$result = $db -> query("select * from uploadfile where MEMBER_NUM = '".$_SESSION['system_item']."' order by SORT ASC") ;
	while($record = $db -> getarray($result))
	{
		if( in_array($record['FILENAME'] , $imgList) == false )
		{
?>
			<li style="float:left;width:100px;height:100px;overflow:hidden;">
				<img src="../upload/<?=$record['FILENAME']?>" style="width:80px;height:auto;">
				<input type="hidden" name="item[]" value="<?=$record['ITEM']?>" />
				<input type="hidden" name="imgsList[]" value="<?=$record['FILENAME']?>" />
			</li>
			<input type="hidden" name="sort[]" value="<?=$record['SORT']?>" />
<?
		}
	}
}
if($_GET['page_status'] == 'add')
{
	$result = $db -> query("select * from uploadfile where MEMBER_NUM = '".$_SESSION['system_item']."' order by SORT ASC") ;
	while($record = $db -> getarray($result))
	{
?>
			<li style="float:left;width:100px;height:100px;overflow:hidden;">
				<img src="../upload/<?=$record['FILENAME']?>" style="width:80px;height:auto;">
				<input type="hidden" name="item[]" value="<?=$record['ITEM']?>" />
			</li>
			<input type="hidden" name="sort[]" value="<?=$record['SORT']?>" />
<?
	}
}
?>
	</ul>
<?
if($_GET['page_status'] == 'modefy')
{
	echo "<input type=\"hidden\" name=\"manyfilesort\" value=\"modefy\" />" ;
	echo "<input type=\"hidden\" name=\"table\" value=\"".$_GET['table']."\" />" ;
	echo "<input type=\"hidden\" name=\"item\" value=\"".$_GET['item']."\" />" ;
	echo "<input type=\"hidden\" name=\"columnen\" value=\"".$_GET['columnen']."\" />" ;
}
if($_GET['page_status'] == 'add')
{
	echo "<input type=\"hidden\" name=\"manyfilesort\" value=\"add\" />" ;
}
?>
	<input type="submit" value="儲存" id="savethickbox" onclick="self.parent.tb_remove();" />
</form>
<script type="text/javascript">
$(document).ready(function(){
	$("#dataList").dragsort({});
//Ajax表單
var options = {
	target: '#manyfilesortform',
	url: './ajax/manyfilesort.php',
	type: 'POST',
	dataType: 'json' ,
	complete :function(){
<?
if($_GET['manyfile'] == 'false')
{
?>
		$("#<?=$_GET['columnen']?>Zone").load("./ajax/ajaxAddFile.php?addfileRel=<?=$_GET['columnen']?>&page_status=<?=$_GET['page_status']?>&columnen=<?=$_GET['columnen']?>&item=<?=$_GET['item']?>&table=<?=$_GET['table']?>") ;
<?
}
if($_GET['manyfile'] == 'true')
{
?>
		$("#<?=$_GET['columnen']?>Zone").load("./ajax/ajaxAddFileInput.php?addfileRel=<?=$_GET['columnen']?>&page_status=<?=$_GET['page_status']?>&columnen=<?=$_GET['columnen']?>&item=<?=$_GET['item']?>&table=<?=$_GET['table']?>") ;
<?
}
?>
	}
	};
	$('#manyfilesortform').ajaxForm(options);
}) ;
</script>