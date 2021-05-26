<li class="item">
    <?php
    if( get_field('custom_title') ) {
        $title = get_field('custom_title');
    } else {
        $title = get_the_title();
    }
    //$link = get_permalink();
    $list_img = get_field('list_img');
    $ext_url = get_field('ext_url');
    $file_url = get_field('file_url');
    $date = get_the_date('', get_the_ID());
        
    $types = wp_get_object_terms(get_the_ID(), 'resource_types', '');
    $the_type = $types[0]->name;
    $rm_link_text = '';
    
    $the_link = ( $the_type == 'Datasheet' || $the_type == 'Slides' ) ? $file_url['url'] : $ext_url;
    
    /*echo '<pre>';
    var_dump($the_type);
    echo '</pre>';*/
    
    switch ( $the_type ) {
        case 'Webinar':
            $rm_link_text = 'Watch Now';
            break;
        case 'Video':
            $rm_link_text = 'Watch Now';
            break;
        case 'Slides':
            $rm_link_text = 'View Now';
            break;
        case 'Report':
            $rm_link_text = 'Read Now';
            break;
        case 'EBook':
            $rm_link_text = 'Access Now';
            break;
        default: //Datasheet
            $rm_link_text = 'Read Now';
    }
        
    echo '<a href="'.$the_link.'">';
    echo '<span class="type_label">'.$the_type.'</span>';
    echo '<div class="top">';
    if( $list_img ) {
        $list_img_src = $list_img['url'];
        echo '<div class="inner" style="background-image:url('.$list_img_src.');">';
    } else {
        echo '<div class="inner">';
    }
    echo '</div></div>';
    echo '<div class="btm"><div class="inner">';
    echo '<p>'.$title.'</p>';
    echo '</div></div>';

    echo '<div class="rm_wrap"><span class="read_more">'.$rm_link_text.'</span></div>';
    echo '</a>';
    ?>
</li>