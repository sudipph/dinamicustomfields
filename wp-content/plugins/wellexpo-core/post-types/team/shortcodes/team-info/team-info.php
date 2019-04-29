<?php
namespace WellExpoCore\CPT\Shortcodes\Team;

use WellExpoCore\Lib;

class TeamInfo implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'qodef_team_info';

        add_action('vc_before_init', array($this, 'vcMap'));

	    //Portfolio project id filter
	    add_filter( 'vc_autocomplete_qodef_team_info_member_id_callback', array( &$this, 'teamInfoIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Portfolio project id render
	    add_filter( 'vc_autocomplete_qodef_team_info_member_id_render', array( &$this, 'teamInfoIdAutocompleteRender', ), 10, 1 ); // Render exact portfolio. Must return an array (label,value)
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
        if(function_exists('vc_map')) {
	        vc_map( array(
			        'name'                      => esc_html__( 'Team Info', 'wellexpo-core' ),
			        'base'                      => $this->getBase(),
			        'category'                  => esc_html__( 'by WELLEXPO', 'wellexpo-core' ),
			        'icon'                      => 'icon-wpb-team-info extended-custom-icon',
			        'allowed_container_element' => 'vc_row',
			        'params'                    => array(
                        array(
					        'type'       => 'autocomplete',
					        'param_name' => 'member_id',
					        'heading'    => esc_html__( 'Select Team Member', 'wellexpo-core' ),
					        'settings'   => array(
						        'sortable'      => true,
						        'unique_values' => true
					        ),
					        'description' => esc_html__( 'If you left this field empty then project ID will be of the current page', 'wellexpo-core' )
				        ),
                        array(
							'type'       => 'dropdown',
							'param_name' => 'skin',
							'heading'    => esc_html__( 'Skin', 'wellexpo-core' ),
							'value'      => array(
								esc_html__( 'Default', 'wellexpo-core' ) => '',
								esc_html__( 'Dark', 'wellexpo-core' )    => 'qodef-dark-skin',
							),
							'save_always' => true
						),
                        array(
					        'type'        => 'dropdown',
					        'param_name'  => 'show_image',
					        'heading'     => esc_html__( 'Show Member\'s Image', 'wellexpo-core' ),
					        'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false, true ) ),
					        'save_always' => true
	                    ),
				        array(
					        'type'        => 'dropdown',
					        'param_name'  => 'show_title',
					        'heading'     => esc_html__( 'Show Member\'s Name', 'wellexpo-core' ),
					        'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false, true ) ),
					        'save_always' => true
	                    ),
				        array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'wellexpo-core' ),
							'value'       => array_flip( wellexpo_select_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'show_title', 'value' => 'yes' )
						),
				        array(
					        'type'        => 'dropdown',
					        'param_name'  => 'show_excerpt',
					        'heading'     => esc_html__( 'Show Member\'s Excerpt', 'wellexpo-core' ),
					        'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false, true ) ),
					        'save_always' => true
	                    ),
				        array(
					        'type'        => 'dropdown',
					        'param_name'  => 'show_position',
					        'heading'     => esc_html__( 'Show Member\'s Position', 'wellexpo-core' ),
					        'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false, false ) ),
					        'save_always' => true
	                    ),
				        array(
					        'type'        => 'dropdown',
					        'param_name'  => 'show_birth_date',
					        'heading'     => esc_html__( 'Show Member\'s Birth Date', 'wellexpo-core' ),
					        'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false, false ) ),
					        'save_always' => true
	                    ),
				        array(
					        'type'        => 'dropdown',
					        'param_name'  => 'show_email',
					        'heading'     => esc_html__( 'Show Member\'s Email', 'wellexpo-core' ),
					        'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false, true ) ),
					        'save_always' => true
	                    ),
				        array(
					        'type'        => 'dropdown',
					        'param_name'  => 'show_twitter',
					        'heading'     => esc_html__( 'Show Member\'s Twitter', 'wellexpo-core' ),
					        'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false, true ) ),
					        'save_always' => true
	                    ),
				        array(
					        'type'        => 'dropdown',
					        'param_name'  => 'show_website',
					        'heading'     => esc_html__( 'Show Member\'s Website', 'wellexpo-core' ),
					        'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false, true ) ),
					        'save_always' => true
	                    ),
				        array(
					        'type'        => 'dropdown',
					        'param_name'  => 'show_phone',
					        'heading'     => esc_html__( 'Show Member\'s Phone', 'wellexpo-core' ),
					        'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false, false ) ),
					        'save_always' => true
	                    ),
				        array(
					        'type'        => 'dropdown',
					        'param_name'  => 'show_address',
					        'heading'     => esc_html__( 'Show Member\'s Address', 'wellexpo-core' ),
					        'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false, false ) ),
					        'save_always' => true
	                    ),
				        array(
					        'type'        => 'dropdown',
					        'param_name'  => 'show_interview',
					        'heading'     => esc_html__( 'Show Member\'s Interview', 'wellexpo-core' ),
					        'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false, true ) ),
					        'save_always' => true
	                    ),
				        array(
					        'type'        => 'dropdown',
					        'param_name'  => 'show_resume',
					        'heading'     => esc_html__( 'Show Member\'s Resume', 'wellexpo-core' ),
					        'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false, false ) ),
					        'save_always' => true
	                    ),
				        array(
					        'type'        => 'dropdown',
					        'param_name'  => 'show_social',
					        'heading'     => esc_html__( 'Show Member\'s Social Network Info', 'wellexpo-core' ),
					        'value'       => array_flip( wellexpo_select_get_yes_no_select_array( false, false ) ),
					        'save_always' => true
	                    )
			        )
		        )
	        );
        }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
	        'member_id'       => 'title',
	        'skin'            => '',
	        'show_image'      => 'yes',
	        'show_title'      => 'yes',
	        'title_tag'       => 'h4',
	        'show_excerpt'    => 'yes',
	        'show_position'   => 'no',
	        'show_birth_date' => 'no',
	        'show_email'      => 'yes',
	        'show_twitter'    => 'yes',
	        'show_website'    => 'yes',
	        'show_phone'      => 'no',
	        'show_address'    => 'no',
	        'show_interview'  => 'yes',
	        'show_resume'     => 'no',
	        'show_social'     => 'no'
        );

		$params = shortcode_atts($args, $atts);
		extract($params);

	    $params['member_id']         = ! empty( $params['member_id'] ) ? $params['member_id'] : get_the_ID();
	    $params['image']             = get_the_post_thumbnail( $params['member_id'] );
	    $params['title']             = get_the_title( $params['member_id'] );
	    $params['title_tag']         = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
	    $params['excerpt']           = get_the_excerpt( $params['member_id'] );
	    $params['position']          = get_post_meta( $params['member_id'], 'qodef_team_member_position', true );
	    $params['birth_date']        = get_post_meta( $params['member_id'], 'qodef_team_member_birth_date', true );
	    $params['email']             = get_post_meta( $params['member_id'], 'qodef_team_member_email', true );
	    $params['twitter']           = get_post_meta( $params['member_id'], 'qodef_team_member_twitter', true );
	    $params['email']             = get_post_meta( $params['member_id'], 'qodef_team_member_email', true );
	    $params['website']           = get_post_meta( $params['member_id'], 'qodef_team_member_website', true );
	    $params['phone']             = get_post_meta( $params['member_id'], 'qodef_team_member_phone', true );
	    $params['address']           = get_post_meta( $params['member_id'], 'qodef_team_member_address', true );
	    $params['interview']         = get_post_meta( $params['member_id'], 'qodef_team_member_interview', true );
	    $params['resume']            = get_post_meta( $params['member_id'], 'qodef_team_member_resume', true );
	    $params['social']            = get_post_meta( $params['member_id'], 'qodef_team_member_social', true );
	    $params['team_social_icons'] = $this->getTeamSocialIcons( $params['member_id'] );

	    $params['holder_classes']    = $this->getHolderClasses( $params );

        $html = wellexpo_core_get_cpt_shortcode_module_template_part('team', 'team-info', 'team-info', '', $params);

        return $html;
	}

	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['image'] ) ? 'qodef-team-image-enabled' : '';
		$holderClasses[] = ! empty( $params['skin'] ) ? $params['skin'] : '';

		return implode( ' ', $holderClasses );
	}

    private function getTeamSocialIcons($id) {
        $social_icons = array();

        for($i = 1; $i < 6; $i++) {
            $team_icon_pack = get_post_meta($id, 'qodef_team_member_social_icon_pack_'.$i, true);
            if($team_icon_pack) {
                $team_icon_collection = wellexpo_select_icon_collections()->getIconCollection(get_post_meta($id, 'qodef_team_member_social_icon_pack_' . $i, true));
                $team_social_icon = get_post_meta($id, 'qodef_team_member_social_icon_pack_' . $i . '_' . $team_icon_collection->param, true);
                $team_social_link = get_post_meta($id, 'qodef_team_member_social_icon_' . $i . '_link', true);
                $team_social_target = get_post_meta($id, 'qodef_team_member_social_icon_' . $i . '_target', true);

                if ($team_social_icon !== '') {

                    $team_icon_params = array();
                    $team_icon_params['icon_pack'] = $team_icon_pack;
                    $team_icon_params[$team_icon_collection->param] = $team_social_icon;
                    $team_icon_params['link'] = ($team_social_link !== '') ? $team_social_link : '';
                    $team_icon_params['target'] = ($team_social_target !== '') ? $team_social_target : '';

                    $social_icons[] = wellexpo_select_execute_shortcode('qodef_icon', $team_icon_params);
                }
            }
        }

        return $social_icons;
    }

	/**
	 * Filter team by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function teamInfoIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$portfolio_id = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'team-member' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $portfolio_id > 0 ? $portfolio_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'wellexpo-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'wellexpo-core' ) . ': ' . $value['title'] : '' );
				$results[] = $data;
			}
		}

		return $results;
	}

	/**
	 * Find team by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function teamInfoIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio
			$team = get_post( (int) $query );
			if ( ! is_wp_error( $team ) ) {

				$team_id = $team->ID;
                $team_title = $team->post_title;

                $team_title_display = '';
				if ( ! empty( $team_title ) ) {
                    $team_title_display = ' - ' . esc_html__( 'Title', 'wellexpo-core' ) . ': ' . $team_title;
				}

                $team_id_display = esc_html__( 'Id', 'wellexpo-core' ) . ': ' . $team_id;

				$data          = array();
				$data['value'] = $team_id;
				$data['label'] = $team_id_display . $team_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}