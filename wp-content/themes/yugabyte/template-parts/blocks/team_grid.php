<?php
/**
 * Team Grid Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'team_grid-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'team_grid';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$bg_color = get_field('bg_color');
$heading = get_field('heading');
$people = get_field('people'); //Single relationship field for selecting Team Members to show
$show_entity = get_field('show_entity'); //Show the organization the Team Member belongs to
$show_jobtitle = get_field('show_jobtitle'); //Show the job title
$show_social = get_field('show_social'); //Show Team Member's social links

$bg_color_class = ( $bg_color ) ? $bg_color : '';
$icon_tw = file_get_contents( get_stylesheet_directory_uri().'/assets/images/social-icons/twitter.svg' );
$icon_ln = file_get_contents( get_stylesheet_directory_uri().'/assets/images/social-icons/linkedin.svg' );
        
if( $people ): ?>
    <div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?>">
        <div class="content_section_inner centered tall_pad small_padding_bottom">
        <?php
        if( $heading ) {
            echo '<h2 class="lined">'.$heading.'</h2>';
        }
        echo '<ul class="team">';
        foreach( $people as $p ):
            setup_postdata($p);
            
            $name = get_the_title($p->ID);
            $headshot = get_field('headshot', $p->ID);
            $entity = get_field('entity', $p->ID);
            $jobtitle = get_field('jobtitle', $p->ID);
            $ln = get_field('ln', $p->ID);
            $tw = get_field('tw', $p->ID);
            
            echo '<li class="gridblock">';
            echo '<div class="inner">';
                if( $headshot ) {
                    $headshot_src = $headshot['sizes']['medium'];
                    echo '<div class="headshot">';
                    $alt_text = ( $headshot['alt'] ) ? $headshot['alt'] : $name;
                    echo '<img src="'.$headshot_src.'" alt="'.$alt_text.'" />';
                    echo '</div>';
                }
                echo '<h4>'.$name.'</h4>';
                if( $show_entity && $entity ) {
                    echo '<p>'.$entity.'</p>';
                }
                if( $show_jobtitle && $jobtitle ) {
                    echo '<p>'.$jobtitle.'</p>';
                }
                if( $show_social && ( $ln || $tw ) ) {
                    echo '<div class="social">';
                    if( $ln ) {
                        echo '<a href="'.$ln.'" class="ln" target="_blank"><span>LinkedIn</span>'.$icon_ln.'</a>';
                    }
                    if( $tw ) {
                        echo '<a href="'.$tw.'" class="tw" target="_blank"><span>Twitter</span>'.$icon_tw.'</a>';
                    }
                    echo '</div>';
                }
            echo '</div>';
            echo '</li>';
        endforeach;
        wp_reset_postdata();
        echo '</ul>';
        ?>
        </div>
    </div>
<?php
endif;
?>