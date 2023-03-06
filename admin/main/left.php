		<ul id="menuStart">
			<li><h2><font thishref="<?=$system_true_path?>" target="_blank" id="gopath"><img src="images/dc.gif" />前台首頁</font></h2></li>
			<li><h2><font thishref="." id="goindex" loginpage="login.php"><img src="images/dc.gif" />後台首頁</font></h2></li>
<?
$system_group_user = $db -> getfirst("select * from sys_control as sys_control , sys_group as sys_group where sys_control.ITEM ='".$_SESSION['system_item']."' and sys_control.SELECT_GROUP = sys_group.ITEM") ;
$sys_left = explode(",",$system_group_user['GROUP_CONTROL']) ;
foreach($left_menu_title as $key => $value)
{
	echo "<li class=\"left_main_zone\"><h2><img src=\"images/h.gif\" />".$value."</h2><ul>" ;
	foreach($left_menu_link[$key] as $key_in => $value_in)
	{
		$control = $left_menu_link[$key][$key_in] ;
		include('./config.php') ;
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
							echo "<li><a thishref=\"?control=".$control."&kind=1\"><img src=\"images/dc.gif\" />".$product_set_name[1]."</a></li>" ;
						}
						break ;
					case 2 :
						if($sys_left_check[1] == 0)
						{
							echo "<li><a thishref=\"?control=".$control."&kind=0\"><img src=\"images/dc.gif\" />".$product_set_name[0]."</a></li>" ;
						}
						if($sys_left_check[1] == 1)
						{
							echo "<li><a thishref=\"?control=".$control."&kind=1\"><img src=\"images/dc.gif\" />".$product_set_name[1]."</a></li>" ;
						}
						break ;
					case 3 :
						if($sys_left_check[1] == 0)
						{
							echo "<li><a thishref=\"?control=".$control."&kind=0\"><img src=\"images/dc.gif\" />".$product_set_name[0]."</a></li>" ;
						}
						break ;
					case 4 :
						if($sys_left_check[1] == 1)
						{
							echo "<li><a class=\"pathhref\" path=\"".$add_another_path."\"><img src=\"images/dc.gif\" />".$product_set_name[1]."</a></li>" ;
						}
						break ;
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
//選單展開縮起
	$('#menuStart h2').click(function(){
		if( $('> img' , this).attr('src') == 'images/h.gif'  )
		{
			$('> img' ,this).attr('src' , 'images/n.gif');
		}
		else
		{
			$('> img' ,this).attr('src' , 'images/h.gif');
		}
		$(this).next().toggle() ;
	}) ;
//滑鼠移到字時變色
	$('#menuStart a').hover(function(){
		if( $(this).css('color') == 'rgb(79, 138, 209)' || $(this).css('color') == '#4f8ad1' )
		{
			$(this).css('color','#ffffff') ;
		}
	},function(){
		if( $(this).css('color') == 'rgb(255, 255, 255)' || $(this).css('color') == '#ffffff' )
		{
			$(this).css('color','#4f8ad1') ;
		}
	}) ;

//左方選單點後，右方進入inside.php	
	$('#menuStart a').click(function(){
		var url = 'inside.php'+$(this).attr('thishref');
		url = url.replace(/^.*#/, '');
		$.history.load(url);
		return false;
	}) ;
	$('.pathhref').click(function(){
		$path = $(this).attr('path') ;
		var url = $path;
		url = url.replace(/^.*#/, '');
		$.history.load(url);
		return false;
	}) ;
}) ;
</script>