<?php 
	/* Template Name: Main Resources */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body>
		<?php include(locate_template('template_parts/main-header.php')); ?>
		
		<div class="resources">
			<?php include(locate_template('template_parts/resources-top.php')); ?>

			<section class="main">
				<div class="container-fluid" data-aos="zoom-in">
				<?php
				$args = array('parent' => 15);
				$resourcesChild = get_categories($args);
				$order = array_column($resourcesChild, 'term_id');
				array_multisort($order, SORT_ASC, $resourcesChild, SORT_NUMERIC);
				foreach ($resourcesChild as $resourceChild) {
					$the_slug = $resourceChild->slug;
					$the_name = $resourceChild->name;
				?>
					<div class="resource-section">

						<div id="<?= $the_slug; ?>" class="row title">
							<div class="col">
								<div class="section-title"><?= $the_name; ?></div>
							</div>
						</div>
						<div class="row item-container d-flex justify-content-center <?= $the_slug; ?>">
						<?php
						$args2 = array(
							'post_type' => 'yb_resources',
							'cat' => $resourceChild->term_id,
							'post_status' => 'publish',
							'posts_per_page' => 3,
							'orderby' => 'menu_order'
						);
						$query2 = new WP_Query($args2);
						if($query2->have_posts() ) {
							while($query2->have_posts() ) {
								$query2->the_post();
								if ($the_slug == "datasheets") {
						?>

							<div class="d-flex">
								<div class="item">
									<a href="<?php the_permalink();?>">
										<div class="image"><img src="<?php the_field('image'); ?>"></div>
										<div class="main-title"><?php the_title(); ?></div>
									</a>
								</div>
							</div>

							<?php } elseif($the_slug == "white-papers") { ?>

							<div class="d-flex">
								<div class="item">
									<a href="<?php the_permalink();?>">
										<div class="image"><img src="<?php the_field('image'); ?>"></div>
										<div class="main-title"><?php the_title(); ?></div>
									</a>
								</div>
							</div>

							<?php } elseif($the_slug == "presentations") { ?>

							<div class="d-flex">
								<div class="item">
									<a href="<?php the_permalink();?>">
										<div class="image"><img src="<?php the_field('image'); ?>"></div>
										<div class="main-title"><?php the_title(); ?></div>
									</a>
								</div>
							</div>

							<?php } elseif($the_slug == "case-studies") { ?>

							<div class="d-flex">
								<div class="item">
									<a href="<?php the_permalink();?>">
										<div class="image"><img src="<?php the_field('logo'); ?>"></div>
										<div class="main-title"><?php the_title(); ?></div>
									</a>
								</div>
							</div>

							<?php } elseif($the_slug == "events") { ?>

							<div class="col">
							<div class="image-container">
									<div class="type"><?php the_field('type'); ?></div>
									<a href="<?php the_permalink();?>">
										<div class="main-title"><?php the_title(); ?></div>
									</a>
									<div class="image" style="background: url('<?php the_field('image'); ?>'); background-position: center; background-size: cover;"></div>
								</div>
								<div class="item">
									<div class="copy">
										<?php the_field('text_1'); ?>
										<br>
										<?php the_field('text_2'); ?>
									</div>
									<div class="button-container">
										<a href="<?php the_permalink();?>" class="button slide-in">
											<span class="text"><?php the_field('link_text'); ?></span>
										</a>
									</div>
								</div>
							</div>

							<?php }} ?>
						</div>
						<div class="row see-all">
							<div class="button-container">
								<a href="/all-resources/<?= $the_slug ?>" class="button slide-in">
									<span class="text">See All <?= $the_name; ?></span>
								</a>
							</div>
						</div>

					<?php } wp_reset_postdata(); ?>
					</div>
					<?php } ?>
				</div>
			</section>
		</div>

		<?php include(locate_template('template_parts/more-orange.php')); ?>
		<?php include(locate_template('template_parts/footer-cta.php')); ?>

		<?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html>