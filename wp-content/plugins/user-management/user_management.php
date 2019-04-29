<?php
ini_set('display_errors',1);
/*
Plugin Name: User Management
Plugin URI: https://google.com/
Description: Just another contact form plugin. Simple but flexible.
Author: Sudip
Text Domain: user-management
Version: 1.0
*/

define('PP1',plugin_dir_url(__FILE__));
define('SHOW_METABOX_ON1', 'event_listing');
add_action('admin_enqueue_scripts', 'dynamic_enqueue_styles_user');
function dynamic_enqueue_styles_user()
{
    
    wp_enqueue_style('front-style-colspan_user', PP1.'css/custom_style.css');
   wp_enqueue_script('jquery'); 
   wp_enqueue_script('jquery_colspan_scripts_user', PP1 . 'js/scripts.js', array('jquery'), 1.1, true);
    

}

function wps_add_role() {
   $pp = array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => false,
        'delete_posts' => false, // Use false to explicitly deny
    );
    add_role( 'attendee', 'Attendee', 
             $pp
    );
}
add_action( 'init', 'wps_add_role' );
function wps_remove_role() {
    remove_role( 'editor' );
   // remove_role( 'sponsor' );
    remove_role( 'author' );
    remove_role( 'contributor' );
    remove_role( 'subscriber' );
    remove_role( 'manager' );
    remove_role( 'organizer' );
    remove_role( 'shop_manager' );
    remove_role( 'customer' );
    
}
add_action( 'init', 'wps_remove_role' );


/**user meta data */
add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );
function load_wp_media_files( $page ) {
  if( $page == 'profile.php' || $page == 'user-edit.php' ) {
   // wp_enqueue_media();
    //wp_enqueue_script( 'my_custom_script', plugins_url( '/js/scripts.js' , __FILE__ ), array('jquery'), '0.1' );
  }
}

add_action( 'show_user_profile', 'cover_image_function' );
add_action( 'edit_user_profile', 'cover_image_function' );
function cover_image_function( $user ) 
{
    $image_id = get_user_meta( $user->ID, 'mycoverimage', true );
    $user_meta=get_userdata($user->ID);

$user_roles=$user_meta->roles;

    if( intval( $image_id ) > 0 ) {
        // Change with the image size you want to use
        $image = wp_get_attachment_image( $image_id, 'medium', false, array( 'id' => 'user-preview-image' ) );
    } else {
        $image = '<img id="user-preview-image" src="http://0.gravatar.com/avatar/ff8000b5f916451ed6f111c9bd18772d?s=200&d=mm&r=g" />';
    }
  
echo '<div style="display:none;">'.$user_roles[1].'</div>';
    if(isset($user_roles)&&(in_array('sponsor',$user_roles) || in_array('dsponsors',$user_roles))){
    ?>
   <h3>Company Logo</h3>
   <style type="text/css">
    .fh-profile-upload-options th,
    .fh-profile-upload-options td,
    .fh-profile-upload-options input {
        vertical-align: top;
    }
    .user-preview-image {
        display: block;
        height: auto;
        width: 300px;
    }
    </style>
    <table class="form-table fh-profile-upload-options">
        <tr>
            <th>
                <label for="image">Company Logo</label>
            </th>
            <td>
                <?php echo $image; ?>
                <input type="hidden" name="mycoverimage" id="mycoverimage" value="<?php echo esc_attr( get_the_author_meta( 'mycoverimage', $user->ID ) ); ?>" class="regular-text" />
                <input type='button' class="button-primary coverimage" value="Upload Image" id="coverimage"/><br />
                <span class="description">Please upload your company logo.<small>(Image Size : 212X80)</small></span>
            </td>
        </tr>
    </table>
    <?php
    }
    ?>
    
   
   
    <table class="form-table fh-profile-upload-options">
        <tr>
            <th>
                <label for="image">Products & Services</label>
            </th>
            <td>
                <textarea rows="10" name="product_service"><?php ?><?php echo esc_attr( get_the_author_meta( 'product_service', $user->ID ) ); ?></textarea>
            </td>
        </tr>
        <tr>
            <th>
                <label for="image">Industries Served</label>
            </th>
            <td>
                <textarea rows="10" name="industries_served"><?php ?><?php echo esc_attr( get_the_author_meta( 'industries_served', $user->ID ) ); ?></textarea>
            </td>
        </tr>
        <tr>
            <th>
                <label for="image">Clients Include</label>
            </th>
            <td>
                <textarea rows="10" name="client_include"><?php ?><?php echo esc_attr( get_the_author_meta( 'client_include', $user->ID ) ); ?></textarea>  
            </td>
        </tr>
    </table>
    <?php
}

