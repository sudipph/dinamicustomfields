<?php
ini_set('display_errors',1);
/*
Plugin Name: Diamond User Management
Plugin URI: https://google.com/
Description: Just another contact form plugin. Simple but flexible.
Author: Sudip
Text Domain: diamonduser-management
Version: 1.0
*/

define('PP4',plugin_dir_url(__FILE__));

define('PLACE','Place');
define('PS','place');
define('SHOW_METABOX_ON4', 'event_listing');
add_action('admin_enqueue_scripts', 'dynamic_enqueue_styles_user4');
function dynamic_enqueue_styles_user4()
{
    
    wp_enqueue_style('front-style-colspan_user4', PP4.'css/custom_style.css');
    wp_enqueue_script('jquery');
   wp_enqueue_script('jquery_colspan_scripts_user4', PP4 . 'js/scripts.js', array('jquery'), 1.1, true);
    

}

function wps_add_role4() {
   $pp = array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => false,
        'delete_posts' => false, // Use false to explicitly deny
    );
    add_role( 'dsponsors', 'Diamond Sponsors', 
             $pp
    );
     add_role( 'sponsor', 'Platinum Sponsors', 
             $pp
    );
     add_role( 'nsponsor', 'Sponsors', 
             $pp
    );
    add_role( 'kspeaker', 'Keynote Speakers', 
             $pp
    );
    add_role( 'ospeaker', 'Our Speakers', 
             $pp
    );
}
add_action( 'init', 'wps_add_role4' );

/**sponsors custom fields */

add_action('admin_init', 'add_post_sponsors_custom_field4');

function add_post_sponsors_custom_field4()
{

    $show_metabox_on = SHOW_METABOX_ON4;

    add_meta_box(
        'dsponsors_content',
        'Diamond Sponsors Settings',
        'post_content_post_sponsors_content4',
        $show_metabox_on,
        'normal',
        'core'
    );
    
}
function post_content_post_sponsors_content4()
{
    global $post, $wp_meta_boxes;

    $gallery_data = get_post_meta($post->ID, 'dsponsors_key', true);

    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');
///var_dump(($gallery_data));
    ?>

<div id="dynamic_form">
<input type="hidden" name="sponsor_post_id4" id="sponsor_post_id4" value="<?php echo $post->ID?>" >
    <div id="field_wrap">
    </div>

    <?php
            tab_with_sponsors_card_type4($gallery_data,$post->ID);
        ?>
</div>

<?php

}
function tab_with_sponsors_card_type4($data,$pid){
    ?>
    <div class="unique_add">
        <p class="form-field" style="    width: 100%;">
        <label for="organizer_Date" class="org_date"> Diamond Sponsors List: </label>
        </p>
        <div id="css3_animated_slider_sponsors_list4" class="wrapper" style="float: left;">
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
                                    <input class="button remove_children remove_add" type="button" value="Remove" onclick="remove_field_editor_box4(this,'<?php echo $kk;?>','<?php echo $pid;?>');" />
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
            <label for="organizer_Date" class="org_date">Add Diamond Sponsors: </label>
            <div class="add_sponsors_loading ">
                <?php 
                //overlay
                $arr ='';
                $selected = '';
                $args = array('fields'=>array('ID','user_login'),'role'         => 'dsponsors',);
                $user = get_users( $args );
                dropdown_html_4('sponsors_user_id4','Diamond Sponsors User :',$user,$selected);
                ?>
                <span class="text_block">
                    <input type="button" name="organizer_sponsors_submit" id="organizer_sponsors_submit_4" placeholder="" value="Add Diamond Sponsors">
                </span>
            </div>
        </p>
    </div>
<?php
}

