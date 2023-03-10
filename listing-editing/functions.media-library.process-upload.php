<?php

	/**
	 * Process media upload from custom form.
	 *
	 * Activated by referencing function name elsewhere in the code.
	 *
	 * @package  	scenic
	 * @author  	Andi North <andi@mangopear.co.uk>
	 * @copyright  	2023 Mangopear creative
	 * @license   	GNU General Public License <http://opensource.org/licenses/gpl-license.php>
	 * @version  	10.0.0
	 * @since   	10.0.0
	 */
	

	/**
	 * Contents
	 *
	 * [1]	Process our media
	 */
	

	/**
	 * [1]	Process our media
	 *
	 * 		[a]	Include required WordPress core files
	 * 		[b]	If no files were included in form, kill the process and show an error
	 * 		[c]	Loop through each uploaded image
	 * 		[d]	Set up file data based on complex $_FILES array data structure
	 * 		[e]	Hook into default WordPress function, calling our files in the response and
	 * 			a default parameter that is required, don't know why though...
	 * 		[f]	If there's an error from [c], kill process and output error
	 * 		[g]	Insert media into WordPress core media library
	 * 		[h]	If upload errors out, kill process and show message
	 * 		[i]	Process media meta data
	 * 		[j]	Redirect to media library
	 * 		[k]	Exit process, for security
	 */
	
	function scenic_process_media_upload() {
		require(dirname(__FILE__) . '/../../../../wp-load.php');						// [a]
		require_once(ABSPATH . 'wp-admin/includes/file.php');							// [a]
		require_once(ABSPATH . 'wp-admin/includes/image.php');							// [a]


		if (empty($_FILES['upload'])) :													// [b]
			wp_die('No files were selected.');											// [b]
		endif;																			// [b]


		foreach ($_FILES['upload']['name'] as $key => $value) :							// [c]
			if ($_FILES['upload']['name'][$key]) :										// [c]
				$file_to_upload = array(												// [d]
					'name'		=> $_FILES['upload']['name'][$key],						// [d]
					'type'		=> $_FILES['upload']['type'][$key],						// [d]
					'tmp_name'	=> $_FILES['upload']['tmp_name'][$key],					// [d]
					'error'		=> $_FILES['upload']['error'][$key],					// [d]
					'size'		=> $_FILES['upload']['size'][$key]						// [d]
				);																		// [d]


				$upload = wp_handle_upload(												// [e]
					$file_to_upload,													// [e]
					array('test_form' => false)											// [e]
				);																		// [e]


				if (! empty($upload['error'])) :										// [f]
					wp_die($upload['error']);											// [f]
				endif;																	// [f]


				$attachment_id = wp_insert_attachment(									// [g]
					array(																// [g]
						'guid'           => $upload['url'],								// [g]
						'post_mime_type' => $upload['type'],							// [g]
						'post_title'     => basename($upload['file']),					// [g]
						'post_content'   => '',											// [g]
						'post_status'    => 'inherit',									// [g]
					),																	// [g]
					$upload['file']														// [g]
				);																		// [g]


				if (is_wp_error($attachment_id) || ! $attachment_id) :					// [h]
					wp_die('Upload error. Please try again.');							// [h]
				endif;																	// [h]


				wp_update_attachment_metadata(											// [i]
					$attachment_id,														// [i]
					wp_generate_attachment_metadata($attachment_id, $upload['file'])	// [i]
				);																		// [i]


			endif;																		// [c]
		endforeach;																		// [c]


		wp_safe_redirect('/your-account/listings/media/my/library/');					// [j]
		exit;																			// [k]
	}