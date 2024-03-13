<?php

	/**
	 * Functionality to enable listing editing
	 *
	 * @package  	scenic
	 * @author  	Andi North <andi@mangopear.co.uk>
	 * @copyright  	2023 Mangopear creative
	 * @license   	GNU General Public License <http://opensource.org/licenses/gpl-license.php>
	 * @version  	1.0.0
	 * @since   	1.0.0
	 */
	

	/**
	 * Contents
	 *
	 * [1]	Global variables
	 * [2]	Include other files
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
	 * [2]	Include other files
	 *
	 * 		[a]	Custom URL endpoints for editing views
	 * 		[b]	Process uploaded media
	 * 		[c]	Handle form submit for all listing editing forms
	 */

	require_once $plugin_path . 'functions.custom-url-endpoints.php'; 			// [a]
	require_once $plugin_path . 'functions.media-library.process-upload.php'; 	// [b]
	require_once $plugin_path . 'class.listing-editing.forms.php'; 				// [c]
	require_once $plugin_path . 'functions.stock-image-apis.php'; 				// [d]