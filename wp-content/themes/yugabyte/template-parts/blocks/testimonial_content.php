<?php
/**
 * Testimonial Content Two Column Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'test_cont-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'test_cont';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$bg_color = get_field('bg_color');
$flip = get_field('flip');
$cont = get_field('cont');
$test_quote = get_field('test_quote');
$test_cite = get_field('test_cite');
$test_cite_subtitle = get_field('test_cite_subtitle');

$flip_class_test = ( $flip ) ? 'col-1-2 mobile-col-1-1 push-right test flip' : 'col-1-2 mobile-col-1-1 test';
$flip_class_cont = ( $flip ) ? 'col-1-2 mobile-col-1-1 cont' : 'col-1-2 mobile-col-1-1 push-right cont';

$bg_color_class = ( $bg_color ) ? $bg_color : 'light-blue';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?>">
    <div class="content_section_inner tall_pad">
        <div class="clearfix vert_align">
            <div class="grid nopadding">
                <div class="eq_r nopadding <?php echo $flip_class_test; ?>">
                    <div class="inner">
                        <div class="inner_content">
                            <?php
                            if( $test_quote ) {
                                echo '<blockquote>'.$test_quote.'</blockquote>';
                                if( $test_cite ) {
                                    echo '<cite>&mdash;&nbsp;'.$test_cite;
                                    if( $test_cite_subtitle ) {
                                        echo '<span>'.$test_cite_subtitle.'</span>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="eq_l nopadding <?php echo $flip_class_cont; ?>">
                    <div class="inner">
                        <div class="inner_content wysiwyg plast">
                            <?php echo $cont; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>