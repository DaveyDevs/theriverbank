<?php
/**
 * Social Snap compatibility class.
 *
 * @package Sinatra
 * @author  Sinatra Team <hello@sinatrawp.com>
 * @since   1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Sinatra_SocialSnap' ) ) :
	/**
	 * Social Snap compatibility class.
	 */
	class Sinatra_SocialSnap {

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			add_action( 'activate_socialsnap/socialsnap.php', array( $this, 'disable_redirect_on_activation' ), 20 );

			// If Social Snap is not activated then return.
			if ( ! class_exists( 'SocialSnap' ) ) {
				return;
			}

			add_action( 'sinatra_after_entry_meta_elements', array( $this, 'entry_meta_share_count' ) );
		}

		/**
		 * Add share count information to entry meta.
		 *
		 * @since 1.0.0
		 */
		public function entry_meta_share_count() {

			$share_count = socialsnap_get_total_share_count();

			// Icon.
			$icon = sinatra_option( 'entry_meta_icons' ) ? '<i class="si-icon si-share-2" aria-hidden="true"></i>' : '';
			$icon = apply_filters( 'sinatra_share_meta_icon', $icon );

			$output = sprintf(
				'<span class="share-count">%3$s%1$s %2$s</span>',
				socialsnap_format_number( $share_count ),
				esc_html( _n( 'Share', 'Shares', $share_count, 'sinatra' ) ),
				wp_kses_post( $icon )
			);

			echo wp_kses_post( apply_filters( 'sinatra_entry_share_count', $output ) );
		}

		/**
		 * Disable admin page redirect on plugin activation.
		 *
		 * @since 1.0.0
		 */
		public static function disable_redirect_on_activation() {
			delete_site_transient( 'socialsnap_activation_redirect' );
		}
	}
endif;
new Sinatra_SocialSnap();
