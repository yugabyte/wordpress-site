<?php 
	/* Template Name: Comparison 2 */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body>
		<?php include(locate_template('template_parts/main-header.php')); ?>
		
		<div class="community use-case-template comparison2-template">
			<section class="hero-container">
				<div class="hero" style="background-image: url(<?php the_field('hero_background_image'); ?>);">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 logo-container">
								<img src="<?php the_field('hero_logo'); ?>">
							</div>
							<div class="col-lg-12">
								<h1 class="title"><?php the_field('hero_title'); ?></h1>
								<div class="title subtitle"><?php the_field('hero_subtitle'); ?></div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<?php if(have_rows('hero_banner_repeater')) { ?>
			<section class="hero-banner">
				<div class="container">
					<div class="row">
						<?php while(have_rows('hero_banner_repeater')) : the_row(); ?>
						<div class="col">
							<a href="#ce-2">
								<div class="title clearfix">
									<div class="icon">
										<img src="<?php the_sub_field('icon'); ?>">
									</div>
									<span class="l-to-r"><?php the_sub_field('title'); ?></span>
								</div>
							</a>
						</div>
						<?php endwhile; ?>
					</div>
				</div>
			</section>
			<?php } ?>

			<section class="it-blocks">
				<div class="container" data-aos="zoom-in">
					<div class="row d-flex justify-content-center">
						<div class="col-lg-12">
							<div class="section-title text-center"><?php the_field('it_title'); ?></div>
						</div>
						<?php if(have_rows('it_repeater')) { ?>
						<div class="row it-blocks-holder d-flex">
							<?php while(have_rows('it_repeater')) : the_row(); ?>
							<div class="col-lg block item">
								<div class="icon"><img src="<?php the_sub_field('image'); ?>"></div>
								<div class="title text-center"><?php the_sub_field('title'); ?></div>
								<div class="copy"><?php the_sub_field('copy'); ?></div>
							</div>
							<?php endwhile; ?>
						</div>
						<?php } ?>

						<div class="col-lg-12 secondary-title-holder">
							<div class="section-title text-center"><?php the_field('it_second_title'); ?></div>
						</div>
					</div>
				</div>
			</section>

			<section class="it-blocks two" id="ce-2">
				<div class="container" data-aos="zoom-in">
					<div class="row d-flex justify-content-center">
						<div class="col-lg-12">
							<div class="section-title text-center"><?php the_field('it_title_2'); ?></div>
						</div>
						<?php if(have_rows('it_repeater_2')) { ?>
						<div class="row it-blocks-holder d-flex">
							<?php while(have_rows('it_repeater_2')) : the_row(); ?>
							<div class="col-lg block item">
								<div class="icon"><img src="<?php the_sub_field('image'); ?>"></div>
								<div class="title text-center"><?php the_sub_field('title'); ?></div>
								<div class="copy"><?php the_sub_field('copy'); ?></div>
							</div>
							<?php endwhile; ?>
						</div>
						<?php } ?>

						<div class="col-lg-12 secondary-title-holder">
							<div class="section-title text-center"><?php the_field('it_second_title_2'); ?></div>
						</div>
					</div>
				</div>
			</section>

			<section class="it-blocks three">
				<div class="container" data-aos="zoom-in">
					<div class="row d-flex justify-content-center">
						<div class="col-lg-12 title-box">
							<div class="section-title text-center no-margin"><?php the_field('it_title_3'); ?></div>
							<div class="section-subtext"><?php the_field('it_copy_3'); ?></div>
						</div>
						<?php if(have_rows('it_repeater_3')) { ?>
						<div class="row it-blocks-holder d-flex">
							<?php while(have_rows('it_repeater_3')) : the_row(); ?>
							<div class="col-lg block item">
								<div class="icon"><img src="<?php the_sub_field('image'); ?>"></div>
								<div class="title text-center"><?php the_sub_field('title'); ?></div>
								<div class="copy"><?php the_sub_field('copy'); ?></div>
							</div>
							<?php endwhile; ?>
						</div>
						<?php } ?>

						<div class="col-lg-12 secondary-title-holder">
							<div class="section-title text-center"><?php the_field('it_second_title_3'); ?></div>
							<div class="button-container">
								<a href="<?php the_field('it_button_link_3'); ?>" class="button slide-in">
									<span class="text"><?php the_field('it_button_text_3'); ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<?php include(locate_template('template_parts/more-orange.php')); ?>
		<?php include(locate_template('template_parts/footer-cta.php')); ?>

		<?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html>