<?php 
	/* Template Name: KubeCon Swag */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

  <body class="kubecon-page">
		<header class="kubecon-header" style="background-image: url(<?php the_field('hero_bg_image'); ?>)">
			<div class="container">
				<div class="row">
					<div class="col-12 kubecon-header__yb-logo-wrapper">
						<a href="<?php the_field('hero_yb_link'); ?>">
							<img class="kubecon-header__yb-logo" src="<?php the_field('hero_yb_logo'); ?>" />
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<h1 class="kubecon-header__title">
							<?php the_field('hero_title'); ?>
						</h1>
						<h3 class="kubecon-header__subtitle">
							<?php the_field('hero_subtitle'); ?>
						</h3>
						<img class="kubecon-header__heart" src="<?php the_field('hero_heart_image'); ?>" />
					</div>
				</div>
			</div>
			<div class="kubecon-header__bg-image-2">
				<img src="<?php the_field('hero_bg_image_2'); ?>" />
			</div>
		</header>

		<section class="kubecon-options">
			<div class="container">
				<div class="row justify-content-between">		
					<?php if(have_rows('options_repeater')) { ?>
						<?php while(have_rows('options_repeater')) : the_row(); ?>
							<div class="col-auto">
								<div class="kubecon-options__card">
									<div class="kubecon-options__main-image">
										<img src="<?php the_sub_field('main_image'); ?>" />
										<div
											class="kubecon-options__progressbar"
											style="background-image: linear-gradient(-45deg, <?php the_sub_field('bar_color'); ?> 4.55%, #fff 4.55%, #fff 50%, <?php the_sub_field('bar_color'); ?> 50%, <?php the_sub_field('bar_color'); ?> 54.55%, #fff 54.55%, #fff 100%)"
											data-name="<?php the_sub_field('name'); ?>"
										>
											<div class="kubecon-options__progressbar__value" data-initial="<?php the_sub_field('initial_height'); ?>" style="background-color: <?php the_sub_field('bar_color'); ?>"></div>
										</div>
									</div>								
									<div class="kubecon-options__logo">
										<a href="<?php the_sub_field('logo_link'); ?>" target="_blank">
											<img src="<?php the_sub_field('logo'); ?>" />	
										</a>
									</div>
									<div class="kubecon-options__learn-more">
										<?php the_field('learn_more_toggle'); ?>
										<div class="kubecon-options__learn-more__tooltip">
											<?php the_sub_field('learn_more_text'); ?>
										</div>
									</div>
									<div class="kubecon-options__select" data-name="<?php the_sub_field('name'); ?>">
										<div class="kubecon-options__select__btn-default">
											<span><?php the_field('select_option'); ?></span>
											<img src="<?php the_field('button_heart_image'); ?>" />
										</div>
										<div class="kubecon-options__select__btn-selected">
											<img src="<?php the_field('button_heart_image'); ?>" />
										</div>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } ?>
				</div>
			</div>
		</section>

		<section class="kubecon-form">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<span class="kubecon-form__info-text"><?php the_field('info_text'); ?></span>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-7">
						
						<div class="kubecon-form__form-wrapper">
							<?php echo do_shortcode(get_field('form_shortcode')) ?>
						</div>
						<div class="kubecon-form__after-submit">
							<?php the_field('success_text'); ?>
						</div>

						<!--
						<div class="kubecon-form__after-submit kubecon-form__after-submit--visible">
							<p>Selection is over, thank you!</p>
						</div>
 						-->
					</div>
				</div>
			</div>
		</section>

		<footer class="kubecon-footer" style="background-image: url(<?php the_field('footer_bg_image'); ?>)">
			<div class="kubecon-footer__title">
				<?php the_field('footer_title'); ?>
			</div>
			<div class="kubecon-footer__subtitle">
				<?php the_field('footer_subtitle'); ?>
			</div>
			<div class="kubecon-footer__footer">
				<div class="kubecon-footer__copyright">
					<?php the_field('footer_copyright'); ?>
				</div>
				<div class="kubecon-footer__links">
					<a href="/support-policy/">Terms</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="/privacy-policy/">Privacy</a>
				</div>
			</div>
		</footer>

		<?php include(locate_template('template_parts/main-scripts.php')); ?>
		<?php wp_footer(); ?>
  </body>
</html>
