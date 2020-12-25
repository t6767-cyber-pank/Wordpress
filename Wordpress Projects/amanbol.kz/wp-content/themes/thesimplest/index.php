<?php get_header(); ?>
<?php
/**
 * TheSimplest Layout Options
 */
$thesimplest_site_layout    =   get_theme_mod( 'thesimplest_layout_options_setting' );
$thesimplest_layout_class   =   'col-md-8 col-sm-12';

if( $thesimplest_site_layout == 'left-sidebar' && is_active_sidebar( 'sidebar-1' ) ) :
	$thesimplest_layout_class = 'col-md-8 col-sm-12 site-main-right';
elseif( $thesimplest_site_layout == 'no-sidebar' || !is_active_sidebar( 'sidebar-1' ) ) :
	$thesimplest_layout_class = 'col-md-8 col-sm-12 col-md-offset-2';
endif;

?>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
  FB.init({
    xfbml            : true,
    version          : 'v8.0'
  });
};

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/ru_RU/sdk/xfbml.customerchat.js';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your Chat Plugin code -->
<div class="fb-customerchat"
  attribution=install_email
  page_id="2156082867812965"
  theme_color="#d696bb">
</div>

<div id="primary" class="content-area row">
    <main id="main" class="site-main <?php echo esc_attr($thesimplest_layout_class); ?>" role="main">

	    <?php
        if( have_posts() ) : ?>

		    <?php if( is_home() && ! is_front_page() ) : ?>
                <header class="page-header">
                    <h1 class="page-title screen-reader-text">
                        <?php single_post_title(); ?>
                    </h1>
                </header>
		    <?php endif; ?>

            <?php
            // Start the loop
            while( have_posts() ) : the_post();

            get_template_part( 'template-parts/content', get_post_format() );

            // End the loop
            endwhile;

		    thesimplest_page_navigation();

        else :
	        get_template_part( 'template-parts/content', 'none' );
            ?>
        <?php endif; ?><!-- have_post() -->

    </main><!-- .site-main -->
    <?php get_sidebar(); ?>
</div><!-- content-area -->
<?php the_content(); ?>
<?php get_footer(); ?>