<?php
require_once ("func_ip.php");
function EncodeIp($strDotquadIp) {
    $arrIpSep = explode('.', $strDotquadIp);
    if (count($arrIpSep) != 4) return 0;
    $intIp = 0;    
    foreach ($arrIpSep as $k => $v) $intIp += (int)$v * pow(256, 3 - $k);
    return $intIp;
}
function GetMicroTime() {
    list($msec, $sec) = explode(" ", microtime()); 
    return ((double)$msec + (double)$sec); 
}


function ip($ip)
{
	$intIp = EncodeIp($ip);
	$arrAddr = ip2addr($intIp);
	return $arrAddr["region"].$arrAddr["address"];
}


?>
