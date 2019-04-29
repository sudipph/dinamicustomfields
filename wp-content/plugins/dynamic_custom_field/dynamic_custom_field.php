<?php
ini_set('display_errors',1);
/*
Plugin Name: Dynamic Custom Field
Plugin URI: https://google.com/
Description: Just another contact form plugin. Simple but flexible.
Author: Sudip
Text Domain: dynamic-custom-field
Version: 1.0
*/

define('FOLDER_NAME','dynamic_custom_field');
define('PP',plugins_url().'/'.FOLDER_NAME. '/');

add_action('admin_enqueue_scripts', 'dynamic_enqueue_styles');
function dynamic_enqueue_styles()
{
    
    wp_enqueue_style('front-style-colspan', PP.'css/custom_style.css');

   // wp_enqueue_script('jquery_1', PP . 'js/jquery-1.9.1.js',false, 1.1, true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery_colspan', PP . 'js/jquery.collapse.js', array('jquery'), 1.1, true);
    wp_enqueue_script('jquery_colspan_scripts', PP . 'js/scripts.js', array('jquery'), 1.1, true);
    

}
add_action('admin_enqueue_scripts', 'date_time_picker');
function date_time_picker(){

     wp_enqueue_script('jquery');
    wp_enqueue_script('jquery_time_picker_time', PP . 'js/jquery.timepicker.js', array('jquery'), 1.1, true);
    wp_enqueue_style('front_time_picker', PP.'css/jquery.timepicker.min.css');

    wp_enqueue_script('jquery_date_picker_time', PP . 'js/bootstrap-datepicker.js', array('jquery'), 1.1, true);
    wp_enqueue_style('front_date_picker', PP.'css/bootstrap-datepicker.css');


	// <script type="text/javascript" src="lib/bootstrap-datepicker.js"></script>
    // <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker.css" />
    
	// <script type="text/javascript" src="lib/site.js"></script>
    // <link rel="stylesheet" type="text/css" href="lib/site.css" />
    
}
define('SHOW_METABOX_ON', 'event_listing');
add_action('admin_init', 'add_post_dynamin_custom_field');

