<!doctype html>
<html <?php language_attributes(); ?>>
<head class="no-js">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

    <?php wp_head(); ?>
<script type="text/javascript">!function(){var
t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?167",t.onload=function(){VK.Retargeting.Init("VK-RTRG-453831-bsMA3"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script><noscript><img
src="https://vk.com/rtrg?p=VK-RTRG-453831-bsMA3" style="position:fixed; left:-999px;" alt=""/></noscript>
	<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '402686240561415');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=402686240561415&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<!-- Load Facebook SDK for JavaScript -->
	<div class="fb-customerchat"
 page_id="<PAGE_ID>">
</div>
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
</head>
<body <?php body_class(); ?>>
<?php
$thesimplest_search_icon_handle      =   get_theme_mod( 'simple_search_icon_handle', 1 );
if( $thesimplest_search_icon_handle ) :
?>
    <div class="search-popup">
        <span class="search-popup-close"><i class="fa fa-times"></i></span>
        <?php get_search_form(); ?>
    </div><!-- .search-popup -->
<?php endif; ?>

<div id="page" class="site">
    <div class="site-inner">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'thesimplest' ); ?></a>

        <header id="masthead" class="site-header" role="banner">

        <?php if( thesimplest_social_search_check() == 1 ) : ?>
            <div class="container">
                <div class="header-links">
                    <?php if( get_theme_mod( 'thesimplest_search_icon_handle', 1 ) ) : ?>
                        <span class="btn-search fa fa-search icon-button-search"></span>
                    <?php endif; ?>
	                <?php thesimplest_social_icons_output(); ?>
                </div><!-- .header-link -->
            </div>
        <?php endif; ?>

        <div class="site-header-main">
            <div class="site-branding">
                <?php if( function_exists( 'the_custom_logo' ) ) : the_custom_logo(); endif;

                if( is_front_page() && is_home() ) : ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                    </h1>
                <?php else : ?>
                    <p class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                    </p>
                <?php endif;
                $description = get_bloginfo( 'description', 'display' );
                if( $description || is_customize_preview() ) :
                ?>
                    <p class="site-description"><?php echo esc_html( $description ); ?></p>
                <?php endif; ?>

            </div><!-- .site-branding -->

            <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <div class="menu-wrapper">
                <button id="menu-toggle" class="menu-toggle toggled-on" aria-expanded="true" aria-controls="site-navigation social-navigation"><?php esc_html_e( 'Menu', 'thesimplest' ) ?></button>
                <div id="site-header-menu" class="site-header-menu clearfix">

                        <nav id="site-navigation" class="main-navigation container" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'thesimplest' ); ?>">
				            <?php
				            wp_nav_menu( array(
					            'theme_location' => 'primary',
					            'menu_class'     => 'primary-menu',
					            'fallback_cb'    =>  false
				            ) );
				            ?>
                        </nav><!-- .main-navigation -->
                </div><!-- .site-header-menu -->
            </div><!-- .menu-wrapper -->
            <?php endif; ?>

        </div><!-- .site-header-main -->


    <?php if( is_front_page() || is_home() ) : if( has_custom_header() ) : ?>
        <!-- Header Image -->
        <div class="header-image"
             style="background-image: url(<?php header_image() ?>);">
        </div>
    <?php endif; endif; ?>

</header>
        <div id="content" class="site-content container"> 