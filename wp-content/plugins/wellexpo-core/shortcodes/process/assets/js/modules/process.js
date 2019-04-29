(function($) {
	'use strict';
	
	var process = {};
	qodef.modules.process = process;
	
	process.qodefInitProcess = qodefInitProcess;
	
	
	process.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitProcess()
	}
	
	/**
	 * Inti process shortcode on appear
	 */
	function qodefInitProcess() {
		var holders = $('.qodef-process-holder');
		
		if(holders.length) {
			holders.appear(function(){
				$(this).addClass('qodef-process-appeared');
			}, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
		}
	}
	
})(jQuery);