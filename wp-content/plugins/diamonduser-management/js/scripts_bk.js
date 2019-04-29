
var acordian = $("#css3_animated_slider").collapse({
    accordion: true,
    open: function () {
        this.addClass("open");
        this.css({
            height: this.children().outerHeight()
        });
    },
    close: function () {
        this.css({
            height: "0px"
        });
        this.removeClass("open");
    }
});

//.deleted_item
$(document).on("click", ".deleted_item", function (event) {

    event.stopPropagation();
    if (confirm('Are you sure want to delete the item?')) {

        $(this).closest("h3").next().remove();
        $(this).closest("h3").remove();
        $('#css3_animated_slider').find("a").contents().unwrap();
        new jQueryCollapse($("#css3_animated_slider"));
    }

    //alert("Hello, ");
});
//$("#organizer_Date_submit").on("click", function (event) {

$(document).on("click", "#organizer_Date_submit", function (event) {
    event.stopPropagation();
    if ($('#organizer_Date').val() == '') {
        alert('Please enter a value.');
        return false;
    } else {
        var org_key = Math.floor(100000 + Math.random() * 900000);
        var content = '<h3 class="root_item">' + $('#organizer_Date').val() + ' <span class="deleted_item">-</span></h3>' +
            '<div class="sibling_item">' +
            '<div class="content">' +
            '<input type="hidden" class="organizer_key" name="organizer_key[]" value="' + org_key + '">' +
            '<input type="hidden" name="organizer_name[' + org_key + ']" value="' + $('#organizer_Date').val() + '">' +
            '<div class="parent_content_box"></div>' +
            '<div id="add_field_row">' +
            '<input class="button add_field_row_quick" type = "button" value = "Add Field"  />' +
            '</div >' +
            '</div>' +
            '</div>';
        $('#css3_animated_slider').append(content);

        $('#css3_animated_slider').find("a").contents().unwrap();

        // $("#css3_animated_slider h3").each(function (index) {
        //     console.log(index + ": " + $(this).html());
        //     //$(this).html().find("a.link").contents().unwrap();
        //     $(this).find("a.link").contents().unwrap();
        // });
        var demo = new jQueryCollapse($("#css3_animated_slider")); // Initializing plugin


        //demo.open(); // Open all sections
        //$("#css3_animated_slider").collapse({ theme: 'e', refresh: true });

    }

});


// $.each(obj, function (key, value) {
//     alert(key + ": " + value);
// });

function add_image(obj) {
    var parent = jQuery(obj).parent().parent('div.field_row');
    var inputField = jQuery(parent).find("input.meta_image_url");

    tb_show('', 'media-upload.php?TB_iframe=true');

    window.send_to_editor = function (html) {
        console.log(html);
        var url = jQuery(html).attr('src');
        console.log(url);

        inputField.val(url);
        jQuery(parent)
            .find("div.image_wrap")
            .html('<img src="' + url + '" height="48" width="48" />');

        // inputField.closest('p').prev('.awdMetaImage').html('<img height=120 width=120 src="'+url+'"/><p>URL: '+ url + '</p>');

        tb_remove();
    };

    return false;
}

function reset_image() {
    jQuery('.image_wrap').html('');
    jQuery('.meta_image_url').val('');
}
$(document).on("click", ".time_picker_link", function (event) {
    $('.time_picker_link').timepicker();
});
$(function () {

    //  $('.time_picker_link').timepicker();
});



function remove_field_editor(vart) {
    var class_name = jQuery(vart).closest('.content_box_children');
    class_name.remove();
    console.log(class_name);
}


//function add_field_row_quick() {

$(document).on("click", ".add_field_row_quick", function (event) {

    var that = this;
    My_New_Global_Settings = tinyMCEPreInit.mceInit.content;
    var organizer_key = jQuery(this).closest('div.content').find('input').filter(':first').val();
    jQuery.ajax({
        url: ajax_url,
        type: "post",
        data: {
            action: "ajax_dynamic_textarea",
            post_type: 'contacts_database',
            organizer_key: organizer_key
        },
        dataType: "json",
        success: function (result) {
            //alert(result);
            if (result) {
                console.log(result.html);

                jQuery(that).closest('div.content').children('.parent_content_box').append(result.html);
                //tinymce.init();
                tinymce.init(My_New_Global_Settings);
                tinyMCE.execCommand('mceAddEditor', false, 'general_info_' + result.random);
                quicktags({
                    id: 'general_info_' + result.random
                });
                //init tinymce
            }
        }
    });
});
//}
