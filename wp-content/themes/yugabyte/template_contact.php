<?php 
	/* Template Name: Contact Gen */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body class="animated-hero">
		<?php include(locate_template('template_parts/main-header.php')); ?>
		
		<div class="contact">
			<section class="hero" id="particles-js" style="background-image: url(<?php the_field('hero_background_image'); ?>);">
				<div class="container">
					<div class="row">
						<div class="col">
							<h1 class="title"><?php the_field('hero_title'); ?></h1>
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
						<div class="col-md">
							<div class="cf7-form"><?php echo do_shortcode( get_field('contact_form') ); ?></div>
						</div>
						<div class="col-md">
							<div class="g-map"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1585.2633874636845!2d-122.0298773!3d37.3773728!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb65cf669f5b5%3A0x2d21886e6d1c7025!2s100%20S%20Murphy%20Ave%2C%20Sunnyvale%2C%20CA%2094086!5e0!3m2!1sen!2sus!4v1614628017572!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe></div>
							<div class="address"><?php the_field('contact_map_address'); ?></div>
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
