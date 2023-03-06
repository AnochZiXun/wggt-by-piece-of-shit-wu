<?
$_GET['kind'] = 0 ;
			include('./adminclass/page.class.php') ;
			//每頁顯示的條數   
			$page_size = $page_max_limit ;  
			//每次顯示的頁數   
			$sub_pages = 5 ;   
			//總筆數  
			$rows = 0 ;
			//得到當前是第幾頁    
			if(!$_GET['p']) $_GET["p"] = 1;
			$pageCurrent=$_GET["p"];
			//資料移動筆數
			$move=$page_size * ($_GET['p'] - 1);
			//計算資料筆數
			if($system_admin_authority_zone == "true")
			{//區塊權限，只看比自己權限低的
				$result = $db -> query("select * from sys_group where SORT >= '".$_SESSION['system_status']."'") ;
				while($record = $db -> getarray($result))
				{
					$auto_column_option[] = $record['ITEM'] ;
				}
				$auth = 0 ;
				$add_auth_column = "(" ;
				foreach($auto_column_option as $key_auth => $value_auth)
				{
					$auth++ ;
					if($auth != 1)
					{
						$add_auth_column .= " or " ;
					}
					$add_auth_column .= "SELECT_GROUP = ".$value_auth."" ;
				}
				$add_auth_column .= ")" ;
				$authString =  "and ".$add_auth_column."" ;
			}
			elseif($system_admin_authority == "true")
			{//區塊權限，只看自己權限的資料
				$authString =  "and MEMBER_NUM ='".$_SESSION['system_item']."'" ;
			}
			else
			{//無設定
				$authString =  "" ;
			}
			
			if($_GET['s_column'] && $_GET['s_keyword'] && $_GET['s_keyword1'])
			{//搜尋
				if($_GET['s_keyword1'] == 'undefined')
				{
					$s_keyword = uniDecode($_GET['s_keyword'],'utf-8');
					$searchString = "and ".$_GET['s_column']." like '%".$s_keyword."%'" ;
				}
				else
				{
					$s_keyword = uniDecode($_GET['s_keyword'],'utf-8');
					$s_keyword1 = uniDecode($_GET['s_keyword1'],'utf-8');
					$searchString = "and ".$_GET['s_column']." between '".$s_keyword."' and '".$s_keyword1."'" ;
				}
			}
			if($_GET['catelist'])
			{
				$catelist = "and DOC_PATH like '%".$_GET['catelist']."%'" ;
			}
