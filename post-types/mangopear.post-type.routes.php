<?php

	/**
	 * Register custom post type for the website: Bus & train routes [routes]
	 *
	 * @category 	Post types
	 * @package  	scenic-buses
	 * @author  	Andi North <andi@mangopear.co.uk>
	 * @copyright  	2017 Mangopear creative
	 * @license   	GNU General Public License <http://opensource.org/licenses/gpl-license.php>
	 * @version  	3.0.0
	 * @link 		https://mangopear.co.uk/
	 * @since   	3.0.0
	 */
	

	/**
	 * Contents
	 *
	 * [1]	Register post type: Routes
	 * [2]	Register taxonomy: Route locations
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
	

	if (!function_exists('mangopear_register_type_routes')) {
		function mangopear_register_type_routes() {
			
			/**
			 * [a]	Define the labels for our post type
			 */
			
			$labels = array(
				'name'					=> _x('Routes',				'Post Type General Name', 	'mangopear'),
				'singular_name'			=> _x('Route',				'Post Type Singular Name',	'mangopear'),
				'menu_name'				=> __('Routes',				'mangopear'),
				'parent_item_colon'		=> __('Parent route:',		'mangopear'),
				'all_items'				=> __('All routes',			'mangopear'),
				'view_item'				=> __('View route',			'mangopear'),
				'add_new_item'			=> __('Add new route',		'mangopear'),
				'add_new'				=> __('Add new',			'mangopear'),
				'edit_item'				=> __('Edit route',			'mangopear'),
				'update_item'			=> __('Update route',		'mangopear'),
				'search_items'			=> __('Search routes',		'mangopear'),
				'not_found'				=> __('Not found',			'mangopear'),
				'not_found_in_trash'	=> __('Not found in trash',	'mangopear'),
			);


			/**
			 * [b]	Define the permalinks for the post type
			 */
			
			$rewrite = array(
				'slug'					=> 'routes',
				'with_front'			=> true,
				'pages'					=> true,
				'feeds'					=> true,
			);


			/**
			 * [c]	Define settings for the post type
			 */
			
			$args = array(
				'label'					=> __('routes',																'mangopear'),
				'description'			=> __('Bus and train routes across the UK', 								'mangopear'),
				'labels'				=> $labels,
				'supports'				=> array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
				'taxonomies'			=> array('resource__types', 'resources__tags'),
				'hierarchical'			=> true,
				'public'				=> true,
				'show_ui'				=> true,
				'show_in_menu'			=> true,
				'menu_icon'				=> 'dashicons-location-alt',
				'show_in_nav_menus'		=> false,
				'show_in_admin_bar'		=> true,
				'menu_position'			=> 48,
				'can_export'			=> true,
				'has_archive'			=> true,
				'exclude_from_search'	=> false,
				'publicly_queryable'	=> true,
				'rewrite'				=> $rewrite,
				'capability_type'		=> 'page',
			);


			/**
			 * [d]	Register the post type in WordPress
			 */
			
			register_post_type('routes', $args);
		}


		/**
		 * [e]	Hook into plugin activation
		 */
		
		add_action('init', 'mangopear_register_type_routes', 0);
	}





	/**
	 * [2]	Register taxonomy: Route locations
	 */
	
	if (! function_exists('mangopear_register_taxonomy_route_locations')) {
		function mangopear_register_taxonomy_route_locations() {
			$labels = array(
				'name'                       => _x('Locations', 							'Taxonomy General Name', 	'mangopear'),
				'singular_name'              => _x('Location', 								'Taxonomy Singular Name', 	'mangopear'),
				'menu_name'                  => __('Locations', 							'mangopear'),
				'all_items'                  => __('All locations', 						'mangopear'),
				'parent_item'                => __('Parent location', 						'mangopear'),
				'parent_item_colon'          => __('Parent location:', 						'mangopear'),
				'new_item_name'              => __('New location', 							'mangopear'),
				'add_new_item'               => __('Add new location', 						'mangopear'),
				'edit_item'                  => __('Edit location', 						'mangopear'),
				'update_item'                => __('Update location', 						'mangopear'),
				'separate_items_with_commas' => __('Separate locations with commas', 		'mangopear'),
				'search_items'               => __('Search locations', 						'mangopear'),
				'add_or_remove_items'        => __('Add or remove locations', 				'mangopear'),
				'choose_from_most_used'      => __('Choose from the most used locations', 	'mangopear'),
				'not_found'                  => __('Category not found', 					'mangopear'),
			);


			$rewrite = array(
				'slug'                       => 'destinations',
				'with_front'                 => true,
				'hierarchical'               => true,
			);


			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => false,
				'query_var'                  => 'route__locations',
				'rewrite'                    => $rewrite,
			);


			register_taxonomy('route__locations', array('routes'), $args);
		}


		add_action('init', 'mangopear_register_taxonomy_route_locations', 0);
	}
	
?>