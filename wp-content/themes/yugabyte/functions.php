<?php
require_once('inc/custom-post-type.php');
require_once('inc/block-registration.php');

function yugabyte_setup() {		
	register_nav_menus( array(
		'primary' => __( 'Primary Nav', 'yugabyte' ),
	) );
	register_nav_menus( array(
		'footer' => __( 'Footer Nav', 'yugabyte' ),
	) );
	
	//CUSTOM IMAGE SIZES
	add_image_size( 'fw-mobile', 767, 246, true);
    add_image_size( 'fw-medium', 1024, 328, true );
    add_image_size( 'fw-large', 1440, 460, true );
    add_image_size( 'fw-x-large', 1920, 620, true );
    
    //DISABLE CUSTOM COLORS
    add_theme_support( 'disable-custom-colors' );
    add_theme_support( 'align-wide' );

    add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => __( 'White', 'yugabyte' ),
            'slug'  => 'white',
            'color'	=> '#ffffff',
        ),
        array(
            'name'  => __( 'Offwhite', 'yugabyte' ),
            'slug'  => 'offwhite',
            'color'	=> '#eef1fa',
        ),
        array(
            'name'  => __( 'Gray Light', 'yugabyte' ),
            'slug'  => 'gray-light',
            'color'	=> '#e8e9f3',
        ),
        array(
            'name'  => __( 'Gray', 'yugabyte' ),
            'slug'  => 'gray',
            'color'	=> '#707070',
        ),
        array(
            'name'  => __( 'Gray Dark', 'yugabyte' ),
            'slug'  => 'gray-dark',
            'color'	=> '#4d4647',
        ),
        array(
            'name'  => __( 'Nearly Black', 'yugabyte' ),
            'slug'  => 'nearly-black',
            'color'	=> '#141920',
        ),
        array(
            'name'  => __( 'Black', 'yugabyte' ),
            'slug'  => 'black',
            'color'	=> '#000000',
        ),
        array(
            'name'  => __( 'Purple', 'yugabyte' ),
            'slug'  => 'purple',
            'color'	=> '#332a66',
        ),
        array(
            'name'  => __( 'Purple Dark', 'yugabyte' ),
            'slug'  => 'purple-dark',
            'color'	=> '#000041',
        ),
        array(
            'name'  => __( 'Orange', 'yugabyte' ),
            'slug'  => 'orange',
            'color'	=> '#ff6e42',
        ),
        array(
            'name'  => __( 'Green', 'yugabyte' ),
            'slug'  => 'green',
            'color'	=> '#4ecd5f',
        ),
        array(
            'name'  => __( 'Blue', 'yugabyte' ),
            'slug'  => 'blue',
            'color'	=> '#2b59c3',
        ),
    ) );
}
add_action( 'after_setup_theme', 'yugabyte_setup', 100 );

function kill_parent_load_child_style() {
    wp_dequeue_style( 'twentytwenty-style' );
    wp_deregister_style( 'twentytwenty-style' );
    
    if( !is_admin() ) {
        wp_enqueue_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js', array(), 1, true);
		wp_register_script( 'custom_script', get_stylesheet_directory_uri().'/assets/js/dist/scripts.min.js', array(), 1, true);
	    wp_enqueue_script( 'custom_script' );
	}
		
	wp_enqueue_style('yugabyte-style', get_stylesheet_directory_uri().'/assets/css/dist/screen.min.css', array(), '20210910');
    wp_enqueue_style( 'dashicons' );
    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css' );
}
add_action( 'wp_enqueue_scripts', 'kill_parent_load_child_style', 20 );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


/**************************************************************/
/***** CUSTOM FORMATTING FOR ACF WYSIWYG EDITOR FIELD *********/
/**************************************************************/
function yb_custom_mce_formats($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'yb_custom_mce_formats');

function mce_sub_sup( $buttons ) {	
	array_push( $buttons, 'subscript' );
	array_push( $buttons, 'superscript' );
	array_push( $buttons, 'underline' );
	array_push( $buttons, 'table' );
	return $buttons;
}
add_filter('mce_buttons', 'mce_sub_sup');

