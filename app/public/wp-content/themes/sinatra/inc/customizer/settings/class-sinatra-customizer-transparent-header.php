<?php
/**
 * Sinatra Transparent Header Settings section in Customizer.
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

if ( ! class_exists( 'Sinatra_Customizer_Transparent_Header' ) ) :
	/**
	 * Sinatra Main Transparent section in Customizer.
	 */
	class Sinatra_Customizer_Transparent_Header {

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			/**
			 * Registers our custom options in Customizer.
			 */
			add_filter( 'sinatra_customizer_options', array( $this, 'register_options' ) );
		}

		/**
		 * Registers our custom options in Customizer.
		 *
		 * @since 1.0.0
		 * @param array $options Array of customizer options.
		 */
		public function register_options( $options ) {

			// Transparent Header Section.
			$options['section']['sinatra_section_transparent_header'] = array(
				'title'    => esc_html__( 'Transparent Header', 'sinatra' ),
				'panel'    => 'sinatra_panel_header',
				'priority' => 20,
			);

			// Enable Transparent Header.
			$options['setting']['sinatra_tsp_header'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'    => 'sinatra-toggle',
					'label'   => esc_html__( 'Enable Transparent Header', 'sinatra' ),
					'section' => 'sinatra_section_transparent_header',
				),
			);

			// Enable on.
			$options['setting']['sinatra_tsp_header_devices'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_select',
				'control'           => array(
					'type'     => 'sinatra-select',
					'label'    => esc_html__( 'Device Visibility', 'sinatra' ),
					'section'  => 'sinatra_section_transparent_header',
					'choices'  => array(
						'all'              => esc_html__( 'Enable on All Devices', 'sinatra' ),
						'no-mobile'        => esc_html__( 'Disable on Mobile', 'sinatra' ),
						'no-tablet'        => esc_html__( 'Disable on Tablet', 'sinatra' ),
						'no-mobile-tablet' => esc_html__( 'Disable on Mobile and Tablet', 'sinatra' ),
					),
					'required' => array(
						array(
							'control'  => 'sinatra_tsp_header',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Transparent Header Condition.
			$options['setting']['sinatra_tsp_header_condition'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_select',
				'control'           => array(
					'type'        => 'sinatra-select',
					'label'       => esc_html__( 'Display Conditions', 'sinatra' ),
					'description' => esc_html__( 'Display transparent header globally or let the theme analyse the page layout and decide. You can override this setting per page.', 'sinatra' ),
					'section'     => 'sinatra_section_transparent_header',
					'choices'     => array(
						'auto-decide' => esc_html__( 'Let the theme decide', 'sinatra' ),
						'globally'    => esc_html__( 'Enable globally', 'sinatra' ),
					),
					'required'    => array(
						array(
							'control'  => 'sinatra_tsp_header',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Display on heading.
			$options['setting']['sinatra_tsp_header_display_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'     => 'sinatra-heading',
					'label'    => esc_html__( 'Enable on', 'sinatra' ),
					'section'  => 'sinatra_section_transparent_header',
					'toggle'   => false,
					'required' => array(
						array(
							'control'  => 'sinatra_tsp_header_condition',
							'value'    => 'globally',
							'operator' => '==',
						),
						array(
							'control'  => 'sinatra_tsp_header',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// 404 pages.
			$options['setting']['sinatra_tsp_header_404'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'     => 'sinatra-toggle',
					'label'    => esc_html__( '404 page', 'sinatra' ),
					'section'  => 'sinatra_section_transparent_header',
					'required' => array(
						array(
							'control'  => 'sinatra_tsp_header_condition',
							'value'    => 'globally',
							'operator' => '==',
						),
						array(
							'control'  => 'sinatra_tsp_header',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Archives & Search pages.
			$options['setting']['sinatra_tsp_header_archive'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'     => 'sinatra-toggle',
					'label'    => esc_html__( 'Archive and Search pages', 'sinatra' ),
					'section'  => 'sinatra_section_transparent_header',
					'required' => array(
						array(
							'control'  => 'sinatra_tsp_header_condition',
							'value'    => 'globally',
							'operator' => '==',
						),
						array(
							'control'  => 'sinatra_tsp_header',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Blog page.
			$options['setting']['sinatra_tsp_header_blog'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'     => 'sinatra-toggle',
					'label'    => esc_html__( 'Blog page', 'sinatra' ),
					'section'  => 'sinatra_section_transparent_header',
					'required' => array(
						array(
							'control'  => 'sinatra_tsp_header_condition',
							'value'    => 'globally',
							'operator' => '==',
						),
						array(
							'control'  => 'sinatra_tsp_header',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Posts.
			$options['setting']['sinatra_tsp_header_posts'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'     => 'sinatra-toggle',
					'label'    => esc_html__( 'Posts', 'sinatra' ),
					'section'  => 'sinatra_section_transparent_header',
					'required' => array(
						array(
							'control'  => 'sinatra_tsp_header_condition',
							'value'    => 'globally',
							'operator' => '==',
						),
						array(
							'control'  => 'sinatra_tsp_header',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Pages.
			$options['setting']['sinatra_tsp_header_pages'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'     => 'sinatra-toggle',
					'label'    => esc_html__( 'Pages', 'sinatra' ),
					'section'  => 'sinatra_section_transparent_header',
					'required' => array(
						array(
							'control'  => 'sinatra_tsp_header_condition',
							'value'    => 'globally',
							'operator' => '==',
						),
						array(
							'control'  => 'sinatra_tsp_header',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			return $options;
		}
	}
endif;
new Sinatra_Customizer_Transparent_Header();
