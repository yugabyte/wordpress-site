<?php 
	/* Template Name: Versus DB */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body>
		<?php include(locate_template('template_parts/main-header.php')); ?>
		
		<div class="versus use-case-template enterprise">
			<section class="hero-container">
				<div class="hero" style="background-image: url(<?php the_field('hero_background_image'); ?>);background-position: center;">
					<div class="container">
						<div class="row">
							<div class="col-lg-12">
								<div class="title"><?php the_field('hero_title'); ?></div>
								<div class="title subtitle"><?php the_field('hero_subtitle'); ?></div>
								<div class="button-container">
									<a href="<?php the_field('hero_button_link'); ?>" class="button slide-in">
										<span class="text"><?php the_field('hero_button_text'); ?></span>
									</a>
								</div>
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
							<a href="<?php the_sub_field('link'); ?>" style="text-align: left;">
								<div class="title clearfix">
									<div class="icon">
										<img src="<?php the_sub_field('icon'); ?>">
									</div>
									<?php the_sub_field('title'); ?>
								</div>
							</a>
						</div>
						<?php endwhile; ?>
					</div>
				</div>
			</section>
			<?php } ?>

			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
				endwhile;
				endif;
			?>

		</div>

		<?php include(locate_template('template_parts/more-orange.php')); ?>
		<?php include(locate_template('template_parts/footer-cta.php')); ?>

		<?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html>