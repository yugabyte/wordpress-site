<?php
/***********************************************/
/**** PAGE BLOCKS ******************************/
/***********************************************/
function create_yb_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'yugabyte-blocks',
				'title' => __( 'Yugabyte Blocks', 'yugabyte-blocks' ),
			),
			array(
				'slug' => 'yugabyte-ss-blocks',
				'title' => __( 'Yugabyte Success Story Blocks', 'yugabyte-ss-blocks' ),
			),
		)
	);
}
add_filter( 'block_categories', 'create_yb_block_category', 10, 2);

add_action('acf/init', 'custom_acf_blocks_init');
function custom_acf_blocks_init() {

    if( function_exists('acf_register_block_type') ) {
        
        //WP TABLE BUILDER TABLE
        acf_register_block_type(array(
            'name'              => 'wptb_table',
            'title'             => __('Comp Table'),
            'description'       => __('Wrapper and shortcode for inserting a WPTableBuilder table'),
            'render_template'   => 'template-parts/blocks/wptb_table.php',
            'category'          => 'yugabyte-blocks',
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
        
        //BASIC CTA BUCKETS
        acf_register_block_type(array(
            'name'              => 'cta_buckets',
            'title'             => __('CTA Buckets'),
            'description'       => __('Basic CTA buckets: heading, summary, CTA'),
            'render_template'   => 'template-parts/blocks/cta_buckets.php',
            'category'          => 'yugabyte-blocks',
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
            'category'          => 'yugabyte-blocks',
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
        
        //2 COL TESTIMONIAL/CONTENT
        acf_register_block_type(array(
            'name'              => 'testimonial_content',
            'title'             => __('Two Column Testimonial and Content'),
            'description'       => __('Standard two-column, 50-50 Testimonial and Content'),
            'render_template'   => 'template-parts/blocks/testimonial_content.php',
            'category'          => 'yugabyte-blocks',
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
        
        //2 COL LOGOS/CONTENT
        acf_register_block_type(array(
            'name'              => 'content_logos',
            'title'             => __('Two Column Content and Logos Group'),
            'description'       => __('Standard two-column, 50-50 Content and Logos Group'),
            'render_template'   => 'template-parts/blocks/content_logos.php',
            'category'          => 'yugabyte-blocks',
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
        
        //TEAM GRID
        acf_register_block_type(array(
            'name'              => 'team_grid',
            'title'             => __('Team Grid'),
            'description'       => __('Grid of Team Members'),
            'render_template'   => 'template-parts/blocks/team_grid.php',
            'category'          => 'yugabyte-blocks',
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
        
        //LOGO GRID
        acf_register_block_type(array(
            'name'              => 'logo_grid',
            'title'             => __('Logo Grid'),
            'description'       => __('Grid of Logos, 4-up'),
            'render_template'   => 'template-parts/blocks/logo_grid.php',
            'category'          => 'yugabyte-blocks',
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
        
        //FULL-WIDTH CTA
        acf_register_block_type(array(
            'name'              => 'fw_cta',
            'title'             => __('Full-Width CTA'),
            'description'       => __('Full-width block, heading, social links, multiple CTA buttons'),
            'render_template'   => 'template-parts/blocks/fw_cta.php',
            'category'          => 'yugabyte-blocks',
            'post_types' => array('page','success-story'),
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
            'category'          => 'yugabyte-blocks',
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
        
        /****************************************/
        /*** SUCCESS STORY BLOCKS ***************/
        /****************************************/
        
        //SS: AT A GLANCE
        acf_register_block_type(array(
            'name'              => 'ss_at_a_glance',
            'title'             => __('Success Story: At A Glance'),
            'description'       => __('icon-ed buckets, optional company bullets or results'),
            'render_template'   => 'template-parts/blocks/ss_at_a_glance.php',
            'category'          => 'yugabyte-ss-blocks',
            'post_types' => array('page','success-story'),
            'align' => false,
            'mode' => 'edit',
            'supports'          => array(
                'align' => false,
                'anchor' => true,
                'alignWide' => false,
                'html' => false,
            ),
        ));
        
        //SS: BUSINESS AND TECHNICAL RESULTS
        acf_register_block_type(array(
            'name'              => 'ss_biz_tech_results',
            'title'             => __('Success Story: Business and Technical Results'),
            'description'       => __('Business and technical results, together, two columns of bullets'),
            'render_template'   => 'template-parts/blocks/ss_biz_tech_results.php',
            'category'          => 'yugabyte-ss-blocks',
            'post_types' => array('page','success-story'),
            'align' => false,
            'mode' => 'edit',
            'supports'          => array(
                'align' => false,
                'anchor' => true,
                'alignWide' => false,
                'html' => false,
            ),
        ));
        
        //SS: CHALLENGES
        acf_register_block_type(array(
            'name'              => 'ss_challenges',
            'title'             => __('Success Story: Challenges'),
            'description'       => __('Icon and open content, stylized'),
            'render_template'   => 'template-parts/blocks/ss_challenges.php',
            'category'          => 'yugabyte-ss-blocks',
            'post_types' => array('page','success-story'),
            'align' => false,
            'mode' => 'edit',
            'supports'          => array(
                'align' => false,
                'anchor' => true,
                'alignWide' => false,
                'html' => false,
            ),
        ));
        
        //SS: ALTERNATING CONTENT ROWS
        acf_register_block_type(array(
            'name'              => 'ss_content_rows',
            'title'             => __('Success Story: Alternating Content Rows'),
            'description'       => __('Alternating (flipped) rows of site content (post, video, file, image, etc) and description/teaser'),
            'render_template'   => 'template-parts/blocks/ss_content_rows.php',
            'category'          => 'yugabyte-ss-blocks',
            'post_types' => array('page','success-story'),
            'align' => false,
            'mode' => 'edit',
            'supports'          => array(
                'align' => false,
                'anchor' => true,
                'alignWide' => false,
                'html' => false,
            ),
        ));
        
        //SS: DATABASE REQUIREMENTS
        acf_register_block_type(array(
            'name'              => 'ss_db_requirements',
            'title'             => __('Success Story: Database Requirements'),
            'description'       => __('Icon and open content, stylized'),
            'render_template'   => 'template-parts/blocks/ss_db_requirements.php',
            'category'          => 'yugabyte-ss-blocks',
            'post_types' => array('page','success-story'),
            'align' => false,
            'mode' => 'edit',
            'supports'          => array(
                'align' => false,
                'anchor' => true,
                'alignWide' => false,
                'html' => false,
            ),
        ));
        
        //SS: TWO-COLUMN IMAGE AND CONTENT
        acf_register_block_type(array(
            'name'              => 'ss_image_content',
            'title'             => __('Success Story: Two-Column Image Content'),
            'description'       => __('Two-column image and content, optional heading above'),
            'render_template'   => 'template-parts/blocks/ss_image_content.php',
            'category'          => 'yugabyte-ss-blocks',
            'post_types' => array('page','success-story'),
            'align' => false,
            'mode' => 'edit',
            'supports'          => array(
                'align' => false,
                'anchor' => true,
                'alignWide' => false,
                'html' => false,
            ),
        ));
        
        //SS: TECHNICAL RESULTS
        acf_register_block_type(array(
            'name'              => 'ss_tech_results',
            'title'             => __('Success Story: Technical Results'),
            'description'       => __('Standalone technical results, large numbers and small text'),
            'render_template'   => 'template-parts/blocks/ss_tech_results.php',
            'category'          => 'yugabyte-ss-blocks',
            'post_types' => array('page','success-story'),
            'align' => false,
            'mode' => 'edit',
            'supports'          => array(
                'align' => false,
                'anchor' => true,
                'alignWide' => false,
                'html' => false,
            ),
        ));
        
        //SS: TESTIMONIALS
        acf_register_block_type(array(
            'name'              => 'ss_testimonials',
            'title'             => __('Success Story: Testimonials'),
            'description'       => __('One or two testimonial quotes, one or two citation blocks'),
            'render_template'   => 'template-parts/blocks/ss_testimonials.php',
            'category'          => 'yugabyte-ss-blocks',
            'post_types' => array('page','success-story'),
            'align' => false,
            'mode' => 'edit',
            'supports'          => array(
                'align' => false,
                'anchor' => true,
                'alignWide' => false,
                'html' => false,
            ),
        ));
        
        //SS: YUGABYTE SOLUTION
        acf_register_block_type(array(
            'name'              => 'ss_yb_solution',
            'title'             => __('Success Story: Yugabyte Solution'),
            'description'       => __('Icon-ed buckets, max 5'),
            'render_template'   => 'template-parts/blocks/ss_yb_solution.php',
            'category'          => 'yugabyte-ss-blocks',
            'post_types' => array('page','success-story'),
            'align' => false,
            'mode' => 'edit',
            'supports'          => array(
                'align' => false,
                'anchor' => true,
                'alignWide' => false,
                'html' => false,
            ),
        ));
        
        //CURRENT (LEVER.CO) JOB POSTINGS
        acf_register_block_type(array(
            'name'              => 'job_openings',
            'title'             => __('Lever Job Openings'),
            'description'       => __('Simple toggle for inserting the current Lever.co job openings'),
            'render_template'   => 'template-parts/blocks/job_openings.php',
            'category'          => 'yugabyte-blocks',
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
        
        //ICONS + LABELS, 3-UP GRID
        acf_register_block_type(array(
            'name'              => 'icon_label_grid',
            'title'             => __('Icon/Label Grid'),
            'description'       => __('Three column grid of icons and labels'),
            'render_template'   => 'template-parts/blocks/icon_label_grid.php',
            'category'          => 'yugabyte-blocks',
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
        
        //IMAGE GALLERY SLIDER
        acf_register_block_type(array(
            'name'              => 'image_slider',
            'title'             => __('Image Gallery Slider'),
            'description'       => __('Gallery of images slider'),
            'render_template'   => 'template-parts/blocks/image_slider.php',
            'category'          => 'yugabyte-blocks',
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
        
        //OUR VALUES
        acf_register_block_type(array(
            'name'              => 'our_values',
            'title'             => __('Our Values'),
            'description'       => __('Left-aligned heading/subhead, two-column grid of wysiwyg content (ex: Careers->Who We Are Values)'),
            'render_template'   => 'template-parts/blocks/our_values.php',
            'category'          => 'yugabyte-blocks',
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
        
        //BLOG PICKER
        acf_register_block_type(array(
            'name'              => 'blog_picker',
            'title'             => __('Blog Post Picker'),
            'description'       => __('Set (max 3) blog posts to feature'),
            'render_template'   => 'template-parts/blocks/blog_picker.php',
            'category'          => 'yugabyte-blocks',
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
        
        //NARROW, SINGLE-COLUMN WYSIWYG - THIS IS EXCLUSIVELY FOR ANCILLARY PAGES SUCH AS SUPPORT POLICY
        acf_register_block_type(array(
            'name'              => 'narrow_wysiwyg',
            'title'             => __('Narrow, Single-Column WYSIWYG'),
            'description'       => __('Exclusive narrow-column content editor, for ancillary pages such as Support Policy'),
            'render_template'   => 'template-parts/blocks/narrow_wysiwyg.php',
            'category'          => 'yugabyte-blocks',
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