<?php

	/**
	 * Process the form submissions for all listing editing 
	 * forms, including over AJAX
	 *
	 * @package  	scenic
	 * @author  	Andi North <andi@mangopear.co.uk>
	 * @copyright  	2023 Mangopear creative
	 * @license   	GNU General Public License <http://opensource.org/licenses/gpl-license.php>
	 * @version  	10.0.0
	 * @since   	10.0.0
	 *
	 *
	 * CONTENTS ---
	 *
	 * [1]	Forbid loading of this file directly
	 * [2]	Define our class
	 */
	

	/**
	 * [1]	Forbid loading of this file directly
	 */
	
	if (! defined('ABSPATH')) { exit; }





	/**
	 * [2]	Define our class
	 *
	 * 		@since 10.0.0
	 *
	 * 		[a]	Dummy constructor
	 * 		[b]	Initialise: Hook & action our operations
	 */
	
	if (! class_exists('Scenic_ListingEditing')) :
		class Scenic_ListingEditing {

			/**
			 * [a]	Dummy constructor
			 */
			
			public function __construct() {
				// Do nothing!
			}





			/**
			 * [b]	Initialise: Hook & action our operations
			 */
			
			public function initialize() {
				add_action('admin_post_scenic_listings_media_meta', array($this, 'edit_media_meta'));
			}





			/**
			 * [c]	Form handler: Media > Edit item meta data
			 */
			
			public function edit_media_meta() {
				$media_item_id = $_POST['item-id'];


				$post_alt           = $_POST['alt-tag'];
				$post_caption       = $_POST['caption'];
				$post_location      = $_POST['location'];
				$post_copyright     = $_POST['copyright'];
				$post_copyright_url = $_POST['copyright-url'];


				update_post_meta($media_item_id, '_wp_attachment_image_alt', $post_alt);
				wp_update_post(array('ID' => $media_item_id, 'post_excerpt' => $post_caption));

				update_field('locations',      $post_location,      $media_item_id);
				update_field('copyright',      $post_copyright,     $media_item_id);
				update_field('copyright__url', $post_copyright_url, $media_item_id);


				wp_safe_redirect('/your-account/listings/media/' . $media_item_id . '/meta/?return=updated');
			}

		} 	// [2]





		/**
		 * [3]	
		 */
		
		function Scenic_ListingEditing() {
			global $Scenic_ListingEditing;


			if (! isset($Scenic_ListingEditing)) :
				$Scenic_ListingEditing = new Scenic_ListingEditing();
				$Scenic_ListingEditing->initialize();
			endif;


			return $Scenic_ListingEditing;
		}


		Scenic_ListingEditing();
		
	endif;	// [2]