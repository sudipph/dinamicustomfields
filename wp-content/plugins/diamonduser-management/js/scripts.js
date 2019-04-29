


// $(document).on("click", ".coverimage", function (e) {
//     console.log('start');
//     e.preventDefault();
//     e.stopPropagation()
//     var image_frame;
//     if (image_frame) {
//         console.log('if condition');
//         image_frame.open();
//     } else {
//         console.log('if condition start');
//         image_frame = wp.media({
//             title: 'Select Media',
//             multiple: false,
//             library: {
//                 type: 'image',
//             }
//         });


//         image_frame.on('close', function () {
//             console.log('if condition close');
//             // get selections and save to hidden input plus other AJAX stuff etc.
//             var selection = image_frame.state().get('selection');
//             var gallery_ids = new Array();
//             var my_index = 0;
//             selection.each(function (attachment) {
//                 gallery_ids[my_index] = attachment['id'];
//                 my_index++;
//             });
//             var ids = gallery_ids.join(",");
//             jQuery('input#mycoverimage').val(ids);
//             Refresh_Image4(ids);
//         });

//         image_frame.on('open', function () {
//             console.log('if condition open');
//             var selection = image_frame.state().get('selection');
//             ids = jQuery('input#mycoverimage').val().split(',');
//             ids.forEach(function (id) {
//                 attachment = wp.media.attachment(id);
//                 attachment.fetch();
//                 selection.add(attachment ? [attachment] : []);
//             });

//         });


//         image_frame.on('toolbar:create:select', function () {
//             console.log('if condition select');
//             image_frame.state().set('filterable', 'uploaded');

//         });

//         image_frame.open();
//         return false;
//         e.stopPropagation()
//     }
// });




$(document).on("click", "#organizer_sponsors_submit_4", function (event) {

    var that = this;
    // jQuery(this).closest('div.add_sponsors_loading').addClass('overlay');
    var selected_sponsors = jQuery('#sponsors_user_id4').val();
    var sponsor_post_id = jQuery('#sponsor_post_id4').val();


    //$(".overlay").show();
    console.log(selected_sponsors + 'sponsor');
    if (selected_sponsors != '') {
        // return false;
        //var organizer_key = jQuery(this).closest('div.content').find('input').filter(':first').val();
        jQuery.ajax({
            url: ajax_url,
            type: "post",
            data: {
                action: "ajax_sponsors_textarea4",
                post_id: sponsor_post_id,
                sponsor_key: selected_sponsors
            },
            dataType: "json",
            success: function (result) {

                //alert(result);
                if (result) {
                    console.log(result);

                    jQuery('#css3_animated_slider_sponsors_list4').append(result.htmlimage);
                    // jQuery(that).closest('div.content').children('.parent_content_box').append(result.html);


                }
            }
        });
    } else {
        alert('Please select a sponsors.');
        return false;
    }
});

function Refresh_Image4(the_id) {
    var data = {
        action: 'cyb_get_image_url',
        id: the_id
    };
    console.log('data');
    jQuery.get(ajaxurl, data, function (response) {

        if (response.success === true) {
            jQuery('#user-preview-image').replaceWith(response.data.image);
        }
    });
}

// $(".overlay").show();

function remove_field_editor_box4(vart, id, post_id) {
    jQuery.ajax({
        url: ajax_url,
        type: "post",
        data: {
            action: "ajax_sponsors_remove4",
            post_key: id,
            post_id: post_id
        },
        dataType: "json",
        success: function (result) {

            //alert(result);
            if (result) {
                console.log(result.htmlimage);
                jQuery('.' + result.htmlimage).remove();
                //jQuery(that).closest('div.content').children('.parent_content_box').append(result.html);


            }
        }
    });
}