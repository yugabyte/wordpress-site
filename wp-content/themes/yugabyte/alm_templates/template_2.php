<li class="item clearfix">
    <?php
    if( get_field('custom_title') ) {
        $title = get_field('custom_title');
    } else {
        $title = get_the_title();
    }
    $link = get_permalink();
    
    $start_time = get_field('start_time');
    $end_time = get_field('end_time');
    
    //Formatting for simpler dates
    $startdate = new DateTime($start_time);
    $startmonth = $startdate->format('F');
    $startday = $startdate->format('d');
    $startyear = $startdate->format('Y');
    
    $enddate = new DateTime($end_time);
    $endmonth = $enddate->format('F');
    $endday = $enddate->format('d');
    $endyear = $enddate->format('Y');
    
    $conf_img = get_field('conf_img');
    $ext_url = get_field('ext_url');
    $is_online = get_field('is_online');
    $phys_loc = get_field('phys_loc');
    
    //if there is an external link use it
    if( $ext_url ) {
        $link = $ext_url;
    }
    $link_tar = ( $ext_url ) ? '_blank' : '_self';
    
    if( has_excerpt() ) {
        $ev_excerpt = get_the_excerpt();
    } else {
        $ev_excerpt = substr( strip_tags( strip_shortcodes(get_the_content()) ), 0, 200 );
    }
    
    //IMAGE
    $has_img = ( $conf_img ) ? '' : 'full';
    if( $conf_img ) {
        $conf_img_src = $conf_img['url'];
        $conf_img_alt = ( $conf_img['alt'] ) ? $conf_img['alt'] : $title;
        echo '<div class="img"><a href="'.$link.'" target="'.$link_tar.'">';
        echo '<img src="'.$conf_img_src.'" alt="'.$conf_img_alt.'" />';
        echo '</a></div>';
        
    }
    
    echo '<div class="cont '.$has_img.'"><div class="inner">';
        echo '<h4><a href="'.$link.'" target="'.$link_tar.'">'.$title.'</a></h4>';
        echo '<p class="meta">';
        //DATE
        if( $startday ) {
            echo '<span class="date">';
            echo $startmonth.' '.$startday;
            if( $endday && ($endday != $startday) ) {
                //if different months
                if( $startmonth != $endmonth ) {
                    echo '-'.$endmonth.' '.$endday;
                } else {
                    echo '-'.$endday;
                }
            }
            if( $startyear ) {
                echo ', '.$startyear;
            }
            //RARE EVENT SPANNING MULTIPLE YEARS
            if( $endyear && ($endyear != $startyear) ) {
                echo '-'.$endyear;
            }
            echo '</span>';
        }
        //TYPE(s)
        $ev_types = wp_get_object_terms(get_the_ID(), 'event_types', '');
        if( $ev_types ):
            $t_len = count($ev_types);
            $t_cur = 1;
            echo '&nbsp;&nbsp;&bull;&nbsp;&nbsp;';
            foreach( $ev_types as $term ):
                $type_slug = $term->slug;
                $type_name = $term->name;
            
                echo $type_name;
                if( $t_cur != $t_len ) {
                    echo ', ';
                }
                $t_cur++;
            endforeach;
        endif;
        
        //IS ONLINE?
        if( $is_online ) {
            echo '&nbsp;&nbsp;&bull;&nbsp;&nbsp;Online'; 
        } else {
            if( $phys_loc ) {
                echo '&nbsp;&nbsp;&bull;&nbsp;&nbsp;'.$phys_loc; 
            }
        }
        
        echo '</p>';
        echo '<p>'.$ev_excerpt.'</p>';
        echo '<a href="'.$link.'" class="btn sq small nomargin" target="'.$link_tar.'">Read more</a>';
    echo '</div></div>';
    ?>
</li>