<?php 
  /* Template Name: Events */ 
?>

<!doctype html>
<html>
  <head>
    <?php include(locate_template('template_parts/main-head.php')); ?>
  </head>

  <body>
    <?php include(locate_template('template_parts/main-header.php')); ?>
    
    <div class="events-page">
      <section class="banner-section">
        <div class="row">
          <div class="col-6 header-text">
            <h1 class="title"><?php the_field('hero_title'); ?></h1>
            <div class="subtitle"><?php the_field('hero_subtitle'); ?></div>
          </div>
          <div class="col-6 header-image">
            <img src="<?php the_field('banner_image'); ?>" height="200" />
          </div>
      </section>
      <div class="container">
        <?php if(have_rows('events_content_repeater')): ?>
          <?php $options = ['None'];
            foreach( get_field('events_content_repeater') as &$value) {
              if (!in_array($value["type"], $options)) {
                array_push($options, $value["type"]);
              }
            } ?>
          <div class="event-list">
            <div class="filters">
              <span>Filter by event type</span>
              <select id="event-type-filter">
                <?php foreach ($options as $type): array_map('htmlentities', $type); ?>
                  <option value="<?php echo $type ?>"><?php echo $type ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <ul>
            <?php while(have_rows('events_content_repeater')) : the_row(); ?>
              <li class="item-container" data-event-type="<?php the_sub_field('type'); ?>">
                <div class="image-wrapper">
                  <a class="conference-image" style="background-image: url('<?php the_sub_field('conference_image'); ?>')" rel="noopener noreferrer" target="_blank" href="<?php the_sub_field('external_link'); ?>"></a>
                </div>
                <div>
                  <a class="event-name brand-primary" rel="noopener noreferrer" target="_blank" href="<?php the_sub_field('external_link'); ?>"><?php the_sub_field('event_name'); ?></a>
                  <div class="event-info"> 
                    <span class="event-type"><?php the_sub_field('type'); ?></span>
                    <span class="event-dates"><?php the_sub_field('dates'); ?></span>
                    <span class="event-location"><?php the_sub_field('location'); ?></span>
                  </div>
                  <div class="event-description"><?php the_sub_field('description'); ?></div>
                </div>
              </li>
            <?php endwhile; ?>
            </ul>
          </div>
        <?php endif; ?>
      </div>

      <?php if(have_rows('meetup_repeater')) { ?>
        <section class="meetups">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="meetups-title">
                  <?php the_field('meetup_title'); ?>
                </div>                
                <div class="list-wrapper">
                  <?php while(have_rows('meetup_repeater')) : the_row(); ?>
                    <a class="meetup-tile" href="<?php the_sub_field('link'); ?>" target="_blank" rel="noopener noreferrer">
                      <img class="meetup-image" src="<?php the_sub_field('image'); ?>" />
                      <div class="meetup-name">
                        <?php the_sub_field('name'); ?>
                      </div>
                    </a>
                  <?php endwhile; ?>
                </div>
              </div>
            </div>
          </div>
        </section>
      <?php } ?>

      <section class="footer-cta">
        <div class="container">
          <div class="contributor-footnote">
            <?php $cta = get_field('events_cta'); ?>
            <div class="more-info email-info-text" style="font-size: 32px; line-height: 42px; color: white; text-align: center;">
              <?php echo $cta['text'] ?>
            </div>
            <div class="button-container">
              <a href="<?php echo $cta['email_url']; ?>" class="email-cta button">
                <?php echo $cta['email_text']; ?>
              </a>
            </div>
          </div>
        </div>
      </section>
    <?php include(locate_template('template_parts/main-footer.php')); ?>
    <?php include(locate_template('template_parts/main-scripts.php')); ?>	
  </body>
</html>
