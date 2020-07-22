<?php

	/**
	 * Plugin name: Scenic Buses
	 * Plugin URI:	https://mangopear.co.uk/
	 * Description:	Bespoke plugin for the Scenic Buses website - this includes post types and functions for searches and directory listings etc.
	 * Version:		3.0.0
	 * Author:		Andi North
	 * Author URI:	https://mangopear.co.uk
	 * License:		GNU General Public License
	 */
	

	/**
	 * Core mangopear website plugin
	 *
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
	 * [1]	Global variables
	 * [2]	Post type registration
	 */
	

	/**
	 * [1]	Global variables
	 *
	 * 		These global variables are used throughout this document, typically to avoid repitition.
	 *
	 * 		[a]	$var to get the plugin directory URL
	 */
	
	$plugin_path = plugin_dir_path(__FILE__); // [a]





	/**
	 * [2]	Post type registration
	 *
	 * 		Group of includes for our various custom post types
	 *
	 * 		[a]	Bus & train routes
	 */

	require_once $plugin_path . 'post-types/mangopear.post-type.routes.php'; 	// [a]





	/**
	 * [3]	Register an options page for ACF
	 *
	 * 		@since 1.0.0
	 *
	 * 		[a]	Add our include
	 */

	require_once $plugin_path . 'settings/settings.options-page.php'; 		// [a]





	/**
	 * [4]	Add custom CSS to admin for routes list
	 *
	 * 		@since 1.1.0
	 *
	 * 		[a]	
	 */
	
	add_action('admin_head', 'scenic_custom_admin_css');

	function scenic_custom_admin_css() {
		echo '
			<style>
				/* Green for published routes */
				.wp-list-table.pages .status-publish th.check-column { border-left: 5px solid #499e00;  }
				.wp-list-table.pages .status-publish th,
				.wp-list-table.pages .status-publish td              { background: rgb(73 158 0 / .15); }


				/* Red for "Initial add for prep" */
				.wp-list-table.pages .status-initial-add-for-prep th.check-column { border-left: 5px solid #F27500;  }
				.wp-list-table.pages .status-initial-add-for-prep th,
				.wp-list-table.pages .status-initial-add-for-prep td              { background: rgb(242 117 0 / .15); }
			</style>
		';
	}