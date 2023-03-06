<?
include('../../../config.php') ;
?>
<script type="text/javascript" src="js/jquery.form.js"></script>

<div style="margin-left:100px;">
<?
//資料匯入
echo "<br><br><br>";
echo "Universal資料匯入"."<br>";
echo "<div align='left' style='color:red'>";
echo "<br/>";

if($_GET['upload'] != "ok")
{
	echo "<form name=\"form\" id=\"form\"  action=\"./module/excel/index.php\" method=\"post\" enctype=\"multipart/form-data\">";
	echo "<input type=\"file\" name=\"excel\" /><br /><br />";
	echo "<input type=\"submit\" value=\"確定送出\" />";
	echo "<input type=\"hidden\" name=\"uploadcheck\" value=\"true\" />" ;
	echo "</form>";
}

if($_POST['uploadcheck'] == "true")
{
	if($_FILES['excel']['name'] != null)
	{
		$tmp_name = $_FILES['excel']['name'];
		copy($_FILES['excel']['tmp_name'],"./upfile/universal.xls") ; 
	}
}
if($_GET['upload'] == "ok")
{
	echo "<a href=\"./module/excel/excel.php?filename=universal&tablename=universal\" target=\"_blank\" id=\"changeexcel\" style=\"color:blue;font-size:14px;\">請按此將上傳檔案匯入資料庫</a>" ;
}
echo "<br><br><br><br>" ;
?>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#excel').click(function(){
		$('#mainContent').load('./module/excel/index.php?change=true') ;
	}) ;

//Ajax表單
var options = {
	target: '#form',
	url: './module/excel/index.php',
	type: 'POST',
	dataType: 'json',
	success: function (){},
	complete :function(){
		$('#mainContent').load('./module/excel/index.php?upload=ok') ;
		alert("檔案已上傳") ;
	}
	};
	$('#form').ajaxForm(options);

}) ;
</script>