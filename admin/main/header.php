	<div id="header">
		<div id="logo"><h1><a href="."><img src="images/logo.png" alt="" title="" /></a></h1></div>
		<div id="logout" <?=(count($lang_array) == 1)?"style=\"right:14px;\"":""?>>
			<div class="logoutzone">Hi <?=$_SESSION['system_id']?>.</div>
			<form name="logout" action="login.php" method="post">
				<input type="hidden" name="login" value="out" />
				<input type="image" src="images/logout.png" class="submit" />
			</form>
		</div>
<?
if(count($lang_array) != 1)
{
	switch($_SESSION['admin_database_session'])
	{//判斷是否為繁中語系
		case "_cn" :
			$please_select_language = "简體中文" ;
			break ;
		case "_en" :
			$please_select_language = "English" ;
			break ;
		case "_es" :
			$please_select_language = "Español" ;
			break ;
		case "_jp" :
			$please_select_language = "日本語" ;
			break ;
		default :
			$please_select_language = "繁體中文" ;
			break ;
	}
?>
		<div id="language">
			<form name="language" method="post" action="login.php">
				<div class="langzone">
					<span class="inputWord">Language：</span><input type="button" value="<?=$please_select_language?>" class="select" onclick="downToggle(this,'#selectBar')" onfocus="this.blur()" />
					<span id="selectBar"><?=$lang_string?></span>
				</div>
				<input type="hidden" name="language" value="" />
				<input type="hidden" name="login" value="change" />
				<input type="image" src="images/submit.png" class="submit" />
			</form>
		</div>
<?
}
$admin = $db -> getfirst("select * from sys_control where DELETE_ID =0 and ITEM ='".$_SESSION['system_item']."'") ;
$sys_group = $db -> getfirst("select * from sys_group where DELETE_ID =0 and ITEM ='".$admin['SELECT_GROUP']."'") ;
?>
		<div id="globalNav">
			<ul id="pagenav">
				<li>登入者：<?=$admin['ACCOUNT']?></li>
				<li>登入權限：<?=$sys_group['TOPIC']?></li>
				<li>登入時間：<?=$admin['LOGIN_TIME']?></li>
				<li>登入IP：<?=$admin['LOGIN_IP']?></li>
			</ul>
		</div>
	</div>