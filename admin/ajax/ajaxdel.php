<?
include('../../config.php') ;
/*-----------------------------------
刪除
-------------------------------------*/
if($_POST['postkind'] == "category")
{
	$db -> del("delete from ".$_POST['table']." where ITEM ='".$_POST['item']."' or LOCATE('".$_POST['item']."<br>',DOC_PATH)!=0") ;
}
if($_POST['postkind'] == "data")
{

	$control = $_POST['control'] ;
	include('../config.php') ;
	//刪除檔案
	foreach( $product_set_para_ex[1] as $key => $value ){
		if( $product_set_para_ex[1][$key] == 3 ){
			$delFile = $db -> getfirst("select * from ".$_POST['table']." where ITEM ='".$_POST['item']."' ") ;
			if( $delFile[strtoupper($product_set_para_en[1][$key])] != null ){
				if( $product_set_para_status[1][$key] != 'manyfile' ){
					$file ="../../upload/".$delFile[strtoupper($product_set_para_en[1][$key])]."";
					if(file_exists($file)){
						unlink($file);
					}
				}else{
					$files = explode(",",$delFile[strtoupper($product_set_para_en[1][$key])]) ;
					foreach( $files as $key_in => $value_in ){
						$file ="../../upload/".$value_in;
						if(file_exists($file)){
							unlink($file);
						}
					}
				}
			}
		}
	}

	
	$db -> del("delete from ".$_POST['table']." where ITEM ='".$_POST['item']."'") ;
	$arr = array ('control'=> $_POST['control'] , 'kind'=> 1 , 'page'=> $_POST['page'] ) ;
	echo json_encode($arr);
}
if($_POST['postkind'] == "muchdata")
{
	$control = $_POST['control'] ;
	include('../config.php') ;
	$delitem = explode("." , $_POST['item']) ;
	foreach($delitem as $key => $value)
	{
		//刪除檔案
		foreach( $product_set_para_ex[1] as $key_inin => $value_inin ){
			if( $product_set_para_ex[1][$key_inin] == 3 ){
				$delFile = $db -> getfirst("select * from ".$_POST['table']." where ITEM ='".$value."' ") ;
				if( $delFile[strtoupper($product_set_para_en[1][$key_inin])] != null ){
					if( $product_set_para_status[1][$key_inin] != 'manyfile' ){
						$file ="../../upload/".$delFile[strtoupper($product_set_para_en[1][$key_inin])]."";
						if(file_exists($file)){
							unlink($file);
						}
					}else{
						$files = explode(",",$delFile[strtoupper($product_set_para_en[1][$key_inin])]) ;
						foreach( $files as $key_in => $value_in ){
							$file ="../../upload/".$value_in;
							if(file_exists($file)){
								unlink($file);
							}
						}
					}
				}
			}
		}
		$db -> del("delete from ".$_POST['table']." where ITEM ='".$value."'") ;
	}
	$arr = array ('control'=> $_POST['control'] , 'kind'=> 1 , 'page'=> $_POST['page'] ) ;
	echo json_encode($arr);
}
?>
