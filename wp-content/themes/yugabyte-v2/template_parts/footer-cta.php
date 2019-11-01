<section class="footer-cta" style="background-image:url(<?php the_field('background_image', 72); ?>)">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="main-title"><?php the_field('main_title', 72); ?></div>
			</div>
			<?php if(have_rows('client_repeater', 72)) { ?>
			<div class="col-lg-12 client-holder">
				<?php while(have_rows('client_repeater', 72)) : the_row(); ?>
				<div class="image-container">
					<a href="<?php the_sub_field('link'); ?>">
						<img src="<?php the_sub_field('image'); ?>">
					</a>
				</div>
				<?php endwhile; ?>
			</div>
			<?php } ?>
			<div class="col-sm-6 button-container">
				<a href="<?php the_field('button_primary_url', 72); ?>" class="button left slide-in">
					<span class="text"><?php the_field('button_primary_text', 72); ?></span>
				</a>
			</div>
			<div class="col-sm-6 button-container">
				<a href="<?php the_field('button_secondary_url', 72); ?>" class="button secondary slide-in">
					<span class="text"><?php the_field('button_secondary_text', 72); ?></span>
				</a>
			</div>
		</div>
	</div>
</section>