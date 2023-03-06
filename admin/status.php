<?
include('../config.php') ;
if(!$_SESSION['system_item']){echo "<script type=\"text/javascript\">location.href='login.php' ;</script>" ;}
$control = $_GET['control'] ;
include('./config.php') ;
include('./main/column.php') ;
require("../fckeditor/fckeditor.php") ;
require("../fckeditor/ckfinder/ckfinder.php") ;
?>
<link href="js/lightbox.css" rel="stylesheet" type="text/css" />
<link rel="Stylesheet" href="js/jquery.datepick.css" />
<link rel="Stylesheet" href="js/upload/uploadify.css" />
<link rel="Stylesheet" href="js/thickbox.css" />
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.lightbox.js"></script>
<script type="text/javascript" src="js/jquery.datepick.min.js"></script>
<script type="text/javascript" src="js/jquery.datepick-zh-TW.js"></script>
<script type="text/javascript" src="js/upload/swfobject.js"></script>
<script type="text/javascript" src="js/upload/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript" src="js/jquery-validate/jquery.validate.js"></script>
<script type="text/javascript" src="js/jquery-validate/jquery.metadata.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<script type="text/javascript">
$(document).ready(function(){
/*Class Column全選*/
	$("input[name='selectall']").click(function() {
		if( $(this).attr("checked") )
		{
			$("input[name^="+$(this).attr('selectname')+"]").each(function() {
				$(this).attr("checked", true);
			});
		}
		else
		{
			$("input[name^="+$(this).attr('selectname')+"]").each(function() {
				$(this).attr("checked", false);
			});           
		}
	});
	$('select[name^="datacategory"]').die() ;
});
</script>
	<form name="form" id="form" enctype="multipart/form-data">
		<table id="columnList">
