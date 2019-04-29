<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link      
 * @since      1.0.0
 *
 * @package    Multi_step_reg
 * @subpackage Multi_step_reg/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Multi_step_reg
 * @subpackage Multi_step_reg/public
 * @author    
 */
class Multi_step_reg_Public {
   
    private $plugin_name;

    private $version;

    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles(){
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/multi_step_reg-public.css', array(), $this->version, 'all' );
    }

    public function enqueue_scripts(){
        /***
        * JS files in header
        ***/
        wp_register_script( 'msr-jquery-validate', plugin_dir_url( __FILE__ ).'js/jquery.validate.min.js', array('jquery'), $this->version, true );
        wp_register_script( 'msr-formtowizard', plugin_dir_url( __FILE__ ).'js/jquery.formtowizard.js', array('jquery'), $this->version, true );
        /***
        * JS files in Footer
        ***/
        wp_register_script( 'msr-public-js', plugin_dir_url( __FILE__ ).'js/multi_step_reg-public.js', array('jquery'), $this->version, false );
        wp_register_script( 'msr-form-builder', plugin_dir_url( __FILE__ ).'js/form-builder.min.js', array('jquery'), $this->version, false );
        wp_register_script( 'msr-form-render', plugin_dir_url( __FILE__ ).'js/form-render.min.js', array('jquery'), $this->version, false );
        wp_register_script( 'msr-vendor', plugin_dir_url( __FILE__ ).'js/vendor.js', array('jquery'), $this->version, false );       
    }

