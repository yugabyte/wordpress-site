<div class="rp4wp-related-posts rp4wp-related-<?php echo esc_attr( $post_type ); ?>">

	<?php
	if ( '' != $heading_text ) {
		$heading = '<h4>' . $heading_text . '</h4>';
		echo apply_filters( 'rp4wp_heading', $heading );
	}
	?>
	<ul class="rp4wp-posts-list clearfix">
		<?php
		global $post;
		$o_post      = $post;
		$row_counter = 0;
		
		foreach ( $related_posts as $post ) {
			// Setup the postdata
			setup_postdata( $post );
			
			//META
            $custom_title = get_field('custom_title');
            $title = ( $custom_title ) ? $custom_title : get_the_title();
            $link = get_permalink();
            
            //PUBLISH DATE
            $date = get_the_date();
            $date_formatted = date('F j, Y', strtotime($date));
            
            $cpt = get_post_type($post->ID);
            
            if( ucfirst($cpt) == 'Post' ) {
                $cpt = 'article';
            }
			
			echo '<li class="scrollnimate">';
			echo '<a class="cont thumb" href="'.esc_url( $link ).'">';
            if( has_post_thumbnail() ) {
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
                echo '<div class="img" style="background-image:url('.$thumb[0].');"></div>';
            } else {
                echo '<div class="img" style="background-image:url('.get_stylesheet_directory_uri().'/assets/images/default-blog-thumbnail.jpg);"></div>';
            }
            echo '</a>';
			
	        echo '<h5><a href="'.$link.'">'.$title.'</a></h5>';
	        echo '<p class="nomargin">'.$date_formatted.'</p>';
            echo '</li>';
		}
		$post = $o_post;
		wp_reset_postdata();
		?>
	</ul>
</div>