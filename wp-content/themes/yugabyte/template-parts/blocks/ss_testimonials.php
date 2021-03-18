<?php
/**
 * Success Story Testimonials Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ss_test-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ss_test';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$c_q = count( get_field('quotes') );
$q_grid_class = ( $c_q == 2 ) ? 'eq_h' : '';
$q_class = ( $c_q == 2 ) ? 'col-1-2 mobile-col-1-1 quote' : 'col-10-12 push-1-12 mobile-col-1-1 quote single';

$c_c = count( get_field('citations') );
$c_class = ( $c_c == 2 ) ? 'col-1-2 mobile-col-1-1 cite' : 'col-1-2 push-3-12 mobile-col-1-1 cite';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?>">
    <div class="content_section_inner">
        <div class="test_bg">
            <!-- QUOTES -->
            <div class="quotes_cont clearfix">
                <div class="grid nopadding <?php echo $q_grid_class; ?>">
                    <?php
                    if( have_rows('quotes') ):
                        $q_i = 1;
                        while ( have_rows('quotes') ): the_row();
                            $quote = get_sub_field('quote');
                            $eq_class = ( $q_i == 1 ) ? 'eq_l' : 'eq_r';
                            
                            echo '<div class="'.$q_class.' '.$eq_class.'">';
                            echo '<div class="inner">';
                            echo '<div class="inner_content">';
                            echo '<p>'.$quote.'</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            $q_i++;
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
            <!-- CITATIONS -->
            <div class="cites_cont clearfix">
                <div class="grid nopadding">
                    <?php
                    if( have_rows('citations') ):
                        $c_i = 1;
                        while ( have_rows('citations') ): the_row();
                            $name = get_sub_field('name');
                            $title = get_sub_field('title');
                            $image = get_sub_field('image');
                            $image_src = $image['sizes']['medium'];
                                                                                    
                            echo '<div class="'.$c_class.'">';
                            echo '<div class="inner">';
                            echo '<div class="inner_content">';
                            echo '<div class="headshot" style="background-image:url('.$image_src.');"></div>';
                            echo '<p>'.$name;
                            if( $title ) {
                                echo '<span>'.$title.'</span>';
                            }
                            echo '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            $q_i++;
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>