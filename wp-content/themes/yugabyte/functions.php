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
    
    add_image_size( 'fw-mobile-home', 767, 1000, true);
    add_image_size( 'fw-x-large-home', 1920, 1200, true );
    
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
		
	wp_enqueue_style('yugabyte-style', get_stylesheet_directory_uri().'/assets/css/dist/screen.min.css');
    //wp_enqueue_style( 'dashicons' );
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
	return $buttons;
}
add_filter('mce_buttons', 'mce_sub_sup');

function constrain_mce_editor( $init ) {
    
    $default_colours = '"000000", "Black", "ffffff", "White", "2b59c3", "Blue", "4ecd5f", "Green", "ff6e42", "Orange", "000041", "Purple Dark", "332a66", "Purple", "141920", "Nearly Black", "4d4647", "Gray Dark", "707070", "Gray", "e8e9f3", "Gray Light", "eef1fa", "Light Blue"';
    $init['textcolor_map'] = '['.$default_colours.']';
    
    $style_formats = array(
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
	
	/*register_sidebar( array(
        'name'          => __( 'TODO Sidebar', 'darrigo' ),
        'id'            => 'sidebar-TODO',
        'description'   => __( 'Add widgets here to appear in your sidebar.', 'darrigo' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );*/
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
    echo '@media screen and (min-width: 1000px) {'.$el.'{background-image: url('.$fw_image_1024.')}}';
    echo '@media screen and (min-width: 1400px) {'.$el.'{background-image: url('.$fw_image_1600.')}}';
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
    
    /*if( is_home() || is_front_page() ):
        
        $subtitle = get_field('subtitle');
        $about_summary = get_field('about_summary');
        $about_ct = get_field('about_ct');
        $about_ct_btn_txt = get_field('about_ct_btn_txt');
        
        $el = '#hero_top';
        //generate_fw_thumbs($hero_image, $el);
        
        $fw_image_mobile = $hero_image['sizes']['fw-mobile-home'];
        $fw_image_desktop = $hero_image['sizes']['fw-x-large-home'];
        
        echo '<style>';
        echo $el.'{background-image:url('.$fw_image_mobile.')}';
        echo '@media screen and (min-width: 768px) {'.$el.'{background-image:url('.$fw_image_desktop.')}}';
        echo '</style>';
        
        echo '<div id="hero" class="content_section">';
            echo '<div class="content_section_inner full nopadding">';
                echo '<div id="hero_top">';
                    echo '<div class="pink_border"></div>';
                    echo '<div class="inner">';
                    echo '<h1>'.$title.'<span class="period">.</span></h1>';
                    echo '</div>';
                echo '</div>';
                echo '<div id="hero_bottom">';
                    echo '<div class="inner">';
                        echo '<div class="grid nopadding">';
                            echo '<div class="col-8-12 tablet-col-7-12 left">';
                            if( $subtitle ) {
                                echo '<p class="subtitle">'.$subtitle.'</p>';
                            }
                            echo '</div>';
                            echo '<div class="col-4-12 tablet-col-5-12 right">';
                            if( $about_summary ) {
                                echo '<p class="summary">'.$about_summary.'</p>';
                                if( $about_ct ) {
                                    echo '<a class="btn dark" href="'.$about_ct.'">'.$about_ct_btn_txt.'</a>';
                                }
                            }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    */
    //else:
        
        $el = '#hero';
        generate_fw_thumbs($hero_image, $el);
        echo '<div id="hero" class="content_section">';
        echo '<div class="content_section_inner nopadding">';
            echo '<div class="inner">';
            echo '<div class="inner_content">';
            echo '<h1>'.$title.'</h1>';
            if( $subheading ) {
                echo '<p class="subheading">'.$subheading.'</p>';
            }
            
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
    echo '<div class="content_section_inner nopadding">';
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



?>