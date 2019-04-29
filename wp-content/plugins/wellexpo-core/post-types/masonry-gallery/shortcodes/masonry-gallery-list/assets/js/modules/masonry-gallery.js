(function($) {
    'use strict';
	
	var masonryGalleryList = {};
	qodef.modules.masonryGalleryList = masonryGalleryList;

    masonryGalleryList.qodefInitMasonryGallery = qodefInitMasonryGallery;

    masonryGalleryList.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitMasonryGallery().init();
	}
	
	/**
	 * Masonry gallery, init masonry and resize pictures in grid
	 */
	function qodefInitMasonryGallery() {
		var holder = $('.qodef-masonry-gallery-holder');
		
		var initMasonryGallery = function (thisHolder, size) {
			thisHolder.waitForImages(function () {
				var masonry = thisHolder.children();
				
				masonry.isotope({
					layoutMode: 'packery',
					itemSelector: '.qodef-mg-item',
					percentPosition: true,
					packery: {
						gutter: '.qodef-mg-grid-gutter',
						columnWidth: '.qodef-mg-grid-sizer'
					}
				});
				
				qodef.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('.qodef-mg-item'), size, true);
				
				setTimeout(function () {
					qodef.modules.common.qodefInitParallax();
				}, 600);
				
				masonry.isotope( 'layout').css('opacity', '1');
			});
		};
		
		var reInitMasonryGallery = function (thisHolder, size) {
			qodef.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('.qodef-mg-item'), size, true);
			
			thisHolder.children().isotope('reloadItems');
		};
		
		return {
			init: function () {
				if (holder.length) {
					holder.each(function () {
						var thisHolder = $(this),
							size = thisHolder.find('.qodef-mg-grid-sizer').outerWidth();
						
						initMasonryGallery(thisHolder, size);
						
						$(window).resize(function () {
							reInitMasonryGallery(thisHolder, size);
						});
					});
				}
			}
		};
	}

})(jQuery);