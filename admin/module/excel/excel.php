<?
require_once 'reader.php';
include('../../../config.php') ;
$data = new Spreadsheet_Excel_Reader();
// Set output Encoding.
$data->setOutputEncoding('utf-8');
//繁體的話可以修改為CP950、簡體是CP936、日文是CP932，可參考codepage說明。
//要放入mysql的EXCEL位置
$data->read("upfile/".$_GET['filename'].".xls");
error_reporting(E_ALL ^ E_NOTICE);

$db -> del("delete from ".$_GET['tablename']."") ;


function excelTime($days, $time=false)
{
	if(is_numeric($days))
	{
		$jd = GregorianToJD(1, 2, 1974);
		$gregorian = JDToGregorian($jd+intval($days)-25569);
		$myDate = explode('/',$gregorian);
		//$myDateStr = str_pad($myDate[2],4,'0', STR_PAD_LEFT)."-".str_pad($myDate[0],2,'0', STR_PAD_LEFT)."-".str_pad($myDate[1],2,'0', STR_PAD_LEFT).($time?" 00:00:00":'');
		$myDateStr = str_pad($myDate[2],4,'0', STR_PAD_LEFT)."-".str_pad($myDate[0],2,'0', STR_PAD_LEFT)."-".str_pad($myDate[1],2,'0', STR_PAD_LEFT);
		return $myDateStr;
	}
	return $days;
}

//$now_date = date("Y-m-d");
//$now_date_long = date("Y-m-d H:i:s");
//寫入product_topic
for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) 
{
	//以下是用for循環印出excel的數據
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) 
	{

	}
	if( $data->sheets[0]['cells'][$i][1] != null && $data->sheets[0]['cells'][$i][2] != null && $data->sheets[0]['cells'][$i][3] != null  )
	{
		$db -> insert("Insert into ".$_GET['tablename']."( TOPIC_CH , TOPIC_EN , START_DATE , START_TIME , EPS , EPISODE_TITLE , SYNOPSIS , CLASSIFICATION , PROGRAMME_GENREL , PROGRAMME_SUB_GENREL , SET_TIME , MODEFY_TIME , CATE_INDEX , DOC_PATH , DELETE_ID , MEMBER_NUM )values( '".addslashes($data->sheets[0]['cells'][$i][3])."' , '".addslashes($data->sheets[0]['cells'][$i][4])."' , '".excelTime($data->sheets[0]['cells'][$i][1])."' , '".$data->sheets[0]['cells'][$i][2]."' , '".addslashes($data->sheets[0]['cells'][$i][5])."' , '".addslashes($data->sheets[0]['cells'][$i][6])."' , '".addslashes($data->sheets[0]['cells'][$i][7])."' , '".addslashes($data->sheets[0]['cells'][$i][8])."' , '".addslashes($data->sheets[0]['cells'][$i][9])."' , '".addslashes($data->sheets[0]['cells'][$i][10])."' , now() , now() , 0 , '0<br>' , 0 , 1 )") ;
		$insert_id = $db ->getid() ;
		$db -> update("update ".$_GET['tablename']." set SORT ='".$insert_id."' where ITEM ='".$insert_id."'") ;
	}

}
$file = "./upfile/universal.xls";
if(file_exists($file))
{
	unlink($file) ;
}
?>
<script type="text/javascript">
window.opener.location.reload();
window.close();
</script>
