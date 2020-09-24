<?php 
	/* Template Name: Case Study - Admiral-style */ 
?>

<!DOCTYPE html>
<html>
  <head>
    <?php include(locate_template('template_parts/main-head.php')); ?>
  </head>

  <body class="cs2">
    
    <div class="container">
      <div class="row">
        <div class="col-12">
          <header class="cs2__header">
            <a class="d-none d-md-block cs2__customer-logo" href="<?php the_field('customer_site_url'); ?>" target="_blank">
              <img src="<?php the_field('customer_logo'); ?>" />
            </a>
            <a class="cs2__header__yb-logo" href="<?php the_field('yugabyte_link'); ?>">
              <img src="<?php the_field('yugabyte_logo'); ?>" />
            </a>
            <a class="d-none d-md-block cs2__cta-btn" href="<?php the_field('button_primary_url'); ?>">
              <?php the_field('button_primary_text'); ?>
            </a>
            <a class="d-block d-md-none cs2__cta-btn" href="<?php the_field('button_primary_url'); ?>">
              <?php the_field('button_mobile_text'); ?>
            </a>
          </header>
        </div>
      </div>
    </div>

    <section class="cs2__hero">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <a class="d-block d-md-none cs2__customer-logo" href="<?php the_field('customer_site_url'); ?>" target="_blank">
              <img src="<?php the_field('customer_logo'); ?>" />
            </a>
            <h1 class="cs2__hero__title">
              <?php the_field('hero_statement'); ?>
            </h1>
            <div class="cs2__hero__yugabyte-purpose">
              <?php the_field('yugabyte_purpose'); ?>
            </div>
            <?php if(have_rows('hero_repeater')) { ?>
              <?php while(have_rows('hero_repeater')) : the_row(); ?>
                <div class="cs2__hero__repeater-row">
                  <div class="cs2__hero__repeater-col-icon" style="background-image: url(<?php the_sub_field('icon'); ?>)"></div>
                  <div class="cs2__hero__repeater-col-content">
                    <?php the_sub_field('company_info'); ?>
                  </div>
                </div>
              <?php endwhile; ?>
            <?php } ?>
          </div>
          <div class="col-md-5">
            <div class="cs2__hero__image" style="background-image: url(<?php the_field('hero_img'); ?>)">
              <?php if(get_field('testimonial_video_link')) { ?>
                <img class="cs2__hero__play-btn" src="<?php the_field('play_button'); ?>" />
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="cs2__customer-intro">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <img class="cs2__customer-intro__image" src="<?php the_field('company_image_1'); ?>" />
          </div>
          <div class="col-md-6">
            <h1 class="cs2__customer-intro__header">
              <?php the_field('company_info_header'); ?>
            </h1>
            <div class="cs2__customer-intro__details">
              <?php the_field('company_info_details'); ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php if(have_rows('info_repeater')) { ?>
      <section class="cs2__evaluation">
        <div class="container">
          <div class="row">
            <?php while(have_rows('info_repeater')) : the_row(); ?>
              <div class="col">
                <h1 class="cs2__evaluation__title">
                  <?php the_sub_field('section_title'); ?>
                </h1>
                <div class="cs2__evaluation__content">
                  <?php the_sub_field('section_content'); ?>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
        <!-- "evaluation_table" placeholder -->
      </section>
    <?php } ?>

    <?php if(have_rows('testimonials')) { ?>
      <div class="container">
        <section class="cs2__testimonials">
          <div class="row">
            <?php while(have_rows('testimonials')) : the_row(); ?>
              <div class="col">
                <div class="cs2__testimonials__quote">
                  <?php the_sub_field('advocater_quote'); ?>
                </div>
              </div>
              <?php if(!empty(get_sub_field('profile_picture'))) { ?>
                <div class="col-auto">
                  <div class="cs2__testimonials__picture-col">
                    <img class="cs2__testimonials__image" src="<?php the_sub_field('profile_picture'); ?>" />
                    <div class="cs2__testimonials__name">
                      <strong><?php the_sub_field('customer_name'); ?></strong>
                    </div>
                    <div class="cs2__testimonials__position">
                      <?php the_sub_field('customer_position'); ?>
                    </div>
                  </div>
                </div>
              <?php } ?>
            <?php endwhile; ?>
          </div>
        </section>
      </div>
    <?php } ?>

    <?php if(have_rows('implementation_details')) { ?>
      <section class="cs2__solutions">
        <div class="container">
          <h1 class="cs2__solutions__title">
            <?php the_field('solution_title'); ?>
          </h1>
          <div class="cs2__solutions__container">
            <?php while(have_rows('implementation_details')) : the_row(); ?>
              <div class="cs2__solutions__card">
                <img class="cs2__solutions__image" src="<?php the_sub_field('details_icon'); ?>" />
                <div class="cs2__solutions__details">
                  <?php the_sub_field('details_spec'); ?>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
      </section>
    <?php } ?>

    <?php if(have_rows('technical_repeater')) { ?>
      <section class="cs2__tech-details">
        <div class="container">
          <h1 class="cs2__tech-details__title">
            <?php the_field('technical_header'); ?>
          </h1>
          <div class="cs2__tech-details__container">
            <?php while(have_rows('technical_repeater')) : the_row(); ?>
              <div class="cs2__tech-details__card">
                <div class="cs2__tech-details__stat-number">
                  <?php the_sub_field('stat_number'); ?>
                </div>
                <div class="cs2__tech-details__stat-unit">
                  <?php the_sub_field('stat_unit'); ?>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
      </section>
    <?php } ?>

    <!-- The Modal -->
    <div id="video-modal" class="modal">
      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
        <?php the_field('demo_video'); ?>
      </div>
    </div>

    <footer class="cs2__footer">
      <div class="container cs2__footer__container">
        <h1 class="cs2__footer__title">
          <?php the_field('main_title'); ?>
        </h1>
        <div class="cs2__footer__buttons">
          <a class="cs2__secondary-btn" href="<?php the_field('button_secondary_url'); ?>">
            <?php the_field('button_secondary_text'); ?>
          </a>
          <a class="cs2__cta-btn" href="<?php the_field('button_primary_url'); ?>">
              <?php the_field('button_primary_text'); ?>
          </a>
        </div>
      </div>
    </footer>

    <footer class="footer-minimal">
      <?php include(locate_template('template_parts/footer-video.php')); ?>
    </footer>

    <?php include(locate_template('template_parts/main-scripts.php')); ?>
  </body>
</html>
