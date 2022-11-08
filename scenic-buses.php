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
				/* Red for "Imported" */
				.wp-list-table.pages .status-imported th.check-column { border-left: 5px solid rgb(255, 0, 0);  }
				.wp-list-table.pages .status-imported th,
				.wp-list-table.pages .status-imported td              { background: rgba(255, 0, 0, .15); }


				/* Red for "To research" */
				.wp-list-table.pages .status-to-research th.check-column { border-left: 5px solid rgb(255, 0, 0);  }
				.wp-list-table.pages .status-to-research th,
				.wp-list-table.pages .status-to-research td              { background: rgba(255, 0, 0, .15); }


				/* Red for "Awaiting content" */
				.wp-list-table.pages .status-awaiting-content th.check-column { border-left: 5px solid rgb(216, 213, 49);  }
				.wp-list-table.pages .status-awaiting-content th,
				.wp-list-table.pages .status-awaiting-content td              { background: rgba(216, 213, 49, .15); }


				/* Red for "Pending imagery" */
				.wp-list-table.pages .status-pending-imagery th.check-column { border-left: 5px solid rgb(26, 89, 224);  }
				.wp-list-table.pages .status-pending-imagery th,
				.wp-list-table.pages .status-pending-imagery td              { background: rgba(26, 89, 224, .15); }


				/* Red for "Review pending" */
				.wp-list-table.pages .status-review-pending th.check-column { border-left: 5px solid rgb(13, 186, 163);  }
				.wp-list-table.pages .status-review-pending th,
				.wp-list-table.pages .status-review-pending td              { background: rgba(13, 186, 163, .15); }


				/* Green for published routes */
				.wp-list-table.pages .status-publish th.check-column { border-left: 5px solid #499e00;  }
				.wp-list-table.pages .status-publish th,
				.wp-list-table.pages .status-publish td              { background: rgb(73 158 0 / .15); }
			</style>
		';
	}