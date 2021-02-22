<li class="item">
    <?php
    if( get_field('custom_title') ) {
        $title = get_field('custom_title');
    } else {
        $title = get_the_title();
    }
    $link = get_permalink();
    $client = get_field('client');
    $logo = get_field('logo');
    $vertical = get_field('vertical');
    $summary = get_field('summary');
    
    echo '<div class="top"><div class="inner">';
        if( $logo ) {
            $logo_src = $logo['url'];
            $logo_alt = ( $logo['alt'] ) ? $logo['alt'] : $client;
            echo '<img src="'.$logo_src.'" alt="'.$logo_alt.'" />';
        }
        if( $vertical ) {
            echo '<span class="vertical">'.$vertical.'</span>';
        }
    echo '</div></div>';
    echo '<div class="btm"><div class="inner">';
        if( $summary ) {
            echo '<p>'.$summary.'</p>';
        }
    echo '</div></div>';
    
    echo '<div class="rm_wrap"><a href="'.$link.'" class="read_more">See Story</a></div>';
    ?>
</li>