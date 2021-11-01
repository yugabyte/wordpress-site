<?php
/**
 * Template Name: Landing Page - Form in Hero
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

include(get_stylesheet_directory()."/page-templates/php/page-landing-form-in-hero-functions.php");

function load_custom_styles() {
	wp_register_style("page-landing-form-in-hero-style", get_stylesheet_directory_uri()."/page-templates/css/page-landing-form-in-hero-style.css");
	wp_enqueue_style('page-landing-form-in-hero-style');
}
add_action('wp_enqueue_scripts', 'load_custom_styles', 99);

$gate_form = get_field('gate_form');
$legal_note = get_field('legal_note');

get_header();
set_hero_form_in($gate_form, $legal_note);
?>
<div id="primary" class="content-area full">
    <div id="content" class="site-content" role="main">
		<?php
		$gate_form = get_field('gate_form');
		$legal_note = get_field('legal_note');
		?>
		
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/content', 'page' );
        endwhile
        ?>
    </div><!-- .content-area -->
</div>
<?php
get_footer();
?>