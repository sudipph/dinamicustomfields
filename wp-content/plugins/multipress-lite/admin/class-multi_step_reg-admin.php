<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       
 * @since      1.0.0
 *
 * @package    Multi_step_reg
 * @subpackage Multi_step_reg/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Multi_step_reg
 * @subpackage Multi_step_reg/admin
 * @author     
 */
class Multi_step_reg_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style('thickbox');
		wp_enqueue_style( 'msr_admin_css', plugin_dir_url( __FILE__ ).'css/multi_step_reg-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $post ) {		
		global $post;
		wp_enqueue_media();
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('thickbox', null, array('jquery') );
		wp_register_script( 'msr-demo', plugin_dir_url(__FILE__).'js/demo.js' );
		if( !empty($post->ID) ){
			$formSections = get_post_meta( $post->ID, 'form_sections', true );
			if( !empty($formSections) ){
				$formSections = json_decode($formSections,true);
				wp_localize_script( 'msr-demo', 'all_steps', $formSections );
			}
			else{
				wp_localize_script( 'msr-demo', 'all_steps', array() );
			}
		}
		if( get_post_type($post) == 'multi_step_reg' ){
			wp_enqueue_script( 'msr-admin', plugin_dir_url( __FILE__ ) . 'js/multi_step_reg-admin.js', array( 'jquery','jquery-ui-tabs' ), $this->version, false );
			wp_enqueue_script( 'msr-demo', '', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( 'msr-form-builder', plugin_dir_url( __FILE__ ) . 'js/form-builder.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( 'msr-form-render', plugin_dir_url( __FILE__ ) . 'js/form-render.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( 'msr-vendor', plugin_dir_url( __FILE__ ) . 'js/vendor.js', array( 'jquery' ), $this->version, false );
		}		
	}	

	public function register_post_type_callback(){
		$labels = array('name'               => _x( 'MultiPress Lite', 'post type general name', 'multi-step-form' ),
						'singular_name'      => _x( 'MultiPress Lite', 'post type singular name', 'multi-step-form' ),
						'menu_name'          => _x( 'MultiPress Lite', 'admin menu', 'multi-step-form' ),
						'name_admin_bar'     => _x( 'MultiPress Lite', 'add new on admin bar', 'multi-step-form' ),
						'add_new'            => _x( 'Add New', 'Form', 'multi-step-form' ),
						'add_new_item'       => __( 'Add New Form', 'multi-step-form' ),
						'new_item'           => __( 'New Form', 'multi-step-form' ),
						'edit_item'          => __( 'Edit Form', 'multi-step-form' ),
						'view_item'          => __( 'View Form', 'multi-step-form' ),
						'all_items'          => __( 'All Forms', 'multi-step-form' ),
						'search_items'       => __( 'Search Form', 'multi-step-form' ),
						'parent_item_colon'  => __( 'Parent Form:', 'multi-step-form' ),
						'not_found'          => __( 'No Form found.', 'multi-step-form' ),
						'not_found_in_trash' => __( 'No Form found in Trash.', 'multi-step-form' )
					);
		$args = array(	'labels'             => $labels,
				        'description'        => __( 'Description.', 'multi-step-form' ),
						'public'             => true,
						'publicly_queryable' => true,
						'show_ui'            => true,
						'show_in_menu'       => true,
						'query_var'          => true,
						'rewrite'            => array( 'slug' => 'MSF' ),
						'capability_type'    => 'post',
						'has_archive'        => true,
						'hierarchical'       => false,
						'menu_position'      => null,
						'menu_icon'           => plugins_url().'/multipress-lite/images/tabIcon.jpg',
						'supports'           => array( 'title' )
					);
                    //Allowing user to enter only one form
		global $wpdb;
		$table = $wpdb->prefix."posts";
		$sql = "SELECT count(id) AS forms FROM $table WHERE post_type = 'multi_step_reg' AND post_status != 'auto-draft' ";
		$forms = $wpdb->get_var($sql);
		if( $forms != 0 ){
			$args['capabilities'] = array( 'create_posts' => 'do_not_allow');
			$args['map_meta_cap'] = true;
		}		
		register_post_type( 'multi_step_reg', $args );		
	}
	
	public function add_meta_boxs(){
		add_meta_box( 'msf-generate_shortcode', 'Shortcode', array($this,'msf_generate_shortcode'), 'multi_step_reg', 'side', 'high' );		
		add_meta_box( 'msf-settings', 'Settings', array($this,'meta_box_content'), 'multi_step_reg', 'side', 'default' );
		add_meta_box( 'msf-choose_fields', 'Default Form (Step 1)', array($this,'msr_default_form'), 'multi_step_reg', 'normal', 'default' );
        add_meta_box( 'msf-upgrade', 'MultiPress Pro Features', array($this,'msr_upgrade'), 'multi_step_reg', 'normal', 'low' );
		/***
		* If post is edit/update then only show multi step form
		***/
		if( !empty($_GET['post']) ){			
			add_meta_box( 'msf-form', 'Generate Form <br/><small class="small">(This form is independent and it is mendatory to click on "Save Steps" button after your step is ready)</small>', array($this,'form_builder'), 'multi_step_reg', 'normal', 'default' );
		}
	}
    
    public function msr_upgrade(){
        
        echo '<h1>#1. [ Create Multiple Registration Forms ]</h1>';
        echo '<p>With MultiPress Pro you are free to create unlimited kind of registration forms for different purposes.</p>';
        
        echo '<h1>#2. [ Paid Registration via Paypal ]</h1>';
        echo '<p>Create paid registration so user can pay fee for registration at your website. Redirect to custom thanks page after registration</p>';
        
        echo '<h1>#3. [ Redirect User After Registration ]</h1>';
        echo '<p>If you want to send user to specific url for each form then pro version would work for you.</p>';
        
        echo '<h1>#4. [ Role Based Registration For Different Forms ]</h1>';
        echo '<p>Specifiy different roles to different kind of registration forms i.e Editor, Subscriber, Contributor etc</p>';
        
        echo '<h1>#5. [ Google reCaptcha Available ]</h1>';
        echo '<p>Prevent bots from registration. Pro version enables Google reCaptcha to insert into your registration form.</p>';
        
        echo '<h1>#6. [ Buttons Text Editing ]</h1>';
        echo '<p>Write your own text for Next/Previous & Submit Buttons to give it more your niche feeling.</p>';
        
        echo '<h1>#7. [ Text Styling & Color Schema ]</h1>';
        echo '<p>Customize form body & all elements color schema, font size etc</p>';
        
        echo '<h1>#8. [ Quick Help & Support ]</h1>';
        echo '<p>Get instant help with our Live Chat Feature & Support from Tickting system with in 12-hrs response time.</p>';
        
        echo '<p style="text-align:center; margin-top: 50px;"><a href="https://www.witoni.com/product/multipress-pro/" target="_blank" rel="noopener"><img class="aligncenter" src="https://www.witoni.com/wp-content/uploads/2018/03/30off.jpg"></a></p>';
    }

	public function add_notification_before_title(){
		global $pagenow;
		/***
		* If new post is added, then force user to save the first step
		***/
		if( ($pagenow == 'post-new.php') && empty($_GET['post']) && ('multi_step_reg' == get_post_type()) ){
			echo "<div class='updated'><p>It is mandatory to save step 1, after that you can add unlimited steps. Have fun!!</p></div>";
		}
	}

	public function msr_default_form( $post ){
		
		$settings = get_post_meta( $post->ID, 'msr_settings', true );
		if( !empty( $settings ) ){
			$setting = json_decode($settings,true);
			if( !empty($setting) ){
				$data = $setting['default_form'];
				if(!empty($data)){
					foreach ($data as $j => $var) {
						if( $var['label'] == 'username' ){
							$user_classname 	= $var['className'];
							$user_placeholder 	= $var['placeholder'];
							$user_nameattr 		= $var['name'];
						}
						elseif( $var['label'] == 'email' ){
							$email_classname 	= $var['className'];
							$email_placeholder 	= $var['placeholder'];
							$email_nameattr 	= $var['name'];	
						}
						elseif( $var['label'] == 'password' ){
							$pass_classname 	= $var['className'];
							$pass_placeholder 	= $var['placeholder'];
							$pass_nameattr 		= $var['name'];
						}
						elseif( $var['label'] == 'confirm_password' ){
							$cpass_classname 	= $var['className'];
							$cpass_placeholder 	= $var['placeholder'];
							$cpass_nameattr 	= $var['name'];
						}
					}
				}				
			}			
		}
		$user_classname 	= !empty($user_classname) ? $user_classname : '';
		$user_placeholder 	= !empty($user_placeholder) ? $user_placeholder : '';
		$user_nameattr 		= !empty($user_nameattr) ? $user_nameattr : '';
		$email_classname 	= !empty($email_classname) ? $email_classname : '';
		$email_placeholder 	= !empty($email_placeholder) ? $email_placeholder : '';
		$email_nameattr 	= !empty($email_nameattr) ? $email_nameattr : '';
		$pass_classname 	= !empty($pass_classname) ? $pass_classname : '';
		$pass_placeholder 	= !empty($pass_placeholder) ? $pass_placeholder : '';
		$pass_nameattr 		= !empty($pass_nameattr) ? $pass_nameattr : '';
		$cpass_classname 	= !empty($cpass_classname) ? $cpass_classname : '';
		$cpass_placeholder 	= !empty($cpass_placeholder) ? $cpass_placeholder : '';
		$cpass_nameattr 	= !empty($cpass_nameattr) ? $cpass_nameattr : '';		
		$bannerImage = "<a href='https://www.witoni.com/product/multipress-pro/' target='_blank'><img src='http://www.witoni.com/wp-content/uploads/2018/03/buy-multistep-pro-banner.gif' /></a>";
		echo '<div id="default_form">
				<table>
					<tr>
						<td>
							<table class="innertable">
								<tr><td colspan="2"><b>Username</b></td></tr>					
								<tr>
									<td width="20%"><label for="username_class">Class</label></td>
									<td width="80%"><input name="msr[username][class]" id="username_class" value="'.$user_classname.'" type="text" class="form-control"></td>
								</tr>
								<tr>
									<td width="20%"><label for="username_placeholder">Placeholder</label></td>
									<td width="80%"><input name="msr[username][placeholder]" id="username_placeholder" value="'.$user_placeholder.'" type="text" class="form-control"></td>
								</tr>
							</table>
						</td>
						<td>
							<table class="innertable">
								<tr><td colspan="2"><b>Email</b></td></tr>					
								<tr>
									<td width="20%"><label for="email_class">Class</label></td>
									<td width="80%"><input name="msr[email][class]" id="email_class" value="'.$email_classname.'" type="text" class="form-control"></td>
								</tr>
								<tr>
									<td width="20%"><label for="email_placeholder">Placeholder</label></td>
									<td width="80%"><input name="msr[email][placeholder]" id="email_placeholder" value="'.$email_placeholder.'" type="text" class="form-control"></td>
								</tr>					
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table class="innertable">
								<tr><td colspan="2"><b>Password</b></td></tr>					
								<tr>
									<td width="20%"><label for="password_class">Class</label></td>
									<td width="80%"><input name="msr[password][class]" id="password_class" value="'.$pass_classname.'" type="text" class="form-control"></td>
								</tr>
								<tr>
									<td width="20%"><label for="password_placeholder">Placeholder</label></td>
									<td width="80%"><input name="msr[password][placeholder]" id="password_placeholder" value="'.$pass_placeholder.'" type="text" class="form-control"></td>
								</tr>
							</table>
						</td>
						<td>
							<table class="innertable">
								<tr><td colspan="2"><b>Confirm Password</b></td></tr>					
								<tr>
									<td width="20%"><label for="confirm_password_class">Class</label></td>
									<td width="80%"><input name="msr[confirm_password][class]" id="confirm_password_class"  value="'.$cpass_classname.'" type="text" class="form-control"></td>
								</tr>
								<tr>
									<td width="20%"><label for="confirm_password_placehoder">Placeholder</label></td>
									<td width="80%"><input name="msr[confirm_password][placeholder]" id="confirm_password_placehoder" value="'.$cpass_placeholder.'" type="text" class="form-control"></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<script>
			jQuery(document).ready(function(){
				jQuery("#msf-choose_fields").before("'.$bannerImage.'");
			})
			</script>';		
	}
	
	public function msf_generate_shortcode( $post ){
		$shortcode = htmlspecialchars('[multi_step_reg id="'.$post->ID.'"]');
		echo '<input type="text" class="form-control" value="'.$shortcode.'" /></td>';
	}

	public function meta_box_content( $post ){
		$settings = get_post_meta( $post->ID, 'msr_settings', true );
		if( !empty( $settings ) ){
			$setting 	  			= json_decode($settings,true);			
			$defaultRole  			= !empty($setting['settings']['default_role']) ? $setting['settings']['default_role'] : 'editor';
			$redirect_url 			= !empty($setting['settings']['redirect_url']) ? $setting['settings']['redirect_url'] : site_url();
			$enable_notification 	= !empty($setting['settings']['enable_notification']) ? 'checked="checked"' : '';
			$send_notification_to 	= !empty($setting['settings']['send_notification_to'])?$setting['settings']['send_notification_to']:'admin';
			$enable_google_captcha 	= !empty($setting['settings']['enable_google_captcha']) ? 'checked="checked"' : '';
			$captcha_secret_key 	= !empty($setting['settings']['captcha_secret_key']) ? $setting['settings']['captcha_secret_key'] : '';
			$captcha_site_key 		= !empty($setting['settings']['captcha_site_key']) ? $setting['settings']['captcha_site_key'] : '';

			$msr_form_width 			= !empty($setting['settings']['msr_form_width']) ? $setting['settings']['msr_form_width'] : '100';
			$msr_form_dimension_unit 	= !empty($setting['settings']['msr_form_dimension_unit']) ? $setting['settings']['msr_form_dimension_unit'] : 'percentage';
			$msr_form_successmessage 	= !empty($setting['settings']['msr_form_successmessage']) ? $setting['settings']['msr_form_successmessage'] : 'User successfully registered';

			//print_r($setting['settings']);
			if( !empty($defaultRole) )
				$default_role = $defaultRole;
			else
				$default_role = 'editor';	
		} ?>
		<table class="settingsFormTable">
			<tr>
				<td><b>Form Width</b></td>
			</tr>
			<tr>				
				<td>
					<div style="width:100%;clear:both">
						<input style="width:80%;float:left" value="<?php echo $msr_form_width ?>" type="number" name="msr_form_width" >
						<select style="width:20%;float:left" name="msr_form_dimension_unit" class="form-control">
							<?php
							if($msr_form_dimension_unit == 'percent'){
								echo '<option selected value="percent">%</option>
									<option value="pixel">px</option>';
							}
							elseif($msr_form_dimension_unit == 'pixel'){
								echo '<option value="percent">%</option>
									<option selected value="pixel">px</option>';
							}
							else{
								echo '<option selected value="percent">%</option>
									<option value="pixel">px</option>';	
							}
							?>							
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td><b>Success Message</b></td>
			</tr>
			<tr>
				<td><input type="text" name="msr_form_successmessage" value="<?php echo $msr_form_successmessage ?>" class="form-control"></td>
			</tr>
            
		</table>
						
	<?php 
	}

	/***
	* Generating the html for the post
	***/
	public function form_builder( $post ){
		echo '<div data-formid="'.$post->ID.'" id="msr-form-builder" class="content">';
			$nu_forms = $this->get_number_of_forms($post->ID);		 
			echo '<ul>';
			for ($i=0; $i < $nu_forms; $i++) {
				$j = $i+2;
				echo '<li><a href="#tab-'.$i.'">Step: '.($i+2).' <span class="dashicons dashicons-dismiss"></span> </a></li>';
			}
			echo '<li><a id="nextStep" data-formid="'.$post->ID.'" data-stepnumber="'.($nu_forms+1).'" class="button button-primary"><span style="vertical-align: middle; height: auto;" class="dashicons dashicons-plus-alt"></span> Add Step</a></li>
					<a class="button button-secondary pull-right" href="javascript:void(0)" id="save-all">Save Steps</a>';
			echo '</ul>';
			for ($i=0; $i < $nu_forms; $i++) {
				$j = $i+2;
				echo '<div id="tab-'.$i.'" class="parent-tab" >
						<div class="build-wrap"></div>
						<form class="render-wrap"></form>
					</div>';
			}
		echo '</div>';
	}	

	/***
	* Handling the user ajax response, if user is login or for admin area.
	***/
	public function handle_logedin_response(){
		$response = array('status'=>false);
		switch ($_POST['action']) {
			case 'action_number_of_fields_to_repeat':
				if( $_POST['form_id'] ){
					$form_id = esc_attr($_POST['form_id']);
					$number  = esc_attr($_POST['fields']);
					$newForm['data'] = array();
					$stepsAdded = $this->save_number_of_forms( $form_id, $newForm );
					if( $stepsAdded ){
						$response['status']  = true;
						$response['message'] = 'Step has been successfully saved';
						$response['response_code'] = '1002';
					}
					else{
						$response['status']  = false;
						$response['message'] = 'Some error occured while adding the step';
						$response['response_code'] = '1003';
					}					
					$this->get_json_response( $response );
				}				
			break;
			case 'save_section_form':
				if( !empty($_POST['formData']) ){
					$form 		= array();
					$form_data	= $_POST['formData'];					
					$form_id 	= esc_attr($_POST['form_id']);					
					if( !empty($form_data) ){						
						foreach ($form_data as $key => $json) {
							$json = stripslashes($json);
							$form[] = json_decode($json,true);							
						}
					}
					$formStr = json_encode($form);
					$saved = update_post_meta( $form_id, 'form_sections', $formStr );
					$response['status']  = true;
					$response['message'] = 'Form has been updated';
					$response['response_code'] = '1002';
					$this->get_json_response( $response );
				}			
			break;
			case 'delete_section_form':
				if( $_POST['form_id'] ){
					$form_id = esc_attr($_POST['form_id']);
					$number  = esc_attr($_POST['step_number']);
					$number  = substr($number, 5);
					$deleted = $this->delete_step( $form_id, $number );
					if( $deleted ){
						$response['status']  = true;
						$response['message'] = 'Step has been deleted successfully';
						$response['response_code'] = '1002';
					}
					else{
						$response['status']  = false;
						$response['message'] = 'Some error occured while deleting the step';
						$response['response_code'] = '1003';
					}					
					$this->get_json_response( $response );
				}			
			break;
			default:
				$response['message'] = 'Invalid action';
				$response['response_code'] = '1001';
				$this->get_json_response( $response );
			break;
		}		
	}

	public function get_json_response( $responseArr ){
		header('Content-type:json');
		echo json_encode($responseArr);
		wp_die();
	}

	public function get_number_of_forms($postID){
		$nu_forms 	= get_post_meta( $postID, 'form_sections', true );
		//$nu_forms = get_post_meta( $postID, 'msr_number_of_forms', true );
		if( empty($nu_forms) ){
			$nu_forms = 0;
		}
		else{
			$sections = json_decode($nu_forms,true);
			$steps 	  = array_keys($sections);
			/*$Steps = array();
			foreach ($steps as $i => $val) {
				$st = explode("step_", $val);
				$Steps[] = $st[1];	
			}
			$nu_forms = max($Steps);*/
			$nu_forms = count($steps);
		}
		return $nu_forms;
	}

	public function get_forms($postID){
		$nu_forms 	= get_post_meta( $postID, 'form_sections', true );
		if( empty($nu_forms) ){
			$nu_forms = array();
		}
		else{
			$nu_forms = json_decode($nu_forms,true);			
		}
		return $nu_forms;
	}

	/***
	* Saving the user generated form in post meta
	***/
	public function save_number_of_forms( $postID, $newForm ){
		$array 	= array();
		$stepNo = 0;
		$forms 	= get_post_meta( $postID, 'form_sections', true );
		//If form is already present then updating it
		if( !empty($forms) ){
			$forms = json_decode($forms,true);
			$forms[] = $newForm['data'];
			$encodedArray = json_encode($forms);
		}
		else{
			$array[] = $newForm['data'];
			$encodedArray = json_encode($array);			
		}
		return update_post_meta( $postID, 'form_sections', $encodedArray );
	}

	/***
	* Deleting the section from the form
	***/
	public function delete_step( $postID, $stepNo ){
		$array 	= array();
		$forms 	= get_post_meta( $postID, 'form_sections', true );
		//If form is already present then updating it
		if( !empty($forms) ){
			$forms = json_decode($forms,true);
			unset( $forms[$stepNo] );
			$forms = array_values($forms);
			$encodedArray = json_encode($forms);
			return update_post_meta( $postID, 'form_sections', $encodedArray );	
		}
	}
	
	/**
	* Save post metadata when a post is saved.
	*
	* @param int $post_id The post ID.
	* @param post $post The post object.
	* @param bool $update Whether this is an existing post being updated or not.
	*/
	public function save_msf( $post_id ){		
		$post_type = get_post_type($post_id);
		if ( "multi_step_reg" != $post_type ) {
			return;
		}
		else{
			$pagedata = array();
			if( !empty( $_POST['msr_default_role'] ) ){
				$pagedata['settings']['default_role'] = $_POST['msr_default_role'];				
			}
			if( !empty( $_POST['msr_redirect_url'] ) ){
				$pagedata['settings']['redirect_url'] = $_POST['msr_redirect_url'];
			}
			if( !empty( $_POST['msr_enable_notification'] ) ){
				$pagedata['settings']['enable_notification'] = $_POST['msr_enable_notification'];
			}
			if( !empty( $_POST['msr_send_notification_to'] ) ){
				$pagedata['settings']['send_notification_to'] = $_POST['msr_send_notification_to'];
			}
			if( !empty( $_POST['msr_enable_google_captcha'] ) ){
				$pagedata['settings']['enable_google_captcha'] = $_POST['msr_enable_google_captcha'];
			}
			if( !empty( $_POST['msr_captcha_secret_key'] ) ){
				$pagedata['settings']['captcha_secret_key'] = $_POST['msr_captcha_secret_key'];
			}
			if( !empty( $_POST['msr_captcha_site_key'] ) ){
				$pagedata['settings']['captcha_site_key'] = $_POST['msr_captcha_site_key'];
			}
			if( !empty( $_POST['msr_form_dimension_unit'] ) ){
				$pagedata['settings']['msr_form_dimension_unit'] = $_POST['msr_form_dimension_unit'];
			}
			if( !empty( $_POST['msr_form_width'] ) ){
				$pagedata['settings']['msr_form_width'] = $_POST['msr_form_width'];
			}
			if( !empty( $_POST['msr_form_successmessage'] ) ){
				$pagedata['settings']['msr_form_successmessage'] = $_POST['msr_form_successmessage'];
			}
			if( !empty( $_POST['msr'] ) ){
				$msr = $_POST['msr'];
				$i = 0;
				$arr = array();
				foreach ($msr as $key => $value) {					
					if( $key == 'username' ){
						$arr[$i]['type'] 	= 'text';
						$arr[$i]['subtype'] = "text";
						$arr[$i]['name'] 	=  "msr_username";
					}
					else if( $key == 'email' ){
						$arr[$i]['type'] 	= 'text';
						$arr[$i]['subtype'] = "email";
						$arr[$i]['name'] 	=  "msr_email";
					}
					else if( $key == 'password' ){
						$arr[$i]['type'] 	= 'text';
						$arr[$i]['subtype'] = "password";
						$arr[$i]['name'] 	= "msr_password";
					}
					else if( $key == 'confirm_password' ){
						$arr[$i]['type'] 	= 'text';
						$arr[$i]['subtype'] = "password";
						$arr[$i]['name'] 	= "msr_cpassword";
					}
					$arr[$i]['required'] 	= true;
					$arr[$i]['label'] 		= $key;
					$arr[$i]['placeholder'] = $value['placeholder'];
					$arr[$i]['className'] 	= $value['class'];					
					$i++;
				}
				$pagedata['default_form'] = $arr;
			}			
			$pageSettingsJson = json_encode($pagedata);			
			update_post_meta( $post_id, 'msr_settings', $pageSettingsJson);			
		}
	}

	public function add_user_columns($column) {
		$column['address'] = 'Street Address';
		$column['zipcode'] = 'Zip Code';
		return $column;
	}
	
	public function add_user_column_data( $val, $column_name, $user_id ) {
	    $user = get_userdata($user_id);
	    switch ($column_name) {
	        case 'address' :
	            return $user->address;
	            break;
	        default:
	    }
	    return;
	}

	public function msr_show_registration_fields( $user ){
		add_thickbox();
		//Fetching the user data
		$formId = $this->this_field_data( $user->ID, 'form_id' );
		//echo get_user_meta( $user->ID, '_msr_submitted_data',true);
		if( !empty($formId) ){			
			//Generating the html using php from multi step form json.
			echo '<h3>Multi steps registration fields</h3>';
			echo "<table class='form-table'>";
			$allForms = $this->get_forms( $formId );
			foreach ($allForms as $a => $elements) {
				foreach ($elements as $b => $element) {
					echo "<tr>";
					//If element is auto complete then making it select box
					if( $element['type'] == 'autocomplete' ){
						echo "<th><label>$element[label]</label></th>";
						echo "<td><select name='msr_edit[".$element['name']."]' >";
						$option_value = $this->this_field_data( $user->ID, $element['name'] );						
						foreach ($element['values'] as $i => $option) {							
							if( $option_value == $option['value'] ){
								echo "<option selected='selected' value='".$option['value']."'>".$option['label']."</option>";
							}
							else{
								echo "<option value='".$option['value']."'>".$option['label']."</option>";
							}							
						}
						echo "</select></td>";
					}
					//If element is text
					elseif( $element['type'] == 'text' ){
						$option_value = $this->this_field_data( $user->ID, $element['name'] );
						echo "<th><label>$element[label]</label></th>";
						echo "<td><input type='text' name='msr_edit[".$element['name']."]' value='".$option_value."'></td>";
					}
					//If element is number
					elseif( $element['type'] == 'number' ){
						$option_value = $this->this_field_data( $user->ID, $element['name'] );
						echo "<th><label>$element[label]</label></th>";
						echo "<td><input type='number' name='msr_edit[".$element['name']."]' value='".$option_value."'></td>";
					}
					//If element is textarea
					elseif( $element['type'] == 'date' ){
						$option_value = $this->this_field_data( $user->ID, $element['name'] );
						echo "<th><label>$element[label]</label></th>";
						echo "<td><input name='msr_edit[".$element['name']."]' type='text' value='".$option_value."'></td>";
					}					
					//If element is textarea
					elseif( $element['type'] == 'textarea' ){
						$option_value = $this->this_field_data( $user->ID, $element['name'] );
						echo "<th><label>$element[label]</label></th>";
						echo "<td><textarea name='msr_edit[".$element['name']."]'>".$option_value."</textarea>";
					}
					//If element is select box
					elseif( $element['type'] == 'select' ){
						echo "<th><label>$element[label]</label></th>";
						echo "<td><select name='msr_edit[".$element['name']."]' >";						
						$option_value = $this->this_field_data( $user->ID, $element['name'] );
						foreach ($element['values'] as $i => $option) {
							if( $option['value'] == $option_value ){
								echo "<option selected='selected' value='".$option['value']."'>".$option['label']."</option>";
							} else{
								echo "<option value='".$option['value']."'>".$option['label']."</option>";
							}							
						}
						echo "</select></td>";
					}
					//If element is checkbox group
					elseif( $element['type'] == 'checkbox-group' ){
						echo "<th><label>$element[label]</label></th>";
						echo "<td>";
						$option_value = $this->this_field_data( $user->ID, $element['name'] );
						//var_dump($option_value);
						foreach ($element['values'] as $i => $option) {
							if( !empty($option_value) && in_array( $option['value'], $option_value ) ){
								echo "<input name='msr_edit[".$element['name']."][]' checked='checked' type='checkbox' value='".$option['value']."'>".$option['label'];
							}else{
								echo "<input name='msr_edit[".$element['name']."][]' type='checkbox' value='".$option['value']."'>".$option['label'];
							}

						}
						echo "</td>";
					}
					//If element is radio group
					elseif( $element['type'] == 'radio-group' ){
						echo "<th><label>$element[label]</label></th>";
						echo "<td>";
						$option_value = $this->this_field_data( $user->ID, $element['name'] );
						foreach ($element['values'] as $i => $option) {
							if( $option_value == $option['value'] ){
								echo "<input name='msr_edit[".$element['name']."]' checked='checked' type='radio' value='".$option['value']."'>".$option['label'];
							}
							else{
								echo "<input name='msr_edit[".$element['name']."]' type='radio' value='".$option['value']."'>".$option['label'];
							}							
						}
						echo "</td>";
					}
					//If element is file type
					elseif( $element['type'] == 'file' ){
						$option_value = $this->this_field_data( $user->ID, $element['name'] );
						$ext = pathinfo($option_value, PATHINFO_EXTENSION);
						echo "<th><label>$element[label] $ext</label></th>";
						echo '<td>
				            	<div id="'.$element['name'].'" class="img_manager">
					            	<input type="text" name="msr_edit['.$element['name'].']" value="'.esc_url_raw( $option_value ).'" class="regular-text" />
					            	<input type="button" class="additional-user-image button-primary" value="Update Image" data-parentId="'.$element['name'].'" id="uploadimage"/>
					            	<br/>';
					    if( 0 ){
					    	echo '<div style="margin-top:5px"><a href="#TB_inline?width=600&height=auto&inlineId=imagepreview_'.$element['name'].'" class="thickbox"><img src="'.esc_url( $option_value ).'" width="200" ></a></div>';
					    	echo '<div id="imagepreview_'.$element['name'].'" style="display:none;">
						    		<p><img src="'.esc_url( $option_value ).'" /></p>
						    	</div>';
					    }
					    if( !empty($option_value) ){
					    	if( ($ext == 'jpg')  && ($ext == 'JPG') && 
					    		($ext == 'jpeg') && ($ext == 'JPEG') &&
					    		($ext == 'png')  && ($ext == 'PNG') &&
					    		($ext == 'gif')  && ($ext == 'GIF') &&
					    		($ext == 'svg')  && ($ext == 'SVG') 
					    		) {
					    		echo '<div style="margin-top:5px">
					    			<a href="'.esc_url( $option_value ).'" target="_blank">
					    				<img src="'.esc_url( $option_value ).'" width="200" >
					    			</a>
					    		</div>';
					    	}
					    	else{
					    		echo '<div style="margin-top:5px">
					    			<a href="'.esc_url( $option_value ).'" target="_blank">
					    				<span style="font-size:40px" class="dashicons dashicons-media-archive"></span>
					    			</a>
					    		</div>';
					    	}					    						   
					    }
				        echo '</div></td>';
					}
					//If element is text
					elseif( $element['type'] == 'hidden' ){
						$option_value = $this->this_field_data( $user->ID, $element['name'] );
						echo "<th><label>Hidden field (".$element['name'].")</label></th>";
						echo "<td><input name='msr_edit[".$element['name']."]' type='text' value='".$option_value."'></td>";
					}
					else{
						/***
						* This is good logic if new element is added
						***/
						/*echo "<td colspan='2'><pre>";
						print_r($element);
						echo "</td></pre>";*/
					}
					echo "</tr>";
				}				
			}
			echo "<tr style='display:none'>
					<td><input type='hidden' name='msr_edit[form_id]' value='".$formId."' />
					</td>
				</tr>";
			echo "</table>";
		}
		else{
			echo '<h3>Multi steps registration fields</h3>
				<table class="form-table">
					<tr><td>No Fields</td></tr>
				</table>';
		}
		/*if( isset($_POST) ){
			$this->msr_profile_update();
		}*/
	}

	public function this_field_data( $user_id, $name_attr ){
		$data = get_user_meta( $user_id, '_msr_submitted_data',true);
		if( !empty($data) ){			
			$dataArr = json_decode($data,true);			
			foreach ($dataArr as $step => $elements) {
				foreach ($elements as $meta_key => $meta_val) {
					if( $name_attr == $meta_key ){
						return $meta_val;
					}
					/*echo "<pre>";
					echo "Meta key: $meta_key & Meta Value: $meta_val<br/> ";
					echo "</pre>";*/
				}
			}			
		}
		return;
	}

	/***
	* This is the callback function whenever the user is updated
	***/
	public function msr_profile_update(){
		// only saves if the current user can edit user profiles
    	if ( !current_user_can( 'edit_user', $user_id ) )
        	return false;

		$user_id = $_POST['user_id'];
		/***
		* Extracting the array from post data
		* this array has msr data.
		***/
		$updated_fields = $_POST['msr_edit'];
		//Converting the form fields to json
		$jsonArray = array();
		foreach ($updated_fields as $key => $value) {
			$jsonArray[] = array($key=>$value);
		}		
		$updated_json 	= json_encode($jsonArray);
		/***
		* Updating the user meta key with new values
		***/
		update_user_meta( $user_id, '_msr_submitted_data', $updated_json );		
	}
    
    
    public function msr_banner_ad() {
    
    ?>
        <a href="https://www.witoni.com/" target="_blank">
        <div class="update-nag" style="border-left: none; box-shadow: none; padding: 5px 5px; line-height: 10px;">
        <img src="https://www.witoni.com/wp-content/uploads/2018/05/wordpress.jpg"/>
        </div>
        </a>
    
    <?php
   
   }

}