//ADD TABLE PLUGIN
function add_mce_table_plugin( $plugins ) {
    $plugins['table'] = get_stylesheet_directory_uri().'/tinymce-table/plugin.min.js';
    return $plugins;
}
add_filter( 'mce_external_plugins', 'add_mce_table_plugin' );

function constrain_mce_editor( $init ) {
    
    $default_colours = '"000000", "Black", "ffffff", "White", "2b59c3", "Blue", "4ecd5f", "Green", "ff6e42", "Orange", "000041", "Purple Dark", "332a66", "Purple", "141920", "Nearly Black", "4d4647", "Gray Dark", "707070", "Gray", "e8e9f3", "Gray Light", "eef1fa", "Light Blue"';
    $init['textcolor_map'] = '['.$default_colours.']';
    
    $style_formats = array(
        array(
            'title' => 'SPECIAL OL',
            'block'    => 'ol',
            'classes' => 'special_ol',
        ),
        array(
            'title' => 'CHECKMARK UL',
            'selector'    => 'ul',
            'classes' => 'checkmark',
        ),
        array(
            'title' => 'TAB INDENT WRAP',
            'block'    => 'div',
            'classes' => 'tab_indent_wrap',
            'wrapper' => true,
        ),
        array(
            'title' => 'H2 LINED',
            'block'    => 'h2',
            'classes' => 'lined',
        ),
        array(
            'title' => 'H2 LINED (LEFT)',
            'block'    => 'h2',
            'classes' => 'lined_left',
        ),
        array(
            'title' => 'H2 LARGE PURPLE',
            'block'    => 'h2',
            'classes' => 'large_purple',
        ),
        array(
            'title' => 'H2 TITLE CASE',
            'block'    => 'h2',
            'classes' => 'title_case',
        ),
        array(
            'title' => 'H3 TITLE CASE',
            'block'    => 'h3',
            'classes' => 'title_case',
        ),
        array(
            'title' => 'H4 TITLE CASE',
            'block'    => 'h4',
            'classes' => 'title_case',
        ),
        array(
            'title' => 'BUTTON STANDARD',
            'selector'    => 'a',
            'classes' => 'btn',
        ),
        array(
            'title' => 'BUTTON OUTLINED',
            'selector'    => 'a',
            'classes' => 'btn outline',
        ),
        array(
            'title' => 'BUTTON SQUARED',
            'selector'    => 'a',
            'classes' => 'btn sq',
        ),
    );
    
    $init['style_formats'] = json_encode( $style_formats );
    return $init;
}
add_filter('tiny_mce_before_init', 'constrain_mce_editor');


/******************************************/
/***** REGISTER/INIT SIDEBARS *************/
/******************************************/
function remove_base_widgets(){

	// Unregister TwentySixteen sidebars
	unregister_sidebar( 'sidebar-1' );
	unregister_sidebar( 'sidebar-2' );
	unregister_sidebar( 'sidebar-3' );
}
add_action( 'widgets_init', 'remove_base_widgets', 11 );

function yugabyte_widgets_init() {
	
	register_sidebar( array(
        'name'          => __( 'Blog Sidebar Listing', 'yugabyte' ),
        'id'            => 'sidebar-blog',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'yugabyte' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'yugabyte_widgets_init' );


/******************************************/
/***** ACF OPTIONS PAGE *******************/
/******************************************/
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
	    'page_title' => 'Yugabyte Theme Options',
	    'menu_title' 	=> 'Yugabyte Options',
		'menu_slug' 	=> 'theme-options',
	));
}

/******************************************/
/***** UTILITY FUNCTIONS ******************/
/******************************************/
function stringToSlug($str) {
	$str = strtolower(trim($str));
	$str = preg_replace('/[^a-z0-9-]/', '-', $str);
	$str = preg_replace('/-+/', "-", $str);
	return $str;
}

// REMOVE POST FORMATS META BOX
add_action('after_setup_theme', 'remove_formats_meta', 100);
function remove_formats_meta() {
    remove_theme_support('post-formats');
}

