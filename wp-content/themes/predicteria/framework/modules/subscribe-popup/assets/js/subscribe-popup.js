(function ($) {
	"use strict";
	
	var subscribePopup = {};
	qodef.modules.subscribePopup = subscribePopup;
	
	subscribePopup.qodefOnWindowLoad = qodefOnWindowLoad;
	
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefSubscribePopup();
	}
	
	function qodefSubscribePopup() {
		var popupOpener = $('.qodef-subscribe-popup-holder'),
			popupClose = $('.qodef-sp-close');
		
		if (popupOpener.length) {
			var popupPreventHolder = popupOpener.find('.qodef-sp-prevent'),
				disabledPopup = 'no';
			
			if (popupPreventHolder.length) {
				var isLocalStorage = popupOpener.hasClass('qodef-sp-prevent-cookies'),
					popupPreventInput = popupPreventHolder.find('.qodef-sp-prevent-input'),
					preventValue = popupPreventInput.data('value');
				
				if (isLocalStorage) {
					disabledPopup = localStorage.getItem('disabledPopup');
					sessionStorage.removeItem('disabledPopup');
				} else {
					disabledPopup = sessionStorage.getItem('disabledPopup');
					localStorage.removeItem('disabledPopup');
				}
				
				popupPreventHolder.children().on('click', function (e) {
					if ( preventValue !== 'yes' ) {
						preventValue = 'yes';
						popupPreventInput.addClass('qodef-sp-prevent-clicked').data('value', 'yes');
					} else {
						preventValue = 'no';
						popupPreventInput.removeClass('qodef-sp-prevent-clicked').data('value', 'no');
					}
					
					if (preventValue === 'yes') {
						if (isLocalStorage) {
							localStorage.setItem('disabledPopup', 'yes');
						} else {
							sessionStorage.setItem('disabledPopup', 'yes');
						}
					} else {
						if (isLocalStorage) {
							localStorage.setItem('disabledPopup', 'no');
						} else {
							sessionStorage.setItem('disabledPopup', 'no');
						}
					}
				});
			}
			
			if (disabledPopup !== 'yes') {
				if (qodef.body.hasClass('qodef-sp-opened')) {
					qodef.body.removeClass('qodef-sp-opened');
					qodef.modules.common.qodefEnableScroll();
				} else {
					qodef.body.addClass('qodef-sp-opened');
					qodef.modules.common.qodefDisableScroll();
				}
				
				popupClose.on('click', function (e) {
					e.preventDefault();
					
					qodef.body.removeClass('qodef-sp-opened');
					qodef.modules.common.qodefEnableScroll();
				});
				
				//Close on escape
				$(document).keyup(function (e) {
					if (e.keyCode === 27) { //KeyCode for ESC button is 27
						qodef.body.removeClass('qodef-sp-opened');
						qodef.modules.common.qodefEnableScroll();
					}
				});
			}
		}
	}
	
})(jQuery);