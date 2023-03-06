<?php
include('../../config.php') ;
$control = $_POST['control'] ;
include('../config.php') ;
	if($set_catelog_control==1){
		$excelOutTable = 1 ;
	}else{
		$excelOutTable = 0 ;
	}
$file = "../../upload/excel/".$product_set_table[$excelOutTable].".xls";
if(file_exists($file)){
	unlink($file);
}
//從這裡開始就是生成Excel檔的方法，首先必須引入Excel轉換的class檔案
require_once ('../../include/Classes/PHPExcel.php');
//新增PHPexcel物件
$objPHPExcel = new PHPExcel();
//作者(注意：以下一長串後面都沒分號結束)
$objPHPExcel->getProperties()->setCreator($system_true_path)
//上次修改者
->setLastModifiedBy($system_true_path)
//檔案標題
->setTitle($product_set_table[$excelOutTable])
//檔案標記
->setKeywords($product_set_table[$excelOutTable])
//檔案類別
->setCategory("Excel");
//欄位標記
$engarray = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
$columnNumsArray = -1 ;
$columnNums = 1 ;
foreach($product_set_para_ex[$excelOutTable] as $key => $value)
{
	if( $product_set_para_ex[$excelOutTable][$key] == 1 || $product_set_para_ex[$excelOutTable][$key] == 2 || $product_set_para_ex[$excelOutTable][$key] == 4 || $product_set_para_ex[$excelOutTable][$key] == 5 )
	{
		$columnNumsArray++ ;
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($engarray[$columnNumsArray].$columnNums , $product_set_para_ch[$excelOutTable][$key]) ;
	}
}

//資料列表
$columnNums = 1 ;
$result = $db -> query("select * from ".$product_set_table[$excelOutTable]." where DELETE_ID =0 order by SORT ASC") ;
while($record = $db -> getarray($result))
{
	$columnNumsArray = -1 ;
	$columnNums++ ;
	foreach($product_set_para_ex[$excelOutTable] as $key => $value)
	{
		
		$changeColumn = strtoupper($product_set_para_en[$excelOutTable][$key]) ;
		switch($product_set_para_ex[$excelOutTable][$key])
		{
			case 1 :
				$columnNumsArray++ ;
				$objPHPExcel->getActiveSheet(0)->setCellValueExplicit($engarray[$columnNumsArray].$columnNums, (string)$record[$changeColumn],PHPExcel_Cell_DataType::TYPE_STRING); 
				break ;
			case 2 :
				$columnNumsArray++ ;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($engarray[$columnNumsArray].$columnNums, strip_tags(stripslashes($record[$changeColumn]))) ;
				break ;
			case 4 :
				$columnNumsArray++ ;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($engarray[$columnNumsArray].$columnNums, $record[$changeColumn]) ;
				break ;
			case 5 :
				$columnNumsArray++ ;
				foreach($product_set_select_option[$excelOutTable][$key] as $key_option => $value_option){
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($engarray[$columnNumsArray].$columnNums, $product_set_select_option[$excelOutTable][$key][$record[$changeColumn]]) ;
					
				}
				break ;
		}
	}
}
for($colw=0;$colw<=$columnNumsArray;$colw++){
	//設定欄寬(自動欄寬)
	$objPHPExcel->getActiveSheet(0)->getColumnDimension($engarray[$colw])->setAutoSize(true);
	//$objPHPExcel->getActiveSheet(0)->getColumnDimension($engarray[$colw])->setWidth(200);
}
$objPHPExcel->setActiveSheetIndex(0);
require_once ('../../include/Classes/PHPExcel/Writer/Excel5.php');
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
$objWriter->save($file);
?>