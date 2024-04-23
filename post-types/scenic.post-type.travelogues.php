<?php

	/**
	 * Register custom post type for the website: Travelogue articles
	 *
	 * @category 	Post types
	 * @package  	scenic-buses
	 * @author  	Andi North <andi@scenic.co.uk>
	 * @copyright  	2023 The Very Creative Fruit Bowl Company
	 * @license   	GNU General Public License <http://opensource.org/licenses/gpl-license.php>
	 * @version  	10.2.0
	 * @link 		https://scenic.co.uk/
	 * @since   	10.2.0
	 */
	

	/**
	 * Contents
	 *
	 * [1]	Register post type: Travelogues
	 */
	

	/**
	 * [1]	Register post type: Travelogues
	 *
	 * 		[a]	Define the labels for our post type
	 * 		[b]	Define the permalinks for the post type
	 * 		[c]	Define settings for the post type
	 * 		[d]	Register the post type in WordPress
	 * 		[e]	Hook into plugin activation
	 */
	

	if (!function_exists('scenic_register_type_travelogues')) {
		function scenic_register_type_travelogues() {
			
			/**
			 * [a]	Define the labels for our post type
			 */
			
			$labels = array(
				'name'					=> _x('Travelogues',			'Post Type General Name', 	'scenic'),
				'singular_name'			=> _x('Travelogue',				'Post Type Singular Name',	'scenic'),
				'menu_name'				=> __('Travelogues',			'scenic'),
				'parent_item_colon'		=> __('Parent travelogue:',		'scenic'),
				'all_items'				=> __('All travelogues',		'scenic'),
				'view_item'				=> __('View travelogue',		'scenic'),
				'add_new_item'			=> __('Add new travelogue',		'scenic'),
				'add_new'				=> __('Add new',				'scenic'),
				'edit_item'				=> __('Edit travelogue',		'scenic'),
				'update_item'			=> __('Update travelogue',		'scenic'),
				'search_items'			=> __('Search travelogues',		'scenic'),
				'not_found'				=> __('Not found',				'scenic'),
				'not_found_in_trash'	=> __('Not found in trash',		'scenic'),
			);


			/**
			 * [b]	Define the permalinks for the post type
			 */
			
			$rewrite = array(
				'slug'					=> 'travelogues',
				'with_front'			=> true,
				'pages'					=> false,
				'feeds'					=> true,
			);


			/**
			 * [c]	Define settings for the post type
			 */
			
			$args = array(
				'label'					=> __('Travelogues',																									'scenic'),
				'description'			=> __('Find inspiration for scenic days out by bus from across the UK & Ireland in these carefully crafted articles.', 	'scenic'),
				'labels'				=> $labels,
				'supports'				=> array('title', 'editor', 'author', 'thumbnail', 'excerpt'),
				'taxonomies'			=> array('category', 'route__locations', 'route__genres', 'operators'),
				'hierarchical'			=> false,
				'public'				=> true,
				'show_ui'				=> true,
				'show_in_menu'			=> true,
				'menu_icon'				=> 'dashicons-excerpt-view',
				'show_in_nav_menus'		=> false,
				'show_in_admin_bar'		=> true,
				'menu_position'			=> 45,
				'can_export'			=> true,
				'has_archive'			=> true,
				'exclude_from_search'	=> false,
				'publicly_queryable'	=> true,
				'rewrite'				=> $rewrite,
				'capability_type'		=> 'post',
				'show_in_rest'			=> true,
			);


			/**
			 * [d]	Register the post type in WordPress
			 */
			
			register_post_type('travelogues', $args);
		}


		/**
		 * [e]	Hook into plugin activation
		 */
		
		add_action('init', 'scenic_register_type_travelogues', 0);
	}
	
?>