<?php 
	/* Template Name: Careers */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body>
    <?php include(locate_template('template_parts/main-header.php')); ?>
		
    <div class="careers">
		<section class="banner-section">
			<div class="row">
				<div class="col-6 header-text">
					<h1 class="title"><?php the_field('hero_title'); ?></h1>
					<div class="subtitle"><?php the_field('hero_subtitle'); ?></div>
					<div class="button-container">						
						<a href="#jobs" class="email-cta button"><?php the_field('hero_cta_button_text'); ?></a>
					</div>
				</div>
				<div class="col-6 header-image">
					<img src="<?php the_field('splash_image'); ?>" height="200" />
				</div>
			</div>
		</section>
		<section class="perks-section">
			<div class="container">
				<h3><?php the_field('perks_section_title'); ?></h3>
				<div class="table-view">
					<?php if(have_rows('perks_list_repeater')): ?>
						<?php while(have_rows('perks_list_repeater')) : the_row(); ?>
							<div class="item">
								<div class="perk-container">
									<div class="perk-icon">
										<img src="<?php the_sub_field('perk_icon'); ?>"/>
									</div>
									<div class="perk-item"><?php the_sub_field('perk_item'); ?></div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<section id="jobs" class="jobs-section">
			<div class="container">
				<h3><?php the_field('jobs_section_title'); ?></h3>
				<div class="description"><?php the_field('jobs_section_description'); ?></div>
				<ul class="job-list">
					<?php if(have_rows('jobs_list_repeater')): ?>
						<?php while(have_rows('jobs_list_repeater')) : the_row(); ?>
							<li class="job-container">
								<a href="<?php the_sub_field('job_link'); ?>" class="title"><?php the_sub_field('job_title'); ?></a>
								<div class="job-info">
									<span><strong><?php the_sub_field('department'); ?></strong> | <?php the_sub_field('location') ?><span>
								</div>
							</li>
						<?php endwhile; ?>
					<?php endif; ?>
				</ul>
			</div>
		</section>
		<section class="footer-cta">
			<div class="container">
				<div class="contributor-footnote">                        
					<div class="cta-phrase"><?php the_field('job_cta_title'); ?></div>
				</div>
			</div>
		</section>
    </div>
    <?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html>