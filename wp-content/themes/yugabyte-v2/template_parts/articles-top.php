<?php 
$the_subject = get_queried_object();
$global_section_id = 1203; 
?>

<section class="hero" style="background-image:url(<?php the_field('hero_background_image', $global_section_id); ?>);background-size:cover;">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="title"><?php the_field('hero_title', $global_section_id); ?></div>
			</div>
		</div>
	</div>
</section>