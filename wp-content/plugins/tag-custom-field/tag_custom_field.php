<?php
/*
Plugin Name: Tag Custom Field
Plugin URI: https://google.com/
Description: Just another contact form plugin. Simple but flexible.
Author: Sudip
Text Domain: tag-custom-field
Version: 1.0
*/

//add_action( 'init', 'create_tag_taxonomies', 0 );

//create two taxonomies, genres and tags for the post type "tag"
// function create_tag_taxonomies() 
// {
//   // Add new taxonomy, NOT hierarchical (like tags)
//   $labels = array(
//     'name' => _x( 'Topic', 'taxonomy general name' ),
//     'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
//     'search_items' =>  __( 'Search Topic' ),
//     'popular_items' => __( 'Popular Topic' ),
//     'all_items' => __( 'All Topic' ),
//     'parent_item' => null,
//     'parent_item_colon' => null,
//     'edit_item' => __( 'Edit Tag' ), 
//     'update_item' => __( 'Update Tag' ),
//     'add_new_item' => __( 'Add New Tag' ),
//     'new_item_name' => __( 'New Tag Name' ),
//     'separate_items_with_commas' => __( 'Separate tags with commas' ),
//     'add_or_remove_items' => __( 'Add or remove tags' ),
//     'choose_from_most_used' => __( 'Choose from the most used tags' ),
//     'menu_name' => __( 'Topic' ),
//   ); 

//   register_taxonomy('topic','event_listing',array(
//     'hierarchical' => false,
//     'labels' => $labels,
//     'show_ui' => true,
//     'update_count_callback' => '_update_post_term_count',
//     'query_var' => true,
//     'rewrite' => array( 'slug' => 'topic' ),
//   ));
// }