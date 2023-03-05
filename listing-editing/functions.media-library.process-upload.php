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
	 * 		[c]	Hook into default WordPress function, calling our files in the response and
	 * 			a default parameter that is required, don't know why though...
	 * 		[d]	If there's an error from [c], kill process and output error
	 * 		[e]	Insert media into WordPress core media library
	 * 		[f]	If upload errors out, kill process and show message
	 * 		[g]	Process media meta data
	 * 		[h]	Redirect to media library
	 * 		[i]	Exit process, for security
	 */
	
	function scenic_process_media_upload() {
		require(dirname(__FILE__) . '/../../../../wp-load.php');				// [a]
		require_once(ABSPATH . 'wp-admin/includes/file.php');					// [a]
		require_once(ABSPATH . 'wp-admin/includes/image.php');					// [a]


		if (empty($_FILES['upload'])) :											// [b]
			wp_die('No files were selected.');									// [b]
		endif;																	// [b]


		foreach ($_FILES['upload']['name'] as $key => $value) :					// []
			if ($_FILES['upload']['name'][$key]) :
				$file_to_upload = array(
					'name'		=> $_FILES['upload']['name'][$key],
					'type'		=> $_FILES['upload']['type'][$key],
					'tmp_name'	=> $_FILES['upload']['tmp_name'][$key],
					'error'		=> $_FILES['upload']['error'][$key],
					'size'		=> $_FILES['upload']['size'][$key]
				);


				$upload = wp_handle_upload(												// [c]
					$file_to_upload,													// [c]
					array('test_form' => false)											// [c]
				);																		// [c]


				if (! empty($upload['error'])) :										// [d]
					wp_die($upload['error']);											// [d]
				endif;																	// [d]


				$attachment_id = wp_insert_attachment(									// [e]
					array(																// [e]
						'guid'           => $upload['url'],								// [e]
						'post_mime_type' => $upload['type'],							// [e]
						'post_title'     => basename($upload['file']),					// [e]
						'post_content'   => '',											// [e]
						'post_status'    => 'inherit',									// [e]
					),																	// [e]
					$upload['file']														// [e]
				);																		// [e]


				if (is_wp_error($attachment_id) || ! $attachment_id) :					// [f]
					wp_die('Upload error. Please try again.');							// [f]
				endif;																	// [f]


				wp_update_attachment_metadata(											// [g]
					$attachment_id,														// [g]
					wp_generate_attachment_metadata($attachment_id, $upload['file'])	// [g]
				);																		// [g]


			endif;								
		endforeach;																// []


		wp_safe_redirect('/your-account/listings/media/my/library/');			// [h]
		exit;																	// [i]
	}