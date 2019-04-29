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