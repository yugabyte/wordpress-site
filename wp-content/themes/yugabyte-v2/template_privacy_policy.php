<?php 
	/* Template Name: Privacy Policy */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body>
		<?php include(locate_template('template_parts/main-header.php')); ?>
		
		<div class="privacy-policy">
			<section class="privacy-hero" style="background-image: url(<?php the_field('hero_background_image'); ?>);">
				<div class="container">
					<div class="row">
						<div class="col">
							<h1 class="title"><?php the_field('hero_title'); ?></h1>
						</div>
					</div>
				</div>
			</section>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<section class="content">
					<div class="container">
						<div class="row">
							<div class="col">
								<?php the_content(); ?> <!-- Page Content -->
							</div>
						</div>
					</div>
				</section>
			<?php endwhile; endif; ?>
		</div>

		<?php include(locate_template('template_parts/footer-cta.php')); ?>

		<?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html>