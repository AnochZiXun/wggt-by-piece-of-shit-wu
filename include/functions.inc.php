<?
/*
*  @author : wu
*  @description : 常用的function
*  @version : 1.0 2010/05/13

* 跳轉URL
* @param :
	$url 頁面名稱
	$msg 訊息
*/
function goURL($url='', $msg='')
{
	$url = ($url)?$url:$_SERVER['HTTP_REFERER'];
	$url = ($url)?$url:'/';
	$JSstr = '';
	if($msg)
	{
		$JSstr .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
		$JSstr .= "<script type=\"text/javascript\">alert('".$msg."');</script>\n";
	}
	$JSstr .= "<script type=\"text/javascript\">location.href='".$url."'</script>\n";
	$JSstr .= "<meta http-equiv=\"refresh\" content=\"1; url=".$url."\">";
	echo $JSstr;
	exit();
}



/* 發送信件
* @param :
	$to_mail    收件者位置
	$form_mail  發信者位置
	$mail_topic 信件主旨
	$content    信件內容
*/
function Sent_Email($to_mail,$from_mail,$mail_topic,$content)
{
	$headers = 'Content-type: text/html; charset=utf-8' . "\r\n";  
	$headers .= "From: ".$from_mail."\r\n"; // 請自行替換寄件地址   
	$charset = "utf-8";
	mail($to_mail, "=?UTF-8?B?".base64_encode($mail_topic)."?=", $content,  $headers);
}
/* Google發送信件
* @param :
	$to_mail    收件者位置
	$form_mail  發信者位置
	$mail_topic 信件主旨
	$content    信件內容
*/
function sendEmail($to_mail,$from_mail,$mail_topic,$content)
{
		require_once("./phpMailer/class.phpmailer.php"); //匯入PHPMailer類別
		$mail= new PHPMailer(); //建立新物件
		$mail->IsSMTP(); //設定使用SMTP方式寄信
		$mail->SMTPAuth = true; //設定SMTP需要驗證
		$mail->Host = "mail.cosmos-school.com.tw"; //Gamil的SMTP主機
		$mail->Port = 25;  //Gamil的SMTP主機的埠號(Gmail為465)。
		$mail->CharSet = "utf-8"; //郵件編碼
		$mail->Encoding = "base64";
		$mail->Username = "sendmail@cosmos-school.com.tw"; //寄信Gamil帳號
		$mail->Password = "~_p0QdEd*eJ}"; //寄信Gmail密碼
		$mail->From = $from_mail; //寄件者信箱，也可以與寄信的帳號一樣
		$mail->FromName = "寰宇外語"; //寄件者姓名
		$mail->Subject =$mail_topic;  //郵件標題
		$mail->Body = $content; //郵件內容，可以使用html格式
		$mail->IsHTML(true); //郵件內容為html ( true || false)
		$mail->AddAddress($to_mail,$mail_topic);
		
		if(!$mail->Send()){
			return true; 
		}
		else{
			return false;
		}
}


/* 切割字元
@param :
	$string  為原字串
	$length  為截取長度
*/
function cutstr($string, $length)
{
	preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $info);   
	$wordscut = '' ;
	$j=0 ;
	for($i=0; $i<count($info[0]); $i++) 
	{
		$wordscut .= $info[0][$i];
		$j = ord($info[0][$i]) > 127 ? $j + 2 : $j + 1;
		if ($j > $length - 3) 
		{
			return $wordscut."...";
		}
	}
	return join('', $info[0]);;
}

/*Email驗證*/
function ValidateEmailAddress($email) {
	return (preg_match("|^[-_.0-9a-z]+@([-_0-9a-z][-_0-9a-z]+\.)+[a-z]{2,3}$|i",$email));
}
function _get($str){
    $val = !empty($_GET[$str]) ? $_GET[$str] : null;
    return $val;
}

function uniDecode($str,$charcode)
{
	$text = preg_replace_callback("/%u[0-9A-Za-z]{4}/",toUtf8,$str);
	return mb_convert_encoding($text, $charcode, 'utf-8');
}
function toUtf8($ar)
{
	foreach($ar as $val)
	{
		$val = intval(substr($val,2),16);
		if($val < 0x7F)
		{// 0000-007F
			$c .= chr($val);
		}
		elseif($val < 0x800) 
		{// 0080-0800
			$c .= chr(0xC0 | ($val / 64));
			$c .= chr(0x80 | ($val % 64));
		}
		else
		{// 0800-FFFF
			$c .= chr(0xE0 | (($val / 64) / 64));
			$c .= chr(0x80 | (($val / 64) % 64));
			$c .= chr(0x80 | ($val % 64));
		}
	}
	return $c;
}
?>