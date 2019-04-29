<?php wp_enqueue_script('wp-event-manager-content-event-listing'); ?>
<div class="right_panel_event_search">
    <div class="event-listings-view-header">
      <div class="row">   
        <div class="col-md-8 "><h3 class="normal-section-title"><?php _e( 'Recent Events', 'wp-event-manager' ); ?></h3></div>
          <div class="col-md-4 layout-view-icon">
              <?php do_action('start_event_listing_layout_icon');?>
                <i id="box-layout-icon"></i>  
                <i id="line-layout-icon" class="lightgray-layout-icon"></i>
              <?php do_action('end_event_listing_layout_icon'); ?>
          </div> 
      </div>
    </div>
<ul id="event-listing-view" class="event_listings event-listings-table-bordered">