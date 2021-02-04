<section class="footer-cta" id="platform-cta">
	<div class="container">		
		<div class="title-box">
			<h2 class="main-title"><?php the_field('main_title', 72); ?></h2>			
		</div>
		<?php if(have_rows('client_repeater', 72)) { ?>
		<div class="client-holder">
			<?php while(have_rows('client_repeater', 72)) : the_row(); ?>
			<div class="image-container">
				<a href="<?php the_sub_field('link'); ?>">
					<img height="64" src="<?php the_sub_field('image'); ?>">
				</a>
			</div>
			<?php endwhile; ?>
		</div>
		<?php } ?>
		<div class="row" style="justify-content: center;">
			<div class="button-container">
				<a href="<?php the_field('button_primary_url', 72); ?>" class="button primary">
					<span class="text"><?php the_field('button_primary_text', 72); ?></span>
				</a>
			</div>
			<div class="button-container">
				<a href="<?php the_field('button_secondary_url', 72); ?>" class="button secondary">
					<span class="text"><?php the_field('button_secondary_text', 72); ?></span>
				</a>
			</div>
			<div class="button-container">
				<a href="<?php the_field('button_tertiary_url', 72); ?>" class="button secondary">
					<span class="text"><?php the_field('button_tertiary_text', 72); ?></span>
				</a>
			</div>
		</div>
		<div class="mobile-cta-links">
			<div class="button-container-mobile">
				<a href="<?php the_field('button_primary_url', 72); ?>" class="button primary">
					<span class="text"><?php the_field('button_primary_text', 72); ?></span>
				</a>
			</div>
			<div class="button-container-mobile">
				<a href="<?php the_field('button_secondary_url', 72); ?>" class="button secondary">
					<span class="text"><?php the_field('button_secondary_text', 72); ?></span>
				</a>
			</div>
			<div class="button-container-mobile">
				<a href="<?php the_field('button_tertiary_url', 72); ?>" class="button secondary">
					<span class="text"><?php the_field('button_tertiary_text', 72); ?></span>
				</a>
			</div>
		</div>
	</div>
</section>