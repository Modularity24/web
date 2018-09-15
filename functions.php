<?php
// Translations can be filed in the /languages/ directory
//load_theme_textdomain( 'themejunkie', TEMPLATEPATH . '/languages' );	

load_theme_textdomain( 'themejunkie', get_template_directory() . '/languages' );

require_once('includes/sidebar-init.php');
require_once('includes/custom-functions.php');
require_once('includes/post-thumbnails.php');
require_once('includes/theme-options.php');
require_once('includes/theme-widgets.php');
//require_once('includes/theme-comments.php');
require_once('functions/theme_functions.php');
require_once('functions/admin_functions.php');

require_once(TEMPLATEPATH . '/includes/theme-posttypes.php');

require_once(TEMPLATEPATH . '/includes/meta-portfolio-items.php');
require_once(TEMPLATEPATH . '/includes/meta-featured-slider.php');
require_once(TEMPLATEPATH . '/includes/meta-testimonials.php');

?>
