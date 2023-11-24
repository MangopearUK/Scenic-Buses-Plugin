<?php

	/**
	 * Register custom post type for the website: Bus & train routes [routes]
	 *
	 * @category 	Post types
	 * @package  	scenic-buses
	 * @author  	Andi North <andi@mangopear.co.uk>
	 * @copyright  	2017 Mangopear creative
	 * @license   	GNU General Public License <http://opensource.org/licenses/gpl-license.php>
	 * @version  	3.1.0
	 * @link 		https://mangopear.co.uk/
	 * @since   	3.1.0
	 */
	

	/**
	 * Contents
	 *
	 * [1]	Register post type: Routes
	 * [2]	Register taxonomy: Route locations
	 * [5]	Register taxonomy: Tickets
	 */
	

	/**
	 * [1]	Register post type: Routes
	 *
	 * 		[a]	Define the labels for our post type
	 * 		[b]	Define the permalinks for the post type
	 * 		[c]	Define settings for the post type
	 * 		[d]	Register the post type in WordPress
	 * 		[e]	Hook into plugin activation
	 */
	

	if (!function_exists('mangopear_register_type_reviews')) {
		function mangopear_register_type_reviews() {
			
			/**
			 * [a]	Define the labels for our post type
			 */
			
			$labels = array(
				'name'					=> _x('Reviews',			'Post Type General Name', 	'mangopear'),
				'singular_name'			=> _x('Review',				'Post Type Singular Name',	'mangopear'),
				'menu_name'				=> __('Reviews',			'mangopear'),
				'parent_item_colon'		=> __('Parent review:',		'mangopear'),
				'all_items'				=> __('All reviews',			'mangopear'),
				'view_item'				=> __('View review',			'mangopear'),
				'add_new_item'			=> __('Add new review',		'mangopear'),
				'add_new'				=> __('Add new',			'mangopear'),
				'edit_item'				=> __('Edit review',			'mangopear'),
				'update_item'			=> __('Update review',		'mangopear'),
				'search_items'			=> __('Search reviews',		'mangopear'),
				'not_found'				=> __('Not found',			'mangopear'),
				'not_found_in_trash'	=> __('Not found in trash',	'mangopear'),
			);


			/**
			 * [b]	Define the permalinks for the post type
			 */
			
			$rewrite = array(
				'slug'					=> 'reviews',
				'with_front'			=> true,
				'pages'					=> true,
				'feeds'					=> true,
			);


			/**
			 * [c]	Define settings for the post type
			 */
			
			$args = array(
				'label'					=> __('Reviews',																			'mangopear'),
				'description'			=> __('User reviews of bus, coach and rail routes and locations served by these routes', 	'mangopear'),
				'labels'				=> $labels,
				'supports'				=> array('title', 'editor', 'author', 'thumbnail', 'excerpt'),
				'taxonomies'			=> array('route__locations'),
				'hierarchical'			=> false,
				'public'				=> true,
				'show_ui'				=> true,
				'show_in_menu'			=> true,
				'menu_icon'				=> 'dashicons-star-half',
				'show_in_nav_menus'		=> false,
				'show_in_admin_bar'		=> true,
				'menu_position'			=> 46,
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
			
			register_post_type('reviews', $args);
		}


		/**
		 * [e]	Hook into plugin activation
		 */
		
		add_action('init', 'mangopear_register_type_reviews', 0);
	}
	
?>