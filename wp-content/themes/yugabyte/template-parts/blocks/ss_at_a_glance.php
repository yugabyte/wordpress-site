<?php
/**
 * Success Story At A Glance Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ss_aag-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ss_aag';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$heading = get_field('heading');
$client = get_field('client');
//$icon_buckets
//$company_notes
//$results
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?>">
    <div class="content_section_inner tall_pad">
        <div class="clearfix vert_align">
            <div class="grid nopadding">
                <?php
                if( have_rows('company_notes') || have_rows('results') ): ?>
                    
                    <div class="col-8-12 nopadding eq_l">
                        <div class="inner">
                        <div class="inner_content">
                            <?php
                            if( have_rows('icon_buckets') ):
                                echo '<h2 class="lined_left">'.$heading.'</h2>';
                                echo '<div class="icon_buckets">';
                                while ( have_rows('icon_buckets') ): the_row();
                                    $icon = get_sub_field('icon');
                                    $txt = get_sub_field('txt');
                                
                                    echo '<div class="bucket">';
                                    echo '<div class="inner">';
                                    if( $icon ) {
                                        $icon_src = $icon['url'];
                                        $icon_alt = ( $icon['alt'] ) ? $icon['alt'] : 'At a glance icon';
                                        echo '<div class="icon"><img src="'.$icon_src.'" alt="'.$icon_alt.'" /></div>';
                                    }
                                    if( $txt ) {
                                        echo '<p>'.$txt.'</p>';
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                endwhile;
                                echo '</div>';
                            endif;
                            ?>
                        </div>
                        </div>
                    </div>
                    <div class="col-4-12 data eq_r">
                        <div class="inner">
                        <div class="inner_content">
                        
                            <?php
                            //Company Notes takes precedence
                            if( have_rows('company_notes') ):
                                echo '<div class="notes">';
                                echo '<h4 class="label">About <br />'.$client.'</h4>';
                                echo '<ul>';
                                while ( have_rows('company_notes') ): the_row();
                                    $txt = get_sub_field('txt');
                                    echo '<li>'.$txt.'</li>';
                                endwhile;
                                echo '</ul>';
                                echo '</div>';
                                
                            else:
                                
                                if( have_rows('results') ):
                                    $c = count( get_field('results') );
                                    $c_class = ( $c == 4 ) ? 'four' : '';
                                    
                                    echo '<div class="results '.$c_class.'">';
                                    echo '<h4 class="lined_left label">Results</h4>';
                                    echo '<ul>';
                                    while ( have_rows('results') ): the_row();
                                        $lg_text = get_sub_field('lg_text');
                                        $desc = get_sub_field('desc');
                                        echo '<li>';
                                        echo '<p class="lg_text">'.$lg_text.'</p>';
                                        if( $desc ) {
                                            echo '<p class="desc">'.$desc.'</p>';
                                        }
                                        echo '</li>';
                                    endwhile;
                                    echo '</ul>';
                                    echo '</div>';
                                endif;
                                
                            endif;
                            ?>
                        </div>
                        </div>
                    </div>
                    
                    
                <?php else: ?>
                    
                    <div class="col-4-12 nopadding">
                        <div class="inner">
                            <?php
                            echo '<h2 class="lined_left">'.$heading.'</h2>';
                            ?>
                        </div>
                    </div>
                    <div class="col-8-12 nopadding">
                        <div class="inner">
                            <?php
                            if( have_rows('icon_buckets') ):
                                echo '<div class="icon_buckets">';
                                while ( have_rows('icon_buckets') ): the_row();
                                    $icon = get_sub_field('icon');
                                    $txt = get_sub_field('txt');
                                
                                    echo '<div class="bucket">';
                                    echo '<div class="inner">';
                                    if( $icon ) {
                                        $icon_src = $icon['url'];
                                        $icon_alt = ( $icon['alt'] ) ? $icon['alt'] : $txt;
                                        echo '<div class="icon"><img src="'.$icon_src.'" alt="'.$icon_alt.'" /></div>';
                                    }
                                    if( $txt ) {
                                        echo '<p>'.$txt.'</p>';
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                endwhile;
                                echo '</div>';
                            endif;
                            ?>
                        </div>
                    </div>
                    
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>