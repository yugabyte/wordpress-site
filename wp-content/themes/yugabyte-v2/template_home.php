<?php 
	/* Template Name: Home */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body class="home-demo">
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
						<?php if(have_rows('hero_title_repeater')) { ?>
							<ul class="col-lg-12 repeater top repeater-container">
								<?php while(have_rows('hero_title_repeater')) : the_row(); ?>
								<div class="item-container">
									<li class="item">
										<img class="item-logo" src="<?php the_sub_field('image'); ?>">
										<div class="item-title"><?php the_sub_field('item'); ?></div>
										<div class="item-subtext"><?php the_sub_field('subtext'); ?></div>
									</li>
								</div>
								<?php endwhile; ?>
								
							</ul>
						<?php } ?>
					</div>
				</div>
			</section>
			<section class="bg-grey">
				<div class="container community-metrics">
					<div class="row text-center">
						<?php if(have_rows('section_repeater')): ?>
							<?php while(have_rows('section_repeater')) : the_row(); ?>
								<div class="col-xs-12 col-md-6 card-content">
									<img src="<?php the_sub_field('community_image'); ?>" />	
									<div class="community-header">
										<h2><?php the_sub_field('community_title'); ?></h2>
										<div class="subtitle-text"><?php the_sub_field('community_subtitle'); ?></div>
									</div>

									<!-- <?php if(have_rows('community_section_repeater')): ?>
										<ul class="section-repeater">
											<?php while(have_rows('community_section_repeater')) : the_row(); ?>
												<li>
													<?php if(!empty(get_sub_field('card_image'))) { ?>
														<img class="logo" src="<?php the_sub_field('card_image'); ?>">
													<?php } ?>
													<div class="tile-title"><?php the_sub_field('card_title'); ?></div>
													<div class="tile-caption"><?php the_sub_field('card_caption'); ?></div>
												</li>
											<?php endwhile; ?>
										</ul>
									<?php endif; ?> -->
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
						<a target="_blank">See all success stories <span><i class="fa fa-chevron-right"></i></span></a>
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
