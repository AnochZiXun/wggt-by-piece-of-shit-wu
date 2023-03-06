$(document).ready(function(){
//表單防呆
$("#form").validate();
$.metadata.setType("attr", "validate");
//刪圖片
$('.clickimg').click(function(){
/*
	$(this).parent().next().attr('class','required') ;
	$(this).parent().remove() ;
	$.post('./ajax/ajaxdelfile.php',{'table':$(this).attr('thistable') , 'column':$(this).attr('thiscolumn') , 'value':$(this).attr('thisvalue') , 'item':$('#item').attr('value')},function(){},'json');
*/
	if (confirm("確定刪除此檔案？") == true )
	{
		//$(this).parent().next().attr('class','required') ;
		$(this).parent().parent().find('input[name^="columnvalue"]').val('') ;
		$(this).parent().remove() ;
		$.post('./ajax/ajaxdelfile.php',{'table':$(this).attr('thistable') , 'column':$(this).attr('thiscolumn') , 'value':$(this).attr('thisvalue') , 'item':$('#item').attr('value')},function(){},'json');
	}
}) ;
//多檔刪除
$('.clickimgs').click(function(){
	$(this).parent().remove() ;
	$.post('./ajax/ajaxdelfiles.php',{'table':$(this).attr('thistable') , 'column':$(this).attr('thiscolumn') , 'value':$(this).attr('thisvalue') , 'item':$('#item').attr('value')},function(){},'json');
}) ;
//Ajax表單
var options = {
	target: '#form',
	url: './ajax/ajaxupdate.php',
	type: 'POST',
	dataType: 'json',
	complete :function(){
		var url = 'inside.php?control='+$('#control').attr('value')+'&item='+$('#item').attr('value')+'&kind='+$('#kind').attr('value')+'&p='+$('#p').attr('value')+'&catelist='+$('#catelist').attr('value')+'&s_column='+$('#s_column').val()+'&s_keyword='+$('#s_keyword').val()+'&s_keyword1='+$('#s_keyword1').val() ;
		url = url.replace(/^.*#/, '');
		$.history.load(url);
		return false;

	}
	};
	$('#form').ajaxForm(options);
}) ;