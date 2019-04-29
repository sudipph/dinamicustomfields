<?php
ini_set('display_errors',1);
/*
Plugin Name: Summit Vanue
Plugin URI: https://google.com/
Description: Just another contact form plugin. Simple but flexible.
Author: Sudip
Text Domain: summit-vanue
Version: 1.0
*/

define('PP3',plugin_dir_url(__FILE__));
define('SHOW_METABOX_ON3', 'event_listing');
add_action('admin_enqueue_scripts', 'dynamic_enqueue_styles_user3');
function dynamic_enqueue_styles_user3()
{
    
    wp_enqueue_style('front-style-colspan_user3', PP3.'css/custom_style.css');
   wp_enqueue_script('jquery'); 
   wp_enqueue_script('jquery_colspan_scripts_user3', PP3 . 'js/scripts.js', array('jquery'), 1.1, true);
    

}

/**sponsors custom fields */

add_action('admin_init', 'add_post_sponsors_custom_field3');

add_action('pre_post_update', 'update_post_event_venue', 11, 3);

 function update_post_event_venue($post_id, $post_object)
{
        remove_action('save_post', __FUNCTION__);
        $data_content = $_POST['content'];
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        // if ('revision' == $post_object->post_type) {
        //     return;
        // }

        if (isset($_POST['post_type']) && SHOW_METABOX_ON != $_POST['post_type']) {
            return;
        }

        
        

        if (isset($_POST['venue_image']) && $_POST['venue_image']!=''){
            $gallery_data['venue_image'] = $_POST['venue_image'];
        } else {
            $gallery_data['venue_image'] = '';
        }
        if (isset($_POST['v_description']) && $_POST['v_description']!=''){
            $gallery_data['v_description'] = $_POST['v_description'];
        } else {
            $gallery_data['v_description'] = '';
        }
        if (isset($_POST['map_it']) && $_POST['map_it']!=''){
            $gallery_data['map_it'] = $_POST['map_it'];
        } else {
            $gallery_data['map_it'] = '';
        }
        if (isset($_POST['website']) && $_POST['website']!=''){
            $gallery_data['website'] = $_POST['website'];
        } else {
            $gallery_data['website'] = '';
        }
        if (isset($_POST['vanue_location']) && $_POST['vanue_location']!=''){
            $gallery_data['vanue_location'] = $_POST['vanue_location'];
        } else {
            $gallery_data['vanue_location'] = '';
        }
        
      
        if (isset($gallery_data) && count($gallery_data) > 0){
            update_post_meta($post_id, 'venue_image', $gallery_data['venue_image']);
            update_post_meta($post_id, 'v_description', $gallery_data['v_description']);
            update_post_meta($post_id, 'map_it', $gallery_data['map_it']);
            update_post_meta($post_id, 'website', $gallery_data['website']);
            update_post_meta($post_id, 'vanue_location', $gallery_data['vanue_location']);
            
        } else {
            delete_post_meta($post_id, 'venue_image');
            delete_post_meta($post_id, 'v_description');
            delete_post_meta($post_id, 'map_it');
            delete_post_meta($post_id, 'website');
            delete_post_meta($post_id, 'vanue_location');
            
        }
        
    }
