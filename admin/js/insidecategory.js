$(document).ready(function(){
//選單展開縮起
	$('.categoryImg').click(function(){
		if($(this).attr('src') == 'images/h.gif')
		{
			$(this).attr('src' , 'images/n.gif');
		}
		else
		{
			$(this).attr('src' , 'images/h.gif');
		}
		$(this).parent().next().toggle() ;
	}) ;
//滑鼠移到字時變色
	$('#category h2').hover(function(){
		$(this).css('color','#4f8ad1') ;
	},function(){
		$(this).css('color','#000000') ;
	}) ;
//檢視
	$('#category h2').click(function(){
		//$('#mainContent').load( 'status.php' + $(this).attr('thishref') ) ;
		var url = 'status.php' + $(this).attr('thishref') ;
		url = url.replace(/^.*#/, '');
		$.history.load(url);
		return false;
	}) ;
//新增
	$('.categoryAdd').click(function(){
		//$('#mainContent').load( 'status.php' + $(this).attr('thishref') ) ;
		var url = 'status.php' + $(this).attr('thishref') ;
		url = url.replace(/^.*#/, '');
		$.history.load(url);
		return false;
	}) ;
//修改
	$('.categoryModefy').click(function(){
		//$('#mainContent').load( 'status.php' + $(this).attr('thishref') ) ;
		var url = 'status.php' + $(this).attr('thishref') ;
		url = url.replace(/^.*#/, '');
		$.history.load(url);
		return false;
	}) ;
//刪除
	$('.categoryDelete').click(function(){
		if(confirm("是否刪除此資料(包含此資料底層全部資料！)"))
		{
			$.post('./ajax/ajaxdel.php',{'table':$(this).attr('thistable') , 'item':$(this).attr('thisitem') , 'postkind':'category' },function(){},'json');
			$(this).parent().parent().remove() ;
		}
	});
});