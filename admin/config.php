<?
/*--------------------------------------------------------------------------------    
一般程式組態檔
---------------------------------------------------------------------------------*/ 
if($control == 1){

	//初始設定 此為設定目錄顯示狀態 
	$set_catelog_control = 1 ;
	//分頁數量設定
	$page_max_limit = 20 ;
	//開啟多顯示欄位
	$changePrintColumn = "true" ;
	//顯示四個欄位
	$columnTotal = 2 ;
	//這四個欄位分別的寬度
	$columnWeight[] = "50%" ;
	$columnWeight[] = "50%" ;
	//顯示陣列第0.1.6.14項欄位
	$columnPName[] = "0" ;
	$columnPName[] = "2" ;
	
	$system_admin_authority_zone = "true" ;

	$product_set_name[0] = "" ;
	$product_set_table[0] = "" ; 
	//[ 分類 ][ 項次 ] 英文名稱請一律小寫
	//$product_set_para_en[0][]= "topic" ;
	//$product_set_para_ch[0][]= "分類名稱" ;
	//$product_set_para_ex[0][]= "1" ;

	$product_set_name[1] = "後台帳號管理" ;
	$product_set_table[1] = "sys_control" ;     
	//[ 分類 ][ 項次 ] 英文名稱請一律小寫
	$product_set_para_en[1][]= "account" ;
	$product_set_para_ch[1][]= "帳號" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	
	$product_set_para_en[1][]= "password" ;
	$product_set_para_ch[1][]= "密碼" ;
	$product_set_para_ex[1][]= "1" ; 
	$product_set_para_status[1][]= "password" ;

	$product_set_para_en[1][]= "select_group" ;
	$product_set_para_ch[1][]= "群組選擇" ;
	$product_set_para_ex[1][]= "5" ;
	$product_set_para_status[1][]= "option" ;
	$product_set_select_option[1][2][''] = "" ;
	$group_result = $db -> query("select * from sys_group where DELETE_ID =0 order by SORT ASC") ;
	while($group_record = $db -> getarray($group_result))
	{
		$product_set_select_option[1][2][$group_record['ITEM']] = $group_record['TOPIC'] ;
	}
	$product_set_para_check[1][2] = "onlyone" ;

}
if($control == 2){

	//初始設定 此為設定目錄顯示狀態 
	$set_catelog_control = 1 ;
	//分頁數量設定
	$page_max_limit = 20 ;

	$product_set_name[0] = "" ;
	$product_set_table[0] = "" ; 
	//[ 分類 ][ 項次 ] 英文名稱請一律小寫

	$product_set_name[1] = "權限群組管理" ;
	$product_set_table[1] = "sys_group" ;     
	//[ 分類 ][ 項次 ] 英文名稱請一律小寫
	$product_set_para_en[1][]= "topic" ;
	$product_set_para_ch[1][]= "群組名稱" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;

	$product_set_para_en[1][]= "group_control" ;
	$product_set_para_ch[1][]= "群組權限" ;
	$product_set_para_ex[1][]= "6" ;
	$product_set_para_status[1][]= "option" ;
	$product_set_select_option[1][1]['1.1'] = "後台帳號管理" ;
	$product_set_select_option[1][1]['2.1'] = "權限群組管理" ;

	$product_set_select_option[1][1]['3.1'] = "會員管理" ;
	$product_set_select_option[1][1]['4.1'] = "會員權限" ;
	$product_set_select_option[1][1]['5.1'] = "聯絡我們" ;
	

}
if($control == 3){

	//初始設定 此為設定目錄顯示狀態
	$set_catelog_control = 1 ;
	//分頁數量設定
	$page_max_limit = 20 ; 
	//開啟多顯示欄位
	$changePrintColumn = "true" ;
	//顯示四個欄位
	$columnTotal = 5 ;
	//這四個欄位分別的寬度
	$columnWeight[] = "20%" ;
	$columnWeight[] = "20%" ;
	$columnWeight[] = "30%" ;
	$columnWeight[] = "15%" ;
	$columnWeight[] = "15%" ;
	//顯示陣列第0.1.6.14項欄位
	$columnPName[] = "0" ;
	$columnPName[] = "1" ;
	$columnPName[] = "6" ;
	$columnPName[] = "8" ;
	$columnPName[] = "9" ;

	$product_set_name[0] = "" ;
	$product_set_table[0] = "" ; 
	//[ 分類 ][ 項次 ] 英文名稱請一律小寫  
	
	
	$product_set_name[1] = "會員管理" ;
	$product_set_table[1] = "member" ;     
	//[ 分類 ][ 項次 ] 英文名稱請一律小寫	
	$product_set_para_en[1][]= "name" ;
	$product_set_para_ch[1][]= "姓名" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "required" ;
	
	$product_set_para_en[1][]= "email" ;
	$product_set_para_ch[1][]= "Email" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "required" ;
	
	$product_set_para_en[1][]= "password" ;
	$product_set_para_ch[1][]= "密碼" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "required" ;

	$product_set_para_en[1][]= "tel" ;
	$product_set_para_ch[1][]= "電話" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "" ;
	
	$product_set_para_en[1][]= "address" ;
	$product_set_para_ch[1][]= "地址" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "" ;
	
	$product_set_para_en[1][]= "eth_address" ;
	$product_set_para_ch[1][]= "以太錢包地址" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "" ;
	
	$product_set_para_en[1][]= "ip" ;
	$product_set_para_ch[1][]= "IP位址" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "" ;
	
	$product_set_para_en[1][]= "wggt" ;
	$product_set_para_ch[1][]= "現有風力幣" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "number" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "required" ;
	
	$product_set_para_en[1][]= "status" ;
	$product_set_para_ch[1][]= "會員狀態" ;
	$product_set_para_ex[1][]= "5" ;
	$product_set_para_status[1][]= "option" ;
	$product_set_select_option[1][8][1] = "已審核" ;
	$product_set_select_option[1][8][2] = "未審核" ;
	$product_set_select_option[1][8][3] = "凍結中" ;
	
	$product_set_para_en[1][]= "member_level" ;
	$product_set_para_ch[1][]= "會員等級" ;
	$product_set_para_ex[1][]= "5" ;
	$product_set_para_status[1][]= "option" ;
	$product_set_select_option[1][9][1] = "一般會員" ;
	$member_level_result = $db -> query("select * from member_level where DELETE_ID =0 order by SORT ASC") ;
	while( $member_level = $db -> getarray($member_level_result) ){
		$product_set_select_option[1][9][$member_level['ITEM']] = $member_level['TOPIC'] ;
	}
}

