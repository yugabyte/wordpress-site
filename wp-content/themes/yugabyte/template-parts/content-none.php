<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h2 class="page-title"><?php _e( 'Nothing Found', 'twentysixteen' ); ?></h2>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'twentysixteen' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Try searching with different keywords via the utility bar at the top of this page.', 'twentysixteen' ); ?></p>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Try searching via the utility bar at the top of this page.', 'twentysixteen' ); ?></p>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->