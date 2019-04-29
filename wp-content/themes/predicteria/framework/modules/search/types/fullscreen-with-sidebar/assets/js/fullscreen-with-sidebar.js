(function($) {
    "use strict";

    var searchFullscreenWithSidebar = {};
    qodef.modules.searchFullscreenWithSidebar = searchFullscreenWithSidebar;

    searchFullscreenWithSidebar.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefSearchFullscreenWithSidebar();
    }
    
	/**
	 * Init Search Types
	 */
	function qodefSearchFullscreenWithSidebar() {
        if ( qodef.body.hasClass( 'qodef-fullscreen-search-with-sidebar' ) ) {
            var searchOpener = $('a.qodef-search-opener');

            if (searchOpener.length > 0) {
                var searchHolder = $('.qodef-fullscreen-with-sidebar-search-holder'),
                    searchClose = $('.qodef-search-close');

                qodef.modules.common.qodefInitPerfectScrollbar().init(searchHolder);

                searchOpener.on('click', function (e) {
                    e.preventDefault();

                    if (searchHolder.hasClass('qodef-animate')) {
                        qodef.body.removeClass('qodef-fullscreen-search-opened qodef-search-fade-out');
                        qodef.body.removeClass('qodef-search-fade-in');
                        searchHolder.removeClass('qodef-animate');

                        setTimeout(function () {
                            searchHolder.find('.qodef-search-field').val('');
                            searchHolder.find('.qodef-search-field').blur();
                        }, 300);

                        qodef.modules.common.qodefEnableScroll();
                    } else {
                        qodef.body.addClass('qodef-fullscreen-search-opened qodef-search-fade-in');
                        qodef.body.removeClass('qodef-search-fade-out');
                        searchHolder.addClass('qodef-animate');

                        setTimeout(function () {
                           searchHolder.find('.qodef-search-field').focus();
                        }, 900);

                        qodef.modules.common.qodefDisableScroll();
                    }
                    
                    searchClose.on('click', function (e) {
                        e.preventDefault();
                        qodef.body.removeClass('qodef-fullscreen-search-opened qodef-search-fade-in');
                        qodef.body.addClass('qodef-search-fade-out');
                        searchHolder.removeClass('qodef-animate');

                        setTimeout(function () {
                            searchHolder.find('.qodef-search-field').val('');
                            searchHolder.find('.qodef-search-field').blur();
                        }, 300);

                        qodef.modules.common.qodefEnableScroll();
                    });
                    
                    //Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) { //KeyCode for ESC button is 27
                            qodef.body.removeClass('qodef-fullscreen-search-opened qodef-search-fade-in');
                            qodef.body.addClass('qodef-search-fade-out');
                            searchHolder.removeClass('qodef-animate');

                            setTimeout(function () {
                                searchHolder.find('.qodef-search-field').val('');
                                searchHolder.find('.qodef-search-field').blur();
                            }, 300);

                            qodef.modules.common.qodefEnableScroll();
                        }
                    });
                });
            }
        }
	}

})(jQuery);
