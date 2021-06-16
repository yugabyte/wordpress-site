<?php
/**
 * Two Column CTA Buckets Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'cta_buckets-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'cta_buckets';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?>">
    <div class="content_section_inner centered tall_pad">
        <div class="grid nopadding">
            <?php
            if( have_rows('cta_buckets') ):
                $row_count = count( get_field('cta_buckets') );
                if( $row_count == 1 ) {
                    $grid_classes = 'cta col-6-12 push-3-12 tablet-col-8-12 tablet-push-2-12 mobile-col-1-1';
                } elseif( $row_count == 2 ) {
                    $grid_classes = 'cta col-6-12 tablet-col-8-12 tablet-push-2-12 mobile-col-1-1';
                } else { // $row_count == 3
                    $grid_classes = 'cta col-4-12 tablet-col-8-12 tablet-push-2-12 mobile-col-1-1';
                }
                while ( have_rows('cta_buckets') ): the_row();
                    $title = get_sub_field('title');
                    $summary = get_sub_field('summary');
                    $ct = get_sub_field('ct');
                    $ct_btn_txt = get_sub_field('ct_btn_txt');
                    
                    echo '<div class="'.$grid_classes.'">';
                    echo '<h3 class="lined">'.$title.'</h3>';
                    if( $summary ) {
                        echo '<p>'.$summary.'</p>';
                    }
                    if( $ct ) {
                        echo '<a class="btn sq" href="'.$ct.'">'.$ct_btn_txt.'<span class="arrow"></span></a>';
                    }
                    echo '</div>';
                endwhile;
            endif;
            ?>
        </div>
    </div>
</div>