    public function handle_post_response(){
        if( !isset($_POST['action']) ){
            return;
        }
        if( $_POST['action'] == 'msr_user_registration' ){
            $responseArray     = array();
            $requestData     = $_POST;
            $username     =  $requestData['msr_username'];
            //$username = 'admin2';
            $password = $requestData['msr_password'];
            $email       = $requestData['msr_email'];
            $form_id  = $requestData['form_id'];

            if( !empty($form_id) ){
                $settings      = get_post_meta( $form_id, 'msr_settings', true );
                $settingsArr = json_decode($settings,true);
                $setting      = $settingsArr['settings'];
                $succssmsg = $setting['msr_form_successmessage'];
                /***
                * If setting are present means this is valid form id
                ***/
                if( !empty($setting) ) {
                    $role            = $setting['default_role'];
                    $redirect_url  = isset($setting['redirect_url']) ? $setting['redirect_url'] : '';
                    $enable_notif  = (isset($setting['enable_notification']) ? $setting['enable_notification'] : '');
                    $send_notif_to = $setting['send_notification_to'];
                    $enable_captc  = !empty( $setting['enable_google_captcha'] ) ? 1 : 0;
                    $captc_secret  = (isset($setting['captcha_secret_key']) ? $setting['captcha_secret_key'] : '');
                    $validationRes = $this->msr_registration_validations( $username, $password, $email );
                    $validation    = json_decode($validationRes,true);
                    /***
                    * If google captcha is enabled and our response is not true then redirect it with error message
                    ***/
                    if( $enable_captc ){
                        $postArray = array( 'secret' => $captc_secret,
                                            'response' => $_POST['g-recaptcha-response'] );
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postArray) );
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $server_output = curl_exec ($ch);
                        curl_close ($ch);
                        $response = json_decode($server_output,true);
                        if($response['success'] != true) {
                            $responseArray['status'] = 0;
                            $responseArray['msg'] = 'Invalid captcha';
                            $query_string = http_build_query($responseArray);                           
                            wp_redirect( $redirect_url.'?'.$query_string );
                            die();                       
                        }
                    }
                    /***
                    * If no validation occurs
                    ***/
                    if( !$validation['is_error'] ){
                        $userdata = array(     'user_login' => $username,
                                            'user_email' => $email,
                                             'user_pass'  => $password,
                                             'role'       => $role
                                        );
                        $user_id = wp_insert_user( $userdata );
                        if( $user_id ){
                            $msr_meta_keys = array();
                            /***
                            * If notifications are enabled
                            ***/
                            if( !empty($enable_notif) ){
                                wp_new_user_notification( $user_id, null, $send_notif_to );
                            }
                            /***
                            * If files are uploaded
                            ****/
                            if( !empty($_FILES) ){
                                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                                require_once( ABSPATH . 'wp-admin/includes/media.php' );                       
                                foreach ($_FILES as $file_key => $file) {
                                    $attach_id = media_handle_upload( $file_key, $form_id );
                                    if (is_numeric($attach_id)) {                               
                                        $attachment_url  = wp_get_attachment_url($attach_id);
                                        $msr_meta_keys[] = array( $file_key => $attachment_url );
                                    }
                                }
                            }
                            foreach ($requestData as $meta_key => $meta_value) {
                                if( $meta_key != 'action' &&
                                    $meta_key != 'msr_username' &&
                                    $meta_key != 'msr_email' &&
                                    $meta_key != 'msr_password' &&
                                    $meta_key != 'msr_cpassword' ){
                                    /***
                                    * Updating the form fields in usermeta
                                    ***/
                                    $msr_meta_keys[] = array( $meta_key => $meta_value);
                                }
                                update_user_meta($user_id, '_msr_submitted_data', json_encode($msr_meta_keys) );
                            }
                            $responseArray['status'] = 1;
                            $responseArray['msg'] = $succssmsg;
                        }
                        else{
                            $responseArray['status'] = 0;
                            $responseArray['msg'] = 'Sorry!! Some error occured while registration';
                        }                       
                    }
                    else{
                        $responseArray['status'] = 0;
                        $responseArray['msg'] = $validation['msg'];
                    }
                }               
            }
            else{
                $responseArray['status'] = 0;
                $responseArray['msg'] = 'Invalid form id';
            }
            $query_string = http_build_query($responseArray);
            wp_redirect( $redirect_url.'?'.$query_string );
        }       
    }

    public function msr_registration_validations( $username, $password, $email ){
        $ret['is_error'] = 1;
        if ( empty( $username ) || empty( $password ) || empty( $email ) ) {           
            $ret['msg'] = 'Required form field is missing';
        }
        else if ( 4 > strlen( $username ) ) {
           $ret['msg'] = 'Username too short. At least 4 characters is required';
        }
        else if ( username_exists( $username ) ){
            $ret['msg'] = 'Sorry, that username already exists!';
        }           
        else if ( ! validate_username( $username ) ) {
            $ret['msg'] = 'Sorry, the username you entered is not valid';
        }
        else if ( 5 > strlen( $password ) ) {
            $ret['msg'] = 'Password length must be greater than 5';
        }
        else if ( !is_email( $email ) ) {
            $ret['msg'] ='Email is not valid';
        }
        else if ( email_exists( $email ) ) {
            $ret['msg'] ='Email Already in use';
        }       
        else{
            $ret['is_error'] = 0;
            $ret['msg'] ='All fields are valid';
        }
        return json_encode($ret);
    }   
   
    public function msr_shortcode_callback( $atts ){
        //ob_start();
        if( is_user_logged_in() ){
            return "<a href='".wp_logout_url()."'>Please logout to register</a>";
        }
        else{
            /***
            * Enqueuing the JS scripts at top.
            ***/
            wp_enqueue_script('jquery-ui-core',null,array('jquery'));
            wp_enqueue_script('jquery-effects-slide',null,array('jquery','jquery-ui-core'));
            wp_enqueue_script('msr-jquery-validate');
            wp_enqueue_script('msr-formtowizard');
            wp_enqueue_script('msr-public-js');
            wp_localize_script( 'msr-public-js', 'msr_jsvars', array('msr_admin_ajaxurl' => admin_url('admin-ajax.php')) );

            /***
            * Getting the form id by shortcode attribute
            ***/
            $id             = $atts['id'];
            $sections           = get_post_meta( $id, 'form_sections', true );
            $formSections     = !empty( $sections ) ? $sections : '[]';
            $formsSelector     = '';
            $formSections     = get_post_meta( $id, 'form_sections', true );

            /***
            * Getting the default form from settings json.
            ***/
            $settings       = get_post_meta( $id, 'msr_settings', true );
            $settingsArr  = json_decode($settings,true);
            $default_form = $settingsArr['default_form'];

            if( $settingsArr['settings']['msr_form_dimension_unit'] == 'percent'){
                $width = $settingsArr['settings']['msr_form_width'].'%';
            }
            else{
                $width = $settingsArr['settings']['msr_form_width'].'px';
            }
           
            /***
            * Getting the captcha settings from settings json.
            ***/
            $enable_google_captcha     = !empty( $settingsArr['settings']['enable_google_captcha'] ) ? 1 : 0;
            //$captcha_secret_key     = $settingsArr['settings']['captcha_secret_key'];       
            if( $enable_google_captcha ){
                $captcha_site_key     = $settingsArr['settings']['captcha_site_key'];
                wp_enqueue_script('msr-google-captcha','https://www.google.com/recaptcha/api.js',array('jquery'));
                $captchaHtml = '<fieldset>
                                <div class="g-recaptcha" data-sitekey="'.$captcha_site_key.'"></div>
                                <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
                                </fieldset>';
            }
            else{
                $captchaHtml = '';
            }

            /***
            * Getting all forms.
            ***/
            $formSections = get_post_meta( $id, 'form_sections', true );
            $formSections = json_decode($formSections,true);
            if( empty($formSections) ){
                $formSections = array();
            }
            /***
            * Inserting the default form at first index on all forms.
            ***/
            array_unshift($formSections,$default_form);
            $numberOfForms = count($formSections);
            /*echo "<pre>";
            print_r($numberOfForms);
            echo "</pre>";*/
            /***
            * Making a js variable of all steps
            ***/
            wp_localize_script( 'msr-public-js', 'all_steps', $formSections );

            /***
            * Generating the HTML for multi step form builder
            ***/
            if($numberOfForms > 1){
                for ($i=0; $i < $numberOfForms; $i++) {
                    $formsSelector .= '<fieldset><div class="msr_form_steps"></div></fieldset>';
                }
            }
            else{
                for ($i=0; $i <= 1; $i++) {
                    $formsSelector .= '<fieldset><div class="msr_form_steps"></div></fieldset>';
                }
            }
           

            /***
            * Enqueuing the JS scripts at bottom.
            ***/       
            wp_enqueue_script('msr-form-builder');
            wp_enqueue_script('msr-form-render');
            wp_enqueue_script('msr-vendor');

            $current_url="//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            /***
            * Returning the generate html from shortcode.
            ***/
            if( !empty($_REQUEST['msg']) ){
                $successmsg = '<div>'.$_REQUEST['msg'].'</div>';
            }
            else{
                $successmsg = '';
            }
            return "<div style='width:".$width."' id='msr-form-wrapper'>
                        <div id='form-loader' style='text-align:center'>
                            <img src='".plugins_url()."/multi_step_reg/images/ajax-loader.gif' />
                        </div>
                        <div style='display:none' id='main-form'>
                            <div id='progress'><div id='progress-complete'></div></div>
                            <form enctype='multipart/form-data' method='post' action='' id='SignupForm' novalidate autocomplete='off'>
                                ".$formsSelector."
                                ".$captchaHtml."
                                <input type='hidden' name='action' value='msr_user_registration' />
                                <input type='hidden' name='form_id' value='".$id."' />
                                <input type='hidden' name='current_url' value='".$current_url."' />
                                <button id='SaveAccount' type='submit' class='btn btn-primary submit'>Submit form</button>                       
                            </form>
                        </div>
                    </div>";
        }   
    }

    /***
    * This is the callback function for ajax response when user is filling form.
    * This will check wether an email/username is present in our system.
    ***/
    public function is_field_exists(){
        //If username is requested
        if( isset($_REQUEST['msr_username']) ){
            $username = $_REQUEST['msr_username'];
            if( !username_exists( $username ) ){
                echo "notexists";
            }
            else{
                echo "exists";
            }
        }
        //If email is requested
        elseif ( isset($_REQUEST['msr_email']) ) {
            $email = $_REQUEST['msr_email'];       
            if( !email_exists( $email ) ){
                echo "notexists";
            }
            else{
                echo "exists";
            }
        }
        wp_die();
    }

    public function handle_alert_messages(){
        if( isset($_GET['status']) && ($_GET['status'] == 1) && !empty($_GET['msg']) ){
            $msg = $_GET['msg'];
            echo "<script>alert('$msg')</script>";
        }
    }

}