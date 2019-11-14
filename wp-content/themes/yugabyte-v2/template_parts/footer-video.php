<div class="main-footer">
    <div class="container">
        <ul class="footer-nav">
            <li class="footer-items">
                <div class="logo-white">
                    <img width="50px" height="30px" alt="YugabyteDB logo" src="<?php the_field('yb_logo_white', 1630); ?>" />
                    <div class="copyright">
                        <div style="margin-bottom: 3px;">© 2019 YugaByte, Inc.</div>
                        <a href="<?php the_field('privacy_policy_url', 1630); ?>">Privacy Policy</a>
                    </div>
                </div>
            </li>
            <?php if(have_rows('footer_links_repeater', 1630)) { ?>
                <?php while(have_rows('footer_links_repeater', 1630)) : the_row(); ?>
                    <li class="footer-items">
                        <a target="_blank" href="<?php the_sub_field('link_url', 1630); ?>" rel="noopener" class="footer-link"><?php the_sub_field('link_text', 1630); ?></a>
                    </li>        
                <?php endwhile; ?>
            <?php } ?>
            <li class="footer-items">
                <div class="footer-title">Address</div>
                <a href="<?php the_field('maps_address', 1630); ?>" target="_blank" rel="noopener" id="office-map">
                    <?php the_field('office_address', 1630); ?>
                </a>
            </li>
            <li class="footer-items">
                <div class="footer-title">Follow Us</div>
                <div class="footer-social">
                <?php if(have_rows('social_media_repeater', 1630)) { ?>
                    <?php while(have_rows('social_media_repeater', 1630)) : the_row(); ?>
                        <a target="_blank" href="<?php the_sub_field('social_media_url', 1630); ?>" rel="noopener" class="footer-link">
                            <img src="<?php the_sub_field('social_media_icon', 1630); ?>" />
                        </a>
                    <?php endwhile; ?>
                <?php } ?>
                </div>
            </li>            
        </ul>
    </div>
</div>