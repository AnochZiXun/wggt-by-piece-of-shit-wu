<?include('../../config.php')?>
		<ul id="showAllZone">
<?
include('../config_top.php') ;
//選單
$system_group_user = $db -> getfirst("select * from sys_control as sys_control , sys_group as sys_group where sys_control.ITEM ='".$_SESSION['system_item']."' and sys_control.SELECT_GROUP = sys_group.ITEM") ;
$sys_left = explode(",",$system_group_user['GROUP_CONTROL']) ;
foreach($left_menu_title as $key => $value)
{
	echo "<li class=\"mainDescription\"><h2>".$value."</h2><ul>" ;
	foreach($left_menu_link[$key] as $key_in => $value_in)
	{
		$control = $left_menu_link[$key][$key_in] ;
		include('../config.php') ;
		foreach($sys_left as $key_sys => $value_sys)
		{
			$sys_left_check = explode(".",$value_sys) ;
			if($sys_left_check[0] == $control)
			{
				switch($set_catelog_control)
				{
					case 1 :
						if($sys_left_check[1] == 1)
						{
							echo "<li class=\"zoneIcon\"><table><tr><td align=\"center\" valign=\"middle\" width=\"110\" height=\"80\"><a rel=\"?control=".$control."&kind=1\"><img src=\"images/icon/i".sprintf("%03d", $left_menu_icon[$key][$key_in]).".jpg\" /></a></td></tr></table><a rel=\"?control=".$control."&kind=1\">".$product_set_name[1]."</a></li>" ;
						}
						break ;
					case 2 :
						if($sys_left_check[1] == 0)
						{
							echo "<li class=\"zoneIcon\"><table><tr><td align=\"center\" valign=\"middle\" width=\"110\" height=\"80\"><a rel=\"?control=".$control."&kind=0\"><img src=\"images/icon/i".sprintf("%03d", $left_menu_icon[$key][$key_in]).".jpg\" /></a></td></tr></table><a rel=\"?control=".$control."&kind=0\">".$product_set_name[0]."</a></li>" ;
						}
						if($sys_left_check[1] == 1)
						{
							echo "<li class=\"zoneIcon\"><table><tr><td align=\"center\" valign=\"middle\" width=\"110\" height=\"80\"><a rel=\"?control=".$control."&kind=1\"><img src=\"images/icon/i".sprintf("%03d", $left_menu_icon[$key][$key_in]).".jpg\" /></a></td></tr></table><a rel=\"?control=".$control."&kind=1\">".$product_set_name[1]."</a></li>" ;
						}
						break ;
					case 3 :
						if($sys_left_check[1] == 0)
						{
							echo "<li class=\"zoneIcon\"><table><tr><td align=\"center\" valign=\"middle\" width=\"110\" height=\"80\"><a rel=\"?control=".$control."&kind=0\"><img src=\"images/icon/i".sprintf("%03d", $left_menu_icon[$key][$key_in]).".jpg\" /></a></td></tr></table><a rel=\"?control=".$control."&kind=0\">".$product_set_name[0]."</a></li>" ;
						}
						break ;
					case 4 :
						if($sys_left_check[1] == 1)
						{
							echo "<li class=\"zonePathIcon\"><table><tr><td align=\"center\" valign=\"middle\" width=\"110\" height=\"80\"><a class=\"pathhref\" path=\"".$add_another_path."\"><img src=\"images/icon/i".sprintf("%03d", $left_menu_icon[$key][$key_in]).".jpg\" /></a></td></tr></table><a class=\"pathhref\" path=\"".$add_another_path."\">".$product_set_name[1]."</a></li>" ;
						}
				}
			}
		}
	}
	echo "</ul></li>" ;
}
?>
		</ul>
<script type="text/javascript">
$(document).ready(function(){
	$('.zoneIcon a').click(function(){
		$icona = $(this).attr('rel') ;
		$('#menuStart a').each(function(){
			if( $(this).attr('thishref') == $icona )
			{
				$(this).parent().parent().attr('style','display:block') ;
				$(this).parent().parent().parent().find('h2 > img').attr('src','images/n.gif') ;
			}
		}) ;
		var url = 'inside.php'+$(this).attr('rel');
		url = url.replace(/^.*#/, '');
		$.history.load(url);
		return false;
	});
//外掛
	$('.pathhref').click(function(){
		$path = $(this).attr('path') ;
		var url = $path;
		url = url.replace(/^.*#/, '');
		$.history.load(url);
		return false;
	}) ;

//右邊空的移除
	$('.mainDescription').each(function(){
		if( $('>ul' ,this).html() == '' || $('>ul' ,this).html() == null )
		{
			$(this).remove() ;
		}
	}) ;

	$nowContentClick = '?control=<?=$_GET['control']?>&kind=<?=$_GET['kind']?>' ;
	$('#menuStart a').each(function(){
		if( $(this).attr('thishref') == $nowContentClick )
		{
			$(this).css('color','#550088') ;
		}
		else
		{
			$(this).css('color','#4f8ad1') ;
		}
	}) ;
	$('#menuStart a').die() ;
	
	$('#mainMenu').css('minHeight',$('#mainContent').height())  ;
});	
</script>