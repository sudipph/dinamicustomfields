<?php
/*
Template Name: Register

*/
get_header(); 
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;
?>
<div class="registration-page-banner-outer">
<?php //echo do_shortcode("[rev_slider alias="registration-banner"]");?>
<?php echo do_shortcode("[insert page='registration-banner' display='content']");?>	
</div>
<?php 
function output_summit_list() {
    global $wpdb;

    $custom_post_type = 'event_listing'; // define your custom post type slug here

    // A sql query to return all post titles
    $results = $wpdb->get_results( $wpdb->prepare( "SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type = %s and post_status = 'publish'", $custom_post_type ), ARRAY_A );

    // Return null if we found no results
    if ( ! $results )
        return;

    // HTML for our select printing post titles as loop
    $output = '<select name="summit[]" id="summit" multiple>';

    foreach( $results as $index => $post ) {
        $output .= '<option value="' . $post['ID'] . '">' . $post['post_title'] . '</option>';
    }

    $output .= '</select>'; // end of select element

    // get the html
    return $output;
}

// Then in your project just call the function
// Where you want the select form to appear
//echo output_summit_list();
?>
<?php 
function output_location_list(){
	global $wpdb;
	$custom_post_type = ''; // define your custom post type slug here

    // A sql query to return all post titles

    //$location_results = $wpdb->get_results( $wpdb->prepare( "SELECT meta_value FROM `wp_postmeta` WHERE `meta_key` LIKE '_event_location' group by meta_value",$custom_post_type), ARRAY_A );
	$custom_post_type1 = 'event_listing';
	$results1 = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_type = %s and post_status = 'publish'", $custom_post_type1 ), ARRAY_A );
	$last_sql = $wpdb->last_query;
	$location_results = $wpdb->get_results( $wpdb->prepare( "SELECT post_id , meta_value FROM `wp_postmeta` WHERE post_id IN ({$wpdb->last_query}) and `meta_key` LIKE '_event_location' group by meta_value",$custom_post_type), ARRAY_A );
	
    // Return null if we found no results
    if ( ! $location_results )
        return;

    // HTML for our select printing post titles as loop
    $output_location = '<select name="location" id="location">';

    for($i=0;$i<count($location_results);$i++) {
		if($location_results[$i]['meta_value'] !=""){
        $output_location .= '<option value="' . $location_results[$i]['meta_value'] . '">' . $location_results[$i]['meta_value'] . '</option>';
		}
    }

    $output_location .= '</select>'; // end of select element

    // get the html
    return $output_location;
	}
	//echo output_location_list();
?>


<body id="login-page" <?php body_class(); ?>>
	<div class="reg_uper-section">
		
		<div class="reg-criteria-section">
			<div class="global-clo-block">
				<h2 class="attendance-text">Please note that attendance is by invitation only</h2>
				<p>Registrants will be ganted confirmation based upon qualifications and space availability. Access to the conference is open to individuals that meet the following criteria. </p>
			</div>
		</div>
		<div class="privae-public-provider">
			<div class="reg-private-sector">
				<h2 class="ppp-heading">Private Sector</h2>
				<p>CXO's (or equivalent), SVP's / Vp's from organizations with revenue $50 M+ Directors from organizations with revenue $800 M+ </p>
			</div>
			<div class="reg-public-sector">
				<h2 class="ppp-heading">Public Sector(Government, Education, and Not-For-Profit Organizations)</h2>
				<p>CXO's (or equivalent) from agencies or organizations with more than 1,000 employees</p>
			</div>
			<div class="reg-service-provider">
			<h2 class="ppp-heading">Service Providers</h2>
				<p>CXO's (or equivalent) from organizations with revenue $1 B+</p>
			</div>
		</div>
	</div>

