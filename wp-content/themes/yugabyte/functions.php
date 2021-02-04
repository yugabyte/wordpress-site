<?php
require_once('inc/custom-post-type.php');

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
    echo '@media screen and (min-width: 1300px) {'.$el.'{background-image: url('.$fw_image_1024.')}}';
    echo '@media screen and (min-width: 1600px) {'.$el.'{background-image: url('.$fw_image_1600.')}}';
    echo '</style>';
}

function set_hero() {
    $post = get_queried_object();
    $hero_image_id = get_post_thumbnail_id( $post->ID );
    $hero_image = get_all_featured_image_sizes($hero_image_id);
    $title = get_the_title();
    
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

/***********************************************/
/**** PAGE BLOCKS ******************************/
/***********************************************/

add_action('acf/init', 'custom_acf_blocks_init');
function custom_acf_blocks_init() {

    if( function_exists('acf_register_block_type') ) {
        
        //WP TABLE BUILDER TABLE
        acf_register_block_type(array(
            'name'              => 'wptb_table',
            'title'             => __('Comp Table'),
            'description'       => __('Wrapper and shortcode for inserting a WPTableBuilder table'),
            'render_template'   => 'template-parts/blocks/wptb_table.php',
            'category'          => 'formatting',
            'post_types' => array('page'),
            'align' => false,
            'mode' => 'edit',
            'supports'          => array(
                'align' => false,
                'anchor' => true,
                'alignWide' => false,
                'html' => false,
            ),
        ));
        
        //2 COL IMAGE/CONTENT
        acf_register_block_type(array(
            'name'              => 'image_content',
            'title'             => __('Two Column Image and Content'),
            'description'       => __('Standard two-column, 50-50 Image and Content'),
            'render_template'   => 'template-parts/blocks/image_content.php',
            'category'          => 'formatting',
            'post_types' => array('page'),
            'align' => false,
            'mode' => 'edit',
            'supports'          => array(
                'align' => false,
                'anchor' => true,
                'alignWide' => false,
                'html' => false,
            ),
        ));
        
        //FULL-WIDTH CUSTOMER TESTIMONIAL
        acf_register_block_type(array(
            'name'              => 'testimonial',
            'title'             => __('Customer Testimonial'),
            'description'       => __('Full-width, DNY blue background, customer logo and testimonial'),
            'render_template'   => 'template-parts/blocks/testimonial.php',
            'category'          => 'formatting',
            'post_types' => array('page'),
            'align' => false,
            'mode' => 'edit',
            'supports'          => array(
                'align' => false,
                'anchor' => true,
                'alignWide' => false,
                'html' => false,
            ),
        ));
    }
}

?>