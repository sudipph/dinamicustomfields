(function($) {
    "use strict";

    var searchCoversHeader = {};
    qodef.modules.searchCoversHeader = searchCoversHeader;

    searchCoversHeader.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
	    qodefSearchCoversHeader();
    }
	
	/**
	 * Init Search Types
	 */
	function qodefSearchCoversHeader() {
        if ( qodef.body.hasClass( 'qodef-search-covers-header' ) ) {

            var searchOpener = $('a.qodef-search-opener');

            if (searchOpener.length > 0) {
                searchOpener.each(function() {
                   var thisOpener = $(this);
                    thisOpener.on('click', function (e) {
                        e.preventDefault();

                        var thisSearchOpener = $(this),
                            searchFormHeight,
                            searchFormHeaderHolder = $('.qodef-page-header'),
                            searchFormTopHeaderHolder = $('.qodef-top-bar'),
                            searchFormFixedHeaderHolder = searchFormHeaderHolder.find('.qodef-fixed-wrapper.fixed'),
                            searchFormMobileHeaderHolder = $('.qodef-mobile-header'),
                            searchForm = $('.qodef-search-cover'),
                            searchFormIsInTopHeader = !!thisSearchOpener.parents('.qodef-top-bar').length,
                            searchFormIsInFixedHeader = !!thisSearchOpener.parents('.qodef-fixed-wrapper.fixed').length,
                            searchFormIsInStickyHeader = !!thisSearchOpener.parents('.qodef-sticky-header').length,
                            searchFormIsInMobileHeader = !!thisSearchOpener.parents('.qodef-mobile-header').length;

                        searchForm.removeClass('qodef-is-active');

                        //Find search form position in header and height
                        if (searchFormIsInTopHeader) {
                            searchFormHeight = qodefGlobalVars.vars.qodefTopBarHeight;
                            searchFormTopHeaderHolder.find('.qodef-search-cover').addClass('qodef-is-active');

                        } else if (searchFormIsInFixedHeader) {
                            searchFormHeight = searchFormFixedHeaderHolder.outerHeight();
                            searchFormHeaderHolder.children('.qodef-search-cover').addClass('qodef-is-active');

                        } else if (searchFormIsInStickyHeader) {
                            searchFormHeight = searchFormHeaderHolder.find('.qodef-sticky-header').outerHeight();
                            searchFormHeaderHolder.children('.qodef-search-cover').addClass('qodef-is-active');

                        } else if (searchFormIsInMobileHeader) {
                            if (searchFormMobileHeaderHolder.hasClass('mobile-header-appear')) {
                                searchFormHeight = searchFormMobileHeaderHolder.children('.qodef-mobile-header-inner').outerHeight();
                            } else {
                                searchFormHeight = searchFormMobileHeaderHolder.outerHeight();
                            }

                            searchFormMobileHeaderHolder.find('.qodef-search-cover').addClass('qodef-is-active');

                        } else {
                            searchFormHeight = searchFormHeaderHolder.outerHeight();
                            searchFormHeaderHolder.children('.qodef-search-cover').addClass('qodef-is-active');
                        }

                        if (searchForm.hasClass('qodef-is-active')) {
                            searchForm.height(searchFormHeight).stop(true).fadeIn(600).find('input[type="text"]').focus();
                        }

                        searchForm.find('.qodef-search-close').on('click', function (e) {
                            e.preventDefault();
                            searchForm.stop(true).fadeOut(450);
                        });

                        searchForm.blur(function () {
                            searchForm.stop(true).fadeOut(450);
                        });

                        $(window).scroll(function () {
                            searchForm.stop(true).fadeOut(450);
                        });
                    });
                });
            }
        }
	}

})(jQuery);
