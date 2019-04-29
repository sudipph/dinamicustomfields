(function($) {
    'use strict';
	
	var accordions = {};
	qodef.modules.accordions = accordions;
	
	accordions.qodefInitAccordions = qodefInitAccordions;
	
	
	accordions.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitAccordions();
	}
	
	/**
	 * Init accordions shortcode
	 */
	function qodefInitAccordions(){
		var accordion = $('.qodef-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this);

				if(thisAccordion.hasClass('qodef-accordion')){
					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('qodef-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.qodef-accordion-title'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						
						thisTitle.hover(function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var animationHolder = {};
	qodef.modules.animationHolder = animationHolder;
	
	animationHolder.qodefInitAnimationHolder = qodefInitAnimationHolder;
	
	
	animationHolder.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitAnimationHolder();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function qodefInitAnimationHolder(){
		var elements = $('.qodef-grow-in, .qodef-fade-in-down, .qodef-element-from-fade, .qodef-element-from-left, .qodef-element-from-right, .qodef-element-from-top, .qodef-element-from-bottom, .qodef-flip-in, .qodef-x-rotate, .qodef-z-rotate, .qodef-y-translate, .qodef-fade-in, .qodef-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var button = {};
	qodef.modules.button = button;
	
	button.qodefButton = qodefButton;
	
	
	button.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefButton().init();
	}
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var qodefButton = function() {
		//all buttons on the page
		var buttons = $('.qodef-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};
		
		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.not('.qodef-with-svg-arrow').each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
    "use strict";

    var clientsGrid = {};
    qodef.modules.clientsGrid = clientsGrid;
    
	clientsGrid.qodefOnDocumentReady = qodefOnDocumentReady;
    
    $(document).ready(qodefOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
		qodefClientsGridLoadingAnimation();
    }    

    function qodefClientsGridLoadingAnimation() {
        var lists = $('.qodef-clients-grid-holder.qodef-cg-with-animation');

		if (lists.length && !qodef.htmlEl.hasClass('touch')) {
			lists.each(function(){
				var list = $(this),
					items = list.find('.qodef-cc-item'),
					articleIndexes = [];

				for (var i = 0; i < items.length; i++) {
					articleIndexes[i] = i;
				}
				
                qodef.modules.common.qodefShuffleIndexes(articleIndexes);
                
                items
                    .each(function(i) {
                        $(this).css('transition-delay', articleIndexes[i] * 80 +'ms');
                    })
                    .appear(function() {
                        $(this).addClass('qodef-appeared');
                    },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
        }
    }

})(jQuery);
(function($) {
	'use strict';
	
	var countdown = {};
	qodef.modules.countdown = countdown;
	
	countdown.qodefInitCountdown = qodefInitCountdown;
	
	
	countdown.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitCountdown();
	}
	
	/**
	 * Countdown Shortcode
	 */
	function qodefInitCountdown() {
		var countdowns = $('.qodef-countdown'),
			date = new Date(),
			currentMonth = date.getMonth(),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');

				if( currentMonth !== month ) {
					month = month - 1;
				}
				
				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month, day, hour, minute, 44),
					labels: ['', monthLabel, '', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'ODHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var counter = {};
	qodef.modules.counter = counter;
	
	counter.qodefInitCounter = qodefInitCounter;
	
	
	counter.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitCounter();
	}
	
	/**
	 * Counter Shortcode
	 */
	function qodefInitCounter() {
		var counterHolder = $('.qodef-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.qodef-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('qodef-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function ($) {
	'use strict';
	
	var customFont = {};
	qodef.modules.customFont = customFont;
	
	customFont.qodefCustomFontResize = qodefCustomFontResize;
	customFont.qodefCustomFontTypeOut = qodefCustomFontTypeOut;
	
	
	customFont.qodefOnDocumentReady = qodefOnDocumentReady;
	customFont.qodefOnWindowLoad = qodefOnWindowLoad;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefCustomFontResize();
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefCustomFontTypeOut();
	}
	
	/*
	 **	Custom Font resizing style
	 */
	function qodefCustomFontResize() {
		var holder = $('.qodef-custom-font-holder');
		
		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';
				
				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}
				
				if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}
				
				if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}
				
				if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {
					
					if (smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1366px) {.qodef-custom-font-holder." + itemClass + " { " + smallLaptopStyle + " } }";
					}
					if (ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.qodef-custom-font-holder." + itemClass + " { " + ipadLandscapeStyle + " } }";
					}
					if (ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.qodef-custom-font-holder." + itemClass + " { " + ipadPortraitStyle + " } }";
					}
					if (mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-custom-font-holder." + itemClass + " { " + mobileLandscapeStyle + " } }";
					}
				}
				
				if (responsiveStyle.length) {
					style = '<style type="text/css">' + responsiveStyle + '</style>';
				}
				
				if (style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
	/*
	 * Init Type out functionality for Custom Font shortcode
	 */
	function qodefCustomFontTypeOut() {
		var qodefTyped = $('.qodef-cf-typed');
		
		if (qodefTyped.length) {
			qodefTyped.each(function () {
				
				//vars
				var thisTyped = $(this),
					typedWrap = thisTyped.parent('.qodef-cf-typed-wrap'),
					customFontHolder = typedWrap.parent('.qodef-custom-font-holder'),
					str = [],
					string_1 = thisTyped.find('.qodef-cf-typed-1').text(),
					string_2 = thisTyped.find('.qodef-cf-typed-2').text(),
					string_3 = thisTyped.find('.qodef-cf-typed-3').text(),
					string_4 = thisTyped.find('.qodef-cf-typed-4').text();
				
				if (string_1.length) {
					str.push(string_1);
				}
				
				if (string_2.length) {
					str.push(string_2);
				}
				
				if (string_3.length) {
					str.push(string_3);
				}
				
				if (string_4.length) {
					str.push(string_4);
				}
				
				customFontHolder.appear(function () {
					thisTyped.typed({
						strings: str,
						typeSpeed: 90,
						backDelay: 700,
						loop: true,
						contentType: 'text',
						loopCount: false,
						cursorChar: '_'
					});
				}, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var elementsHolder = {};
	qodef.modules.elementsHolder = elementsHolder;
	
	elementsHolder.qodefInitElementsHolderResponsiveStyle = qodefInitElementsHolderResponsiveStyle;
	
	
	elementsHolder.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitElementsHolderResponsiveStyle();
	}
	
	/*
	 **	Elements Holder responsive style
	 */
	function qodefInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.qodef-elements-holder');
		
		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.qodef-eh-item'),
					style = '',
					responsiveStyle = '';
				
				elementsHolderItem.each(function() {
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
					if (typeof thisItem.data('1367-1600') !== 'undefined' && thisItem.data('1367-1600') !== false) {
						largeLaptop = thisItem.data('1367-1600');
					}
					if (typeof thisItem.data('1025-1366') !== 'undefined' && thisItem.data('1025-1366') !== false) {
						smallLaptop = thisItem.data('1025-1366');
					}
					if (typeof thisItem.data('769-1024') !== 'undefined' && thisItem.data('769-1024') !== false) {
						ipadLandscape = thisItem.data('769-1024');
					}
					if (typeof thisItem.data('681-768') !== 'undefined' && thisItem.data('681-768') !== false) {
						ipadPortrait = thisItem.data('681-768');
					}
					if (typeof thisItem.data('680') !== 'undefined' && thisItem.data('680') !== false) {
						mobileLandscape = thisItem.data('680');
					}
					
					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {
						
						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1367px) and (max-width: 1600px) {.qodef-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1025px) and (max-width: 1366px) {.qodef-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 769px) and (max-width: 1024px) {.qodef-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 681px) and (max-width: 768px) {.qodef-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
					}
				});
				
				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}
				
				if(style.length) {
					$('head').append(style);
				}
				
				if (typeof qodef.modules.common.qodefOwlSlider === "function") {
					qodef.modules.common.qodefOwlSlider();
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var googleMap = {};
	qodef.modules.googleMap = googleMap;
	
	googleMap.qodefShowGoogleMap = qodefShowGoogleMap;
	
	
	googleMap.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefShowGoogleMap();
	}
	
	/*
	 **	Show Google Map
	 */
	function qodefShowGoogleMap(){
		var googleMap = $('.qodef-google-map');
		
		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);
				
				var snazzyMapStyle = false;
				var snazzyMapCode  = '';
				if(typeof element.data('snazzy-map-style') !== 'undefined' && element.data('snazzy-map-style') === 'yes') {
					snazzyMapStyle = true;
					var snazzyMapHolder = element.parent().find('.qodef-snazzy-map'),
						snazzyMapCodes  = snazzyMapHolder.val();
					
					if( snazzyMapHolder.length && snazzyMapCodes.length ) {
						snazzyMapCode = JSON.parse( snazzyMapCodes.replace(/`{`/g, '[').replace(/`}`/g, ']').replace(/``/g, '"').replace(/`/g, '') );
					}
				}
				
				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}
				
				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}
				
				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}
				
				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}
				
				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}
				
				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}
				
				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}
				
				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}
				
				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}
				
				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "qodef-map-"+ uniqueId;
				
				qodefInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}
	
	/*
	 **	Init Google Map
	 */
	function qodefInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){
		
		if(typeof google !== 'object') {
			return;
		}
		
		var mapStyles = [];
		if(snazzyMapStyle && snazzyMapCode.length) {
			mapStyles = snazzyMapCode;
		} else {
			mapStyles = [
				{
					stylers: [
						{hue: color },
						{saturation: saturation},
						{lightness: lightness},
						{gamma: 1}
					]
				}
			];
		}
		
		var googleMapStyleId;
		
		if(snazzyMapStyle || customMapStyle === 'yes'){
			googleMapStyleId = 'qodef-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}
		
		wheel = wheel === 'yes';
		
		var qoogleMapType = new google.maps.StyledMapType(mapStyles, {name: "Google Map"});
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		
		if (!isNaN(height)){
			height = height + 'px';
		}
		
		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'qodef-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};
		
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('qodef-style', qoogleMapType);
		
		var index;
		
		for (index = 0; index < data.length; ++index) {
			qodefInitializeGoogleAddress(data[index], pin, map, geocoder);
		}
		
		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}
	
	/*
	 **	Init Google Map Addresses
	 */
	function qodefInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}
		
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
				
				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var googleMapWithContactForm = {};
	qodef.modules.googleMapWithContactForm = googleMapWithContactForm;
	
	googleMapWithContactForm.qodefShowGoogleMapWithContactForm = qodefShowGoogleMapWithContactForm;
	
	
	googleMapWithContactForm.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefShowGoogleMapWithContactForm();
	}
	
	/*
	 **	Show Google Map
	 */
	function qodefShowGoogleMapWithContactForm(){
		var googleMapWithContactForm = $('.qodef-google-map-with-contact-form');
		
		if(googleMapWithContactForm.length){
			googleMapWithContactForm.each(function(){
				var element = $(this);
				
				var snazzyMapStyle = false;
				var snazzyMapCode  = '';
				if(typeof element.data('snazzy-map-style') !== 'undefined' && element.data('snazzy-map-style') === 'yes') {
					snazzyMapStyle = true;
					var snazzyMapHolder = element.parent().find('.qodef-snazzy-map'),
						snazzyMapCodes  = snazzyMapHolder.val();
					
					if( snazzyMapHolder.length && snazzyMapCodes.length ) {
						snazzyMapCode = JSON.parse( snazzyMapCodes.replace(/`{`/g, '[').replace(/`}`/g, ']').replace(/``/g, '"').replace(/`/g, '') );
					}
				}
				
				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}
				
				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}
				
				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}
				
				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}
				
				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}
				
				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}
				
				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}
				
				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}
				
				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}
				
				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "qodef-map-"+ uniqueId;
				
				qodefInitializeGoogleMapWithContactForm(snazzyMapStyle, snazzyMapCode, customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}
	
	/*
	 **	Init Google Map
	 */
	function qodefInitializeGoogleMapWithContactForm(snazzyMapStyle, snazzyMapCode, customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){
		
		if(typeof google !== 'object') {
			return;
		}
		
		var mapStyles = [];
		if(snazzyMapStyle && snazzyMapCode.length) {
			mapStyles = snazzyMapCode;
		} else {
			mapStyles = [
				{
					stylers: [
						{hue: color },
						{saturation: saturation},
						{lightness: lightness},
						{gamma: 1}
					]
				}
			];
		}
		
		var googleMapStyleId;
		
		if(snazzyMapStyle || customMapStyle === 'yes'){
			googleMapStyleId = 'qodef-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}
		
		wheel = wheel === 'yes';
		
		var qoogleMapType = new google.maps.StyledMapType(mapStyles, {name: "Google Map"});
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		
		if (!isNaN(height)){
			height = height + 'px';
		}
		
		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'qodef-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};
		
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('qodef-style', qoogleMapType);
		
		var index;
		
		for (index = 0; index < data.length; ++index) {
			qodefInitializeGoogleAddress(data[index], pin, map, geocoder);
		}
		
		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}
	
	/*
	 **	Init Google Map Addresses
	 */
	function qodefInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}
		
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
				
				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var icon = {};
	qodef.modules.icon = icon;
	
	icon.qodefIcon = qodefIcon;
	
	
	icon.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefIcon().init();
	}
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var qodefIcon = function() {
		var icons = $('.qodef-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('qodef-icon-animation')) {
				icon.appear(function() {
					icon.parent('.qodef-icon-animation-holder').addClass('qodef-icon-animation-show');
				}, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.qodef-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('borderTopColor');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var iconListItem = {};
	qodef.modules.iconListItem = iconListItem;
	
	iconListItem.qodefInitIconList = qodefInitIconList;
	
	
	iconListItem.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitIconList().init();
	}
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var qodefInitIconList = function() {
		var iconList = $('.qodef-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('qodef-appeared');
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var imageWithText = {};
	qodef.modules.imageWithText = imageWithText;
	
	imageWithText.qodefOnDocumentReady = qodefOnDocumentReady;
	imageWithText.qodefInitIWTAnimation = qodefInitIWTAnimation;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefIWTHoverTrigger();
		qodefInitIWTAnimation();
	}

    /*
	 **	IWT Hover Trigger
	 */
    function qodefIWTHoverTrigger() {
        var iwtTitles = $('.qodef-iwt-title')

        if (iwtTitles.length) {
            iwtTitles
                .on('mouseenter', function() {
                    $(this).closest('.qodef-image-with-text-holder').addClass('qodef-hovered');
                })
                .on('mouseleave', function() {
                    $(this).closest('.qodef-image-with-text-holder').removeClass('qodef-hovered');
                });
        }
    }

	/*
	 **	IWT Text Animation
	 */
	function qodefInitIWTAnimation() {
        var iwtTextHolders = $('.qodef-iwt-with-animation .qodef-iwt-text-holder');
        
        if (iwtTextHolders.length) {
            iwtTextHolders.each(function(){
                var holder = $(this),
                    text = holder.find('.qodef-iwt-text');

                //text prep
                if (text.length) {
                    var textChars = text.text().trim().split(""),
                        indexes = [];

                    for (var i = 0; i < textChars.length; i++) {
					    indexes[i] = i;
                    }

                    qodef.modules.common.qodefShuffleIndexes(indexes);

                    text.empty();
                    $.each(textChars, function (i, singleChar) {
                        var num1 = Math.floor(Math.random() * 10),
                            num2 = Math.floor(Math.random() * 10);
                        text.append("<span class='qodef-num qodef-num-1' style='animation-delay:"+indexes[i]*25+"ms'>" + num1 + "</span> \
                                        <span class='qodef-num qodef-num-2' style='animation-delay:"+indexes[i]*30+"ms'>" + num2 + "</span> \
                                        <span class='qodef-char' style='animation-delay:"+indexes[i]*35+"ms'>" + singleChar + "</span>");
                    });
                }

                holder.appear(function() {
                    $(this).parent().addClass('qodef-appeared');
                },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
            })
        }
	}
})(jQuery);
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
(function($) {
	'use strict';
	
	var process = {};
	qodef.modules.process = process;
	
	process.qodefInitProcess = qodefInitProcess;
	
	
	process.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitProcess()
	}
	
	/**
	 * Inti process shortcode on appear
	 */
	function qodefInitProcess() {
		var holders = $('.qodef-process-holder');
		
		if(holders.length) {
			holders.appear(function(){
				$(this).addClass('qodef-process-appeared');
			}, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var progressBar = {};
	qodef.modules.progressBar = progressBar;
	
	progressBar.qodefInitProgressBars = qodefInitProgressBars;
	
	
	progressBar.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitProgressBars();
	}
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function qodefInitProgressBars() {
		var progressBar = $('.qodef-progress-bar');
		
		if (progressBar.length) {
			progressBar.each(function () {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.qodef-pb-content'),
					progressBar = thisBar.find('.qodef-pb-percent'),
					percentage = thisBarContent.data('percentage');
				
				thisBar.appear(function () {
					qodefInitToCounterProgressBar(progressBar, percentage);
					
					thisBarContent.css('width', '0%').animate({'width': percentage + '%'}, 2000);
					
					if (thisBar.hasClass('qodef-pb-percent-floating')) {
						progressBar.css('left', '0%').animate({'left': percentage + '%'}, 2000);
					}
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function qodefInitToCounterProgressBar(progressBar, percentageValue){
		var percentage = parseFloat(percentageValue);
		
		if(progressBar.length) {
			progressBar.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');
				
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var sectionTitle = {};
	qodef.modules.sectionTitle = sectionTitle;
	
	sectionTitle.qodefOnDocumentReady = qodefOnDocumentReady;
	sectionTitle.qodefInitSectionTitleAnimation = qodefInitSectionTitleAnimation;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitSectionTitleAnimation();
	}
	
	/*
	 **	Section Title Animation
	 */
	function qodefInitSectionTitleAnimation() {
        var sectionTitles = $('.qodef-st-with-animation');
        
        if (sectionTitles.length) {
            sectionTitles.each(function(){
                var titleHolder = $(this),
                    tagline = titleHolder.find('.qodef-st-tagline');

                //tagline prep
                if (tagline.length) {
                    var taglineChars = tagline.text().trim().split(""),
                        indexes = [];

                    for (var i = 0; i < taglineChars.length; i++) {
					    indexes[i] = i;
                    }

                    qodef.modules.common.qodefShuffleIndexes(indexes);

                    tagline.empty();
                    $.each(taglineChars, function (i, singleChar) {
                        var num1 = Math.floor(Math.random() * 10),
                            num2 = Math.floor(Math.random() * 10);
                        tagline.append("<span class='qodef-num qodef-num-1' style='animation-delay:"+indexes[i]*25+"ms'>" + num1 + "</span> \
                                        <span class='qodef-num qodef-num-2' style='animation-delay:"+indexes[i]*30+"ms'>" + num2 + "</span> \
                                        <span class='qodef-char' style='animation-delay:"+indexes[i]*35+"ms'>" + singleChar + "</span>");
                    });
                }

                titleHolder.appear(function() {
                    $(this).addClass('qodef-appeared');
                },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
            })
        }
	}
})(jQuery);
(function($) {
	'use strict';
	
	var tabs = {};
	qodef.modules.tabs = tabs;
	
	tabs.qodefInitTabs = qodefInitTabs;
	
	
	tabs.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitTabs();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function qodefInitTabs(){
		var tabs = $('.qodef-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.qodef-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.qodef-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;

					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

                $('.qodef-tabs a.qodef-external-link').unbind('click');
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var verticalSplitSlider = {};
	qodef.modules.verticalSplitSlider = verticalSplitSlider;
	
	verticalSplitSlider.qodefInitVerticalSplitSlider = qodefInitVerticalSplitSlider;
	
	
	verticalSplitSlider.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitVerticalSplitSlider();
	}
	
	/*
	 **	Vertical Split Slider
	 */
	function qodefInitVerticalSplitSlider() {
		var slider = $('.qodef-vertical-split-slider'),
			progressBarFlag = true;
		
		if (slider.length) {
			if (qodef.body.hasClass('qodef-vss-initialized')) {
				qodef.body.removeClass('qodef-vss-initialized');
				$.fn.multiscroll.destroy();
			}
			
			slider.height(qodef.windowHeight).animate({opacity: 1}, 300);
			
			var defaultHeaderStyle = '';
			if (qodef.body.hasClass('qodef-light-header')) {
				defaultHeaderStyle = 'custom-light';
			} else if (qodef.body.hasClass('qodef-dark-header')) {
				defaultHeaderStyle = 'custom-dark';
			}
			
			slider.multiscroll({
				scrollingSpeed: 700,
				easing: 'easeInOutQuart',
				navigation: true,
				useAnchorsOnLoad: false,
				sectionSelector: '.qodef-vss-ms-section',
				leftSelector: '.qodef-vss-ms-left',
				rightSelector: '.qodef-vss-ms-right',
				afterRender: function () {
					qodefCheckVerticalSplitSectionsForHeaderStyle($('.qodef-vss-ms-left .qodef-vss-ms-section:first-child').data('header-style'), defaultHeaderStyle);
					qodef.body.addClass('qodef-vss-initialized');
					
					var contactForm7 = $('div.wpcf7 > form');
					if (contactForm7.length) {
						contactForm7.each(function(){
							var thisForm = $(this);
							
							thisForm.find('.wpcf7-submit').off().on('click', function(e){
								e.preventDefault();
								wpcf7.submit(thisForm);
							});
						});
					}
					
					//prepare html for smaller screens - start //
					var verticalSplitSliderResponsive = $('<div class="qodef-vss-responsive"></div>'),
						leftSide = slider.find('.qodef-vss-ms-left > div'),
						rightSide = slider.find('.qodef-vss-ms-right > div');
					
					slider.after(verticalSplitSliderResponsive);
					
					for (var i = 0; i < leftSide.length; i++) {
						verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
						verticalSplitSliderResponsive.append($(rightSide[leftSide.length - 1 - i]).clone(true));
					}
					
					//prepare google maps clones
					var googleMapHolder = $('.qodef-vss-responsive .qodef-google-map');
					if (googleMapHolder.length) {
						googleMapHolder.each(function () {
							var map = $(this);
							map.empty();
							var num = Math.floor((Math.random() * 100000) + 1);
							map.attr('id', 'qodef-map-' + num);
							map.data('unique-id', num);
						});
					}
					
					if (typeof qodef.modules.animationHolder.qodefInitAnimationHolder === "function") {
						qodef.modules.animationHolder.qodefInitAnimationHolder();
					}
					
					if (typeof qodef.modules.button.qodefButton === "function") {
						qodef.modules.button.qodefButton().init();
					}
					
					if (typeof qodef.modules.elementsHolder.qodefInitElementsHolderResponsiveStyle === "function") {
						qodef.modules.elementsHolder.qodefInitElementsHolderResponsiveStyle();
					}
					
					if (typeof qodef.modules.googleMap.qodefShowGoogleMap === "function") {
						qodef.modules.googleMap.qodefShowGoogleMap();
					}
					
					if (typeof qodef.modules.icon.qodefIcon === "function") {
						qodef.modules.icon.qodefIcon().init();
					}
					
					if (progressBarFlag && typeof qodef.modules.progressBar.qodefInitProgressBars === "function" && $($('.qodef-vss-ms-left .qodef-vss-ms-section, .qodef-vss-ms-right .qodef-vss-ms-section')[0]).find('.qodef-progress-bar').length) {
						qodef.modules.progressBar.qodefInitProgressBars();
						progressBarFlag = false;
					}
				},
				onLeave: function (index, nextIndex) {
					if (typeof qodef.modules.progressBar.qodefInitProgressBars === "function" && $($('.qodef-vss-ms-left .qodef-vss-ms-section, .qodef-vss-ms-right .qodef-vss-ms-section')[nextIndex]).find('.qodef-progress-bar').length) {
						setTimeout(function(){
							qodef.modules.progressBar.qodefInitProgressBars();
							progressBarFlag = false;
						},700); // scrolling speed is 700
					}

					qodefIntiScrollAnimation(slider, nextIndex);
					qodefCheckVerticalSplitSectionsForHeaderStyle($($('.qodef-vss-ms-left .qodef-vss-ms-section')[nextIndex - 1]).data('header-style'), defaultHeaderStyle);
				}
			});
			
			if (qodef.windowWidth <= 1024) {
				$.fn.multiscroll.destroy();
			} else {
				$.fn.multiscroll.build();
			}
			
			$(window).resize(function () {
				if (qodef.windowWidth <= 1024) {
					$.fn.multiscroll.destroy();
				} else {
					$.fn.multiscroll.build();
				}
			});
		}
	}
	
	function qodefIntiScrollAnimation(slider, nextIndex) {
		
		if (slider.hasClass('qodef-vss-scrolling-animation')) {
			
			if (nextIndex > 1 && !slider.hasClass('qodef-vss-scrolled')) {
				slider.addClass('qodef-vss-scrolled');
			} else if (nextIndex === 1 && slider.hasClass('qodef-vss-scrolled')) {
				slider.removeClass('qodef-vss-scrolled');
			}
		}
	}
	
	/*
	 **	Check slides on load and slide change for header style changing
	 */
	function qodefCheckVerticalSplitSectionsForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			qodef.body.removeClass('qodef-custom-light-header qodef-custom-dark-header').addClass('qodef-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			qodef.body.removeClass('qodef-custom-light-header qodef-custom-dark-header').addClass('qodef-' + default_header_style + '-header');
		} else {
			qodef.body.removeClass('qodef-custom-light-header qodef-custom-dark-header');
		}
	}
	
})(jQuery);
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
(function($) {
    'use strict';

    var team = {};
    qodef.modules.team = team;

	team.qodefOnDocumentReady = qodefOnDocumentReady;
	team.qodefTeamLoadingAnimation = qodefTeamLoadingAnimation;

    $(document).ready(qodefOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
		ajaxLoadTeamContent();
		qodefTeamLoadingAnimation();
    }

	function ajaxLoadTeamContent() {

		var teamInfomembers = $('.qodef-team-list-holder.qodef-team-popup .qodef-team');
		var modal = $('.qodef-team-modal-holder');
		var spinner = $('<div class="qodef-team-spinner"><div class="qodef-team-pulse"></div><div class="qodef-team-pulse"></div></div>');

		if(teamInfomembers.length) {
			teamInfomembers.each(function () {
				var teamInfoMember = $(this);

				teamInfoMember.find('a').on('click', function(e){
					e.preventDefault();
					modal.fadeIn(400, 'easeInOutQuint');
					modal.append(spinner);
					spinner.fadeIn(200);

					var ajaxData = {
						action: 'wellexpo_core_team_list_info_opening',
						member_id : teamInfoMember.data('member-id')
					};

					$.ajax({
						type: 'POST',
						data: ajaxData,
						url: qodefGlobalVars.vars.qodefAjaxUrl,
						success: function (data) {
							var response = JSON.parse(data);
							var responseHtml = response.html;
							modal.empty();
							modal.append(responseHtml);
							qodef.body.addClass('qodef-team-info-opened');
							qodef.html.addClass('qodef-scroll-disabled');
							spinner.fadeOut(200).remove();
							setTimeout(function(){
								modal.addClass('qodef-modal-opened');
							},300);

							modal.find('.qodef-close').on('click', function(){
								e.preventDefault();
								qodef.body.removeClass('qodef-team-info-opened');
								qodef.html.removeClass('qodef-scroll-disabled');
								modal.removeClass('qodef-modal-opened');
								setTimeout(function(){
									modal.empty();
									modal.fadeOut(100);
								}, 400);
							});

							//Close on click away
							$(document).mouseup(function (e) {
								if (modal.hasClass('qodef-modal-opened')){
									var container = $(".qodef-team-popup-content");
									if (!container.is(e.target) && container.has(e.target).length === 0)  {
										e.preventDefault();
										qodef.body.removeClass('qodef-team-info-opened');
										qodef.html.removeClass('qodef-scroll-disabled');
										modal.removeClass('qodef-modal-opened');
										setTimeout(function(){
											modal.empty();
											modal.fadeOut(100);
										}, 400);
									}
								}
							});
						}
					});
				});
			});
		}
	}


	function qodefTeamLoadingAnimation() {
		var lists = $('.qodef-tl-with-animation');

		if (lists.length && !qodef.htmlEl.hasClass('touch')) {
			lists.filter('.qodef-tl-standard').each(function(){
				var list = $(this),
					items = list.find('.qodef-team '),
					articleIndexes = [];

				for (var i = 0; i < items.length; i++) {
					articleIndexes[i] = i;
				}
				
				qodef.modules.common.qodefShuffleIndexes(articleIndexes);

				items.each(function(i) {
					$(this).css('transition-delay', articleIndexes[i] * 80 +'ms')
				});
			});

			lists.each(function(){
				var items = $(this).find('.qodef-team');

				items.appear(function() {
					$(this).addClass('qodef-appeared');
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}

})(jQuery);