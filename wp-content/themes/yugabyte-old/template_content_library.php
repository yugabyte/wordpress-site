<?php 
  /* Template Name: Content Library */ 
?>

<!doctype html>
<html>
  <head>
    <?php include(locate_template('template_parts/main-head.php')); ?>
  </head>

  <body>
    <?php include(locate_template('template_parts/main-header.php')); ?>

    <div class="content-library">
      <section class="content-library-banner">
        <div class="container">
          <div class="row">
            <div class="col">
              <h1 class="content-library-banner__title"><?php the_field('title'); ?></h1>
              <h2 class="content-library-banner__subtitle"><?php the_field('subtitle'); ?></h2>
            </div>
          </div>        
        </div>
      </section>
      <section class="content-library-search">
        <div class="container">
          <div class="row justify-content-between">
            <div class="col-xl-3 col-sm-6 content-library-search__title">
              Find Resources
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
              <div class="content-library-search__input-group">
                <i class="fas fa-search content-library-search__input-icon"></i>
                <input type="text" class="content-library-search__input" placeholder="Search" />
              </div>
            </div>
          </div>
        </div>
      </section>
      <main class="container">
        <div class="row">
          <aside class="col-lg-3 col-sm-4 col-12">
            <div class="content-library-filters">
              <div class="content-library-filters__title content-library-filters__title--desktop">
                Filters
              </div>
              <div class="content-library-filters__title content-library-filters__title--mobile <?= empty(get_query_var('type')) ? '' : 'content-library-filters__title--selected'; ?>">
                <span><?= empty(get_query_var('type')) ? 'Filters' : get_query_var('type') ?></span>
                <div class="content-library-filters__chevron">
                  <i class="fas fa-chevron-up"></i>
                </div>
              </div>
              <div class="content-library-filters__container">
                <a class="content-library-filters__item <?= empty(get_query_var('type')) ? 'content-library-filters__item--active' : ''; ?>" href="<?= the_permalink(); ?>">All</a>
                <?php
                  $contentLibSubfields = get_field_object('content_lib_repeater')['sub_fields'];
                  if (isset($contentLibSubfields)) {
                    $i = array_search('type', array_column($contentLibSubfields, 'name'));
                    $contentTypes = $contentLibSubfields[$i]['choices'];
                    $currentType = get_query_var('type');

                    sort($contentTypes);
                    foreach ($contentTypes as $item) {
                      echo '<a class="content-library-filters__item '.(strcasecmp($currentType, $item) == 0 ? 'content-library-filters__item--active' : '').'" href="'.get_permalink().'?type='.$item.'">'.ucwords($item).'</a>';
                    }
                  }
                ?>
              </div>
            </div> 
          </aside>
          <div class="col-lg-9 col-sm-8 col-12">
            <div class="content-library-list container">
              <div class="row">
                <?php if (have_rows('content_lib_repeater')): ?>
                  <?php while (have_rows('content_lib_repeater')) : the_row(); ?>
                    <?php if (empty(get_query_var('type')) || strcasecmp(get_sub_field('type'), get_query_var('type')) == 0): ?>
                      <article class="content-library-tile col-xl-4 col-lg-6 col-12">
                        <div class="content-library-tile__tab">
                          <?php the_sub_field('type'); ?>
                        </div>
                        <div class="content-library-tile__card">
                          <div class="content-library-tile__thumb">
                            <a href="<?php the_sub_field('link'); ?>">
                              <img src="<?php the_sub_field('thumbnail'); ?>" alt="<?php the_sub_field('title'); ?>">
                            </a>
                          </div>
                          <div class="content-library-tile__text">
                            <?php the_sub_field('title'); ?>
                          </div>
                          <div class="content-library-tile__link">
                            <a href="<?php the_sub_field('link'); ?>">
                              <?php the_sub_field('link_text'); ?>
                            </a>
                          </div>
                        </div>
                      </article>
                    <?php endif; ?>
                  <?php endwhile; ?>
                <?php endif; ?>
              </div>
              <div class="row d-sm-none">
                <div class="col d-flex justify-content-center">
                  <div class="content-library-list__scroll-top">
                    <i class="fas fa-chevron-up"></i>
                    <span>Return<br>to top</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
    
    <?php include(locate_template('template_parts/main-footer.php')); ?>
    <?php include(locate_template('template_parts/main-scripts.php')); ?>	
  </body>
</html>
