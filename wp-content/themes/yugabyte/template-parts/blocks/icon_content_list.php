<?php
/**
 * Icon Content List Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'icon_cont_list-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'icon_cont_list';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$bg_color = get_field('bg_color');
$heading = get_field('heading');
$intro = get_field('intro');
$grid_layout = get_field('grid_layout');
$grid_layout_variant = get_field('grid_layout_variant');

//if the 2-up grid view, bg is always white; if vertical stack, bg is always light-blue
$bg_color_class = ( $bg_color ) ? $bg_color : '';
//$bg_color_class = ( $grid_layout ) ? 'white' : 'light-blue';
$container_pad = ( $grid_layout ) ? '' : 'tall_pad';
$grid_classes = ( $grid_layout ) ? 'col-1-1' : 'col-10-12 push-1-12';
if( $grid_layout ) {
    if( $grid_layout_variant ) {
        $container_pad = 'tall_pad';
        $grid_classes = 'col-10-12 push-1-12';
    } else {
        $grid_classes = 'col-1-1';
    }
} else {
    $grid_classes = 'col-10-12 push-1-12';
}
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?>">
    <div class="content_section_inner centered <?php echo $container_pad; ?>">
        <div class="clearfix">
            <div class="grid nopadding">
                <div class="nopadding <?php echo $grid_classes; ?> tablet-col-1-1">
                    <?php
                    if( $heading || $intro ) {
                        echo '<div class="intro">';
                        if( $heading ) {
                            echo '<h2 class="lined">'.$heading.'</h2>';
                        }
                        if( $intro ) {
                            echo $intro;
                        }
                        echo '</div>';
                    }
        
                    if( have_rows('icon_cont_blocks') ):
                        if( $grid_layout ) {
                            if( $grid_layout_variant ) {
                                $list_type = 'two_up variant';
                            } else {
                                $list_type = 'two_up';
                            }
                        } else {
                            $list_type = 'stack';
                        }
                        echo '<ul class="icon_cont_blocks '.$list_type.'">';
                        while ( have_rows('icon_cont_blocks') ): the_row();
                            $icon = get_sub_field('icon');
                            $title = get_sub_field('title');
                            $cont = get_sub_field('cont');
                
                            $icon_src = $icon['url'];
                            $icon_alt = $icon['alt'];
                            
                            echo '<li class="bucket">';
                            echo '<div class="inner">';
                            if( $grid_layout ) {
                                if( $grid_layout_variant ) {
                                    
                                    echo '<div class="inner_content wysiwyg">';
                                    if( $icon ) {
                                        echo '<div class="icon_wrap"><img class="icon" src="'.$icon_src.'" alt="'.$icon_alt.'" /></div>';
                                    }
                                    echo '<div class="cont_wrap">';
                                    if( $title ) {
                                        echo '<h3>'.$title.'</h3>';
                                    }
                                    echo $cont;
                                    echo '</div>';
                                    echo '</div>';
                                    
                                } else {
                                    
                                    echo '<div class="inner_content wysiwyg">';
                                    echo '<div class="vert_align">';
                                    if( $icon ) {
                                        echo '<img class="icon" src="'.$icon_src.'" alt="'.$icon_alt.'" />';
                                    }
                                    if( $title ) {
                                        echo '<h3>'.$title.'</h3>';
                                    }
                                    echo '</div>';
                                    echo '<div class="cont_wrap">';
                                    echo $cont;
                                    echo '</div>';
                                    echo '</div>';
                                    
                                }
                                
                            } else {
                                echo '<div class="clearfix">';
                                if( $icon ) {
                                    echo '<div class="icon"><img src="'.$icon_src.'" alt="'.$icon_alt.'" /></div>';
                                }
                                echo '<div class="cont wysiwyg">';
                                if( $title ) {
                                    echo '<h3 class="lined_left">'.$title.'</h3>';
                                }
                                echo $cont;
                                echo '</div>';
                            }
                            echo '</div>';
                            echo '</li>';
                            
                        endwhile;
                        echo '</ul>';
                    endif;
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>