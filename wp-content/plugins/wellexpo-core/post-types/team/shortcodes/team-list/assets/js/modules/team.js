(function($) {
    'use strict';

    var team = {};
    qodef.modules.team = team;

	team.qodefOnDocumentReady = qodefOnDocumentReady;
	team.qodefTeamLoadingAnimation = qodefTeamLoadingAnimation;

    $(document).ready(qodefOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
		ajaxLoadTeamContent();
		qodefTeamLoadingAnimation();
    }

	function ajaxLoadTeamContent() {

		var teamInfomembers = $('.qodef-team-list-holder.qodef-team-popup .qodef-team');
		var modal = $('.qodef-team-modal-holder');
		var spinner = $('<div class="qodef-team-spinner"><div class="qodef-team-pulse"></div><div class="qodef-team-pulse"></div></div>');

		if(teamInfomembers.length) {
			teamInfomembers.each(function () {
				var teamInfoMember = $(this);

				teamInfoMember.find('a').on('click', function(e){
					e.preventDefault();
					modal.fadeIn(400, 'easeInOutQuint');
					modal.append(spinner);
					spinner.fadeIn(200);

					var ajaxData = {
						action: 'wellexpo_core_team_list_info_opening',
						member_id : teamInfoMember.data('member-id')
					};

					$.ajax({
						type: 'POST',
						data: ajaxData,
						url: qodefGlobalVars.vars.qodefAjaxUrl,
						success: function (data) {
							var response = JSON.parse(data);
							var responseHtml = response.html;
							modal.empty();
							modal.append(responseHtml);
							qodef.body.addClass('qodef-team-info-opened');
							qodef.html.addClass('qodef-scroll-disabled');
							spinner.fadeOut(200).remove();
							setTimeout(function(){
								modal.addClass('qodef-modal-opened');
							},300);

							modal.find('.qodef-close').on('click', function(){
								e.preventDefault();
								qodef.body.removeClass('qodef-team-info-opened');
								qodef.html.removeClass('qodef-scroll-disabled');
								modal.removeClass('qodef-modal-opened');
								setTimeout(function(){
									modal.empty();
									modal.fadeOut(100);
								}, 400);
							});

							//Close on click away
							$(document).mouseup(function (e) {
								if (modal.hasClass('qodef-modal-opened')){
									var container = $(".qodef-team-popup-content");
									if (!container.is(e.target) && container.has(e.target).length === 0)  {
										e.preventDefault();
										qodef.body.removeClass('qodef-team-info-opened');
										qodef.html.removeClass('qodef-scroll-disabled');
										modal.removeClass('qodef-modal-opened');
										setTimeout(function(){
											modal.empty();
											modal.fadeOut(100);
										}, 400);
									}
								}
							});
						}
					});
				});
			});
		}
	}


	function qodefTeamLoadingAnimation() {
		var lists = $('.qodef-tl-with-animation');

		if (lists.length && !qodef.htmlEl.hasClass('touch')) {
			lists.filter('.qodef-tl-standard').each(function(){
				var list = $(this),
					items = list.find('.qodef-team '),
					articleIndexes = [];

				for (var i = 0; i < items.length; i++) {
					articleIndexes[i] = i;
				}
				
				qodef.modules.common.qodefShuffleIndexes(articleIndexes);

				items.each(function(i) {
					$(this).css('transition-delay', articleIndexes[i] * 80 +'ms')
				});
			});

			lists.each(function(){
				var items = $(this).find('.qodef-team');

				items.appear(function() {
					$(this).addClass('qodef-appeared');
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}

})(jQuery);