// DEAL WITH AMPERSANDS IN TITLES
function entity_decode_title( $title ) {
    $title = html_entity_decode( $title );
    $title = urlencode( $title );
    return $title;
}

// MOVE YOAST META BOXES TO THE BOTTOM
function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

//ALLOW SVG MIME TYPE IN MEDIA LIBRARY
function add_new_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'add_new_mime_types');


/***********************************************/
/**** HERO / RESPONSIVE IMAGES *****************/
/***********************************************/
function generate_fw_thumbs($i, $el) {
    $fw_image_full = $i['url'];
    $fw_image_1600 = $i['sizes']['fw-x-large'];
    $fw_image_1024 = $i['sizes']['fw-large'];
    $fw_image_768 = $i['sizes']['fw-medium'];
    $fw_image_540 = $i['sizes']['fw-mobile'];
    
    /*echo '<pre>';
	var_dump( $i['url'] );
    echo '</pre>';*/

    echo '<style>';
    echo $el.'{background-image:url('.$fw_image_1024.')}';
    echo '@media screen and (min-width: 768px) {'.$el.'{background-image:url('.$fw_image_768.')}}';
    echo '@media screen and (min-width: 1000px) {'.$el.'{background-image: url('.$fw_image_1600.')}}';
    //echo '@media screen and (min-width: 1400px) {'.$el.'{background-image: url('.$fw_image_1600.')}}';
    echo '</style>';
}

