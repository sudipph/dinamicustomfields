(function($) {
    "use strict";

	window.qodefAdmin = {};
	qodefAdmin.framework = {};

    $(document).ready(function () {
        //plugins init goes here

        if ($('.qodef-page-form').length > 0) {
            qodefScrollToAnchorSelect();
            qodefInitSearchFloat();
            qodefChangedInput();
        }
    });

    function qodefScrollToAnchorSelect() {
        var selectAnchor = $('#qodef-select-anchor');
        selectAnchor.on('change', function () {

            var selectAnchor = $('option:selected', '#qodef-select-anchor');
            if (typeof selectAnchor.data('anchor') !== 'undefined') {
                qodefScrollToPanel(selectAnchor.data('anchor'));
            }
        });
    }

    function qodefScrollToPanel(panel) {
        var adminBarHeight = $('#wpadminbar').height();
        var panelTopPosition = $(panel).offset().top - adminBarHeight;

        $('html, body').animate({
            scrollTop: panelTopPosition
        }, 1000);

        return false;
    }

    function checkBottomPaddingOfFormWrapDiv() {
        //check bottom padding of form wrap div, since bottom holder is changing its height because of the info messages
        setTimeout(function () {
            $('.qodef-page-form').css('padding-bottom', $('.form-button-section').height());
        }, 350);
    }

    function qodefInitSearchFloat() {
        var $wrapForm = $('.qodef-page-form'),
            $controls = $('.form-button-section');

        function initControlsSize() {
            $('#anchornav').css({
                "width": $wrapForm.width()
            });
            checkBottomPaddingOfFormWrapDiv();
        };

        function initControlsFlow() {
            var wrapBottom = $wrapForm.offset().top + $wrapForm.outerHeight(),
                viewportBottom = $(window).scrollTop() + $(window).height();

            if (viewportBottom <= wrapBottom) {
                $controls.addClass('flow');
            }
            else {
                $controls.removeClass('flow');
            }
            ;
        };

        initControlsSize();
        initControlsFlow();

        $(window).on("scroll", function () {
            initControlsFlow();
        });

        $(window).on("resize", function () {
            initControlsSize();
        });
    }


    function qodefChangedInput() {
        $('.qodef-tabs-content').on('change keyup keydown', 'input:not([type="submit"]), textarea, select:not(#qodef-select-anchor)', function (e) {
            $('.qodef-input-change').addClass('yes');
            checkBottomPaddingOfFormWrapDiv();
        });

        $('.field.switch label:not(.selected)').on('click', function () {
            $('.qodef-input-change').addClass('yes');
            checkBottomPaddingOfFormWrapDiv();
        });

        $(window).on('beforeunload', function () {
            if ($('.qodef-input-change.yes').length) {
                return 'You haven\'t saved your changes.';
            }
        });
	
	    $('#anchornav input').on('click', function () {
		    var yesInputChange = $('.qodef-input-change.yes');
		    if (yesInputChange.length) {
			    yesInputChange.removeClass('yes');
		    }
		    var saveChanges = $('.qodef-changes-saved');
		    checkBottomPaddingOfFormWrapDiv();
		    if (saveChanges.length) {
			    saveChanges.addClass('yes');
			    setTimeout(function () {
				    saveChanges.removeClass('yes');
				    checkBottomPaddingOfFormWrapDiv();
			    }, 3000);
		    }
	    });
    }

})(jQuery);
