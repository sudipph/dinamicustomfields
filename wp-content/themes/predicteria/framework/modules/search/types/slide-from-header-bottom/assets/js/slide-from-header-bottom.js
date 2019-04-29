(function($) {
    "use strict";

    var searchSlideFromHB = {};
    qodef.modules.searchSlideFromHB = searchSlideFromHB;

    searchSlideFromHB.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
	    qodefSearchSlideFromHB();
    }
	
	/**
	 * Init Search Types
	 */
	function qodefSearchSlideFromHB() {
        if ( qodef.body.hasClass( 'qodef-slide-from-header-bottom' ) ) {

            var searchOpener = $('a.qodef-search-opener');

            if (searchOpener.length > 0) {
                //Check for type of search
                searchOpener.on('click', function (e) {
                    e.preventDefault();

                    var thisSearchOpener = $(this),
                        searchIconPosition = parseInt(qodef.windowWidth - thisSearchOpener.offset().left - thisSearchOpener.outerWidth());

                    if (qodef.body.hasClass('qodef-boxed') && qodef.windowWidth > 1024) {
                        searchIconPosition -= parseInt((qodef.windowWidth - $('.qodef-boxed .qodef-wrapper .qodef-wrapper-inner').outerWidth()) / 2);
                    }

                    var searchFormHeaderHolder = $('.qodef-page-header'),
                        searchFormTopOffset = '100%',
                        searchFormTopHeaderHolder = $('.qodef-top-bar'),
                        searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.qodef-fixed-wrapper.fixed'),
                        searchFormMobileHeaderHolder = $('.qodef-mobile-header'),
                        searchForm = $('.qodef-slide-from-header-bottom-holder'),
                        searchFormIsInTopHeader = !!thisSearchOpener.parents('.qodef-top-bar').length,
                        searchFormIsInFixedHeader = !!thisSearchOpener.parents('.qodef-fixed-wrapper.fixed').length,
                        searchFormIsInStickyHeader = !!thisSearchOpener.parents('.qodef-sticky-header').length,
                        searchFormIsInMobileHeader = !!thisSearchOpener.parents('.qodef-mobile-header').length;

                    searchForm.removeClass('qodef-is-active');

                    //Find search form position in header and height
                    if (searchFormIsInTopHeader) {
                        searchFormTopHeaderHolder.find('.qodef-slide-from-header-bottom-holder').addClass('qodef-is-active');

                    } else if (searchFormIsInFixedHeader) {
                        searchFormTopOffset = searchFormFixedHeaderHolder.outerHeight() + qodefGlobalVars.vars.qodefAddForAdminBar;
                        searchFormHeaderHolder.children('.qodef-slide-from-header-bottom-holder').addClass('qodef-is-active');

                    } else if (searchFormIsInStickyHeader) {
                        searchFormTopOffset = qodefGlobalVars.vars.qodefStickyHeaderHeight + qodefGlobalVars.vars.qodefAddForAdminBar;
                        searchFormHeaderHolder.children('.qodef-slide-from-header-bottom-holder').addClass('qodef-is-active');

                    } else if (searchFormIsInMobileHeader) {
                        if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
                            searchFormTopOffset = searchFormMobileHeaderHolder.children('.qodef-mobile-header-inner').outerHeight() + qodefGlobalVars.vars.qodefAddForAdminBar;
                        }
                        searchFormMobileHeaderHolder.find('.qodef-slide-from-header-bottom-holder').addClass('qodef-is-active');

                    } else {
                        searchFormHeaderHolder.children('.qodef-slide-from-header-bottom-holder').addClass('qodef-is-active');
                    }

                    if (searchForm.hasClass('qodef-is-active')) {
                        searchForm.css({
                            'right': searchIconPosition,
                            'top': searchFormTopOffset
                        }).stop(true).slideToggle(300, 'easeOutBack');
                    }

                    //Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) { //KeyCode for ESC button is 27
                            searchForm.stop(true).fadeOut(0);
                        }
                    });

                    $(window).scroll(function () {
                        searchForm.stop(true).fadeOut(0);
                    });
                });
            }
        }
	}

})(jQuery);
