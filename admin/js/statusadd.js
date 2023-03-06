$(document).ready(function(){
//表單防呆
$("#form").validate();
$.metadata.setType("attr", "validate");
//Ajax表單
var options = {
	target: '#form',
	url: './ajax/ajaxadd.php',
	type: 'POST',
	dataType: 'json',
	complete :function(){
		var url = 'inside.php?control='+ $('#control').attr('value') +'&kind='+$('#kind').attr('value')+'&p='+$('#p').attr('value')+'&catelist='+$('#catelist').attr('value') ;
		url = url.replace(/^.*#/, '');
		$.history.load(url);
		return false;
	}
	};
	$('#form').ajaxForm(options);
}) ;