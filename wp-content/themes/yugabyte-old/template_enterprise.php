<?php 
	/* Template Name: Enterprise */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body class="home-demo has-video">
		<?php include(locate_template('template_parts/main-header.php')); ?>

		<section class="platform-page-hero" style="background-image: url(<?php the_field('platform_hero_background_image_1'); ?>)">
			<div class="platform-page-hero__container">
				<div class="row">
					<div class="col-lg-6">
						<h1 class="platform-page-hero__title platform-page-hero__title--h1">
							<?php the_field('platform_hero_title'); ?>
						</h1>
						<h2 class="platform-page-hero__title platform-page-hero__title--h2">
							<?php the_field('platform_hero_subtitle_1'); ?>
						</h2>
						<h3 class="platform-page-hero__title platform-page-hero__title--h3">
							<?php the_field('platform_hero_subtitle_2'); ?>
						</h3>
						<a href="#request-trial-form" class="platform-page-hero__try-btn">
							<?php the_field('platform_hero_try_now_text'); ?>
						</a>
					</div>

					<div class="col-lg-6">
						<div class="platform-page-hero__screenshot">
							<img src="<?php the_field('platform_hero_image'); ?>" />
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="platform-page-features">
			<h1 class="platform-page-features__title">
				<?php the_field('platform_features_title'); ?>
			</h1>

			<div class="platform-page-features__container">
				<?php if(have_rows('platform_features_repeater')) { ?>
					<?php while(have_rows('platform_features_repeater')) : the_row(); ?>
						<div class="platform-page-features__item">
							<div class="platform-page-features__item__image-row">
								<div class="platform-page-features__item__image">
									<img src="<?php the_sub_field('platform_feature_image'); ?>" />
								</div>
								<div class="platform-page-features__item__title platform-page-features__item__title--mobile">
									<?php the_sub_field('platform_feature_title'); ?>
								</div>
							</div>
							
							<div class="platform-page-features__item__description">
								<div class="platform-page-features__item__title">
									<?php the_sub_field('platform_feature_title'); ?>
								</div>
								<div class="platform-page-features__item__details">
									<?php the_sub_field('platform_feature_details'); ?>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php } ?>
			</div>
		</section>

		<section class="platform-page-trial" style="background-image: url(<?php the_field('platform_trial_background_image'); ?>)">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 platform-page-trial__mobile-col--top">
						<h1 class="platform-page-trial__title">
							<?php the_field('platform_trial_title'); ?>
						</h1>
						<h2 class="platform-page-trial__subtitle">
							<?php the_field('platform_trial_subtitle'); ?>
						</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5 platform-page-trial__mobile-col--top">
						<div class="platform-page-trial__title-2">
							<?php the_field('platform_trial_operations_title'); ?>
						</div>
						<?php if(have_rows('platform_trial_operations_repeater')) { ?>
							<?php while(have_rows('platform_trial_operations_repeater')) : the_row(); ?>
								<div class="platform-page-trial__bullet-row">
									<img src="<?php the_field('platform_trial_repeater_icon'); ?>" />
									<?php the_sub_field('platform_trial_operation_item_title'); ?>
								</div>
							<?php endwhile; ?>
						<?php } ?>

						<div class="platform-page-trial__title-2">
							<?php the_field('platform_trial_support_title'); ?>
						</div>
						<?php if(have_rows('platform_trial_support_repeater')) { ?>
							<?php while(have_rows('platform_trial_support_repeater')) : the_row(); ?>
								<div class="platform-page-trial__bullet-row">
									<img src="<?php the_field('platform_trial_repeater_icon'); ?>" />
									<?php the_sub_field('platform_trial_support_item_title'); ?>
								</div>
							<?php endwhile; ?>
						<?php } ?>
					</div>
					
					<div class="col-lg-1"></div>

					<div class="col-lg-6 platform-page-trial__mobile-col--bottom">
						<div class="platform-page-trial__title-2" id="request-trial-form">
							<?php the_field('platform_trial_form_title'); ?>
						</div>

						<div class="platform-page-trial__form" >
							<?php echo do_shortcode(get_field('platform_trial_form_shortcode')) ?>
						</div>

					</div>
				</div>
			</div>

		</section>

		<!--
		<div class="community enterprise enterprise-page hidden">
			<section class="block five table-section" id="compare-editions">
				<div class="container" data-aos="zoom-in">
					<div class="row">
						<div class="col">
							<div class="section-title"><?php the_field('title_5'); ?></div>
							<div class="copy"><?php the_field('copy_5'); ?></div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
						<?php $table = get_field( 'comparison_table_5' );
						if ( $table ) {
							$count = 0;
						    echo '<table border="0">';
						    if ( $table['header'] ) {
							   	echo '<thead>', '<tr>';
						   		foreach ( $table['header'] as $th ) {
						   			echo '<th>', $th['c'], '</th>';
						   		}
						   		echo '</tr>', '</thead>';
							}
							echo '<tbody>';
							foreach ( $table['body'] as $tr ) {
								if (!is_null($tr[0]['c']) && $tr[0]['c'] == '') {
									echo '<tr class="break ';
									echo $count++;
									echo '">';
								} else {
									echo '<tr>';
								}
							    foreach ( $tr as $td ) {
							    	$cellValue = checkTableIcon($td['c']);
							    	echo '<td>', $cellValue, '</td>';
							    }
							   	echo '</tr>';
							}
							echo '</tbody>', '</table>';
						} ?>
						</div>
					</div>
				</div>
			</section>
		</div>
		-->

		<?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html>
