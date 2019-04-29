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