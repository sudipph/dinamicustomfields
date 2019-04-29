<div class="event-details-header">
   <ul>
	<li><a href="javascript:void(0);" onClick="scrollToposition('.summits-tetails-text-testimonial');">Summit Details</a></li>
	<li><a href="javascript:void(0);" onClick="scrollToposition('#details_key_themes11');">Program</a></li>
	<li><a href="javascript:void(0);" onClick="scrollToposition('.d-exe-board-summit-venue');">Venue</a></li>
	<li><a href="javascript:void(0);" onClick="scrollToposition('.d-exe-board-summit-speaker-outer-inner');" >Sponsor</a></li>
	<li class="details_reg"><a href="javascript:void(0);" onClick="scrollToposition('#attendee-join');">Register</a></li>
	</ul>
</div>



<?php global $post; ?>
<div class="single_event_listing" id="summit_details" itemscope itemtype="http://schema.org/EventPosting">
	<meta itemprop="title" content="<?php echo esc_attr( $post->post_title ); ?>" />
	
    <!-- Main if condition start -->
	<?php if ( get_option( 'event_manager_hide_expired_content', 1 ) && 'expired' === $post->post_status ) : ?>
		<div class="event-manager-info"><?php _e( 'This listing has expired.', 'wp-event-manager' ); ?></div>
	<?php else : ?>
		
		<?php
			/**
			 * single_event_listing_start hook
			 *	
			 */
			 
			//do_action( 'single_event_listing_start' );
			 
			//do_action( 'set_single_listing_view_count', $post);
			
		?>
		
		<div class="row">
                             
             <!-- Event description column start -->                             
            <div class="col-md-12 text-justify details_page_outer"> 
            
              <?php do_action('single_event_overview_start');?>
              <div class="event-details" itemprop="description">
                <h3 class="section-title">
				<?php // _e( 'Event Overview', 'wp-event-manager' ); ?></h3>  
                
                <?php $event_banners = get_event_banner(); ?> 
                <?php if( is_array( $event_banners) && sizeof($event_banners ) > 1 )
                { ?>
                    <div id="single-event-slider" class="carousel slide" data-ride="carousel">
                   
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">
                       
                        <?php 
                        $active = 'active';
                           foreach($event_banners as $banner_key => $banner_value ){
                        ?>
                        <div class="item <?php echo $active;?>">
                          <img src="<?php echo $banner_value; ?>"  alt="<?php echo esc_attr( get_organizer_name( $post ) );?>">
                        </div>
                        <?php
                        $active ='';
                           }
                         ?>
                      </div>

					</div>                    
			<div class="clearfix">
				<div id="thumbcarousel" class="carousel slide" data-interval="false">
				<div class="carousel-inner">
				   
					<?php 
					$slide_to = 0;
					foreach($event_banners as $banner_key => $banner_value ){ 
						 if( $slide_to == 0) {
							$thumbanils_num = +4;
							echo '<div class="item active">';
						  }
						  elseif( $slide_to == $thumbanils_num){
							$thumbanils_num = $thumbanils_num + 4;
							echo '</div><div class="item">';
						  }                
					
					?>
						<div data-target="#myCarousel" data-slide-to="<?php echo $slide_to;?>" class="thumb"><img src="<?php echo $banner_value; ?>"></div>
						<?php
						 $slide_to++;
						} ?>
					</div><!-- /items -->
					
					  <a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
					
				</div><!-- /carousel-inner -->
			
			</div> <!-- /thumbcarousel -->
		</div><!-- /clearfix -->

   <?php 
		} 
        else {
           display_event_banner();
        } 
        ?>       
               <p><?php //echo apply_filters( 'display_event_description', get_the_content() ); ?></p>            
              </div>
              <?php //do_action('single_event_overview_end');?>
            
            </div>   
            <!-- Event description column end -->
                                                    
           <!-- Organizer logo, Contact button, event location, time and social sharing column start -->                       
          <!--  <div class="col-md-4 text-justify ">                            
                <?php  //get_event_manager_template_part( 'content', 'single-event_listing-organizer' ); ?>
            </div> --> <!-- col-md-4 --> 
           <!-- Organizer logo, Contact button, event location, time and social sharing column end -->
                 
	 	</div>
	<div class="where-and-when-outer">
		<div class="where-and-when-outer-inner">
			<?php do_action( 'single_event_listing_start' ); ?>
			<div class="summits-tetails-text-testimonial">
				<div class="left">
					<p class="dtail-head">WHAT IS IT</P>
					<h2 class="summit-details-heading">Summit Details</h2>
					<p class="event-details-text-custom"><?php echo apply_filters( 'display_event_description', get_the_content() ); ?></p>
				</div>
				<div class="right">
					<h2> Attendee Testimonials</h2>
					<?php 
					include('attendee_testimonials.php'); 
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="whytoattend" id="whytoattend">
	<?php include('whytoattend.php');?>
	</div>
	
	<div class="details_key_themes" id="details_key_themes">
	<?php include('keythemes.php');?>
	</div>
	<div class="details_key_themes11" id="details_key_themes11">
		<?php 
		do_action('agenda_list');
		//include('agenda_custom.php');?>

	</div>	<div class="d-exe-board-speaker-outer">		<div class="executive-board-page-outer">			
	<?php include('executtive_board.php');?>		
	</div>		<div class="executive-board-page-outer speaker-keynote">			
	<?php 
	do_action('speaker_list');
	//include('speaker_list.php');?>		
	</div>		
	<!-- <div class="executive-board-page-outer speaker-our-list">			
	<?php //include('our-speaker.php');?>		
	</div>	 -->
	</div>	<div class="d-exe-board-summit-venue">		
	<?php //include('summit_venue.php');
	do_action('summit_vanue');
	?>	</div>	<div class="d-exe-board-summit-speaker-outer">		<div class="d-exe-board-summit-speaker-outer-inner">			<div class="d-summit-sponsor-outer platinum-sponsor">				
	<?php 
	do_action('sponsors_loop');
	do_action('sponsors_loop4');
	//include('palatinum_sponsor_list.php');?>			</div>			<div class="d-summit-sponsor-outer diamond-sponsor">				
	<?php //include('diamond_sponsor.php');?>			</div>		</div>	</div>	<div class="still-have-question-outer">		
	<?php include('still_have_question.php');?>	</div>
	<?php
    /**
     * single_event_listing_end hook
     */
    	do_action( 'single_event_listing_end' );
    ?>
	
	
  <?php endif; ?><!-- Main if condition end -->
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.js"type="text/javascript"></script>
<script type="text/javascript">
	jQuery('.attendee_testimonial_slider').bxSlider({
	 minSlides: 1,
	 maxSlides: 1,
	slideWidth: 400,
	slideMargin:0,
	speed:900,
	pager: false,
	autoHover: true,
	auto: true,
	responsive:true,
	infiniteLoop: true
	});
</script><script type="text/javascript">	jQuery('.board-member-slider').bxSlider({	 minSlides: 4,	 maxSlides: 4,	slideWidth: 1000,		moveSlides: 1,		slideMargin:11,	speed:900,		pager: false,	autoHover: true,	auto: true,	responsive:true,    	infiniteLoop: true	});</script><script type="text/javascript">	jQuery('.diamond-sponsor-slider').bxSlider({	 minSlides: 6,	 maxSlides: 6,	slideWidth: 1000,		moveSlides: 1,		slideMargin:11,	speed:900,		pager: false,	autoHover: true,	auto: true,	responsive:true,    	infiniteLoop: true	});</script>