<?
/*關聯分類下拉選單開始*/
//新增
if($set_catelog_control == 2 && $product_set_table[0] != null && $_GET['kind'] != "0" && $_GET['page_status'] == "add")
{
	$categoryColumn = strtoupper($product_set_para_en[0][0]) ;
?>
			<input type="hidden" id="categoryTable" name="categoryTable" value="<?=$product_set_table[0]?>">
			<input type="hidden" id="categoryTopic" name="categoryTopic" value="<?=$categoryColumn?>">
			<tr>
				<td class="columnTopic" valign="top">分類：</td>
				<td class="column" valign="top" id="datacategoryZone">
					<div id="datacategory1">
						<select name="datacategory1" nowlevel="1" title="請選擇分類" validate="required:true">
							<option value=""></option>
<?
$result = $db -> query("select * from ".$product_set_table[0]." where DELETE_ID =0 and CATE_INDEX =0") ;
while($record = $db -> getarray($result))
{
	echo "<option value=\"".$record['ITEM']."\">".$record[$categoryColumn]."</option>" ;
}
?>
						</select>
					</div>
				</td>
			</tr>
<?
}
//修改
if($set_catelog_control == 2 && $product_set_table[0] != null && $_GET['kind'] != "0" && $_GET['page_status'] == "modefy")
{
	$categoryColumn = strtoupper($product_set_para_en[0][0]) ;
?>
			<input type="hidden" id="categoryTable" name="categoryTable" value="<?=$product_set_table[0]?>">
			<input type="hidden" id="categoryTopic" name="categoryTopic" value="<?=$categoryColumn?>">
			<tr>
				<td class="columnTopic" valign="top">分類：</td>
				<td class="column" valign="top" id="datacategoryZone">
<?
	$categorySelectLevel  = 0 ;
	$record = $db -> getfirst("select * from ".$product_set_table[$_GET['kind']]." where DELETE_ID =0 and ITEM='".$_GET['item']."'") ;
	if($record['CATE_INDEX'] != '0')
	{//一開始就設定有分類
		$categoryList = explode("<br>" , $record['DOC_PATH']) ;
		foreach($categoryList as $key => $value)
		{
			if($value != null)
			{
				$categorySelectLevel++ ;
				if( (count($categoryList)-1) != $categorySelectLevel )
				{
					$categoryResult = $db -> query("select * from ".$product_set_table[0]." where DELETE_ID =0 and CATE_INDEX ='".$value."'") ;
				
?>
						<div id="datacategory<?=$categorySelectLevel?>">
							<select name="datacategory<?=$categorySelectLevel?>" nowlevel="<?=$categorySelectLevel?>" title="請選擇分類" validate="required:true">
<?
					while($categoryRecord = $db -> getarray($categoryResult))
					{
						if(in_array( $categoryRecord['ITEM'] , $categoryList ))
						{
							$selected = "selected" ;
						}
						else
						{
							$selected = "" ;
						}
						echo "<option value=\"".$categoryRecord['ITEM']."\" ".$selected.">".$categoryRecord[$categoryColumn]."</option>" ;
					}
					echo "</select></div>" ;
				}
			}
		}
	}
	else
	{//改成分類時
?>
					<div id="datacategory1">
						<select name="datacategory1" nowlevel="1" title="請選擇分類" validate="required:true">
							<option value=""></option>
<?
$result = $db -> query("select * from ".$product_set_table[0]." where DELETE_ID =0 and CATE_INDEX =0") ;
while($record = $db -> getarray($result))
{
	echo "<option value=\"".$record['ITEM']."\">".$record[$categoryColumn]."</option>" ;
}
?>
						</select>
					</div>
<?
	}
	echo "<td><tr>" ;
}
if( ($set_catelog_control == 2 && $product_set_table[0] != null && $_GET['kind'] != "0") && ($_GET['page_status'] == "modefy" || $_GET['page_status'] == "add") )
{
?>
<script type="text/javascript">	
$(document).ready(function(){
	$('select[name^="datacategory"]').live('change' ,function(){
		changeitem = $(this,"selected").val() ;
		categoryname = 'datacategory'+$(this).attr('nowlevel') ;
		if( $(this).attr('name') == categoryname )
		{
			$.post('./ajax/findcategory.php',{'table':$('#categoryTable').attr('value') , 'item':changeitem , 'nowlevel':$(this).attr('nowlevel') , 'topic':$('#categoryTopic').attr('value') , 'SelectCheck':'<?=$exceptionCategory?>' },function(response){
				if(response.check == "havecategory")
				{
					$('#datacategoryZone').append(response.select) ;
					$('#categoryLevel').attr('value',response.level) ;
<?
if($exceptionCategory == 'true')
{
?>
					$('#cate_index').attr('value' , changeitem) ;
<?
}
?>
				}
				else
				{
					$('#cate_index').attr('value' , changeitem) ;
				}
			},'json');
			$(this).parent().nextAll().remove() ;
		}
	});
}) ;
</script>
<?
}
//檢視
if($set_catelog_control == 2 && $product_set_table[0] != null && $_GET['kind'] != "0" && $_GET['page_status'] == "show")
{
	$categoryColumn = strtoupper($product_set_para_en[0][0]) ;
?>
			<tr>
				<td class="columnTopic" valign="top">分類：</td>
				<td class="column" valign="top" id="datacategoryZone">
<?
	$categorySelectLevel  = 0 ;
	$record = $db -> getfirst("select * from ".$product_set_table[$_GET['kind']]." where DELETE_ID =0 and ITEM='".$_GET['item']."'") ;
	$categoryList = explode("<br>" , $record['DOC_PATH']) ;
	foreach($categoryList as $key => $value)
	{
		if($value != null || $value != 0)
		{
			$categorySelectLevel++ ;
			$categoryRecord = $db -> getfirst("select * from ".$product_set_table[0]." where DELETE_ID =0 and ITEM ='".$value."'") ;
			echo "<div>".$categoryRecord[$categoryColumn]."</div>" ;
		}
	}
	echo "<td><tr>" ;
}
/*關聯分類下拉選單結束*/

