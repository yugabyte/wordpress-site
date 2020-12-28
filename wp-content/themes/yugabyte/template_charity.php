<?php 
	/* Template Name: Charity */ 
?>

<!doctype html>
<html>
	<head>
        <?php include(locate_template('template_parts/main-head.php')); ?>
        <link href="https://fonts.googleapis.com/css2?family=Fira+Mono&display=swap" rel="stylesheet">
	</head>

	<body>
    <?php include(locate_template('template_parts/main-header.php')); ?>
		
    <div class="charity">
		<section class="banner-section" style="background-image: url('<?php the_field('hero_bg'); ?>');">
			<div class="container">
				<div class="row">
					<div class="col-6 header-text">
						<h1 class="title"><?php the_field('hero_title'); ?></h1>
						<div class="subtitle"><?php the_field('hero_subtitle'); ?></div>					
					</div>
					<div class="col-6 header-image">
						<img src="<?php the_field('splash_image'); ?>" height="200" />
					</div>
				</div>
			</div>
		</section>
		<section class="register">
			<div class="container">
				<h2><?php the_field('register_section_title'); ?></h2>
				<div class="section-text"><?php the_field('register_description'); ?></div>
                <a href="<?php the_field('cta_link'); ?>" class="register-cta">
                    <?php the_field('cta_text'); ?>
                    <i class="fa fa-caret-right" style="color: #FF6E42; margin-left: 2px"></i>
                </a>
			</div>
		</section>
		<section class="vote-charity">
			<div class="container">
				<h2><?php the_field('vote_section_title'); ?></h2>
				<div class="description"><?php the_field('vote_section_description'); ?></div>
				<ul class="charity-list">
					<?php if(have_rows('charity_list_repeater')): ?>
						<?php while(have_rows('charity_list_repeater')) : the_row(); ?>
							<li>                                
								<a href="<?php the_sub_field('org_link'); ?>" class="circle-logo">
                                    <img src="<?php the_sub_field('logo'); ?>" />
                                </a>
								<div class="email-vote">
                                    <?php the_sub_field('action_text'); ?>
                                    <i class="fa fa-caret-right" style="color: #FF6E42; margin-left: 2px"></i>
                                </div>
                                <div class="email-submission-form hidden" data-url="<?php the_sub_field('org_link'); ?>">
                                    <?php echo do_shortcode( '[contact-form-7 id="2257" title="Register Email"]' ); ?>
                                </div>
							</li>
						<?php endwhile; ?>
					<?php endif; ?>
				</ul>
			</div>
		</section>
		<section class="footer-cta light" style="background-image: url('<?php the_field('footer_bg'); ?>')">
			<div class="container">
				<h3><?php the_field('footer_header'); ?></h3>
                <div class="message-text"><?php the_field('footer_text'); ?></div>
			</div>
		</section>
    </div>
    <?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html>