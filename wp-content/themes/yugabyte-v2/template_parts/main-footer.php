<footer class="footer">
	<div class="main-footer">
		<div class="container">
			<div class="row clearfix footer-menu">
				<div class="col logo-cta-container">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo-link">
						<img class="navBlack" src="/wp-content/uploads/2019/07/ybDB-Dark-v2.svg">
					</a>
					<div class="email-contact"><?php echo do_shortcode( get_field('hero_email_cta') ); ?></div>
					<?php if(have_rows('footer_social', 23)){ ?>
						<div class="social-icons">
						<?php while(have_rows('footer_social', 23)) : the_row(); ?>
							<a href="<?php the_sub_field('link', 23); ?>" target="_blank">
								<img src="<?php the_sub_field('icon', 23); ?>" alt="<?php the_sub_field('social', 23); ?>" />
							</a>
						<?php endwhile; ?>
						</div>
					<?php } ?>
				</div>
				<?php if(have_rows('column_1_repeater', 23)){ ?>
				<div class="col">
					<ul>
						<?php while(have_rows('column_1_repeater', 23)) : the_row(); ?>
							<a href="<?php the_sub_field('item_link', 23); ?>">
								<li><span class=""><?php the_sub_field('item', 23); ?></span></li>
							</a>
						<?php endwhile; ?>
					</ul>
				</div>
				<?php } ?>
				<?php if(have_rows('column_2_repeater', 23)){ ?>
				<div class="col">
					<ul>
						<?php while(have_rows('column_2_repeater', 23)) : the_row(); ?>
							<a href="<?php the_sub_field('item_link', 23); ?>">
								<li><span class=""><?php the_sub_field('item', 23); ?></span></li>
							</a>
						<?php endwhile; ?>
					</ul>
				</div>
				<?php } ?>
				<?php if(have_rows('column_3_repeater', 23)){ ?>
				<div class="col">
					<ul>
						<?php while(have_rows('column_3_repeater', 23)) : the_row(); ?>
							<a href="<?php the_sub_field('item_link', 23); ?>">
								<li><span class=""><?php the_sub_field('item', 23); ?></span></li>
							</a>
						<?php endwhile; ?>
					</ul>
				</div>
				<?php } ?>
				<?php if(have_rows('column_4_repeater', 23)){ ?>
				<div class="col">
					<ul>
						<?php while(have_rows('column_4_repeater', 23)) : the_row(); ?>
							<a href="<?php the_sub_field('item_link', 23); ?>">
								<li><span class=""><?php the_sub_field('item', 23); ?></span></li>
							</a>
						<?php endwhile; ?>
					</ul>
				</div>
				<?php } ?>
			</div>
			<div class="row clearfix">
				<div class="col-lg-12 copyright-container">
					<span class="copyright"><?php the_field('main_copyright', 23); ?></span>
					<a class="terms-hyperlink" href="<?php the_field('terms_url', 23); ?>" target="_blank">Terms</a>
					<a href="<?php the_field('privacy_url', 23); ?>" target="_blank">Privacy</a>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>