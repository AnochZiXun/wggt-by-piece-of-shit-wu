<?
include('../config.php') ;
$control = $_GET['control'] ;
include('./config.php') ;
if(!$_SESSION['system_item'])
{
	header("Location: login.php?error_mark=long") ;
}
if($_GET['catelist'])
{
	$catelist = "and DOC_PATH like '%".$_GET['catelist']."%'" ;
}

//排序
			switch($sortList[$_GET['kind']])
			{
				case "ASC" :
					$dataSort = "ASC" ;
					break ;
				case "DESC" :
					$dataSort = "DESC" ;
					break ;
				default :
					$dataSort = "ASC" ;
					break ;
			}
			
			
			
			
		//計算資料筆數
		$rows = $db -> getcount("select * from ".$product_set_table[$_GET['kind']]." where DELETE_ID =0 ".$catelist."") ;
		if($rows != 0)
		{
?>
<script type="text/javascript" src="js/dragsort.js"></script>
<script type="text/javascript" src="js/iprint.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<form name="sortform" id="sortform">
		<div id="controlMenu">
			<span class="selectall"></span>
			<div id="methodMenu">
				<input type="image" src="images/save.gif" />
			</div>
		</div>
		<input type="hidden" name="table" value="<?=$product_set_table[$_GET['kind']]?>" />
		<ul id="dataList">
<?
			$result = $db -> query("select * from ".$product_set_table[$_GET['kind']]." where DELETE_ID =0 ".$catelist." order by SORT ".$dataSort."") ;
			$i = 0 ;
			while($record = $db -> getarray($result))
			{
				$i++ ;
				if($i % 2 == 1)
				{
					echo "<li class=\"odd\">" ;
				}
				else
				{
					echo "<li class=\"even\">" ;
				}
?>
				<p class="columnShow"><?=$record[strtoupper($product_set_para_en[$_GET['kind']][0])]?></p>
				<input type="hidden" name="item[]" value="<?=$record['ITEM']?>" />
			</li>
			
			<input type="hidden" name="sort[]" value="<?=$record['SORT']?>" />
<?
			}
		}
?>
		</ul>
</form>
<script type="text/javascript">
$(document).ready(function(){
	$("#dataList").dragsort({
		dragBetween: true 
	});
//Ajax表單
var options = {
	target: '#sortform',
	url: './ajax/ajaxsort.php',
	type: 'POST',
	dataType: 'json' ,
	complete :function(){
		//右方頁面重LOAD
		//$('#mainContent').load('inside.php?control=<?=$_GET['control']?>&kind=<?=$_GET['kind']?>') ;
		//紀錄步驟
		var url = 'inside.php?control=<?=$_GET['control']?>&kind=<?=$_GET['kind']?>&catelist=<?=$_GET['catelist']?>' ;
		url = url.replace(/^.*#/, '');
		$.history.load(url);
		return false;
	}
	};
	$('#sortform').ajaxForm(options);
	$('#mainMenu').css('minHeight',$('#mainContent').height())  ;
}) ;
</script>