function dropdown_html_4($input_name,$tag,$arr,$selected){
    ?>

        <div class="field_row remove_padding">

        <div class="field_left" style="width: 60%;">
            <div class="form_field">
                <label>
                    <?php echo $tag;?>
                </label>
                <select name="<?php echo $input_name;?>[]" id="<?php echo $input_name;?>">
                    <option value="">Select Diamond Sponsors User</option>
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


add_action('wp_ajax_nopriv_ajax_sponsors_remove4', 'sponsors_remove_ajax4');
add_action('wp_ajax_ajax_sponsors_remove4', 'sponsors_remove_ajax4');
function sponsors_remove_ajax4(){
    $sponsor_key = $_REQUEST['post_key'];
    
    $post_id = $_REQUEST['post_id'];
    
    $gallery_data = get_post_meta($post_id, 'dsponsors_key', true);

    if($sponsor_key!=''){
        unset($gallery_data[$sponsor_key]);    
          
    $update = update_post_meta($post_id, 'dsponsors_key', $gallery_data);
    }

   

   

ob_start();
    ?>
<div class="content_box_children">
    <?php         
                    $arr ='';
                    $selected = '';
                    $args = array('fields'=>array('ID','user_login'),'role'         => 'dsponsors');
                    $user = get_users( $args );
                    dropdown_html_4('user_id','User :',$user,$selected);
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

add_action('wp_ajax_nopriv_ajax_sponsors_textarea4', 'sponsors_form_ajax4');
add_action('wp_ajax_ajax_sponsors_textarea4', 'sponsors_form_ajax4');

function sponsors_form_ajax4(){
    $sponsor_key = $_REQUEST['sponsor_key'];
    $post_id = $_REQUEST['post_id'];
    
    if($sponsor_key!='' && $post_id!=''){
       $previous = get_post_meta($post_id, 'dsponsors_key', true);
        if($previous!='' && is_array($previous)){
            $gallery_data[] = $sponsor_key;
            $gallery_data = array_merge($previous,$gallery_data);
        }else{
            $gallery_data[] = $sponsor_key;
        }
          
    $update = update_post_meta($post_id, 'dsponsors_key', $gallery_data);
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
                                <input class="button remove_children remove_add" type="button" value="Remove" onclick="remove_field_editor_box4(this,'<?php echo ($total_arr );?>','<?php echo $post_id;?>');" />
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
                    $args = array('fields'=>array('ID','user_login'),'role'         => 'dsponsors');
                    $user = get_users( $args );
                    dropdown_html_4('user_id','User :',$user,$selected);
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

/** Topic ategory*/

add_action( 'init', 'create_tag_taxonomies', 0 );

//create two taxonomies, genres and tags for the post type "tag"
function create_tag_taxonomies() 
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Topic', 'taxonomy general name' ),
    'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Topic' ),
    'popular_items' => __( 'Popular Topic' ),
    'all_items' => __( 'All Topic' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Tag' ), 
    'update_item' => __( 'Update Tag' ),
    'add_new_item' => __( 'Add New Tag' ),
    'new_item_name' => __( 'New Tag Name' ),
    'separate_items_with_commas' => __( 'Separate tags with commas' ),
    'add_or_remove_items' => __( 'Add or remove tags' ),
    'choose_from_most_used' => __( 'Choose from the most used tags' ),
    'menu_name' => __( 'Topic' ),
  ); 

  register_taxonomy('topic','event_listing',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'topic' ),
  ));
  $labels = array(
    'name' => _x( 'Location', 'taxonomy general name' ),
    'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Location' ),
    'popular_items' => __( 'Popular Location' ),
    'all_items' => __( 'All Location' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Tag' ), 
    'update_item' => __( 'Update Tag' ),
    'add_new_item' => __( 'Add New Tag' ),
    'new_item_name' => __( 'New Tag Name' ),
    'separate_items_with_commas' => __( 'Separate tags with commas' ),
    'add_or_remove_items' => __( 'Add or remove tags' ),
    'choose_from_most_used' => __( 'Choose from the most used tags' ),
    'menu_name' => __( 'Location' ),
  ); 

  register_taxonomy('location','event_listing',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'location' ),
  ));
  $labels = array(
    'name' => _x( PLACE, 'taxonomy general name' ),
    'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search '.PLACE ),
    'popular_items' => __( 'Popular '.PLACE ),
    'all_items' => __( 'All '.PLACE ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Tag' ), 
    'update_item' => __( 'Update Tag' ),
    'add_new_item' => __( 'Add New Tag' ),
    'new_item_name' => __( 'New Tag Name' ),
    'separate_items_with_commas' => __( 'Separate tags with commas' ),
    'add_or_remove_items' => __( 'Add or remove tags' ),
    'choose_from_most_used' => __( 'Choose from the most used tags' ),
    'menu_name' => __( PLACE ),
  ); 

  register_taxonomy(PS,'event_listing',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => PS ),
  ));
}