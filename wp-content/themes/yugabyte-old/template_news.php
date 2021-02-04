<?php 
	/* Template Name: News */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body>
		<?php include(locate_template('template_parts/main-header.php')); ?>
		
		<div class="resources news">
		<?php
		include(locate_template('template_parts/articles-top.php'));
		$args = array('parent' => 16);
		$resourcesChild = get_categories($args);
		$order = array_column($resourcesChild, 'term_id');
		array_multisort($order, SORT_ASC, $resourcesChild, SORT_NUMERIC);
		foreach ($resourcesChild as $resourceChild) {
			$the_slug = $resourceChild->slug;
			$the_name = $resourceChild->name;
		?>
			<section class="main">
				<div class="container" data-aos="zoom-in">
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
							if ($the_slug == "press-releases") {
					?>

						<div class="d-flex">
							<div class="item">
								<a href="<?php the_field('read_more_link');?>">
									<div class="image"><img src="<?php the_field('image'); ?>"></div>
									<div class="main-title"><?php the_title(); ?></div>
									<div class="date"><?php the_field('date'); ?></div>
									<span class="main-title read-more">Read More</span>
								</a>
							</div>
						</div>

						<?php } elseif($the_slug == "yugabyte-in-the-news") { ?>

						<div class="d-flex">
							<div class="item">
								<a href="<?php the_field('read_more_link');?>">
									<div class="image"><img src="<?php the_field('image'); ?>"></div>
									<div class="main-title"><?php the_title(); ?></div>
									<div class="date"><?php the_field('date'); ?></div>
									<span class="main-title read-more">Read More</span>
								</a>
							</div>
						</div>

					<?php }} ?>
					</div>
					<div class="row see-all">
						<div class="button-container">
							<a href="/all-resources/<?= $the_slug ?>#<?= $the_slug ?>" class="button slide-in">
								<span class="text">See All</span>
							</a>
						</div>
					</div>
						<?php } wp_reset_postdata(); ?>
				</div>
			</section>
		<?php } ?>
		</div>


		<?php include(locate_template('template_parts/more-orange.php')); ?>
		<?php include(locate_template('template_parts/footer-cta.php')); ?>

		<?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html>