function add_post_dynamin_custom_field()
{

    $show_metabox_on = SHOW_METABOX_ON;

    add_meta_box(
        'post_content',
        'Agenda Settings',
        'post_content_post_dinamic_content',
        $show_metabox_on,
        'normal',
        'core'
    );
    
}
function post_content_post_dinamic_content()
{
    global $post, $wp_meta_boxes;

    $gallery_data = get_post_meta($post->ID, 'gallery_data', true);

    wp_nonce_field(plugin_basename(__FILE__), 'noncename_so_14445904');
//var_dump($gallery_data);

    ?>

<div id="dynamic_form">
    <div id="field_wrap">
    </div>

    <?php
            tab_with_dinamic_card_type($gallery_data,$post->ID);
        ?>
</div>

<?php

}
function tab_with_dinamic_card_type($data,$pid){
    ?>
<div id="css3_animated_slider">
    <?php 
       if(isset($data['organizer_key']) && count($data['organizer_key'])>0){
           foreach($data['organizer_key'] as $org_key){
           ?>
            <h3 class="root_item"><?php echo $data['organizer_name'][$org_key]; ?> <span class="deleted_item">-</span></h3>

            <div class="sibling_item">
                <div class="content">

                <input type="hidden" class="organizer_key" name="organizer_key[]" value="<?php echo $org_key;?>">
                
                <input type="hidden" name="organizer_name[<?php echo $org_key;?>]" value="<?php echo $data['organizer_name'][$org_key]; ?>">
                
                <div class="field_left" style="width: 60%;    padding-left: 10px;">
                    <div class="form_field">
                    <label>Date : </label>
                    <input type="text" class="date_picker" name="organizer_date[<?php echo $org_key;?>]" value="<?php echo $data['organizer_date'][$org_key]; ?>">
                    </div>
                </div>
                    <div class="parent_content_box" id="">
                    <?php 
                    if(isset($data['rand_number'][$org_key]) && count($data['rand_number'][$org_key])>0){
                        foreach($data['rand_number'][$org_key] as $rand_number){
                            
                            $string_wout_rand = str_replace('_'.$org_key,"",$rand_number);
                           $desc = get_post_meta( $pid, $rand_number.'_description', true ) ;
                           $time_set = get_post_meta( $pid, $rand_number.'_time_set', true ) ;
                           $time_unset = get_post_meta( $pid, $rand_number.'_time_unset', true ) ;
                           $location = get_post_meta( $pid, $rand_number.'_location', true ) ;
                           $image_name = get_post_meta( $pid, $rand_number.'_image_name', true ) ;
                           $topic_id = get_post_meta( $pid, $rand_number.'_topic_id', true ) ;

                           $session = get_post_meta( $pid, $rand_number.'_session', true ) ;
                           $eventname = get_post_meta( $pid, $rand_number.'_eventname', true ) ;
                           $user_id = get_post_meta( $pid, $rand_number.'_user_id', true ) ;
                            $user_id_array = get_post_meta( $pid, $rand_number.'_user_id_array', true ) ;
                    ?>
                        <div class="content_box_children">
                            <input type="hidden" name="rand_number[<?php echo $org_key;?>][<?php echo $string_wout_rand;?>]" value="<?php echo $rand_number;?>">
                            <?php 
                            input_html('eventname','Event Name :',$rand_number,$eventname);
                            $arr ='';
                            

                            $terms = get_terms( "topic", array(
                            'hide_empty' => 0,
                            'fields'=>'all'
                            ) );
                            $place = get_terms( "place", array(
                            'hide_empty' => 0,
                            'fields'=>'all'
                            ) );
                            // echo '<pre>';
                            // var_dump($terms);
                            // echo '</pre>';

                           
                            dropdown_html('topic_id','Select Topic :',$terms,$topic_id,$rand_number,array('a'=>'term_id','b'=>'name'),'Select Topic');
                            
                            time_html('time_set','Time From:',$rand_number,$time_set);
                            time_html('time_unset','Time To:',$rand_number,$time_unset);
                            
                            
                            dropdown_html('location','Select Location :',$place,$location,$rand_number,array('a'=>'term_id','b'=>'name'),'Select Location');
                            
                            image_with_content('image_name','Company URL :',$rand_number,$image_name,'<small>(Image Size : 180X40)</small>');
                            input_html('session','Session :',$rand_number,$session);
                            $arr ='';
                            //$selected = $user_id;
                            $selected = $user_id_array;
                            $args = array('fields'=>array('ID','user_login'),'role' => 'speaker');
                            $user = get_users( $args );
                            //dropdown_html('user_id','User :',$user,$selected,$rand_number);
                            dropdown_html_with_add_more_4('user_id','Speaker User :',$user,$selected,$rand_number,array('a'=>'ID','b'=>'user_login'), 'Select User',$pid);
                            
                            text_editor('description','Description :',$rand_number,$desc);
                            ?>
                            <div class="col-12 remove_button" style="text-align:right;">
                                <input class="button remove_children" type="button" value="Remove" onclick="remove_field_editor(this);" />
                            </div>
                        </div>
                        <?php 
                        }
                    }?>
                    </div>
                    <div id="add_field_row">
                        <input class="button add_field_row_quick" type="button" value="Add Field"  />
                    </div>
                </div>
            </div>
        <?php 
           }
    }?>
</div>
<div class="unique_add">
    <p class="form-field">
        <label for="organizer_Date" class="org_date">Add Date: </label>
        <input type="text" name="organizer_Date" id="organizer_Date" placeholder="" value="">
        <span class="text_block">
            <input type="button" name="organizer_Date_submit" id="organizer_Date_submit" placeholder="" value="Add">
        </span>

    </p>

</div>
<?php
}



