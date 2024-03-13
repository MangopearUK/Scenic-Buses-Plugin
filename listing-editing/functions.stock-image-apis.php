<?php

/**
 * [Stock image libraries] Fwtch stock images via API
 * 
 * @package     scenic-buses
 * @category    functions
 * @since       1.6.0
 * @version     1.6.0
 * @author  	Andi North <andi@theverycreativefruitbowl.co.uk>
 * @copyright  	2024 The Very Creative Fruit Bowl Company
 * @license   	Proprietary license - You can not use this code without permission
 */


/**
 * Contents
 *
 * [1]	Load the oAuth2 client for connecting to the API
 * [2]	Fetch access token for SugarCRM API
 * [1]	Perform API request to SugarCRM
 */


/**
 * [1]	Load the oAuth2 client for connecting to the API
 *
 * 		@since 1.2.0
 *
 * 		[i]	Fetch our oAuth2 client files
 */

function scenic_load_api_client() {
	require(plugin_dir_path(__FILE__) . '../helpers/oauth2/Client.php');					// [i]
	require(plugin_dir_path(__FILE__) . '../helpers/oauth2/GrantType/IGrantType.php');		// [i]
	require(plugin_dir_path(__FILE__) . '../helpers/oauth2/GrantType/Password.php');		// [i]
}





/**
 * [2]	Fetch access token for SugarCRM API
 *
 * 		@since 1.2.0
 *
 * 		[i]		Loaded by other functions in our plugin
 * 		[ii]	Setup oAuth2 client
 * 		[iii]	Create access token
 * 		[iv]	Set endpoint
 * 		[v]		Use "password" type of connection
 * 		[vi]	Set authentication credentials
 * 		[vii]	Return access token as value
 */

function scenic_fetch_access_token($client) {									// [i]
	$response = $client->getAccessToken(										// [iii]
		'https://sspc.sugarondemand.com/rest/v11_6/oauth2/token/', 				// [iv]
		'password', 															// [v]
		array(																	// [vi]
			'username' => 'auto',												// [vi]
			'password' => 'Stateside1',											// [vi]
			'platform' => 'StatesideAPM_WordPressPlugin',						// [vi]
		)																		// [vi]
	);																			// [iii]


	return $response['result']['access_token'];									// [vii]
}																				// [i]





/**
 * [1]	Perform API request to SugarCRM
 *
 * 		@since 1.2.0
 *
 * 		[i]		Loaded by other functions in our plugin
 */

function scenic_connect_to_api($client, $access_token, $endpoint, $args) {				// [i]
	$response = $client->fetch(															// []
		'https://sspc.sugarondemand.com/rest/v11_6/' . $endpoint,						// []
		$args,																			// []
		'GET',																			// []
		array(																			// []
			'Authorization' => 'Bearer ' . $access_token,								// []
			'User-Agent'    => 'StatesideAPM_WordPressPlugin',							// []
		),																				// []
	);																					// []


	return $response;																	// []
}																						// [i]





/**
 * [4]	Fetch from Adobe Stock
 */

function scenic_stock_image_fetch_from_adobe() {
	
}