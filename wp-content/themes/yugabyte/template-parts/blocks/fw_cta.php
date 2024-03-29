<?php
/**
 * FW CTA Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'fw_cta-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'fw_cta';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$bg_color = get_field('bg_color');
$heading = get_field('heading');
$heading_img = get_field('heading_img');
$underline = get_field('underline');
$standard_h2 = get_field('standard_h2');
$subheading = get_field('subheading');
$social = get_field('social');

$bg_color_class = ( $bg_color ) ? $bg_color : 'purple-dark';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?>">
    <div class="content_section_inner centered tall_pad">
        <?php
        if( $heading ) {
            $is_lined = ( $underline ) ? 'lined' : '';
            $is_standard = ( $standard_h2 ) ? 'standard' : '';
            
            //IF LOGOS GROUP
            if( have_rows('logos_group') ) {
                echo '<div class="head_wrap clearfix">';
                echo '<div class="logos_group">';
                while ( have_rows('logos_group') ): the_row();
                    $logo = get_sub_field('logo');
                    $logo_name = get_sub_field('logo_name');
                    $logo_url = get_sub_field('logo_url');
                    
                    $logo_src = $logo['url'];
                    $logo_alt = ( $logo_name ) ? $logo_name : $logo['alt'];
                    
                    if( $logo_url ) {
                        echo '<a href="'.$logo_url.'" class="logo"><img src="'.$logo_src.'" alt="'.$logo_alt.'" /></a>';
                    } else {
                        echo '<span class="logo"><img src="'.$logo_src.'" alt="'.$logo_alt.'" /></span>';
                    }
                endwhile;
                echo '</div>';
                echo '<h2 class="'.$is_standard.'">'.$heading.'</h2>';
                echo '</div>';
            } else {
                echo '<h2 class="'.$is_lined.' '.$is_standard.'">'.$heading.'</h2>';
            }
        }
        if( $subheading ) {
            echo '<p>'.$subheading.'</p>';
        }
        //SOCIAL
        if( $social ):
            echo '<div class="social_wrap">';
            foreach( $social as $v ):
                $opt = get_field($v,'option');
                $icon_path = get_stylesheet_directory_uri().'/assets/images/social-icons/'.$v.'.svg';
                $icon_file = file_get_contents( $icon_path );
                echo '<a href="'.$opt.'" class="social '.$v.'" target="_blank"><span>'.$v.'</span>'.$icon_file.'</a>';
            endforeach;
            echo '</div>';
        endif;
        
        if( have_rows('ctas') ):
            echo '<div class="ctas_wrap">';
            while ( have_rows('ctas') ): the_row();
                $ct = get_sub_field('ct');
                $ct_ext = get_sub_field('ct_ext');
                $ct_email = get_sub_field('ct_email');
                $ct_btn_txt = get_sub_field('ct_btn_txt');
                $cta_tar = get_sub_field('cta_tar');
                $alt_style = get_sub_field('alt_style');
                
                $is_alt = ( $alt_style ) ? 'outline' : '';
                $tar = ( $cta_tar ) ? '_blank' : '_self';
                    
                if( $ct || $ct_ext || $ct_email ) {
                    if( $ct_email ) { //EMAIL WILL ALWAYS TAKE PRECEDENCE
                        $link = 'mailto:'.$ct_email;
                    } elseif( $ct_ext ) {
                        if( $ct ) {
                            $link = $ct;
                        } else {
                            $link = $ct_ext;
                        }
                    } else {
                        $link = $ct;
                    }
                    echo '<a href="'.$link.'" class="btn '.$is_alt.'" target="'.$tar.'">'.$ct_btn_txt.'</a>';
                }
            endwhile;
            echo '</div>';
        endif;
        ?>
    </div>
</div>