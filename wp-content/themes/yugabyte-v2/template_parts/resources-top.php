<?php 
$the_subject = get_queried_object();
$global_section_id = 958; 
?>

<section class="hero" style="background-image: url(<?php the_field('hero_background_image', $global_section_id); ?>);">
	<div class="container">
		<div class="row">
			<div class="col">
				<h1 class="title"><?php the_field('hero_title', $global_section_id); ?></h1>
			</div>
		</div>
		<?php if(have_rows('hero_resources_repeater', $global_section_id)) { ?>
		<div class="row hero-resources">
			<?php while(have_rows('hero_resources_repeater', $global_section_id)) : the_row(); ?>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="item" style="background: url('<?php the_sub_field('background_image', $global_section_id); ?>'); background-size: auto 100%;">
					<div class="category"><?php the_sub_field('category', $global_section_id); ?></div>
					<a href="<?php the_sub_field('link_url', $global_section_id); ?>">
						<div class="main-title"><?php the_sub_field('title', $global_section_id); ?></div>
					</a>
					<div class="button-container">
						<a href="<?php the_sub_field('link_url', $global_section_id); ?>" class="button slide-in">
							<span class="text"><?php the_sub_field('link_text', $global_section_id); ?></span>
						</a>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
		<?php } ?>
	</div>
</section>

<?php if(have_rows('hero_banner_repeater', $global_section_id)) { ?>
<section class="hero-banner secondary">
	<div class="container">
		<div class="row">
			<?php while(have_rows('hero_banner_repeater', $global_section_id)) : the_row(); ?>
			<?php $isActive = $the_subject->name == get_sub_field('title', $global_section_id) ? true : false; ?>
			<div class="col item">
				<a href="<?php the_sub_field('url', $global_section_id); ?>" class="<?= $isActive ? 'active' : ''; ?>">
					<div class="icon icon-off"><img src="<?php the_sub_field('icon_off', $global_section_id); ?>"></div>
					<div class="icon icon-on"><img src="<?php the_sub_field('icon_on', $global_section_id); ?>"></div>
					<div class="main-title">
						<?php the_sub_field('title', $global_section_id); ?>

					</div>
				</a>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
</section>
<?php } ?>