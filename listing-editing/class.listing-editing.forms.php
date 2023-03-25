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
			 * [c]	Output form field
			 */
			
			public function output_form_field($args = array()) {
				$field__name = ($args['name'] != '') ? $args['name'] : $args['id'];
				$field__id   = $args['id'];
				$label       = $args['label'];
				$message     = $args['help-message'];
				$value       = $args['default-value'];
				$type        = ($args['type']) ? $args['type'] : 'text';


				$html = '<div class="c-edit-form__field  c-edit-form__field--text" data-field="' . $field__id . '">';
					$html .= '<label class="c-edit-form__label" for="' . $field__id . '">' . $label . '</label>';


					if ($type == 'text') :
						$html .= '<input class="c-edit-form__input" type="text" id="' . $field__id . '" name="' . $field__name . '" value="' . $value . '">';

					elseif ($type == 'select2') :

					endif;


					if ($message != "") {
						$html .= '<div class="c-edit-form__helper">' . $message . '</div>';
					}


					$html .= '<p class="c-edit-form__inline-error  js-edit-form__inline-error"></p>';
				$html .= '</div>';


				return $html;
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