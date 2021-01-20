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
          <div class="col-12">
            <h1 class="yb-university-hero__title"><?php the_field('hero_title'); ?></h1>
            <h2 class="yb-university-hero__subtitle"><?php the_field('hero_subtitle'); ?></h2>
          </div>
        </div>
      </div>
    </section>


    <?php while(have_rows('trainings_repeater')) : the_row(); ?>
      <section>
        <div class="container">
          <div class="row">
            
            <div class="col-9">
              <div>
                <?php the_sub_field('training_title'); ?>
              </div>
              <div>
                <?php the_sub_field('training_description'); ?>
              </div>
              <div>
                <?php the_sub_field('training_cta_label'); ?>
              </div>
              <a href="#">
                <?php the_sub_field('training_cta_btn_text'); ?>
              </a>
            </div>

            <div class="col-3">
              <?php $parent_title = get_sub_field('training_available_courses_label'); ?>
              <?php if(have_rows('training_available_courses_repeater')) { ?>
                <div class="xxx">
                  <?php echo $parent_title; ?>
                </div>
                <ul>
                  <?php while(have_rows('training_available_courses_repeater')) : the_row(); ?>
                    <li>
                      <a href="<?php the_sub_field('training_available_courses_link'); ?>">
                        <?php the_sub_field('training_available_courses_name'); ?>
                      </a>
                    </li>
                  <?php endwhile; ?>
                </ul>
              <?php } ?>

              <?php $parent_title = get_sub_field('training_available_workshops_label'); ?>
              <?php if(have_rows('training_available_workshops_repeater')) { ?>
                <div>
                  <?php echo $parent_title; ?>
                </div>
                <ul>
                  <?php while(have_rows('training_available_workshops_repeater')) : the_row(); ?>
                    <li>
                      <a href="<?php the_sub_field('training_available_workshops_link'); ?>">
                        <?php the_sub_field('training_available_workshops_name'); ?>
                      </a>
                    </li>
                  <?php endwhile; ?>
                </ul>
              <?php } ?>

              <?php $parent_title = get_sub_field('training_courses_in_dev_label'); ?>
              <?php if(have_rows('training_courses_in_dev_repeater')) { ?>
                <div>
                  <?php echo $parent_title; ?>
                </div>
                <ul>
                  <?php while(have_rows('training_courses_in_dev_repeater')) : the_row(); ?>
                    <li>
                      <a href="<?php the_sub_field('training_courses_in_dev_link'); ?>">
                        <?php the_sub_field('training_courses_in_dev_name'); ?>
                      </a>
                    </li>
                  <?php endwhile; ?>
                </ul>
              <?php } ?>

            </div>
          </div>
        </div>
      </section>
    <?php endwhile; ?>

    

    

		<?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html> 
