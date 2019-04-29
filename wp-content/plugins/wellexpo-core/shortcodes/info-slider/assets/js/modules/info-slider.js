(function($) {
	'use strict';
	
	var infoSlider = {};
	qodef.modules.infoSlider = infoSlider;
	
	infoSlider.qodefOnDocumentReady = qodefOnDocumentReady;
	infoSlider.qodefInitInfoSlider = qodefInitInfoSlider;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitInfoSlider();
	}
	
	/*
	 **	Info Slider
	 */
	function qodefInitInfoSlider() {
        var infoSliders = $('.qodef-info-slider');
        
        if (infoSliders.length) {
			var setActiveSlide = function(slider) {
				slider.find('.qodef-is-item').first().addClass('qodef-active');
				slider.data('hasNav') ? slider.find('.qodef-is-nav-item').first().addClass('qodef-active') : '';
			}
			
            var changeActiveItems = function(slider, items, activeIndex) {
				items
					.removeClass('qodef-active')
					.filter(function() { 
						return $(this).data("index") == activeIndex; 
					}).addClass('qodef-active');

				slider.one(qodef.animationEnd, function() {
					!slider.data('autoplay') && autoplaySlides(slider);
				})
			}

			var navigateSlides = function(slider) {
				var navItems = slider.find('.qodef-is-nav-item'),
					slides = slider.find('.qodef-is-item');

				navItems.on('click', function() {
					var activeIndex = $(this).data('index');
					
					slider
						.find('.qodef-is-item')
						.removeClass('qodef-prev')
						.filter('.qodef-active')
						.addClass('qodef-prev');
						
					clearInterval(slider.data('autoplay'));
					slider.data('autoplay', false);
					changeActiveItems(slider, slides, activeIndex);
					changeActiveItems(slider, navItems, activeIndex);
				});
			}

			var autoplaySlides = function(slider) {
				var navItems = slider.data('hasNav') ? slider.find('.qodef-is-nav-item') : '',
					slides = slider.find('.qodef-is-item');

				slider.data('autoplay', setInterval(function(){
					var currentItem = slides.filter('.qodef-active').data('index'),
						activeIndex = currentItem < slides.length ? currentItem + 1 : 1;

					slider
						.find('.qodef-is-item')
						.removeClass('qodef-prev')
						.filter('.qodef-active')
						.addClass('qodef-prev');

					changeActiveItems(slider, slides, activeIndex);
					if (navItems) {
						changeActiveItems(slider, navItems, activeIndex);
					}
				}, 3000));
			}

            infoSliders.each(function(){
				var slider = $(this);
					slider.data('hasNav', slider.find('.qodef-is-nav').length ? true : '' );
					slider.data('autoplay');
				
				setActiveSlide(slider);
				autoplaySlides(slider);
				if (slider.data('hasNav')) {
					navigateSlides(slider);
				}
            });
        }
	}
})(jQuery);