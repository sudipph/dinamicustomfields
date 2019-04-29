(function($) {
    "use strict";

    var blogListSC = {};
    qodef.modules.blogListSC = blogListSC;
    
	blogListSC.qodefOnDocumentReady = qodefOnDocumentReady;
    blogListSC.qodefOnWindowLoad = qodefOnWindowLoad;
    blogListSC.qodefOnWindowScroll = qodefOnWindowScroll;
    
    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).scroll(qodefOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefBlogItemsHoverClass();
		qodefBlogItemsLoadingAnimation();
		qodefBlogBgrndLoadingAnimation();
    }    

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function qodefOnWindowLoad() {
        qodefInitBlogListShortcodePagination().init();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function qodefOnWindowScroll() {
        qodefInitBlogListShortcodePagination().scroll();
    }

    /**
     * Init blog list shortcode pagination functions
     */
    function qodefInitBlogListShortcodePagination(){
        var holder = $('.qodef-blog-list-holder');

        var initStandardPagination = function(thisHolder) {
            var standardLink = thisHolder.find('.qodef-bl-standard-pagination li');

            if(standardLink.length) {
                standardLink.each(function(){
                    var thisLink = $(this).children('a'),
                        pagedLink = 1;

                    thisLink.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
                            pagedLink = thisLink.data('paged');
                        }

                        initMainPagFunctionality(thisHolder, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function(thisHolder) {
            var loadMoreButton = thisHolder.find('.qodef-blog-pag-load-more a');

            loadMoreButton.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisHolder);
            });
        };

        var initInifiteScrollPagination = function(thisHolder) {
            var blogListHeight = thisHolder.outerHeight(),
                blogListTopOffest = thisHolder.offset().top,
                blogListPosition = blogListHeight + blogListTopOffest - qodefGlobalVars.vars.qodefAddForAdminBar;

            if(!thisHolder.hasClass('qodef-bl-pag-infinite-scroll-started') && qodef.scroll + qodef.windowHeight > blogListPosition) {
                initMainPagFunctionality(thisHolder);
            }
        };

        var initMainPagFunctionality = function(thisHolder, pagedLink) {
            var thisHolderInner = thisHolder.find('.qodef-blog-list'),
                nextPage,
                maxNumPages;

            if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
                maxNumPages = thisHolder.data('max-num-pages');
            }

            if(thisHolder.hasClass('qodef-bl-pag-standard-shortcodes')) {
                thisHolder.data('next-page', pagedLink);
            }

            if(thisHolder.hasClass('qodef-bl-pag-infinite-scroll')) {
                thisHolder.addClass('qodef-bl-pag-infinite-scroll-started');
            }

            var loadMoreDatta = qodef.modules.common.getLoadMoreData(thisHolder),
                loadingItem = thisHolder.find('.qodef-blog-pag-loading');

            nextPage = loadMoreDatta.nextPage;

            if(nextPage <= maxNumPages){
                if(thisHolder.hasClass('qodef-bl-pag-standard-shortcodes')) {
                    loadingItem.addClass('qodef-showing qodef-standard-pag-trigger');
                    thisHolder.addClass('qodef-bl-pag-standard-shortcodes-animate');
                } else {
                    loadingItem.addClass('qodef-showing');
                }

                var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'wellexpo_select_blog_shortcode_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: qodefGlobalVars.vars.qodefAjaxUrl,
                    success: function (data) {
                        if(!thisHolder.hasClass('qodef-bl-pag-standard-shortcodes')) {
                            nextPage++;
                        }

                        thisHolder.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml =  response.html;

                        if(thisHolder.hasClass('qodef-bl-pag-standard-shortcodes')) {
                            qodefInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);

                            thisHolder.waitForImages(function(){
                                if(thisHolder.hasClass('qodef-bl-masonry')){
                                    qodefInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    qodefInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);

                                    if (typeof qodef.modules.common.qodefStickySidebarWidget === 'function') {
                                        qodef.modules.common.qodefStickySidebarWidget().reInit();
                                    }
                                }
                            });
                        } else {
                            thisHolder.waitForImages(function(){
                                if(thisHolder.hasClass('qodef-bl-masonry')){
                                    qodefInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    qodefInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);

                                    if (typeof qodef.modules.common.qodefStickySidebarWidget === 'function') {
                                        qodef.modules.common.qodefStickySidebarWidget().reInit();
                                    }
                                }
                            });
                        }

                        if(thisHolder.hasClass('qodef-bl-pag-infinite-scroll-started')) {
                            thisHolder.removeClass('qodef-bl-pag-infinite-scroll-started');
                        }
                    }
                });
            }

            if(nextPage === maxNumPages){
                thisHolder.find('.qodef-blog-pag-load-more').hide();
            }
        };

        var qodefInitStandardPaginationLinkChanges = function(thisHolder, maxNumPages, nextPage) {
            var standardPagHolder = thisHolder.find('.qodef-bl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.qodef-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.qodef-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.qodef-pag-next a');

            standardPagNumericItem.removeClass('qodef-pag-active');
            standardPagNumericItem.eq(nextPage-1).addClass('qodef-pag-active');

            standardPagPrevItem.data('paged', nextPage-1);
            standardPagNextItem.data('paged', nextPage+1);

            if(nextPage > 1) {
                standardPagPrevItem.css({'opacity': '1'});
            } else {
                standardPagPrevItem.css({'opacity': '0'});
            }

            if(nextPage === maxNumPages) {
                standardPagNextItem.css({'opacity': '0'});
            } else {
                standardPagNextItem.css({'opacity': '1'});
            }
        };

        var qodefInitHtmlIsotopeNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.html(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
            thisHolder.removeClass('qodef-bl-pag-standard-shortcodes-animate');

            setTimeout(function() {
                thisHolderInner.isotope('layout');

                if (typeof qodef.modules.common.qodefStickySidebarWidget === 'function') {
                    qodef.modules.common.qodefStickySidebarWidget().reInit();
                }
            }, 600);
        };

        var qodefInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
            thisHolder.removeClass('qodef-bl-pag-standard-shortcodes-animate');
            thisHolderInner.html(responseHtml);
        };

        var qodefInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('qodef-showing');

            setTimeout(function() {
                thisHolderInner.isotope('layout');

                if (typeof qodef.modules.common.qodefStickySidebarWidget === 'function') {
                    qodef.modules.common.qodefStickySidebarWidget().reInit();
                }
            }, 600);
        };

        var qodefInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('qodef-showing');
            thisHolderInner.append(responseHtml);
        };

        return {
            init: function() {
                if(holder.length) {
                    holder.each(function() {
                        var thisHolder = $(this);

                        if(thisHolder.hasClass('qodef-bl-pag-standard-shortcodes')) {
                            initStandardPagination(thisHolder);
                        }

                        if(thisHolder.hasClass('qodef-bl-pag-load-more')) {
                            initLoadMorePagination(thisHolder);
                        }

                        if(thisHolder.hasClass('qodef-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            },
            scroll: function() {
                if(holder.length) {
                    holder.each(function() {
                        var thisHolder = $(this);

                        if(thisHolder.hasClass('qodef-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            }
        };
    }

    function qodefBlogItemsHoverClass() {
        var items = $('.qodef-blog-list-holder .qodef-bl-item');

		if (items.length) {
            items
                .find('.qodef-post-title')
                .on('mouseenter', function() {
                    $(this).closest('.qodef-bl-item').addClass('qodef-hovered');
                })
                .on('mouseleave', function() {
                    $(this).closest('.qodef-bl-item').removeClass('qodef-hovered');
                });
        }
    }

    function qodefBlogItemsLoadingAnimation() {
        var lists = $('.qodef-bl-masonry-boxed.qodef-bl-with-animation');

		if (lists.length && !qodef.htmlEl.hasClass('touch')) {
            lists.each(function(){
                var items = $(this).find('.qodef-bl-item');

                items.appear(function() {
                    $(this).addClass('qodef-appeared');
                },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
            });
        }
    }

    function qodefBlogBgrndLoadingAnimation() {
        var lists = $('.qodef-bl-standard.qodef-bl-with-bgrnd-animation');

		if (lists.length && !qodef.htmlEl.hasClass('touch')) {
            lists.each(function(){
                var items = $(this).find('.qodef-bl-item');

                items.appear(function() {
                    $(this).addClass('qodef-appeared');
                },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
            });
        }
    }

})(jQuery);