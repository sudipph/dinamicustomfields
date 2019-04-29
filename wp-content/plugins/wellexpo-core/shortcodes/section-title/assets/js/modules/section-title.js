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