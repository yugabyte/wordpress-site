<section class="more-orange">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="main-title"><?php the_field('main_title', 915); ?></div>
			</div>

			<?php if(have_rows('item_repeater', 915)) { ?>
			<div class="col-lg-12 item-holder">

				<?php while(have_rows('item_repeater', 915)) : the_row(); ?>
				<a href="<?php the_sub_field('link_url'); ?>">
					<div class="item">
						<div class="icon">
							<img src="<?php the_sub_field('icon'); ?>">
						</div>
						<div class="text"><?php the_sub_field('link_text'); ?></div>
					</div>
				</a>
				<?php endwhile; ?>

			</div>
			<?php } ?>
			
		</div>
	</div>
</section>