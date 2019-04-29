<?php
/*
Plugin Name: Export to CSV
Plugin URI: https://google.com/
Description: Just another contact form plugin. Simple but flexible.
Author: Sudip
Text Domain: export-to-csv
Version: 1.0
*/
define('PP5',plugin_dir_url(__FILE__));

add_action('wp_enqueue_scripts', 'dynamic_enqueue_styles5');
function dynamic_enqueue_styles5()
{
    
   // wp_enqueue_script('jquery_5', PP5 . 'js/jquery-1.9.1.js',false, 1.1, true);
    wp_enqueue_script('jquery'); 
    wp_enqueue_script('jquery_colspan_scripts5', PP5 . 'js/scripts.js', array('jquery'), 1.1, true);
    

}
define('SHOW_METABOX_ON5', 'event_listing');



function agenda_list_function_download($pid){
	    global $post, $wp_meta_boxes;
	
    $data = get_post_meta($pid, 'gallery_data', true);
    $ro = [];
	
		$html_content = '';
		$i=0;
		if(isset($data['organizer_key']) && count($data['organizer_key'])>0){
           foreach($data['organizer_key'] as $key=>$org_key){
		$ro[$i][] = $data['organizer_name'][$org_key]; 
			if(isset($data['organizer_date'][$org_key])){
			$ro[$i][] = date('M d,Y',strtotime($data['organizer_date'][$org_key]));
            } 	
                    if(isset($data['rand_number'][$org_key]) && count($data['rand_number'][$org_key])>0){
							
				        foreach($data['rand_number'][$org_key] as $rand_number){
                            $i++;
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

                            $ro[$i][] = $time_set.' - '.$time_unset;
                            $ro[$i][] = $location; 
                            $ro[$i][] = $session;
                            $ro[$i][] = $eventname;
                                            if($topic_id!=''){ 
                               
											$topic = get_term_by('id', $topic_id, 'topic');
											
                                            $ro[$i][] =  isset($topic->name)&&$topic->name!=''?$topic->name:'';//$topic_id;
                                             }else{
                                            $ro[$i][] =  '';     
                                             } 
                                              if(isset($user_id)){
														//echo $user_id;
														$user_info = get_userdata($user_id);
                                                        $ro[$i][] =  get_avatar( $user_id, 80 ,'','',array('class'=>'aten_img')); 
                                                        $ro[$i][] = (isset($user_info->first_name)?$user_info->first_name:'') .' '.(isset($user_info->last_name)?$user_info->last_name:'');
                                                        $ro[$i][] = (isset($user_info->description)?$user_info->description:'');
                                                        

                                                    
                                                }
                                                     $ro[$i][] =  $desc; 
                                                     

                       
                       
                           // $i++;
						}
                        
                    }
                    $i++;
           
                }
		}
		// echo '<pre>';	
        // var_dump($ro);
        // echo '</pre>';
      return  isset($ro)&&count($ro)>0?$ro:'';
}

add_action('wp_ajax_nopriv_download_from_ajax_dynamic', 'download_from_ajax_dynamic');
add_action('wp_ajax_download_from_ajax_dynamic', 'download_from_ajax_dynamic');

function download_from_ajax_dynamic(){
    $pid = $_REQUEST['pid'];
  //  @header("Last-Modified: " . @gmdate("D, d M Y H:i:s",date('m/d/Y h:i:s a', time())) . " GMT");
//@header("Content-type: text/x-csv");
// If the file is NOT requested via AJAX, force-download
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
 //   header("Content-Disposition: attachment; filename=search_results.csv");
}
$alldata = agenda_list_function_download($pid);
//die();
if($alldata){
    echo  array_to_csv_download($alldata, // this array is going to be the second row
    "numbers.csv"
    );
}
    die();
}

function array_to_csv_download($array, $filename = "export.csv", $delimiter=";") {
    // open raw memory as file so no temp files needed, you might run out of memory though
    $f = fopen('php://memory', 'w'); 
    // loop over the input array
    foreach ($array as $line) { 
        // generate csv lines from the inner arrays
        fputcsv($f, $line, $delimiter); 
    }
    // reset the file pointer to the start of the file
    fseek($f, 0);
    // tell the browser it's going to be a csv file
    header('Content-Type: application/csv');
    // tell the browser we want to save it instead of displaying it
    header('Content-Disposition: attachment; filename="'.$filename.'";');
    // make php send the generated csv lines to the browser
    fpassthru($f);
}


add_action('wp_head', 'add_conditional_css5');
function add_conditional_css5(){
    ?>
<script>
var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<?php
}