add_action( 'personal_options_update', 'save_cover_image' );
add_action( 'edit_user_profile_update', 'save_cover_image' );
function save_cover_image( $user_id ) {
    if ( ! current_user_can( 'edit_user', $user_id ) )
    {
        return false;
    }
    if(isset($_POST[ 'mycoverimage' ])){
        update_user_meta( $user_id, 'mycoverimage', $_POST[ 'mycoverimage' ] );
    }
    if(isset($_POST[ 'product_service' ])){
        update_user_meta( $user_id, 'product_service', $_POST[ 'product_service' ] );
    }
    if(isset($_POST[ 'industries_served' ])){
        update_user_meta( $user_id, 'industries_served', $_POST[ 'industries_served' ] );
    }
    if(isset($_POST[ 'client_include' ])){
        update_user_meta( $user_id, 'client_include', $_POST[ 'client_include' ] );
    }
}  


// Ajax action to refresh the user image
add_action( 'wp_ajax_cyb_get_image_url', 'cyb_get_image_url'   );
function cyb_get_image_url() {
    if(isset($_GET['id']) ){
        $image = wp_get_attachment_image( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'medium', false, array( 'id' => 'user-preview-image' ) );
        $data = array(
            'image'    => $image,
        );
        wp_send_json_success( $data );
    } else {
        wp_send_json_error();
    }
}
/**sponsors custom fields */

add_action('admin_init', 'add_post_sponsors_custom_field');

function add_post_sponsors_custom_field()
{

    $show_metabox_on = SHOW_METABOX_ON1;

    add_meta_box(
        'sponsors_content',
        'Platinum Sponsors Settings',
        'post_content_post_sponsors_content',
        $show_metabox_on,
        'normal',
        'core'
    );
    
}
function post_content_post_sponsors_content()
{
    global $post, $wp_meta_boxes;

    $gallery_data = get_post_meta($post->ID, 'sponsors_key', true);

    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');
///var_dump(($gallery_data));
    ?>

<div id="dynamic_form">
<input type="hidden" name="sponsor_post_id" id="sponsor_post_id" value="<?php echo $post->ID?>" >
    <div id="field_wrap">
    </div>

    <?php
            tab_with_sponsors_card_type($gallery_data,$post->ID);
        ?>
</div>

<?php

}
function tab_with_sponsors_card_type($data,$pid){
    ?>
    <div class="unique_add">
    <p class="form-field" style="    width: 100%;">
    <label for="organizer_Date" class="org_date"> Platinum Sponsors List: </label>
    </p>
    <div id="css3_animated_slider_sponsors_list" class="wrapper" style="float: left;">

    <?php 
   // $data = (array)$data;
    //var_dump($data);
        if(isset($data) && (is_array($data) && count($data)>0)){
            foreach($data as $kk=>$org_key){
              
            ?>
            <div class="sibling_item<?php  echo '_'.$kk;?> box">
                <?php   //echo $kk;
                 $image_id = get_user_meta( $org_key, 'mycoverimage', true );
                $user_meta=get_userdata($org_key);
                $user_roles=$user_meta->roles;
                if( intval( $image_id ) > 0 ) {
                    // Change with the image size you want to use
                    $image = wp_get_attachment_image( $image_id, 'medium', false, array( 'id' => '','class'=>'image_size_change' ) );
                    //$image =  '<img src="'. esc_url( get_avatar_url( $org_key ) ).'" />';
                } else {
                    $image = '<img id="" class="image_size_change" src="http://0.gravatar.com/avatar/ff8000b5f916451ed6f111c9bd18772d?s=200&d=mm&r=g" />';
                }
                ?>
                <div class="content">
                    <div class="parent_content_box" id="">
                    <div class="image_class">
                        <?php echo $image;?>
                         <div class="image_box_title"><?php echo $user_meta->user_login;?></div>
                    </div>
                        <div class="content_box_children">
                            <div class="col-12" style="text-align:right;">
                                <input class="button remove_children remove_add" type="button" value="Remove" onclick="remove_field_editor_box(this,'<?php echo $kk;?>','<?php echo $pid;?>');" />
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        <?php 
            }
    }
    ?>
    </div>
    
    </div>
    <div class="unique_add">
    <p class="form-field">
        <label for="organizer_Date" class="org_date">Add Sponsors: </label>
        <div class="add_sponsors_loading ">
            <?php 
            //overlay
            $arr ='';
            $selected = '';
            $args = array('fields'=>array('ID','user_login'),'role'         => 'sponsor',);
            $user = get_users( $args );
            dropdown_html_1('sponsors_user_id','Platinum Sponsors User :',$user,$selected);
            ?>
            <span class="text_block">
                <input type="button" name="organizer_sponsors_submit" id="organizer_sponsors_submit_2" placeholder="" value="Add Sponsors">
            </span>
        </div>
    </p>

    </div>
<?php
}

