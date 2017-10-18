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
