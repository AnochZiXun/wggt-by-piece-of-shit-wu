<?
function checklange()
{
	session_register('login_language') ;
	session_register('se_now_lang') ;
	$ip      = $_SERVER['REMOTE_ADDR'];
	$user_ip = explode(".",$ip);
	
	if($_GET['set_lang'] != null)
	{
		if( strlen($_GET['set_lang']) > 2 || ($_GET['set_lang'] != $now_lang))
		{
			$_SESSION['se_now_lang'] = $_GET['set_lang'] ;
			header("LOCATION: .") ;
			exit ;
		}
	}
	else
	{
		/*-------大陸----------*/
		$chinacontents = file ('china.txt');
		while(list($line_num,$line)=each($chinacontents)) 
		{
			$data=explode(" ",htmlspecialchars($line));
			$ip_country=$data[1];
			$ip_zone=$data[2];
			/*Class B*/
			if($ip_zone>=65536)
			{
				$b=$ip_zone/65536;
				$ip_countryz=explode(".",$ip_country);
				for($i=0;$i<$b;$i++)
				{
					if(($user_ip[0]==$ip_countryz[0])&&($user_ip[1]==$ip_countryz[1]))
					{
						$_SESSION['login_language'] = "cn" ;
					}
					$ip_countryz[1]++;
				}
			}
			/*Class C*/
			if($ip_zone>=256 && $ip_zone<65536)
			{
				$c=$ip_zone/256;
				$ip_countryz=explode(".",$ip_country);
				for($i=0;$i<$c;$i++)
				{
					if(($user_ip[0]==$ip_countryz[0])&&($user_ip[1]==$ip_countryz[1])&&($user_ip[2]==$ip_countryz[2]))
					{
						$_SESSION['login_language'] = "cn" ;
					}
					$ip_countryz[2]++;
				}
			}
		}
		/*-------臺灣----------*/
		$fcontents = file ('taiwan.txt');
		while(list($line_num,$line)=each($fcontents))
		{
			$data=explode(" ",htmlspecialchars($line));
			$ip_country=$data[1];
			$ip_zone=$data[2];
			/*Class B*/
			if($ip_zone>=65536)
			{
				$b=$ip_zone/65536;
				$ip_countryz=explode(".",$ip_country);
				for($i=0;$i<$b;$i++)
				{
					if(($user_ip[0]==$ip_countryz[0])&&($user_ip[1]==$ip_countryz[1]))
					{
						$_SESSION['login_language'] = "ch" ;
					}
					$ip_countryz[1]++;
				}
			}
			/*Class C*/
			if($ip_zone>=256 && $ip_zone<65536)
			{
				$c=$ip_zone/256;
				$ip_countryz=explode(".",$ip_country);
				for($i=0;$i<$c;$i++)
				{
					if(($user_ip[0]==$ip_countryz[0])&&($user_ip[1]==$ip_countryz[1])&&($user_ip[2]==$ip_countryz[2]))
					{
						$_SESSION['login_language'] = "ch" ;

					}
					$ip_countryz[2]++;
				}
			}
		}
		if($_SESSION['se_now_lang'])
		{
			$now_lang = $_SESSION['se_now_lang'] ;
		}
		else
		{
			$now_lang = $_SESSION['login_language'] ;
		}
	}
}
?>