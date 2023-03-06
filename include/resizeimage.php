<? 
/*
 *  @author : wu
 *  @version : 1.0 2010/03/02
 *  功 能：利用PHP的GD函式生成高質量縮圖
 *  運行環境:PHP5.01/GD2
 
 *  類別說明：高精度的縮圖類別
可以選擇是/否裁圖，是/否放大圖像。

如果裁圖則生成的圖的尺寸與您輸入的一樣。 
原則：盡可能保持原圖完整 

如果不裁圖，則按照原圖比例生成新圖 
原則：根據比例以輸入的長或者寬為基準

如果不放大圖像，則當原圖尺寸不大於新圖尺寸時，維持原圖尺寸

@$imgout        輸出圖片的位址
@$imgsrc        源圖片位址
@$width         新圖的寬度 
@$height        新圖的高度 
@$cut           是否裁圖，1為是，0為否
@$enlarge       是否放大圖像，1為是，0為否
@photostatus    圖片態型 


 * example  以下將產生一個寬x高不超過320x240的縮圖：
$resizeimage = new resizeimage('upload/imgout.jpg', 'upload/imgsrc.jpg', 320, 240,'0','0');
*/ 
class resizeimage 
{
	//圖片類型 
	var $type; 
	//實際寬度 
	var $width; 
	//實際高度 
	var $height; 
	//改變後的寬度 
	var $resize_width; 
	//改變後的高度 
	var $resize_height; 
	//是否裁圖 
	var $cut; 
	//是否放大圖像
	var $enlarge; 
	//來源圖檔 
	var $srcimg; 
	//目標圖檔位址 
	var $dstimg; 
	//臨時建立的圖檔 
	var $im; 
	//回傳狀態
	var $status;

	function resizeimage($imgout, $imgsrc, $width, $height,$cut,$enlarge) 
	{ 
		//目標圖檔位址 
		$this->dstimg = $imgout; 
		//來源圖檔 
		$this->srcimg = $imgsrc; 
		//改變後的寬度
		$this->resize_width = $width; 
		//改變後的高度
		$this->resize_height = $height; 
		//是否裁圖 
		$this->cut = $cut; 
		//是否放大圖像
		$this->enlarge = $enlarge;
		//初始化圖檔 
		$this->initi_img(); 
		//來源圖檔實際寬度
		$this->width = imagesx($this->im); 
		//來源圖檔實際高度
		$this->height = imagesy($this->im); 
		//生成新圖檔 
		$this->newimg(); 
		//結束圖形
		ImageDestroy ($this->im); 
	} 
	function newimg() 
	{ 
		if(($this->cut)=="1") 
		//裁圖 
		{ 
			if($this->enlarge=='0')//不放大圖像，只縮圖
			{
				//調整輸出的圖片大小，如不超過指定的大小則維持原大小
				if($this->resize_width < $this->width)
				$resize_width = $this->resize_width;
				else
				$resize_width = $this->width;

				if($this->resize_height < $this->height)
				$resize_height = $this->resize_height;
				else
				$resize_height = $this->height;
			}
			else//放大圖像
			{
				$resize_width = $this->resize_width;
				$resize_height = $this->resize_height;
			}

			//改變後的圖檔的比例 
			$resize_ratio = ($this->resize_width)/($this->resize_height); 
			//實際圖檔的比例 
			$ratio = ($this->width)/($this->height); 

			if($ratio>=$resize_ratio) 
			//高度優先 
			{ 
				$newimg = imagecreatetruecolor($resize_width,$resize_height); 
				//生成白色背景
				$white = imagecolorallocate($newimg, 255, 255, 255);
				imagefilledrectangle($newimg,0,0,$resize_width,$resize_height,$white);
				imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $resize_width,$resize_height, (($this->height)*$resize_ratio), $this->height); 
				$this->status = ImageJpeg ($newimg,$this->dstimg); 
			} 
			if($ratio<$resize_ratio) 
			//寬度優先 
			{ 
				$newimg = imagecreatetruecolor($resize_width,$resize_height); 
				//生成白色背景
				$white = imagecolorallocate($newimg, 255, 255, 255);
				imagefilledrectangle($newimg,0,0,$resize_width,$resize_height,$white);
				imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $resize_width, $resize_height, $this->width, (($this->width)/$resize_ratio)); 
				$this->status = ImageJpeg ($newimg,$this->dstimg); 
			} 
		} 
		else 
		//不裁圖 
		{ 
			if($this->enlarge=='0')//不放大圖像，只縮圖
			{
				//調整輸出的圖片大小，如不超過指定的大小則維持原大小
				if($this->resize_width < $this->width)
				{
					$resize_width = $this->resize_width;
				}
				else
				{
					$resize_width = $this->width;
				}

				if($this->resize_height < $this->height)
				{
					$resize_height = $this->resize_height;
				}
				else
				{
					$resize_height = $this->height;
				}
			}
			else//放大圖像
			{
				$resize_width = $this->resize_width;
				$resize_height = $this->resize_height;
			}

			//改變後的圖檔的比例 
			$resize_ratio = ($this->resize_width)/($this->resize_height); 
			//實際圖檔的比例 
			$ratio = ($this->width)/($this->height); 

			if($this->width>=$this->height) //圖片較寬
			{
				$newimg = imagecreatetruecolor($resize_width,($resize_width)/$ratio); 
				//生成白色背景
				$white = imagecolorallocate($newimg, 255, 255, 255);
				imagefilledrectangle($newimg,0,0,$resize_width,($resize_width)/$ratio,$white);
				imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, $resize_width, ($resize_width)/$ratio, $this->width, $this->height); 
				$this->status = ImageJpeg ($newimg,$this->dstimg); 
			} 
			if($this->width<$this->height) //圖片較高
			{
				$newimg = imagecreatetruecolor(($resize_height)*$ratio,$resize_height); 
				//生成白色背景
				$white = imagecolorallocate($newimg, 255, 255, 255);
				imagefilledrectangle($newimg,0,0,($resize_height)*$ratio,$resize_height,$white);
				imagecopyresampled($newimg, $this->im, 0, 0, 0, 0, ($resize_height)*$ratio, $resize_height, $this->width, $this->height); 
				$this->status = ImageJpeg ($newimg,$this->dstimg); 
			} 
		} 
	} 
	//初始化圖檔 
	function initi_img() 
	{ 
		//取得圖片的類型 
		$getimgdata=@getimagesize($this->srcimg);
		$this->type = $getimgdata['mime']; 

		//根據類型選擇讀取方式
		if($this->type=='image/gif') 
		{ 
			$this->im = imagecreatefromgif($this->srcimg); 
		} 
		else if($this->type=='image/png') 
		{ 
			$this->im = imagecreatefrompng($this->srcimg); 
		} 
		else
		{ 
			$this->im = imagecreatefromjpeg($this->srcimg); 
		} 
	} 
}
?>