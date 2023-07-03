<?php

	/**
	 * Create options page for ACF fields
	 *
	 * @package  	scenic-buses
	 * @author  	Andi North <andi@mangopear.co.uk>
	 * @copyright  	2019 Mangopear creative
	 * @license   	GNU General Public License <http://opensource.org/licenses/gpl-license.php>
	 * @version  	3.0.0
	 * @since   	3.0.0
	 */
	

	/**
	 * Contents
	 *
	 * [1]	Set up setting for [2]
	 * [2]	Register an options page for Advanced Custom Fields
	 * [3]	Add seperator for admin menu
	 */
	

	/**
	 * [1]	Register an options page for Advanced Custom Fields
	 *
	 * 		We use ACF for some global settings, registering an options page 
	 * 		allows us to set these using ACF.
	 *
	 * 		@since 1.0.0
	 * 		@see  https://www.advancedcustomfields.com/resources/acf_add_options_page/ [ACF Docs page]
	 *
	 * 		[a]	
	 */
	
	$options_page_settings = array(
		'page_title'		=> 'Scenic Buses website options',
		'menu_title'		=> 'Scenic Buses',
		'menu_slug'			=> 'scenic-buses',
		'capability'		=> 'edit_posts',
		'position'			=> '47',
		'icon_url'			=> 'dashicons-location',
		'post_id' 			=> 'options',
		'update_button'		=> 'Save settings',
		'updated_message'	=> 'The Scenic Buses website settings have been successfully saved. Good job!',
	);





	/**
	 * [2]	Register an options page for Advanced Custom Fields
	 *
	 * 		We use ACF for some global settings, registering an options page 
	 * 		allows us to set these using ACF.
	 *
	 * 		@since 1.0.0
	 * 		@see  https://www.advancedcustomfields.com/resources/acf_add_options_page/ [ACF Docs page]
	 *
	 * 		[a]	If ACF is available
	 * 		[b]	Register custom options page
	 */
	
	if (function_exists('acf_add_options_page')) :				// [a]
		acf_add_options_page($options_page_settings);			// [b]
	endif;





	/**
	 * [3]	Add seperator for admin menu
	 *
	 * 		@since 1.0.0
	 *
	 * 		[a]	Register action
	 * 		[b]	Register our function#
	 * 		[c]	Get global menu
	 * 		[d]	Set $var for our position ID
	 * 		[e]	The text of the menu item
	 * 		[f]	Permission level required to view the item
	 * 		[g]	The ID of the menu item
	 * 		[h]	Empty by default
	 * 		[i]	Custom class names for the menu item
	 */
	
	add_action('admin_init', 'scenic__add_admin_seperator');		// [a]


	function scenic__add_admin_seperator() {
		global $menu;


		$menu[44] = array(
			0	=>	'',							// [e]
			1	=>	'read',						// [f]
			2	=>	'separator' . $position,	// [g]
			3	=>	'',							// [h]
			4	=>	'wp-menu-separator'			// [i]
		);


		$menu[48] = array(
			0	=>	'',							// [e]
			1	=>	'read',						// [f]
			2	=>	'separator' . $position,	// [g]
			3	=>	'',							// [h]
			4	=>	'wp-menu-separator'			// [i]
		);


		ksort($menu);
	}