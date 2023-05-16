<?php

	/**
	 * Create custom URL endpoints for the listing editing section of a user's account.
	 *
	 * This allows us to use the following URL format to enable the editing:
	 * https://scenicbuses.uk/your-account/listings/route/012345/tickets/
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
	 * [1]	Create rewrite rules for listings URL endpoint
	 * [2]	Add query vars
	 * [3]	Hook our functions
	 */
	

	/**
	 * [1]	Create rewrite rules for listings URL endpoint
	 */
	
	function scenic_rewrites_operators($rules) {
		$rules['operator/([^/]+)/([^/]+)/?$'] = 'index.php?pagename=operators&scenic-operators-view=$matches[1]&scenic-operator-id=$matches[2]';
		return $rules;
	}





	/**
	 * [2]	Add query vars
	 */
	
	function scenic_query_vars_operators($vars) {
		array_push($vars, 'scenic-operators-view');
		array_push($vars, 'scenic-operator-id');


		return $vars;
	}





	/**
	 * [3]	Hook our functions
	 *
	 * [a]	Rewrite rules
	 * [b]	Query vars for [a]
	 */
	
	add_filter('rewrite_rules_array', 'scenic_rewrites_operators'); 	// [a]
	add_filter('query_vars',          'scenic_query_vars_operators'); 	// [b]