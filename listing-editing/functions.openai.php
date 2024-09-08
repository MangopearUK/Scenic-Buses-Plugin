<?php

/**
 * [OpenAI] Use OpenAI to generate content on the fly
 * 
 * @package     scenic-buses
 * @category    functions
 * @since       11.0.0
 * @version     11.0.0
 * @author  	Andi North <andi@theverycreativefruitbowl.co.uk>
 * @copyright  	2024 The Very Creative Fruit Bowl Company
 * @license   	Proprietary license - You can not use this code without permission
 */


/**
 * Contents
 *
 * [1]	
 */


/**
 * [1]	
 *
 * 		@since 11.0.0
 *
 * 		[i]	
 */

function scenic_load_openai_client() {
	require(plugin_dir_path(__FILE__) . '../helpers/openai/OpenAi.php');	// [i]
	require(plugin_dir_path(__FILE__) . '../helpers/openai/Url.php');		// [i]

	return SCENIC_OPENAI_API_KEY;
}





/**
 * [2]	
 */

function scenic_handle_ajax_scenic_openai_location_subtitle() {
	if (! wp_verify_nonce($_REQUEST['nonce'], 'scenic-global-nonce')) {												// [i]
		wp_send_json_error('Security key could not be validated. Refresh the page and try again.', 500);			// [i]
		exit;																										// [i]
	}																												// [i]


	if (! isset($_REQUEST)) :																						// [ii]
		wp_send_json_error('There was no data sent with your request. Please try again.', 500);						// [ii]
		exit;																										// [ii]
	else :																											// [ii]
		$openai_key = scenic_load_openai_client();																	// []
		$open_ai = new Orhanerday\OpenAi\OpenAi($openai_key);														// []


		$location_id = intval($_REQUEST['locationID']);
		$location_object = get_term_by('term_id', $location_id, 'route__locations');
		$location_name = (get_field('expressive-title', 'route__locations_' . $location_object->term_id)) ?: $location_object->name;


		$json_response = $open_ai->chat([
			'model' 			=> 'gpt-4o-mini',
			'messages' 			=> array(
				array(
					'role'	  => 'user',
					'content' => "Write a 15 to 22 word long headline for $location_name, based on tourism by bus, all in British English and sentence case.",
				),
			),
			'n'					=> 3,
			'temperature' 		=> 0.9,
			'max_tokens' 		=> 150,
			'frequency_penalty' => 0,
			'presence_penalty' 	=> 0.6,
		]);


		$response = json_decode($json_response);


		wp_send_json_success(																						// []
			array(																									// []
				'result'	=> $response,																			// []
			),																										// []
			200																										// []
		);																											// []
	endif;																											// [ii]
}


add_action('wp_ajax_scenic_openai_location_subtitle', 'scenic_handle_ajax_scenic_openai_location_subtitle');





/**
 * [3]	
 */

function scenic_handle_ajax_scenic_openai_location_content() {
	if (! wp_verify_nonce($_REQUEST['nonce'], 'scenic-global-nonce')) {												// [i]
		wp_send_json_error('Security key could not be validated. Refresh the page and try again.', 500);			// [i]
		exit;																										// [i]
	}																												// [i]


	if (! isset($_REQUEST)) :																						// [ii]
		wp_send_json_error('There was no data sent with your request. Please try again.', 500);						// [ii]
		exit;																										// [ii]
	else :																											// [ii]
		$openai_key = scenic_load_openai_client();																	// []
		$open_ai = new Orhanerday\OpenAi\OpenAi($openai_key);														// []


		$location_id = intval($_REQUEST['locationID']);
		$location_object = get_term_by('term_id', $location_id, 'route__locations');
		$location_name = (get_field('expressive-title', 'route__locations_' . $location_object->term_id)) ?: $location_object->name;


		$length = intval($_REQUEST['contentLength']);


		$json_response = $open_ai->chat([
			'model' 			=> 'gpt-4o-mini',
			'messages' 			=> array(
				array(
					'role'	  => 'user',
					'content' => "Write a $length word long description for $location_name, based on tourism by bus, all in British English, sentence case and short paragraphs, formatted as simple HTML <p>.",
				),
			),
			'n'					=> 3,
			'temperature' 		=> 0.9,
			'max_tokens' 		=> 275,
			'frequency_penalty' => 0,
			'presence_penalty' 	=> 0.6,
		]);


		$response = json_decode($json_response);


		wp_send_json_success(																						// []
			array(																									// []
				'result'	=> $response,																			// []
				'length'	=> $length,
			),																										// []
			200																										// []
		);																											// []
	endif;																											// [ii]
}


add_action('wp_ajax_scenic_openai_location_content', 'scenic_handle_ajax_scenic_openai_location_content');