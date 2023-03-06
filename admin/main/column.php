<?
/*
 * @ author : Wu
 * @ description : 後臺欄位Class
 * @ version status: v2.1 - 2011.04.10
 */
class column
{
/*
 * @ description : 欄位一般輸入
 *
 *  $columnName   欄位名稱
 *  $columnStatus 欄位型態
 *  $columnSelect 型態選擇
 *  $option       選項值
 */
	function inputColumn( $columnName , $columnStatus , $columnSelect , $option , $description , $check , $nums , $default_value )
	{
		switch($check)
		{//欄位必填確認
			case "required" :
				$class = "required" ;
				break ;
			case "email" :
				$class = "email" ;
				break ;
			case "url" :
				$class = "url" ;
				break ;
			case "number" :
				$class = "number" ;
				break ;
			case "digits" :
				$class = "digits" ;
				break ;
			case "creditcard" :
				$class = "creditcard" ;
				break ;
			case "onlyone" :
				$class = "validate=\"required:true, minlength:1\"" ;
				$title = "最少要選1個" ;
				break ;
			case "minlength" :
				$class = "validate=\"required:true, minlength:".$nums."\"" ;
				$title = "最少要選".$nums."個" ;
				break ;
			case "maxlength" :
				$class = "validate=\"required:true, maxlength:".$nums."\"" ;
				$title = "最多可選".$nums."個" ;
				break ;
		}
		//型態1(輸入)
		if($columnStatus == 1)
		{
			switch($columnSelect)
			{
				case "read" :
				case "number" :
				case "readonly" :
					echo "<input type=\"text\" name=\"".$columnName."\" style=\"width:30%;\" class=\"".$class."\" /><font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
				case "password" :
					echo "<input type=\"password\" name=\"".$columnName."\" style=\"width:30%;\" class=\"".$class."\" /><font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
			}
		}
		//型態2(textarea)
		if($columnStatus == 2)
		{
			switch($columnSelect)
			{
				case "html" :
				case "nocode" :
					echo "<textarea name='".$columnName."' style=\"width:70%;height:310px;\" class=\"".$class."\"></textarea><font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
				case "value" :
					$oFCKeditor = new FCKeditor($columnName) ;
					$oFCKeditor->BasePath = '../fckeditor/' ;
					$oFCKeditor->Width = '95%' ;
					$oFCKeditor->Height = '500' ;
					$oFCKeditor->Value = stripslashes($default_value) ;
					CKFinder::SetupFCKeditor($oFCKeditor , '../fckeditor/ckfinder/') ;
					$oFCKeditor->Create() ;
					echo "<font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
				case "fck" :
					$oFCKeditor = new FCKeditor($columnName) ;
					$oFCKeditor->BasePath = '../fckeditor/' ;
					$oFCKeditor->Width = '95%' ;
					$oFCKeditor->Height = '500' ;
					$oFCKeditor->Value=' ' ;
					CKFinder::SetupFCKeditor($oFCKeditor , '../fckeditor/ckfinder/') ;
					$oFCKeditor->Create() ;
					echo "<font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
				case "google" :
					$oFCKeditor = new FCKeditor($columnName) ;
					$oFCKeditor->BasePath = '../fckeditor/' ;
					$oFCKeditor->ToolbarSet = 'Google' ;
					$oFCKeditor->Width = '95%' ;
					$oFCKeditor->Height = '500' ;
					CKFinder::SetupFCKeditor($oFCKeditor , '../fckeditor/ckfinder/') ;
					$oFCKeditor->Create() ;
					echo "<font style=\"color:#ff0000\">".$description."</font>" ;
					break;
				case "detail" :
					$oFCKeditor = new FCKeditor($columnName) ;
					$oFCKeditor->BasePath = '../fckeditor/' ;
					$oFCKeditor->ToolbarSet = 'Detail' ;
					$oFCKeditor->Width = '95%' ;
					$oFCKeditor->Height = '500' ;
					CKFinder::SetupFCKeditor($oFCKeditor , '../fckeditor/ckfinder/') ;
					$oFCKeditor->Create() ;
					echo "<font style=\"color:#ff0000\">".$description."</font>" ;
					break;
				case "basic" :
					$oFCKeditor = new FCKeditor($columnName) ;
					$oFCKeditor->BasePath = '../fckeditor/' ;
					$oFCKeditor->ToolbarSet = 'Basic' ;
					$oFCKeditor->Width = '70%' ;
					$oFCKeditor->Height = '310' ;
					CKFinder::SetupFCKeditor($oFCKeditor , '../fckeditor/ckfinder/') ;
					$oFCKeditor->Create() ;
					echo "<font style=\"color:#ff0000\">".$description."</font>" ;
					break;
			}
		}
		//型態3(file)
		if($columnStatus == 3)
		{
			switch($columnSelect)
			{
				case "image" :
				case "nochangeimg" :
				case "file" :
				case "nochangefile" :
					echo "<input type=\"file\" name=\"".$columnName."\" style=\"width:30%;\" class=\"".$class."\" /><font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
				case "manyfile" :
					echo "<div id=\"".$columnName."Zone\" style=\"width:70%;float:left;\"></div><br /><div style=\"float:left;width:50%;padding-bottom:10px;padding-top:10px;margin-left:10px;\"><a href=\"./ajax/manyfilesort.php?height=400&amp;width=700&amp;columnen=".$columnName."&amp;page_status=add&amp;manyfile=false&amp;\" title=\"排序\" class=\"manyfilesort thickbox\">排序</a></div><br />" ;
					echo "<div style=\"padding-top:10px;width:50%;float:left;\"><input type=\"file\" name=\"".$columnName."\" id=\"".$columnName."\" /></div>" ;
					break ;
				case "manyfileinput" :
					echo "<div id=\"".$columnName."Zone\" style=\"width:70%;float:left;\"></div><br /><div style=\"float:left;width:50%;padding-bottom:10px;padding-top:10px;margin-left:10px;\"><a href=\"./ajax/manyfilesortinput.php?height=400&amp;width=700&amp;columnen=".$columnName."&amp;page_status=add&amp;manyfile=true&amp;\" title=\"排序\" class=\"manyfilesort thickbox\">排序</a></div><br />" ;
					echo "<div style=\"padding-top:10px;width:50%;float:left;\"><input type=\"file\" name=\"".$columnName."\" id=\"".$columnName."\" /></div>" ;
					break ;
			}
		}
		//型態4(date)
		if($columnStatus == 4)
		{
			switch($columnSelect)
			{
				case "date" :
				case "birth" :
					echo "<input type=\"text\" name=\"".$columnName."\" id=\"".$columnName."\" style=\"width:30%;\" class=\"".$class."\" /><font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
				case "detail" :
					$hour = "" ;
					for($hourValue = 0 ; $hourValue < 24 ; $hourValue++ )
					{
						$hour .= "<option value=\"".sprintf("%02d", $hourValue)."\">".sprintf("%02d", $hourValue)."</option>" ;
					}
					$mintue = "" ;
					for($mintueValue = 1 ; $mintueValue <= 60 ; $mintueValue++ )
					{
						$mintue .= "<option value=\"".sprintf("%02d", $mintueValue)."\">".sprintf("%02d", $mintueValue)."</option>" ;
					}
					$sec = "" ;
					for($secValue = 1 ; $secValue <= 60 ; $secValue++ )
					{
						$sec .= "<option value=\"".sprintf("%02d", $secValue)."\">".sprintf("%02d", $secValue)."</option>" ;
					}
					echo "<input type=\"text\" name=\"".$columnName."\" id=\"".$columnName."\" style=\"width:100px;\" class=\"".$class."\" /><select name=\"".$columnName."hour\" style=\"margin-left:5px;\"><option value=\"0\">時</option>".$hour."</select><select name=\"".$columnName."mintue\" style=\"margin-left:5px;\"><option value=\"0\">分</option>".$mintue."</select><select name=\"".$columnName."sec\" style=\"margin-left:5px;\"><option value=\"0\">秒</option>".$sec."</select><font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
			}
		}
		//型態5(select)
		if($columnStatus == 5)
		{
			switch($columnSelect)
			{
				case "related" :
					$column = "";
					foreach($option as $key => $value)
					{
						$level++ ;
						$column .="<select name=\"".$columnName.$level."\" class=\"labelselect\" ".$class.">" ;
						foreach($value as $key_in => $value_in)
						{
							$column .= "<option value=\"".$key_in."\">".$value_in."</option>" ;
						}
						$column .="</select>" ;
					}
					echo "<input type=\"hidden\" name=\"".$columnName."related\" value=\"".$level."\" />" ;
					break ;
				case "option" :
					$column ="<select name=\"".$columnName."\" ".$class.">" ;
					foreach($option as $key => $value)
					{
						$column .= "<option value=\"".$key."\">".$value."</option>" ;
					}
					$column .="</select>" ;
					break ;
			}
			echo $column ;
			echo "<font style=\"color:#ff0000\">".$description."</font>" ;
		}
		//型態6(checkbox)
		if($columnStatus == 6)
		{
			$column .= "<p style=\"width:100px;height:40px;\"><input type=\"checkbox\" name=\"selectall\" selectname=\"".$columnName."\" style=\"float:left;margin-top:2px;margin-right:4px;*margin:0px;\" /><font style=\"float:left;*margin-top:4px;width:80px;\">此項全選</font></p>";
			switch($columnSelect)
			{
				case "option" :
					foreach($option as $key => $value)
					{
						$column .= "<span class=\"muchbox\"><input type=\"checkbox\" name=\"".$columnName."[]\" value=\"".$key."\" ".$class." /><p>".$value."</p></span>" ;
					}
					break ;
			}
			echo $column ;
			echo "<font style=\"color:#ff0000\">".$description."</font><label style=\"display:none;\" for=\"".$columnName."[]\" class=\"error\">".$title."</label>" ;
		}
		//型態7(radio)
		if($columnStatus == 7)
		{
			switch($columnSelect)
			{
				case "option" :
					foreach($option as $key => $value)
					{
						$column .= "<span class=\"muchbox\"><input type=\"radio\" name=\"".$columnName."\" value=\"".$key."\" ".$class." /><p>".$value."</p></span>" ;
					}
					break ;
			}
			echo $column ;
			echo "<font style=\"color:#ff0000\">".$description."</font><label style=\"display:none;\" for=\"".$columnName."\" class=\"error\">".$title."</label>" ;
		}
	}
/*
 * @ description : 欄位值修改
 *
 *  $columnName   欄位名稱
 *  $columnStatus 欄位型態
 *  $columnSelect 型態選擇
 *	$columnValue  欄位值
 *  $option       選項值
 */
	function modefyColumn( $table , $columnName , $columnStatus , $columnSelect , $option , $columnValue , $description , $check , $nums , $manyinput2)
	{
		switch($check)
		{//欄位必填確認
			case "required" :
				$class = "required" ;
				break ;
			case "email" :
				$class = "email" ;
				break ;
			case "url" :
				$class = "url" ;
				break ;
			case "number" :
				$class = "number" ;
				break ;
			case "digits" :
				$class = "digits" ;
				break ;
			case "creditcard" :
				$class = "creditcard" ;
				break ;
			case "onlyone" :
				$class = "validate=\"required:true, minlength:1\"" ;
				$title = "最少要選1個" ;
				break ;
			case "minlength" :
				$class = "validate=\"required:true, minlength:".$nums."\"" ;
				$title = "最少要選".$nums."個" ;
				break ;
			case "maxlength" :
				$class = "validate=\"required:true, maxlength:".$nums."\"" ;
				$title = "最多要選".$nums."個" ;
				break ;
		}
		//型態1(輸入)
		if($columnStatus == 1)
		{
			switch($columnSelect)
			{
				case "read" :
				case "number" :
					echo "<input type=\"text\" name=\"".$columnName."\" value=\"".$columnValue."\" style=\"width:30%;\" class=\"".$class."\" /><font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
				case "readonly" :
					echo $columnValue."<input type=\"hidden\" name=\"".$columnName."\" value=\"".$columnValue."\" style=\"width:30%;\" class=\"".$class."\" /><font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
				case "password" :
					echo "<input type=\"password\" name=\"".$columnName."\" value=\"".$columnValue."\" style=\"width:30%;\" class=\"".$class."\" /><font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
			}
		}
		//型態2(textarea)
		if($columnStatus == 2)
		{
			switch($columnSelect)
			{
				case "html" :
					$breaks = array("<br />","<br>","<br/>");  
					echo "<textarea name=\"".$columnName."\" style=\"width:500px;height:310px;\" class=\"".$class."\" >".stripslashes(str_ireplace($breaks,"\n",$columnValue))."</textarea><font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
				case "nocode" :
					echo "<textarea name=\"".$columnName."\" style=\"width:500px;height:310px;\" class=\"".$class."\" >".stripslashes($columnValue)."</textarea><font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
				case "value" :
					$oFCKeditor = new FCKeditor($columnName) ;
					$oFCKeditor->BasePath = '../fckeditor/' ;
					$oFCKeditor->Width = '95%' ;
					$oFCKeditor->Height = '500' ;
					$oFCKeditor->Value = stripslashes($columnValue) ;
					CKFinder::SetupFCKeditor($oFCKeditor , '../fckeditor/ckfinder/') ;
					$oFCKeditor->Create() ;
					echo "<font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
				case "fck" :
					$oFCKeditor = new FCKeditor($columnName) ;
					$oFCKeditor->BasePath = '../fckeditor/' ;
					$oFCKeditor->Width = '95%' ;
					$oFCKeditor->Height = '500' ;
					$oFCKeditor->Value = stripslashes($columnValue) ;
					CKFinder::SetupFCKeditor($oFCKeditor , '../fckeditor/ckfinder/') ;
					$oFCKeditor->Create() ;
					echo "<font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
				case "google" :
					$oFCKeditor = new FCKeditor($columnName) ;
					$oFCKeditor->BasePath = '../fckeditor/' ;
					$oFCKeditor->ToolbarSet = 'Google' ;
					$oFCKeditor->Width = '95%' ;
					$oFCKeditor->Height = '500' ;
					$oFCKeditor -> Value = stripslashes($columnValue) ;
					CKFinder::SetupFCKeditor($oFCKeditor , '../fckeditor/ckfinder/') ;
					$oFCKeditor->Create() ;
					echo "<font style=\"color:#ff0000\">".$description."</font>" ;
					break;
				case "detail" :
					$oFCKeditor = new FCKeditor($columnName) ;
					$oFCKeditor->BasePath = '../fckeditor/' ;
					$oFCKeditor->ToolbarSet = 'Detail' ;
					$oFCKeditor->Width = '95%' ;
					$oFCKeditor->Height = '500' ;
					$oFCKeditor -> Value = stripslashes($columnValue) ;
					CKFinder::SetupFCKeditor($oFCKeditor , '../fckeditor/ckfinder/') ;
					$oFCKeditor->Create() ;
					echo "<font style=\"color:#ff0000\">".$description."</font>" ;
					break;
				case "basic" :
					$oFCKeditor = new FCKeditor($columnName) ;
					$oFCKeditor->BasePath = '../fckeditor/' ;
					$oFCKeditor->ToolbarSet = 'Basic' ;
					$oFCKeditor->Width = '95%' ;
					$oFCKeditor->Height = '500' ;
					$oFCKeditor -> Value = stripslashes($columnValue) ;
					CKFinder::SetupFCKeditor($oFCKeditor , '../fckeditor/ckfinder/') ;
					$oFCKeditor->Create() ;
					echo "<font style=\"color:#ff0000\">".$description."</font>" ;
					break;
			}
		}
		//型態3(file)
		if($columnStatus == 3)
		{
			if($columnValue == null)
			{
				$thisclass = "class=\"".$check."\"" ;
				
			}
			else
			{
				$thisclass = "class=\"\"" ;
			}
			switch($columnSelect)
			{
				case "image" :
				case "nochangeimg" :
					if(!$columnValue)
					{
						echo "<input type=\"file\" name=\"".$columnName."\" style=\"width:30%;\" class=\"".$class."\" /><font style=\"color:#ff0000\">".$description."</font>" ;
					}
					else
					{
						echo "<span><a href=\"../upload/".$columnValue."\" class=\"lightbox\">原圖片請按此</a>&nbsp;&nbsp;|&nbsp;&nbsp;<font style=\"color:#ff0000;cursor:pointer;\" thiscolumn=\"".$columnName."\" thisvalue=\"".$columnValue."\" thistable=\"".$table."\" class=\"clickimg\">按此刪除圖片</font><br /></span><input type=\"file\" name=\"".$columnName."\" style=\"width:30%;\" ".$thisclass." /><font style=\"color:#ff0000\">".$description."</font>" ;
					}
					break ;
				case "file" :
				case "nochangefile" :
					if(!$columnValue)
					{
						echo "<input type=\"file\" name=\"".$columnName."\" style=\"width:30%;\" class=\"".$class."\" /><font style=\"color:#ff0000\">".$description."</font>" ;
					}
					else
					{
						echo "<span><a href=\"../upload/".$columnValue."\">原檔案請按此</a>&nbsp;&nbsp;|&nbsp;&nbsp;<font style=\"color:#ff0000;cursor:pointer;\" thiscolumn=\"".$columnName."\" thisvalue=\"".$columnValue."\" thistable=\"".$table."\" class=\"clickimg\">按此刪除檔案</font><br /></span><input type=\"file\" name=\"".$columnName."\" style=\"width:30%;\" ".$thisclass." /><font style=\"color:#ff0000\">".$description."</font>" ;
					}
					break ;
				case "manyfile" :
					$fileList = explode(",",$columnValue) ;
					echo "<div id=\"".$columnName."Zone\" style=\"width:70%;float:left;\"><div style=\"width:100%;float:left;\">" ;
					foreach($fileList as $key => $value)
					{
						if($value != null)
						{
							//$columnString .= "<span class=\"muchbox\"><font style=\"color:#ff0000;cursor:pointer;\" thiscolumn=\"".$columnName."\" thisvalue=\"".$value."\" thistable=\"".$table."\" class=\"clickimgs\">刪除此圖片</font><br /><a href=\"../upload/".$value."\" class=\"lightbox\" rel=\"".$columnName."\"><img src=\"\"></a></span>" ;
							echo "<span class=\"muchFile\"><font style=\"color:#ff0000;cursor:pointer;text-align:right;width:80%;display:block;\" thiscolumn=\"".$columnName."\" thisvalue=\"".$value."\" thistable=\"".$table."\" class=\"clickimgs\">刪除</font><a href=\"../upload/".$value."\" class=\"lightbox\" rel=\"".$columnName."\"><img src=\"../upload/".$value."\"></a></span>" ;
						}
					}
					echo "</div></div><br /><div style=\"float:left;width:50%;padding-bottom:10px;padding-top:10px;margin-left:10px;\"><a href=\"./ajax/manyfilesort.php?height=400&amp;width=700&amp;columnen=".$columnName."&amp;page_status=modefy&amp;table=".$table."&amp;item=".$_GET['item']."&amp;manyfile=false&amp;\" title=\"排序\" class=\"manyfilesort thickbox\">排序</a></div><br />" ;
					echo "<div style=\"padding-top:10px;width:50%;float:left;\"><input type=\"file\" name=\"".$columnName."\" id=\"".$columnName."\" /></div>" ;
					break ;
				case "manyfileinput" :
					$fileList = explode(",",$columnValue) ;
					$fileListInput = explode(",",$manyinput2) ;
					echo "<div id=\"".$columnName."Zone\" style=\"width:70%;float:left;\"><div style=\"width:100%;float:left;\">" ;
					foreach($fileList as $key => $value)
					{
						if($value != null)
						{
							echo "<span class=\"muchFile\"><font style=\"color:#ff0000;cursor:pointer;text-align:right;width:80%;display:block;\" thiscolumn=\"".$columnName."\" thisvalue=\"".$value."\" thistable=\"".$table."\" class=\"clickimgs\">刪除</font><a href=\"../upload/".$value."\" class=\"lightbox\" rel=\"".$columnName."\"><img src=\"../upload/".$value."\"></a><input type=\"text\" value=\"".$fileListInput[$key]."\" name=\"".($columnName.'input')."[]\" style=\"width:75px;margin-top:5px;float:left;\" /></span>" ;
						}
					}
					echo "</div></div><br /><div style=\"float:left;width:50%;padding-bottom:10px;padding-top:10px;margin-left:10px;\"><a href=\"./ajax/manyfilesortinput.php?height=400&amp;width=700&amp;columnen=".$columnName."&amp;page_status=modefy&amp;table=".$table."&amp;item=".$_GET['item']."&amp;manyfile=true&amp;\" title=\"排序\" class=\"manyfilesort thickbox\">排序</a></div><br />" ;
					echo "<div style=\"padding-top:10px;width:50%;float:left;\"><input type=\"file\" name=\"".$columnName."\" id=\"".$columnName."\" /></div>" ;
					break ;
			}
		}
		//型態4(date)
		if($columnStatus == 4)
		{
			switch($columnSelect)
			{
				case "date" :
				case "birth" :
					echo "<input type=\"text\" name=\"".$columnName."\" id=\"".$columnName."\" style=\"width:30%;\" class=\"".$class."\" value=\"".$columnValue."\" /><font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
				case "detail" :
					$timer = explode(" ",$columnValue) ;
					$timeDetail = explode(":" , $timer[1]) ;
					$hour = "" ;
					for($hourValue = 0 ; $hourValue < 24 ; $hourValue++ )
					{
						if( $hourValue == $timeDetail[0])
						{
							$selected = "selected" ;
						}
						else
						{
							$selected = "" ;
						}
						$hour .= "<option value=\"".sprintf("%02d", $hourValue)."\" ".$selected.">".sprintf("%02d", $hourValue)."</option>" ;
					}
					$mintue = "" ;
					for($mintueValue = 1 ; $mintueValue <= 60 ; $mintueValue++ )
					{
						if( $mintueValue == $timeDetail[1])
						{
							$selected = "selected" ;
						}
						else
						{
							$selected = "" ;
						}
						$mintue .= "<option value=\"".sprintf("%02d", $mintueValue)."\" ".$selected.">".sprintf("%02d", $mintueValue)."</option>" ;
					}
					$sec = "" ;
					for($secValue = 1 ; $secValue <= 60 ; $secValue++ )
					{
						if( $secValue == $timeDetail[2])
						{
							$selected = "selected" ;
						}
						else
						{
							$selected = "" ;
						}
						$sec .= "<option value=\"".sprintf("%02d", $secValue)."\" ".$selected.">".sprintf("%02d", $secValue)."</option>" ;
					}
					echo "<input type=\"text\" name=\"".$columnName."\" id=\"".$columnName."\" style=\"width:100px;\" class=\"".$class."\" value=\"".$timer[0]."\" /><select name=\"".$columnName."hour\" style=\"margin-left:5px;\"><option value=\"0\">時</option>".$hour."</select><select name=\"".$columnName."mintue\" style=\"margin-left:5px;\"><option value=\"0\">分</option>".$mintue."</select><select name=\"".$columnName."sec\" style=\"margin-left:5px;\"><option value=\"0\">秒</option>".$sec."</select><font style=\"color:#ff0000\">".$description."</font>" ;
					break ;
			}
		}
		//型態5(select)
		if($columnStatus == 5)
		{
			switch($columnSelect)
			{
				case "related" :
					$column = "";
					$explodecolumn = explode(",",$columnValue) ;
					foreach($option as $key => $value)
					{
						$level++ ;
						$column .="<select name=\"".$columnName.$level."\" class=\"labelselect\" ".$class.">" ;
						foreach($value as $key_in => $value_in)
						{
							$explodezone = $level -1 ;
							if($explodecolumn[$explodezone] == $key_in)
							{
								$focus = "selected" ;
							}
							else
							{
								$focus = "" ;
							}
							$column .= "<option value=\"".$key_in."\" ".$focus.">".$value_in."</option>" ;
						}
						$column .="</select>" ;
					}
					echo "<input type=\"hidden\" name=\"".$columnName."related\" value=\"".$level."\" />" ;
					break ;
				case "option" :
					$column ="<select name=\"".$columnName."\" ".$class.">" ;
					foreach($option as $key => $value)
					{
						if($columnValue == $key)
						{
							$focus = "selected" ;
						}
						else
						{
							$focus = "" ;
						}
						$column .= "<option value=\"".$key."\" ".$focus.">".$value."</option>" ;
					}
					$column .="</select>" ;
					
					break ;
			}
			echo $column ;
			echo "<font style=\"color:#ff0000\">".$description."</font>" ;
		}
		//型態6(checkbox)
		if($columnStatus == 6)
		{
			$column .= "<p style=\"width:100px;height:40px;\"><input type=\"checkbox\" name=\"selectall\" selectname=\"".$columnName."\" style=\"float:left;margin-top:2px;margin-right:4px;*margin:0px;\" /><font style=\"float:left;*margin-top:4px;width:80px;\">此項全選</font></p>";
			$explodecolumn = explode(",",$columnValue) ;
			switch($columnSelect)
			{
				case "option" :
					foreach($option as $key => $value)
					{
						if(in_array( $key , $explodecolumn) == true )
						{
							$focus = "checked" ;
						}
						else
						{
							$focus = "" ;
						}
						$column .= "<span class=\"muchbox\"><input type=\"checkbox\" name=\"".$columnName."[]\" value=\"".$key."\" ".$class." ".$focus."/><p>".$value."</p></span>" ;
					}
					break ;
			}
			echo $column ;
			echo "<font style=\"color:#ff0000\">".$description."</font><label style=\"display:none;\" for=\"".$columnName."[]\" class=\"error\">".$title."</label>" ;
		}
		//型態7(radio)
		if($columnStatus == 7)
		{
			switch($columnSelect)
			{
				case "option" :
					foreach($option as $key => $value)
					{
						if($columnValue == $key)
						{
							$focus = "checked" ;
						}
						else
						{
							$focus = "" ;
						}
						$column .= "<span class=\"muchbox\"><input type=\"radio\" name=\"".$columnName."\" value=\"".$key."\" ".$class." ".$focus." /><p>".$value."</p></span>" ;
					}
					break ;
			}
			echo $column ;
			echo "<font style=\"color:#ff0000\">".$description."</font><label style=\"display:none;\" for=\"".$columnName."\" class=\"error\">".$title."</label>" ;
		}
	}
/*
 * @ description : 欄位值顯示
 *
 *  $columnName   欄位名稱
 *  $columnStatus 欄位型態
 *  $columnSelect 型態選擇
 *	$columnValue  欄位值
 *  $option       選項值
 */
	function showColumn( $table , $columnName , $columnStatus , $columnSelect , $option , $columnValue , $manyinput2 )
	{
		//型態1(輸入)
		if($columnStatus == 1)
		{
			switch($columnSelect)
			{
				case "read" :
				case "number" :
				case "readonly" :
					echo $columnValue ;
					break ;
				case "password" :
					echo "此為密碼欄位不顯示" ;
					break ;
			}
		}
		//型態2(textarea)
		if($columnStatus == 2)
		{
			switch($columnSelect)
			{
				case "html" :
				case "value" :
					echo nl2br(stripslashes($columnValue)); 
					break ;
				case "nocode" :
					echo $columnValue ;
					break ;
				case "fck" :
					echo nl2br(stripslashes($columnValue)) ;
					break ;
				case "google" :
				case "detail" :
				case "basic" :
					$oFCKeditor = new FCKeditor($columnName) ;
					$oFCKeditor->BasePath = '../fckeditor/' ;
					$oFCKeditor->ToolbarSet = 'Null' ;
					$oFCKeditor->Width = '95%' ;
					$oFCKeditor->Height = '280' ;
					$oFCKeditor -> Value = stripslashes($columnValue) ;
					CKFinder::SetupFCKeditor($oFCKeditor , '../fckeditor/ckfinder/') ;
					$oFCKeditor->Create() ;
					break;
			}
		}
		//型態3(file)
		if($columnStatus == 3)
		{
			switch($columnSelect)
			{
				case "image" :
				case "nochangeimg" :
					if(!$columnValue)
					{
						echo "尚無上傳圖片" ;
					}
					else
					{
						echo "<a href=\"../upload/".$columnValue."\" class=\"lightbox\">原圖片請按此</a>" ;
					}
					break ;
				case "file" :
				case "nochangefile" :
					if(!$columnValue)
					{
						echo "尚無上傳檔案" ;
					}
					else
					{
						echo "<a href=\"../upload/".$columnValue."\">原檔案請按此</a>" ;
					}
					break ;
				case "manyfile" :
					$fileList = explode(",",$columnValue) ;
					$i = 0 ;
					foreach($fileList as $key => $value)
					{
						if($value != null)
						{
							$i++ ;
							$columnString .= "<span class=\"muchbox\"><a href=\"../upload/".$value."\" class=\"lightbox\" rel=\"".$columnName."\">原圖片請按此</a></span>" ;
						}
					}
					if($i != 0)
					{
						echo "<div style=\"float:left;width:600px;\">".$columnString."</div>" ;
					}
					break ;
				case "manyfileinput" :
					$fileList = explode(",",$columnValue) ;
					$fileListInput = explode(",",$manyinput2) ;
					$i = 0 ;
					foreach($fileList as $key => $value)
					{
						if($value != null)
						{
							$i++ ;
							$columnString .= "<span class=\"muchbox\"><a href=\"../upload/".$value."\" class=\"lightbox\" rel=\"".$columnName."\">原圖片請按此</a><p style=\"width:75px;margin-top:5px;float:left;\">".$fileListInput[$key]."</p></span>" ;
							//<input type=\"text\" value=\"".$fileListInput[$key]."\" name=\"".($columnName.'input')."[]\" style=\"width:75px;margin-top:5px;float:left;\" />
						}
					}
					if($i != 0)
					{
						echo "<div style=\"float:left;width:600px;\">".$columnString."</div>" ;
					}
					break ;
			}
		}
		//型態4(date)
		if($columnStatus == 4)
		{
			echo $columnValue ;
		}
		//型態5(select)
		if($columnStatus == 5)
		{
			switch($columnSelect)
			{
				case "related" :
					$showvalue = explode("," , $columnValue) ;
					foreach($option as $key => $value)
					{
						foreach($option[$key] as $key_in => $value_in)
						{
							if($key_in == $showvalue[$key-1])
							{
								$column .= "<span class=\"fontweight\">".$value_in."</span>" ;
							}
						}
					}
					break ;
				case "option" :
					foreach($option as $key => $value)
					{
						if($key == $columnValue)
						{
							$column .= $value ;
						}
					}
					break ;
			}
			echo $column ;
		}
		//型態6(checkbox)
		if($columnStatus == 6)
		{
			$showvalue = explode("," , $columnValue) ;
			foreach($option as $key => $value)
			{
				if(in_array( $key , $showvalue) == true )
				{
					$column .= "<span class=\"fontweight\">".$value."</span>" ;
				}
			}
			echo $column ;
		}
		//型態7(radio)
		if($columnStatus == 7)
		{
			switch($columnSelect)
			{
				case "option" :
					foreach($option as $key => $value)
					{
						if($key == $columnValue)
						{
							$column .= $value ;
						}
					}
					break ;
			}
			echo $column ;
		}
	}
}
?>