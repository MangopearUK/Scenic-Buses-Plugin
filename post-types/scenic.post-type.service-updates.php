<?php

	/**
	 * Register custom post type for the website: Service updates
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
	 * [1]	Register post type: service_updates
	 */
	

	/**
	 * [1]	Register post type: service_updates
	 *
	 * 		[a]	Define the labels for our post type
	 * 		[b]	Define the permalinks for the post type
	 * 		[c]	Define settings for the post type
	 * 		[d]	Register the post type in WordPress
	 * 		[e]	Hook into plugin activation
	 */
	

	if (!function_exists('scenic_register_type_service_updates')) {
		function scenic_register_type_service_updates() {
			
			/**
			 * [a]	Define the labels for our post type
			 */
			
			$labels = array(
				'name'					=> _x('Service updates',			'Post Type General Name', 	'scenic'),
				'singular_name'			=> _x('Service update',				'Post Type Singular Name',	'scenic'),
				'menu_name'				=> __('Service updates',			'scenic'),
				'parent_item_colon'		=> __('Parent service update:',		'scenic'),
				'all_items'				=> __('All service updates',		'scenic'),
				'view_item'				=> __('View service update',		'scenic'),
				'add_new_item'			=> __('Add new service update',		'scenic'),
				'add_new'				=> __('Add new',					'scenic'),
				'edit_item'				=> __('Edit service update',		'scenic'),
				'update_item'			=> __('Update service update',		'scenic'),
				'search_items'			=> __('Search service updates',		'scenic'),
				'not_found'				=> __('Not found',					'scenic'),
				'not_found_in_trash'	=> __('Not found in trash',			'scenic'),
			);


			/**
			 * [b]	Define the permalinks for the post type
			 */
			
			$rewrite = array(
				'slug'					=> 'updates',
				'with_front'			=> true,
				'pages'					=> true,
				'feeds'					=> true,
			);


			/**
			 * [c]	Define settings for the post type
			 */
			
			$args = array(
				'label'					=> __('Service updates',																			'scenic'),
				'description'			=> __('Keep up to date on the latest changes to the UK &amp; Ireland\'s most scenic bus routes.', 	'scenic'),
				'labels'				=> $labels,
				'supports'				=> array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
				'taxonomies'			=> array('category', 'route__locations', 'route__genres', 'operators'),
				'hierarchical'			=> false,
				'public'				=> true,
				'show_ui'				=> true,
				'show_in_menu'			=> true,
				'menu_icon'				=> 'dashicons-excerpt-view',
				'show_in_nav_menus'		=> false,
				'show_in_admin_bar'		=> true,
				'menu_position'			=> 48,
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
			
			register_post_type('service_updates', $args);
		}


		/**
		 * [e]	Hook into plugin activation
		 */
		
		add_action('init', 'scenic_register_type_service_updates', 0);
	}
	
?>