<?php
/**
 * The template for displaying the 404 template in the Twenty Twenty theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
set_hero_alt();
?>
<div id="primary" class="content-area full">
    <div id="content" class="site-content" role="main">
        <div class="content_section narrow_wys">
            <div class="content_section_inner">
                <div class="inner">
                    <div class="inner_content wysiwyg">
                        <?php
                        //PULL CONTENT FROM THE GLOBAL OPTIONS IN THE ADMIN
                        $content_404 = get_field('content_404','option');
                        if( $content_404 ) {
                            remove_filter( $content_404, 'wpautop' );
                            add_filter( $content_404, 'wpautop' , 99);
                            echo $content_404;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .content-area -->
</div>
<?php
get_footer();
?>