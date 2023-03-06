<?
$lang_string = "" ;
$lang_array = explode(",",$system_language) ;
for($i = 0 ; $i < count($lang_array) ; $i++)
{
	$this_lang = explode(":" , $lang_array[$i]) ;
	$lang_string .= "<a href=\"javascript:\" rel=\"".$this_lang[0]."\">".$this_lang[1]."</a>" ;
}
?>