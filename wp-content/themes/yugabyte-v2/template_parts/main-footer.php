<footer class="footer">
	<div class="main-footer">
		<div class="container">
			<div class="row clearfix footer-menu">
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
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="nav-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link">
								<img src="<?php the_field('footer_logo', 23); ?>">
							</a>
						</div>
						<?php if(have_rows('footer_social', 23)){?>
						<div class="footer-social">
							<?php while(have_rows('footer_social', 23)) : the_row(); ?>
								<a id="<?php the_sub_field('social'); ?>" href="<?php the_sub_field('link');?>">
									<i class="<?php the_sub_field('social'); ?>"></i>
								</a>
							<?php endwhile; ?>
						</div>
					<?php } ?>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="copyright"><?php the_field('main_copyright', 23); ?></div>
						<div class="copyright secondary"><?php the_field('secondary_copyright', 23); ?>
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/thespider-sanfrancisco-web-design-and-database-development.jpg" alt="TheSpider, Inc. San Francsico Web Design and Database Development" title="TheSpider, Inc. San Francsico Web Design and Database Development" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>