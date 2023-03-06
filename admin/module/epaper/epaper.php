<?
require('../../../config.php') ;

$topic = $_POST['topic'] ;
$htmlcontent = stripslashes($_POST['content']) ;

$sendcontent = str_replace("<img src=\"/","<img src=\"".$system_true_path."",$htmlcontent) ;

$content = <<<EOC
<div style="position:relative;float:left;width:800px;">
	<div style="float:left;width:800px;border-bottom:6px solid #ecbe76;">
		<div style="float:left;margin-top:20px;"><img src="{$system_true_path}images/logo.png" /></div>
		<p style="float:right;color:#ff0000;font-size:10px;margin-top:140px;">此信件透過系統發送，請勿直接回覆</p>
	</div>
	<div style="float:left;margin-top:10px;"><img src="{$system_true_path}images/epaper.jpg"></div>
	<table style="float:left;margin-top:10px;">
		<tr>
			<td width="800" style="font-size:16px;color:#f4a351;line-height:24px;">{$topic}</td>
		</tr>
		<tr>
			<td width="800" style="font-size:12px;color:#000000;line-height:18px;">{$sendcontent}</td>
		</tr>
	</table>
	<div style="float:left;width:800px;border-top:6px solid #ecbe76;margin-top:30px;">
		<p style="float:left;color:#c6c6c6;font-size:10px;width:200px;">Hair De Queen 美髮沙龍</p>
		<p style="float:left;color:#c6c6c6;font-size:10px;width:200px;">電話：06-22-00069</p>
		<p style="float:left;color:#c6c6c6;font-size:10px;width:400px;">地址：台南市西門路一段579號(京城銀行總行對面)</p>
		<p style="float:left;color:#e7e7e7;font-size:10px;width:100%;"><a href="{$system_true_path}" style="color:#c6c6c6;">{$system_true_path}</a></p>
	</div>
</div>
EOC;






/*
$content = "" ;
$content .= "標題：".$_POST['topic']."<br />" ;
$content .= "內容：".stripslashes($_POST['content'])."" ;
$content = str_replace("<img src=\"/","<img src=\"".$system_true_path."",$content) ;
*/





foreach($_POST['member'] as $key => $value)
{
	$member = $db -> getfirst( "select * from member where DELETE_ID =0 and ITEM ='".$value."'" ) ;
	$to_mail = $member['EMAIL'] ;
	$mail_topic = "電子報-".$_POST['topic'] ;
	$from_mail = "hairdequeen@hairdequeen.com.tw" ;
	Sent_Email($to_mail,$from_mail,$mail_topic,$content) ;
}

?>