function add_post_sponsors_custom_field3()
{

    $show_metabox_on = SHOW_METABOX_ON3;

    add_meta_box(
        'summit_content',
        'Summit Vanue Settings',
        'post_content_post_sponsors_content3',
        $show_metabox_on,
        'normal',
        'core'
    );
    
}
function post_content_post_sponsors_content3()
{
    global $post, $wp_meta_boxes;

    
    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');
//var_dump(($gallery_data));
    ?>

<div id="dynamic_form">
<input type="hidden" name="sponsor_post_id" id="speaker_post_id" value="<?php echo $post->ID?>" >
    <div id="field_wrap">
    </div>

    <?php
            tab_with_sponsors_card_type3($post->ID);
        ?>
</div>

<?php

}
function tab_with_sponsors_card_type3($pid){
    $venue_image = get_post_meta($pid, 'venue_image', true);
$v_description = get_post_meta($pid, 'v_description', true);
$map_it = get_post_meta($pid, 'map_it', true);
$website = get_post_meta($pid, 'website', true);
$vanue_location = get_post_meta($pid, 'vanue_location', true);


    ?>
    
    <div class="unique_add">
     <p class="form-field">
        <div class="add_sponsors_loading ">
            <?php 
            
            input_html3('vanue_location','Venue Location :',$vanue_location);
                          
            ?>
            
        </div>
    </p>
    <p class="form-field">
             <div class="add_sponsors_loading ">
            <?php 
            
              image_with_content3('venue_image','Venue Image :',$venue_image);
                
            ?>
            
        </div>
    </p>
    <p class="form-field">
             <div class="add_sponsors_loading ">
            <?php 
            
            text_editor3('v_description','Venue Details :',$v_description);
                          
            ?>
            
        </div>
    </p>
    <p class="form-field">
        <div class="add_sponsors_loading ">
            <?php 
            
            input_html3('map_it','Map It :',$map_it);
                          
            ?>
            
        </div>
    </p>
    <p class="form-field">
        <div class="add_sponsors_loading ">
            <?php 
            
            input_html3('website','Vanue Website :',$website);
                          
            ?>
            
        </div>
    </p>

    </div>
<?php
}
function input_html3($input_name,$tag,$value){
    ?>
<div class="field_row remove_padding">
    <div class="field_left" style="width: 60%;">
        <div class="form_field">
            <label>
                <?php echo $tag;?>
            </label>
            <input type="text" class="meta_image_url" name="<?php echo $input_name;?>" value="<?php if (isset($value)) {
        esc_html_e($value);
    }?>" />
        </div>
    </div>
    <div class="clear"></div>
</div>

<?php
}

function text_editor3($input_name,$tag,$value=''){
    ?>
    <div class="field_row remove_padding" style="padding-bottom: 0px; margin-bottom: 0px;">
        <div class="field_left">
            <div class="" style="padding-bottom: 0px; ">
                <label class="font_change">
                    <?php echo $tag;?> </label>
                <?php echo wp_editor($value, 'general_info', array(
                        'wpautop' => true,
                        'media_buttons' => true,
                        'textarea_name' => ''.$input_name.'',
                        'textarea_rows' => 10,
                        'teeny' => true,
                    )); ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <?php
}
function dropdown_html_3($input_name,$tag,$arr,$selected){
    ?>

<div class="field_row remove_padding">

    <div class="field_left" style="width: 60%;">
        <div class="form_field">
            <label>
                <?php echo $tag;?>
            </label>
            <select name="<?php echo $input_name;?>" id="<?php echo $input_name;?>">
                <option value="">Select Speaker User</option>
                <?php 
            if(count($arr)){
                foreach($arr as $user_obj){
            ?>
                <option value="<?php echo $user_obj->ID;?>" <?php echo ($selected==$user_obj->ID?'selected':'');?>>
                    <?php echo $user_obj->user_login;?>
                </option>
                <?php }
            }
            ?>
            </select>

        </div>

    </div>


    <div class="clear"></div>
</div>

<?php
}


// add_action( 'init', 'my_script_enqueuer' );

// function my_script_enqueuer() {
//    wp_register_script( "my_voter_script", WP_PLUGIN_URL.'/my_plugin/my_voter_script.js', array('jquery') );
//    wp_localize_script( 'my_voter_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        

//    wp_enqueue_script( 'jquery' );
//    wp_enqueue_script( 'my_voter_script' );

// }

function image_with_content3($name,$tag,$value){
    ?>
<div class="field_row remove_padding">
    <div class="field_left" style="width: 60%;">
        <div class="form_field">
            <label><?php echo $tag;?></label>
            <input type="text" class="meta_image_url" name="<?php echo $name;?>" value="<?php if (isset($value)) {
        esc_html_e($value);
    }?>" />
        </div>
    </div>
    <div class="field_right image_wrap">
        <?php
if (isset($value)&& '' != $value) {
        ?>
        <img src="<?php esc_html_e($value);?>" height="48" width="48" />
        <?php
    }
    ?>
    </div>
    <div class="field_right">
        <input class="button" type="button" value="Choose File" onclick="add_image(this)" /><br />
        <input class="button reset_image" type="button" value="Remove"  />
    </div>
    <div class="clear"></div>
</div>
<?php
}
