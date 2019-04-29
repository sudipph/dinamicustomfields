(function( $ ) {
	'use strict';
	$( window ).load(function() {});

	$(function() {		
		//$('.build-wrap').formBuilder();
		$("#nextStep").on("click",function(){
			var var1 = $(this).attr("data-formid");
			var var2 = $(this).attr("data-stepnumber");
			$.ajax({
				url: ajaxurl,
				method: 'POST',
				data: {	action:'action_number_of_fields_to_repeat',
						fields: var2,
						form_id: var1
					},
				success: function(response){
					console.log( response.message );
					window.location.href='';
				}
			});
		});		
		//Initializing the tabs for mulisteps
		$( "#msr-form-builder" ).tabs();

		// Uploading the files on users edit/update profile page
		var file_frame;
		$('.additional-user-image').on('click', function( event ){
			event.preventDefault();			
			var tid = $(this).attr("data-parentId");			
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: $( this ).data( 'uploader_title' ),
				button: {
					text: $( this ).data( 'uploader_button_text' ),
				},
				multiple: false  // Set to true to allow multiple files to be selected
			});
			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				var attachment = file_frame.state().get('selection').first().toJSON();
				console.log(tid);				
				$('#'+tid).find("input[type='text']").val(attachment.url);
				$('#'+tid).find("img").attr("src",attachment.url);				
				// Do something with attachment.id and/or attachment.url here
			});			
			// Finally, open the modal
			file_frame.open();
		});

		//Checking if checkbox is checked
		$('input[name="msr_enable_google_captcha"]').on('change',function(){
			if ( $('input[name="msr_enable_google_captcha"]').is(':checked') ) {
				$('input[name="msr_captcha_site_key"]').prop({
				        required: true
				    });
					$('input[name="msr_captcha_secret_key"]').prop({
				        required: true
				    });
			}
			else{
				$('input[name="msr_captcha_site_key"]').prop({
				        required: false
			    });
				$('input[name="msr_captcha_secret_key"]').prop({
			        required: false
			    });
			}
		});
				
	});

})( jQuery );
