<?php
function set_hero_form_in($gate_form, $legal_note) {
    $post = get_queried_object();
    $hero_image_id = get_post_thumbnail_id();
    $hero_image = get_all_featured_image_sizes($hero_image_id);
    if( get_field('custom_title') ) {
        $title = get_field('custom_title');
    } else {
        $title = get_the_title();
    }
    $subheading = get_field('subheading');
    
    $bg_color_class = '';
    
    if( is_page() ):
        
        $hero_image_id = get_post_thumbnail_id();
        $hero_image = get_all_featured_image_sizes($hero_image_id);
        
        if( has_post_thumbnail() ) {
            $bg_color_class = '';
        } else {
            $bg_color_class = 'grad-dkpurple-blue';
        }
        
    elseif( is_category() || is_tag() || is_tax() ):
    
        $term = $post;
        $term_id = $term->term_id;
        $tax = $post->taxonomy;
        $hero_image = get_field('hero_image', $tax.'_'.$term_id);
        if( get_field('custom_title', $tax.'_'.$term_id) ) {
            $title = get_field('custom_title', $tax.'_'.$term_id);
        } else {
            $title = $term->name;
        }
        if( is_category() || is_tag() ) {
            $title = 'Distributed SQL Blog: '.$title;
        }
        $subheading = get_field('subheading', $tax.'_'.$term_id);
        
        $bg_color_class = 'blog grad_orange_purpledark';
    
    elseif( is_author() ):
        $author = get_queried_object();
        $author_id = $author->ID;
        $author_fname = get_user_meta( $author_id, 'first_name', true );
        $author_lname = get_user_meta( $author_id, 'last_name', true );
        $title = 'Articles by '.$author_fname.' '.$author_lname;
        $bg_color_class = 'blog grad_orange_purpledark';
    
    elseif( is_search() ):
        $search = get_search_query();
        $title = 'Search results for: "'.$search.'"';
        $bg_color_class = 'search grad_orange_purpledark';
        
    elseif( is_404() ):
        $title = get_field('title_404','option');
        $bg_color_class = 'error grad_orange_purpledark';
    
    elseif( is_singular('post') ):
        $hero_image = get_field('hero_image');
        $subheading = get_field('subheading');
        $bg_color_class = 'blog grad_orange_purpledark';
        
    else:
        
        $hero_image_id = get_post_thumbnail_id();
        $hero_image = get_all_featured_image_sizes($hero_image_id);
        
    endif;
        
    $el = '#hero_alt';
    if( !is_author() && !is_tag() ) {
        generate_fw_thumbs($hero_image, $el);
    }
    echo '<div id="hero_alt" class="content_section '.$bg_color_class.'">';
    echo '<div class="content_section_inner nopadding">';
        echo '<div class="inner">';
        echo '<div class="inner_content">';
        echo '<h1>'.$title.'</h1>';
        if( $subheading ) {
            echo '<p class="subheading">'.$subheading.'</p>';
        }
		//SET THE FORM
		if( $gate_form ) {
			gravity_form($gate_form['id'], false, false, false, '', true, 1);
		}
		if( $legal_note ) {
			echo '<p class="form_footnote">'.$legal_note.'</p>';
		}
	
        if( is_singular('post') ) {
            $author_id = get_the_author_meta('ID');
            $author = get_the_author();
            $author_link = get_author_posts_url($author_id);
            $author_headshot = get_avatar_url($author_id);
            $author_fname = get_user_meta( $author_id, 'first_name', true );
            $author_lname = get_user_meta( $author_id, 'last_name', true );
            $date = get_the_date('', get_the_ID());
            $date_formatted = date('F j, Y', strtotime($date));
            
            echo '<div class="byline">';
                if( $author_headshot ) {
                    echo '<a class="headshot" href="'.$author_link.'" style="background-image:url('.$author_headshot.');"></a>';
                }
                echo '<p><span>By <a href="'.$author_link.'">'.$author_fname.' '.$author_lname.'</a></span><br />'.$date_formatted.'</p>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    echo '</div>';
    echo '</div>'; 
    wp_reset_postdata();
}
?>