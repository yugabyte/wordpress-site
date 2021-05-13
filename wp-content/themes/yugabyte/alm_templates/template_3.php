<li class="item">
    <?php
    if( get_field('custom_title') ) {
        $title = get_field('custom_title');
    } else {
        $title = get_the_title();
    }
    $link = get_permalink();
    $image = get_field('image');
    //$date = get_field('date');
    $date = get_the_date('', get_the_ID());
    $read_more_link = get_field('read_more_link');
    
    $types = wp_get_object_terms(get_the_ID(), 'news_types', '');
    $the_type = $types[0]->name;
    
    /*if( has_excerpt() ) {
        $news_excerpt = get_the_excerpt();
    } else {
        $news_excerpt = substr( strip_tags( strip_shortcodes(get_the_content()) ), 0, 100 ).'&hellip;';
    }*/
    
    /*echo '<pre>';
    var_dump($the_type);
    echo '</pre>';*/
    
    if( $the_type == 'Press Releases' ) {
        //PRESS RELEASES
        echo '<a href="'.$read_more_link.'" target="_blank">';
        echo '<div class="top pr">';
        if( $image ) {
            $image_src = $image['url'];
            echo '<div class="inner" style="background-image:url('.$image_src.');">';
        } else {
            echo '<div class="inner">';
        }
        echo '</div></div>';
        echo '<div class="btm"><div class="inner">';
        echo '<p>'.$title.'</p>';
        echo '</div></div>';
    
        echo '<div class="rm_wrap"><span class="read_more">Read more</span></div>';
        echo '</a>';
        
    } elseif( $the_type == 'Yugabyte in the News' ) {
        //YB IN THE NEWS
        echo '<a href="'.$read_more_link.'" target="_blank">';
        echo '<div class="top ybitn"><div class="inner">';
            if( $image ) {
                $image_src = $image['url'];
                $image_alt = ( $image['alt'] ) ? $image['alt'] : $title;
                echo '<img src="'.$image_src.'" alt="'.$image_alt.'" />';
            }
        echo '</div></div>';
        echo '<div class="btm"><div class="inner">';
        echo '<p>'.$title.'</p>';
        echo '</div></div>';
    
        echo '<div class="rm_wrap"><span class="read_more">See Story</span></div>';
        echo '</a>';
        
    }
    ?>
</li>