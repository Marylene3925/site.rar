	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+d.toUTCString();
		//Definir le path est important sinon, le cookie s'enregistre à plusieurs endroits (doublons)
		document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/";
	}
	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i=0; i<ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1);
			if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
		}
		return "";
	}

(function($) {
"use strict";


	
	
	
	//disclaimer cookies
	var css_disclaimer_cookie = ' style="display:none; position:fixed; bottom:0; left:0; width:100%; padding:40px 10px; z-index:99999999; background:#333; color:#fff; font-size:16px;" ';
	var css_disclaimer_cookie_button_ok = ' style="display:inline-block; padding: 20px; margin-left:30px; background:#fff; color:#000; font-size:16px;" ';
	var css_disclaimer_cookie_link_normal = ' style="color:#fff; font-size:16px; text-decoration:underline;" ';
	
	
	if (getCookie('WG_disclaimer_cookies') == '') {
		
		$("body").append(
			'<div class="disclaimer_cookie" ' + css_disclaimer_cookie + '>' +
				'Ce site utilise des cookies. Pour en savoir plus <a ' + css_disclaimer_cookie_link_normal + ' href="politique-confidentialite.php">cliquez ici</a>. En poursuivant votre navigation sur ce site, vous acceptez l\'utilisation des cookies.' +
				'<a ' + css_disclaimer_cookie_button_ok + ' href="javascript:;" onclick="setCookie(\'WG_disclaimer_cookies\', \'1\', 99); this.parentNode.style.display = \'none\';" class="button_ok">OK</a>' +
			'</div>'
		);
		
		$(".disclaimer_cookie").show();
	}




/* ==============================================
ACCORDION -->
=============================================== */

    function toggleChevron(e) {
        $(e.target)
            .prev('.panel-heading')
            .find("i.indicator")
            .toggleClass('fa-angle-down fa-angle-right');
    }
    $('#accordion').on('hidden.bs.collapse', toggleChevron);
    $('#accordion').on('shown.bs.collapse', toggleChevron);

/* ---------------------------------------------
WINDOWS HEIGHT JS -->
 --------------------------------------------- */

    $(".js-height-full").height($(window).height());
        $(".js-height-parent").each(function(){
        $(this).height($(this).parent().first().height());
    });

/* ==============================================
FUN -->
=============================================== */

    function count($this){
        var current = parseInt($this.html(), 10);
        current = current + 10;
        $this.html(++current);
        if(current > $this.data('count')){
        $this.html($this.data('count'));
        } 
        else {    
        setTimeout(function(){count($this)}, 10);
        }
        }        
        $(".stat-count").each(function() {
        $(this).data('count', parseInt($(this).html(), 10));
        $(this).html('0');
        count($(this));
    });

/* ==============================================
ANIMATION -->
=============================================== */

    new WOW({
      boxClass:     'wow',      // default
      animateClass: 'animated', // default
      offset:       0,          // default
      mobile:       false,       // default
      live:         true        // default
    }).init();

/* ==============================================
PROGRESS -->
=============================================== */

	$('.progress .progress-bar').progressbar({transition_delay: 800});

/* ==============================================
LIGHTBOX -->
=============================================== */

	jQuery('a[data-gal]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('gal')); });     
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({animationSpeed:'slow',theme:'light_square',slideshow:true,overlay_gallery: true,social_tools:false,deeplinking:false});

})(jQuery);