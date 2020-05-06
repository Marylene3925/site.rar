function OpenPopup(nomPage, width, height) { 
    
	window.open (nomPage, "", 
				"width=" + width + 
				",height=" + height + 
				",left=" + ((screen.availWidth - width)/2) + 
				",top=" + ((screen.availHeight - height)/2) + 
				"location=no, status=no, toolbar=no, resizable=yes, scrollbars=no, menubar=no"
	) 
}