$column = new column();
$record = $db -> getfirst("select * from ".$product_set_table[$_GET['kind']]." where DELETE_ID =0 and ITEM='".$_GET['item']."'") ;
foreach($product_set_para_ex[$_GET['kind']] as $key => $value)
{
	$changeColumn = strtoupper($product_set_para_en[$_GET['kind']][$key]) ;
?>
			<tr>
				<td class="columnTopic" valign="top"><?=$product_set_para_ch[$_GET['kind']][$key]?>：</td>
				<td class="column" valign="top">
<?
	if($_GET['page_status'] == "show")
	{
		if( $product_set_para_status[$_GET['kind']][$key] == 'manyfileinput' )
		{
			$showColumn = $column -> showColumn( $product_set_table[$_GET['kind']] , $product_set_para_en[$_GET['kind']][$key] , $product_set_para_ex[$_GET['kind']][$key] , $product_set_para_status[$_GET['kind']][$key] , $product_set_select_option[$_GET['kind']][$key] , $record[$changeColumn] , $record[$changeColumn.'INPUT'] ) ;
		}
		else
		{
			$showColumn = $column -> showColumn( $product_set_table[$_GET['kind']] , $product_set_para_en[$_GET['kind']][$key] , $product_set_para_ex[$_GET['kind']][$key] , $product_set_para_status[$_GET['kind']][$key] , $product_set_select_option[$_GET['kind']][$key] , $record[$changeColumn] , '' ) ;
		}
		
	}
	if($_GET['page_status'] == "add")
	{
		$inputColumn = $column -> inputColumn( $product_set_para_en[$_GET['kind']][$key] , $product_set_para_ex[$_GET['kind']][$key] , $product_set_para_status[$_GET['kind']][$key] , $product_set_select_option[$_GET['kind']][$key] , $product_set_direction[$_GET['kind']][$key] , $product_set_para_check[$_GET['kind']][$key] , $product_set_select_nums[$_GET['kind']][$key] , $product_set_default_value[$_GET['kind']][$key] ) ;
		//將欄位存成陣列
		echo "<input type=\"hidden\" name=\"inputString[]\" value=\"".$product_set_para_en[$_GET['kind']][$key]."\" />" ;
		echo "<input type=\"hidden\" name=\"columnstatus[]\" value=\"".$product_set_para_ex[$_GET['kind']][$key]."\" />" ;
		echo "<input type=\"hidden\" name=\"columnselect[]\" value=\"".$product_set_para_status[$_GET['kind']][$key]."\" />" ;
	}
	if($_GET['page_status'] == "modefy")
	{
		if( $product_set_para_status[$_GET['kind']][$key] == 'manyfileinput' )
		{
			$modefyColumn = $column -> modefyColumn( $product_set_table[$_GET['kind']] , $product_set_para_en[$_GET['kind']][$key] , $product_set_para_ex[$_GET['kind']][$key] , $product_set_para_status[$_GET['kind']][$key] , $product_set_select_option[$_GET['kind']][$key] , $record[$changeColumn] , $product_set_direction[$_GET['kind']][$key] , $product_set_para_check[$_GET['kind']][$key] , $product_set_select_nums[$_GET['kind']][$key] , $record[$changeColumn.'INPUT'] ) ;
		}
		else
		{
			$modefyColumn = $column -> modefyColumn( $product_set_table[$_GET['kind']] , $product_set_para_en[$_GET['kind']][$key] , $product_set_para_ex[$_GET['kind']][$key] , $product_set_para_status[$_GET['kind']][$key] , $product_set_select_option[$_GET['kind']][$key] , $record[$changeColumn] , $product_set_direction[$_GET['kind']][$key] , $product_set_para_check[$_GET['kind']][$key] , $product_set_select_nums[$_GET['kind']][$key] , '' ) ;
		}
		
		//將欄位存成陣列
		echo "<input type=\"hidden\" name=\"updateString[]\" value=\"".$product_set_para_en[$_GET['kind']][$key]."\" />" ;
		echo "<input type=\"hidden\" name=\"columnstatus[]\" value=\"".$product_set_para_ex[$_GET['kind']][$key]."\" />" ;
		echo "<input type=\"hidden\" name=\"columnselect[]\" value=\"".$product_set_para_status[$_GET['kind']][$key]."\" />" ;
		echo "<input type=\"hidden\" name=\"columnvalue[]\" value=\"".strip_tags(stripslashes($record[$changeColumn]))."\" />" ;
	}
?>
				</td>
			</tr>
<?
	if($product_set_para_ex[$_GET['kind']][$key] == 4 && $product_set_para_status[$_GET['kind']][$key] == "birth")
	{//生日
?>
<script type="text/javascript">
$(document).ready(function(){
	$('#<?=$product_set_para_en[$_GET['kind']][$key]?>').datepick({dateFormat: 'yy-mm-dd',yearRange:"-60:+0"}); 
});
</script>
<?
	}
	if($product_set_para_ex[$_GET['kind']][$key] == 4 && $product_set_para_status[$_GET['kind']][$key] == "date")
	{//萬年曆
?>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#<?=$product_set_para_en[$_GET['kind']][$key]?>').datepick({dateFormat: 'yy-mm-dd',yearRange:"-5:+5"}); 
	});
	</script>