add_action('wp_ajax_nopriv_ajax_dynamic_front_checkbox', 'ajax_dynamic_front_checkbox');
add_action('wp_ajax_ajax_dynamic_front_checkbox', 'ajax_dynamic_front_checkbox');
function ajax_dynamic_front_checkbox(){

    $organizer_key = $_REQUEST['current_key'];
$pid = $_REQUEST['post_id'];
$htmlcon = '';
$search_content_arr = $_REQUEST['search_by_term'];
$agenda_location = (isset($_REQUEST['agenda_location'])&&$_REQUEST['agenda_location']!='')?$_REQUEST['agenda_location']:'';

$agenda_location = ($agenda_location==-1)?'':$agenda_location ;
$all_gallery_data = get_post_meta($_REQUEST['post_id'], 'gallery_data', true);
$full_gallery_data_arr = $all_gallery_data['rand_number'][$organizer_key];

$result_for_search  = find_selected_item_from_array($search_content_arr,$full_gallery_data_arr,$pid,$agenda_location);

if((isset($search_content_arr) && count($search_content_arr)>0) || (isset($agenda_location) && $agenda_location!='') ){

}else{
    $result_for_search = $full_gallery_data_arr;
}
if(isset($result_for_search) && count($result_for_search)){
         foreach($result_for_search as $rand_number){
ob_start();
    $org_key = $organizer_key;     
                    //$rand = mt_rand(100000,999999);
                   // $rand_number = $rand.'_'.$organizer_key;
                    
                     $string_wout_rand = str_replace('_'.$org_key,"",$rand_number);
                           $desc = get_post_meta( $pid, $rand_number.'_description', true ) ;
						   $time_set = get_post_meta( $pid, $rand_number.'_time_set', true ) ;
						   $time_unset = get_post_meta( $pid, $rand_number.'_time_unset', true ) ;
                           $location = get_post_meta( $pid, $rand_number.'_location', true ) ;
						   $image_name = get_post_meta( $pid, $rand_number.'_image_name', true ) ;
						   $topic_id = get_post_meta( $pid, $rand_number.'_topic_id', true ) ;
						   $session = get_post_meta( $pid, $rand_number.'_session', true ) ;
						   $eventname = get_post_meta( $pid, $rand_number.'_eventname', true ) ;
                           $user_id = get_post_meta( $pid, $rand_number.'_user_id', true ) ;
                           $user_id_array = get_post_meta( $pid, $rand_number.'_user_id_array', true ) ;
                        
                    ?>
                  		

							
							<div class="agenda_list_outer">
								<div class="agenda_list_inner">
									<div class="left">
										<ul>
											<li class="a_time"><?php echo $time_set.' - '.$time_unset;?></li>
                                            <?php 
											if($location!=''){
											$location_tax = get_term_by("id",$location,'place');
											?>
											<li class="a_loction"><?php echo $location_tax->name;?></li>
                                            <?php }?>
											<li class="a_con_logo" style="background:url('<?php echo $image_name;?>') no-repeat 0 0;">
													
											</li>
										</ul>
									</div>
									<div class="right">
										<ul>
											<li class="a_time_r"><?php echo $session;?></li>
											<li class="a_loction_r"><?php echo $eventname;?></li>
											<?php if($topic_id!=''){ ?>
											<li class="a_specilist">
											
											<?php 
											$topic = get_term_by('id', $topic_id, 'topic');
											
											echo $topic->name;//$topic_id;?></li>
											<?php } ?>
											<li class="a_con_logo_r">
                                            <?php //var_dump($user_id_array);?>
												<div class="left">
													<?php if(isset($user_id)){
														//echo $user_id;
														$user_info = get_userdata($user_id);
														?>
													<div class="lf1">
													<?php echo get_avatar( $user_id, 80 ,'','',array('class'=>'aten_img')); ?>
														
													</div>
													<div class="rit">
														<p class="a_title"><?php echo (isset($user_info->first_name)?$user_info->first_name:'') .' '.(isset($user_info->last_name)?$user_info->last_name:'');?></p>
														 <p class="a_details"><?php echo (isset($user_info->description)?$user_info->description:'');?></p> 
														<div class="a-social-link">
															<span class="link_in_cust" href="#"></span>
															<span class="twi_ter" href="#"></span>
														</div>

													</div>
													<?php }?>
													<div class="a_cs_desc_outer">
														<p class="a_description">

														<?php echo $desc; ?>
														
														</p>
													</div>
												</div>

											</li>
										</ul>
									</div>
								</div>
							</div>
							
<?php
$htmlcon .= ob_get_clean();
        }
}else{
    $htmlcon .= '<div class="no_record_found">No Record Found.</div>';
}
$arr = array();
$arr['html'] = $htmlcon;
$arr['random'] = $organizer_key;
echo json_encode($arr);
die(0);
}

