<?php 
	/* Template Name: Community */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body>
		<?php include(locate_template('template_parts/main-header.php')); ?>
		<div id="community-contribute-page">
			<section class="community-hero">
				<div class="container">
					<div class="row center-align ">
						<div class="col-lg-12 logo-container">
							<div class="title"><?php the_field('hero_title'); ?></div>
							<div class="subtitle"><?php the_field('hero_subtitle'); ?></div>
							<img src="<?php the_field('hero_image'); ?>">
							<div class="button-container">
								<a href="<?php the_field('hero_button_link'); ?>" class="button">
									<span class="text"><?php the_field('hero_button_text'); ?></span>
								</a>
								<a href="<?php the_field('hero_secondary_button_link'); ?>" class="secondary-button">
									<span class="text"><?php the_field('hero_secondary_button_text'); ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php if(have_rows('hero_banner_repeater')) { ?>
			<section class="hero-banner">
				<div class="container">
					<div class="row center-container">
						<?php while(have_rows('hero_banner_repeater')) : the_row(); ?>
						<div class="col item">
							<img class="header-image" src="<?php the_sub_field('header_image'); ?>" />
							<h3><?php the_sub_field('title'); ?></h3>
							<?php if(have_rows('section_repeater')) { ?>
								<div class="container">
									<?php while(have_rows('section_repeater')) : the_row(); ?>
										<a href="<?php the_sub_field('link_address') ?>">
											<img class="icon-sm section-icon" src="<?php the_sub_field('section_icon'); ?>" />
											<?php the_sub_field('section_title'); ?>
											<span class="icon-right"><i class="fa fa-caret-right secondary-grey"></i></span>
										</a>
									<?php endwhile; ?>
								</div>
							<?php } ?>
						</div>
						<?php endwhile; ?>
					</div>
				</div>
			</section>
			<?php } ?>
			<section class="it-blocks" id="why">
				<div class="container md-max-width">
					<div class="row d-flex justify-content-center">
						<div class="contribute-wrapper">
							<div class="contribute-header">
								<img class="contribute-splash" src="<?php the_field('contribute_header_image'); ?>" />
								<h2 class="brand-primary"><?php the_field('contribute_title'); ?></h2>
							</div>
							<?php if(have_rows('how_to_contribute_repeater')) { ?>
								<ul class="accordion-container">
									<?php while(have_rows('how_to_contribute_repeater')) : the_row(); ?>
										<li class="contribute-blocks">
											<div class="summary">
												<img class="section-icon" src="<?php the_sub_field('section_icon'); ?>" />
												<div class="accordion-phrase brand-primary"><?php the_sub_field('section_phrase'); ?></div>
												<span class="action-open">
													<i class="fa fa-chevron-down"></i>
												</span>
												<span class="action-close">
													<i class="fa fa-chevron-up"></i>
												</span>
											</div>
											<div class="expanded-content">
												<?php the_sub_field('expanded_content'); ?>
											</div>
										</li>
									<?php endwhile ?>
								</ul>
							<?php } ?>
						</div>
					</div>
				</div>
			</section>
			<section class="contributor-program">
				<div class="container">
					<div class="title-wrapper">
						<h3 class="contributor-program-title"><?php the_field('contributor_program_title'); ?></h3>
						<div class="contributor-subtext"><?php the_field('contributor_program_subtext'); ?></div>
					</div>		
					<?php if(have_rows('contributor_repeater')) { ?>			
						<div class="row center-container">
							<?php while(have_rows('contributor_repeater')) : the_row(); ?>
							<div class="col item">
								<img class="contributor-reward" src="<?php the_sub_field('item_image'); ?>" />
								<h3 class="contributor-type"><?php the_sub_field('contributor_type'); ?></h3>
								<div class="description"><?php the_sub_field('contributor_info'); ?></div>
							</div>
							<?php endwhile; ?>
						</div>
					<?php } ?>
					<div class="read-docs-container">
						<?php $cta = get_field('contributor_cta'); ?>
						<div class="button-container"><a href="<?php echo $cta['button_link']; ?>" class="button"><?php echo $cta['button_text']; ?></a></div>
					</div>
				</div>
			</section>
			<section class="footer-cta">
				<div class="container">
					<div class="contributor-footnote">
						<div class="more-info email-info-text"><?php echo $cta['questions_text'] ?></div>
						<div class="button-container">
							<a href="<?php echo $cta['email_url']; ?>" class="email-cta button">
								<?php echo $cta['email_text']; ?>
							</a>
						</div>
					</div>
				</div>
			</section>
		</div>

		<?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html>