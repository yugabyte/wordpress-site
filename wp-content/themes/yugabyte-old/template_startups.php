<?php 
	/* Template Name: Startups Program */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body class="startups-page">
		<?php include(locate_template('template_parts/main-header.php')); ?>

    <section class="startups-page-hero" style="background-image: url(<?php the_field('hero_background'); ?>)">
      <div class="container">
				<div class="row">
          <div class="col-12">
            <h1 class="startups-page-hero__title"><?php the_field('hero_title'); ?></h1>
            <h2 class="startups-page-hero__body"><?php the_field('hero_body'); ?></h2>
          </div>
        </div>
      </div>
    </section>

    <section class="startups-page-hero-footer">
      <div class="container">
				<div class="row">
          <div class="col-md-8">
            <div class="startups-page-hero-footer__text"><?php the_field('hero_footer'); ?></div>
          </div>
          <div class="col-md-4 d-flex align-items-center">
            <a href="#contact-us" class="startups-page-hero-footer__btn">Contact Us</a>
          </div>
        </div>
      </div>
    </section>

    <section class="startups-page-info">
      <div class="container">
				<div class="row">
          <div class="col-12 d-flex flex-column align-items-center">
            <h1 class="startups-page-info__title"><?php the_field('info_header'); ?></h1>
            <h2 class="startups-page-info__subtitle"><?php the_field('info_subheader'); ?></h2>
          </div>
        </div>
      </div>
    </section>
    
    <?php if(have_rows('info_repeater')) { ?>
      <div class="startups-page-info__blocks">
        <div class="container">
          <div class="row">
            <?php while(have_rows('info_repeater')) : the_row(); ?>
              <div class="startups-page-info__block-wrapper">
                
                <div class="startups-page-info__block">
                  <div class="row align-items-center">
                    <div class="col-lg-5 text-center">
                      <img src="<?php the_sub_field('icon'); ?>" />
                    </div>
                    <div class="col-lg-7">
                      <div class="startups-page-info__block-title"><?php the_sub_field('title'); ?></div>
                    </div>
                  </div>  
                  <div class="startups-page-info__block-content">
                    <?php the_sub_field('description'); ?>
                  </div>
                </div>

              </div>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    <?php } ?>
    
    <section class="startups-page-customers">
      <div class="container">
        <div class="row justify-content-center">
          <h1 class="startups-page-customers__title"><?php the_field('customers_title'); ?></h1>
        </div>
        <?php if(have_rows('customers_logo')) { ?>
          <div class="startups-page-customers__logos-wrapper">
            <?php while(have_rows('customers_logo')) : the_row(); ?>
              <a href="<?php the_sub_field('link'); ?>" target="_blank">
                <img class="startups-page-customers__startup-logo" src="<?php the_sub_field('logo'); ?>" />
              </a>
            <?php endwhile; ?>
          </div>
        <?php } ?>
      </div>
    </section>

    <section class="startups-page-form">
      <div class="container">
        <div class="row">
          <div class="col-12" id="contact-us">
            <h1 class="startups-page-form__title"><?php the_field('contact_form_title'); ?></h1>
          </div>
        </div>
        <div class="startups-page-form__wrapper">
          <?php echo do_shortcode(get_field('contact_form_shortcode')) ?>
        </div>
      </div>
    </section>

		<?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html> 
