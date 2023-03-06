<?include('../config.php')?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PDI數位科技</title>
<?
for($i = 1 ; $i <= 30 ; $i++)
{
	$control = $i ;
	include("config.php") ;
	foreach($product_set_table as $key=>$value)
	{
		if( $value != null && $product_set_para_en[$key][0] != null)
		{

			echo "<br />資料表為".$value."<br />" ;
			if( $control == 1 )
			{
				$query = "CREATE TABLE ".strtolower($value)."( 
					ITEM INT(10) AUTO_INCREMENT   , 
					CATE_INDEX INT(10) NOT NULL    ,
					SET_TIME DATE NOT NULL         ,
					MODEFY_TIME DATETIME NOT NULL  ,
					DOC_PATH TEXT NOT NULL         ,
					DELETE_ID INT(1) NOT NULL      ,
					MEMBER_NUM INT(10) NOT NULL    ,
					SORT INT(10) NOT NULL          ,
					DOC_LEVEL INT(10) NOT NULL     ,
					LOGIN_IP TEXT NOT NULL         ,
					LOGIN_TIME TEXT NOT NULL       
					" ;
			}
			elseif( $control == 2)
			{
				$query = "CREATE TABLE ".strtolower($value)."( 
					ITEM INT(10) AUTO_INCREMENT   , 
					CATE_INDEX INT(10) NOT NULL    ,
					SET_TIME DATE NOT NULL         ,
					MODEFY_TIME DATETIME NOT NULL  ,
					DOC_PATH TEXT  NOT NULL        ,
					DELETE_ID INT(1) NOT NULL      ,
					MEMBER_NUM INT(10) NOT NULL    ,
					SORT INT(10) NOT NULL          ,
					DOC_LEVEL INT(10) NOT NULL     
					" ;
			}
			else
			{
				$query = "CREATE TABLE ".strtolower($value)."( 
					ITEM INT(10) AUTO_INCREMENT   , 
					CATE_INDEX INT(10) NOT NULL    ,
					SET_TIME DATE NOT NULL         ,
					MODEFY_TIME DATETIME NOT NULL  ,
					DOC_PATH TEXT NOT NULL         ,
					DELETE_ID INT(1) NOT NULL      ,
					MEMBER_NUM INT(10) NOT NULL    ,
					SORT INT(10) NOT NULL          ,
					DOC_LEVEL INT(10) NOT NULL     
					" ;
			}
			foreach( $product_set_para_en[$key] as $key_in => $value_in )
			{
				echo "欄位為-->".strtoupper($value_in)."=>種類為".$product_set_para_ex[$key][$key_in] ;
				$query .= ", `".strtoupper($value_in)."`" ;
				switch($product_set_para_ex[$key][$key_in])
				{
				case 1 :
					switch($product_set_para_status[$key][$key_in])
					{
					case "read" :
					case "readonly" :
					case "password" :
						$query .= " VARCHAR(200) NOT NULL COMMENT '".$product_set_para_ch[$key][$key_in]."'" ;
						break ;
					case "number" :
						$query .= " INT(10) NOT NULL COMMENT '".$product_set_para_ch[$key][$key_in]."'" ;
						break ;
					}
					break ;
				case 2 :
					$query .= " TEXT NOT NULL COMMENT '".$product_set_para_ch[$key][$key_in]."'" ;
					break ;
				case 3 :
					switch($product_set_para_status[$key][$key_in])
					{
					case "image" :
					case "file" :
					case "nochangeimg" :
					case "nochangefile" :
						$query .= " VARCHAR(100) NOT NULL COMMENT '".$product_set_para_ch[$key][$key_in]."'" ;
						break ;
					case "manyfile" :
						$query .= " TEXT NOT NULL COMMENT '".$product_set_para_ch[$key][$key_in]."'" ;
						break ;
					}
					break ;
				case 4 :
					switch($product_set_para_status[$key][$key_in])
					{
					case "birth" :
					case "date" :
						$query .= " DATE NOT NULL COMMENT '".$product_set_para_ch[$key][$key_in]."'" ;
						break ;
					case "detail" :
						$query .= " DATETIME NOT NULL COMMENT '".$product_set_para_ch[$key][$key_in]."'" ;
						break ;
					}
					break ;
				case 5 :
					$query .= " INT(10) default 1 COMMENT '".$product_set_para_ch[$key][$key_in]."'" ;
					break ;
				case 6 :
					$query .= " TEXT NOT NULL COMMENT '".$product_set_para_ch[$key][$key_in]."'" ;
					break ;
				case 7 :
					$query .= " INT(10) NOT NULL COMMENT '".$product_set_para_ch[$key][$key_in]."'" ;
					break ;
				}
				echo "<br>" ;
			}
			$query .= ",PRIMARY KEY (ITEM)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '".$product_set_name[$key]."';" ; 
			echo "<br>資料庫語法為==> ".$query."<br>" ;
			
			

			
			$SQL = $query ;
			$db -> query($SQL) ;
			//建立多檔上傳的資料表與系統帳號權限
			if($control == 2)
			{
				$query = "CREATE TABLE uploadfile (
						  ITEM INT(10) AUTO_INCREMENT,
						  FILENAME VARCHAR(100) NOT NULL ,
						  TOPIC VARCHAR(200) NOT NULL ,
						  SORT INT(10) ,
						  MEMBER_NUM INT(10) ,
						  PRIMARY KEY (ITEM)) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;" ;


				$SQL = $query;
				$db -> query($SQL) ;

				$db -> insert("insert into sys_control(CATE_INDEX , SET_TIME , MODEFY_TIME , DOC_PATH , DELETE_ID , MEMBER_NUM , SORT , DOC_LEVEL , SELECT_GROUP , ACCOUNT , PASSWORD)values( 0 , now() , now() , '0<br>' , 0 , 1 , 1 , 1 , 1 , 'root' , 'root' )") ;
				$db -> insert("insert into sys_group(CATE_INDEX , SET_TIME , MODEFY_TIME , DOC_PATH , DELETE_ID , MEMBER_NUM , SORT , DOC_LEVEL , TOPIC , GROUP_CONTROL)values( 0 , now() , now() , '0<br>' , 0 , 1 , 1 , 1 , '系統管理員' , '1.1,2.1' )") ;
			}
		}
	}
	$product_set_para_en = null ;
	$product_set_para_ex = null ;
	$product_set_para_ch = null ;
	$product_set_para_status = null ;
}
?>