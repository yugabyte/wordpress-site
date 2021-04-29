<?php
/**
 * Skinny CTA Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'skinny_cta-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'skinny_cta';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$bg_color = get_field('bg_color');
$cont = get_field('cont');
$ct = get_field('ct');
$ct_ext = get_field('ct_ext');
$ct_btn_txt = get_field('ct_btn_txt');
$ct_btn_tar = get_field('ct_btn_tar');
$flip = get_field('flip');

$flip_class_ct = ( $flip ) ? 'col-3-12 mobile-col-1-1 ct' : 'col-3-12 mobile-col-1-1 push-right ct';
$flip_class_cont = ( $flip ) ? 'col-9-12 mobile-col-1-1 push-right cont' : 'col-9-12 mobile-col-1-1 cont';

$is_flipped = ( $flip ) ? 'flip' : '';
$bg_color_class = ( $bg_color ) ? $bg_color : '';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?> <?php echo $is_flipped; ?>">
    <div class="content_section_inner">
        <div class="clearfix vert_align">
            <div class="grid eq_h nopadding">
                <div class="eq_l <?php echo $flip_class_cont; ?>">
                    <div class="inner">
                        <div class="inner_content wysiwyg">
                            <?php
                            if( $cont ) {
                                echo '<p class="nomargin">'.$cont.'</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="eq_r <?php echo $flip_class_ct; ?>">
                    <div class="inner">
                        <div class="inner_content">
                            <?php
                            $tar = ( $ct_btn_tar ) ? '_blank' : '_self';
                    
                            if( $ct || $ct_ext ) {
                                if( $ct ) {
                                    if( $ct_ext ) {
                                        $link = $ct_ext;
                                    } else {
                                        $link = $ct;
                                    }
                                } elseif( $ct_ext ) {
                                    $link = $ct_ext;
                                }
                                echo '<a href="'.$link.'" class="btn" target="'.$tar.'">'.$ct_btn_txt.'</a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>