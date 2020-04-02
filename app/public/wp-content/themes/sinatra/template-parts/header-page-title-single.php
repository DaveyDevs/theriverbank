<?php
/**
 * Template part for displaying page header for single post.
 *
 * @package Sinatra
 * @author  Sinatra Team <hello@sinatrawp.com>
 * @since   1.0.0
 */

?>

<header <?php sinatra_page_header_classes(); ?>>

	<?php if ( sinatra_page_header_has_title() ) { ?>
		<div class="si-container">
			<div class="si-page-header-wrapper">

				<?php if ( sinatra_option( 'single_post_categories' ) ) { ?>
					<?php get_template_part( 'template-parts/entry/entry', 'category' ); ?>
				<?php } ?>

				<div class="si-page-header-title">
					<?php sinatra_page_header_title(); ?>
				</div>

				<?php get_template_part( 'template-parts/entry/entry', 'meta' ); ?>
			</div>
		</div>
	<?php } ?>

	<?php if ( sinatra_page_header_has_breadcrumbs() ) { ?>
		<div class="si-container si-breadcrumbs">
			<?php sinatra_breadcrumb( array( 'show_browse' => false ) ); ?>
		</div>
	<?php } ?>

</header>