<style>
/*custom font*/
@import url(https://fonts.googleapis.com/css?family=Montserrat);

/*basic reset*/
* {margin: 0; padding: 0;}

html {
	height: 100%;
	/*Image only BG fallback*/
	
	/*background = gradient + image pattern combo*/
	background: 
		linear-gradient(rgba(196, 102, 0, 0.6), rgba(155, 89, 182, 0.6));
}

body {
	font-family: montserrat, arial, verdana;
}
/*form styles*/
#msform {
	width: 400px;
	margin: 50px auto;
	text-align: center;
	position: relative;
}
#msform fieldset {
	background: white;
	border: 0 none;
	border-radius: 3px;
	box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
	padding: 20px 30px;
	box-sizing: border-box;
	width: 80%;
	margin: 0 10%;
	
	/*stacking fieldsets above each other*/
	position: relative;
}
/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
	display: none;
}
/*inputs*/
#msform input, #msform textarea {
	padding: 15px;
	border: 1px solid #ccc;
	border-radius: 3px;
	margin-bottom: 10px;
	width: 100%;
	box-sizing: border-box;
	font-family: montserrat;
	color: #2C3E50;
	font-size: 13px;
}
/*buttons*/
#msform .action-button {
	width: 100px;
	background: #27AE60;
	font-weight: bold;
	color: white;
	border: 0 none;
	border-radius: 1px;
	cursor: pointer;
	padding: 10px 5px;
	margin: 10px 5px;
}
#msform .action-button:hover, #msform .action-button:focus {
	box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
}
/*headings*/
.fs-title {
	font-size: 15px;
	text-transform: uppercase;
	color: #2C3E50;
	margin-bottom: 10px;
}
.fs-subtitle {
	font-weight: normal;
	font-size: 13px;
	color: #666;
	margin-bottom: 20px;
}
/*progressbar*/
#progressbar {
	margin-bottom: 30px;
	overflow: hidden;
	/*CSS counters to number the steps*/
	counter-reset: step;
}
#progressbar li {
	list-style-type: none;
	color: white;
	text-transform: uppercase;
	font-size: 9px;
	width: 33.33%;
	float: left;
	position: relative;
}
#progressbar li:before {
	content: counter(step);
	counter-increment: step;
	width: 20px;
	line-height: 20px;
	display: block;
	font-size: 10px;
	color: #333;
	background: white;
	border-radius: 3px;
	margin: 0 auto 5px auto;
}
/*progressbar connectors*/
#progressbar li:after {
	content: '';
	width: 100%;
	height: 2px;
	background: white;
	position: absolute;
	left: -50%;
	top: 9px;
	z-index: -1; /*put it behind the numbers*/
}
#progressbar li:first-child:after {
	/*connector not needed before the first step*/
	content: none; 
}
/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before,  #progressbar li.active:after{
	background: #27AE60;
	color: white;
}




</style>
<div class="container reg-custon-con">

<div class="row register-page-container p-3 p-lg-5 mt-5 d-flex justify-content-center w-75 mx-auto">

<?php
global $wpdb, $user_ID; 

