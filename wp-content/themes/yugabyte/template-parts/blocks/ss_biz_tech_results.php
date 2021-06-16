<?php
/**
 * Success Story Business and Technical Results Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ss_biz_tech_results-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'ss_biz_tech_results';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and adding defaults.
$bg_color = get_field('bg_color');
$biz_heading = get_field('biz_heading');
$tech_heading = get_field('tech_heading');
//biz_list
//tech_list

$biz_list = get_field('biz_list');
$tech_list = get_field('tech_list');
$c_b = 1;
$c_t = 1;
if ( !empty($biz_list) ) {
    $c_b = count( $biz_list );
}
if ( !empty($tech_list) ) {
    $c_t = count( $tech_list );
}

$bg_color_class = ( $bg_color ) ? $bg_color : '';
?>
<div id="<?php echo esc_attr($id); ?>" class="content_section <?php echo esc_attr($className); ?> <?php echo $bg_color_class; ?>">
    <div class="content_section_inner tall_pad">
        <div class="clearfix">
            <div class="grid nopadding">
                <?php
                if( $c_b > 1 && $c_t == 1 ) { //Business but no Tech ?>
                    
                    <div class="col-8-12 push-2-12 tablet-col-10-12 tablet-push-1-12 mobile-col-1-1 nopadding list_col single">
                        <div class="inner">
                            <div class="inner_content">
                                <?php
                                if( have_rows('biz_list') ):
                                    echo '<h2 class="lined centered">'.$biz_heading.'</h2>';
                                    echo '<ul class="results split">';
                                    while ( have_rows('biz_list') ): the_row();
                                        $list_item = get_sub_field('list_item');
                                        echo '<li><span>'.$list_item.'</span></li>';
                                    endwhile;
                                    echo '</ul>';
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                <?php } elseif( $c_t > 1 && $c_b == 1 ) { //Technical but no biz ?>
                    <div class="col-8-12 push-2-12 tablet-col-10-12 tablet-push-1-12 mobile-col-1-1 nopadding list_col single">
                        <div class="inner">
                            <div class="inner_content">
                                <?php
                                if( have_rows('tech_list') ):
                                    echo '<h2 class="lined centered">'.$tech_heading.'</h2>';
                                    echo '<ul class="results split">';
                                    while ( have_rows('tech_list') ): the_row();
                                        $list_item = get_sub_field('list_item');
                                        echo '<li><span>'.$list_item.'</span></li>';
                                    endwhile;
                                    echo '</ul>';
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                <?php } else { //Both business and technical results exist ?>
                    <div class="col-5-12 push-1-12 tablet-col-1-2 mobile-col-1-1 nopadding list_col">
                        <div class="inner">
                            <div class="inner_content">
                                <?php
                                if( have_rows('tech_list') ):
                                    echo '<h2 class="lined_left">'.$tech_heading.'</h2>';
                                    echo '<ul class="results">';
                                    while ( have_rows('tech_list') ): the_row();
                                        $list_item = get_sub_field('list_item');
                                        echo '<li><span>'.$list_item.'</span></li>';
                                    endwhile;
                                    echo '</ul>';
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-5-12 tablet-col-1-2 mobile-col-1-1 nopadding list_col">
                        <div class="inner">
                            <div class="inner_content">
                                <?php
                                if( have_rows('biz_list') ):
                                    echo '<h2 class="lined_left">'.$biz_heading.'</h2>';
                                    echo '<ul class="results">';
                                    while ( have_rows('biz_list') ): the_row();
                                        $list_item = get_sub_field('list_item');
                                        echo '<li><span>'.$list_item.'</span></li>';
                                    endwhile;
                                    echo '</ul>';
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>