function find_selected_item_from_array($search_content_arr='',$full_gallery_data_arr,$pid,$ajanda_location=''){
    $topic = [];
    $return_result = [];
    if(isset($full_gallery_data_arr) && count($full_gallery_data_arr)>0){
        //foreach($full_gallery_data_arr as $gallery_key){
        for($i=0; $i<count($full_gallery_data_arr);$i++){
              
             $topic_id_cc = get_post_meta( $pid, $full_gallery_data_arr[$i].'_topic_id', true ) ;
             $full_location = get_post_meta( $pid, $full_gallery_data_arr[$i].'_location', true ) ;
             
             $full_location = strtolower($full_location); 
             $ajanda_location = strtolower($ajanda_location);
             if((isset($search_content_arr) && count($search_content_arr)>0 )&& in_array($topic_id_cc,$search_content_arr)){
                $return_result[] = $full_gallery_data_arr[$i];
             }else if (isset($ajanda_location) && $ajanda_location !='' && strpos($full_location, $ajanda_location) !== false) {
                $return_result[] = $full_gallery_data_arr[$i];
            }

            // var_dump(strpos($full_location, $ajanda_location));
             //var_dump($full_location);
             //var_dump($ajanda_location);
             $topic_id[] = $topic_id_cc;
        }            
    }
    //var_dump($return_result);
    return $return_result;
   // return $topic_id;
    
}



add_action('wp_ajax_nopriv_ajax_dynamic_textarea', 'dinamic_form_ajax');
add_action('wp_ajax_ajax_dynamic_textarea', 'dinamic_form_ajax');
function dinamic_form_ajax(){
    $organizer_key = $_REQUEST['organizer_key'];
ob_start();
    ?>
<div class="content_box_children">
    <?php           
                    $rand = mt_rand(100000,999999);
                    $rand_number = $rand.'_'.$organizer_key;
                    ?>
    <input type="hidden" name="rand_number[<?php echo $organizer_key?>][<?php echo $rand;?>]" value="<?php echo $rand_number;?>">
    <?php 
                    input_html('eventname','Event Name :',$rand_number,$value='');
                    $terms = get_terms( "topic", array(
                            'hide_empty' => 0,
                            'fields'=>'all'
                            ) );
                        $place = get_terms( "place", array(
                            'hide_empty' => 0,
                            'fields'=>'all'
                            ) );    
                            // echo '<pre>';
                            // var_dump($terms);
                            // echo '</pre>';
                        $topic_id = '' ;

                           
                            dropdown_html('topic_id','Select Topic :',$terms,$topic_id,$rand_number,array('a'=>'term_id','b'=>'name'),'Select Topic');
                            
                    time_html('time_set','Time From:',$rand_number,$value='');
                    time_html('time_unset','Time To:',$rand_number,$value='');
                    //input_html('location','Location :',$rand_number,$value='');
                    dropdown_html('location','Select Location :',$place,'',$rand_number,array('a'=>'term_id','b'=>'name'),'Select Location');
                            
                    image_with_content('image_name','Company URL :',$rand_number,$value='');
                    input_html('session','Session :',$rand_number,$value='');
                    $arr ='';
                    $selected = '';
                    $args = array('fields'=>array('ID','user_login'));
                    $user = get_users( $args );
                    dropdown_html('user_id','User :',$user,$selected,$rand_number);
                    text_editor('description','Description :',$rand_number,$value='');
                    ?>
    <div class="col-12 remove_button" style="text-align:right;">
        <input class="button remove_children" type="button" value="Remove" onclick="remove_field_editor(this);" />
    </div>
</div>
<?php
$htmlcon = ob_get_clean();
$arr = array();
$arr['html'] = $htmlcon;
$arr['random'] = $rand_number;
echo json_encode($arr);
die(0);
}
function input_html($input_name,$tag,$rand_number,$value){
    ?>
<div class="field_row remove_padding">
    <div class="field_left" style="width: 60%;">
        <div class="form_field">
            <label>
                <?php echo $tag;?>
            </label>
            <input type="text" class="meta_image_url" name="gallery[<?php echo $rand_number;?>][<?php echo $input_name;?>]" value="<?php if (isset($value)) {
        esc_html_e($value);
    }?>" />
        </div>
    </div>
    <div class="clear"></div>
