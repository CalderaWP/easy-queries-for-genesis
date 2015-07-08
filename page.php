<?php
/**
 * Single page template that will pull use a query defined with Caldera Easy Queries if a page with the same slug as an Easy Query exists.
 *
 * @package   cwp_genesis_easy_queries
 * @author    Josh Pollock <Josh@CalderaWP.com>
 * @license   GPL-2.0+
 * @link      
 * @copyright 2015 CalderaWP LLC
 */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'cwp_genesis_easy_queries_do_custom_loop' );
function cwp_genesis_easy_queries_do_custom_loop() {

	//get slug of current page
	$page = get_query_var( 'pagename' );

	//Correct for the fact that Easy Queries have underscores, not dashes
	$slug = str_replace( '-', '_', $page );

	//get class instance
	$class =  \calderawp\caeq\core::get_instance();

	//find arguments for an Easy Query with same slug as page
	$args =  $class->build_query_args( $slug );

	//check if we found a matching Easy Query
	if ( ! $args ) {

		//Nope, so do normal loop.
		genesis_standard_loop();
	}else{

		//Found an Easy Query, use its arguments
		genesis_custom_loop( $args );
	}

}

//Do some Genesis
genesis();