if($control == 4){

	//初始設定 此為設定目錄顯示狀態
	$set_catelog_control = 1 ;
	//分頁數量設定
	$page_max_limit = 20 ; 
	
	$product_set_name[0] = "" ;
	$product_set_table[0] = "" ; 
	//[ 分類 ][ 項次 ] 英文名稱請一律小寫  
	
	
	$product_set_name[1] = "會員權限" ;
	$product_set_table[1] = "member_level" ;     
	//[ 分類 ][ 項次 ] 英文名稱請一律小寫	
	$product_set_para_en[1][]= "topic" ;
	$product_set_para_ch[1][]= "名稱" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "required" ;
}
if($control == 5){

	//初始設定 此為設定目錄顯示狀態
	$set_catelog_control = 1 ;
	//分頁數量設定
	$page_max_limit = 20 ; 
	//開啟多顯示欄位
	$changePrintColumn = "true" ;
	//顯示四個欄位
	$columnTotal = 4 ;
	//這四個欄位分別的寬度
	$columnWeight[] = "20%" ;
	$columnWeight[] = "30%" ;
	$columnWeight[] = "30%" ;
	$columnWeight[] = "20%" ;
	//顯示陣列第0.1.6.14項欄位
	$columnPName[] = "0" ;
	$columnPName[] = "1" ;
	$columnPName[] = "2" ;
	$columnPName[] = "4" ;
	$sortList[1] = "DESC"  ;

	$product_set_name[0] = "" ;
	$product_set_table[0] = "" ; 
	//[ 分類 ][ 項次 ] 英文名稱請一律小寫  
	
	$product_set_name[1] = "聯絡我們" ;
	$product_set_table[1] = "contact" ;     
	//[ 分類 ][ 項次 ] 英文名稱請一律小寫
	$product_set_para_en[1][]= "name" ;
	$product_set_para_ch[1][]= "姓名" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "" ;

	$product_set_para_en[1][]= "tel" ;
	$product_set_para_ch[1][]= "聯絡電話" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "" ;
	
	$product_set_para_en[1][]= "email" ;
	$product_set_para_ch[1][]= "Email" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "" ;

	$product_set_para_en[1][]= "content" ;
	$product_set_para_ch[1][]= "留言內容" ;
	$product_set_para_ex[1][]= "2" ;
	$product_set_para_status[1][]= "html" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "" ;
	
	$product_set_para_en[1][]= "onread" ;
	$product_set_para_ch[1][]= "是否閱讀" ;
	$product_set_para_ex[1][]= "5" ;
	$product_set_para_status[1][]= "option" ;
	$product_set_select_option[1][4][1] = "否" ;
	$product_set_select_option[1][4][2] = "是" ;
}
/*
if($control == 8){

	//初始設定 此為設定目錄顯示狀態
	$set_catelog_control = 1 ;
	//分頁數量設定
	$page_max_limit = 20 ; 
	//開啟多顯示欄位
	$changePrintColumn = "true" ;
	//顯示四個欄位
	$columnTotal = 5 ;
	//這四個欄位分別的寬度
	$columnWeight[] = "20%" ;
	$columnWeight[] = "20%" ;
	$columnWeight[] = "20%" ;
	$columnWeight[] = "25%" ;
	$columnWeight[] = "15%" ;
	//顯示陣列第0.1.6.14項欄位
	$columnPName[] = "5" ;
	$columnPName[] = "1" ;
	$columnPName[] = "0" ;
	$columnPName[] = "4" ;
	$columnPName[] = "6" ;
	
	$product_set_name[0] = "" ;
	$product_set_table[0] = "" ; 
	//[ 分類 ][ 項次 ] 英文名稱請一律小寫  
	
	
	$product_set_name[1] = "訂單管理" ;
	$product_set_table[1] = "order_topic" ;     
	//[ 分類 ][ 項次 ] 英文名稱請一律小寫	
	$product_set_para_en[1][]= "email" ;
	$product_set_para_ch[1][]= "Email" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "required" ;
	
	$product_set_para_en[1][]= "name" ;
	$product_set_para_ch[1][]= "姓名" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "required" ;
	
	$product_set_para_en[1][]= "eth_address" ;
	$product_set_para_ch[1][]= "以太幣地址" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "required" ;
	
	$product_set_para_en[1][]= "eth" ;
	$product_set_para_ch[1][]= "以太幣數量" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "required" ;
	
	$product_set_para_en[1][]= "wgc" ;
	$product_set_para_ch[1][]= "風力幣數量" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "required" ;
	
	$product_set_para_en[1][]= "order_number" ;
	$product_set_para_ch[1][]= "交易編號" ;
	$product_set_para_ex[1][]= "1" ;
	$product_set_para_status[1][]= "read" ;
	$product_set_direction[1][] = "";
	$product_set_para_check[1][] = "required" ;
	
	$product_set_para_en[1][]= "status" ;
	$product_set_para_ch[1][]= "交易狀態" ;
	$product_set_para_ex[1][]= "5" ;
	$product_set_para_status[1][]= "option" ;
	$product_set_select_option[1][6][1] = "尚未確認" ;
	$product_set_select_option[1][6][2] = "已確認" ;
}
*/
?>