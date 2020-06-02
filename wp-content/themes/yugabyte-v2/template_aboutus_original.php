<?php 
	/* Template Name: About Us */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body>
		<?php include(locate_template('template_parts/main-header.php')); ?>
		
		<div class="about">
			<section class="hero" style="background: url(<?php the_field('hero_background_image'); ?>)no-repeat center top;background-size:cover;">
				<div class="container">
					<div class="row hero-content">
						<div class="col">
							<h1 class="title"><?php the_field('hero_title'); ?></h1>
							<div class="copy"><?php the_field('hero_copy'); ?></div>
							<div class="button-container">
								<a href="<?php the_field('hero_button_link'); ?>" class="button slide-in">
									<span class="text"><?php the_field('hero_button_text'); ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</section>

			<?php if(have_rows('hero_banner_repeater')) { ?>
			<section class="hero-banner orange">
				<div class="container">
					<div class="row">
						<?php while(have_rows('hero_banner_repeater')) : the_row(); ?>
						<div class="col item">
							<a href="#us-<?php the_row_index(); ?>">
								<div class="title"><?php the_sub_field('title'); ?></div>
							</a>
						</div>
						<?php endwhile; ?>
					</div>
				</div>
			</section>
			<?php } ?>

			<section id="team" class="about-main team">
				<div class="container" data-aos="zoom-in">
					<div id="us-1" class="wrapper one">
						<div class="row">
							<div class="col">
								<div class="section-title"><?php the_field('block_1_title'); ?></div>
							</div>
						</div>
						<?php if(have_rows('block_1_repeater')) { ?>
						<div class="row item-container">
							<?php while(have_rows('block_1_repeater')) : the_row(); ?>
								<div class="item col-lg-3">
									<div class="image"><img src="<?php the_sub_field('image'); ?>"></div>
									<div class="main-title"><?php the_sub_field('main_title'); ?></div>
									<div class="subtitle"><?php the_sub_field('subtitle'); ?></div>
									<div class="social">
										<div class="button">
											<a href="<?php the_sub_field('twitter'); ?>">
												<i class="fab fa-twitter"></i>
											</a>
										</div>
										<div class="button">
											<a href="<?php the_sub_field('linkedin'); ?>">
												<i class="fab fa-linkedin-in"></i>
											</a>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</section>

			<section class="about-main board">
				<div class="container" data-aos="zoom-in">
					<div id="us-2" class="wrapper two">
						<div class="row">
							<div class="col">
								<div class="section-title"><?php the_field('block_2_title'); ?></div>
							</div>
						</div>
						<?php if(have_rows('block_2_repeater')) { ?>
						<div class="row item-container">
							<?php while(have_rows('block_2_repeater')) : the_row(); ?>
								<div class="item col-lg-3">
									<div class="image"><img src="<?php the_sub_field('image'); ?>"></div>
									<div class="main-title"><?php the_sub_field('main_title'); ?></div>
									<div class="subtitle"><?php the_sub_field('subtitle'); ?></div>
									<div class="social">
										<div class="button">
											<a href="<?php the_sub_field('twitter'); ?>">
												<i class="fab fa-twitter"></i>
											</a>
										</div>
										<div class="button">
											<a href="<?php the_sub_field('linkedin'); ?>">
												<i class="fab fa-linkedin-in"></i>
											</a>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</section>

			<section class="about-main advisors">
				<div class="container" data-aos="zoom-in">
					<div id="us-3" class="wrapper three">
						<div class="row">
							<div class="col">
								<div class="section-title"><?php the_field('block_3_title'); ?></div>
							</div>
						</div>
						<?php if(have_rows('block_3_repeater')) { ?>
						<div class="row item-container">
							<?php while(have_rows('block_3_repeater')) : the_row(); ?>
								<div class="item col-lg-3">
									<div class="image"><img src="<?php the_sub_field('image'); ?>"></div>
									<div class="main-title"><?php the_sub_field('main_title'); ?></div>
									<div class="subtitle"><?php the_sub_field('subtitle'); ?></div>
									<div class="social">
										<div class="button">
											<a href="<?php the_sub_field('twitter'); ?>">
												<i class="fab fa-twitter"></i>
											</a>
										</div>
										<div class="button">
											<a href="<?php the_sub_field('linkedin'); ?>">
												<i class="fab fa-linkedin-in"></i>
											</a>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</section>

			<section class="block four more-orange">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="main-title"><?php the_field('title_4'); ?></div>
						</div>
						<div class="col-lg-12 item-holder">

						<?php while(have_rows('item_repeater')) : the_row(); ?>
							<a href="<?php the_sub_field('link_url'); ?>">
								<div class="item">
									<div class="icon">
										<img src="<?php the_sub_field('icon'); ?>">
									</div>
									<div class="text"><?php the_sub_field('link_text'); ?></div>
								</div>
							</a>
						<?php endwhile; ?>

						</div>
					</div>
				</div>
			</section>
		</div>

		<?php include(locate_template('template_parts/footer-cta.php')); ?>

		<?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html>