function dropdown_html_1($input_name,$tag,$arr,$selected){
    ?>

<div class="field_row remove_padding">

    <div class="field_left" style="width: 60%;">
        <div class="form_field">
            <label>
                <?php echo $tag;?>
            </label>
            <select name="<?php echo $input_name;?>[]" id="<?php echo $input_name;?>">
                <option value="">Select Platinum Sponsors User</option>
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


add_action('wp_ajax_nopriv_ajax_sponsors_remove', 'sponsors_remove_ajax');
add_action('wp_ajax_ajax_sponsors_remove', 'sponsors_remove_ajax');
function sponsors_remove_ajax(){
    $sponsor_key = $_REQUEST['post_key'];
    
    $post_id = $_REQUEST['post_id'];
    
    $gallery_data = get_post_meta($post_id, 'sponsors_key', true);

    if($sponsor_key!=''){
        unset($gallery_data[$sponsor_key]);    
          
    $update = update_post_meta($post_id, 'sponsors_key', $gallery_data);
    }



   

ob_start();
    ?>
<div class="content_box_children">
    <?php         
                    $arr ='';
                    $selected = '';
                    $args = array('fields'=>array('ID','user_login'));
                    $user = get_users( $args );
                    dropdown_html_1('user_id','Platinum Sponsors User :',$user,$selected);
                        ?>
    <div class="col-12 remove_button" style="text-align:right;">
        <input class="button remove_children" type="button" value="Remove" onclick="remove_field_editor(this);" />
    </div>
</div>
<?php
$htmlcon = ob_get_clean();
$arr = array();
$arr['html'] = $htmlcon;
$arr['htmlimage'] = 'sibling_item_'.$sponsor_key;


echo json_encode($arr);
die(0);
}

add_action('wp_ajax_nopriv_ajax_sponsors_textarea2', 'sponsors_form_ajax');
add_action('wp_ajax_ajax_sponsors_textarea2', 'sponsors_form_ajax');
function sponsors_form_ajax(){
    $sponsor_key = $_REQUEST['sponsor_key'];
    $post_id = $_REQUEST['post_id'];
    
    if($sponsor_key!='' && $post_id!=''){
       $previous = get_post_meta($post_id, 'sponsors_key', true);
        if($previous!='' && is_array($previous)){
            $gallery_data[] = $sponsor_key;
            $gallery_data = array_merge($previous,$gallery_data);
        }else{
            $gallery_data[] = $sponsor_key;
        }
          
    $update = update_post_meta($post_id, 'sponsors_key', $gallery_data);
    }
     $image_id = get_user_meta( $sponsor_key, 'mycoverimage', true );

    $total_arr = sizeof($gallery_data);
    if( intval( $image_id ) > 0 ) {
        // Change with the image size you want to use
        $image = wp_get_attachment_image( $image_id, 'medium', false, array( 'id' => '','class'=>'image_size_change' ) );
    } else {
        $image = '<img id="" class="image_size_change" src="http://0.gravatar.com/avatar/ff8000b5f916451ed6f111c9bd18772d?s=200&d=mm&r=g"  />';
    }

    ob_start();
    ?>
<div class="sibling_item<?php  echo '_'.$total_arr;?> box">
                <?php  
                 $image_id = get_user_meta( $sponsor_key, 'mycoverimage', true );
    $user_meta=get_userdata($sponsor_key);

$user_roles=$user_meta->roles;

    if( intval( $image_id ) > 0 ) {
        
        $image = wp_get_attachment_image( $image_id, 'medium', false, array( 'id' => '','class'=>'image_size_change' ) );
        
    } else {
        $image = '<img id="" class="image_size_change" src="http://0.gravatar.com/avatar/ff8000b5f916451ed6f111c9bd18772d?s=200&d=mm&r=g" />';
    }
     
                ?>
                <div class="content">
                    <div class="parent_content_box" id="">
                    <div class="image_class">
                        <?php echo $image;?>
                         <div class="image_box_title"><?php echo $user_meta->user_login;?></div>
                    </div>
                        <div class="content_box_children">
                            <div class="col-12" style="text-align:right;">
                                <input class="button remove_children remove_add" type="button" value="Remove" onclick="remove_field_editor_box(this,'<?php echo ($total_arr );?>','<?php echo $post_id;?>');" />
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
<?php
$htmlimage = ob_get_clean();

ob_start();
    ?>
<div class="content_box_children">
   
    <?php         
                    $arr ='';
                    $selected = '';
                    $args = array('fields'=>array('ID','user_login'));
                    $user = get_users( $args );
                    dropdown_html_1('user_id','Platinum Sponsors User :',$user,$selected);
                        ?>
    <div class="col-12 remove_button" style="text-align:right;">
        <input class="button remove_children" type="button" value="Remove" onclick="remove_field_editor(this);" />
    </div>
</div>
<?php
$htmlcon = ob_get_clean();
$arr = array();
$arr['html'] = $htmlcon;
$arr['htmlimage'] = $htmlimage;

echo json_encode($arr);
die(0);
}

// add_action( 'init', 'my_script_enqueuer' );

// function my_script_enqueuer() {
//    wp_register_script( "my_voter_script", WP_PLUGIN_URL.'/my_plugin/my_voter_script.js', array('jquery') );
//    wp_localize_script( 'my_voter_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        

//    wp_enqueue_script( 'jquery' );
//    wp_enqueue_script( 'my_voter_script' );

// }