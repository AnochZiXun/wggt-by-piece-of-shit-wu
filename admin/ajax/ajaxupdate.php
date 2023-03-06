<?
include('../../config.php') ;
$control = $_POST['control'] ;
include('../config.php') ;
/*-----------------------------------
資料修改
-------------------------------------*/
foreach($_POST['updateString'] as $key => $value)
{//判斷欄位型態
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
					if( $_FILES[$value]['name'] != null )
					{
						//刪除舊檔案
						$file ="../../upload/".$_POST['columnvalue'][$key]."";
						if(file_exists($file))
						{
							unlink($file);
						}
						$type_file = strtolower(strrchr($_FILES[$value]['name'], ".")) ;
						$new_name = time()."_".rand(1,9999) ;
						$_POST[$value] = $new_name.$type_file ;
						copy($_FILES[$value]['tmp_name'],"../../upload/".$_POST[$value]."") ;
						if($type_file=='.jpg' || $type_file=='.jpeg'){
							$file ="../../upload/".$_POST[$value];
							$quality = 90;
							$img = imagecreatefromjpeg($file);
							@imagejpeg($img, $file, $quality);
							@imagedestroy($img);
						}
						$getstring[] = $_POST[$value] ;
					}
					else
					{
						$getstring[] = $_POST['columnvalue'][$key] ;
					}
					
					break ;
				case "nochangeimg" :
				case "nochangefile" :
					if( $_FILES[$value]['name'] != null )
					{
						//刪除舊檔案
						$file ="../../upload/".$_POST['columnvalue'][$key]."";
						if(file_exists($file))
						{
							unlink($file);
						}
						$_POST[$value] = $_FILES[$value]['name'] ;
						copy($_FILES[$value]['tmp_name'],"../../upload/".$_POST[$value]."") ;
						$getstring[] = $_POST[$value] ;
					}
					else
					{
						$getstring[] = $_POST['columnvalue'][$key] ;
					}
					break ;
				case "manyfile" :
					//舊圖片資訊
					$old = $db -> getfirst("select * from ".$_POST['table']." where ITEM ='".$_POST['item']."'") ;
					$result = $db -> query("select * from uploadfile") ;
					$imgrows = $db -> getcount("select * from uploadfile") ;
					$nowimg = 0 ;
					if($imgrows > 0 )
					{
						if($old[strtoupper($value)] != null)
						{
							$allfile = $old[strtoupper($value)] . "," ;
							$imgsCol = explode(",",$old[strtoupper($value)]) ;
						}
						else
						{
							$allfile = "" ;
						}
						
						while($record = $db -> getarray($result))
						{
							if( in_array($record['FILENAME'] , $imgsCol) == false )
							{
								$nowimg++ ;
								$allfile .= $record['FILENAME'] ;
								if($imgrows != $nowimg)
								{
									$allfile .="," ;
								}
							}
						}
					}
					else
					{
						$allfile =$old[strtoupper($value)] ;
					}
					$db -> query("truncate table uploadfile") ;
					$getstring[] = $allfile ;
					break ;
				case "manyfileinput" :
					//舊圖片資訊
					$old = $db -> getfirst("select * from ".$_POST['table']." where ITEM ='".$_POST['item']."'") ;
					$result = $db -> query("select * from uploadfile") ;
					$imgrows = $db -> getcount("select * from uploadfile") ;
					$nowimg = 0 ;
					if($imgrows > 0 )
					{
						if($old[strtoupper($value)] != null)
						{
							$allfile = $old[strtoupper($value)] . "," ;
							$imgsCol = explode(",",$old[strtoupper($value)]) ;

							//$allfilename = $old[strtoupper($manyinput).'INPUT'] . "," ;
							//$inputsCol = explode(",",$old[strtoupper($manyinput).'INPUT']) ;

						}
						else
						{
							$allfile = "" ;
							//$allfilename = "" ;
						}
						
						while($record = $db -> getarray($result))
						{
							if( in_array($record['FILENAME'] , $imgsCol) == false )
							{
								$nowimg++ ;
								$allfile .= $record['FILENAME'] ;
								//$allfilename .= $record['TOPIC'] ;
								if($imgrows != $nowimg)
								{
									$allfile .="," ;
									//$allfilename .="," ;
								}
							}
						}
					}
					else
					{
						$allfile =$old[strtoupper($value)] ;
						//$allfilename =$old[strtoupper($manyinput).'INPUT'] ;
					}
					$db -> query("truncate table uploadfile") ;

					$inputnum = 0 ;
					foreach( $_POST[$manyinput.'input'] as $key_in2 => $value_in2 )
					{
						$inputnum++ ;
						$allfilename .= $value_in2 ;
						if( count( $_POST[$manyinput.'input'] ) != $inputnum )
						{
							$allfilename .="," ;
						}
						
					}

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
		case 7 :
			$getstring[] = $_POST[$value] ;
			break ;
	}
}
foreach($_POST['updateString'] as $key => $value)
{//欄位 = '值' 排成字串
	$string .= "".strtoupper($value)." = '".$getstring[$key]."' ," ;
}
	if( $allfilename != null )
	{
		$string .= "".strtoupper($manyinput).'INPUT'." = '".$allfilename."' ," ;
	}
	
	
if($_POST['cate_index'] != null)
{
	$doc       = $db -> getfirst("select * from ".$_POST['categoryTable']." where DELETE_ID =0 and ITEM ='".$_POST['cate_index']."'") ;
	$doc_path  = $doc['DOC_PATH'].$_POST['cate_index']."<br>" ;
	$doc_level = $doc['DOC_LEVEL'] + 1 ;
	$db -> update("update ".$_POST['table']." set ".$string." MODEFY_TIME = now() , MEMBER_NUM ='".$_SESSION['system_item']."' , CATE_INDEX ='".$_POST['cate_index']."' , DOC_PATH ='".$doc_path."' , DOC_LEVEL ='".$doc_level."' where ITEM ='".$_POST['item']."'") ;
}
else
{
	$db -> update("update ".$_POST['table']." set ".$string." MODEFY_TIME = now() , MEMBER_NUM ='".$_SESSION['system_item']."' where ITEM ='".$_POST['item']."'") ;
}
?>