function set_hero() {
    $post = get_queried_object();
    $hero_image_id = get_post_thumbnail_id( $post->ID );
    $hero_image = get_all_featured_image_sizes($hero_image_id);
    if( get_field('custom_title') ) {
        $title = get_field('custom_title');
    } else {
        $title = get_the_title();
    }
    
    //ADDITIONAL FIELDS
    $subheading = get_field('subheading');
    $post_cta_note = get_field('post_cta_note');
    $alert_bar = get_field('alert_bar');
    
    if( is_category() || is_tax() ):
        $term = $post;
        $term_id = $term->term_id;
        $tax = $post->taxonomy;
        $hero_image = get_field('hero_image', $tax.'_'.$term_id);
        if( get_field('custom_title', $tax.'_'.$term_id) ) {
            $title = get_field('custom_title', $tax.'_'.$term_id);
        } else {
            $title = $term->name;
        }
        $subheading = get_field('subheading', $tax.'_'.$term_id);
    endif;
    
        $el = '#hero';
        generate_fw_thumbs($hero_image, $el);
        echo '<div id="hero" class="content_section">';
        echo '<div class="content_section_inner">';
            echo '<div class="inner">';
            echo '<div class="inner_content">';
            
            //HOMEPAGE ROTATING 'TYPING' BANNER
            if( is_home() || is_front_page() ) {
                echo '<div class="jumbotron" id="hero-animation">';
                echo '<div class="inner">';
                echo '<h1><span>The&nbsp;</span><span id="wordstring">Resilient</span><div class="cursor-wrapper"><span class="cursor"></span></div><br /><span>Distributed SQL Database</span></h1>';
                echo '</div>';
                echo '</div>';
            } else {
                echo '<h1>'.$title.'</h1>';
            }
            
            if( $subheading ) {
                echo '<p class="subheading">'.$subheading.'</p>';
            }
            
            if ( have_rows('cta_buttons') ):
                echo '<div class="cta_group">';
                while ( have_rows('cta_buttons') ): the_row();
                    $cta_url = get_sub_field('cta_url');
                    $cta_url_ext = get_sub_field('cta_url_ext');
                    $cta_url_deep = get_sub_field('cta_url_deep');
                    $cta_tar = get_sub_field('cta_tar');
                    $cta_btn_txt = get_sub_field('cta_btn_txt');
                    $alt_style = get_sub_field('alt_style');
                    
                    $is_alt = ( $alt_style ) ? 'outline' : '';
                    $tar = ( $cta_tar ) ? '_blank' : '_self';
                    
                    $is_deep = ( $cta_url_deep ) ? 'deeplink' : '';
                    
                    if( $cta_url || $cta_url_ext || $cta_url_deep ) {
                        if( $cta_url_ext ) {
                            if( $cta_url ) {
                                $link = $cta_url;
                            } else {
                                $link = $cta_url_ext;
                            }
                        } elseif( $cta_url_deep ) {
                            $link = '#'.$cta_url_deep;
                        } else {
                            $link = $cta_url;
                        }
                        echo '<a href="'.$link.'" class="btn '.$is_alt.' '.$is_deep.'" target="'.$tar.'">'.$cta_btn_txt.'</a>';
                    }
                endwhile;
                echo '</div>';
            endif;
            wp_reset_postdata();
            
            //POST-CTA NOTE
            if( $post_cta_note ) {
                echo '<p class="post_note">'.$post_cta_note.'</p>';
            }
            
            echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '</div>';
        //LATEST NEWS
        if( is_home() || is_front_page() ) {
            $latest_news = get_field('latest_news');
            $latest_news_override = get_field('latest_news_override');
            
            //LATEST YBNEWS POST QUERY
            $latest = new WP_Query( array(
                'post_type' => 'ybnews',
                'posts_per_page' => 1
            ));
            
            if( $latest_news ) {
                echo '<div id="latest_news" class="content_section purple-dark">';
                echo '<div class="content_section_inner">';
                echo '<div class="ln_wrap clearfix">';
                
                /*echo '<pre>';
                var_dump($latest);
                echo '</pre>';*/
                
                if ($latest->have_posts()):
                
                    if( $latest_news_override ) {
                        
                        foreach( $latest_news_override as $p ):
                            setup_postdata($p);
                            $title = get_the_title($p->ID);
                            $link = get_permalink($p->ID);
                            $rm_link = get_field('read_more_link', $p->ID);
                    
                            echo '<span class="ln_label">News</span>';
                            echo '<a class="ln_link" href="'.$rm_link.'" target="_blank">'.$title.'</a>';
                        endforeach;
                        wp_reset_postdata();
                        
                    } else {
                        while ( $latest->have_posts() ) : $latest->the_post();
                            
                            $title = get_the_title();
                            $link = get_permalink();
                            $rm_link = get_field('read_more_link');
                    
                            echo '<span class="ln_label">News</span>';
                            echo '<a class="ln_link" href="'.$rm_link.'">'.$title.'</a>';
                            
                        endwhile;
                    }
                endif;
                wp_reset_query();
                
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
        //ALERT BAR
        if( $alert_bar ) {
            echo '<div id="alert_bar" class="content_section purple-dark">';
            echo '<div class="content_section_inner">';
            echo '<div class="alert_bar_wrap wysiwyg plast">';
            echo $alert_bar;
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    wp_reset_postdata();
}

function set_hero_alt() {
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

function set_ss_hero() {
    $post = get_queried_object();
    $client = get_field('client');
    $hero_image = get_field('hero_image');
    $hero_logo = get_field('hero_logo');
    if( get_field('custom_title') ) {
        $title = get_field('custom_title');
    } else {
        $title = get_the_title();
    }
    
    $el = '#hero_ss';
    if( $hero_image['sizes']['large'] ) {
        $hero_img_src = $hero_image['sizes']['large'];
    } else {
        $hero_img_src = $hero_image['url'];
    }

    echo '<style>';
    echo $el.'{background-image:url('.$hero_img_src.')}';
    echo '@media screen and (max-width: 767px) {'.$el.'{background-image:none;}}';
    echo '</style>';
    
    echo '<div id="hero_ss" class="content_section">';
    echo '<div class="content_section_inner">';
        echo '<div class="inner">';
        echo '<div class="inner_content">';
        if( $hero_logo ) {
            $hero_logo_src = $hero_logo['url'];
            $hero_logo_alt = ( $hero_logo['url'] ) ? $hero_logo['url'] : $client;
            echo '<img class="ss_logo" src="'.$hero_logo_src.'" alt="'.$hero_logo_alt.'" />';
        }
        echo '<h1>'.$title.'</h1>';
        
        if ( have_rows('cta_buttons') ):
            echo '<div class="cta_group">';
            while ( have_rows('cta_buttons') ): the_row();
                $cta_url = get_sub_field('cta_url');
                $cta_url_ext = get_sub_field('cta_url_ext');
                $cta_tar = get_sub_field('cta_tar');
                $cta_btn_txt = get_sub_field('cta_btn_txt');
                $alt_style = get_sub_field('alt_style');
                
                $is_alt = ( $alt_style ) ? 'outline' : '';
                $tar = ( $cta_tar ) ? '_blank' : '_self';
                
                if( $cta_url || $cta_url_ext ) {
                    if( $cta_url_ext ) {
                        if( $cta_url ) {
                            $link = $cta_url;
                        } else {
                            $link = $cta_url_ext;
                        }
                    } else {
                        $link = $cta_url;
                    }
                    echo '<a href="'.$link.'" class="btn '.$is_alt.'" target="'.$tar.'">'.$cta_btn_txt.'</a>';
                }
            endwhile;
            echo '</div>';
        endif;
        wp_reset_postdata();
        
        echo '</div>';
        echo '</div>';
    echo '</div>';
    echo '</div>';
        
    //endif;
    wp_reset_postdata();
}

function set_hero_gated() {
    $post = get_queried_object();
    $hero_image = get_field('hero_image');
    if( get_field('custom_title') ) {
        $title = get_field('custom_title');
    } else {
        $title = get_the_title();
    }
    $tagline = get_field('tagline');
    $subheading = get_field('subheading');
    
    $bg_color_class = '';
        
    if( !$hero_image ) {
        $bg_color_class = 'grad-dkpurple-blue';
    }
        
    $el = '#hero_gated';
    generate_fw_thumbs($hero_image, $el);
    echo '<div id="hero_gated" class="content_section '.$bg_color_class.'">';
    echo '<div class="content_section_inner nopadding_tb">';
        echo '<div class="grid nopadding">';
        echo '<div class="col-5-12 push-1-12 mobile-col-1-1 nopadding">';
            echo '<div class="inner">';
            echo '<div class="inner_content">';
            //SITE HEADER IS HIDDEN, SO SET LOGO IN HEADER
            ?>
            <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="" src="<?php echo get_stylesheet_directory_uri().'/assets/images/logo-main-light.svg' ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
            <?php
            if( $tagline ) {
                echo '<p class="tagline">'.$tagline.'</p>';
            }
            echo '<h1>'.$title.'</h1>';
            if( $subheading ) {
                echo '<p class="subheading">'.$subheading.'</p>';
            }
            echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '</div>';
    echo '</div>';
    echo '</div>'; 
    wp_reset_postdata();
}

function get_all_featured_image_sizes($attachment_id = 0) {
    $sizes = get_intermediate_image_sizes();
    if(!$attachment_id) $attachment_id = get_post_thumbnail_id();
    
    $images = array();
    foreach ( $sizes as $size ) {
        $images[$size] = wp_get_attachment_image_src( $attachment_id, $size )[0];
    }
    $imageObject = array(
        'sizes' => $images
    );
    return $imageObject;
}

/******************************************/
/***** PAGINATION *************************/
/******************************************/
function yb_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( 'Previous', 'yugabyte' ),
		'next_text' => __( 'Next', 'yugabyte' ),
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'certified' ); ?></h1>
		<div class="pagination loop-pagination">
			<?php echo $links; ?>
		</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}


//CUSTOM TOOLTIP SHORTCODE
function set_info_tooltip( $atts = [], $content = null, $tag = '' ) {
    // normalize attribute keys, lowercase
    $atts = array_change_key_case( (array) $atts, CASE_LOWER );
 
    // override default attributes with user attributes
    $tip_atts = shortcode_atts(
        array(
            'content' => 'Lorem ipsum dolor sit amet',
        ), $atts, $tag
    );
 
    // info icon
    $o = '<a class="info_tip" href="#">';
 
    // title
    $o .= '<span class="tip"><span class="inner">' . esc_html__( $tip_atts['content'], 'yugabyte' ) . '</span></span>';
    $o .= '</a>';
 
    return $o;
}

add_shortcode('info_tip', 'set_info_tooltip');

//SET VIDEO EMBED WITH POSTER IMAGE AND PLAY BUTTON
function video_setup($v, $p) {
    echo '<div class="vid_cont" style="background-image:url('.$p.');">';
    echo '<div class="video_container off">';
    preg_match('/src="(.+?)"/', $v, $matches);
    $src = $matches[1];

    // add extra params to iframe src
    $params = array(
        'controls'    => 1,
        'rel' => 0,
        'hd'        => 1,
        'autohide'    => 1
    );
    $new_src = add_query_arg($params, $src);
    $video = str_replace($src, $new_src, $v);

    // add extra attributes to iframe html
    $attributes = 'frameborder="0"';

    $video = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $video);
    echo $video;
    echo '</div>';
    
    //play btn overlay
    echo '<a class="play_btn vid_block"></a>';
    echo '</div>';
}


add_filter( 'gform_field_content', function ( $field_content, $field ) {
	
	if ( 'number' !== $field->type && $field->cssClass == 'whole_num' ) {
		return $field_content;
	}
	
	return str_replace( "step='any'", "step='1'", $field_content );

}, 10, 2 );

/**********************************************************************************/
/***** SET FULL-WIDTH CTA (YUGABYTE GLOBAL OPTIONS PANEL) *************************/
/**********************************************************************************/
function setGlobalFWCTA() {
    // Create id attribute allowing for custom "anchor" value.
    $id = 'fw_cta-options';
    $className = 'fw_cta';

    // Load values and adding defaults.
    $bg_color = get_field('bg_color','option');
    $heading = get_field('heading','option');
    $underline = get_field('underline','option');
    $standard_h2 = get_field('standard_h2','option');
    $subheading = get_field('subheading','option');
    $social = get_field('social','option');

    $bg_color_class = ( $bg_color ) ? $bg_color : 'purple-dark';
    
    echo '<div id="'.esc_attr($id).'" class="content_section '.esc_attr($className).' '.$bg_color_class.'">';
    echo '<div class="content_section_inner centered tall_pad">';
        
    if( $heading ) {
        $is_lined = ( $underline ) ? 'lined' : '';
        $is_standard = ( $standard_h2 ) ? 'standard' : '';
        
        //IF LOGOS GROUP
        if( have_rows('logos_group','option') ) {
            echo '<div class="head_wrap clearfix">';
            echo '<div class="logos_group">';
            while ( have_rows('logos_group','option') ): the_row();
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
    
    if( have_rows('ctas','option') ):
        echo '<div class="ctas_wrap">';
        while ( have_rows('ctas','option') ): the_row();
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
    
    echo '</div>';
    echo '</div>';
}

//REDIRECT SINGLE YBNEWS POSTS
add_action( 'template_redirect', 'redirect_cpt_single' );
function redirect_cpt_single(){
    if ( !is_singular( array('ybnews','teammember','testimonial','ybevent') ) )
        return;
    
    if ( is_singular('ybnews') ) {
        $redirect_url = get_permalink( get_page_by_path('news') );
    } elseif( is_singular('teammember') ) {
        $redirect_url = get_permalink( get_page_by_path('about') );
    } elseif( is_singular('testimonial') ) {
        $redirect_url = get_permalink( get_page_by_path('about') );
    } elseif( is_singular('ybevent') ) {
        $redirect_url = get_permalink( get_page_by_path('events') );
    }
    
    wp_redirect( $redirect_url, 301 );
    exit;
}

//FORCE NOINDEX NOFOLLOW ON SINGLE POST TYPES WHERE NO FRONTEND DESIGN EXISTS
function noindex_cpt_single() {
    if ( is_singular( array('ybnews','teammember','testimonial','ybevent') ) ) {
        return '<meta name="robots" content="noindex, follow">';
    }
}
add_action('wp_head', 'noindex_cpt_single');
?>