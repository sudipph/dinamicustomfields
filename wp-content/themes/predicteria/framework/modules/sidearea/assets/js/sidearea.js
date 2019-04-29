(function($) {
    "use strict";

    var sidearea = {};
    qodef.modules.sidearea = sidearea;

    sidearea.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
	    qodefSideArea();
    }
	
	/**
	 * Show/hide side area
	 */
    function qodefSideArea() {
		var wrapper = $('.qodef-wrapper'),
			sideMenu = $('.qodef-side-menu'),
			sideMenuButtonOpen = $('a.qodef-side-menu-button-opener'),
			cssClass,
			//Flags
			slideFromRight = false,
			slideWithContent = false,
			slideUncovered = false;
		
		if (qodef.body.hasClass('qodef-side-menu-slide-from-right')) {
			$('.qodef-cover').remove();
			cssClass = 'qodef-right-side-menu-opened';
			wrapper.prepend('<div class="qodef-cover"/>');
			slideFromRight = true;
		} else if (qodef.body.hasClass('qodef-side-menu-slide-with-content')) {
			cssClass = 'qodef-side-menu-open';
			slideWithContent = true;
		} else if (qodef.body.hasClass('qodef-side-area-uncovered-from-content')) {
			cssClass = 'qodef-right-side-menu-opened';
			slideUncovered = true;
		}
		
		$('a.qodef-side-menu-button-opener, a.qodef-close-side-menu').on('click', function (e) {
			e.preventDefault();
	
	        if (!sideMenuButtonOpen.hasClass('opened')) {
		        sideMenuButtonOpen.addClass('opened');
		        qodef.body.addClass(cssClass);
		
		        if (slideFromRight) {
			        $('.qodef-wrapper .qodef-cover').on('click', function () {
				        qodef.body.removeClass('qodef-right-side-menu-opened');
				        sideMenuButtonOpen.removeClass('opened');
			        });
		        }
		
		        if (slideUncovered) {
			        sideMenu.css({
				        'visibility': 'visible'
			        });
		        }
		
		        var currentScroll = $(window).scrollTop();
		        $(window).scroll(function () {
			        if (Math.abs(qodef.scroll - currentScroll) > 400) {
				        qodef.body.removeClass(cssClass);
				        sideMenuButtonOpen.removeClass('opened');
				        if (slideUncovered) {
					        var hideSideMenu = setTimeout(function () {
						        sideMenu.css({'visibility': 'hidden'});
						        clearTimeout(hideSideMenu);
					        }, 400);
				        }
			        }
		        });
            } else {
	            sideMenuButtonOpen.removeClass('opened');
	            qodef.body.removeClass(cssClass);
	
	            if (slideUncovered) {
		            var hideSideMenu = setTimeout(function () {
			            sideMenu.css({'visibility': 'hidden'});
			            clearTimeout(hideSideMenu);
		            }, 400);
	            }
            }
	
	        if (slideWithContent) {
		        e.stopPropagation();
		
		        wrapper.on('click', function () {
			        e.preventDefault();
			        sideMenuButtonOpen.removeClass('opened');
			        qodef.body.removeClass('qodef-side-menu-open');
		        });
	        }
        });

        if(sideMenu.length){
            qodef.modules.common.qodefInitPerfectScrollbar().init(sideMenu);
        }
    }

})(jQuery);
