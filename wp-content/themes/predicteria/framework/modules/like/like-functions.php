<?php

if ( ! function_exists( 'wellexpo_select_like' ) ) {
	/**
	 * Returns WellExpoSelectClassLike instance
	 *
	 * @return WellExpoSelectClassLike
	 */
	function wellexpo_select_like() {
		return WellExpoSelectClassLike::get_instance();
	}
}

function wellexpo_select_get_like() {
	
	echo wp_kses( wellexpo_select_like()->add_like(), array(
		'span' => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'    => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'    => array(
			'href'  => true,
			'class' => true,
			'id'    => true,
			'title' => true,
			'style' => true
		)
	) );
}