<section class="footer-cta" id="platform-cta">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<h2 class="main-title"><?php the_field('main_title', 72); ?></h2>
				<div class="row">
					<div class="col-sm-6 button-container">
						<a href="<?php the_field('button_primary_url', 72); ?>" class="button left">
							<span class="text"><?php the_field('button_primary_text', 72); ?></span>
						</a>
					</div>
					<div class="col-sm-6 button-container">
						<a href="<?php the_field('button_secondary_url', 72); ?>" class="button secondary">
							<span class="text"><?php the_field('button_secondary_text', 72); ?></span>
						</a>
					</div>
				</div>
			</div>
			<?php if(have_rows('client_repeater', 72)) { ?>
			<div class="col-lg-6 client-holder">
				<?php while(have_rows('client_repeater', 72)) : the_row(); ?>
				<div class="image-container">
					<a href="<?php the_sub_field('link'); ?>">
						<img height="64" src="<?php the_sub_field('image'); ?>">
					</a>
				</div>
				<?php endwhile; ?>
			</div>
			<?php } ?>
			<div class="mobile-cta-links">
				<div class="col-sm-6 button-container-mobile">
					<a href="<?php the_field('button_primary_url', 72); ?>" class="button left">
						<span class="text"><?php the_field('button_primary_text', 72); ?></span>
					</a>
				</div>
				<div class="col-sm-6 button-container-mobile">
					<a href="<?php the_field('button_secondary_url', 72); ?>" class="button secondary">
						<span class="text"><?php the_field('button_secondary_text', 72); ?></span>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>