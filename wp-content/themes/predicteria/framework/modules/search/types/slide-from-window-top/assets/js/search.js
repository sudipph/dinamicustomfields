(function($) {
    "use strict";

    var searchSlideFromWT = {};
    qodef.modules.searchSlideFromWT = searchSlideFromWT;

    searchSlideFromWT.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
	    qodefSearchSlideFromWT();
    }
	
	/**
	 * Init Search Types
	 */
	function qodefSearchSlideFromWT() {
        if ( qodef.body.hasClass( 'qodef-search-slides-from-window-top' ) ) {
            var searchOpener = $('a.qodef-search-opener');

            if ( searchOpener.length > 0 ) {
                var searchForm = $('.qodef-search-slide-window-top'),
                    searchClose = $('.qodef-search-close');

                searchOpener.on('click', function(e) {
                    e.preventDefault();

                    if ( searchForm.height() === "0") {
                        $('.qodef-search-slide-window-top input[type="text"]').focus();
                        //Push header bottom
                        qodef.body.addClass('qodef-search-open');
                    } else {
                        qodef.body.removeClass('qodef-search-open');
                    }

                    $(window).scroll(function() {
                        if ( searchForm.height() !== '0' && qodef.scroll > 50 ) {
                            qodef.body.removeClass('qodef-search-open');
                        }
                    });

                    searchClose.on('click', function(e){
                        e.preventDefault();
                        qodef.body.removeClass('qodef-search-open');
                    });
                });
            }
		}
	}

})(jQuery);
