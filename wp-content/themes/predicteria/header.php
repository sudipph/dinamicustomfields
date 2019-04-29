<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * wellexpo_select_action_header_meta hook
	 *
	 * @see wellexpo_select_header_meta() - hooked with 10
	 * @see wellexpo_select_user_scalable_meta - hooked with 10
	 * @see wellexpo_core_set_open_graph_meta - hooked with 10
	 */
	do_action( 'wellexpo_select_action_header_meta' );
	
	wp_head(); ?>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet"/>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php
	/**
	 * wellexpo_select_action_after_body_tag hook
	 *
	 * @see wellexpo_select_get_side_area() - hooked with 10
	 * @see wellexpo_select_smooth_page_transitions() - hooked with 10
	 */
	do_action( 'wellexpo_select_action_after_body_tag' ); ?>

    <div class="qodef-wrapper">
        <div class="qodef-wrapper-inner">
            <?php
            /**
             * wellexpo_select_action_after_wrapper_inner hook
             *
             * @see wellexpo_select_get_header() - hooked with 10
             * @see wellexpo_select_get_mobile_header() - hooked with 20
             * @see wellexpo_select_back_to_top_button() - hooked with 30
             * @see wellexpo_select_get_header_minimal_full_screen_menu() - hooked with 40
             * @see wellexpo_select_get_header_bottom_navigation() - hooked with 40
             */
            do_action( 'wellexpo_select_action_after_wrapper_inner' ); ?>
	        
            <div class="qodef-content" <?php wellexpo_select_content_elem_style_attr(); ?>>
                <div class="qodef-content-inner">