<?php
/**
 * Form Embed Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'form_embed-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'form_embed';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$bg_color = get_field('bg_color');
$alt_layout = get_field('alt_layout');
$bg_img = get_field('bg_img');
$the_form = get_field('the_form');
$title_override = get_field('title_override');
$desc_override = get_field('desc_override');
$legal_note = get_field('legal_note');
$is_narrow = get_field('is_narrow');
$hide_title = get_field('hide_title');
$hide_desc = get_field('hide_desc');
$is_single_col = get_field('is_single_col');

$alt_class = ( $alt_layout ) ? 'alt_layout' : '';
$bg_color_class = ( $bg_color ) ? $bg_color : '';

if( $bg_img ) {
    $bg_img_src = $bg_img['url'];
    $bg_img_dec = 'background-image:url('.$bg_img_src.');';
} else {
    $bg_img_dec = '';
}

$narrow_class = ( $is_narrow ) ? 'narrow_form' : '';
$single_col_class = ( $is_single_col ) ? 'force_1col' : '';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?> <?php echo $alt_class; ?> <?php echo $single_col_class; ?>" style="<?php echo $bg_img_dec; ?>">
    <div class="content_section_inner tall_pad centered">
        <div class="clearfix">
            <div class="grid nopadding">
                <div class="col-10-12 push-1-12 tablet-col-1-1 mobile-col-1-1 nopadding">
                    <div class="inner">
                        <?php
                        if( !$hide_title ) {
                            $title = ( $title_override ) ? $title_override : $the_form['title'];
                            echo '<h2 class="lined">'.$title.'</h2>';
                        }
                        if( !$hide_desc ) {
                            if( $desc_override ) {
                                $subheading = $desc_override;
                            } elseif( $the_form['description'] ) {
                                $subheading = $the_form['description'];
                            }
                            if( $subheading != '' ) {
                                echo '<p class="desc">'.$subheading.'</p>';
                            }
                            
                        }
                        
                        echo '<div class="'.$narrow_class.'">';
                        gravity_form($the_form['id'], false, false, false, '', true, 1);
                        
                        //add the description
                        if( $legal_note ) {
                            echo '<p class="form_footnote nomargin">'.$legal_note.'</p>';
                        }
                        echo '</div>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>