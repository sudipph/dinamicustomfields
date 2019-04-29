<?php

if ( ! function_exists( 'wellexpo_select_set_search_slide_from_hb_global_option' ) ) {
    /**
     * This function set search type value for search options map
     */
    function wellexpo_select_set_search_slide_from_hb_global_option( $search_type_options ) {
        $search_type_options['slide-from-header-bottom'] = esc_html__( 'Slide From Header Bottom', 'wellexpo' );

        return $search_type_options;
    }

    add_filter( 'wellexpo_select_filter_search_type_global_option', 'wellexpo_select_set_search_slide_from_hb_global_option' );
}