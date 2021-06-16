<?php
/**
 * Success Story Database Requirements Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ss_db_reqs-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ss_db_reqs';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$heading = get_field('heading');
$cont = get_field('cont');
$icon = get_field('icon');
$icon_src = $icon['url'];
$icon_alt = $icon['alt'];
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?>">
    <div class="content_section_inner tall_pad nopadding_top">
        <div class="clearfix vert_align">
            <div class="grid nopadding">
                <div class="nopadding col-2-12 push-2-12 tablet-col-2-12 mobile-col-1-1 icon">
                    <div class="inner">
                        <div class="inner_content">
                            <?php echo '<img src="'.$icon_src.'" alt="'.$icon_alt.'" />'; ?>
                        </div>
                    </div>
                </div>
                <div class="nopadding col-6-12 tablet-col-10-12 mobile-col-1-1 cont">
                    <div class="inner">
                        <div class="inner_content wysiwyg plast">
                            <?php
                            echo '<h2 class="lined_left">'.$heading.'</h2>';
                            if( $cont ) {
                                echo $cont;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>