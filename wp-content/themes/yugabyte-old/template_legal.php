<?php 
	/* Template Name: Legal Pages */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
	</head>

	<body class="legal-page">
		<?php include(locate_template('template_parts/main-header.php')); ?>
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-10">
              <div class="legal-page__content">
                <?php the_content(); ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endwhile; endif; ?>

		<?php include(locate_template('template_parts/more-orange.php')); ?>
		<?php include(locate_template('template_parts/footer-cta.php')); ?>
		
		<?php include(locate_template('template_parts/main-footer.php')); ?>
		<?php include(locate_template('template_parts/main-scripts.php')); ?>	
	</body>
</html> 
