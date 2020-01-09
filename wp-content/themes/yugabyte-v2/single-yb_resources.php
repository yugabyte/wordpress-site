<!doctype html>
<html>
	<head>
		<?php
		include(locate_template('template_parts/main-head.php'));
		?>
	</head>

	<body class="download-template animated-hero <?= get_field('gated') == 1 ? 'gated' : 'free' ; ?> <?= (in_category('presentations')) ? 'presentations' : ''; ?>">
		<?php include(locate_template('template_parts/main-header.php')); ?>
		
		<div class="download">
			<section id="particles-js" class="hero">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="title"><?php get_field('hero_title') ? the_field('hero_title') : the_title(); ?> </div>
							<div class="copy"><?php the_field('hero_copy'); ?></div>
						</div>
					</div>
				</div>
			</section>

			<section class="block one">
				<div class="container">
				<?php if(in_category('case-studies')) { ?>
					<div class="row logo-top">
						<div class="image logo"><img src="<?php the_field('logo'); ?>"></div>
					</div>
					<div class="row">
						<div class="col-md abstract">
							<div class="text"><?php the_field('description'); ?></div>
						</div>
					<?php } else { ?>
					<div class="row">
						<div class="col-md preview">
							<div class="image">
								<img src="<?php the_field('image'); ?>">
							</div>
							<div class="author"><?php the_field('author'); ?></div>
							<div class="date"><?php the_field('date'); ?></div>
						</div>
					<?php } ?>
						<div class="col-md abstract">
							<div class="text"><?php the_field('text'); ?></div>
						</div>
						<div class="col-lg right-side-dl">
							<?php if (in_category('case-studies')) { ?>
							<div class="preview-image">
								<img src="<?php the_field('image'); ?>">
							</div>
							<?php } ?>
							<div class="col-lg dl-form">
								<div class="cf7-form">
									<?php echo do_shortcode( '[contact-form-7 id="699" title="Download Form"]' ); ?>
								</div>
							</div>
							<div class="col-lg dl-btn">
								<div class="button-container" id="pvp-1">
									<?php if (in_category('presentations')) { ?>
										<div class="button slide-in">
											<span class="text"><?php the_field('link_text'); ?></span>
										</div>
									<?php } else { ?>
										<a href="<?php the_field('link'); ?>" class="button slide-in">
											<span class="text"><?php the_field('link_text'); ?></span>
										</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<div class="video modal" id="pvp-2" style="display: none;">
			<div class="vimeo modal-content">
				<iframe src="<?php the_field('link'); ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			</div>
		</div>

		<?php
		include(locate_template('template_parts/more-orange.php'));
		include(locate_template('template_parts/footer-cta.php'));
		include(locate_template('template_parts/main-footer.php'));
		include(locate_template('template_parts/main-scripts.php'));
		?>
	</body>
</html> 