<?
	}
	if($product_set_para_ex[$_GET['kind']][$key] == 4 && $product_set_para_status[$_GET['kind']][$key] == "detail")
	{//詳細日期
?>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#<?=$product_set_para_en[$_GET['kind']][$key]?>').datepick({dateFormat: 'yy-mm-dd',yearRange:"-5:+5"}); 
	});
	</script>
<?
	}
	if($product_set_para_ex[$_GET['kind']][$key] == 3 && $product_set_para_status[$_GET['kind']][$key] == "manyfile")
	{//多檔上傳
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#<?=$product_set_para_en[$_GET['kind']][$key]?>").uploadify({
		'uploader'       : 'js/upload/uploadify.swf',
		'script'         : 'js/upload/uploadify.php?lang=<?=$_SESSION['admin_database_session']?>',
		'cancelImg'      : 'js/upload/cancel.png',
		'folder'         : '../upload',
		'fileDesc'       : '請選擇圖檔文件（*.jpg, *.gif, *.png, *.jpeg, *.bmp）',
		'fileExt'        : '*.jpg;*.gif;*.png;*.jpeg;*.bmp;',
		'multi'          : true ,
		'auto'           : true ,
<?
if($product_set_select_nums[$_GET['kind']][$key] != null)
{
?>
		'queueSizeLimit' : <?=$product_set_select_nums[$_GET['kind']][$key]?> ,
<?
}
?>
		'onAllComplete'	: function(){
			$("#<?=$product_set_para_en[$_GET['kind']][$key]?>Zone").load('./ajax/ajaxAddFile.php?addfileRel=<?=$product_set_para_en[$_GET['kind']][$key]?>&page_status=<?=$_GET['page_status']?>&table=<?=$product_set_table[$_GET['kind']]?>&item=<?=$_GET['item']?>&columnen=<?=$product_set_para_en[$_GET['kind']][$key]?>') ;
		}
	});
});
</script>
<?
	}
	if($product_set_para_ex[$_GET['kind']][$key] == 3 && $product_set_para_status[$_GET['kind']][$key] == "manyfileinput")
	{//多檔上傳
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#<?=$product_set_para_en[$_GET['kind']][$key]?>").uploadify({
		'uploader'       : 'js/upload/uploadify.swf',
		'script'         : 'js/upload/uploadify.php',
		'cancelImg'      : 'js/upload/cancel.png',
		'folder'         : '../upload',
		'fileDesc'       : '請選擇圖檔文件（*.jpg, *.gif, *.png, *.jpeg, *.bmp）',
		'fileExt'        : '*.jpg;*.gif;*.png;*.jpeg;*.bmp;',
		'multi'          : true ,
		'auto'           : true ,
<?
if($product_set_select_nums[$_GET['kind']][$key] != null)
{
?>
		'queueSizeLimit' : <?=$product_set_select_nums[$_GET['kind']][$key]?> ,
<?
}
?>
		'onAllComplete'	: function(){
			$("#<?=$product_set_para_en[$_GET['kind']][$key]?>Zone").load('./ajax/ajaxAddFileInput.php?addfileRel=<?=$product_set_para_en[$_GET['kind']][$key]?>&page_status=<?=$_GET['page_status']?>&table=<?=$product_set_table[$_GET['kind']]?>&item=<?=$_GET['item']?>&columnen=<?=$product_set_para_en[$_GET['kind']][$key]?>') ;
		}
	});
});
</script>
<?
	}
}
if($_GET['page_status'] == "modefy" || $_GET['page_status'] == "add")
{
?>
			<tr>
				<td class="columnTopic" valign="top">&nbsp;</td>
				<td class="column" valign="top"><input type="image" src="images/submit.png" id="submitForm" /></td>
			</tr>
<?
	echo "<input type=\"hidden\" id=\"table\" name=\"table\" value=\"".$product_set_table[$_GET['kind']]."\">" ;
	echo "<input type=\"hidden\" id=\"control\" name=\"control\" value=\"".$_GET['control']."\" />" ;
	echo "<input type=\"hidden\" id=\"item\" name=\"item\" value=\"".$_GET['item']."\" />" ;
	echo "<input type=\"hidden\" id=\"cate_index\" name=\"cate_index\" value=\"".$_GET['cate_index']."\" />" ;
	echo "<input type=\"hidden\" id=\"kind\" name=\"kind\" value=\"".$_GET['kind']."\" />" ;
	echo "<input type=\"hidden\" id=\"p\" name=\"p\" value=\"".$_GET['p']."\" />" ;
	echo "<input type=\"hidden\" id=\"catelist\" name=\"catelist\" value=\"".$_GET['catelist']."\" />" ;
	
	echo "<input type=\"hidden\" id=\"s_column\" name=\"s_column\" value=\"".$_GET['s_column']."\" />" ;
	echo "<input type=\"hidden\" id=\"s_keyword\" name=\"s_keyword\" value=\"".$_GET['s_keyword']."\" />" ;
	echo "<input type=\"hidden\" id=\"s_keyword1\" name=\"s_keyword1\" value=\"".$_GET['s_keyword1']."\" />" ;
}
?>
		</table>
	</form>
