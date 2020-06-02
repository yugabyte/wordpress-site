<?php 
	/* Template Name: Research Landing */ 
?>

<!doctype html>
<html>
	<head>
		<?php include(locate_template('template_parts/main-head.php')); ?>
        <meta name="robots" content="noindex" />
	</head>

	<body id="research-page">
        <nav class="navbar research-page justify-content-between" role="menu" id="myNav">
            <div class="container research-page">
                <div class="yugabyte-branding">
                    <a class="yugabyte-logo" href="<?php the_field('yugabyte_link'); ?>">
                        <img src="<?php the_field('yugabyte_logo'); ?>" />
                    </a>                    
                </div>
            </div>
        </nav>
        <div class="hero" style="background-image: url(<?php the_field('hero_background'); ?>);">
            <div class="container">
                <div class="col-lg-8">
                    <div class="alert-box"><?php the_field('alert_text'); ?></div>
                    <h1 class="title"><?php the_field('title'); ?></h1>
                    <div class="subtitle"><?php the_field('subtitle'); ?></div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container main-text">
                <div id="content-pitch">
                    <?php the_field('content'); ?>
                </div>
                <div class="aside">
                    <h2><?php the_field('header_text'); ?></h2>
                    <div class="form-container">
                        <div class="card__face card__face--front">
                            <div class="preview">
                                <img  src="<?php the_field('report_preview'); ?>" />
                            </div>
                            <div class="download-form">
                                <?php echo do_shortcode( '[contact-form-7 id="2507" title="Download Report"]' ); ?>
                            </div>
                        </div>
                        <div class="card__face card__face--back">
                            Thank you for submitting. You will receive an email to download the document.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <div class="copyright"><?php the_field('copyright'); ?></div>
            <div class="links">
                <a href="https://www.yugabyte.com/support-policy/">Terms</a> | <a href="https://www.yugabyte.com/privacy-policy/">Privacy</a>
            </div>
        </footer>
        
        <?php include(locate_template('template_parts/main-scripts.php')); ?>
        <script> 
        function changeHeroBanner() {
            if (window.innerWidth < 500) {
                $('#research-page .hero').css('background-image', "url(<?php the_field('mobile_hero_background'); ?>)");
            } else {
                $('#research-page .hero').css('background-image', "url(<?php the_field('hero_background'); ?>)");
            }
        }

        window.onresize = changeHeroBanner;
        </script>
        <?php wp_footer(); ?>
    </body>
</html>