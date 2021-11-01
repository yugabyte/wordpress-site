<?php
/** Template Name: Cloud v2 */

get_header();
?>
<div id="primary" class="content-area full">
    <div id="content" class="site-content" role="main">
        <?php while ( have_posts() ) : the_post(); ?>
            
            <main>
                <section class="c-v2-sm-yuga-intro">
                    <div class="c-row">
                        <div class="c-columns c-v2-sm-yuga-intro-top">
                            <div class="c-columns c-v2-sm-yuga-intro-subtitle animation-element fade-in-up c-center-text">
                                <?php the_field('intro_subtitle'); ?>
                            </div>
                            <div class="c-columns c-v2-sm-yuga-intro-title animation-element fade-in-up c-center-text">
                                <h1>
                                    <?php the_field('intro_title'); ?>
                                </h1>
                            </div>
                            <div class="c-columns c-v2-sm-yuga-intro-text-hold c-center-text">
                                <div class="c-v2-sm-yuga-intro-text animation-element fade-in-up">
                                    <?php the_field('intro_text'); ?>
                                </div>
                            </div>
                            <div class="c-columns c-v2-sm-yuga-intro-form animation-element fade-in-up c-center-text">
                                <div class="c-v2-intro-form animation-element fade-in-up">
                                    <!-- <input type="text" placeholder="Email Address">
                                    <button type="submit"><span>Sign Up</span></button> -->
                                    <a href="https://cloud.yugabyte.com/signup" class="c-btn-orange">
                                        <span> Sign Up </span>
                                    </a>
                                </div>
                                <div class="c-v2-intro-form-text animation-element fade-in-up">
                                    <?php the_field('after_form_text'); ?> <a href="<?php the_field('after_form_link_url'); ?>"><?php the_field('after_form_link_label'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="c-v2-sm-yuga-intro-bottom-hold">
                        <div class="c-row">
                            <div class="c-columns c-v2-sm-yuga-intro-bottom">
                                <ul>
                                    <?php if( have_rows('box_list') ): ?>
                                    <?php while( have_rows('box_list') ): the_row(); ?>
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
                    </div>
                </section>

                <section class="c-v2-sm-yuga-service">
                    <div class="c-row">
                        <div class="c-columns c-v2-sm-yuga-title-40 animation-element fade-in-up c-center-text">
                            <h2>
                                <?php the_field('services_title'); ?>
                            </h2>
                        </div>
                        <div class="c-v2-sm-yuga-service-textbox c-columns c-center-text">
                            <div class="c-v2-sm-yuga-text animation-element fade-in-up ">
                                <?php the_field('services_text'); ?>
                            </div>
                        </div>
                        <div class="c-columns c-v2-sm-yuga-service-list">
                            <?php if( have_rows('services_items') ): ?>
                            <?php while( have_rows('services_items') ): the_row(); ?>
                                <div class="c-columns c-v2-sm-yuga-service-list-item animation-element fade-in-up">
                                    <div class="c-columns c-v2-sm-yuga-service-list-item-img">
                                        <?php $image = get_sub_field('image'); ?>
                                        <?php if( $image && $image !== '' ) { ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        <?php } else { 
                                            $image = '';
                                        } ?>
                                    </div>
                                    <div class="c-columns c-v2-sm-yuga-service-list-item-textbox">
                                        <div class="c-columns c-v2-sm-yuga-service-list-item-title">
                                            <?php the_sub_field('title'); ?>
                                        </div>
                                        <div class="c-columns c-v2-sm-yuga-service-list-item-text">
                                            <?php the_sub_field('text'); ?>
                                        </div>
                                        <?php if( get_sub_field('link_url') && get_sub_field('link_label')) { ?>
                                            <div class="c-columns c-v2-sm-yuga-service-list-item-link">
                                                <a href="<?php the_sub_field('link_url'); ?>" class="c-btn-link-orange">
                                                    <?php the_sub_field('link_label'); ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>

                <section class="c-v2-sm-yuga-cloud">
                    <div class="c-row c-row-lgr">
                        <div class="c-columns c-v2-sm-yuga-cloud-box">
                            <div class="c-v2-yugabyte-db-section-triangle"></div>
                            <div class="c-columns c-v2-sm-yuga-cloud-top">
                                <div class="c-columns c-v2-sm-yuga-cloud-top-right">
                                    <?php $image = get_field('capabilities_top_image'); ?>
                                    <?php if( $image && $image !== '' ) { ?>
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                    <?php } else { 
                                        $image = '';
                                    } ?>
                                </div>
                                <div class="c-columns c-v2-sm-yuga-cloud-top-left">
                                    <div class="c-columns c-v2-sm-yuga-title-40 c-v2-sm-yuga-title-40-white animation-element fade-in-up">
                                        <h2>
                                            <?php the_field('capabilities_top_title'); ?>
                                        </h2>
                                    </div>
                                    <div class="c-columns c-v2-sm-yuga-text c-v2-sm-yuga-text-white animation-element fade-in-up">
                                        <?php the_field('capabilities_top_text'); ?>
                                    </div>
                                    <?php if( get_field('capabilities_top_button_url') && get_field('capabilities_top_button_label')) { ?>
                                        <div class="c-columns animation-element fade-in-up">
                                            <a href="<?php the_field('capabilities_top_button_url'); ?>" class="c-btn-orange c-btn-orange-auto">
                                                <span><?php the_field('capabilities_top_button_label'); ?></span>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="c-columns c-v2-sm-yuga-cloud-list">
                                <ul>
                                    <?php if( have_rows('capabilities_list') ): ?>
                                    <?php while( have_rows('capabilities_list') ): the_row(); ?>
                                        <li class="animation-element staggered fade-in-up">
                                            <div class="c-v2-sm-yuga-cloud-list-icon">
                                                <?php $image = get_sub_field('icon'); ?>
                                                <?php if( $image && $image !== '' ) { ?>
                                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                <?php } else { 
                                                    $image = '';
                                                } ?>
                                            </div>
                                            <div class="c-v2-sm-yuga-cloud-list-title">
                                                <?php the_sub_field('title'); ?>
                                            </div>
                                            <div class="c-v2-sm-yuga-cloud-list-text">
                                                <?php the_sub_field('text'); ?>
                                            </div>
                                        </li>
                                    <?php endwhile; ?>
                                    <?php endif; ?>
                                </ul>
                            </div> 
                            <?php if( get_field('capabilities_bottom_button_url') && get_field('capabilities_bottom_button_label') ) { ?>
                                <div class="c-columns c-center-text animation-element fade-in-up">
                                    <a href="<?php the_field('capabilities_bottom_button_url'); ?>" class="c-btn-orange c-btn-orange-auto">
                                        <span><?php the_field('capabilities_bottom_button_label'); ?></span>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </section>

                <section class="c-v2-sm-yuga-customers">
                    <div class="c-row">
                        <div class="c-columns c-get-started-title c-center-text animation-element fade-in-up">
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
                    </div>
                </section>

                <section class="c-v2-sm-yuga-pricing">
                    <div class="c-v2-yugabyte-db-section-triangle"></div>
                    <div class="c-row">
                        <div class="c-columns c-get-started-title c-center-text animation-element fade-in-up">
                            <h2>
                                <?php the_field('pricing_title'); ?>
                            </h2>
                        </div>
                        <div class="c-columns c-v2-sm-yuga-pricing-list">
                            <ul>
                                <?php if( have_rows('pricing_items') ): ?>
                                <?php while( have_rows('pricing_items') ): the_row(); ?>
                                    <li class="animation-element staggered fade-in-up">
                                        <div class="c-v2-sm-yuga-pricing-list-box c-center-text">
                                            <div class="c-v2-sm-yuga-pricing-list-img">
                                                <?php $image = get_sub_field('icon'); ?>
                                                <?php if( $image && $image !== '' ) { ?>
                                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                <?php } else { 
                                                    $image = '';
                                                } ?>
                                            </div>
                                            <div class="c-v2-sm-yuga-pricing-list-title">
                                                <?php the_sub_field('title'); ?>
                                            </div>
                                            <div class="c-v2-sm-yuga-pricing-list-price">
                                                <?php the_sub_field('price'); ?> <span><?php the_sub_field('price_period'); ?></span>
                                            </div>
                                            <div class="c-v2-sm-yuga-pricing-list-text">
                                                <?php the_sub_field('text'); ?>
                                            </div>
                                            <div class="c-v2-sm-yuga-pricing-list-btn">
                                                <a href="<?php the_sub_field('button_url'); ?>" class="c-btn-orange">
                                                    <span><?php the_sub_field('button_label'); ?></span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="c-columns c-get-started-title c-center-text animation-element fade-in-up">
                            <h2>
                                <?php the_field('pricing_bottom_title'); ?>
                            </h2>
                        </div>
                        <div class="c-columns c-get-started-text-hold c-center-text animation-element fade-in-up">
                            <div class="c-get-started-text">
                                <?php the_field('pricing_bottom_text'); ?>
                            </div>
                        </div>
                        <div class="c-columns c-v2-sm-yuga-pricing-logo-list">
                            <ul>
                                <?php if( have_rows('pricing_bottom_logo_list') ): ?>
                                <?php while( have_rows('pricing_bottom_logo_list') ): the_row(); ?>
                                    <li class="animation-element staggered fade-in-up">
                                        <?php if( get_sub_field('url') ) { ?>
                                            <a href="<?php the_sub_field('url'); ?>">
                                                <?php $image = get_sub_field('img'); ?>
                                                <?php if( $image && $image !== '' ) { ?>
                                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                <?php } else { 
                                                    $image = '';
                                                } ?>
                                            </a>
                                        <?php } else { ?>
                                            <?php $image = get_sub_field('img'); ?>
                                            <?php if( $image && $image !== '' ) { ?>
                                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                            <?php } else { 
                                                $image = '';
                                            } ?>
                                        <?php } ?>
                                    </li>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </section>

                <section class="c-v2-sm-yuga-resources">
                    <div class="c-v2-yugabyte-db-section-triangle"></div>
                    <div class="c-row">
                        <div class="c-columns c-get-started-title c-center-text animation-element fade-in-up">
                            <h2>
                            <?php the_field('resources_title'); ?>
                            </h2>
                        </div>
                        <div class="c-columns c-get-started-text-hold c-center-text animation-element fade-in-up">
                            <div class="c-get-started-text">
                                <?php the_field('resources_text'); ?>
                            </div>
                        </div>
                        <div class="c-columns c-v2-yugabyte-db-bottom-list c-v2-yugabyte-db-bottom-list-3">
                            <ul>
                                <?php if( have_rows('resources_items') ): ?>
                                <?php while( have_rows('resources_items') ): the_row(); ?>
                                    <li class="animation-element staggered fade-in-up">
                                        <div class="c-columns">
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
                </section>
            </main>

        <?php endwhile ?>
    </div><!-- .content-area -->
</div>
<?php get_footer(); ?>