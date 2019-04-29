<?php

namespace WellExpoCore\Lib;

/**
 * interface PostTypeInterface
 * @package WellExpoCore\Lib;
 */
interface PostTypeInterface {
	/**
	 * @return string
	 */
	public function getBase();
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register();
}