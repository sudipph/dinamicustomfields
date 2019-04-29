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