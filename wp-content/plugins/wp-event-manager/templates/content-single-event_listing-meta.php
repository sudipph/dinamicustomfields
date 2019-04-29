<?php
/**
 * Single view event meta box
 *
 * Hooked into single_event_listing_start priority 20
 *
 * @since  1.14.0
 */

global $post;
do_action( 'single_event_listing_meta_before' );
?>
<section class="meta">
  
	<div class="col-md-12">
		<?php do_action( 'single_event_listing_meta_start' ); ?>
		
        
        <div class="form-group meta-text" >
			<div class="details-page-banner-section">
			
          <!--  <?php if ( get_option( 'event_manager_enable_event_types' ) ) {  ?>	  
	        <span><?php display_event_type($post); ?></span> 	
            <big>|</big>
            <?php } ?> -->
            <?php if ( get_option( 'event_manager_enable_categories' ) ) {
            	?>
            	<span><?php display_event_category($post); ?></span> 	
            <!--	<big>,</big> -->
            <?php
            }?> 
				<div class="event-title">
					<?php the_title();?>
				</div>
				<div class="details_regsiter_link_outer">
				    <ul>
						<li><a  href="javascript:void(0);" onClick="scrollToposition('.d-exe-board-summit-venue');">REGISTER</a></li>
						<li><a  href="javascript:void(0);" onClick="scrollToposition('.summits-tetails-text-testimonial');">SUMMITS DETAILS</a></li>
					<ul>
				</div>
			</div>
	    <!--    <span><?php echo display_organizer_name() ?></span>	   
            <big>|</big> -->
			<div class="where-whene-view-agenda-custom">
				<ul class="when-where when-where-custom">
					<li class="event-location">	
					<div class="detaila-where-outer">
					 <p><b>WHERE</b></p>
					 
					 <?php if(is_event_online($post) ): 
						  echo __('Online Event','wp-event-manager'); 
					  else:
						  echo '<p class="text-center details-location">'. get_event_location().'</p>'; 
					  endif;?>
					</div>  
					</li>
					<li class="event-start-date dtails-date-time">
					<div class="details-when-outer">
						<p><b>WHEN</b></p>
						<div>
						 <?php $timestamp = strtotime(get_event_start_date()); if($timestamp!=null): echo date_i18n("l",$timestamp); endif;?>
						
						</div>
						<div>
							<span><?php $timestamp = strtotime(get_event_start_date()); if($timestamp!=null): echo date_i18n("M j -",$timestamp); endif;?></span>
							<span><?php $timestamp = strtotime(get_event_end_date());  if($timestamp!=null): echo date_i18n("j, Y",$timestamp); endif; ?></span>
						</div>
					</div>
					</li>
					<li class="agenda-view">
					    <div class="details-agenda-speaker">
							<ul>
								<li><a class="view-agenda-custom-link" href="javascript:void(0);" onClick="scrollToposition('.details_key_themes11');">VIEW AGENDA</a></li>
								<li><a class="view-speakers-custom-link" href="javascript:void(0);" onClick="scrollToposition('.executive-board-page-outer.speaker-keynote');">VIEW SPEAKERS</a></li>
							</ul>
						</div>
					</li>
					
				</ul>
			</div>
        <!--    <big>|</big>			     
            <span class="date-posted" itemprop="datePosted">
           	 <date><?php display_event_publish_date(); ?></date>
            </span>
            <?php if ( is_event_cancelled() ) : ?>
              <big>|</big>
              <span class="event-cancelled"  itemprop="eventCancelled"><?php _e( 'This event has been cancelled', 'wp-event-manager' ); ?></span>	               
            <?php elseif ( ! attendees_can_apply() && 'preview' !== $post->post_status ) : ?>		       
               <big>|</big>
		       <span class="listing-expired" itemprop="eventExpired"><?php _e( 'Registrations have closed', 'wp-event-manager' ); ?></span>
	        <?php endif; ?> -->
        </div>   

      <?php do_action( 'single_event_listing_meta_end' ); ?>
  </div>

 <div style="clear:both;"></div>
 
</section>

<?php do_action( 'single_event_listing_meta_after' ); ?>