<?php 
	/* Template Name: Case Study */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body>
        <nav class="navbar case-study-page justify-content-between" role="menu" id="myNav">
            <div class="container case-study-page">
                <a class="customer-hyperlink" href="<?php the_field('customer_site_url'); ?>" target="_blank">
                    <img class="customer-logo" src="<?php the_field('customer_logo'); ?>" />
                </a>
                <div class="yugabyte-branding">
                    <a class="yugabyte-logo" href="<?php the_field('yugabyte_link'); ?>">
                        <img src="<?php the_field('yugabyte_logo'); ?>" />
                    </a>
                    <a class="primary-btn btn" href="<?php the_field('button_primary_url'); ?>">
                        <?php the_field('button_primary_text'); ?>
                    </a>
                    <a class="primary-btn-mobile btn" href="<?php the_field('button_primary_url'); ?>">
                        <?php the_field('button_mobile_text'); ?>
                    </a>
                </div>
            </div>
        </nav>
    
		<div class="case-study">
			<section class="hero">
                <div class="diamond-motif" id="bg-diamond-1-1">
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                </div>
                <div class="diamond-motif" id="bg-diamond-1-2">
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                </div>
                <div class="diamond-motif" id="bg-diamond-1-3">
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                </div>
                <div class="diamond-motif" id="bg-diamond-1-4">
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                </div>
				<div class="container case-study-page">
                    <a class="customer-hyperlink-mobile" href="<?php the_field('customer_site_url'); ?>" target="_blank">
                        <img class="customer-logo" src="<?php the_field('customer_logo'); ?>" />
                    </a>
					<div class="row">
						<div class="col">
                            <div class="hero-title"><?php the_field('hero_statement'); ?></div>
                            <div class="yugabyte-purpose">
                                <?php the_field('yugabyte_purpose'); ?>
                            </div>
							<div class="subtitle">
                                <?php if(have_rows('hero_repeater')) { ?>
                                    <?php while(have_rows('hero_repeater')) : the_row(); ?>
                                        <div class="item-container">
                                            <img class="item-icon" src="<?php the_sub_field('icon'); ?>" />
                                            <div class="item-content"><?php the_sub_field('company_info'); ?></div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="hero-image-wrapper">
                                <img class="hero-image" src="<?php the_field('hero_img'); ?>" />
                                <img class="play-btn" src="<?php the_field('play_button'); ?>" />
                            </div>
                        </div>
                        <div class="subtitle-mobile">
                            <?php if(have_rows('hero_repeater')) { ?>
                                <?php while(have_rows('hero_repeater')) : the_row(); ?>
                                    <div class="item-container lg-col">
                                        <img class="item-icon" src="<?php the_sub_field('icon'); ?>">
                                        <div class="item-content"><?php the_sub_field('company_info'); ?></div>
                                    </div>
                                <?php endwhile; ?>
                            <?php } ?>
                        </div>
					</div>
                </div>
			</section>

			<section class="customer-intro">
				<div class="container case-study-page">
					<div class="row">
						<div class="stacked-images">
                            <img src="<?php the_field('company_image_1'); ?>" />
                        </div>
						<div class="company-container">
                            <div class="company-title"><?php the_field('company_info_header'); ?></div>
                            <div class="company-info-details"><?php the_field('company_info_details'); ?></div>
                        </div>
					</div>
				</div>
			</section>

			<section class="evaluation">
                <div class="diamond-motif" id="bg-diamond-3-1">
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                </div>
                <div class="diamond-motif" id="bg-diamond-3-2">
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                </div>
                <div class="diamond-motif" id="bg-diamond-3-3">
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                </div>
				<div class="container case-study-page">
					<div class="row">
                        <?php if(have_rows('info_repeater')) { ?>
                            <?php $singleRow = count(get_field('info_repeater')) ?>
                            <?php while(have_rows('info_repeater')) : the_row(); ?>
                                <div class="col ">
                                    <h2 class="section-title <?php if ($singleRow == 1) { echo 'centered'; } ?>">
                                        <?php the_sub_field('section_title'); ?>
                                    </h2>
                                    <div class="section-content <?php if ($singleRow == 1) { echo 'centered'; } ?>"><?php the_sub_field('section_content'); ?></div>
                                </div>
                            <?php endwhile; ?>                  
                        <?php } ?>
					</div>
                    <?php if(get_field('evaluation_table')) { ?>
                        <div class="row">
                            <div class="col">
                                <h2 class="section-title centered">Evaluation Criteria</h2>
                                <div class="section-content table-content"><?php the_field('evaluation_table'); ?></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
			</section>

			<section class="testimonials">
                <div class="diamond-motif" id="bg-diamond-4-1">
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                </div>
				<div class="container case-study-page">
					<div class="row">
						<?php if(have_rows('testimonials')) { ?>
							<?php while(have_rows('testimonials')) : the_row(); ?>
							<div class="col-sm quote-container">
                                <div class="quote"><?php the_sub_field('advocater_quote'); ?></div>
                                <div class="quoter-info">
                                    <img class="profile-picture" src="<?php the_sub_field('profile_picture'); ?>" />
								    <div class="customer-info">
                                        <div class="name"><?php the_sub_field('customer_name'); ?></div>
                                        <div class="position"><?php the_sub_field('customer_position'); ?></div>
                                    </div>
                                </div>
                                <div class="left-bg-col"></div>
							</div>
							<?php endwhile; ?>
						<?php } ?>
					</div>
				</div>
			</section>

			<section class="solutions">
                <div class="diamond-motif" id="bg-diamond-5-1">
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                </div>
                <div class="diamond-motif" id="bg-diamond-5-2">
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                </div>
                <div class="diamond-motif" id="bg-diamond-5-3">
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                </div>
                <div class="diamond-motif" id="bg-diamond-5-4">
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                </div>
                <div class="diamond-motif" id="bg-diamond-5-5">
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                </div>
                <div class="diamond-motif" id="bg-diamond-5-6">
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                </div>
                <div class="diamond-motif" id="bg-diamond-5-7">
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                </div>
                <div class="diamond-motif" id="bg-diamond-5-8">
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                    <div>
                        <div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div><div class="oval"></div>
                    </div>
                </div>
				<div class="container case-study-page">
                    <h1><?php the_field('solution_title'); ?></h1>
                    <div class="visual-specs row">
                        <?php if(have_rows('implementation_details')) { ?>
                            <?php while(have_rows('implementation_details')) : the_row(); ?>
	        					<div class="col-lg-4 spec-container">
                                    <img src="<?php the_sub_field('details_icon'); ?>" />
                                    <div><?php the_sub_field('details_spec'); ?></div>
                                </div>
                            <?php endwhile; ?>
						<?php } ?>
                    </div>
                    
                    <h2><?php the_field('technical_header'); ?></h2>
                    <div class="tech-specs row">
                        <?php if(have_rows('technical_repeater')) { ?>
                            <?php while(have_rows('technical_repeater')) : the_row(); ?>
	        					<div class="col-lg-2 stat-block">
                                    <div class="stat-number"><?php the_sub_field('stat_number'); ?></div>
                                    <div class="stat-unit"><?php the_sub_field('stat_unit'); ?></div>
                                </div>
                            <?php endwhile; ?>
                        <?php } ?>
                    </div>
                    
                    <h2><?php the_field('business_header'); ?></h2>
                    <div class="business-value-props">
                        <?php if(have_rows('business_repeater')) { ?>
                            <?php while(have_rows('business_repeater')) : the_row(); ?>
	        					<div class="value-prop">
                                    <?php the_sub_field('business_value_item'); ?>
                                    <div class="left-bg-col"></div>
                                </div>
                            <?php endwhile; ?>
                        <?php } ?>
                    </div>
                </div>
			</section>
        </div>
        <!-- The Modal -->
        <div id="video-modal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
            <span class="close">&times;</span>
            <?php the_field('demo_video'); ?>
            </div>

        </div>
        <footer class="footer-minimal">
            <div class="footer-video">
                <div class="container case-study-page">
                    <div class="row">
                        <div class="col-lg-6 video-wrapper">
                            <div class="demo-video">
                                <?php the_field('demo_video'); ?>
                                <img class="play-btn" src="<?php the_field('play_button'); ?>" />
                            </div>
                        </div>
                        <div class="col-lg-6 text-wrapper">
                            <div class="main-title"><?php the_field('main_title'); ?></div>
                            <div class="row btn-wrapper">
                                <a class="secondary-btn btn" href="<?php the_field('button_secondary_url'); ?>" download>
                                    <?php the_field('button_secondary_text'); ?>
                                </a>
                                <a class="primary-btn btn" href="<?php the_field('button_primary_url'); ?>">
                                    <?php the_field('button_primary_text'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include(locate_template('template_parts/footer-video.php')); ?>
        </footer>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html>