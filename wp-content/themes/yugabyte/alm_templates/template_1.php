<?php
$ss_page = get_page_by_title('Success Stories');
$ss_page_id = $ss_page->ID;
$inline_ctas = get_field('inline_ctas', $ss_page_id);

//  Determine the paging info 
//$posts_per_page = get_option( 'posts_per_page' );
$posts_per_page = 6;
$current_page   = $alm_page + 1;
$total_ctas     = count($inline_ctas);
$total_pages    = ceil($alm_found_posts/$posts_per_page);

//  Get the CTA Testimonial to show
$current_cta = (!empty( $inline_ctas[ $alm_page ] )) ?  $alm_page : ($current_page-1) % $total_ctas;
    
//  Get the CTA Testimonial fields
$current_id = $inline_ctas[ $current_cta ]->ID;
$name = get_field('name', $current_id);
$headshot = get_field('headshot', $current_id);
$job_title = get_field('job_title', $current_id);
$company = get_field('company', $current_id);
$logo = get_field('logo', $current_id);
$test_quote = get_field('test_quote', $current_id);

echo '<div class="inline_cta test">';
    echo '<div class="grid nopadding flex_vert_cent">';
        echo '<div class="col-4-12 nopadding meta centered">';
            echo '<div class="inner">';
            if( $headshot ) {
                $headshot_src = $headshot['sizes']['medium'];
                echo '<div class="headshot">';
                $alt_text = ( $headshot['alt'] ) ? $headshot['alt'] : $name;
                echo '<img src="'.$headshot_src.'" alt="'.$alt_text.'" />';
                echo '</div>';
            }
            if( $name ) {
                echo '<p><strong>'.$name.'</strong></p>';
            }
            if( $job_title ) {
                echo '<p>'.$job_title.'</p>';
            }
            if( $company ) {
                echo '<p><strong>'.$company.'</strong></p>';
            }
            echo '</div>';
        echo '</div>';
        echo '<div class="col-8-12 nopadding quote">';
            echo '<div class="inner">';
            if( $logo ) {
                $logo_src = $logo['url'];
                $logo_alt = ( $logo['alt'] ) ? $logo['alt'] : $company;
                echo '<img src="'.$logo_src.'" alt="'.$logo_alt.'" />';
            }
            if( $test_quote ) {
                echo '<p>&ldquo;'.$test_quote.'&rdquo;</p>';
            }
            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';
?>