<script type="text/javascript">
$(document).ready(function(){
	//LightBox
	$(".lightbox").lightbox({fitToScreen: true}); 
	$('#mainMenu').css('minHeight',$('#mainContent').height())  ;
}); 
</script>
<?
if($_GET['page_status']=="add")
{
	echo "<script type=\"text/javascript\" src=\"js/statusadd.js\"></script>" ;
}
if($_GET['page_status']=="modefy")
{
	echo "<script type=\"text/javascript\" src=\"js/statusmodefy.js\"></script>" ;
}
//此為選項3，訂單系統專用
if($set_catelog_control == 3 && ($_GET['page_status'] == "show" || $_GET['page_status'] == "modefy"))
{
	$y = 0 ;
	$width = intval(100 / (count($relativeColumn)+1)) ;
	echo "<ul>" ;
	echo "<li class=\"even\" style=\"width:80%;margin-left:9%;padding-left:1%;\">" ;
	foreach($relativeCh as $key_ch => $value_ch)
	{
		echo "<span style=\"float:left;width:".$width."%\">".$value_ch."</span>" ;
	}
	echo "</li>" ;
	$result = $db -> query("select * from order_list where DELETE_ID =0 and CATE_INDEX ='".$_GET['item']."'") ;
	while($record = $db -> getarray($result))
	{
		$y++ ;
		//$relative = $db -> getfirst("select * from ".$relativeTable." where ITEM ='".$record['PRODUCT']."'") ;
		if($y % 2 == 1)
		{
			echo "<li class=\"odd\" style=\"width:80%;margin-left:9%;padding-left:1%;\">" ;
		}
		else
		{
			echo "<li class=\"even\" style=\"width:80%;margin-left:9%;padding-left:1%;\">" ;
		}
		foreach($relativeColumn as $key => $value)
		{
			echo "<span style=\"float:left;width:".$width."%\">".$record[$value]."</span>" ;
		}
		echo "</li>" ;
	}
	echo "</ul>" ;
}
/*
if($set_catelog_control == 3 && $_GET['page_status'] == "show")
{
	$y = 0 ;
	$width = intval(100 / (count($relativeColumn)+1)) ;
	echo "<ul>" ;
	echo "<li class=\"even\" style=\"width:80%;margin-left:9%;padding-left:1%;\">" ;
	foreach($relativeCh as $key_ch => $value_ch)
	{
		echo "<span style=\"float:left;width:".$width."%\">".$value_ch."</span>" ;
	}
	echo "</li>" ;
	$result = $db -> query($sqlString) ;
	while($record = $db -> getarray($result))
	{
		$y++ ;
		$relative = $db -> getfirst("select * from ".$relativeTable." where ITEM ='".$record['PRODUCT']."'") ;
		if($y % 2 == 1)
		{
			echo "<li class=\"odd\" style=\"width:80%;margin-left:9%;padding-left:1%;\">" ;
		}
		else
		{
			echo "<li class=\"even\" style=\"width:80%;margin-left:9%;padding-left:1%;\">" ;
		}
		foreach($relativeColumn as $key => $value)
		{
			echo "<span style=\"float:left;width:".$width."%\">".$relative[$value]."</span>" ;
		}
		echo "<span style=\"float:left;\">".$record[strtoupper($product_set_para_en[1][1])]."</span>" ;
		echo "</li>" ;
	}
	echo "</ul>" ;
}
*/
//此為選項2，多表關聯
if($set_catelog_control == 2 && $_GET['page_status'] == "show" && $showAnotherTable == "true")
{
	$y = 0 ;
	$width = intval(100 / (count($relativeCh))) ;

	echo "<ul>" ;
	echo "<li class=\"even\" style=\"width:80%;margin-left:9%;padding-left:1%;\">" ;
	foreach($relativeCh as $key_ch => $value_ch)
	{
		echo "<span style=\"float:left;width:".$width."%\">".$value_ch."</span>" ;
	}
	echo "</li>" ;

	$result = $db -> query($mainString) ;
	while($record = $db -> getarray($result))
	{
		
		$y++ ;
		$relative = $db -> getfirst($secString." and ITEM ='".$record[$secCheckColumn]."'") ;
		if($y % 2 == 1)
		{
			echo "<li class=\"odd\" style=\"width:80%;margin-left:9%;padding-left:1%;\">" ;
		}
		else
		{
			echo "<li class=\"even\" style=\"width:80%;margin-left:9%;padding-left:1%;\">" ;
		}
		foreach($mainColumn as $key => $value)
		{
			echo "<span style=\"float:left;width:".$width."%\">".$relative[$value]."</span>" ;
		}
		foreach($secColumn as $key_in => $value_in)
		{
			echo "<span style=\"float:left;width:".$width."%\">".$record[$value_in]."</span>" ;
		}
		echo "</li>" ;
	}
	echo "</ul>" ;
}
if($member_epaper == "true")
{
?>
<script type="text/javascript">
$(document).ready(function(){
var options2 = {
	target: '#form',
	url: './module/epaper/epaper.php',
	type: 'POST',
	dataType: 'json'
	};
	$('#submitForm').click(function(){
		$('#form').ajaxSubmit(options2);
	}) ;
}) ;
</script>
<?
}
?>