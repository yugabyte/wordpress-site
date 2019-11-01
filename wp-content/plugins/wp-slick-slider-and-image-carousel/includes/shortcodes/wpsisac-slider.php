<?php 
function get_wpsisac_slider( $atts, $content = null ){          

    extract(shortcode_atts(array(
	    "limit"    			=> '-1',
		"category" 			=> '',
		"design" 			=> 'design-1',
		"image_size" 		=> 'full',	
		"show_content" 		=> 'true',       
		"dots"     			=> 'true',
		"arrows"     		=> 'true',
		"autoplay"     		=> 'true',	
		"autoplay_interval" => '3000',
		"speed"             => '300',
		"fade"		        => 'false',
		"sliderheight"     	=> '',
		"image_fit" 		=> 'true',
		"rtl"               => '',
	), $atts));	
	
	 
    $shortcode_designs 	= wpsisac_slider_designs();
	$limit 				= !empty($limit) 					? $limit 						: '-1';	
	$cat 				= (!empty($category)) 				? explode(',', $category) 		: '';	
	$design 			= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) : 'design-1';	
	$show_content 		= ( $show_content == 'false' ) 		? false 						: true;
	$dots 				= ( $dots == 'false' ) 				? 'false' 						: 'true';
	$arrows 			= ( $arrows == 'false' ) 			? 'false' 						: 'true';
	$autoplay 			= ( $autoplay == 'false' ) 			? 'false' 						: 'true';
	$autoplay_interval 	= (!empty($autoplay_interval)) 		? $autoplay_interval 			: 3000;
	$speed 				= (!empty($speed)) 					? $speed 						: 300;
	$fade 				= ( $fade == 'true' ) 				? 'true' 						: 'false';
	$image_fit			= ( $image_fit == 'false' )			? 0                             : 1;	
	$sliderheight 		= (!empty($sliderheight)) 			? $sliderheight 				: '';
	$slider_height_css 	= (!empty($sliderheight))			? "style='height:{$sliderheight}px;'" : '';
	$sliderimage_size 	= !empty($image_size) 				? $image_size 					: 'full';
	
	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}
	
	// Shortcode file
	$design_file_path 	= WPSISAC_VERSION_DIR . '/templates/' . $design . '.php';
	$design_file 		= (file_exists($design_file_path)) ? $design_file_path : '';
	
	
	// Enqueus required script
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'wpsisac-public-script' );
	
	// Taking some variables
	$image_fit_class = ( $image_fit ) 			? 'wpsisac-image-fit'		: '';
	
	// Slider configuration
	$slider_conf = compact('dots', 'arrows', 'autoplay', 'autoplay_interval', 'fade','speed', 'rtl');
	
	ob_start();	
	
	global $post;
	$unique 		= wpsisac_get_unique();
	$post_type 		= 'slick_slider';
	$orderby 		= 'post_date';
	$order 			= 'DESC';		

    $args = array ( 
        'post_type'      => $post_type, 
        'orderby'        => $orderby, 
        'order'          => $order,
        'posts_per_page' => $limit,  
       
        );
	if($cat != ""){
    	$args['tax_query'] = array( 
    						array( 	'taxonomy' 	=> 'wpsisac_slider-category', 
    								'field' 	=> 'id', 
    								'terms' 	=> $cat) );
    }        
    $query = new WP_Query($args);
    $post_count = $query->post_count;         
    if ( $query->have_posts() ) :
	?>
	<div class="wpsisac-slick-slider-wrp wpsisac-clearfix">
		<div id="wpsisac-slick-slider-<?php echo $unique; ?>" class="wpsisac-slick-slider <?php echo $design; ?> <?php echo $image_fit_class; ?>">
			<?php while ( $query->have_posts() ) : $query->the_post();		
			$slider_img 	= wpsisac_get_post_featured_image( $post->ID, $sliderimage_size, true );
					// Include shortcode html file
						if( $design_file ) {
							include( $design_file );
						}
				endwhile; ?>
		</div>	
		<div class="wpsisac-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
	</div>
	<?php
    endif; 
    wp_reset_query();
	return ob_get_clean();
}
add_shortcode('slick-slider','get_wpsisac_slider');