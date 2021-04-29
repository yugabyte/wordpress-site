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
$the_form = get_field('the_form');
$title_override = get_field('title_override');
$subheading = get_field('subheading');
$is_narrow = get_field('is_narrow');
$is_single_col = get_field('is_single_col');

$bg_color_class = ( $bg_color ) ? $bg_color : '';
$narrow_class = ( $is_narrow ) ? 'col-6-12 push-3-12 mobile-col-1-1' : 'col-10-12 push-1-12 mobile-col-1-1';
$single_col_class = ( $is_single_col ) ? 'force_1col' : '';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?> <?php echo $single_col_class; ?>">
    <div class="content_section_inner tall_pad centered">
        <div class="clearfix">
            <div class="grid nopadding">
                <div class="<?php echo $narrow_class; ?>">
                    <div class="inner">
                        <?php
                        $title = ( $title_override ) ? $title_override : $the_form['title'];
                        echo '<h2 class="lined">'.$title.'</h2>';
        
                        if( $subheading ) {
                            echo '<p>'.$subheading.'</p>';
                        }
                        
                        gravity_form($the_form['id'], false, false, false, '', true, 1);
                        
                        //add the description
                        if( $the_form['description'] ) {
                            echo '<p class="nomargin">'.$the_form['description'].'</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>