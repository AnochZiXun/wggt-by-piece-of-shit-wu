$(document).ready(function(){
//分頁
	$('#page a').click(function(){
		var url = $(this).attr('rel') ;
		url = url.replace(/^.*#/, '');
		$.history.load(url);
		return false;
	});
//全選反選
	$("#selectall").click(function() {
	   if( $(this).attr("checked") )
	   {
		 $("input[name='checkitem[]']").each(function() {
			 $(this).attr("checked", true);
		 });
	   }
	   else
	   {
		 $("input[name='checkitem[]']").each(function() {
			 $(this).attr("checked", false);
		 });           
	   }
	});
//多選刪除
	$('#delIcon').click(function(){
		if(confirm("是否刪除勾選資料"))
		{
			var delthisitem = "" ;
			var deltotal = 0 ;
			$("input[name='checkitem[]']").each(function(){
				deltotal++ ;
				if( $(this).attr("checked") == true )
				{
					delthisitem += $(this).attr('value') + '.' ;
				}
			}) ;

			if( $('input[name="thisPageNums"]').attr('value') == deltotal )
			{
				sendPage = $('input[name="delpage"]').attr('value') -1 ;
			}
			else
			{
				sendPage = $('input[name="delpage"]').attr('value') ;
			}
			$.post('./ajax/ajaxdel.php',{'table':$('.deleteMenu').attr('thistable') , 'item':delthisitem , 'postkind':'muchdata' , 'page':sendPage , 'control':$('.deleteMenu').attr('thiscontrol')},function(response){
				$('#mainContent').load('inside.php?control='+response.control+'&kind='+response.kind+'&p='+response.page) ;
			},'json');
		}
	});
//檢視
	$('.linkshow').click(function(){
		var url = 'status.php' + $(this).attr('thishref') ;
		url = url.replace(/^.*#/, '');
		$.history.load(url);
		return false;
	}) ;
//新增
	$('#addIcon').click(function(){
		var url = 'status.php' + $(this).attr('thishref') ;
		url = url.replace(/^.*#/, '');
		$.history.load(url);
		return false;
	});
//修改
	$('.modefyMenu').click(function(){
		var url = 'status.php' + $(this).attr('thishref') ;
		url = url.replace(/^.*#/, '');
		$.history.load(url);
		return false;
	});
//刪除
	$('.deleteMenu').click(function(){
		if(confirm("是否刪除此資料"))
		{
			if( $('input[name="thisPageNums"]').attr('value') == 1 )
			{
				sendPage = $('input[name="delpage"]').attr('value') -1 ;
			}
			else
			{
				sendPage = $('input[name="delpage"]').attr('value') ;
			}
			$.post('./ajax/ajaxdel.php',{'table':$(this).attr('thistable') , 'item':$(this).attr('thisitem') , 'postkind':'data' , 'page':sendPage , 'control':$(this).attr('thiscontrol')},function(response){
				$('#mainContent').load('inside.php?control='+response.control+'&kind=1&p='+response.page) ;
			},'json');
		}
	});
//全部排序載入頁面
	$('#sortIcon').click(function(){
		//$('#mainContent').load('sortall.php' + $(this).attr('thishref')) ;
		var url = 'sortall.php' + $(this).attr('thishref') ;
		url = url.replace(/^.*#/, '');
		$.history.load(url);
		return false;
	}) ;
//箭頭上下排序
	$('.sortup').click(function(){
		nowsort = $(this).parent().parent().html() ;
		upsort  = $(this).parent().parent().prev().html() ;
		nowitem = $(this).attr('nowitem') ;
		upitem  = $(this).parent().parent().prev().find('.sortup').attr('nowitem') ;
		if(upsort != null && upitem != undefined)
		{
			$.post('./ajax/ajaxsortup.php',{'table':$(this).attr('thistable') , 'nowitem':nowitem , 'upitem':upitem , 'page':$(this).attr('nowpage') , 'kind':$(this).attr('thiskind') , 'control':$(this).attr('thiscontrol') },function(response){
				$('#mainContent').load('inside.php?control='+response.control+'&kind='+response.kind+'&p='+response.page) ;
			},'json');
		}
		else
		{
			$.post('./ajax/ajaxsortup.php',{'table':$(this).attr('thistable') , 'nowitem':nowitem , 'upitem':upitem , 'page':$(this).attr('nowpage') , 'kind':$(this).attr('thiskind') , 'control':$(this).attr('thiscontrol') },function(response){
				var url = 'inside.php?control='+response.control+'&kind='+response.kind+'&p='+(response.page-1) ;
				url = url.replace(/^.*#/, '');
				$.history.load(url);
				return false;
			},'json');
		}
	}) ;
	$('.sortdown').click(function(){
		nowsort = $(this).parent().parent().html() ;
		downsort  = $(this).parent().parent().next().html() ;
		nowitem = $(this).attr('nowitem') ;
		downitem  = $(this).parent().parent().next().find('.sortdown').attr('nowitem') ;
		if(downsort != null && downitem != undefined)
		{
			$.post('./ajax/ajaxsortdown.php',{'table':$(this).attr('thistable') , 'nowitem':nowitem , 'downitem':downitem , 'page':$(this).attr('nowpage') , 'kind':$(this).attr('thiskind') , 'control':$(this).attr('thiscontrol') },function(response){
				$('#mainContent').load('inside.php?control='+response.control+'&kind='+response.kind+'&p='+response.page) ;
			},'json');
		}
		else
		{
			$.post('./ajax/ajaxsortdown.php',{'table':$(this).attr('thistable') , 'nowitem':nowitem , 'downitem':downitem , 'page':$(this).attr('nowpage') , 'kind':$(this).attr('thiskind') , 'control':$(this).attr('thiscontrol') },function(response){
				if( $('input[name="checkNumsPage"]').val() == "yes" )
				{
				
					var url = 'inside.php?control='+response.control+'&kind='+response.kind+'&p='+(parseInt(response.page)+1) ;
				}
				else
				{
					var url = 'inside.php?control='+response.control+'&kind='+response.kind+'&p='+response.page ;
				}
				url = url.replace(/^.*#/, '');
				$.history.load(url);
				return false;
			},'json');
		}
	}) ;
//直接修改下拉選單的值
	$('.columnShow select').change(function(){
		$.post('./ajax/ajaxinside.php',{'table':$(this).attr('thistable') , 'item':$(this).attr('thisitem') , 'name':$(this).attr('name') , 'value':$(this,"selected").val() },function(){},'json');
	}) ;
//LightBox
	$(".lightbox").lightbox({fitToScreen: true});
//搜尋
	$('#searchForm').click(function(){
		$('select[name="s_column"]').each(function(){
			Column = $(this,"selected").val() ;
		}) ;
		Keywords = $('#s_keyword').val() ;
		Keywords1 = $('#s_keyword1').val() ;
		var url = 'inside.php?control='+ $('#control').attr('value') +'&kind='+$('#kind').attr('value')+'&s_column='+escape(Column)+'&s_keyword='+escape(Keywords)+'&s_keyword1='+escape(Keywords1) ;
		url = url.replace(/^.*#/, '');
		$.history.load(url);
		return false;
	}) ;
//搜尋下拉選單
	$('select[name="s_column"]').change(function(){
		if( $(this).val() == '' )
		{
			var url = 'inside.php?control='+ $('#control').attr('value') +'&kind='+$('#kind').attr('value') ;
			url = url.replace(/^.*#/, '');
			$.history.load(url);
			return false;
		}
		else
		{
			$('option:selected', this).each(function(){
				if( $(this).attr('thisOpstatus') == 'number' )
				{//數字
					$('#searchColumnSelect').html("<input type=\"text\" name=\"s_keyword\" id=\"s_keyword\" style=\"width:68px;\" />至<input type=\"text\" name=\"s_keyword1\" id=\"s_keyword1\" style=\"width:68px;\" />") ;
				}
				else if( $(this).attr('thisOpstatus') == 'birth' )
				{//生日
					$('#searchColumnSelect').html("<input type=\"text\" name=\"s_keyword\" id=\"s_keyword\" style=\"width:68px;\" />至<input type=\"text\" name=\"s_keyword1\" id=\"s_keyword1\" style=\"width:68px;\" />") ;
					$('#s_keyword').datepick({dateFormat: 'yy-mm-dd',yearRange:"-60:+0"});
					$('#s_keyword1').datepick({dateFormat: 'yy-mm-dd',yearRange:"-60:+0"});
				}
				else if( $(this).attr('thisOpstatus') == 'date' )
				{//日期
					$('#searchColumnSelect').html("<input type=\"text\" name=\"s_keyword\" id=\"s_keyword\" style=\"width:68px;\" />至<input type=\"text\" name=\"s_keyword1\" id=\"s_keyword1\" style=\"width:68px;\" />") ;
					$('#s_keyword').datepick({dateFormat: 'yy-mm-dd',yearRange:"-5:+5"});
					$('#s_keyword1').datepick({dateFormat: 'yy-mm-dd',yearRange:"-5:+5"});
				}
				else if( $(this).attr('thisOpstatus') == 'option' )
				{//下拉選單
					var optionValue = $(this).attr('thisOpValue') ;
					optionValue = replaceAll( optionValue , '!!' , '"') ;
					optionValue = replaceAll( optionValue , ':f' , '<') ;
					optionValue = replaceAll( optionValue , ':l' , '>') ;
					$('#searchColumnSelect').html("<select name=\"s_keyword\" id=\"s_keyword\">"+ optionValue +"</select>") ;
				}
				else
				{//一般輸入框
					$('#searchColumnSelect').html("<input type=\"text\" name=\"s_keyword\" id=\"s_keyword\" />") ;
				}
			});
		}
	}) ;
//匯出Excel
	$('#excelIcon').click(function(){
		$table = $(this).attr('thisTable') ;
		$.post('./ajax/excelout.php',{'control':$(this).attr('thisControl') },function(){
			location.href = '../upload/excel/download.php?table='+$table ;
		},'json');
	}) ;
}) ;

function replaceAll(strOrg,strFind,strReplace)
{//replace字串取代(全部)
	var index = 0;
	while(strOrg.indexOf(strFind,index) != -1)
	{
		strOrg = strOrg.replace(strFind,strReplace);
		index = strOrg.indexOf(strFind,index);
	}
	return strOrg
}