//計算筆數
			$rows = $db -> getcount("select * from ".$product_set_table[$_GET['kind']]." where DELETE_ID =0 ".$authString." ".$searchString." ".$catelist."") ;
			//新增完資料的頁碼
			if($rows < $page_max_limit)
			{
				$addPage = 1 ;
			}
			elseif($rows / $page_max_limit != 0 && $rows < $page_max_limit)
			{
				$addPage = intval($rows / $page_max_limit) +1 ;
			}
			if($rows != 0)
			{
?>
		<div id="controlMenu">
			<span class="selectall">
<?
if($delete[$_GET['kind']] != "false")
{
?>
				<input type="checkbox" name="selectall" id="selectall" /><p class="word">全選</p>
<?
}
?>
			</span>
<?
//分類搜尋
if($set_catelog_control == 2)
{
?>
			<ul id="cateSearch">
				<li>分類：</li>
<?
	$categoryColumn = strtoupper($product_set_para_en[0][0]) ;
?>
				<li id="datacategoryZone">
					<input type="hidden" id="categoryTable" name="categoryTable" value="<?=$product_set_table[0]?>">
					<input type="hidden" id="categoryTopic" name="categoryTopic" value="<?=$categoryColumn?>">

<?
	if($_GET['catelist'])
	{
		$categorySelectLevel  = 0 ;
		$selarray = explode("<br>",$_GET['catelist']) ;
		foreach($selarray as $key_sel => $value_sel)
		{
			if($value_sel != null)
			{
				$categorySelectLevel++ ;
				$cateRes = $db -> query("select * from ".$product_set_table[0]." where DELETE_ID =0 and CATE_INDEX ='".$value_sel."'") ;
				$cateRows = $db -> getcount("select * from ".$product_set_table[0]." where DELETE_ID =0 and CATE_INDEX ='".$value_sel."'") ;
				if($cateRows > 0)
				{
?>
							<span id="datacategory<?=$categorySelectLevel?>">
								<select name="datacategory<?=$categorySelectLevel?>" nowlevel="<?=$categorySelectLevel?>"><option value="">--全顯示--</option>
<?
					while($cateRec = $db -> getarray($cateRes))
					{
						if(in_array($cateRec['ITEM'] , $selarray))
						{
							echo "<option value=\"".$cateRec['ITEM']."\" selected>".$cateRec[$categoryColumn]."</option>" ;
						}
						else
						{
							echo "<option value=\"".$cateRec['ITEM']."\">".$cateRec[$categoryColumn]."</option>" ;
						}
					}
					echo "</select></span>" ;
				}
			}
		}
	}
	else
	{
?>
					<span id="datacategory1">
						<select name="datacategory1" nowlevel="1">
						<option value="">--全顯示--</option>
<?
		$categoryRes = $db -> query("select * from ".$product_set_table[0]." where DELETE_ID =0 and CATE_INDEX =0") ;
		while($cateRec = $db -> getarray($categoryRes))
		{
			echo "<option value=\"".$cateRec['ITEM']."\">".$cateRec[$categoryColumn]."</option>" ;
		}
	}

?>

						</select>
					</span>
				</li>
			</ul>
<?
}
//搜尋
if($search[$_GET['kind']] != "false" && $add[$_GET['kind']] != "false")
{
$optionValue = "<option value=\"\">--全顯示--</option>" ;
foreach($product_set_para_ex[$_GET['kind']] as $key => $value)
{
	$s_column = strtoupper($product_set_para_en[$_GET['kind']][$key]) ;
	if($product_set_para_ex[$_GET['kind']][$key] == 1 || $product_set_para_ex[$_GET['kind']][$key] == 2 || $product_set_para_ex[$_GET['kind']][$key] == 4 || $product_set_para_ex[$_GET['kind']][$key] == 5 || $product_set_para_ex[$_GET['kind']][$key] == 7 )
	{
		if( $product_set_para_status[$_GET['kind']][$key] == 'option' && ( $product_set_para_ex[$_GET['kind']][$key] == 5 || $product_set_para_ex[$_GET['kind']][$key] == 7 ) )
		{
			$thisOpValue = "" ;
			foreach( $product_set_select_option[$_GET['kind']][$key] as $key_option => $value_option )
			{
				$thisOpValue .= ":foption value=!!".$key_option."!!:l".$value_option.":f/option:l" ;
			}
		}
		if($product_set_para_status[$_GET['kind']][$key] != 'google' || $product_set_para_status[$_GET['kind']][$key] != 'related')
		{
			$optionValue .= "<option value=\"".$s_column."\" thisOpstatus=\"".$product_set_para_status[$_GET['kind']][$key]."\" thisOpValue=\"".$thisOpValue."\">".$product_set_para_ch[$_GET['kind']][$key]."</option>" ;
		}
	}
}
?>
		<ul id="search">
			<li><img src="./images/send.jpg" id="searchForm" style="cursor:pointer;" /></li>
			<li id="searchColumnSelect"></li>
			<li><select name="s_column"><?=$optionValue?></select></li>
<?
	echo "<input type=\"hidden\" id=\"table\" name=\"table\" value=\"".$product_set_table[$_GET['kind']]."\">" ;
	echo "<input type=\"hidden\" id=\"control\" name=\"control\" value=\"".$_GET['control']."\" />" ;
	echo "<input type=\"hidden\" id=\"kind\" name=\"kind\" value=\"".$_GET['kind']."\" />" ;
?>
		</ul>

<?
}
?>
			<div id="methodMenu">
<?
if( $excel[$_GET['kind']] != "false" )
{
?>
				<img src="images/excel.gif" style="cursor:pointer;" id="excelIcon" thisControl="<?=$_GET['control']?>" thisTable="<?=$product_set_table[$_GET['kind']]?>" />
<?
}
if( $add[$_GET['kind']] != "false" )
{
?>
				<img src="images/add.gif" style="cursor:pointer;" id="addIcon" thishref="?control=<?=$_GET['control']?>&kind=<?=$_GET['kind']?>&page_status=add&p=<?=$addPage?>" />
<?
}
if( $sortall[$_GET['kind']] != "false" )
{
?>
				<img src="images/sort.gif" style="cursor:pointer;" id="sortIcon" thishref="?control=<?=$_GET['control']?>&kind=<?=$_GET['kind']?>" />
<?
}
if( $delete[$_GET['kind']] != "false" )
{
?>
				<img src="images/del.gif" style="cursor:pointer;" id="delIcon" />
<?
}
?>
			</div>
		</div>
		<ul id="dataList">
<?
if($changePrintColumn == "true")
{//開啟多欄位時，顯示標題
?>
			<li id="listTopic">
				<span class="tc1">
<?
	if($delete[$_GET['kind']] != "false")
	{
		echo "&nbsp;" ;
	}
?>
				</span>
				<span class="tc2">
<?
	if($modefy[$_GET['kind']] != "false")
	{
		echo "&nbsp;" ;
	}
?>
				</span>
				<span class="tc3">
<?
	if($sort[$_GET['kind']] != "false")
	{
		echo "&nbsp;" ;
	}
?>
				</span>
				<span class="topicShowZone">
<?
	for($sum = 0 ; $sum < $columnTotal ; $sum++)
	{
		echo "<font style=\"float:left;width:".$columnWeight[$sum]."\">".$product_set_para_ch[$_GET['kind']][$columnPName[$sum]]."</font>" ;
	}
?>
				</span>
				<span class="tc4" <?=$menuZoneStyle?>>
<?
	if($delete[$_GET['kind']] != "false")
	{
		echo "&nbsp;" ;
	}
?>
				</span>
			</li>
<?
}
/*-------------------
開始輸出資料
---------------------*/
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
			$result = $db -> query("select * from ".$product_set_table[$_GET['kind']]." where DELETE_ID =0 ".$authString." ".$searchString." ".$catelist." order by SORT ".$dataSort." limit ".$move.",".$page_size."") ;
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
				<span class="checkbox">
<?
				if($delete[$_GET['kind']] != "false")
				{
?>
					<input type="checkbox" name="checkitem[]" value="<?=$record['ITEM']?>" />
<?
				}
?>
				</span>

				<span class="img">
<?
				if($modefy[$_GET['kind']] != "false")
				{
?>
					<img src="images/modefy.gif" class="modefyMenu" thishref="?control=<?=$_GET['control']?>&item=<?=$record['ITEM']?>&kind=<?=$_GET['kind']?>&page_status=modefy&p=<?=$_GET['p']?>" style="cursor:pointer;" />
<?
				}
?>
				</span>
<?
				if($sort[$_GET['kind']] != "false")
				{
					//排序按鈕
					if($dataSort == "ASC")
					{
						$sortup = "sortup" ;
						$sortdown = "sortdown" ;
					}
					else if($dataSort == "DESC")
					{
						$sortup = "sortdown" ;
						$sortdown = "sortup" ;
					}
?>
				<span class="sort"><img src="images/up.gif" class="<?=$sortup?>" nowitem="<?=$record['ITEM']?>" thistable="<?=$product_set_table[$_GET['kind']]?>" nowpage="<?=$_GET['p']?>" thiskind="0" thiscontrol="<?=$_GET['control']?>" style="cursor:pointer;" /></span>
				<span class="sort"><img src="images/down.gif" class="<?=$sortdown?>" nowitem="<?=$record['ITEM']?>" thistable="<?=$product_set_table[$_GET['kind']]?>" nowpage="<?=$_GET['p']?>" thiskind="0" thiscontrol="<?=$_GET['control']?>" style="cursor:pointer;" /></span>
<?
				}
?>
				<span class="columnShow">
<?
//多顯示欄位
				if($changePrintColumn == "true")
				{
					for($sum = 0 ; $sum < $columnTotal ; $sum++)
					{
						if($sum == '0')
						{
							echo "<a thishref=\"?control=".$_GET['control']."&item=".$record['ITEM']."&kind=".$_GET['kind']."&page_status=show\" class=\"linkshow\" style=\"cursor:pointer;\">" ;
						}
						echo "<p style=\"width:".$columnWeight[$sum].";\">" ;
						if($columnPName[$sum] == "relative")
						{
							echo "<font>".$columnPUrl[$sum].$record['ITEM']."</font>" ;
						}
						if($product_set_para_ex[$_GET['kind']][$columnPName[$sum]] == 1 || $product_set_para_ex[$_GET['kind']][$columnPName[$sum]] == 4)
						{
							if($set_catelog_control == 2 && $sum == '0')
							{
								$category = $db -> getfirst("select * from ".$product_set_table[0]." where DELETE_ID =0 and ITEM ='".$record['CATE_INDEX']."'") ;
								echo "<font>".$category[strtoupper($product_set_para_en[0][0])]."&nbsp;>&nbsp;".$record[strtoupper($product_set_para_en[$_GET['kind']][$columnPName[$sum]])]."</font>" ;
							}
							else
							{
								echo "<font>".$record[strtoupper($product_set_para_en[$_GET['kind']][$columnPName[$sum]])]."</font>" ;
							}
						}
						if($product_set_para_ex[$_GET['kind']][$columnPName[$sum]] == 3)
						{
							switch($product_set_para_status[$_GET['kind']][$columnPName[$sum]])
							{
								case "image" :
								case "nochangeimg" :
									echo "<a href=\"../upload/".$record[strtoupper($product_set_para_en[$_GET['kind']][$columnPName[$sum]])]."\" class=\"lightbox\"><img src=\"../upload/".$record[strtoupper($product_set_para_en[$_GET['kind']][$columnPName[$sum]])]."\" height=\"28\" /></a>" ;
									break ;
								case "file" :
								case "nochangefile" :
									echo "<font><a href=\"../upload/".$record[strtoupper($product_set_para_en[$_GET['kind']][$columnPName[$sum]])]."\">".$record[strtoupper($product_set_para_en[$_GET['kind']][$columnPName[$sum]])]."</a></font>" ;
									break ;
							}
						}
						if($product_set_para_ex[$_GET['kind']][$columnPName[$sum]] == 5)
						{
							switch($product_set_para_status[$_GET['kind']][$columnPName[$sum]])
							{
								case "option" :
									echo "<select name=\"".$product_set_para_en[$_GET['kind']][$columnPName[$sum]]."\" thistable=\"".$product_set_table[$_GET['kind']]."\" thisitem=\"".$record['ITEM']."\" >" ;
									foreach($product_set_select_option[$_GET['kind']][$columnPName[$sum]] as $key => $value)
									{
										if($record[strtoupper($product_set_para_en[$_GET['kind']][$columnPName[$sum]])] == $key)
										{
											$focus = "selected" ;
										}
										else
										{
											$focus = "" ;
										}
										if($system_admin_authority_zone == "true")
										{//區塊權限，只看比自己權限低的
											if(in_array($key ,$auto_column_option))
											{
												echo "<option value=\"".$key."\" ".$focus.">".$value."</option>" ;
											}
										}
										else
										{//無設定
											echo "<option value=\"".$key."\" ".$focus.">".$value."</option>" ;
										}
									}
									echo "</select>" ;
									break ;
							}
						}
						if($product_set_para_ex[$_GET['kind']][$columnPName[$sum]] == 7)
						{
							switch($product_set_para_status[$_GET['kind']][$columnPName[$sum]])
							{
								case "option" :
									foreach($product_set_select_option[$_GET['kind']][$columnPName[$sum]] as $key => $value)
									{
										if($record[strtoupper($product_set_para_en[$_GET['kind']][$columnPName[$sum]])] == $key)
										{
											$focus = "checked" ;
										}
										else
										{
											$focus = "" ;
										}
										if($system_admin_authority_zone == "true")
										{//區塊權限，只看比自己權限低的
											if(in_array($key ,$auto_column_option))
											{
												echo "<input type=\"radio\" name=\"".$product_set_para_en[$_GET['kind']][$columnPName[$sum]]."\" value=\"".$key."\" ".$focus." /><font>".$value."</font>" ;
											}
										}
										else
										{//無設定
											echo "<input type=\"radio\" name=\"".$product_set_para_en[$_GET['kind']][$columnPName[$sum]]."\" value=\"".$key."\" ".$focus." /><font>".$value."</font>" ;
										}
									}
									break ;
							}
						}
						if($sum == "0")
						{
							echo "</a>" ;
						}
						echo "</p>" ;
					}
				}
				else
				{
					if($set_catelog_control == 1)
					{
?>
						<p style="width:100%;"><a thishref="?control=<?=$_GET['control']?>&item=<?=$record['ITEM']?>&kind=<?=$_GET['kind']?>&page_status=show" class="linkshow" style="cursor:pointer;"><font><?=$record[strtoupper($product_set_para_en[$_GET['kind']][0])]?></font></a></p>
<?
					}
					if($set_catelog_control == 2)
					{
						$category = $db -> getfirst("select * from ".$product_set_table[0]." where DELETE_ID =0 and ITEM ='".$record['CATE_INDEX']."'") ;
?>
						<p style="width:100%;"><a thishref="?control=<?=$_GET['control']?>&item=<?=$record['ITEM']?>&kind=<?=$_GET['kind']?>&page_status=show" class="linkshow" style="cursor:pointer;"><font><?=$category[strtoupper($product_set_para_en[0][0])]?>&nbsp;>&nbsp;<?=$record[strtoupper($product_set_para_en[$_GET['kind']][0])]?></font></a></p>
<?
					}
				}
?>
				</span>
<?
if($sort[$_GET['kind']] == "false")
{
	$menuZoneStyle = "style=\"width:23%;\"" ;
}
?>
				<span class="menuZone" <?=$menuZoneStyle?>>
<?
if($delete[$_GET['kind']] != "false")
{
?>
					<img src="images/del.gif" class="deleteMenu" thisitem="<?=$record['ITEM']?>" thistable="<?=$product_set_table[$_GET['kind']]?>" thiscontrol="<?=$_GET['control']?>" style="cursor:pointer;" />
<?
}
?>
				</span>
				
			</li>
<?
			}
				echo "<input type=\"hidden\" name=\"delpage\" value=\"".$_GET['p']."\" />" ;
				echo "<input type=\"hidden\" name=\"thisPageNums\" value=\"".$i."\" />" ;
				if($i != $page_max_limit || (intval($rows / $page_max_limit)+1) == $_GET['p'] )
				{
					$sortPage = "no" ;
				}
				elseif($i == $page_max_limit || (intval($rows / $page_max_limit)+1) != $_GET['p'])
				{
					$sortPage = "yes" ;
				}
				echo "<input type=\"hidden\" name=\"checkNumsPage\" value=\"".$sortPage."\">" ;
				echo "</ul><ul id=\"page\">" ;
				if($rows > $page_size)
				{
					$subPages=new SubPages($page_size,$rows,$pageCurrent,$sub_pages,"inside.php?control=".$control."&kind=".$_GET['kind']."&s_column=".$_GET['s_column']."&s_keyword=".$_GET['s_keyword']."&s_keyword1=".$_GET['s_keyword1']."&catelist=".$_GET['catelist']."&p=",2) ;
				}
				echo "</ul>" ;
			}
			else
			{
				if($_GET['s_column'] && $_GET['s_keyword'] && $_GET['s_keyword1'])
				{
					echo "<div style=\"float:left;margin-left:7px;margin-top:10px;line-height:20px;\">查無資料，請重新輸入搜尋範圍</div>" ;
				}
				else if($_GET['catelist'])
				{
					echo "<div style=\"float:left;margin-left:7px;margin-top:10px;line-height:20px;\">此分類無任何資料，請重新選擇分類</div>" ;
				}
				else
				{
					echo "<div style=\"float:left;margin-left:7px;margin-top:10px;line-height:20px;\">此區域目前無資料，請按此按鈕新增<br /><img src=\"images/add.gif\" style=\"cursor:pointer;\" id=\"addIcon\" thishref=\"?control=".$_GET['control']."&kind=".$_GET['kind']."&page_status=add\" /></div>" ;
				}
			}
	echo "<link href=\"js/lightbox.css\" rel=\"stylesheet\" type=\"text/css\" />" ;
	echo "<script type=\"text/javascript\" src=\"js/jquery.lightbox.js\"></script>" ;
	echo "<script type=\"text/javascript\" src=\"js/literaldata.js\"></script>" ;
?>
<script type="text/javascript">
$(document).ready(function(){
	$('#mainMenu').css('minHeight',$('#mainContent').height())  ;
}) ;
</script>