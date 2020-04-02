<?php
/**
 * Sinatra Blog » Blog Page / Archive section in Customizer.
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

if ( ! class_exists( 'Sinatra_Customizer_Blog_Page' ) ) :
	/**
	 * Sinatra Blog » Blog Page / Archive section in Customizer.
	 */
	class Sinatra_Customizer_Blog_Page {

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

			// Section.
			$options['section']['sinatra_section_blog_page'] = array(
				'title' => esc_html__( 'Blog Page / Archive', 'sinatra' ),
				'panel' => 'sinatra_panel_blog',
			);

			// Post Elements.
			$options['setting']['sinatra_blog_entry_elements'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_sortable',
				'control'           => array(
					'type'        => 'sinatra-sortable',
					'section'     => 'sinatra_section_blog_page',
					'label'       => esc_html__( 'Post Elements', 'sinatra' ),
					'description' => esc_html__( 'Set order and visibility for post elements.', 'sinatra' ),
					'choices'     => array(
						'summary'        => esc_html__( 'Summary', 'sinatra' ),
						'header'         => esc_html__( 'Title', 'sinatra' ),
						'meta'           => esc_html__( 'Post Meta', 'sinatra' ),
						'thumbnail'      => esc_html__( 'Featured Image', 'sinatra' ),
						'summary-footer' => esc_html__( 'Read More', 'sinatra' ),
					),
				),
			);

			// Meta/Post Details Layout.
			$options['setting']['sinatra_blog_entry_meta_elements'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_sortable',
				'control'           => array(
					'type'        => 'sinatra-sortable',
					'section'     => 'sinatra_section_blog_page',
					'label'       => esc_html__( 'Post Meta', 'sinatra' ),
					'description' => esc_html__( 'Set order and visibility for post meta details.', 'sinatra' ),
					'choices'     => array(
						'author'   => esc_html__( 'Author', 'sinatra' ),
						'date'     => esc_html__( 'Publish Date', 'sinatra' ),
						'comments' => esc_html__( 'Comments', 'sinatra' ),
						'category' => esc_html__( 'Categories', 'sinatra' ),
						'tag'      => esc_html__( 'Tags', 'sinatra' ),
					),
				),
			);

			// Meta Author image.
			$options['setting']['sinatra_entry_meta_icons'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'    => 'sinatra-toggle',
					'section' => 'sinatra_section_blog_page',
					'label'   => esc_html__( 'Show avatar and icons in post meta', 'sinatra' ),
				),
			);

			// Excerpt Length.
			$options['setting']['sinatra_excerpt_length'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_range',
				'control'           => array(
					'type'        => 'sinatra-range',
					'section'     => 'sinatra_section_blog_page',
					'label'       => esc_html__( 'Excerpt Length', 'sinatra' ),
					'description' => esc_html__( 'Number of words displayed in the excerpt.', 'sinatra' ),
					'min'         => 0,
					'max'         => 100,
					'step'        => 1,
					'unit'        => '',
					'responsive'  => false,
				),
			);

			// Excerpt more.
			$options['setting']['sinatra_excerpt_more'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_text_field',
				'control'           => array(
					'type'        => 'sinatra-text',
					'section'     => 'sinatra_section_blog_page',
					'label'       => esc_html__( 'Excerpt More', 'sinatra' ),
					'description' => esc_html__( 'What to append to excerpt if the text is cut.', 'sinatra' ),
				),
			);

			return $options;
		}
	}
endif;

new Sinatra_Customizer_Blog_Page();
