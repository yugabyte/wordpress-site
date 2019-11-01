<?php 
	/* Template Name: Contact EE */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body class="animated-hero">
		<?php include(locate_template('template_parts/main-header-light.php')); ?>
		
		<div class="contact ee">
			<section class="hero" id="particles-js" style="background-image: url(<?php the_field('hero_background_image'); ?>);">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="title"><?php the_field('hero_title'); ?></div>
							<div class="subtitle"><?php the_field('hero_copy'); ?></div>
						</div>
					</div>
				</div>
			</section>

			<section class="contact-form">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="section-title"><?php the_field('contact_form_title'); ?></div>
						</div>
					</div>
					<div class="row">
						<?php if(get_field('textbox')) { ?>
						<div class="col-md">
							<div class="textbox"><?php echo the_field('textbox'); ?></div>
						</div>
						<?php } ?>
						<div class="col-md <?php echo get_field('textbox') ? '' : 'full-form'; ?>">
							<div class="cf7-form"><?php echo do_shortcode( get_field('contact_form') ); ?></div>
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