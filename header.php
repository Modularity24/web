<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>" charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php tj_custom_titles(); ?></title>
<?php tj_custom_description(); ?>
<?php tj_custom_keywords(); ?>
<?php tj_custom_canonical(); ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/css3-mediaqueries.js"></script>
<![endif]-->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
<script type='text/javascript'>
	jQuery(document).ready(function() {
		$('#content-slider-1').royalSlider({
			autoHeight: true,
			arrowsNav: false,
			fadeinLoadedSlide: false,
			controlNavigationSpacing: 0,
			controlNavigation: 'tabs',
			imageScaleMode: 'none',
			imageAlignCenter:false,
			loop: false,
			loopRewind: true,
			numImagesToPreload: 6,
			keyboardNavEnabled: true,
			transitionType: '<?php echo (get_option('estudio_featured_slider_effect')); ?>',
			usePreloader: true
		});
	});
</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php /* Header Ad */
	if( get_option('estudio_header_ad_enable') == 'on'){
		echo "<div class='header-ad'>";
		echo get_option('estudio_header_ad_code');
		echo "</div>";
	} ?>
	<div id="header">
		<div class="container">
			<?php
				$logo = (get_option('estudio_logo') <> '') ? get_option('estudio_logo') : get_template_directory_uri().'/images/logo.png';
				if (get_option('estudio_text_logo_enable') == 'on') { 
			?>
				<div id="text-logo">
					<h1 id="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
					<p id="site-desc"><?php bloginfo('description'); ?></p>
				</div><!-- #text-logo -->
			<?php } else { ?>
				<a href="<?php echo home_url(); ?>">
					<img src="<?php echo ($logo) ?>" alt="<?php bloginfo('name'); ?>" id="logo"/>
				</a>
			<?php } ?>
			<div id="primary-nav" class="container">
				<?php 
					$menuClass = 'nav';
					$menuID = 'primary-navigation';
					$primaryNav = '';
					if (function_exists('wp_nav_menu')) {
						$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-nav', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false ) );
					};
					if ($primaryNav == '') { 
				?>
					<ul id="<?php echo $menuID; ?>" class="<?php echo $menuClass; ?>">
						<?php if (get_option('estudio_home_link') == 'on') { ?>
							<li <?php if (is_home()) { echo "class=\"first\""; } ?>><a href="<?php bloginfo('url'); ?>"><?php _e('Home', 'themejunkie') ?></a></li>
						<?php } ?>				
						<?php show_page_menu($menuClass,false,false); ?>
					</ul>
				<?php 
					} else echo ($primaryNav); 
				?>
				<div class="btn-nav-right">
					<?php _e('Menu', 'themejunkie'); ?> 
				</div><!-- .btn-nav-right -->				
			</div><!-- #primary-nav -->
			<div class="clear"></div>
	
		</div><!-- .container -->
	</div><!-- #header -->

			<nav id="mobile-menu">
				<div class="container">
					<?php
						 $menuClass = 'ul';
							$menuID = 'responsive-menu';
							$res_menu = '';
							$response_menu_args = array( 
								'theme_location' => 'primary-nav', 
								'container' => '', 
								'fallback_cb' => '', 
								'menu_class' => $menuClass, 
								'menu_id' => $menuID, 
								'echo' => false 
							);
						$res_menu = wp_nav_menu( $response_menu_args); 
						if ($res_menu) {
							
							echo $res_menu;
							
						}else{
							echo '<ul id="responsive-menu">';
							show_page_menu($menuClass,false,false); 
							echo '</ul>';
						}
					?>
				</div><!-- .container -->
			</nav><!-- #mobile-menu -->			
	
	<div id="main" class="container">