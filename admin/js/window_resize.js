var currentClientHeight = 0 ;
var resizeWindow = function () 
{
	if (currentClientHeight != document.documentElement.clientHeight) 
	{
		var menu = document.getElementById('mainMenu');
		if(parseInt(navigator.appVersion)>3) 
		{
			if(navigator.appName=="Netscape") 
			{
				winH = window.innerHeight;
				changeHeight = winH - 159+'px';
			}
			if(navigator.appName.indexOf("Microsoft")!=-1) 
			{
				winH = document.documentElement.clientHeight;
				changeHeight = winH - 159+'px';
			}
			if(window.XMLHttpRequest)
			{
				menu.style.minHeight = changeHeight;
			}
			else
			{
				menu.style.height = changeHeight;
			}
		}
	}
	currentClientHeight = document.documentElement.clientHeight;
};