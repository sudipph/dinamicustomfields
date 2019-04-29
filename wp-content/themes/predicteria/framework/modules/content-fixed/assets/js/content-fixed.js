(function ($) {
	"use strict";
	
	var contentFixed = {};
	qodef.modules.contentFixed = contentFixed;
	
	contentFixed.qodefOnWindowLoad = qodefOnWindowLoad;
	
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefContentFixed();
	}
	
	function qodefContentFixed() {
		var contentFixed = $('.qodef-content-fixed');
		
		if (contentFixed.length) {
			var contentFixedClose = contentFixed.find('.qodef-content-fixed-close');

			contentFixed.addClass('qodef-content-show');
			contentFixedClose.on('click', function () {
				contentFixed.removeClass('qodef-content-show');
			});
		}
	}
	
})(jQuery);