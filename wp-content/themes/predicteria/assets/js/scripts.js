/** ajanda script*/
jQuery(document).ready(function () {

    jQuery('#tabs li a:not(:first)').addClass('inactive');
    jQuery('#tabs li:first').addClass('active');
    jQuery('.container1').hide();
    jQuery('.container1:first').show();

    jQuery('#tabs li').click(function () {
        var t = jQuery(this).children('a').attr('id');
        jQuery('.active').removeClass('active');
        jQuery(this).addClass('active');
        if (jQuery(this).hasClass('inactive')) { //this is the start of our condition 

            jQuery(this).removeClass('inactive');
        }
        jQuery('.container1').hide();
        jQuery('#' + t + 'C').fadeIn('slow');

    });
});
/** ajanda script*/

function scrollToposition(id) {
    // Scroll
    console.log(id);
    $('html,body').animate({ scrollTop: $(id).offset().top }, 'slow');
}
//search_by_checkbox_onclick

$(document).on("click", ".search_by_checkbox_onclick", function (event) {

    var that = this;
    //.filter_option_current_box
    var current_selected_id = jQuery(this).closest('div.filter_option_current_box').attr('data-id');
    var frm_obj = jQuery(this).closest('form.form_filter_option_current_box');
    console.log(current_selected_id);

    //var organizer_key = jQuery(this).closest('div.content').find('input').filter(':first').val();
    jQuery.ajax({
        url: ajax_url,
        type: "post",
        data: frm_obj.serialize(),
        dataType: "json",
        success: function (result) {
            //alert(result);
            if (result) {

                console.log('.content_search_by_filter_' + result.random);
                jQuery('.content_search_by_filter_' + result.random).html('');
                jQuery('.content_search_by_filter_' + result.random).html(result.html);
                console.log(result.html);
                //content_search_by_filter_320220

                //jQuery(that).closest('div.content').children('.parent_content_box').append(result.html);

                //init tinymce
            }
        }
    });
});

$(document).on("change", ".search_by_location_with_topic", function (event) {

    var that = this;
    //.filter_option_current_box
    var current_selected_id = jQuery(this).closest('div.filter_option_current_box').attr('data-id');
    var frm_obj = jQuery(this).closest('form.form_filter_option_current_box');
    console.log(current_selected_id);

    //var organizer_key = jQuery(this).closest('div.content').find('input').filter(':first').val();
    jQuery.ajax({
        url: ajax_url,
        type: "post",
        data: frm_obj.serialize(),
        dataType: "json",
        success: function (result) {
            //alert(result);
            if (result) {

                console.log('.content_search_by_filter_' + result.random);
                jQuery('.content_search_by_filter_' + result.random).html('');
                jQuery('.content_search_by_filter_' + result.random).html(result.html);
                console.log(result.html);
                //content_search_by_filter_320220

                //jQuery(that).closest('div.content').children('.parent_content_box').append(result.html);

                //init tinymce
            }
        }
    });
});



$(document).on("change", ".search_by_location_sub_location", function (event) {

    var that = this;
    //.filter_option_current_box
    var current_value = jQuery(this).val();
    console.log(current_value);

    //var organizer_key = jQuery(this).closest('div.content').find('input').filter(':first').val();
    jQuery.ajax({
        url: ajax_url,
        type: "post",
        data: { 'action': 'get_subcategory_value', 'parent': current_value },
        dataType: "json",
        success: function (result) {
            //alert(result);
            if (result) {
                console.log(result);

                jQuery('#result_city_list_from_location').html('');
                jQuery('#result_city_list_from_location').html(result.result);



                //init tinymce
            }
        }
    });
});




jQuery('.d-learn-more_dinamic_ajax').on('click', function (e) {
    var user_id = jQuery(this).attr('data-id');
    var post_id = jQuery(this).attr('data-key');
    var post_value = jQuery(this).attr('data-value');
    var post_attr = jQuery(this).attr('data-attr');

    // dataType: "json",
    jQuery.ajax({
        url: ajax_url,
        type: "post",
        data: { action: 'get_user_info_ajax', user_id: user_id, post_id: post_id, user_key: post_value, key_index: post_attr },
        success: function (result) {
            console.log(result);
            if (result) {

                jQuery("#fetch_user_data_with_agenda").html(result)
                jQuery("#dinamic_ajax").show();
                jQuery('body').addClass('pop-fix');
                //  console.log('.content_search_by_filter_' + result.random);
                //   jQuery('.content_search_by_filter_' + result.random).html('');
                // jQuery('.content_search_by_filter_' + result.random).html(result.html);
                //  console.log(result.html);
                //content_search_by_filter_320220

                //jQuery(that).closest('div.content').children('.parent_content_box').append(result.html);

                //init tinymce
            }
        }
    });


    e.preventDefault();
});


jQuery(document).on('click', '.d-learn-more_dinamic_ajax_close', function (e) {
    var user_id = jQuery(this).attr('data-id');
    var post_id = jQuery(this).attr('data-key');
    var post_value = jQuery(this).attr('data-value');
    var post_attr = jQuery(this).attr('data-attr');
    jQuery("#dinamic_ajax").hide();
    // dataType: "json",
    jQuery.ajax({
        url: ajax_url,
        type: "post",
        data: { action: 'get_user_info_ajax', user_id: user_id, post_id: post_id, user_key: post_value, key_index: post_attr },
        success: function (result) {
            console.log(result);
            if (result) {

                jQuery("#fetch_user_data_with_agenda").html(result)
                jQuery("#dinamic_ajax").show();
                jQuery('body').addClass('pop-fix');
                //  console.log('.content_search_by_filter_' + result.random);
                //   jQuery('.content_search_by_filter_' + result.random).html('');
                // jQuery('.content_search_by_filter_' + result.random).html(result.html);
                //  console.log(result.html);
                //content_search_by_filter_320220

                //jQuery(that).closest('div.content').children('.parent_content_box').append(result.html);

                //init tinymce
            }
        }
    });


    e.preventDefault();
});

jQuery('.dmond-pop-up-close').on('click', function (e) {
    jQuery('.dmond-pop-up').hide();
    jQuery('body').removeClass('pop-fix');
    e.preventDefault();
});
