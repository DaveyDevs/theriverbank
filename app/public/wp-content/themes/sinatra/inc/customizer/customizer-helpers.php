<?php
/**
 * Sinatra Customizer helper functions.
 *
 * @package     Sinatra
 * @author      Sinatra Team <hello@sinatrawp.com>
 * @since       1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns array of available widgets.
 *
 * @since 1.0.0
 * @return array, $widgets array of available widgets.
 */
function sinatra_get_customizer_widgets() {

	$widgets = array(
		'text'    => 'Sinatra_Customizer_Widget_Text',
		'nav'     => 'Sinatra_Customizer_Widget_Nav',
		'socials' => 'Sinatra_Customizer_Widget_Socials',
		'search'  => 'Sinatra_Customizer_Widget_Search',
		'button'  => 'Sinatra_Customizer_Widget_Button',
	);

	return apply_filters( 'sinatra_customizer_widgets', $widgets );
}
