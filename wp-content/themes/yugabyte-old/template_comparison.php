<?php 
	/* Template Name: Comparison */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body>
		<?php include(locate_template('template_parts/main-header.php')); ?>
		
		<div class="comparison">
			<section class="hero" style="background-image: url(<?php the_field('hero_background_image'); ?>);">
				<div class="container">
					<div class="row">
						<div class="col">
							<h1 class="title"><?php the_field('hero_title'); ?></h1>
							<div class="subtitle"><?php the_field('hero_subtitle'); ?></div>
						</div>
					</div>
				</div>
			</section>

			<?php if(have_rows('hero_banner_repeater')) { ?>
			<section class="hero-banner orange">
				<div class="container">
					<div class="row">
						<?php while(have_rows('hero_banner_repeater')) : the_row(); ?>
						<div class="col item">
							<a href="#vs-<?php the_row_index(); ?>">
								<div class="title"><?php the_sub_field('title'); ?></div>
							</a>
						</div>
						<?php endwhile; ?>
					</div>
				</div>
			</section>
			<?php } ?>

			<section id="vs-1" class="block one">
				<div class="container" data-aos="zoom-in">
					<div class="row">
						<div class="col">
							<div class="section-title"><?php the_field('simple_block_title'); ?></div>
							<div class="copy"><?php the_field('simple_block_copy'); ?></div>
						</div>
					</div>
				</div>
			</section>

			<section class="it-blocks">
				<div class="container" data-aos="zoom-in">
					<div class="row">
						<div class="col-lg-12">
							<div class="section-title"><?php the_field('it_title'); ?></div>
						</div>
						<?php if(have_rows('it_repeater')) { ?>
						<div class="row it-blocks-holder">
							<?php while(have_rows('it_repeater')) : the_row(); ?>
							<div class="col-sm block item">
								<div class="icon"><img src="<?php the_sub_field('image'); ?>"></div>
								<div class="title text-center"><?php the_sub_field('title'); ?></div>
								<div class="copy"><?php the_sub_field('copy'); ?></div>
							</div>
							<?php endwhile; ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</section>

			<section id="vs-2" class="table-section">
				<div class="container" data-aos="zoom-in">
					<div class="row">
						<div class="col-lg-12">
							<div class="section-title"><?php the_field('comparison_table_title'); ?></div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<table class="text-center">
								<?php $table = get_field( 'comparison_table' );

								if ( $table ) {

								    echo '<table border="0">';

								        if ( $table['header'] ) {

								            echo '<thead>';

								                echo '<tr>';

								                    foreach ( $table['header'] as $th ) {

								                        echo '<th>';
								                            echo $th['c'];
								                        echo '</th>';
								                    }

								                echo '</tr>';

								            echo '</thead>';
								        }

								        echo '<tbody>';

								            foreach ( $table['body'] as $tr ) {

								                echo '<tr>';

								                    foreach ( $tr as $td ) {
								                    	$cellValue = checkTableIcon($td['c']);
								                        echo '<td>';
								                            echo $cellValue;
								                        echo '</td>';
								                    }

								                echo '</tr>';
								            }

								        echo '</tbody>';

								    echo '</table>';
								} ?>
							</table>
						</div>
					</div>
				</div>
			</section>

			<section class="block two">
				<div class="container" data-aos="zoom-in">
					<div class="row">
						<div class="col">
							<div class="section-title"><?php the_field('simple_block_title_2'); ?></div>
							<div class="image"><img src="<?php the_field('simple_block_image_2'); ?>"></div>
							<div class="copy"><?php the_field('simple_block_copy_2'); ?></div>
						</div>
					</div>
				</div>
			</section>

			<section class="it-blocks block three grid">
				<div class="container" data-aos="zoom-in">
					<div class="row">
						<div class="col">
							<div class="section-title"><?php the_field('simple_image_block_title'); ?></div>
						</div>
					</div>
					<?php if(have_rows('simple_image_block_repeater')) { ?>
					<div class="row it-blocks-holder">
						<?php while(have_rows('simple_image_block_repeater')) : the_row(); ?>
						<div class="col-md item">
							<div class="image">
								<img src="<?php the_sub_field('image'); ?>">
							</div>
							<div class="title text-center"><?php the_sub_field('title'); ?></div>
						</div>
						<?php endwhile; ?>
					</div>
					<?php } ?>
				</div>
			</section>

			<section id="vs-3" class="table-section">
				<div class="container" data-aos="zoom-in">
					<div class="row">
						<div class="col-lg-12">
							<div class="section-title text-center"><?php the_field('pricing_table_title'); ?></div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<table class="text-center">
								<?php $table = get_field( 'pricing_table' );

								if ( $table ) {

								    echo '<table border="0">';

								        if ( $table['header'] ) {

								            echo '<thead>';

								                echo '<tr>';

								                    foreach ( $table['header'] as $th ) {

								                        echo '<th>';
								                            echo $th['c'];
								                        echo '</th>';
								                    }

								                echo '</tr>';

								            echo '</thead>';
								        }

								        echo '<tbody>';

								            foreach ( $table['body'] as $tr ) {

								                echo '<tr>';

								                    foreach ( $tr as $td ) {
								                    	$cellValue = checkTableIcon($td['c']);
								                        echo '<td>';
								                            echo $cellValue;
								                        echo '</td>';
								                    }

								                echo '</tr>';
								            }

								        echo '</tbody>';

								    echo '</table>';
								} ?>
							</table>
						</div>
					</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="disclaimer">
								<?php the_field('disclaimer_text'); ?>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="download-cta">
				<div class="container" data-aos="zoom-in">
					<div class="row">
						<div class="col-lg-12">
							<div class="main-title">
								<?php the_field('cta_title'); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="button-container white">
								<a href="<?php the_field('cta_button_link'); ?>"><?php the_field('cta_button_text'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<?php include(locate_template('template_parts/footer-cta.php')); ?>

		<?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html>