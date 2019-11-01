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
		<div class="community enterprise enterprise-page">
			<section class="homepage-hero hero" style="background-image: url(<?php the_field('hero_background_image'); ?>);">
				<div class="container">
					<div class="row center-align ">
						<div class="col-lg-12 logo-container">
							<img src="<?php the_field('hero_logo'); ?>">
							<div class="title"><?php the_field('hero_title'); ?></div>
						</div>
						<div class="col-lg-12 video">
							<div class="vimeo"><iframe src="<?php the_field('hero_video_url'); ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
						</div>
						<div class="col-lg-12 placeholder">
							<img src="<?php the_field('hero_video_placeholder'); ?>">
							<div class="button-container" id="hvp">
								<div class="button slide-in">
									<span class="text">Play Video</span>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="copy"><?php the_field('hero_subtitle'); ?></div>
						</div>
						<div class="button-container">
							<a href="<?php the_field('hero_button_link'); ?>" class="button slide-in">
								<span class="text"><?php the_field('hero_button_text'); ?></span>
							</a>
						</div>
					</div>
				</div>
			</section>

			<?php if(have_rows('hero_banner_repeater')) { ?>
			<section class="hero-banner">
				<div class="container">
					<div class="row">
						<?php while(have_rows('hero_banner_repeater')) : the_row(); ?>
						<div class="col item">
							<a href="#ee-<?php the_row_index(); ?>">
								<div class="icon icon-on"><img src="<?php the_sub_field('icon_on'); ?>"></div>
								<div class="icon icon-off"><img src="<?php the_sub_field('icon_off'); ?>"></div>
								<div class="title"><?php the_sub_field('title'); ?></div>
							</a>
						</div>
						<?php endwhile; ?>
					</div>
				</div>
			</section>
			<?php } ?>

			<section id="ee-1" class="deployment">
				<div class="container" data-aos="zoom-in">
					<div class="row">
						<div class="col-lg-12">
							<div class="icon"><img src="<?php the_field('deployment_icon'); ?>"></div>
							<div class="section-title"><?php the_field('deployment_title'); ?></div>
							<div class="subtitle"><?php the_field('deployment_subtitle'); ?></div>
						</div>
					</div>
					<?php if(have_rows('deployment_repeater')) {
						$count = 0;
						while(have_rows('deployment_repeater')) : the_row();
					?>
					<div class="row block-holder">
						<?php if($count%2 == 0) { ?>
						<div class="col-lg-1">
							<div class="icon-sub">
								<img src="<?php the_sub_field('icon'); ?>">
							</div>
						</div>
						<div class="col-lg-3 block-text">
							<div class="main-title"><?php the_sub_field('title'); ?></div>
							<div class="copy"><?php the_sub_field('copy'); ?></div>
							<div class="link-arrow">
								<a href="<?php the_sub_field('link_url'); ?>"><?php the_sub_field('link_text'); ?></a>
							</div>
						</div>
						<div class="col-lg-8">
							<img src="<?php the_sub_field('image'); ?>">
						</div>
					<?php } else { ?>
						<div class="col-lg-8 order-12 order-lg-1">
							<img src="<?php the_sub_field('image'); ?>">
						</div>
						<div class="col-lg-1 order-2">
							<div class="icon-sub">
								<img src="<?php the_sub_field('icon'); ?>">
							</div>
						</div>
						<div class="col-lg-3 order-3 block-text">
							<div class="main-title"><?php the_sub_field('title'); ?></div>
							<div class="copy"><?php the_sub_field('copy'); ?></div>
							<div class="link-arrow">
								<a href="<?php the_sub_field('link_url'); ?>"><?php the_sub_field('link_text'); ?></a>
							</div>
						</div>
						<?php } ?>
					</div>
					<?php $count++;
						endwhile;
						}
					?>
				</div>
			</section>

			<section id="ee-2" class="support">
				<div class="container" data-aos="zoom-in">
					<div class="row">
						<div class="col-lg-12">
							<div class="icon"><img src="<?php the_field('support_icon'); ?>"></div>
							<div class="section-title"><?php the_field('support_title'); ?></div>
							<div class="subtitle"><?php the_field('support_subtitle'); ?></div>
						</div>
					</div>
					<?php if(have_rows('support_repeater')) { ?>
					<div class="row repeater">
						<?php while(have_rows('support_repeater')) : the_row(); ?>
						<div class="col-lg-6 col-md-12">
							<div class="item d-flex justify-content-center">
								<div class="icon"><img src="<?php the_sub_field('icon'); ?>"></div>
								<div class="main-title"><?php the_sub_field('title'); ?></div>
								<div class="copy"><?php the_sub_field('copy'); ?></div>
							</div>
						</div>
						<?php endwhile; ?>
					</div>
					<?php } ?>
				</div>
			</section>
			
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

		<?php include(locate_template('template_parts/more-orange.php')); ?>
		<?php include(locate_template('template_parts/footer-cta.php')); ?>

		<?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html>