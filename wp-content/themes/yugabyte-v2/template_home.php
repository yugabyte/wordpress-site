<?php 
	/* Template Name: Home */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body>
		<?php include(locate_template('template_parts/main-header.php')); ?>
		
		<div class="home">
			<section class="homepage-hero">
				<div class="container">
					<div class="row">
						<div class="container col-lg-6">
							<div class="row">
								<div class="icon"><img src="<?php the_field('banner_icon'); ?>"></div>
								<div class="text">
									<a class="banner-link" href="<?php the_field('banner_link_url'); ?>">
										<b>News</b><?php the_field('banner_link_text'); ?><span>→</span>
									</a>
								</div>
							
								<div>
									<h2 class="hero-title-phrase"><?php the_field('hero_description_title'); ?></h2>
									<div class="hero-subtext"><?php the_field('hero_description_subtext'); ?></div>
									<div class="email-contact"><?php echo do_shortcode( get_field('hero_email_cta') ); ?></div>
								</div>
							</div>
						</div>
						<div class="container col-lg-6">
							<div class="hero-bg-image">
								<img src="<?php the_field('hero_background_image'); ?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<ul class="col-lg-12 repeater top repeater-container">
							<div class="item-container">
								<li class="item latency-tile">
									<div id="latency-animation">
										<div class="latency">
											<div class="box square-left"></div>
											<div class="box square-right"></div>
										</div>
									</div>
									<div class="item-title">Single-Digit Millisecond Latency</div>
									<div class="item-subtext">Build blazing fast applications in the cloud and serve queries directly from the DB</div>
								</li>
							</div>
							<div class="item-container">
								<li class="item scale-tile">
									<div id="new-node-animation">
										<div class="box"></div>
										<div class="animation">
											<img src="http://localhost:8888/wp-content/uploads/2019/12/database-1.svg" width="40" height="40" />
											<img src="http://localhost:8888/wp-content/uploads/2019/12/database-1.svg" width="40" height="40" />
											<img src="http://localhost:8888/wp-content/uploads/2019/12/database-1.svg" width="40" height="40" />
											<img class="newNode" src="http://localhost:8888/wp-content/uploads/2019/12/database-1.svg" width="40" height="40" />
										</div>
									</div>
									<div class="item-title">Massive Scale</div>
									<div class="item-subtext">Achieve millions of transactions per second and store multiple TB’s of data per node</div>
								</li>
							</div>
							<div class="item-container" style="padding: 20px 50px 50px;">
								<li class="item">
									<div class="global-animation">
										<svg class="globe-line" width="120" height="100" xmlns="http://www.w3.org/2000/svg">
											<path class="path-clockwise" d="M 33, 37 a 50,10 40 1 1 50 42" stroke-width="2" stroke="#FF6E42" fill="transparent" stroke-linejoin="round" stroke-miterlimit="10" 
											/>
											<path class="path-counterclockwise" d="M 85, 37 a 50 10 138 1,0 -45 42" stroke="#FF6E42" stroke-width="2" fill="transparent" stroke-linejoin="round" stroke-miterlimit="10" 
											/>
										</svg>
									</div>
									<div class="item-title">Geo-Distribution</div>
									<div class="item-subtext">Deploy across regions and clouds with synchronous or multi-master replication</div>
								</li>
							</div>
						</ul>
					</div>
				</div>
			</section>
			<section class="bg-grey">
				<div class="container community-metrics">
					<div class="row text-center">
						<?php if(have_rows('section_repeater')): ?>
							<?php while(have_rows('section_repeater')) : the_row(); ?>
								<div class="col-xs-12 col-md-6 card-content">
									<div class="community-header">
										<h2><?php the_sub_field('community_title'); ?></h2>
										<div class="subtitle-text"><?php the_sub_field('community_subtitle'); ?></div>
									</div>
									<img class="main-illustration" src="<?php the_sub_field('community_image'); ?>" />
									<div class="metrics-header"><?php the_sub_field('metrics_caption'); ?></div>
									<?php if(have_rows('community_section_repeater')): ?>
										<div class="row">
										<?php while(have_rows('community_section_repeater')) : the_row(); ?>
											<div class="metric-wrapper">
												<?php if(!empty(get_sub_field('card_image'))) { ?>
													<img height="25" src="<?php the_sub_field('card_image'); ?>" />
												<?php } ?>
												<div class="metric-stat"><?php the_sub_field('card_title'); ?></div>
												<span class="metric-unit"><?php the_sub_field('card_caption'); ?></span>
											</div>
										<?php endwhile; ?>
										</div>
									<?php endif; ?>
									<?php if(!empty(get_sub_field('community_hyperlink'))) { ?>
										<a class="more-info-link" href="<?php get_sub_field('community_hyperlink'); ?>" target="_blank">
											Learn More <span><i class="fa fa-chevron-right"></i></span>
										</a>
									<?php } ?>
								</div>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</div>
			</section>
			<section class="layers">
				<div class="value-prop">
					<div class="value-header-container">
						<h2 class="title"><?php the_field('value_prop_title'); ?></h2>
						<div class="description"><?php the_field('value_prop_desc'); ?></div>
					</div>
					<div class="value-prop-list">
						<?php if(have_rows('value_prop_repeater')): ?>
							<?php while(have_rows('value_prop_repeater')) : the_row(); ?>
								<div class="row">
									<div class="col-3 col-xs-12 text-right">
										<img class="feature-icon" src="<?php the_sub_field('feature_icon'); ?>">
									</div>
									<div>
										<div class="tile-title"><?php the_sub_field('feature_name'); ?></div>
										<div class="tile-caption"><?php the_sub_field('feature_description'); ?></div>
									</div>
								</div>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</div>
			</section>
			<section class="demo-banner">
				<div class="container">
					<div class="cta-wrapper">
						<h3>Take a test drive</h3>
						<div class="text-content">Avoid cloud lock-in with an enterprise-grade, cloud-native, open-source database.</div>
						<div class="email-contact"><?php echo do_shortcode( get_field('hero_email_cta') ); ?></div>
						<div class="more-info-link">
							<a href="" target="_blank">Or learn more <span><i class="fa fa-chevron-right"></i></span></a>
						</div>
					</div>
				</div>
			</section>
			<section class="customers">
				<div class="container">
					<h2 class="section-header"><?php the_field('demo_banner_title'); ?></h2>
					<div class="row case-study-wrapper">
						<?php if(have_rows('customer_repeater_copy')): ?>
							<?php while(have_rows('customer_repeater_copy')) : the_row(); ?>
								<div class="customer-card">
									<div class="title-logo">
										<img src="<?php the_sub_field('customer_logo'); ?>" />
									</div>
									<div class="customer-testimonial"><?php the_sub_field('testimonial'); ?></div>
									<div class="customer-advocate">
										<img class="profile-pic" src="<?php the_sub_field('profile_picture'); ?>"/>
										<div class="customer-details">
											<b><?php the_sub_field('customer_name'); ?></b>
											<div class="customer-position"><?php the_sub_field('customer_position'); ?></div> 
											</div>
									</div>
									<div class="more-info-link">
										<a href="/wp-content/uploads/2019/03/Narvar-YugaByte-DB-Case-Study.pdf">Read more <span><i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
					<div class="success-stories-wrapper more-info-link">
						<a href="/success-stories">See more success stories <span><i class="fa fa-chevron-right"></i></span></a>
					</div>
				</div>
			</section>

			</section>
		</div>

		<?php include(locate_template('template_parts/footer-cta.php')); ?>

		<?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html>
