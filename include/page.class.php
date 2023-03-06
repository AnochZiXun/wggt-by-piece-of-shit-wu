<?
/*
 *  @author : wu
 *  @description : 分頁class
 *  @version : 1.0 2010/03/24
*/
class SubPages
{   
	private $each_disNums;//每頁顯示資料筆數
	private $nums;//總資料數
	private $current_page;//當前被選中的頁
	private $sub_pages;//每次顯示的頁數
	private $pageNums;//總頁數   
	private $page_array = array();//用來構造分頁的數組   
	private $subPage_link;//每個分頁的鏈接   
	private $subPage_type;//顯示分頁的類型(目前共有二種類型，第一種為簡單，第二種為詳細)
/*  
__construct是SubPages的構造函數，用來在創建類別的時候自動運行.  
@$each_disNums 每頁顯示的資料數
@nums 總資料數
@current_num 當前被選中的頁  
@sub_pages 每次顯示的頁數  
@subPage_link 每個分頁的鏈接  
@subPage_type 顯示分頁的類型  
	
當@subPage_type=1的時候為普通分頁模式  
		example： 共4523條記錄,每頁顯示10條,當前第1/453頁 [第一頁] [上頁] [下頁] [最末頁]  
		當@subPage_type=2的時候為詳細分頁樣式  
		example： 當前第1/453頁 [第一頁] [上頁] 1 2 3 4 5 6 7 8 9 10 [下頁] [最末頁]  
		當@subPage_type=3的時候為巴哈姆特分頁樣式  
		example： 當前第1/453頁 1 2 3 4 5 [最末頁] [上一頁][下一頁]
		當@subPage_type=4的時候為精簡分頁樣式  
		example： 當前第1/453頁 1 2 3 4 5[下一頁]
*/  
	function __construct($each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$subPage_type)
	{
		$this->each_disNums=intval($each_disNums);   
		$this->nums=intval($nums);   
		if(!$current_page)
		{   
			$this->current_page=1;   
		}
		else
		{   
			$this->current_page=intval($current_page);   
		}   
		$this->sub_pages=intval($sub_pages);   
		$this->pageNums=ceil($nums/$each_disNums);   
		$this->subPage_link=$subPage_link;    
		$this->show_SubPages($subPage_type);    
		//echo $this->pageNums."--".$this->sub_pages;   

	}   
	
/*  
__destruct析構函數，當類別不在使用的時候調用，該函數用來釋放資源。  
*/  
	function __destruct()
	{   
		unset($each_disNums);   
		unset($nums);   
		unset($current_page);   
		unset($sub_pages);   
		unset($pageNums);   
		unset($page_array);   
		unset($subPage_link);   
		unset($subPage_type);   
	}   
	
/*  
show_SubPages函數用在構造函數里面。而且用來判斷顯示什麼樣子的分頁   
*/  
	function show_SubPages($subPage_type)
	{
		if($subPage_type == 1)
		{
			$this->subPageCss1();   
		}
		elseif ($subPage_type == 2)
		{
			$this->subPageCss2();   
		}
		elseif ($subPage_type == 3)
		{   
			$this->subPageCss3();   
		}
		elseif ($subPage_type == 4)
		{
			$this->subPageCss4();   
		}
		elseif ($subPage_type == 5)
		{
			$this->subPageCss5();   
		}
	}
	
	
/*  
用來給建立分頁的數組初始化的函數。  
*/  
	function initArray()
	{   
		for($i=0;$i<$this->sub_pages;$i++)
		{   
			$this->page_array[$i]=$i;   
		}   
		return $this->page_array;   
	}   
	
	
/*  
construct_num_Page該函數使用來構造顯示的條目  
即使：[1][2][3][4][5][6][7][8][9][10]  
*/  
	function construct_num_Page()
	{   
		if($this->pageNums < $this->sub_pages)
		{   
			$current_array=array();   
			for($i=0;$i<$this->pageNums;$i++)
			{    
				$current_array[$i]=$i+1;   
			}   
		}
		else
		{
			$current_array=$this->initArray();   
			if($this->current_page <= 3)
			{   
				for($i=0;$i<count($current_array);$i++)
				{   
					$current_array[$i]=$i+1;   
				}   
			}
			elseif ($this->current_page <= $this->pageNums && $this->current_page > $this->pageNums - $this->sub_pages + 1 )
			{   
				for($i=0;$i<count($current_array);$i++)
				{   
					$current_array[$i]=($this->pageNums)-($this->sub_pages)+1+$i;   
				}   
			}
			else
			{   
				for($i=0;$i<count($current_array);$i++)
				{   
					$current_array[$i]=$this->current_page-2+$i;   
				}   
			}   
		}   
		
		return $current_array;   
	}   
	
/*  
構造普通模式的分頁  
共4523條記錄,每頁顯示10條,當前第1/453頁 [第一頁] [上頁] [下頁] [最末頁]  
*/  
	function subPageCss1()
	{   
		$subPageCss1Str="";   
		$subPageCss1Str.="共".$this->nums."筆記錄，";   
		$subPageCss1Str.="每頁顯示".$this->each_disNums."筆，";   
		$subPageCss1Str.="目前第".$this->current_page."/".$this->pageNums."頁 ";   
		if($this->current_page > 1)
		{   
			$firstPageUrl=$this->subPage_link."1";   
			$prewPageUrl=$this->subPage_link.($this->current_page-1);   
			$subPageCss1Str.="[<a href='".$firstPageUrl."'>第一頁</a>] ";   
			$subPageCss1Str.="[<a href='".$prewPageUrl."'>上一頁</a>] ";   
		}
		else 
		{   
			$subPageCss1Str.="[第一頁] ";   
			$subPageCss1Str.="[上一頁] ";   
		}   
		
		if($this->current_page < $this->pageNums)
		{   
			$lastPageUrl=$this->subPage_link.$this->pageNums;   
			$nextPageUrl=$this->subPage_link.($this->current_page+1);   
			$subPageCss1Str.=" [<a href='".$nextPageUrl."'>下一頁</a>] ";   
			$subPageCss1Str.="[<a href='".$lastPageUrl."'>最末頁</a>] ";   
		}
		else 
		{   
			$subPageCss1Str.="[下一頁] ";   
			$subPageCss1Str.="[最末頁] ";   
		}   
		
		echo $subPageCss1Str;   
		
	}   
	
	
/*  
構造經典模式的分頁  
當前第1/453頁 [第一頁] [上頁] 1 2 3 4 5 6 7 8 9 10 [下頁] [最末頁]  
*/  
	function subPageCss2()
	{   
		$subPageCss2Str="";   
		$subPageCss2Str.="目前第".$this->current_page."/".$this->pageNums."頁 ";   

		if($this->current_page > 1)
		{   
			$firstPageUrl=$this->subPage_link."1";   
			$prewPageUrl=$this->subPage_link.($this->current_page-1);   
			$subPageCss2Str.="&nbsp;<a href='".$firstPageUrl."'>第一頁</a>&nbsp; ";   
			$subPageCss2Str.="&nbsp;<a href='".$prewPageUrl."'>上一頁</a>&nbsp; ";   
		}
		else 
		{   
			$subPageCss2Str.="&nbsp;第一頁&nbsp; ";   
			$subPageCss2Str.="&nbsp;上一頁&nbsp; ";   
		}   
		
		$a=$this->construct_num_Page();   
		for($i=0;$i<count($a);$i++)
		{   
			$s=$a[$i];   
			if($s == $this->current_page )
			{   
				$subPageCss2Str.="&nbsp;<span style='color:#000000;font-weight:bold;'>".$s."</span>&nbsp;";   
			}
			else
			{   
				$url=$this->subPage_link.$s;   
				$subPageCss2Str.="&nbsp;<a href='".$url."'>".$s."</a>&nbsp;";   
			}   
		}   
		
		if($this->current_page < $this->pageNums)
		{   
			$lastPageUrl=$this->subPage_link.$this->pageNums;   
			$nextPageUrl=$this->subPage_link.($this->current_page+1);   
			$subPageCss2Str.=" &nbsp;<a href='".$nextPageUrl."'>下一頁</a>&nbsp; ";   
			$subPageCss2Str.="&nbsp;<a href='".$lastPageUrl."'>最末頁</a>&nbsp; ";   
		}
		else 
		{   
			$subPageCss2Str.="&nbsp;下一頁&nbsp; ";   
			$subPageCss2Str.="&nbsp;最末頁&nbsp; ";   
		}   
		echo $subPageCss2Str;   
	}
/*
構造巴哈姆特式分頁
example： 當前第1/453頁 1 2 3 4 5 [最末頁] [上一頁][下一頁]
*/
	function subPageCss3()
	{   
		$subPageCss3Str="";
		$a=$this->construct_num_Page();   
		for($i=0;$i<count($a);$i++)
		{   
			$s=$a[$i];   
			if($s == $this->current_page )
			{   
				$subPageCss3Str.="<font style='float:left;margin-left:2px;width:13px;height:18px;background-color:#fea660;border:1px solid #dec035;color:#ffffff;text-align:center;line-height:18px;'>".$s."</font>";   
			}
			else
			{   
				$url=$this->subPage_link.$s;   
				$subPageCss3Str.="<font style='float:left;margin-left:2px;width:13px;height:18px;background-color:#fea660;border:1px solid #dec035;text-align:center;line-height:18px;'><a href='".$url."' style='color:#ffffff;'>".$s."</a></font>";   
			}   
		}
		if($this->current_page < $this->pageNums)
		{   
			$lastPageUrl=$this->subPage_link.$this->pageNums;   
			$nextPageUrl=$this->subPage_link.($this->current_page+1);   
			$subPageCss3Str.="<font style='float:right;width:50px;height:17px;background-color:#feffdb;border:1px solid #dec035;text-align:center;line-height:18px;margin-left:7px;display:inline;'><a href='".$nextPageUrl."' style='color:#000000;'>下一頁</a></font>";   
			$subPageCss3Str.="<font style='float:left;width:43px;height:18px;background-color:#feffdb;border:1px solid #dec035;text-align:center;line-height:18px;margin-left:10px;color:#000000;'><a href='".$lastPageUrl."' style='color:#000000'>最末頁</a></font>";   
		}
		else 
		{   
			$subPageCss3Str.="<font style='float:right;width:50px;height:17px;background-color:#feffdb;border:1px solid #dec035;text-align:center;line-height:18px;margin-left:7px;display:inline;'>下一頁</font>";   
			$subPageCss3Str.="<font style='float:left;width:43px;height:18px;background-color:#feffdb;border:1px solid #dec035;text-align:center;line-height:18px;margin-left:10px;color:#000000;'>最末頁</font>";   
		}
		if($this->current_page > 1)
		{
			$prewPageUrl=$this->subPage_link.($this->current_page-1);   
			$subPageCss3Str.="<font style='float:right;width:50px;height:17px;background-color:#feffdb;border:1px solid #dec035;text-align:center;line-height:18px;display:inline;'><a href='".$prewPageUrl."' style='color:#000000;'>上一頁</a></font>";   
		}
		else 
		{
			$subPageCss3Str.="<font style='float:right;width:50px;height:17px;background-color:#feffdb;border:1px solid #dec035;text-align:center;line-height:18px;display:inline;'>上一頁</font>";   
		}
		echo $subPageCss3Str;   
	}
/*
構造KARAMAX分頁
example： 當前第1/453頁 1 2 3 4 5[next.►]
*/
	function subPageCss4()
	{
		$subPageCss4Str="";   
		
		if($this->current_page > 1)
		{
			$firstPageUrl=$this->subPage_link."1";   
			$prewPageUrl=$this->subPage_link.($this->current_page-1);   
			$subPageCss4Str.="<li style='display:inline;font-size:12px;color:#1e6668;margin-right:15px;'><a href='".$firstPageUrl."' style='color:#1e6668;display:inline-block;'>Page1</a></li>";   
			$subPageCss4Str.="<li style='display:inline;font-size:12px;color:#1e6668;margin-right:15px;'><a href='".$prewPageUrl."' style='color:#1e6668;display:inline-block;'>◄Prev</a></li>";   
		}
		
		$a=$this->construct_num_Page();   
		for($i=0;$i<count($a);$i++)
		{
			$s=$a[$i];   
			if($s == $this->current_page )
			{
				$subPageCss4Str.="<li style='margin-left:4px;display:inline;text-align:center;line-height:25px;'>".$s."</li>";   
			}
			else
			{
				$url=$this->subPage_link.$s;   
				$subPageCss4Str.="<li style='margin-left:4px;display:inline;text-align:center;line-height:25px;'><a href='".$url."' style='width:15px;height:25px;background-color:#1e6668;color:#ffffff;display:inline-block;'>".$s."</a></li>";   
			}
		}
		if($this->current_page < $this->pageNums)
		{
			$lastPageUrl=$this->subPage_link.$this->pageNums;   
			$nextPageUrl=$this->subPage_link.($this->current_page+1);   
			$subPageCss4Str.=" <li style='display:inline;font-size:22px;color:#1e6668;margin-left:15px;'><a href='".$nextPageUrl."' style='font-size:12px;color:#1e6668;display:inline-block;'>Next►</a></li>";
			$subPageCss4Str.="<li style='display:inline;font-size:22px;color:#1e6668;margin-left:15px;'><a href='".$lastPageUrl."' style='font-size:12px;color:#1e6668;display:inline-block;'>End</a></li>";   
		}
		echo $subPageCss4Str;   
	}
	
/*
LED模式
example 第一頁 上一頁 1 2 3 4 5  下頁 最後一頁  
*/
	function subPageCss5()
	{
		$subPageCss5Str="";   
		if($this->current_page < $this->pageNums)
		{
			$lastPageUrl=$this->subPage_link.$this->pageNums;   
			$nextPageUrl=$this->subPage_link.($this->current_page+1);   
			$subPageCss5Str.="<li style='display:inline;text-align:center;float:right;width:70px;'><a href='".$lastPageUrl."' style=''>最末頁</a></li>";   
			$subPageCss5Str.=" <li style='display:inline;text-align:center;float:right;width:70px;'><a href='".$nextPageUrl."' style=''>下一頁</a></li>";
			
		}
		else 
		{   
			$subPageCss5Str.="<li style='display:inline;text-align:center;float:right;width:70px;'>最末頁</li>";   
			$subPageCss5Str.="<li style='display:inline;text-align:center;float:right;width:70px;'>下一頁</li>";   
		}
		if($this->current_page > 1)
		{
			$firstPageUrl=$this->subPage_link."1";   
			$prewPageUrl=$this->subPage_link.($this->current_page-1);   
			$subPageCss5Str.="<li style='display:inline;text-align:center;float:left;width:70px;'><a href='".$firstPageUrl."' style='color:#000000;'>第一頁</a></li>";   
			$subPageCss5Str.="<li style='display:inline;text-align:center;float:left;width:70px;'><a href='".$prewPageUrl."' style='color:#000000;'>上一頁</a></li>";   
		}
		else 
		{
			$subPageCss5Str.="<li style='display:inline;text-align:center;float:left;width:70px;'>第一頁</li>";   
			$subPageCss5Str.="<li style='display:inline;text-align:center;float:left;width:70px;'>上一頁</li>";
		}

		$a=$this->construct_num_Page();   
		for($i=0;$i<count($a);$i++)
		{
			$s=$a[$i];   
			if($s == $this->current_page )
			{
				$subPageCss5Str.="<li style='width:15px;text-align:center;display:inline;margin-left:5px;margin-right:5px;color:#ff0000;'>".$s."</li>";   
			}
			else
			{
				$url=$this->subPage_link.$s;   
				$subPageCss5Str.="<li style='width:15px;text-align:center;display:inline;margin-left:5px;margin-right:5px;'><a href='".$url."' style='color:#000000;display:inline-blok;'>".$s."</a></li>";   
			}
		}
		echo $subPageCss5Str;   
	}
}
?>   