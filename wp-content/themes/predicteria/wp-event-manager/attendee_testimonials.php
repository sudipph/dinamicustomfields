<?php 
/* Template Name: My testimonial new */ ?>
 
<?php // get_header(); ?>
 
<div id="primary" class="content-area attendee_testi_custom">
    <main id="main" class="site-main" role="main">
       <?php
$args = array(
  'post_type'   => 'testimonials',
  'post_status' => 'publish',
  'tax_query'   => array(
  	array(
  		'taxonomy' => 'testimonials-category',
  		'field'    => 'slug',
  		'terms'    => 'attendee'
  	)
  )
 );
 
$testimonials = new WP_Query( $args );
if( $testimonials->have_posts() ) :
?>
  <ul class="attendee_testimonial_slider">
    <?php
      while( $testimonials->have_posts() ) :
        $testimonials->the_post();
		$title    = get_post_meta( get_the_ID(), 'qodef_testimonial_title', true );
		$text     = get_post_meta( get_the_ID(), 'qodef_testimonial_text', true );
		$author   = get_post_meta( get_the_ID(), 'qodef_testimonial_author', true );
		$position = get_post_meta( get_the_ID(), 'qodef_testimonial_author_position', true );
		$current_id = get_the_ID();
        ?>
		<li>
		<div class="qodef-testimonial-contentb testi_custom" id="qodef-testimonial-<?php echo esc_attr( $current_id ) ?>">
				
					<div class="qodef-testimonial-text-holder">
                        <?php if ( ! empty( $text ) ) { ?>
                            <p class="qodef-testimonial-text"><?php echo esc_html( $text ); ?></p>
                        <?php } ?>
					<!--	<span class="qodef-testimonial-type-id">
		                    <span class="qodef-bg-svg">
								<?php echo wellexpo_select_get_dot_svg_image(); ?>
							</span>
					        <span class="qodef-testimonial-icon-holder">
						        <span class="qodef-testimonial-icon">“</span>
					        </span>
					    </span> -->
                        
                    </div>
					
                    <div class="qodef-testimonial-heading">
	                    <?php if ( has_post_thumbnail() ) { ?>
                            <div class="qodef-testimonial-image">
                                <?php echo get_the_post_thumbnail( get_the_ID(), array( 114, 114 ) ); ?>
                            </div>
                        <?php } ?>
	                    
						<?php if ( ! empty( $author ) ) { ?>
                            <div class="qodef-testimonial-author-holder clearfix">
                                <h5 class="qodef-testimonial-author-name">
                                    <span><?php echo esc_html( $author ); ?></span>
                                </h5>
	                            <?php if ( ! empty( $position ) ) { ?>
	                                <div class="qodef-testimonial-author-job">
                                        <span><?php echo esc_html( $position ); ?></span>
	                                </div>
			                    <?php } ?>
                            </div>
                        <?php } ?>
			        </div>
				
				</div>
		
		</li>
          <!-- <li><?php printf( '%1$s - %2$s', get_the_title(), get_the_content() );  ?></li>  -->
        <?php
      endwhile;
      wp_reset_postdata();
    ?>
  </ul>
<?php
else :
  esc_html_e( 'No testimonials in the diving taxonomy!', 'text-domain' );
endif;
?>
 
    </main><!-- .site-main -->
 
    <?php //get_sidebar( 'content-bottom' ); ?>
 
</div><!-- .content-area -->
 
<?php // get_sidebar(); ?>
<?php //get_footer(); ?>