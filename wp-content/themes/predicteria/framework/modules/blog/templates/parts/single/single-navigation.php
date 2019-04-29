<?php
$blog_single_navigation = wellexpo_select_options()->getOptionValue('blog_single_navigation') === 'no' ? false : true;
$blog_navigation_through_same_category = wellexpo_select_options()->getOptionValue('blog_navigation_through_same_category') === 'no' ? false : true;
?>
<?php if($blog_single_navigation){ ?>
	<div class="qodef-blog-single-navigation">
		<div class="qodef-blog-single-navigation-inner clearfix">
			<?php
				/* Single navigation section - SETTING PARAMS */
				$post_navigation = array(
					'prev' => array(
						'post'       => '',
						'image'      => '',
						'categories' => ''
					),
					'next' => array(
						'post'       => '',
						'image'      => '',
						'categories' => ''
					)
				);
			
				if($blog_navigation_through_same_category){
					if(get_previous_post(true) !== ""){
						$post_navigation['prev']['post'] = get_previous_post(true);
					}
					if(get_next_post(true) !== ""){
						$post_navigation['next']['post'] = get_next_post(true);
					}
				} else {
					if(get_previous_post() !== ""){
						$post_navigation['prev']['post'] = get_previous_post();
					}
					if(get_next_post() !== ""){
						$post_navigation['next']['post'] = get_next_post();
					}
				}

				/* Single navigation section - RENDERING */
				foreach (array('prev', 'next') as $nav_type) {
					if (isset($post_navigation[$nav_type]['post'])) { ?>
						<?php if ($post_navigation[$nav_type]['post']) { ?>
							<span class="qodef-blog-single-<?php echo esc_attr($nav_type); ?>">
								<a itemprop="url" class="qodef-post-image" href="<?php echo get_permalink($post_navigation[$nav_type]['post']->ID); ?>">
									<?php echo wellexpo_select_generate_thumbnail( get_post_thumbnail_id( $post_navigation[$nav_type]['post']->ID ), '', '67px', '47px' ) ?>
								</a>
								<span class="qodef-post-info">
									<?php wellexpo_select_get_module_template_part('templates/parts/post-info/category', 'blog', 'for-post', array('post_id' => $post_navigation[$nav_type]['post']->ID)); ?>
									<a itemprop="url" class="qodef-post-info-title" href="<?php echo get_permalink($post_navigation[$nav_type]['post']->ID); ?>">
										<?php echo substr( esc_html($post_navigation[$nav_type]['post']->post_title), 0, 44 ); ?>
									</a>
								</span>
							</span>
						<?php } ?>
					<?php }
				}
			?>
		</div>
	</div>
<?php } ?>