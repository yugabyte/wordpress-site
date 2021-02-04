<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<?php
$search_mag_glass = file_get_contents( get_stylesheet_directory_uri().'/assets/images/search-mag-glass.svg' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search', 'label', 'yugabyte' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'yugabyte' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'yugabyte' ); ?></span><?php echo $search_mag_glass; ?></button>
</form>
