<!-- Events Display Widget-->
<!-- digi --> 
<div class="event-widget">     
	<div class="event-img"><?php display_event_banner(); ?></div>  	
	<div class="event-content-custom-outer">		
		<div class="event-start-date"><?php $timestamp = strtotime(get_event_start_date()); if($timestamp!= null): echo date("M j, Y",$timestamp); endif;?></div>		
		<div class="event-title">		   
		<h3><?php echo esc_html( get_the_title() ); ?></h3>		
	</div>		   		
	<div class="event-location"><?php if(get_event_location()=='Anywhere'): echo __('Online Event','wp-event-manager'); else:  display_event_location(false); endif; ?>	</div>		
	<div class="box-footer even-type-custom"><?php if ( get_option( 'event_manager_enable_event_types' ) ) {  ?>		   <div class="event-type"> <span><?php display_event_type(); ?>,</span> 
	</div>		  <?php } ?>          		 <!-- <div class="event-ticket"><?php echo '#'.get_event_ticket_option(); ?></div> -->		</div> 		
	<div class="know_more_evn_outer">			<a href="<?php the_permalink(); ?>">VIEW DETAILS</a>		
	</div>	
	</div> 
</div>   