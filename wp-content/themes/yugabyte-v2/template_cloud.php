<?php 
	/* Template Name: Cloud */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body class="animated-hero">
		<?php include(locate_template('template_parts/main-header.php')); ?>
		
		<div class="contact ee" id="yugabyte-cloud">
			<section class="banner-section">
				<div class="row">
                    <div class="col-6 header-text">
                        <h2 class="title"><?php the_field('hero_title'); ?></h2>
                        <div class="subtitle"><?php the_field('hero_subtitle'); ?></div>
                        <div class="button-container">                            
                            <a href="<?php the_field('cloud_register') ?>" class="email-cta button"><?php the_field('cloud_register_cta_text'); ?></a>					
                        </div>
						<div class="cloud-alt-link">
							<?php the_field('cloud_login_cta'); ?>
						</div>
                    </div>
                    <div class="col-6 header-image">
                        <img src="<?php the_field('banner_image'); ?>" height="200" />
                    </div>
				</div>
			</section>

			<!-- <section class="contact-form">
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
			</section> -->

			<section class="layers">
				<div class="container value-prop">
					<div class="value-header-container">
						<h2 class="title"><?php the_field('value_prop_title'); ?></h2>
						<div class="description"><?php the_field('value_prop_desc'); ?></div>
					</div>
					<div class="value-prop-list">
						<?php if(have_rows('value_prop_repeater')): ?>
							<?php while(have_rows('value_prop_repeater')) : the_row(); ?>
								<div class="row">
									<div class="col-3 col-xs-12 text-right">
										<img class="feature-icon" width="64" height="64" src="<?php the_sub_field('feature_icon'); ?>">
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
			<section class="cloud-features">
				<div class="container">
					<h4 class="title brand-primary"><?php the_field('cloud_feature_title'); ?></h4>
					<div class="bullets-checkbox">
						<ul class="bullets">
							<?php if(have_rows('cloud_feature_repeater')): ?>
								<?php while(have_rows('cloud_feature_repeater')) : the_row(); ?>
									<li>
										<i class="fas fa-check green-check"></i>
										<div class="feature-item"><?php the_sub_field('text'); ?></div>
									</li>
								<?php endwhile; ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</section>
		</div>

		<?php include(locate_template('template_parts/more-orange.php')); ?>
		<?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html>