<?
include('../../config.php') ;
$control = $_POST['control'] ;
include('../config.php') ;
/*-----------------------------------
資料新增
-------------------------------------*/
foreach($_POST['inputString'] as $key => $value)
{
	switch($_POST['columnstatus'][$key])
	{
		case 1 :
			$getstring[] = htmlentities($_POST[$value],ENT_QUOTES,'UTF-8') ;
			break ;
		case 2 :
			switch($_POST['columnselect'][$key])
			{
				case "fck" :
				case "google" :
				case "detail" :
				case "basic" :
					$getstring[] = addslashes($_POST[$value]) ;
					break ;
				case "html" :
				case "value" :
					$getstring[] = addslashes($_POST[$value]) ;
					break ;
				case "nocode" :
					$getstring[] = addslashes($_POST[$value]) ;
					break ;
			}
			break ;
		case 3 :
			switch($_POST['columnselect'][$key])
			{
				case "image" :
				case "file" :
					if($_FILES[$value]['name']!=null)
					{
						$type_file = strtolower(strrchr($_FILES[$value]['name'], ".")) ;
						//if( $type_file == ".jpg" || $type_file == ".png" || $type_file == ".gif" || $type_file == ".jpeg" || $type_file == ".JPG" || $type_file == ".PNG" || $type_file == ".GIF" || $type_file == ".JPEG" )
						//{
							$new_name = time()."_".rand(1,9999) ;
							$_POST[$value] = $new_name.$type_file ;
							copy($_FILES[$value]['tmp_name'],"../../upload/".$_POST[$value]."") ;
						//}
						if($type_file=='.jpg' || $type_file=='.jpeg'){
							$file ="../../upload/".$_POST[$value];
							$quality = 90;
							$img = imagecreatefromjpeg($file);
							@imagejpeg($img, $file, $quality);
							@imagedestroy($img);
						}
					}
					$getstring[] = $_POST[$value] ;
					break ;
					
				case "nochangeimg" :
				case "nochangefile" :
					if($_FILES[$value]['name']!=null)
					{
						$_POST[$value] = $_FILES[$value]['name'] ;
						copy($_FILES[$value]['tmp_name'],"../../upload/".$_POST[$value]."") ;
					}
					$getstring[] = $_POST[$value] ;
					break ;
				case "manyfile" :
					$result = $db -> query("select * from uploadfile order by SORT ASC") ;
					$imgrows = $db -> getcount("select * from uploadfile") ;
					$nowimg = 0 ;
					while($record = $db -> getarray($result))
					{
						$nowimg++ ;
						$allfile .= $record['FILENAME'] ;
						if($imgrows != $nowimg)
						{
							$allfile .="," ;
						}
					}
					$db -> query("truncate table uploadfile") ;
					$getstring[] = $allfile ;
					break ;
				case "manyfileinput" :
					$result = $db -> query("select * from uploadfile order by SORT ASC") ;
					$imgrows = $db -> getcount("select * from uploadfile") ;
					$nowimg = 0 ;
					while($record = $db -> getarray($result))
					{
						$nowimg++ ;
						$allfile .= $record['FILENAME'] ;
						$allfilename .= $record['TOPIC'] ;
						if($imgrows != $nowimg)
						{
							$allfile .="," ;
							$allfilename .="," ;
						}
					}
					$checkallfile = "true" ;
					$db -> query("truncate table uploadfile") ;
					$getstring[] = $allfile ;
					break ;
					
					
					
					
			}
			break ;
		case 4 :
			switch($_POST['columnselect'][$key])
			{
				case "date" :
				case "birth" :
					$getstring[] = $_POST[$value] ;
					break ;
				case "detail" :
					$timer = $_POST[$value."hour"].":".$_POST[$value."mintue"].":".$_POST[$value."sec"] ;
					$getstring[] = $_POST[$value]." ".$timer ;
					break ;
			}
			break ;
		case 5 :
			$selectString = "" ;
			switch($_POST['columnselect'][$key])
			{
				case "related" :
					for($i = 1 ; $i <= $_POST[$value."related"] ; $i++)
					{
						$selectString .= $_POST[$value.$i] ;
						if($i != $_POST[$value."related"])
						{
							$selectString .= "," ;
						}
					}
					$getstring[] = $selectString ;
					break ;
				case "option" :
					$getstring[] = $_POST[$value] ;
					break ;
			}
			break ;
		case 6 :
			$checkboxString = "" ;
			switch($_POST['columnselect'][$key])
			{
				case "option" :
					$i = 0 ;
					foreach($_POST[$value] as $key_in => $value_in)
					{
						$i++ ;
						$checkboxString .= $value_in ;
						if( count($_POST[$value]) != $i)
						{
							$checkboxString .= "," ;
						}
					}
					$getstring[] = $checkboxString ;
					break ;
			}

			break ;
		case 7 :
			switch($_POST['columnselect'][$key])
			{
				case "option" :
					$getstring[] = $_POST[$value] ;
					break ;
			}
			break ;
	}
	//將欄位排成字串
	$columnString .= "".strtoupper($value)." ," ;
}

foreach($getstring as $key => $value)
{//將值排成字串
	$valueString .= "'".$value."' ," ; 
}

if( $checkallfile == "true" )
{//新增多檔上傳的欄位值
	$columnString .= "".strtoupper($manyinput)."INPUT ," ;
	$valueString .= "'".$allfilename."' ," ; 
}

if($_POST['item'] == null)
{
	if($_POST['cate_index'] != null)
	{
		$doc       = $db -> getfirst("select * from ".$_POST['categoryTable']." where DELETE_ID =0 and ITEM ='".$_POST['cate_index']."'") ;
		$doc_path  = $doc['DOC_PATH'].$_POST['cate_index']."<br>" ;
		$doc_level = $doc['DOC_LEVEL'] + 1 ;
		$_POST['item'] = $_POST['cate_index'] ;
	}
	else
	{
		$_POST['item'] = 0 ;
		$doc_path = "0<br>" ;
		$doc_level = 1 ;
	}
}
else
{
	$doc       = $db -> getfirst("select * from ".$_POST['table']." where DELETE_ID =0 and ITEM ='".$_POST['item']."'") ;
	$doc_path  = $doc['DOC_PATH'].$_POST['item']."<br>" ;
	$doc_level = $doc['DOC_LEVEL'] + 1 ;
}
$db -> insert("Insert into ".$_POST['table']."( ".$columnString." CATE_INDEX , DOC_PATH , MODEFY_TIME , SET_TIME , DELETE_ID , MEMBER_NUM , DOC_LEVEL  ) values( ".$valueString." '".$_POST['item']."' , '".$doc_path."' , now() , now() , 0 , '".$_SESSION['system_item']."' , '".$doc_level."' )") ;
$insert_id = $db ->getid() ;
$db -> update("update ".$_POST['table']." set SORT ='".$insert_id."' where ITEM ='".$insert_id."'") ;
?>