</div>

<?php
}
function dropdown_html_with_add_more_4($input_name,$tag,$arr,$selected,$rand,$ob_arr=array('a'=>'ID','b'=>'user_login'),$select_content = 'Select User',$pid){
    ?>

        
<div class="field_row remove_padding">

    <div class="field_left" style="width: 60%;">
        <div class="form_field">
            <label>
                <?php echo $tag;?>
            </label>
            
            <select name="gallery_no[<?php echo $rand;?>][<?php echo $input_name;?>]" class="selected_box_value">
                <option value=""><?php echo $select_content;?></option>
                <?php 
            if(count($arr)){
                foreach($arr as $user_obj){
                    $a = $ob_arr['a'];
            ?>
                <option value="<?php echo $user_obj->{$a};?>" <?php echo ($selected==$user_obj->{$a}?'selected':'');?>>
                    <?php echo $user_obj->{$ob_arr['b']};?>
                </option>
                <?php }
            }
            ?>
            </select>
            <input type="hidden" class="serialize_data_all" name="gallery[<?php echo $rand;?>][<?php echo $input_name;?>]" value="<?php echo serialize($selected);?>">
       
            <input type="button" name="organizer_sponsors_submit" class="organizer_speaker_submit" data-key="<?php echo $rand;?>" data-id="<?php echo $pid; ?>" placeholder="" value="Add Speaker">
       
        </div>

    </div>


    <div class="clear"></div>
    </div>

    <div class="unique_add speake_list_for_data_value">
        <p class="form-field" style="    width: 100%;">
        <label for="organizer_Date" class="org_date"> Speaker List: </label>
        </p>
        <div id="css3_animated_slider_speaker_list_<?php echo $rand;?>" class="wrapper" style="float: left;">
        <?php 
        // $data = (array)$data;
        //var_dump($data);
        //$selected
      // echo serialize($selected);
       
        $data = $selected;
        //
            if(isset($data) && (is_array($data) && count($data)>0)){
                foreach($data as $kk=>$user_id){  
                ?>
                <div class="sibling_item_speaker<?php  echo '_'.$kk;?> box">
                    <?php   //echo $kk;
                    $image_id = get_user_meta( $user_id, 'mycoverimage', true );
                    
                    $user_meta=get_userdata($user_id);
                   // var_dump($user_meta->user_login);
                    $user_roles=$user_meta->roles;

                    if( intval( $image_id ) > 0 ) {
                        // Change with the image size you want to use
                        $image = wp_get_attachment_image( $image_id, 'medium', false, array( 'id' => '','class'=>'image_size_change' ) );
                        //$image =  '<img src="'. esc_url( get_avatar_url( $user_id ) ).'" />';
                    } else {
                        $image = '<img id="" class="image_size_change" src="http://0.gravatar.com/avatar/ff8000b5f916451ed6f111c9bd18772d?s=200&d=mm&r=g" />';
                    }
                    ?>
                    <div class="content">
                        <div class="parent_content_box" id="">
                            <div class="image_class">
                                <?php echo get_avatar( $user_id, 80 ,'','',array('class'=>'aten_img'));?>
                                <div class="image_box_title"><?php echo $user_meta->user_login;?></div>
                            </div>
                            <div class="content_box_children">
                                <div class="col-12" style="text-align:right;">
                                    <input class="button remove_children remove_add" type="button" value="Remove" onclick="remove_field_editor_box4_user(this,'<?php echo $kk;?>','<?php echo $pid;?>','<?php echo $rand;?>');" />
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
    <?php
}
function dropdown_html($input_name,$tag,$arr,$selected,$rand,$ob_arr=array('a'=>'ID','b'=>'user_login'),$select_content = 'Select User'){
 //   array('ID','user_login')
    ?>

<div class="field_row remove_padding">

    <div class="field_left" style="width: 60%;">
        <div class="form_field">
            <label>
                <?php echo $tag;?>
            </label>
            
            <select name="gallery[<?php echo $rand;?>][<?php echo $input_name;?>]">
                <option value=""><?php echo $select_content;?></option>
                <?php 
            if(count($arr)){
                foreach($arr as $user_obj){
                   $a = $ob_arr['a'];
            ?>
                <option value="<?php echo $user_obj->{$a};?>" <?php echo ($selected==$user_obj->{$a}?'selected':'');?>>
                    <?php echo $user_obj->{$ob_arr['b']};?>
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
function time_html($name,$tag,$rand,$value){
    ?>
<div class="field_row remove_padding">
    <div class="field_left" style="width: 60%;">
        <div class="form_field">
            <label><?php echo $tag;?> </label>
            <input type="text" class="meta_image_url time_picker_link" name="gallery[<?php echo $rand?>][<?php echo $name?>]" value="<?php if (isset($value)) {
        esc_html_e($value);
    }?>" />
        </div>
    </div>
    <div class="clear"></div>
</div>
<?php
}
function image_with_content($name,$tag,$rand_number,$value,$content=''){
    ?>
<div class="field_row remove_padding">
    <div class="field_left" style="width: 60%;">
        <div class="form_field">
            <label><?php echo $tag;?></label>
            <input type="text" class="meta_image_url" name="gallery[<?php echo $rand_number;?>][<?php echo $name;?>]" value="<?php if (isset($value)) {
        esc_html_e($value);
    }?>" /><br><?php echo $content;?>
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

function text_editor($input_name,$tag,$rand_number,$value=''){
    ?>
    <div class="field_row remove_padding" style="padding-bottom: 0px; margin-bottom: 0px;">
        <div class="field_left">
            <div class="" style="padding-bottom: 0px; ">
                <label class="font_change">
                    <?php echo $tag;?> : </label>
                <?php echo wp_editor($value, 'general_info_'.$rand_number, array(
                        'wpautop' => true,
                        'media_buttons' => true,
                        'textarea_name' => 'gallery['.$rand_number.']['.$input_name.']',
                        'textarea_rows' => 10,
                        'teeny' => true,
                    )); ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <?php
}
add_action('admin_head', 'add_conditional_css');

add_action('wp_head', 'add_conditional_css');
function add_conditional_css(){
    ?>
<script>
var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<?php
}

add_action('pre_post_update', 'update_post_gallery_so_14445904', 11, 3);

 function update_post_gallery_so_14445904($post_id, $post_object)
{
        remove_action('save_post', __FUNCTION__);
        $data_content = $_POST['content'];
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if ('revision' == $post_object->post_type) {
            return;
        }

        if (isset($_POST['post_type']) && SHOW_METABOX_ON != $_POST['post_type']) {
            return;
        }

        if (isset($_POST['organizer_key']) && count($_POST['organizer_key']) > 0) {
            $gallery_data = array();
            // for ($i = 0; $i < count($_POST['organizer_key']); $i++) {

            //     if ('' != $_POST['organizer_key'][$i]){
            //         $gallery_data['organizer_key'][] = $_POST['organizer_key'][$i];
            //         $org_key = $_POST['organizer_key'][$i];
            //         $gallery_data['organizer_name'][$org_key] = $_POST['organizer_name'][$org_key];
            //     }
            // }
            
        }

        if (isset($_POST['rand_number']) && count($_POST['rand_number']) > 0) {
            $gallery_data = array();
            for ($i = 0; $i < count($_POST['rand_number']); $i++) {
                if ('' != $_POST['organizer_key'][$i]){
                    $gallery_data['organizer_key'][] = $_POST['organizer_key'][$i];
                    $org_key = $_POST['organizer_key'][$i];
                    $gallery_data['organizer_name'][$org_key] = $_POST['organizer_name'][$org_key];
                    $gallery_data['organizer_date'][$org_key] = $_POST['organizer_date'][$org_key];
                }

                if (isset($_POST['rand_number'][$org_key]) && count($_POST['rand_number'][$org_key])>0){
                    //for ($j = 0; $j < count($_POST['rand_number'][$org_key]); $j++) {
                    foreach($_POST['rand_number'][$org_key] as $key=>$val){        
                        $gallery_data['rand_number'][$org_key][] = $_POST['rand_number'][$org_key][$key];
                        update_rand_content($post_id,$_POST,$_POST['rand_number'][$org_key][$key]);
                    }
                }
            }
            
        }
       // var_dump($gallery_data);
       // die();
        if (isset($gallery_data) && count($gallery_data) > 0){
            $update = update_post_meta($post_id, 'gallery_data', $gallery_data);
        } else {
            delete_post_meta($post_id, 'gallery_data');
        }
        
    }

    function update_rand_content($post_id,$post,$rand_number){
        if (isset($post['gallery'][$rand_number]) && $post['gallery'][$rand_number]) {
            $gallery_data = array();
            if (isset($post['gallery'][$rand_number]['time_set'])) {
                $gallery_data[$rand_number.'_time_set'] = $post['gallery'][$rand_number]['time_set'];
            } else {
                $gallery_data[$rand_number.'_time_set'] = '';
            }


            if (isset($post['gallery'][$rand_number]['time_unset'])) {
                $gallery_data[$rand_number.'_time_unset'] = $post['gallery'][$rand_number]['time_unset'];
            } else {
                $gallery_data[$rand_number.'_time_unset'] = '';
            }
            if (isset($post['gallery'][$rand_number]['location'])) {
                $gallery_data[$rand_number.'_location'] = $post['gallery'][$rand_number]['location'];
            } else {
                $gallery_data[$rand_number.'_location'] = '';
            }
            if (isset($post['gallery'][$rand_number]['image_name'])) {
                $gallery_data[$rand_number.'_image_name'] = $post['gallery'][$rand_number]['image_name'];
            } else {
                $gallery_data[$rand_number.'_image_name'] = '';
            }

            if (isset($post['gallery'][$rand_number]['topic_id'])) {
                $gallery_data[$rand_number.'_topic_id'] = $post['gallery'][$rand_number]['topic_id'];
            } else {
                $gallery_data[$rand_number.'_topic_id'] = '';
            }

            if (isset($post['gallery'][$rand_number]['eventname'])) {
                $gallery_data[$rand_number.'_eventname'] = $post['gallery'][$rand_number]['eventname'];
            } else {
                $gallery_data[$rand_number.'_eventname'] = '';
            }

            if (isset($post['gallery'][$rand_number]['session'])) {
                $gallery_data[$rand_number.'_session'] = $post['gallery'][$rand_number]['session'];
            } else {
                $gallery_data[$rand_number.'_session'] = '';
            }

            if (isset($post['gallery'][$rand_number]['user_id'])) {
                $gallery_data[$rand_number.'_user_id'] = $post['gallery'][$rand_number]['user_id'];
            } else {
                $gallery_data[$rand_number.'_user_id'] = '';
            }
            if (isset($post['gallery'][$rand_number]['description'])) {
                $gallery_data[$rand_number.'_description'] = $post['gallery'][$rand_number]['description'];
            } else {
                $gallery_data[$rand_number.'_description'] = '';
            }
            
            if ($gallery_data) { 
                $update = update_post_meta($post_id, $rand_number.'_description', $gallery_data[$rand_number.'_description']);
                $update = update_post_meta($post_id, $rand_number.'_user_id', $gallery_data[$rand_number.'_user_id']);
                $update = update_post_meta($post_id, $rand_number.'_session', $gallery_data[$rand_number.'_session']);

                $update = update_post_meta($post_id, $rand_number.'_eventname', $gallery_data[$rand_number.'_eventname']);

                $update = update_post_meta($post_id, $rand_number.'_image_name', $gallery_data[$rand_number.'_image_name']);
                $update = update_post_meta($post_id, $rand_number.'_topic_id', $gallery_data[$rand_number.'_topic_id']);

                $update = update_post_meta($post_id, $rand_number.'_location', $gallery_data[$rand_number.'_location']);
                $update = update_post_meta($post_id, $rand_number.'_time_set', $gallery_data[$rand_number.'_time_set']);
                $update = update_post_meta($post_id, $rand_number.'_time_unset', $gallery_data[$rand_number.'_time_unset']);
                
            } else {
                delete_post_meta($post_id, $rand_number.'_description');
                delete_post_meta($post_id, $rand_number.'_user_id');
                delete_post_meta($post_id, $rand_number.'_session');
                delete_post_meta($post_id, $rand_number.'_eventname');
                
                delete_post_meta($post_id, $rand_number.'_image_name');
                delete_post_meta($post_id, $rand_number.'_topic_id');
                delete_post_meta($post_id, $rand_number.'_location');
                delete_post_meta($post_id, $rand_number.'_time_set');
                delete_post_meta($post_id, $rand_number.'_time_unset');

            }


        }
    }


    /** dinamic speaker Add*/

    add_action('wp_ajax_nopriv_ajax_speaker_add_multiple', 'ajax_speaker_add_multiple');
add_action('wp_ajax_ajax_speaker_add_multiple', 'ajax_speaker_add_multiple');

function ajax_speaker_add_multiple(){
    $user_id = $_REQUEST['speaker_key'];
    $post_id = $_REQUEST['post_id'];
    $rand_no = $_REQUEST['rand_no'];
    
    
    $serialize_data = $_REQUEST['serialize_data'];
    //var_dump($serialize_data);
    $arr_serialize = array();
    
    if(isset($serialize_data)&& $serialize_data!=''){

       $arr_serialize = unserialize($serialize_data);
    }
    $new_arr_serialize[] = $user_id ;
    $old_gallery_data = get_post_meta($post_id, $rand_no.'_user_id_array', true);
    //var_dump($old_gallery_data);
    if(is_array($old_gallery_data) && count($old_gallery_data)>0){
        
        $array_store = array_merge($new_arr_serialize,$old_gallery_data);
    }else{
        $array_store = $new_arr_serialize;
    }

    $update = update_post_meta($post_id, $rand_no.'_user_id_array', $array_store);
    
    //$array_store['another'] = $arr_serialize;

   // echo json_encode($array_store);


    
    $total_arr = count($array_store);
    

    ob_start();
    ?>
<div class="sibling_item_speaker<?php  echo '_'.$total_arr;?> box">
                <?php  
                 
    $user_meta=get_userdata($user_id);

$user_roles=$user_meta->roles;

    
                ?>
                <div class="content">
                    <div class="parent_content_box" id="">
                    <div class="image_class">
                       <?php echo get_avatar( $user_id, 80 ,'','',array('class'=>'aten_img'));?>
                       <div class="image_box_title"><?php echo $user_meta->user_login;?></div>
                    </div>
                        <div class="content_box_children">
                            <div class="col-12" style="text-align:right;">
                                <input class="button remove_children remove_add" type="button" value="Remove" onclick="remove_field_editor_box4_user(this,'<?php echo ($total_arr );?>','<?php echo $post_id;?>','<?php echo $rand_no;?>');" />
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
<?php
$htmlimage = ob_get_clean();

 ob_start();
 /*
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
*/
$htmlcon = ob_get_clean();
$arr = array();
$arr['html'] = $htmlcon;
$arr['rand'] = $rand_no;
$arr['htmlimage'] = $htmlimage;

echo json_encode($arr);
die(0);
}




add_action('wp_ajax_nopriv_ajax_sponsors_remove4_from_selected_user', 'sponsors_remove_ajax4_from_selected_user');
add_action('wp_ajax_ajax_sponsors_remove4_from_selected_user', 'sponsors_remove_ajax4_from_selected_user');
function sponsors_remove_ajax4_from_selected_user(){
    $sponsor_key = $_REQUEST['post_key'];
    
    $post_id = $_REQUEST['post_id'];
    $rand = $_REQUEST['rand'];
    
    $gallery_data = get_post_meta($post_id, $rand.'_user_id_array', true);

    if($sponsor_key!=''){
        unset($gallery_data[$sponsor_key]);    
          
    $update = update_post_meta($post_id, $rand.'_user_id_array', $gallery_data);
    }

   

   /*

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
$htmlcon = ob_get_clean();*/
$arr = array();
$htmlcon = '';
$arr['html'] = $htmlcon;
$arr['htmlimage'] = 'sibling_item_speaker_'.$sponsor_key;


echo json_encode($arr);
die(0);
}

?>