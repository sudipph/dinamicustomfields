(function($) {
	'use strict';
	
	var masonryElementsHolder = {};
	qodef.modules.masonryElementsHolder = masonryElementsHolder;

	masonryElementsHolder.qodefInitElementsHolderResponsiveStyle = qodefInitMasonryElementsHolderResponsiveStyle;


	masonryElementsHolder.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitMasonryElements();
		qodefInitMasonryElementsHolderResponsiveStyle();
	}

	function qodefInitMasonryElements() {
		var container = $('.qodef-masonry-elements-holder');
		
		if (container.length) {
			container.waitForImages(function () {
				container.each(function() {
					var thisMasonryElements = $(this);

					qodefResizeMasonryElements(thisMasonryElements);

					qodefMasonryElements(thisMasonryElements);
					$(window).resize(function() {
						qodefResizeMasonryElements(thisMasonryElements);
						qodefMasonryElements(thisMasonryElements);
					});
				});
			});
		}
	}

	function qodefMasonryElements(container) {
		container.waitForImages(function () {
			container.isotope({
				itemSelector: '.qodef-masonry-elements-item',
				resizable: false,
				layoutMode: 'packery',
				packery: {
					columnWidth: '.qodef-masonry-elements-grid-sizer'
				}
			});
			container.addClass('qodef-appeared');
			
			setTimeout(function() {
				container.isotope('layout');
			}, 800);
		});
	}

	function qodefResizeMasonryElements(container) {
		var size = container.find('.qodef-masonry-elements-grid-sizer').width();

		var defaultMasonryItem = container.find('.qodef-square');
		var largeWidthMasonryItem = container.find('.qodef-large-width');
		var largeHeightMasonryItem = container.find('.qodef-large-height');
		var largeWidthHeightMasonryItem = container.find('.qodef-large-width-height');

		defaultMasonryItem.css('height', size);
		largeWidthMasonryItem.css('height', size);
		largeHeightMasonryItem.css('height', Math.round(2 * size));

		if (qodef.windowWidth > 600) {
			largeWidthHeightMasonryItem.css('height', Math.round(2 * size));
		} else {
			largeWidthHeightMasonryItem.css('height', size);
		}

		var items = container.find('.qodef-masonry-elements-item');

		items.each(function () {
			var item = $(this);
			var itemHeight = item.find('.qodef-masonry-elements-item-inner-helper').height();
			var itemChildHeight = item.find('.qodef-masonry-elements-item-inner-tc').height();

			if (itemChildHeight > itemHeight) {
				item.css('height', 'auto');
			}
		});
		
		setTimeout(function(){
			var slider = container.find('.qodef-owl-slider');
			
			if (slider.length) {
				slider.each(function(){
					var thisSlider = $(this);
					
					thisSlider.trigger('refresh.owl.carousel');
				});
			}
		}, 800);
	}

	/*
	 **	Elements Holder responsive style
	 */
	function qodefInitMasonryElementsHolderResponsiveStyle() {
		var masonryElementsHolder = $('.qodef-masonry-elements-holder');

		if (masonryElementsHolder.length) {
			masonryElementsHolder.each(function () {
				var thisMasonryElementsHolder = $(this),
					masonryElementsHolderItem = thisMasonryElementsHolder.find('.qodef-masonry-elements-item-inner'),
					style = '',
					responsiveStyle = '';
				
				masonryElementsHolderItem.each(function () {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';

					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1280-1440') !== 'undefined' && thisItem.data('1280-1440') !== false) {
						largeLaptop = thisItem.data('1280-1440');
					}
					if (typeof thisItem.data('1024-1280') !== 'undefined' && thisItem.data('1024-1280') !== false) {
						smallLaptop = thisItem.data('1024-1280');
					}
					if (typeof thisItem.data('768-1024') !== 'undefined' && thisItem.data('768-1024') !== false) {
						ipadLandscape = thisItem.data('768-1024');
					}
					if (typeof thisItem.data('600-768') !== 'undefined' && thisItem.data('600-768') !== false) {
						ipadPortrait = thisItem.data('600-768');
					}
					if (typeof thisItem.data('480-600') !== 'undefined' && thisItem.data('480-600') !== false) {
						mobileLandscape = thisItem.data('480-600');
					}
					if (typeof thisItem.data('480') !== 'undefined' && thisItem.data('480') !== false) {
						mobilePortrait = thisItem.data('480');
					}

					if (largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {

						if (largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1280px) and (max-width: 1440px) {.qodef-masonry-elements-item-inner." + itemClass + " { padding: " + largeLaptop + " !important; } }";
						}
						if (smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1024px) and (max-width: 1280px) {.qodef-masonry-elements-item-inner." + itemClass + " { padding: " + smallLaptop + " !important; } }";
						}
						if (ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 768px) and (max-width: 1024px) {.qodef-masonry-elements-item-inner." + itemClass + " { padding: " + ipadLandscape + " !important; } }";
						}
						if (ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 600px) and (max-width: 768px) {.qodef-masonry-elements-item-inner." + itemClass + " { padding: " + ipadPortrait + " !important; } }";
						}
						if (mobileLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 480px) and (max-width: 600px) {.qodef-masonry-elements-item-inner." + itemClass + " { padding: " + mobileLandscape + " !important; } }";
						}
						if (mobilePortrait.length) {
							responsiveStyle += "@media only screen and (max-width: 480px) {.qodef-masonry-elements-item-inner." + itemClass + " { padding: " + mobilePortrait + " !important; } }";
						}
					}
				});

				if (responsiveStyle.length) {
					style = '<style type="text/css">' + responsiveStyle + '</style>';
				}

				if (style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
})(jQuery);