<?php 
  /* Template Name: Yugabyte University */ 
?>

<!doctype html>
<html>
  <head>
    <?php include(locate_template('template_parts/main-head.php')); ?>
  </head>

  <body class="yb-university-page">
    <?php include(locate_template('template_parts/main-header.php')); ?>

    <section class="yb-university-hero" style="background-image: url(<?php the_field('hero_background'); ?>)">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="yb-university-hero__title"><?php the_field('hero_title'); ?></h1>
            <h2 class="yb-university-hero__subtitle"><?php the_field('hero_subtitle'); ?></h2>
          </div>
        </div>
      </div>
    </section>

    <?php while(have_rows('trainings_repeater')) : the_row(); ?>
      <section class="yb-university-training">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
              <h1 class="yb-university-training__title">
                <?php the_sub_field('training_title'); ?>
              </h1>
              <div class="yb-university-training__description">
                <?php the_sub_field('training_description'); ?>
              </div>
              <div class="yb-university-training__cta-label">
                <?php the_sub_field('training_cta_label'); ?>
              </div>
              <a href="<?php the_sub_field('training_cta_btn_link'); ?>" class="yb-university-training__cta-btn">
                <?php the_sub_field('training_cta_btn_text'); ?>
              </a>
            </div>

            <div class="col-md-5">
              <div class="yb-university-training__links-wrapper">
                <?php
                  $parent_title = get_sub_field('training_available_courses_label');
                  if(have_rows('training_available_courses_repeater')) {
                ?>
                  <div class="yb-university-training__links-group-title">
                    <?php echo $parent_title; ?>
                  </div>
                  <ul class="yb-university-training__links-list">
                    <?php while(have_rows('training_available_courses_repeater')) : the_row(); ?>
                      <li>
                        <?php if(empty(get_sub_field('training_available_courses_link'))) { ?>
                          <span class="yb-university-training__list-item">
                            <?php the_sub_field('training_available_courses_name'); ?>
                          </span>
                        <?php } else { ?>
                          <a
                            href="<?php the_sub_field('training_available_courses_link'); ?>"
                            class="yb-university-training__list-item yb-university-training__list-item--link"
                            target="_blank"
                          >
                            <?php the_sub_field('training_available_courses_name'); ?>
                          </a>
                        <?php } ?>
                      </li>
                    <?php endwhile; ?>
                  </ul>
                <?php } ?>

                <?php
                  $parent_title = get_sub_field('training_available_workshops_label');
                  if(have_rows('training_available_workshops_repeater')) {
                ?>
                  <div class="yb-university-training__links-group-title">
                    <?php echo $parent_title; ?>
                  </div>
                  <ul class="yb-university-training__links-list">
                    <?php while(have_rows('training_available_workshops_repeater')) : the_row(); ?>
                      <li>
                        <?php if(empty(get_sub_field('training_available_workshops_link'))) { ?>
                          <span class="yb-university-training__list-item">
                            <?php the_sub_field('training_available_workshops_name'); ?>
                          </span>
                        <?php } else { ?>
                          <a
                            href="<?php the_sub_field('training_available_workshops_link'); ?>"
                            class="yb-university-training__list-item yb-university-training__list-item--link"
                            target="_blank"
                          >
                            <?php the_sub_field('training_available_workshops_name'); ?>
                          </a>
                        <?php } ?>
                      </li>
                    <?php endwhile; ?>
                  </ul>
                <?php } ?>

                <?php
                  $parent_title = get_sub_field('training_courses_in_dev_label');
                  if(have_rows('training_courses_in_dev_repeater')) {
                ?>
                  <div class="yb-university-training__links-group-title">
                    <?php echo $parent_title; ?>
                  </div>
                  <ul class="yb-university-training__links-list">
                    <?php while(have_rows('training_courses_in_dev_repeater')) : the_row(); ?>
                      <li>
                        <?php if(empty(get_sub_field('training_courses_in_dev_link'))) { ?>
                          <span class="yb-university-training__list-item">
                            <?php the_sub_field('training_courses_in_dev_name'); ?>
                          </span>
                        <?php } else { ?>
                          <a
                            href="<?php the_sub_field('training_courses_in_dev_link'); ?>"
                            class="yb-university-training__list-item yb-university-training__list-item--link"
                            target="_blank"
                          >
                            <?php the_sub_field('training_courses_in_dev_name'); ?>
                          </a>
                        <?php } ?>
                      </li>
                    <?php endwhile; ?>
                  </ul>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endwhile; ?>

    <section class="yb-university-footer">
      <div class="yb-university-footer__titles-wrapper">
        <h1 class="yb-university-footer__title"><?php the_field('footer_title'); ?></h1>
        <h2 class="yb-university-footer__subtitle"><?php the_field('footer_subtitle'); ?></h2>
      </div>
      <div class="yb-university-footer__btns-wrapper">
        <a href="<?php the_field('footer_contact_btn_link'); ?>" class="yb-university-training__cta-btn">
          <?php the_field('footer_contact_btn_text'); ?>
        </a>
        <a href="<?php the_field('footer_slack_btn_link'); ?>" class="yb-university-training__cta-btn" target="_blank">
          <?php the_field('footer_slack_btn_text'); ?>
        </a>
      </div>
    </section>
    
    <?php include(locate_template('template_parts/main-footer.php')); ?>
    <?php include(locate_template('template_parts/main-scripts.php')); ?>	
  </body>
</html> 
