<?php 
	/* Template Name: YugabyteDB */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body class="home-demo has-video">
		<?php include(locate_template('template_parts/main-header.php')); ?>
		<div class="community enterprise community-page">
			<section class="homepage-hero hero" style="background-image: url(<?php the_field('hero_background_image'); ?>);">
				<div class="container">
					<div class="row center-align ">
						<div class="col-lg-12 logo-container">
							<img src="<?php the_field('hero_logo'); ?>">
							<h1 class="title"><?php the_field('hero_title'); ?></h1>
						</div>
						<div class="col-lg-12 video">
							<div class="vimeo"><iframe src="<?php the_field('hero_video_url'); ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
						</div>
						<div class="col-lg-12 placeholder">
							<img src="<?php the_field('hero_video_placeholder'); ?>">
							<div class="button-container" id="hvp">
								<div class="button slide-in">
									<span class="text">Play Video</span>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="copy"><?php the_field('hero_subtitle'); ?></div>
						</div>
						<div class="button-container">
							<a href="<?php the_field('hero_button_link'); ?>" class="button slide-in">
								<span class="text"><?php the_field('hero_button_text'); ?></span>
							</a>
						</div>
					</div>
				</div>
			</section>
			<?php if(have_rows('hero_banner_repeater')) { ?>
			<section class="hero-banner">
				<div class="container">
					<div class="row">
						<?php while(have_rows('hero_banner_repeater')) : the_row(); ?>
						<div class="col item">
							<a href="<?php the_sub_field('link') ?>">
								<div class="icon icon-on"><img src="<?php the_sub_field('icon_on'); ?>"></div>
								<div class="icon icon-off"><img src="<?php the_sub_field('icon_off'); ?>"></div>
								<div class="title"><?php the_sub_field('title'); ?></div>
							</a>
						</div>
						<?php endwhile; ?>
					</div>
				</div>
			</section>
			<?php } ?>
			<section class="it-blocks" id="why">
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

			<section id="ee-2" class="advanced-features">
				<div class="container" data-aos="zoom-in">
					<div class="row">
						<div class="col-lg-12">
							<div class="icon"><img src="<?php the_field('features_icon'); ?>"></div>
							<div class="section-title"><?php the_field('features_title'); ?></div>
							<div class="subtitle"><?php the_field('features_subtitle'); ?></div>
						</div>
					</div>
					<?php if(have_rows('features_repeater')) { ?>
					<div class="row repeater">
						<?php while(have_rows('features_repeater')) : the_row(); ?>
						<div class="col-xl-3 col-md-6 col-sm-12">
							<div class="item d-flex justify-content-center">
								<div class="icon"><img src="<?php the_sub_field('icon'); ?>"></div>
								<div class="main-title"><?php the_sub_field('title'); ?></div>
								<div class="copy"><?php the_sub_field('copy'); ?></div>
							</div>
						</div>
						<?php endwhile;	?>
					</div>
					<?php } ?>
				</div>
			</section>


			<section class="it-blocks three" id="compare">
				<div class="container" data-aos="zoom-in">
					<div class="row d-flex justify-content-center">
						<div class="col-lg-12">
							<div class="section-title text-center"><?php the_field('it_title_3'); ?></div>
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