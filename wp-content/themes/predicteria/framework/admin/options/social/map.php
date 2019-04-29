<?php

if ( ! function_exists( 'wellexpo_select_social_options_map' ) ) {
	function wellexpo_select_social_options_map() {

	    $page = '_social_page';
		
		wellexpo_select_add_admin_page(
			array(
				'slug'  => '_social_page',
				'title' => esc_html__( 'Social Networks', 'wellexpo' ),
				'icon'  => 'fa fa-share-alt'
			)
		);
		
		/**
		 * Enable Social Share
		 */
		$panel_social_share = wellexpo_select_add_admin_panel(
			array(
				'page'  => '_social_page',
				'name'  => 'panel_social_share',
				'title' => esc_html__( 'Enable Social Share', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Social Share', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will allow social share on networks of your choice', 'wellexpo' ),
				'parent'        => $panel_social_share
			)
		);
		
		$panel_show_social_share_on = wellexpo_select_add_admin_panel(
			array(
				'page'            => '_social_page',
				'name'            => 'panel_show_social_share_on',
				'title'           => esc_html__( 'Show Social Share On', 'wellexpo' ),
				'dependency' => array(
					'show' => array(
						'enable_social_share'  => 'yes'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_post',
				'default_value' => 'no',
				'label'         => esc_html__( 'Posts', 'wellexpo' ),
				'description'   => esc_html__( 'Show Social Share on Blog Posts', 'wellexpo' ),
				'parent'        => $panel_show_social_share_on
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_social_share_on_page',
				'default_value' => 'no',
				'label'         => esc_html__( 'Pages', 'wellexpo' ),
				'description'   => esc_html__( 'Show Social Share on Pages', 'wellexpo' ),
				'parent'        => $panel_show_social_share_on
			)
		);

        /**
         * Action for embedding social share option for custom post types
         */
		do_action('wellexpo_select_action_post_types_social_share', $panel_show_social_share_on);
		
		/**
		 * Social Share Networks
		 */
		$panel_social_networks = wellexpo_select_add_admin_panel(
			array(
				'page'            => '_social_page',
				'name'            => 'panel_social_networks',
				'title'           => esc_html__( 'Social Networks', 'wellexpo' ),
				'dependency' => array(
					'hide' => array(
						'enable_social_share'  => 'no'
					)
				)
			)
		);
		
		/**
		 * Facebook
		 */
		wellexpo_select_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'facebook_title',
				'title'  => esc_html__( 'Share on Facebook', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_facebook_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Facebook', 'wellexpo' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_facebook_share_container = wellexpo_select_add_admin_container(
			array(
				'name'            => 'enable_facebook_share_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_facebook_share'  => 'yes'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'facebook_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'wellexpo' ),
				'parent'        => $enable_facebook_share_container
			)
		);
		
		/**
		 * Twitter
		 */
		wellexpo_select_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'twitter_title',
				'title'  => esc_html__( 'Share on Twitter', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_twitter_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Twitter', 'wellexpo' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_twitter_share_container = wellexpo_select_add_admin_container(
			array(
				'name'            => 'enable_twitter_share_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_twitter_share'  => 'yes'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'twitter_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'wellexpo' ),
				'parent'        => $enable_twitter_share_container
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'twitter_via',
				'default_value' => '',
				'label'         => esc_html__( 'Via', 'wellexpo' ),
				'parent'        => $enable_twitter_share_container
			)
		);
		
		/**
		 * Google Plus
		 */
		wellexpo_select_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'google_plus_title',
				'title'  => esc_html__( 'Share on Google Plus', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_google_plus_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Google Plus', 'wellexpo' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_google_plus_container = wellexpo_select_add_admin_container(
			array(
				'name'            => 'enable_google_plus_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_google_plus_share'  => 'yes'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'google_plus_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'wellexpo' ),
				'parent'        => $enable_google_plus_container
			)
		);
		
		/**
		 * Linked In
		 */
		wellexpo_select_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'linkedin_title',
				'title'  => esc_html__( 'Share on LinkedIn', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_linkedin_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via LinkedIn', 'wellexpo' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_linkedin_container = wellexpo_select_add_admin_container(
			array(
				'name'            => 'enable_linkedin_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_linkedin_share'  => 'yes'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'linkedin_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'wellexpo' ),
				'parent'        => $enable_linkedin_container
			)
		);
		
		/**
		 * Tumblr
		 */
		wellexpo_select_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'tumblr_title',
				'title'  => esc_html__( 'Share on Tumblr', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_tumblr_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Tumblr', 'wellexpo' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_tumblr_container = wellexpo_select_add_admin_container(
			array(
				'name'            => 'enable_tumblr_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_tumblr_share'  => 'yes'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'tumblr_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'wellexpo' ),
				'parent'        => $enable_tumblr_container
			)
		);
		
		/**
		 * Pinterest
		 */
		wellexpo_select_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'pinterest_title',
				'title'  => esc_html__( 'Share on Pinterest', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_pinterest_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via Pinterest', 'wellexpo' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_pinterest_container = wellexpo_select_add_admin_container(
			array(
				'name'            => 'enable_pinterest_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_pinterest_share'  => 'yes'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'pinterest_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'wellexpo' ),
				'parent'        => $enable_pinterest_container
			)
		);
		
		/**
		 * VK
		 */
		wellexpo_select_add_admin_section_title(
			array(
				'parent' => $panel_social_networks,
				'name'   => 'vk_title',
				'title'  => esc_html__( 'Share on VK', 'wellexpo' )
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_vk_share',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Share', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will allow sharing via VK', 'wellexpo' ),
				'parent'        => $panel_social_networks
			)
		);
		
		$enable_vk_container = wellexpo_select_add_admin_container(
			array(
				'name'            => 'enable_vk_container',
				'parent'          => $panel_social_networks,
				'dependency' => array(
					'show' => array(
						'enable_vk_share'  => 'yes'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'vk_icon',
				'default_value' => '',
				'label'         => esc_html__( 'Upload Icon', 'wellexpo' ),
				'parent'        => $enable_vk_container
			)
		);
		
		if ( defined( 'WELLEXPO_TWITTER_FEED_VERSION' ) ) {
			$twitter_panel = wellexpo_select_add_admin_panel(
				array(
					'title' => esc_html__( 'Twitter', 'wellexpo' ),
					'name'  => 'panel_twitter',
					'page'  => '_social_page'
				)
			);
			
			wellexpo_select_add_admin_twitter_button(
				array(
					'name'   => 'twitter_button',
					'parent' => $twitter_panel
				)
			);
		}
		
		if ( defined( 'WELLEXPO_INSTAGRAM_FEED_VERSION' ) ) {
			$instagram_panel = wellexpo_select_add_admin_panel(
				array(
					'title' => esc_html__( 'Instagram', 'wellexpo' ),
					'name'  => 'panel_instagram',
					'page'  => '_social_page'
				)
			);
			
			wellexpo_select_add_admin_instagram_button(
				array(
					'name'   => 'instagram_button',
					'parent' => $instagram_panel
				)
			);
		}
		
		/**
		 * Open Graph
		 */
		$panel_open_graph = wellexpo_select_add_admin_panel(
			array(
				'page'  => '_social_page',
				'name'  => 'panel_open_graph',
				'title' => esc_html__( 'Open Graph', 'wellexpo' ),
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_open_graph',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Open Graph', 'wellexpo' ),
				'description'   => esc_html__( 'Enabling this option will allow usage of Open Graph protocol on your site', 'wellexpo' ),
				'parent'        => $panel_open_graph
			)
		);
		
		$enable_open_graph_container = wellexpo_select_add_admin_container(
			array(
				'name'            => 'enable_open_graph_container',
				'parent'          => $panel_open_graph,
				'dependency' => array(
					'show' => array(
						'enable_open_graph'  => 'yes'
					)
				)
			)
		);
		
		wellexpo_select_add_admin_field(
			array(
				'type'          => 'image',
				'name'          => 'open_graph_image',
				'default_value' => SELECT_ASSETS_ROOT . '/img/open_graph.jpg',
				'label'         => esc_html__( 'Default Share Image', 'wellexpo' ),
				'parent'        => $enable_open_graph_container,
				'description'   => esc_html__( 'Used when featured image is not set. Make sure that image is at least 1200 x 630 pixels, up to 8MB in size', 'wellexpo' ),
			)
		);

        /**
         * Action for embedding social share option for custom post types
         */
        do_action('wellexpo_select_action_social_options', $page);
	}
	
	add_action( 'wellexpo_select_action_options_map', 'wellexpo_select_social_options_map', wellexpo_select_set_options_map_position( 'social' ) );
}