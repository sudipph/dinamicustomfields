(function ($) {
	"use strict";
	
	var mobileHeader = {};
	qodef.modules.mobileHeader = mobileHeader;
	
	mobileHeader.qodefOnDocumentReady = qodefOnDocumentReady;
	mobileHeader.qodefOnWindowResize = qodefOnWindowResize;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).resize(qodefOnWindowResize);
	
	/*
		All functions to be called on $(document).ready() should be in this function
	*/
	function qodefOnDocumentReady() {
		qodefInitMobileNavigation();
		qodefInitMobileNavigationScroll();
		qodefMobileHeaderBehavior();
	}
	
	/*
        All functions to be called on $(window).resize() should be in this function
    */
	function qodefOnWindowResize() {
		qodefInitMobileNavigationScroll();
	}
	
	function qodefInitMobileNavigation() {
		var navigationOpener = $('.qodef-mobile-header .qodef-mobile-menu-opener'),
			navigationHolder = $('.qodef-mobile-header .qodef-mobile-nav'),
			dropdownOpener = $('.qodef-mobile-nav .mobile_arrow, .qodef-mobile-nav h6, .qodef-mobile-nav a.qodef-mobile-no-link');
		
		//whole mobile menu opening / closing
		if (navigationOpener.length && navigationHolder.length) {
			navigationOpener.on('tap click', function (e) {
				e.stopPropagation();
				e.preventDefault();
				
				if (navigationHolder.is(':visible')) {
					navigationHolder.slideUp(450, 'easeInOutQuint');
					navigationOpener.removeClass('qodef-mobile-menu-opened');
				} else {
					navigationHolder.slideDown(450, 'easeInOutQuint');
					navigationOpener.addClass('qodef-mobile-menu-opened');
				}
			});
		}
		
		//dropdown opening / closing
		if (dropdownOpener.length) {
			dropdownOpener.each(function () {
				var thisItem = $(this);
				
				thisItem.on('tap click', function (e) {
					var thisItemParent = thisItem.parent('li'),
						thisItemParentSiblingsWithDrop = thisItemParent.siblings('.menu-item-has-children');
					
					if (thisItemParent.hasClass('has_sub')) {
						var submenu = thisItemParent.find('> ul.sub_menu');
						
						if (submenu.is(':visible')) {
							submenu.slideUp(450, 'easeInOutQuint');
							thisItemParent.removeClass('qodef-opened');
						} else {
							thisItemParent.addClass('qodef-opened');
							
							if (thisItemParentSiblingsWithDrop.length === 0) {
								thisItemParent.find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
									submenu.slideDown(400, 'easeInOutQuint');
								});
							} else {
								thisItemParent.siblings().removeClass('qodef-opened').find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
									submenu.slideDown(400, 'easeInOutQuint');
								});
							}
						}
					}
				});
			});
		}
		
		$('.qodef-mobile-nav a, .qodef-mobile-logo-wrapper a').on('click tap', function (e) {
			if ($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
				navigationHolder.slideUp(450, 'easeInOutQuint');
				navigationOpener.removeClass("qodef-mobile-menu-opened");
			}
		});
	}
	
	function qodefInitMobileNavigationScroll() {
		if (qodef.windowWidth <= 1024) {
			var mobileHeader = $('.qodef-mobile-header'),
				mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0,
				navigationHolder = mobileHeader.find('.qodef-mobile-nav'),
				navigationHeight = navigationHolder.outerHeight(),
				windowHeight = qodef.windowHeight - 100;
			
			//init scrollable menu
			var scrollHeight = mobileHeaderHeight + navigationHeight > windowHeight ? windowHeight - mobileHeaderHeight : navigationHeight;

			navigationHolder.height(scrollHeight);
            qodef.modules.common.qodefInitPerfectScrollbar().init(navigationHolder);
		}
	}
	
	function qodefMobileHeaderBehavior() {
		var mobileHeader = $('.qodef-mobile-header'),
			mobileMenuOpener = mobileHeader.find('.qodef-mobile-menu-opener'),
			mobileHeaderHeight = mobileHeader.length ? mobileHeader.outerHeight() : 0;
		
		if (qodef.body.hasClass('qodef-content-is-behind-header') && mobileHeaderHeight > 0 && qodef.windowWidth <= 1024) {
			$('.qodef-content').css('marginTop', -mobileHeaderHeight);
		}
		
		if (qodef.body.hasClass('qodef-sticky-up-mobile-header')) {
			var stickyAppearAmount,
				adminBar = $('#wpadminbar');
			
			var docYScroll1 = $(document).scrollTop();
			stickyAppearAmount = mobileHeaderHeight + qodefGlobalVars.vars.qodefAddForAdminBar;
			
			$(window).scroll(function () {
				var docYScroll2 = $(document).scrollTop();
				
				if (docYScroll2 > stickyAppearAmount) {
					mobileHeader.addClass('qodef-animate-mobile-header');
				} else {
					mobileHeader.removeClass('qodef-animate-mobile-header');
				}
				
				if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount && !mobileMenuOpener.hasClass('qodef-mobile-menu-opened')) || (docYScroll2 < stickyAppearAmount)) {
					mobileHeader.removeClass('mobile-header-appear');
					mobileHeader.css('margin-bottom', 0);
					
					if (adminBar.length) {
						mobileHeader.find('.qodef-mobile-header-inner').css('top', 0);
					}
				} else {
					mobileHeader.addClass('mobile-header-appear');
					mobileHeader.css('margin-bottom', stickyAppearAmount);
				}
				
				docYScroll1 = $(document).scrollTop();
			});
		}
	}
	
})(jQuery);