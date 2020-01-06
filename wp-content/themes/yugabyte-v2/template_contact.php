<?php 
	/* Template Name: Contact Gen */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body class="animated-hero">
		<?php include(locate_template('template_parts/main-header-light.php')); ?>
		
		<div class="contact">
			<section class="hero" id="particles-js" style="background-image: url(<?php the_field('hero_background_image'); ?>);">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="title"><?php the_field('hero_title'); ?></div>
							<div class="subtitle">
								<?php if (isset($_GET['contact-email'])) {
    								the_field('hero_copy_alternate');
								} else {
									the_field('hero_copy');
								} ?>
								</div>
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
							<div class="g-map"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12679.028136102643!2d-122.031771!3d37.3955778!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb9f3a0d6b036c06d!2sYugaByte+Inc!5e0!3m2!1sen!2sus!4v1535387143878" width="530" height="310" frameborder="0" style="border:0" allowfullscreen></iframe></div>
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