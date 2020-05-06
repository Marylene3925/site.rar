tinyMCE.init({
	mode : "exact",
	elements : "descriptif,descriptif_fr,descriptif_en,temoignage",
	theme : "advanced",
	skin : "o2k7",
	skin_variant : "silver",
	language : "fr",
	
	maxlength : 1000, //maxlength
	maxlength_callback: //function fired when content length is too long
    function(length)
    {
      //alert('Your content is too long' + length);
    },
	
	plugins : "maxlength,safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
	
	theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,forecolor,backcolor",
	theme_advanced_buttons2 : "bullist,numlist,|,link,unlink,|,sub,sup,charmap,|,pasteword,removeformat",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	
	extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]"
});