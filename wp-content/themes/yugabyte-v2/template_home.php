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
			<section class="homepage-hero" 
			<?php echo (get_field('responsive_bg')) ? 'data-responsivebg="'. get_field('responsive_bg') .'"' : '' ?> 
			style="background-image: url(<?php the_field('hero_background_image'); ?>);"
			data-fullbg="<?php the_field('hero_background_image'); ?>" >
				<div class="container">
					<div class="row">
						<div class="container">
							<div class="row">
								<div class="icon"><img src="<?php the_field('banner_icon'); ?>"></div>
								<div class="text">
									<a class="banner-link" href="<?php the_field('banner_link_url'); ?>">
										<b>News</b><?php the_field('banner_link_text'); ?><span>→</span>
									</a>
								</div>
							
								<div>
									<div class="hero-title-phrase"><?php the_field('hero_description_title'); ?></div>
									<div class="hero-subtext"><?php the_field('hero_description_subtext'); ?></div>
									<div class="email-contact"><?php echo do_shortcode( get_field('hero_email_cta') ); ?></div>
								</div>
							</div>
						</div>
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
				<div class="community-metrics">
					<div class="row text-center">
						<?php if(have_rows('section_repeater')): ?>
							<?php while(have_rows('section_repeater')) : the_row(); ?>
								<div class="col-xs-12 col-md-6 card-content">
									<div class="community-header">
										<h2><?php the_sub_field('community_title'); ?></h2>
										<h4><?php the_sub_field('community_subtitle'); ?></h4>
									</div>
									<img src="<?php the_sub_field('community_image'); ?>" />

									<?php if(have_rows('community_section_repeater')): ?>
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
									<?php endif; ?>
									<?php if(!empty(get_sub_field('community_hyperlink'))) { ?>
										<a class="community-hyperlink" href="<?php get_sub_field('community_hyperlink'); ?>" target="_blank">Yugabyte Community</a>
									<?php } ?>
								</div>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</div>
			</section>
			<section class="layers">
				<div class="figure-container">
					<h3>Service Control Platform</h3>
					<div class="row">
						<div>
							Visualization
							<ul class="feature-list-options">
								<li data-arc-id="12">VITALS</li>
								<li data-arc-id="13">MANAGER</li>
								<li data-arc-id="14">PORTAL</li>
							</ul>
						</div>
						<svg id="graphic"></svg>
						<div>
							Interpretation
							<ul class="feature-list-options">
								<li data-arc-id="6">IMMUNITY</li>
								<li data-arc-id="2">BRAIN</li>
								<li data-arc-id="9">OSS PLUGINS</li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<section class="value-prop">	
				<div class="content">
					<div class="value-header-container">
						<div class="title"><?php the_field('value_prop_title'); ?></div>
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
										<h4 class="tile-title"><?php the_sub_field('feature_name'); ?></h4>
										<div class="tile-caption"><?php the_sub_field('feature_description'); ?></div>
									</div>
								</div>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</div>
			</section>
			
			<section class="customers">
				<?php if(have_rows('customer_repeater_copy')): ?>
					<?php while(have_rows('customer_repeater_copy')) : the_row(); ?>
						<div class="case-study-wrapper">
							<div class="title-logo">
								<h4>Case Study</h4>
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
							<div class="case-study-link">
								<a href="/wp-content/uploads/2019/03/Narvar-YugaByte-DB-Case-Study.pdf">See Full Case Study</a>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>

				<!-- <div class="container" data-aos="zoom-in">
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<div class="section-title text-center"><?php the_field('customer_title'); ?></div>
						</div>
						<?php if(have_rows('customer_repeater')) { ?>
						<div class="row customer-holder d-flex it-blocks-holder">
							<?php while(have_rows('customer_repeater')) : the_row(); ?>
							<div class="col-lg-4">
								<div class="item block">
									<a href="<?php the_sub_field('url'); ?>">
										<div class="icon"><img src="<?php the_sub_field('image'); ?>"></div>
										<div class="text"><?php the_sub_field('text'); ?></div>
									</a>
								</div>
							</div>
							<?php endwhile; ?>
						</div>
						<?php } ?>					
					</div>
				</div> -->
			</section>

			</section>
		</div>

		<?php include(locate_template('template_parts/footer-cta.php')); ?>

		<?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html>
