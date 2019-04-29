<?php

class WellExpoSelectClassAuthorInfoWidget extends WellExpoSelectClassWidget {
	public function __construct() {
		parent::__construct(
			'qodef_author_info_widget',
			esc_html__( 'Predicteria Author Info Widget', 'wellexpo' ),
			array( 'description' => esc_html__( 'Add author info element to widget areas', 'wellexpo' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'extra_class',
				'title' => esc_html__( 'Custom CSS Class', 'wellexpo' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_bottom_margin',
				'title' => esc_html__( 'Widget Bottom Margin (px)', 'wellexpo' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'author_username',
				'title' => esc_html__( 'Author Username', 'wellexpo' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'show_author_name',
				'title'   => esc_html__( 'Show Author Name', 'wellexpo' ),
				'options' => wellexpo_select_get_yes_no_select_array(false, true)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'author_name_skin',
				'title'   => esc_html__( 'Author Name Skin', 'wellexpo' ),
				'options' => array(
					''      => esc_html__( 'Default', 'wellexpo' ),
					'light' => esc_html__( 'Light', 'wellexpo' ),
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'show_author_info',
				'title'   => esc_html__( 'Show Author Info', 'wellexpo' ),
				'options' => wellexpo_select_get_yes_no_select_array(false, true)
			),
		);
	}
	
	public function widget( $args, $instance ) {
		extract( $args );
		
		$extra_class = '';
		if ( ! empty( $instance['extra_class'] ) ) {
			$extra_class = $instance['extra_class'];
		}
		
		$widget_styles = array();
		if ( isset( $instance['widget_bottom_margin'] ) && $instance['widget_bottom_margin'] !== '' ) {
			$widget_styles[] = 'margin-bottom: ' . wellexpo_select_filter_px( $instance['widget_bottom_margin'] ) . 'px';
		}
		
		$authorID = 1;
		if ( ! empty( $instance['author_username'] ) ) {
			$author = get_user_by( 'login', $instance['author_username'] );
			
			if ( $author ) {
				$authorID = $author->ID;
			}
		}

		if (!isset($instance['show_author_name'])) {
			$instance['show_author_name'] = 'no';
		}

		$author_name_class = '';
		if (!empty($instance['author_name_skin'])) {
			$author_name_class = 'qodef-aiw-title-' . $instance['author_name_skin'] . '-skin';
		}

		if (!isset($instance['show_author_info'])) {
			$instance['show_author_info'] = 'no';
		}

		$author_name = $instance['show_author_name'] === 'yes'
			? (( get_the_author_meta( 'first_name', $authorID ) != "" || get_the_author_meta( 'last_name', $authorID ) != "" )
				? get_the_author_meta( 'first_name', $authorID ) . "<br />" . get_the_author_meta( 'last_name', $authorID )
				: get_the_author_meta( 'display_name', $authorID ))
			: '';
		$author_info = $instance['show_author_info'] === 'yes' ? get_the_author_meta( 'description', $authorID ) : '';
		?>
		
		<div class="widget qodef-author-info-widget <?php echo esc_html( $extra_class ); ?>" <?php echo wellexpo_select_get_inline_style( $widget_styles ); ?>>
			<div class="qodef-aiw-inner">
				<span class="qodef-aiw-image">
					<?php echo wellexpo_select_kses_img( get_avatar( $authorID, 302 ) ); ?>
					<?php if ( $instance['show_author_name'] === 'yes' && $author_name !== "" ) { ?>
						<span class="qodef-aiw-title <?php echo esc_attr( $author_name_class ); ?> vcard author">
							<a itemprop="url" href="<?php echo esc_url( get_author_posts_url( $authorID ) ); ?>" title="<?php the_title_attribute(); ?>">
								<span class="fn">
									<?php echo wp_kses( $author_name, array( 'br' => true ) ); ?>
								</span>
							</a>
						</span>
					<?php } ?>
				</span>
				<?php if ( $instance['show_author_info'] === 'yes' && $author_info !== "" ) { ?>
					<p itemprop="description" class="qodef-aiw-text"><?php echo wp_kses_post( $author_info ); ?></p>
				<?php } ?>
			</div>
		</div>
		<?php
	}
}