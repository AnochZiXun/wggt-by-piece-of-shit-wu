<?
/************************************************************
使用說明:
    可以使用 $B_參數名稱 來取得已過濾後的參數值
	ex: index.php?apple=5&tgg=again
	在該頁的最前面使用
	include('b_loading/overloading.php') ;
	接下來的頁面就可以以
	$M_apple $M_tgg 來取得其值
	( 僅能防範簡單的sql injection )
	
特殊用法: 用來強力防範sql injection
    $overloading_param = "number,3" ; //限定所有的參數僅能為數值且不超過三位數 , 否則跳回首頁
    include('b_loading/overloading.php') ;

說明如下:
   格式為 "第一各參數種類,第一各參數長度,第二各參數種類,第二各參數長度,第三各參數種類,第三各參數長度...";
   若只設定一個參數 , 就代表之後的參數都是符合其規則
   
   種類有 : number => 代表為數值
            string => 代表為字串
   
   長度設定為0時 , 表示不測試長度   
************************************************************/
require(ROOT."/htmlpurifier/library/HTMLPurifier.auto.php");
$purifier = new HTMLPurifier();
foreach( $_POST as $key => $value )
{
	eval( '$M_' . $key . '= \'' . $purifier -> purify($value) . '\' ;' ) ;
}
?>