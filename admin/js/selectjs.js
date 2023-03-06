function downToggle(self,id)
{
	$(id).toggle();
	$(self).click(function(event){
		event.stopPropagation();
	});
	$(id + ' a').click(function(){
		lang = $(this).attr('rel') ;
		$('input[name=language]').val(lang) ;		
		val=$(this).html();
		$(self).val(val);
		$(id).hide();
	});
}