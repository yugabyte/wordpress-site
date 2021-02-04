<?php
/**
 * Testimonial Full-Width Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'testimonial-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'testimonial';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$heading = get_field('heading');
$quote = get_field('quote') ?: 'Lorem ipsum dolor sit amet...';
$logo_img = get_field('logo_img');
$img_src = $logo_img['url'];
$img_alt = $logo_img['alt'];
$cite = get_field('cite');

?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?>">
    <div class="content_section_inner">
        <div class="grid nopadding">
            <div class="col-8-12 push-4-12 mobile-col-1-1 nopadding">
            <?php
            if( $heading ) {
                echo '<h3>'.$heading.'</h3>';
            }
            ?>
            </div>
        </div>
        <div class="grid nopadding">
            <div class="col-3-12 mobile-col-1-1 img nopadding">
                <?php echo '<img src="'.$img_src.'" alt="'.$img_alt.'" />'; ?>
            </div>
            <div class="col-8-12 mobile-col-1-1 push-right quote nopadding">
                <div class="inner">
                <?php
                if( $quote ) {
                    echo '<blockquote>&ldquo;'.$quote.'&rdquo;</blockquote>';
                    if( $cite ) {
                        echo '<cite>'.$cite.'</cite>';
                    }
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>