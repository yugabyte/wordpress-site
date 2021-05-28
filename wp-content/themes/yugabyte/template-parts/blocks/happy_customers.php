<?php
/**
 * Image Content Two Column Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'happy_customers-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'happy_customers';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$heading = get_field('heading');
$testimonial = get_field('testimonial');
$ct = get_field('ct');
$ct_btn_txt = get_field('ct_btn_txt');

?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> light-blue">
    <div class="content_section_inner tall_pad">
        <div class="grid nopadding">
            <div class="intro col-8-12 push-2-12 mobile-col-1-1 nopadding centered">
            <?php
            if( $heading ) {
                echo '<h2 class="lined">'.$heading.'</h2>';
            }
            ?>
            </div>
        </div>
        <?php
        if( $testimonial ):
            //TODO: NEEDS TO BE A SLIDER
            foreach( $testimonial as $p ):
                setup_postdata($p);

                $name = get_field('name', $p->ID);
                $headshot = get_field('headshot', $p->ID);
                $job_title = get_field('job_title', $p->ID);
                $company = get_field('company', $p->ID);
                $logo = get_field('logo', $p->ID);
                $test_quote = get_field('test_quote', $p->ID);
                
                echo '<div class="hc_test grid eq_h nopadding">';
                if( $logo ) {
                    $logo_src = $logo['url'];
                    $logo_alt = ( $logo['alt'] ) ? $logo['alt'] : $company;
                    
                    echo '<div class="logo eq_l col-3-12 push-1-12 mobile-col-1-1 clearfix">';
                    echo '<div class="inner">';
                    echo '<div class="inner_inner">';
                    echo '<img src="'.$logo_src.'" alt="'.$logo_alt.'" />';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '<div class="cont eq_r col-7-12 mobile-col-1-1 clearfix">';
                echo '<div class="inner">';
                    if( $test_quote ) {
                        echo '<p class="quote"><span class="mark">&ldquo;</span>'.$test_quote.'</p>';
                    }
                    echo '<div class="inner_content">';
                        if( $headshot ) {
                            $headshot_src = $headshot['sizes']['medium'];
                            echo '<div class="headshot" style="background-image:url('.$headshot_src.');"></div>';
                        }
                        if( $name ) {
                            echo '<p><strong>'.$name.'</strong>';
                        }
                        if( $job_title ) {
                            echo '<br />'.$job_title;
                        }
                        if( $company ) {
                            echo ', '.$company;
                        }
                        echo '</p>';
                    echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

            endforeach;
            wp_reset_postdata();
        endif;
        
        //LOGOS
        if( have_rows('logos') ):
            echo '<div class="grid nopadding">';
            echo '<div class="col-1-1 nopadding centered">';
            echo '<ul class="logos six">';
            while ( have_rows('logos') ): the_row();
                $name = get_sub_field('name');
                $logo = get_sub_field('logo');
                $link = get_sub_field('link');
                                
                echo '<li class="gridblock">';
                echo '<div class="inner">';
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
                echo '</div>';
                echo '</li>';
            endwhile;
            echo '</ul>';
            
            //CLICKTHROUGH
            if( $ct ) {
                echo '<a href="'.$ct.'" class="btn sq">'.$ct_btn_txt.'<span class="arrow"></span></a>';
            }
            
            echo '</div>';
            echo '</div>';
        endif;
        ?>
    </div>
</div>
