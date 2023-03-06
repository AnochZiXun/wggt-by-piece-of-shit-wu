		<ul id="showAllZone">
<?
//選單
foreach($left_menu_title as $key => $value)
{
	echo "<li class=\"mainDescription\"><h2>".$value."</h2><ul>" ;
	foreach($left_menu_link[$key] as $key_in => $value_in)
	{
		$control = $left_menu_link[$key][$key_in] ;
		include('../config.php') ;
		switch($set_catelog_control)
		{
			case 1 :
				echo "<li class=\"zoneIcon\"><table><tr><td align=\"center\" valign=\"middle\" width=\"110\" height=\"80\"><a rel=\"?control=".$control."&kind=1\"><img src=\"images/icon/i".sprintf("%03d", $left_menu_icon[$key][$key_in]).".jpg\" /></a></td></tr></table><a rel=\"?control=".$control."&kind=1\">".$product_set_name[1]."</a></li>" ;
				break ;
			case 2 :
				echo "<li class=\"zoneIcon\"><table><tr><td align=\"center\" valign=\"middle\" width=\"110\" height=\"80\"><a rel=\"?control=".$control."&kind=0\"><img src=\"images/icon/i".sprintf("%03d", $left_menu_icon[$key][$key_in]).".jpg\" /></a></td></tr></table><a rel=\"?control=".$control."&kind=0\">".$product_set_name[0]."</a></li>" ;
				echo "<li class=\"zoneIcon\"><table><tr><td align=\"center\" valign=\"middle\" width=\"110\" height=\"80\"><a rel=\"?control=".$control."&kind=1\"><img src=\"images/icon/i".sprintf("%03d", $left_menu_icon[$key][$key_in]).".jpg\" /></a></td></tr></table><a rel=\"?control=".$control."&kind=1\">".$product_set_name[1]."</a></li>" ;
				break ;
			case 3 :
				echo "<li class=\"zoneIcon\"><table><tr><td align=\"center\" valign=\"middle\" width=\"110\" height=\"80\"><a rel=\"?control=".$control."&kind=1\"><img src=\"images/icon/i".sprintf("%03d", $left_menu_icon[$key][$key_in]).".jpg\" /></a></td></tr></table><a rel=\"?control=".$control."&kind=1\">".$product_set_name[1]."</a></li>" ;
				break ;
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
		$('#mainContent').load( 'inside.php'+$(this).attr('rel') ) ;
	});
});
</script>