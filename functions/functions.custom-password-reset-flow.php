<?php

	/**
	 * Functions to handle our custom password reset forms and process
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
	 * [1]	Hijack default lost password process
	 */
	

	/**
	 * [1]	Hijack default lost password process
	 *
	 * 		@since 10.0.0
	 *
	 * 		[a]
	 */

	function scenic_override_default_lost_password_action() {
		if ('GET' == $_SERVER['REQUEST_METHOD']) :
			if (is_user_logged_in()) :
				$this->redirect_logged_in_user();
			else :
				wp_safe_redirect('/your-account/?action=reset-password');
			endif;


			exit;
		endif;
	}


	function scenic_override_lost_password_redirects() {
		if ('GET' == $_SERVER['REQUEST_METHOD']) :
			$user = check_password_reset_key($_REQUEST['key'], $_REQUEST['login']);


			if (! $user || is_wp_error($user)) :
				if ($user && $user->get_error_code() === 'expired_key') :
					wp_safe_redirect('/your-account/?action=reset-password&error=expired-key');
				else :
					wp_safe_redirect('/your-account/?action=reset-password&error=invalid-key');
				endif;

				exit;
			endif;


			$redirect_url = '/your-account?action=reset-password&email-link=true';
			$redirect_url = add_query_arg('login', esc_attr($_REQUEST['login']), $redirect_url);
			$redirect_url = add_query_arg('key',   esc_attr($_REQUEST['key']),   $redirect_url);


			wp_safe_redirect($redirect_url);
			exit;
		endif;
	}


	add_action('login_form_lostpassword', 'scenic_override_default_lost_password_action');
	add_action('login_form_rp',           'scenic_override_lost_password_redirects');
	add_action('login_form_resetpass',    'scenic_override_lost_password_redirects');
	










	/**
	 * [2]	Handle the custom reset
	 */
	
	function scenic_do_password_reset() {
		if ('POST' == $_SERVER['REQUEST_METHOD']) :
			$rp_key = $_REQUEST['rp_key'];
			$rp_login = $_REQUEST['rp_login'];


			$user = check_password_reset_key($rp_key, $rp_login);


			if (!$user || is_wp_error($user)) :
				if ($user && $user->get_error_code() === 'expired_key') :
					wp_safe_redirect('/your-account/?action=reset-password&error=expired-key');
				else :
					wp_safe_redirect('/your-account/?action=reset-password&error=invalid-key');
				endif;
				exit;
			endif;


			if (isset($_POST['pass1'])) :
				if ($_POST['pass1'] != $_POST['pass2']) : // Passwords don't match
					$redirect_url = '/your-account/?action=reset-password';

					$redirect_url = add_query_arg('key',   $rp_key,             $redirect_url);
					$redirect_url = add_query_arg('login', $rp_login,           $redirect_url);
					$redirect_url = add_query_arg('error', 'password-mismatch', $redirect_url);

					wp_safe_redirect($redirect_url);
					exit;
				endif;


				if (empty($_POST['pass1'])) : // Password is empty
					$redirect_url = '/your-account/?action=reset-password';

					$redirect_url = add_query_arg('key',   $rp_key,               $redirect_url);
					$redirect_url = add_query_arg('login', $rp_login,             $redirect_url);
					$redirect_url = add_query_arg('error', 'no-password-entered', $redirect_url);

					wp_safe_redirect($redirect_url);
					exit;
				endif;


				// Parameter checks OK, reset password
				reset_password($user, $_POST['pass1']);
				wp_safe_redirect('/your-account/?password=reset-by-user');


			else :
				wp_safe_redirect('/your-account/?action=reset-password&error=unknown');
			endif;

			exit;
		endif;
	}


	add_action('login_form_rp',        'scenic_do_password_reset');
	add_action('login_form_resetpass', 'scenic_do_password_reset');











	/**
	 * [3]	
	 */
	
	function scenic_do_password_lost_redirects() {
		if ('POST' == $_SERVER['REQUEST_METHOD']) :
			$errors = retrieve_password();
			if (is_wp_error($errors)) :
				$redirect_url = '/your-account/?action=reset-password';
				$redirect_url = add_query_arg('errors', join(',', $errors->get_error_codes()), $redirect_url);


			else :
				$redirect_url = '/your-account/?action=reset-password';
				$redirect_url = add_query_arg('check-email', 'confirm', $redirect_url);
			endif;


			wp_redirect($redirect_url);
			exit;
		endif;
	}


	add_action('login_form_lostpassword', 'scenic_do_password_lost_redirects');