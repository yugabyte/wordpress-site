<?php 
$currentCategory = get_queried_object();

$the_slug = $currentCategory->slug;
$the_name = $currentCategory->name;
$the_id = $currentCategory->term_id;
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body class="resource-category">
		<?php include(locate_template('template_parts/main-header.php')); ?>
		
		<div class="resources">

			<?php
			$cat = get_the_category();
			$parent = get_category($cat[0]->category_parent);
			if ($parent->term_id == 15) {
				include(locate_template('template_parts/resources-top.php'));
			?>

			<section class="main <?= get_query_var('cat'); ?>">
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
						'cat' => $currentCategory->term_id,
						'post_status' => 'publish',
						'posts_per_page' => -1,
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
						<?php } wp_reset_postdata(); ?>
				</div>
			</section>
			<?php }
			else if ($parent->term_id == 16) {
				include(locate_template('template_parts/articles-top.php'));
			?>
			<section class="main <?= get_query_var('cat'); ?>">
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
						'cat' => $currentCategory->term_id,
						'post_status' => 'publish',
						'posts_per_page' => -1,
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