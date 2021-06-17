<?php
/**
 * Content Logos Two Column Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'logos_cont-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'logos_cont';
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

$flip_class_logos = ( $flip ) ? 'col-1-2 mobile-col-1-1 logos' : 'col-1-2 mobile-col-1-1 push-right logos';
$flip_class_cont = ( $flip ) ? 'col-1-2 mobile-col-1-1 push-right cont flip' : 'col-1-2 mobile-col-1-1 cont';

$bg_color_class = ( $bg_color ) ? $bg_color : '';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?>">
    <div class="content_section_inner tall_pad">
        <div class="clearfix vert_align">
            <div class="grid nopadding">
                <div class="eq_r nopadding <?php echo $flip_class_logos; ?> tablet-col-5-12">
                    <div class="inner">
                        <div class="inner_content">
                            <?php
                            if( have_rows('logos') ):
                                echo '<ul class="logos_stagger">';
                                while ( have_rows('logos') ): the_row();
                                    $name = get_sub_field('name');
                                    $logo = get_sub_field('logo');
                                    $link = get_sub_field('link');
                                
                                    echo '<li class="clearfix">';
                                        if( $logo ) {
                                            $logo_src = $logo['url'];
                                            $logo_alt = ( $logo['alt'] ) ? $logo['alt'] : $name;
                                            if( $link ) {
                                                echo '<a class="logo" href="'.$link.'" target="_blank">';
                                            } else {
                                                echo '<div class="logo">';
                                            }
                                            echo '<img src="'.$logo_src.'" alt="'.$logo_alt.'" />';
                                            if( $link ) {
                                                echo '</a>';
                                            } else {
                                                echo '</div>';
                                            }
                                        }
                                    echo '</li>';
                                endwhile;
                                echo '</ul>';
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="eq_l nopadding <?php echo $flip_class_cont; ?> tablet-col-7-12">
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