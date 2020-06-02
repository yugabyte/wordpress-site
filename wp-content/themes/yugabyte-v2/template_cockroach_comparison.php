<?php 
	/* Template Name: Cockroach Comparison */ 
?>

<!doctype html>
<html>
	<head>
        <?php include(locate_template('template_parts/main-head.php')); ?>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
	</head>

	<body>
    <?php include(locate_template('template_parts/main-header.php')); ?>
		
    <div class="comparison">
		<section class="banner-section" style="background-image: url('<?php the_field('hero_bg'); ?>');">
			<div class="centered container">
				<div class="centered">
					<h1 class="title"><?php the_field('hero_title'); ?></h1>
                    <div class="subtitle"><?php the_field('hero_subtitle'); ?></div>
				</div>
			</div>
		</section>
		<section class="advantages">
			<div class="centered container">
				<h2><?php the_field('advantages_section_title'); ?></h2>
				<div class="section-text">
                    <span class="orange-line"></span>
                    <?php the_field('advantages_desc'); ?>
                    <span class="orange-line"></span>
                </div>                             
            </div>
            <div class="container content-box">
                <ul class="value-prop-list">
                    <?php if(have_rows('value_prop_list_repeater')): ?>
                        <?php while(have_rows('value_prop_list_repeater')) : the_row(); ?>
                            <li>                                
                                <img class="icon" src="<?php the_sub_field('icon'); ?>" />                                    
                                <div class="description">
                                    <div class="item-label">
                                        <strong><?php echo get_row_index(); ?>.</strong>
                                        <?php the_sub_field('item_label'); ?>
                                    </div>
                                    <div class="item-text">
                                    <?php the_sub_field('item_text'); ?>
                                    </div>                                        
                                </div>                                    
                            </li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
            </div> 
		</section>
		<section class="performance">
			<div class="container">
                <h2 class="title"><?php the_field('performance_section_title'); ?></h2>
                <div class="note"><?php the_field('perf_note'); ?></div>			
                <?php if(have_rows('performance_repeater')): ?>
                    <ul class="performance-sections">
                        <?php while(have_rows('performance_repeater')) : the_row(); ?>
                            <li>                                
                                <h3><?php the_sub_field('group_title'); ?></h3>
                                <div class="graph-sequence">
                                    <?php if(have_rows('graph_repeater')): ?>
                                        <?php while(have_rows('graph_repeater')) : the_row(); ?>
                                            <img src="<?php the_sub_field('graph_image'); ?>" />
                                        <?php endwhile; ?>
                                    <?php endif; ?>                                    
                                </div>                                
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
			</div>
		</section>
        <section class="customers">
            <div class="container">
                <div class="content-box">
                    <div class="centered container">
                        <h2><?php the_field('customers_section_title'); ?></h2>
                        <div class="quote-image">“</div>
                        <div class="quote"><?php the_field('customer_quote'); ?></div>
                        <div class="logo-wall fit-content">
                            <?php while(have_rows('customer_logos_repeater')) : the_row(); ?>
                                <a class="logo" href="<?php the_sub_field('case_study_link'); ?>">
                                    <img src="<?php the_sub_field('customer_logo'); ?>" />
                                </a>
                            <?php endwhile; ?>
                        </div>
                        <a href="<?php the_field('stories_url'); ?>" class="button"><?php the_field('stories_text'); ?><i class="fa fa-caret-right link-icon"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="features">
            <div class="centered container">
                <h2><?php the_field('feature_section_title'); ?></h2>
                <div class="feature-subtitle"><?php the_field('feature_section_subtitle'); ?></div>
                <div><?php echo do_shortcode('[table id=4 /]'); ?></div>
                <div class="table-note"><?php the_field('table_note'); ?></div>
            </div>
		</section>
		<section class="footer-cta dark footer-video">
			<div class="centered">
				<h2 class="video-header"><?php the_field('footer_header'); ?></h2>
                <!-- <div class="message-text"><?php the_field('footer_text'); ?></div> -->
                 <div class="video-wrapper">
                    <div class="demo-video" style="width: auto;">
                        <?php the_field('event_vod'); ?>
                        <img class="play-btn" src="<?php the_field('play_button'); ?>" />
                    </div>
                </div>
			</div>
		</section>
        <section class="form-download vc_section">
            <div class="container">
                <h2><?php the_field('form_header'); ?></h2>
                <div class="cf7-form">
                    <?php echo do_shortcode( '[contact-form-7 id="1581" title="YugaByte vs CockroachDB Demo Request"]' ); ?>
                </div>
            </div>
        </section>
    </div>
    <div id="video-modal" class="modal image-modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="image-container"></div>
        </div>
    </div>
    <?php include(locate_template('template_parts/footer-cta.php')); ?>
    <?php include(locate_template('template_parts/main-footer.php')); ?>
	<?php include(locate_template('template_parts/main-scripts.php')); ?>	
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>	
	</body>
</html>