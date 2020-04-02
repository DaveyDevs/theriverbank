<?php
/**
 * Sinatra Blog - Single Post section in Customizer.
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

if ( ! class_exists( 'Sinatra_Customizer_Single_Post' ) ) :
	/**
	 * Sinatra Blog - Single Post section in Customizer.
	 */
	class Sinatra_Customizer_Single_Post {

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
			$options['section']['sinatra_section_blog_single_post'] = array(
				'title'    => esc_html__( 'Single Post', 'sinatra' ),
				'panel'    => 'sinatra_panel_blog',
				'priority' => 20,
			);

			// Single post layout.
			$options['setting']['sinatra_single_post_layout_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'    => 'sinatra-heading',
					'label'   => esc_html__( 'Layout', 'sinatra' ),
					'section' => 'sinatra_section_blog_single_post',
				),
			);

			// Content Layout.
			$options['setting']['sinatra_single_post_layout'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_select',
				'control'           => array(
					'type'        => 'sinatra-select',
					'label'       => esc_html__( 'Content Layout', 'sinatra' ),
					'description' => esc_html__( 'Select content layout for single post pages.', 'sinatra' ),
					'section'     => 'sinatra_section_blog_single_post',
					'choices'     => array(
						'layout-1' => esc_html__( 'Layout 1', 'sinatra' ),
						'layout-2' => esc_html__( 'Layout 2', 'sinatra' ),
					),
					'required'    => array(
						array(
							'control'  => 'sinatra_single_post_layout_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Content width.
			$options['setting']['sinatra_single_content_width'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_select',
				'control'           => array(
					'type'        => 'sinatra-select',
					'label'       => esc_html__( 'Content Width', 'sinatra' ),
					'description' => esc_html__( 'Narrow content width or match your site&rsquo;s Content Width (defined in General Settings &raquo; Layout).', 'sinatra' ),
					'section'     => 'sinatra_section_blog_single_post',
					'choices'     => array(
						'wide'   => esc_html__( 'Content Width', 'sinatra' ),
						'narrow' => esc_html__( 'Narrow Width', 'sinatra' ),
					),
					'required'    => array(
						array(
							'control'  => 'sinatra_single_post_layout_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Narrow container width.
			$options['setting']['sinatra_single_narrow_container_width'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sinatra_sanitize_range',
				'control'           => array(
					'type'        => 'sinatra-range',
					'label'       => esc_html__( 'Narrow Container Width', 'sinatra' ),
					'description' => esc_html__( 'Choose the width (in px) for narrow container on single posts.', 'sinatra' ),
					'section'     => 'sinatra_section_blog_single_post',
					'min'         => 500,
					'max'         => 1500,
					'step'        => 10,
					'required'    => array(
						array(
							'control'  => 'sinatra_single_content_width',
							'value'    => 'narrow',
							'operator' => '==',
						),
						array(
							'control'  => 'sinatra_single_post_layout_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Single post elements.
			$options['setting']['sinatra_single_post_elements_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'    => 'sinatra-heading',
					'label'   => esc_html__( 'Post Elements', 'sinatra' ),
					'section' => 'sinatra_section_blog_single_post',
				),
			);

			// Meta/Post Details Layout.
			$options['setting']['sinatra_single_post_meta_elements'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_sortable',
				'control'           => array(
					'type'        => 'sinatra-sortable',
					'label'       => esc_html__( 'Post Meta', 'sinatra' ),
					'description' => esc_html__( 'Set order and visibility for post meta details.', 'sinatra' ),
					'section'     => 'sinatra_section_blog_single_post',
					'choices'     => array(
						'author'   => esc_html__( 'Author', 'sinatra' ),
						'date'     => esc_html__( 'Publish Date', 'sinatra' ),
						'comments' => esc_html__( 'Comments', 'sinatra' ),
						'category' => esc_html__( 'Categories', 'sinatra' ),
					),
					'required'    => array(
						array(
							'control'  => 'sinatra_single_post_elements_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Post Featured image.
			$options['setting']['sinatra_single_post_thumb'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'     => 'sinatra-toggle',
					'label'    => esc_html__( 'Show Featured Image', 'sinatra' ),
					'section'  => 'sinatra_section_blog_single_post',
					'required' => array(
						array(
							'control'  => 'sinatra_single_post_elements_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Post Categories.
			$options['setting']['sinatra_single_post_categories'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'     => 'sinatra-toggle',
					'label'    => esc_html__( 'Show Post Categories', 'sinatra' ),
					'section'  => 'sinatra_section_blog_single_post',
					'required' => array(
						array(
							'control'  => 'sinatra_single_post_elements_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Post Tags.
			$options['setting']['sinatra_single_post_tags'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'     => 'sinatra-toggle',
					'label'    => esc_html__( 'Show Post Tags', 'sinatra' ),
					'section'  => 'sinatra_section_blog_single_post',
					'required' => array(
						array(
							'control'  => 'sinatra_single_post_elements_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Last Updated.
			$options['setting']['sinatra_single_last_updated'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'     => 'sinatra-toggle',
					'label'    => esc_html__( 'Show Last Updated Date', 'sinatra' ),
					'section'  => 'sinatra_section_blog_single_post',
					'required' => array(
						array(
							'control'  => 'sinatra_single_post_elements_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// About Author box.
			$options['setting']['sinatra_single_about_author'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'     => 'sinatra-toggle',
					'label'    => esc_html__( 'Show About Author box', 'sinatra' ),
					'section'  => 'sinatra_section_blog_single_post',
					'required' => array(
						array(
							'control'  => 'sinatra_single_post_elements_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Next/Prev posts.
			$options['setting']['sinatra_single_post_next_prev'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'     => 'sinatra-toggle',
					'label'    => esc_html__( 'Show Next/Prev Post Links', 'sinatra' ),
					'section'  => 'sinatra_section_blog_single_post',
					'required' => array(
						array(
							'control'  => 'sinatra_single_post_elements_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Toggle Comments.
			$options['setting']['sinatra_single_toggle_comments'] = array(
				'transport'         => 'refresh',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'     => 'sinatra-toggle',
					'label'    => esc_html__( 'Show Toggle Comments', 'sinatra' ),
					'section'  => 'sinatra_section_blog_single_post',
					'required' => array(
						array(
							'control'  => 'sinatra_single_post_elements_heading',
							'value'    => true,
							'operator' => '==',
						),
					),
				),
			);

			// Single Post typography heading.
			$options['setting']['sinatra_typography_single_post_heading'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sinatra_sanitize_toggle',
				'control'           => array(
					'type'    => 'sinatra-heading',
					'label'   => esc_html__( 'Typography', 'sinatra' ),
					'section' => 'sinatra_section_blog_single_post',
				),
			);

			// Single post content font size.
			$options['setting']['sinatra_single_content_font_size'] = array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sinatra_sanitize_responsive',
				'control'           => array(
					'type'        => 'sinatra-range',
					'label'       => esc_html__( 'Post Content Font Size', 'sinatra' ),
					'description' => esc_html__( 'Choose your single post content font size.', 'sinatra' ),
					'section'     => 'sinatra_section_blog_single_post',
					'responsive'  => true,
					'unit'        => array(
						array(
							'id'   => 'px',
							'name' => 'px',
							'min'  => 8,
							'max'  => 30,
							'step' => 1,
						),
						array(
							'id'   => 'em',
							'name' => 'em',
							'min'  => 0.5,
							'max'  => 1.875,
							'step' => 0.01,
						),
						array(
							'id'   => 'rem',
							'name' => 'rem',
							'min'  => 0.5,
							'max'  => 1.875,
							'step' => 0.01,
						),
					),
					'required'    => array(
						array(
							'control'  => 'sinatra_typography_single_post_heading',
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
new Sinatra_Customizer_Single_Post();
