<?php
/** Template Name: Homepage v2 */

get_header();
?>
<div id="primary" class="content-area full">
    <div id="content" class="site-content" role="main">
        <?php while ( have_posts() ) : the_post(); ?>
            
        <main>
            <section class="c-v2-intro-section">
                <div class="c-row">
                    <div class="c-v2-intro-text-box">
                        <?php if( get_field('intro_new_show') ) { ?>
                            <div class="c-v2-intro-subtitle animation-element fade-in">
                                <a href="<?php the_field('intro_new_url'); ?>">
                                    <span><?php the_field('intro_new_box_word'); ?></span> <?php the_field('intro_new_text'); ?>
                                </a>
                            </div>
                        <?php } ?>
                        <div class="c-v2-intro-title c-v2-intro-title-fade-words animation-element fade-in-up">
                            <h1>
                                <?php the_field('intro_title'); ?>
                            </h1>
                            <div id="c-v2-intro-title-hidden" class="c-v2-intro-title-hidden">
                                <?php if( have_rows('intro_title_fade_words') ): ?>
                                <?php while( have_rows('intro_title_fade_words') ): the_row(); ?>
                                    <span><?php the_sub_field('word'); ?></span>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="c-v2-intro-text animation-element fade-in-up">
                            <?php the_field('intro_text'); ?>
                        </div>
                        <div class="c-v2-intro-form animation-element fade-in-up">
                            <!-- <input type="text" placeholder="Email Address">
                            <button type="submit"><span>Get Demo</span></button> -->
                            <a href="https://www.yugabyte.com/demo/" class="c-btn-orange">
                                <span> Get Demo </span></a>
                        </div>
                        <div class="c-v2-intro-img-box c-v2-intro-img-box-mobile">
                            <?php $image = get_field('intro_side_image'); ?>
                        <?php if( $image && $image !== '' ) { ?>
                            <img class="animation-element fade-in" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php } else { 
                            $image = '';
                        } ?>
                        </div>
                        <div class="c-v2-intro-list">
                            <ul>
                                <?php if( have_rows('intro_boxes_list') ): ?>
                                <?php while( have_rows('intro_boxes_list') ): the_row(); ?>
                                    <li class="animation-element staggered fade-in-up">
                                        <div>
                                            <?php the_sub_field('title'); ?>
                                            <span><?php the_sub_field('text'); ?></span>
                                        </div>
                                    </li>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="c-v2-intro-img-box c-v2-intro-img-box-pc">
                        <?php $image = get_field('intro_side_image'); ?>
                        <?php if( $image && $image !== '' ) { ?>
                            <img class="animation-element fade-in" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php } else { 
                            $image = '';
                        } ?>
                    </div>
                </div>
            </section>

            <section class="c-v2-sticky-section">
                <div class="c-row">
                    <div class="c-columns c-v2-sticky-section-top">
                        <div class="c-v2-sticky-section-word c-v2-sticky-section-word-1">
                            <span class="animation-element fade-in"><?php the_field('sticky_section_first_hashtag'); ?></span>
                        </div>
                        <div class="c-columns c-v2-sticky-section-title animation-element fade-in-up">
                            <h2>
                                <?php the_field('sticky_section_main_title'); ?>
                            </h2>
                        </div>
                        <div class="c-columns c-v2-sticky-section-text animation-element fade-in-up">
                            <?php the_field('sticky_section_main_text'); ?>
                        </div>
                    </div>
                    <div class="c-columns c-v2-sticky-section-bottom-media">
                        <?php if( have_rows('sticky_section_items') ): ?>
                            <?php $stickyContent = 0; ?>
                        <?php while( have_rows('sticky_section_items') ): the_row(); $stickyContent++; ?>
                            <div class="c-columns c-v2-sticky-section-st-content-media">
                                <div class="c-columns c-v2-sticky-section-bottom-sticked-box">
                                    <div class="c-columns c-v2-sticky-section-bottom-right-textbox animation-element fade-in-up">
                                        <div class="c-columns c-v2-sticky-section-bottom-item-number">
                                            <?php if( $stickyContent < 10 ) { ?>
                                                0<?php echo $stickyContent; ?>
                                            <?php } else { ?>
                                                <?php echo $stickyContent; ?>
                                            <?php } ?>
                                        </div>
                                        <div class="c-columns c-v2-sticky-section-bottom-item-title">
                                            <?php the_sub_field('point_title'); ?>
                                        </div>
                                        <div class="c-columns c-v2-sticky-section-bottom-item-text">
                                            <?php the_sub_field('text'); ?>
                                        </div>
                                    </div>
                                    <div class="c-columns c-v2-sticky-section-bottom-right-imghold animation-element fade-in">
                                        <div class="c-v2-sticky-section-bottom-item-img">
                                            <?php $image = get_sub_field('image'); ?>
                                            <?php if( $image && $image !== '' ) { ?>
                                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                            <?php } else { 
                                                $image = '';
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="c-v2-sticky-section-bottom">
                    <div class="c-row">
                        <div id="c-v2-sticky-section-sticky-hiddens-wrapper" class="c-columns c-v2-sticky-hiddens">
                            <?php if( have_rows('sticky_section_items') ): ?>
                                <?php $stickyHidden = 0; ?>
                            <?php while( have_rows('sticky_section_items') ): the_row(); $stickyHidden++; ?>
                                <div id="c-v2-sticky-<?php echo $stickyHidden; ?>" class="c-columns c-v2-sticky-hidden animation-element-sticky"></div>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="c-v2-sticky-section-bottom-sticked-vh">
                        <div class="c-v2-sticky-section-bottom-sticked">
                            <div class="c-row">
                                <div class="c-v2-sticky-section-bottom-sticked-hold">
                                    <div class="c-columns c-v2-sticky-section-bottom-left">
                                        <div class="c-v2-sticky-section-word c-v2-sticky-section-word-2">
                                            <span class="animation-element fade-in"><?php the_field('sticky_section_second_hashtag'); ?></span>
                                        </div>
                                        <ul>
                                            <?php if( have_rows('sticky_section_items') ): ?>
                                                <?php $stickyPoints = 0; ?>
                                            <?php while( have_rows('sticky_section_items') ): the_row();  $stickyPoints++; ?>
                                                <li class="animation-element staggered fade-in-up active" data-id="c-v2-sticky-<?php echo $stickyPoints; ?>">
                                                    <?php the_sub_field('point_title'); ?>
                                                </li>
                                            <?php endwhile; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="c-columns c-v2-sticky-section-bottom-right animation-element fade-in">
                                        <?php if( have_rows('sticky_section_items') ): ?>
                                            <?php $stickyContent = 0; ?>
                                        <?php while( have_rows('sticky_section_items') ): the_row(); $stickyContent++; ?>
                                            <div data-id="c-v2-sticky-<?php echo $stickyContent; ?>" class="c-columns c-v2-sticky-section-st-content <?php if( $stickyContent == 1 ) { echo 'active';} ?>">
                                                <div class="c-columns c-v2-sticky-section-bottom-sticked-box">
                                                    <div class="c-columns c-v2-sticky-section-bottom-right-textbox">
                                                        <div class="c-columns c-v2-sticky-section-bottom-item-number">
                                                            <?php if( $stickyContent < 10 ) { ?>
                                                                0<?php echo $stickyContent; ?>
                                                            <?php } else { ?>
                                                                <?php echo $stickyContent; ?>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="c-columns c-v2-sticky-section-bottom-item-title">
                                                            <?php the_sub_field('title'); ?>
                                                        </div>
                                                        <div class="c-columns c-v2-sticky-section-bottom-item-text">
                                                            <?php the_sub_field('text'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="c-columns c-v2-sticky-section-bottom-right-imghold animation-element fade-in">
                                                        <div class="c-v2-sticky-section-bottom-item-img">
                                                            <?php $image = get_sub_field('image'); ?>
                                                            <?php if( $image && $image !== '' ) { ?>
                                                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                            <?php } else { 
                                                                $image = '';
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="c-v2-yugabyte-db-section">
                <div class="c-v2-yugabyte-db-section-triangle"></div>
                <div class="c-columns c-v2-yugabyte-db-section-triangle-top"></div>

                <div class="c-row">
                    <div class="c-columns c-v2-section-title-32 c-v2-section-title-white c-center-text animation-element fade-in-up">
                        <h2>
                            <?php the_field('yugabytedb_title'); ?>
                        </h2>
                    </div>
                    <div class="c-columns c-get-started-text-hold c-center-text animation-element fade-in-up">
                        <div class="c-get-started-text">
                            <?php the_field('yugabytedb_text'); ?>
                        </div>
                    </div>
                
                    <div class="c-columns c-v2-yugabyte-db-section-list">
                        <?php if( have_rows('yugabytedb_items') ): ?>
                        <?php while( have_rows('yugabytedb_items') ): the_row(); ?>
                            <div class="c-columns c-v2-yugabyte-db-section-list-item">
                                <div class="c-v2-yugabyte-db-section-list-item-img-hold animation-element fade-in">
                                    <div class="c-v2-yugabyte-db-section-list-item-img-primary">
                                        <?php $image = get_sub_field('image'); ?>
                                        <?php if( $image && $image !== '' ) { ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        <?php } else { 
                                            $image = '';
                                        } ?>
                                    </div>
                                    <?php $image = get_sub_field('second_image'); ?>
                                    <?php if( $image && $image !== '' ) { ?>
                                        <div class="c-v2-yugabyte-db-section-list-item-img-secondary animation-element fade-in">
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        </div>
                                    <?php } else { 
                                        $image = '';
                                    } ?>
                                </div>
                                <div class="c-v2-yugabyte-db-section-list-item-textbox">
                                    <span class="animation-element fade-in-up"><?php the_sub_field('title'); ?></span>
                                    <ul>
                                        <?php if( have_rows('list') ): ?>
                                        <?php while( have_rows('list') ): the_row(); ?>
                                            <li class="animation-element staggered fade-in-up">
                                                <?php the_sub_field('title'); ?>
                                            </li>
                                        <?php endwhile; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                
                    <div class="c-columns c-v2-yugabyte-db-section-img c-center-text">
                        <?php $image = get_field('yugabytedb_large_image'); ?>
                        <?php if( $image && $image !== '' ) { ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php } else { 
                            $image = '';
                        } ?>
                        <div class="c-v2-yugabyte-db-section-side-info c-v2-yugabyte-db-section-side-info-1 animation-element fade-in fade-in-later">
                            <?php the_field('yugabytedb_image_first_point'); ?>
                        </div>
                        <div class="c-v2-yugabyte-db-section-side-info c-v2-yugabyte-db-section-side-info-2 animation-element fade-in fade-in-later">
                            <?php the_field('yugabytedb_image_second_point'); ?>
                        </div>
                    </div>
                    <div class="c-columns c-v2-yugabyte-db-section-logo c-center-text">
                        <ul>
                            <?php if( have_rows('yugabytedb_logo_list') ): ?>
                            <?php while( have_rows('yugabytedb_logo_list') ): the_row(); ?>
                                <li class="animation-element staggered fade-in-up">
                                    <?php $image = get_sub_field('logo'); ?>
                                    <?php if( $image && $image !== '' ) { ?>
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                    <?php } else { 
                                        $image = '';
                                    } ?>
                                </li>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                        <div class="c-v2-yugabyte-db-section-side-info c-v2-yugabyte-db-section-side-info-3 animation-element fade-in fade-in-later">
                            <?php the_field('yugabytedb_logo_point'); ?>
                        </div>
                    </div>
                </div>

                <div class="c-v2-yugabyte-db-bottom-section">
                    <div class="c-row">
                        <div class="c-columns c-v2-yugabyte-db-bottom-list c-center-text">
                            <ul>
                                <?php if( have_rows('yugabytedb_bottom_white_blocks') ): ?>
                                <?php while( have_rows('yugabytedb_bottom_white_blocks') ): the_row(); ?>
                                    <li class="animation-element staggered fade-in-up">
                                        <div class="c-columns c-center-text">
                                            <div class="c-get-started-list-title">
                                                <h3>
                                                    <?php the_sub_field('title'); ?>
                                                </h3>
                                            </div>
                                            <div class="c-get-started-list-text">
                                                <?php the_sub_field('text'); ?>
                                            </div>
                                        </div>
                                        <a href="<?php the_sub_field('button_url'); ?>" class="c-btn-orange">
                                            <span><?php the_sub_field('button_label'); ?></span>
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section class="c-v2-customers-stories-section">
                <div class="c-row">
                    <div class="c-columns c-v2-customers-stories-title c-center-text animation-element fade-in-up">
                        <h2>
                            <?php the_field('customers_title'); ?>
                        </h2>
                    </div>
                    <div class="c-columns c-v2-customers-stories-slider animation-element fade-in-up">
                        <div class="owl-carousel owl-theme c-v2-customers-owl">
                            <?php if( have_rows('customers_list') ): ?>
                            <?php while( have_rows('customers_list') ): the_row(); ?>
                                <div class="item">
                                    <div class="c-v2-customers-owl-img">
                                        <?php $image = get_sub_field('image'); ?>
                                        <?php if( $image && $image !== '' ) { ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        <?php } else { 
                                            $image = '';
                                        } ?>
                                    </div>
                                    <div class="c-v2-customers-owl-textbox">
                                        <div>
                                            <?php $image = get_sub_field('logo'); ?>
                                            <?php if( $image && $image !== '' ) { ?>
                                                <div class="c-v2-customers-owl-person-logo">
                                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                </div>
                                            <?php } else { 
                                                $image = '';
                                            } ?>
                                            <div class="c-v2-customers-owl-quote">
                                                <?php the_sub_field('quote'); ?>
                                            </div>
                                            <div class="c-v2-customers-owl-person-info">
                                                <?php the_sub_field('person_name'); ?>
                                                <span><?php the_sub_field('person_position'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="c-columns c-v2-customers-stories-logos">
                        <ul>
                            <?php if( have_rows('customers_logo_list') ): ?>
                            <?php while( have_rows('customers_logo_list') ): the_row(); ?>
                                <li class="animation-element staggered fade-in-up">
                                    <a href="<?php the_sub_field('url'); ?>">
                                        <?php $image = get_sub_field('logo'); ?>
                                        <?php if( $image && $image !== '' ) { ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        <?php } else { 
                                            $image = '';
                                        } ?>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php if( get_field('customers_button_url') && get_field('customers_button_label')) { ?>
                        <div class="c-columns c-center-text animation-element fade-in-up">
                            <a href="<?php the_field('customers_button_url'); ?>" class="c-btn-orange">
                                <?php the_field('customers_button_label'); ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </section>

            <section class="c-v2-links-stats-section">
                <div class="c-row">
                    <?php if( have_rows('statistics_section_item') ): ?>
                    <?php while( have_rows('statistics_section_item') ): the_row(); ?>
                        <div class="c-columns c-v2-links-stats-item">
                            <div class="c-columns c-v2-links-stats-item-left">
                                <div class="c-v2-links-stats-item-title animation-element fade-in-up">
                                    <h3>
                                        <?php the_sub_field('title'); ?>
                                    </h3>
                                </div>
                                <div class="c-v2-links-stats-item-text animation-element fade-in-up">
                                    <?php the_sub_field('text'); ?>
                                </div>
                                <?php if( get_sub_field('button_url') && get_sub_field('button_label')) { ?>
                                    <div class="c-v2-links-stats-item-btn animation-element fade-in-up">
                                        <a href="<?php the_sub_field('button_url'); ?>" class="c-btn-blue">
                                            <?php the_sub_field('button_label'); ?>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="c-columns c-v2-links-stats-item-right">
                                <ul>
                                    <?php if( have_rows('side_list') ): ?>
                                    <?php while( have_rows('side_list') ): the_row(); ?>
                                        <li class="animation-element staggered fade-in-up">
                                            <div class="c-v2-links-stats-item-right-title">
                                                <?php the_sub_field('title'); ?>
                                            </div>
                                            <div class="c-v2-links-stats-item-right-text">
                                                <?php the_sub_field('text'); ?>
                                            </div>
                                        </li>
                                    <?php endwhile; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </section>

            <section class="c-v2-sql-blog-section">
                <div class="c-row">
                    <div class="c-columns c-get-started-title c-center-text animation-element fade-in-up">
                        <h2>
                            <?php the_field('get_started_title'); ?>
                        </h2>
                    </div>
                    <div class="c-columns c-get-started-text-hold c-center-text animation-element fade-in-up">
                        <div class="c-get-started-text">
                            <?php the_field('get_started_text'); ?>
                        </div>
                    </div>
                    <div class="c-columns c-get-started-list c-center-text">
                        <ul>
                            <?php if( have_rows('get_started_list') ): ?>
                            <?php while( have_rows('get_started_list') ): the_row(); ?>
                                <li class="animation-element staggered fade-in-up">
                                    <div class="c-get-started-list-title">
                                        <h3>
                                            <?php the_sub_field('title'); ?>
                                        </h3>
                                    </div>
                                    <a href="<?php the_sub_field('button_url'); ?>" class="c-btn-orange">
                                        <span><?php the_sub_field('button_label'); ?></span>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <div class="c-columns c-v2-sql-blog-list-line"></div>

                    <div class="c-columns c-v2-section-title-32 c-v2-section-title-white c-center-text animation-element fade-in-up">
                        <h2>
                            <?php the_field('blog_section_title'); ?>
                        </h2>
                    </div>
                    <div class="c-columns c-v2-sql-blog-list">
                        <?php if( have_rows('blog_section_items') ): ?>
                        <?php while( have_rows('blog_section_items') ): the_row(); ?>
                            <div class="c-v2-sql-blog-list-item">
                                <div class="c-v2-sql-blog-list-item-title animation-element fade-in-up">
                                    <h3>
                                        <?php the_sub_field('title'); ?>
                                    </h3>
                                </div>
                                <div class="c-v2-sql-blog-list-item-text animation-element fade-in-up">
                                    <?php the_sub_field('text'); ?>
                                    <a href="<?php the_sub_field('url'); ?>">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </main>

        <?php endwhile ?>
    </div><!-- .content-area -->
</div>
<?php get_footer(); ?>