//Check whether the user is already logged in 
if (!$user_ID) {

// Default page shows register form. 
// To show Login form set query variable action=login
$action = (isset($_GET['action']) ) ? $_GET['action'] : 0;

// Login Page
if ($action === "login") { ?>

<?php 
$login = (isset($_GET['login']) ) ? $_GET['login'] : 0;

if ( $login === "failed" ) {
echo '<div class="col-12 register-error"><strong>ERROR:</strong> Invalid username and/or password.</div>';
} elseif ( $login === "empty" ) {
echo '<div class="col-12 register-error"><strong>ERROR:</strong> Username and/or Password is empty.</div>';
} elseif ( $login === "false" ) {
echo '<div class="col-12 register-error"><strong>ERROR:</strong> You are logged out.</div>';
}
?>

<div class="col-md-5">

<?php 
$args = array(
'redirect' => home_url().'/login/', 
);

wp_login_form($args); ?>

<p class="text-center"><a class="mr-2" href="<?php echo wp_registration_url(); ?>">Register Now</a>
<span clas="mx-2">·</span><a class="ml-2" href="<?php echo wp_lostpassword_url( ); ?>" title="Lost Password">Lost Password?</a></p>

</div>

<?php

} else { // Register Page ?>

<?php
//print_r($_POST);
//exit;
if ( $_POST ) {

$error = 0;

$username = esc_sql($_REQUEST['username']); 
if ( empty($username) ) {

echo '<div class="col-12 register-error">User name should not be empty.</div>'; 
$error = 1;
}

$email = esc_sql($_REQUEST['email']);
if ( !preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email) ) { 

echo '<div class="col-12 register-error">Please enter a valid email.</div>';
$error = 1;
}

if ( $error == 0 ) {

$random_password = wp_generate_password( 12, false ); 
$status = wp_create_user( $username, $random_password, $email, $_POST); 
//attendee
$user_id_role = new WP_User($status);
$user_id_role->set_role('attendee');
if ( is_wp_error($status) ) {

echo '<div class="col-12 register-error">Username already exists. Please try another one.</div>'; 
} else {

$from = get_option('admin_email'); 
$headers = 'From: '.$from . "\r\n"; 
$subject = "Registration successful"; 
$message = "Registration successful.\nYour login details\nUsername: $username\nPassword: $random_password"; 

// Email password and other details to the user
wp_mail( $email, $subject, $message, $headers ); 

echo// do_shortcode("[insert page='message-success' display='content']"); 

$error = 2; // We will check for this variable before showing the sign up form. 
}
}
?>
<script type="text/javascript">
window.location.href = '<?php echo site_url(); ?>/message-success/';
</script>
<?php
}

if ( $error != 2 ) { ?> 

<?php if(get_option('users_can_register')) { ?>

<div class="col-md-5 manual-register-form">

<form id="msform" action="" method="post"> 
  <ul id="progressbar">
    <li class="active">
	    
		<p class="personal-info">Personal Information</p>
	</li>
    <li>
		
		<p class="personal-info">Company Information</p>
	</li>
    <li>
		
		<p class="personal-info">Additional Information</p>
	</li>
  </ul>
<fieldset>
	<div class="first_step_part_1"><!--sudip-->
		<div class="stp-by-stp">
			<p class="step13">STEP 1 OF 3</p>
			<p class="personal-info-title">Personal Information</p>
		</div>
		<ul class="solct-item-outer">
			<li class="slect-summit"><label>SELECT SUMMIT *</label><?php echo output_summit_list(); ?></li>
			<li class="select-summit-location"><label>SELECT SUMMIT LOCATION*</label><?php echo output_location_list(); ?></li>
			<li> <input type="text" name="username" placeholder="First Name*" class="register-input mb-4" required></li>
			<li><input type="text" name="lname" placeholder="Last Name*" class="register-input mb-4" required></li>
			<li> <input type="email" name="email" placeholder="Email*" class="register-input mb-4" required> <br /> </li>
			<li> <input type="text" name="phone" placeholder="Phone" class="register-input mb-4"> <br /></li>
			<li> <input type="text" name="linkedin_url" placeholder="Linkedin URL" class="register-input mb-4"> <br /></li>
			<li> <input type="text" name="twiter_handel" placeholder="Twitter Handel" class="register-input mb-4"> <br /></li>
			<li> <input type="text" name="job_title" placeholder="Job Title" class="register-input mb-4"> <br /></li>
			<li> <input type="text" name="custion_role" placeholder="Attendee Type" class="register-input mb-4"> <br />
			<p class="attendee-form-text">i.e (Attendee, Media Partner, Press, Speaker, Sponsor)</p>
			</li>
		</ul>
			<!--<p> 
			<label for="user_login">Select Role</label>
			<select name="custion_role" class="register-input mb-4" required>
				<option value="attendee">Attendee</option>
				<option value="speaker">Speaker</option>
				<option value="sponsor">Sponsor</option>
			</select>
			<input type="text" name="attendee" placeholder="Attendee Type*" class="register-input mb-4" required> <br /> 
			<label for="attendee">i.e (Attendee, Media Partner, Press, Speaker, Sponsor)</label> 
		</p>-->

	</div>
	
		<input type="button" name="next" class="next action-button nex-t" value="NEXT STEP" />
		<p class="required-field">*Required Fields</p>
	
</fieldset>
<fieldset>
	
	<div class="first_step_part_1">
		<div class="stp-by-stp">
			<p class="step13">STEP 2 OF 3</p>
			<p class="personal-info-title">Company Information</p>
		</div>
		<ul class="solct-item-outer">
			<li><input type="text" name="cname" placeholder="Company Name*" class="register-input mb-4" required> <br /> </li>
			<li><input type="text" name="city" placeholder="City*" class="register-input mb-4" required> <br /></li>
			
			<li><input type="text" name="state" placeholder="State*" class="register-input mb-4" required > <br /></li>
			<li><input type="text" name="zipcode" placeholder="Zip Code*" class="register-input mb-4" required> <br /></li>
			
			<li><input type="text" name="arevenue" placeholder="Annual Revenue" class="register-input mb-4" > <br /> </li>
			<li><input type="text" name="itrevenue" placeholder="IT Revenue" class="register-input mb-4"> <br /></li> 
			
			<li>
				<label for="user_login">SELECT INDUSTRY*</label>
				<select name="industry" class="register-input mb-4" required>
				  <option value="it">IT</option>
				  <option value="marketing">Marketing</option>
				  <option value="manufacturing">Manufacturing</option>
				  <option value="media">Media</option>
				</select>
			</li>
			<li>
				<label for="user_login">SELECT COUNTRY*</label>
					<select name="country" class="register-input mb-4" required>
						<option value="Afghanistan">Afghanistan</option>
						<option value="Albania">Albania</option>
						<option value="Algeria">Algeria</option>
						<option value="American Samoa">American Samoa</option>
						<option value="Andorra">Andorra</option>
						<option value="Angola">Angola</option>
						<option value="Anguilla">Anguilla</option>
						<option value="Antartica">Antarctica</option>
						<option value="Antigua and Barbuda">Antigua and Barbuda</option>
						<option value="Argentina">Argentina</option>
						<option value="Armenia">Armenia</option>
						<option value="Aruba">Aruba</option>
						<option value="Australia">Australia</option>
						<option value="Austria">Austria</option>
						<option value="Azerbaijan">Azerbaijan</option>
						<option value="Bahamas">Bahamas</option>
						<option value="Bahrain">Bahrain</option>
						<option value="Bangladesh">Bangladesh</option>
						<option value="Barbados">Barbados</option>
						<option value="Belarus">Belarus</option>
						<option value="Belgium">Belgium</option>
						<option value="Belize">Belize</option>
						<option value="Benin">Benin</option>
						<option value="Bermuda">Bermuda</option>
						<option value="Bhutan">Bhutan</option>
						<option value="Bolivia">Bolivia</option>
						<option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
						<option value="Botswana">Botswana</option>
						<option value="Bouvet Island">Bouvet Island</option>
						<option value="Brazil">Brazil</option>
						<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
						<option value="Brunei Darussalam">Brunei Darussalam</option>
						<option value="Bulgaria">Bulgaria</option>
						<option value="Burkina Faso">Burkina Faso</option>
						<option value="Burundi">Burundi</option>
						<option value="Cambodia">Cambodia</option>
						<option value="Cameroon">Cameroon</option>
						<option value="Canada">Canada</option>
						<option value="Cape Verde">Cape Verde</option>
						<option value="Cayman Islands">Cayman Islands</option>
						<option value="Central African Republic">Central African Republic</option>
						<option value="Chad">Chad</option>
						<option value="Chile">Chile</option>
						<option value="China">China</option>
						<option value="Christmas Island">Christmas Island</option>
						<option value="Cocos Islands">Cocos (Keeling) Islands</option>
						<option value="Colombia">Colombia</option>
						<option value="Comoros">Comoros</option>
						<option value="Congo">Congo</option>
						<option value="Congo">Congo, the Democratic Republic of the</option>
						<option value="Cook Islands">Cook Islands</option>
						<option value="Costa Rica">Costa Rica</option>
						<option value="Cota D'Ivoire">Cote d'Ivoire</option>
						<option value="Croatia">Croatia (Hrvatska)</option>
						<option value="Cuba">Cuba</option>
						<option value="Cyprus">Cyprus</option>
						<option value="Czech Republic">Czech Republic</option>
						<option value="Denmark">Denmark</option>
						<option value="Djibouti">Djibouti</option>
						<option value="Dominica">Dominica</option>
						<option value="Dominican Republic">Dominican Republic</option>
						<option value="East Timor">East Timor</option>
						<option value="Ecuador">Ecuador</option>
						<option value="Egypt">Egypt</option>
						<option value="El Salvador">El Salvador</option>
						<option value="Equatorial Guinea">Equatorial Guinea</option>
						<option value="Eritrea">Eritrea</option>
						<option value="Estonia">Estonia</option>
						<option value="Ethiopia">Ethiopia</option>
						<option value="Falkland Islands">Falkland Islands (Malvinas)</option>
						<option value="Faroe Islands">Faroe Islands</option>
						<option value="Fiji">Fiji</option>
						<option value="Finland">Finland</option>
						<option value="France">France</option>
						<option value="France Metropolitan">France, Metropolitan</option>
						<option value="French Guiana">French Guiana</option>
						<option value="French Polynesia">French Polynesia</option>
						<option value="French Southern Territories">French Southern Territories</option>
						<option value="Gabon">Gabon</option>
						<option value="Gambia">Gambia</option>
						<option value="Georgia">Georgia</option>
						<option value="Germany">Germany</option>
						<option value="Ghana">Ghana</option>
						<option value="Gibraltar">Gibraltar</option>
						<option value="Greece">Greece</option>
						<option value="Greenland">Greenland</option>
						<option value="Grenada">Grenada</option>
						<option value="Guadeloupe">Guadeloupe</option>
						<option value="Guam">Guam</option>
						<option value="Guatemala">Guatemala</option>
						<option value="Guinea">Guinea</option>
						<option value="Guinea-Bissau">Guinea-Bissau</option>
						<option value="Guyana">Guyana</option>
						<option value="Haiti">Haiti</option>
						<option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
						<option value="Holy See">Holy See (Vatican City State)</option>
						<option value="Honduras">Honduras</option>
						<option value="Hong Kong">Hong Kong</option>
						<option value="Hungary">Hungary</option>
						<option value="Iceland">Iceland</option>
						<option value="India">India</option>
						<option value="Indonesia">Indonesia</option>
						<option value="Iran">Iran (Islamic Republic of)</option>
						<option value="Iraq">Iraq</option>
						<option value="Ireland">Ireland</option>
						<option value="Israel">Israel</option>
						<option value="Italy">Italy</option>
						<option value="Jamaica">Jamaica</option>
						<option value="Japan">Japan</option>
						<option value="Jordan">Jordan</option>
						<option value="Kazakhstan">Kazakhstan</option>
						<option value="Kenya">Kenya</option>
						<option value="Kiribati">Kiribati</option>
						<option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
						<option value="Korea">Korea, Republic of</option>
						<option value="Kuwait">Kuwait</option>
						<option value="Kyrgyzstan">Kyrgyzstan</option>
						<option value="Lao">Lao People's Democratic Republic</option>
						<option value="Latvia">Latvia</option>
						<option value="Lebanon" selected>Lebanon</option>
						<option value="Lesotho">Lesotho</option>
						<option value="Liberia">Liberia</option>
						<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
						<option value="Liechtenstein">Liechtenstein</option>
						<option value="Lithuania">Lithuania</option>
						<option value="Luxembourg">Luxembourg</option>
						<option value="Macau">Macau</option>
						<option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
						<option value="Madagascar">Madagascar</option>
						<option value="Malawi">Malawi</option>
						<option value="Malaysia">Malaysia</option>
						<option value="Maldives">Maldives</option>
						<option value="Mali">Mali</option>
						<option value="Malta">Malta</option>
						<option value="Marshall Islands">Marshall Islands</option>
						<option value="Martinique">Martinique</option>
						<option value="Mauritania">Mauritania</option>
						<option value="Mauritius">Mauritius</option>
						<option value="Mayotte">Mayotte</option>
						<option value="Mexico">Mexico</option>
						<option value="Micronesia">Micronesia, Federated States of</option>
						<option value="Moldova">Moldova, Republic of</option>
						<option value="Monaco">Monaco</option>
						<option value="Mongolia">Mongolia</option>
						<option value="Montserrat">Montserrat</option>
						<option value="Morocco">Morocco</option>
						<option value="Mozambique">Mozambique</option>
						<option value="Myanmar">Myanmar</option>
						<option value="Namibia">Namibia</option>
						<option value="Nauru">Nauru</option>
						<option value="Nepal">Nepal</option>
						<option value="Netherlands">Netherlands</option>
						<option value="Netherlands Antilles">Netherlands Antilles</option>
						<option value="New Caledonia">New Caledonia</option>
						<option value="New Zealand">New Zealand</option>
						<option value="Nicaragua">Nicaragua</option>
						<option value="Niger">Niger</option>
						<option value="Nigeria">Nigeria</option>
						<option value="Niue">Niue</option>
						<option value="Norfolk Island">Norfolk Island</option>
						<option value="Northern Mariana Islands">Northern Mariana Islands</option>
						<option value="Norway">Norway</option>
						<option value="Oman">Oman</option>
						<option value="Pakistan">Pakistan</option>
						<option value="Palau">Palau</option>
						<option value="Panama">Panama</option>
						<option value="Papua New Guinea">Papua New Guinea</option>
						<option value="Paraguay">Paraguay</option>
						<option value="Peru">Peru</option>
						<option value="Philippines">Philippines</option>
						<option value="Pitcairn">Pitcairn</option>
						<option value="Poland">Poland</option>
						<option value="Portugal">Portugal</option>
						<option value="Puerto Rico">Puerto Rico</option>
						<option value="Qatar">Qatar</option>
						<option value="Reunion">Reunion</option>
						<option value="Romania">Romania</option>
						<option value="Russia">Russian Federation</option>
						<option value="Rwanda">Rwanda</option>
						<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
						<option value="Saint LUCIA">Saint LUCIA</option>
						<option value="Saint Vincent">Saint Vincent and the Grenadines</option>
						<option value="Samoa">Samoa</option>
						<option value="San Marino">San Marino</option>
						<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
						<option value="Saudi Arabia">Saudi Arabia</option>
						<option value="Senegal">Senegal</option>
						<option value="Seychelles">Seychelles</option>
						<option value="Sierra">Sierra Leone</option>
						<option value="Singapore">Singapore</option>
						<option value="Slovakia">Slovakia (Slovak Republic)</option>
						<option value="Slovenia">Slovenia</option>
						<option value="Solomon Islands">Solomon Islands</option>
						<option value="Somalia">Somalia</option>
						<option value="South Africa">South Africa</option>
						<option value="South Georgia">South Georgia and the South Sandwich Islands</option>
						<option value="Span">Spain</option>
						<option value="SriLanka">Sri Lanka</option>
						<option value="St. Helena">St. Helena</option>
						<option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
						<option value="Sudan">Sudan</option>
						<option value="Suriname">Suriname</option>
						<option value="Svalbard">Svalbard and Jan Mayen Islands</option>
						<option value="Swaziland">Swaziland</option>
						<option value="Sweden">Sweden</option>
						<option value="Switzerland">Switzerland</option>
						<option value="Syria">Syrian Arab Republic</option>
						<option value="Taiwan">Taiwan, Province of China</option>
						<option value="Tajikistan">Tajikistan</option>
						<option value="Tanzania">Tanzania, United Republic of</option>
						<option value="Thailand">Thailand</option>
						<option value="Togo">Togo</option>
						<option value="Tokelau">Tokelau</option>
						<option value="Tonga">Tonga</option>
						<option value="Trinidad and Tobago">Trinidad and Tobago</option>
						<option value="Tunisia">Tunisia</option>
						<option value="Turkey">Turkey</option>
						<option value="Turkmenistan">Turkmenistan</option>
						<option value="Turks and Caicos">Turks and Caicos Islands</option>
						<option value="Tuvalu">Tuvalu</option>
						<option value="Uganda">Uganda</option>
						<option value="Ukraine">Ukraine</option>
						<option value="United Arab Emirates">United Arab Emirates</option>
						<option value="United Kingdom">United Kingdom</option>
						<option value="United States">United States</option>
						<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
						<option value="Uruguay">Uruguay</option>
						<option value="Uzbekistan">Uzbekistan</option>
						<option value="Vanuatu">Vanuatu</option>
						<option value="Venezuela">Venezuela</option>
						<option value="Vietnam">Viet Nam</option>
						<option value="Virgin Islands (British)">Virgin Islands (British)</option>
						<option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
						<option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
						<option value="Western Sahara">Western Sahara</option>
						<option value="Yemen">Yemen</option>
						<option value="Yugoslavia">Yugoslavia</option>
						<option value="Zambia">Zambia</option>
						<option value="Zimbabwe">Zimbabwe</option>
				</select>
			</li>
		</ul>
	</div>
	
	<input type="button" name="previous" class="previous action-button pre-v" value="PREVIOUS STEP" />
	<input type="button" name="next" class="next action-button nex-t" value="NEXT STEP" />
	<p class="required-field">*Required Fields</p>
</fieldset>
<fieldset>
	
	<div class="first_step_part_1">
		<div class="stp-by-stp">
			<p class="step13">STEP 3 OF 3</p>
			<p class="personal-info-title">Additional Information</p>
		</div>
		<ul class="solct-item-outer">
			<li> 
				<label for="user_login">Are you an employee of a local/national goverenment or public education institution ?*</label>
				<select name="institution" class="register-input mb-4" required>
				  <option value="yes">Yes</option>
				  <option value="no">No</option>
				</select>
			</li>
			<li> 
				<label for="user_login">Do you have any restrictions?*</label>
				<select name="restriction" class="register-input mb-4" required>
				  <option>Select...</option>
				  <option value="allergy">Allergy</option>
				  <option value="restriction1">Restriction1</option>
				</select>
			</li>
			<li> 
				<label for="user_login">Would you like to use our reservation system?*</label>
				<select name="reservation_system" class="register-input mb-4" onchange="getval(this);" required>
					<option value="no">No</option>
					<option value="yes">Yes</option>
				</select>
				
			</li>
			<li class="re-type" style="display:none">
				<input type="text" name="restype" placeholder="More About Your" class="register-input mb-4"> <br /> 
			</li>
			<div class="if-reservation-div" style="display:none">
				<p class="if-reservation">Please use our registration system to book your room for the selected events.Take advantage of our conference rate! We have negotiated a discount rate , plus taxes per room per night for all Predictera Summit delegates.The room is available from the nights of Wednesday until Thrusday.Would you like to reserve a sending you an URL for hotel reservation.</p>
				<ul class="if-rev-ul">
					<li>The hotel cost will be provided for the first day of the summit for delegates who will be travelling beyond 200 miles.</li>
					<li>Predictera will also cover $250 for the travel and flight expense.</li>
				</ul>
				<p class="p-rev-note">Note: Predictera will need to review & approve the request for reimbursement.</p>
			</div>
		</ul>
	</div>
	<input type="button" name="previous" class="previous action-buttosn pre-v" value="PREVIOUS STEP" />
	<input type="submit" name="submit" class="submit action-button sub-mit" value="SUBMIT" />
	<p class="required-field">*Required Fields</p>
</fieldset>
</form>

<p style="display:none;">Already have an account? <a href="<?php echo site_url(); ?>/wp-admin/">Login Here</a></p>

</div>

<?php } else {

echo "Registration is currently disabled. Please try again later."; 

}

} ?>

<?php }

} else { ?>

<p>You are logged in. Click <a href="<?php bloginfo('wpurl'); ?>">here to go home</a></p>

<?php } ?>

</div>
</div>
<?php get_footer(); 
?>
</body>
</html>
<script>
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 10, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 10, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});
</script>
<script>
	function getval(sel)
	{
     if(sel.value == 'yes')
	 {
		jQuery('.if-reservation-div').show();
		jQuery('.re-type').show();
	 }
	if(sel.value == 'no'){
		jQuery('.if-reservation-div').hide();
		jQuery('.re-type').hide();
	 }
	}
</script>